<?php
 /**
 * Home controller class
 *
 * Displays User Dashboard page
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/profile/home
 */
class Home extends CI_Controller {

    /*
     * Home controller class constructor
     */

    public function __construct() {
	parent::__construct(); 
	$this->load->model('Fullcalendar_model','calendar');
	$this->load->model('Category_model');
	$this->load->model('Member_model');
	$this->load->model('gmaps_model');		
	$this->load->model('Eventsources_model');  
	$this->load->model('Page_model');  	
	 
	$this->load->helper('string');
	$this->load->helper('date');	 
	$this->load->helper('security');
	$this->load->helper('form');
	$this->load->helper('url'); 	
	
	$this->load->library('ion_auth');
	$this->load->library('Recurrence');
	$this->load->library('Languages'); 
	$this->load->library('Icalendar');
	$this->load->library('Notify');
	$this->load->library('form_validation');  	  
	$this->load->library('upload');
	$this->load->library('image_lib'); 

	// load all settings into an array
	$this->setting = $this->Setting_model->getEverySetting();
    }

    /**
    * Display template
    * This function displays the dashboard
    ****
    * @access public/private
    * @ Param none
    * @return none
    */
    function index() { 
	 
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
 
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('calendar');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];
		$data['key'] = $this->setting['cal_apikey'];   
		$data['current_version'] = config_item('version');
		
		// check if the user is logged in 
	    if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
			
			//load the data within view
			$data['userinfo'] = $this->Member_model->getUserById($user->id);	
			$data['pagename'] = $this->Page_model->getAllMembersPages(4, $this->uri->segment(4));  
			$data['groups'] = $this->ion_auth->get_users_groups($user->id)->result_array();
			$data['currentGroups'] = $this->ion_auth->get_users_groups($user->id)->result();  		
			$data['userCategories'] = $this->Category_model->get_categories($user);  		
			$data['userSources'] = $this->Eventsources_model->getSourceList(0,0,$user->username);
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
	 
			debug('Initialize index - loading "home/index" view');
			$sections = array('body_content' => $this->setting['current_theme'] . '/backend/home/index', 'nav_content' => $this->setting['current_theme'] . '/backend/home/nav', 'header_content' => $this->setting['current_theme'] . '/backend/home/header', 'footer_content' => $this->setting['current_theme'] . '/backend/home/footer');
			$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
  
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);

		} 

	}
	
   /**
    * import - events are saved in ics format
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */			
	public function upload_file() {
		debug('Initialize upload - loading "home/upload_file" uploading ICS files');
		// check user is logged in with permissions   
		
		 if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
		
			$user = $this->ion_auth->user()->row();
			
			$userinfo = $this->Member_model->getUserById($user->id);
		 
			$status = "";
			$msg = "";
			$file_element_name = 'userfile';  
			
			if ($status != "error")   {
		   
				$config['upload_path']	= $this->setting['sync_path_location'];
				$config['allowed_types']= $this->setting['sync_allowed_extension'];  
				$config['max_size']		= $this->setting['sync_max_size'];
				$config['encrypt_name'] = FALSE;  

				$this->upload->initialize($config);

				if (!$this->upload->do_upload($file_element_name))	{
				
					 $status = 'error';
					 $msg = $this->upload->display_errors('', '');
				
				}else {
				
					$data = $this->upload->data();
					$filename = $_FILES['userfile']['tmp_name'];
					 
					$this->calendar->import($userinfo->username, $this->icalendar->parseFile($filename)); 					
				}
				@unlink($_FILES[$file_element_name]);
			}
			
		}else {
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301); 
		}	  		 
   }	
 	
   /**
    * export - Export specific event in ics format
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function export($id) {		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('calendar');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['key'] = $this->setting['cal_apikey'];
		$data['current_version'] = config_item('calendar_version');
		
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {			
			
			$user = $this->ion_auth->user()->row();
		
			$userinfo = $this->Member_model->getUserById($user->id);
		  
			debug('Initialize export - loading "home/index" ics export'); 
			$filename = $userinfo->username . "_export_". now() .".ics";
			header("Content-type:text/calendar");
			header("Content-Disposition: attachment; filename=$filename");  
			
			$timezone = $this->setting['site_timezone']; 
			echo $this->calendar->export($userinfo->username, $id, $timezone, $data['lang']); 
		
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 301);
		}
	}	   
	
	/**
    * export_all - All events are saved in ics format by each member
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function export_all() {		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('calendar');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description']; 
		$data['key'] = $this->setting['cal_apikey'];
		$data['current_version'] = config_item('calendar_version');
		
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
		
			$userinfo = $this->Member_model->getUserById($user->id);
		  
			debug('Initialize export - loading "home/index" ics export'); 
			$filename = $userinfo->username . "_export_". now() .".ics";
			header("Content-type:text/calendar");
			header("Content-Disposition: attachment; filename=$filename");  
			
			$timezone = $this->setting['site_timezone']; 
			echo $this->calendar->export($userinfo->username, 0, $timezone, $data['lang']); 
		
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 301);
		}
	}		
		
    /**
    * search - query events by title
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function search() {
		// check user is logged in with permissions  
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row(); 
			$title = $this->security->xss_clean($this->input->get('title'));  
			echo $this->calendar->search_private($title, $user->username); 
		  
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 301);
		}		
	
	}	

    /**
    * get_usergroups events and shows
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
	public function get_usergroups()	{ 	  
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
			// pass the user group to the view
			$usergroups = $this->ion_auth->get_users_groups($user->id)->result(); 
			
			echo json_encode($usergroups);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}        
	
	/**
    * get_groups events and shows
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
	public function get_groups()	{ 	  
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
			// pass the user group to the view
			$groups = $this->ion_auth->get_users_groups($user->id)->result_array();
			
			echo json_encode($groups);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}    
	
    /**
    * get_marker events and shows
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_marker() { 
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row(); 
			$category = $this->security->xss_clean($this->input->get('category'));
			$marker = $this->gmaps_model->get($category, $user->username);
			
			echo json_encode($marker);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}
	
    /**
    * get_category events and shows
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
	public function get_category()	{ 	  
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			$user = $this->ion_auth->user()->row(); 
			$category = $this->Category_model->get_categories($user); 
			echo json_encode($category); 
		}
	}
	
     /**
    * get_eventsource get the list of 20 event sources
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
	public function get_eventsource() { 		 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row();  
		$category = $this->Eventsources_model->getSourceList(20,0,$user->username);
		echo json_encode($category); 
	}	
	
     /**
    * get_lang events and shows
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_lang() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row();  
		echo json_encode($user->lang); 
	}     
	
	/**
    * get_timezone events and shows
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_timezone() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row();  
		$datetime = new DateTime('now', new DateTimeZone($user->cal_timezone));
		$datetime_string = $datetime->format('c');  
		echo json_encode($datetime_string); 
	}
	/**
    * get_timezone2 get timezone string
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_timezone2() {  
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row();  
		echo json_encode($user->cal_timezone); 
	}	
	
	/**
    * get_coordinate - get longitude, latitude string
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_coordinate() {   	 
		$latitude = $this->setting['site_latitude']; 
		$longitude = $this->setting['site_longitude'];  
		$coordinate = $latitude.",".$longitude; 
		echo json_encode($coordinate); 
	}
	
	/**
    * get_defaultview events and shows
    * This function is called to specify calendar default view.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_defaultview() {  
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_defaultview); 
	}	
	
	/**
    * get_header_left - headers buttons
    * This function is called to specify calendar default header_left.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_header_left() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_header_left); 
	}
	
	/**
    * get_header_center - headers buttons
    * This function is called to specify calendar default header_center.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_header_center() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_header_center); 
	}	
	
	/**
    * get_header_right - headers buttons
    * This function is called to specify calendar default header right.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_header_right() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_header_right); 
	}	
		
	
	/**
    * get_firstday - calendar preference
    * This function is called to specify calendar default hiddenDays.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_firstday() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row();	 
		echo json_encode($user->cal_firstday); 
	}	
	
	/**
    * get_mintime - calendar preference
    * This function is called to specify calendar default minTime.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_mintime() { 
		// check user is logged in with permissions   
		$user = $this->ion_auth->user()->row();	 
		echo json_encode($user->cal_mintime); 
	}		
	
	/**
    * get_maxtime - calendar preference
    * This function is called to specify calendar default maxTime.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_maxtime() { 
		// check user is logged in with permissions   
		$user = $this->ion_auth->user()->row();	 
		echo json_encode($user->cal_maxtime); 
	}		
	
	/**
    * get_hiddenDays - calendar preference
    * This function is called to specify calendar default hiddenDays.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_hiddendays() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 	 
		echo json_encode($user->cal_hiddendays); 
	}
	
	/**
    * get_businessstart - calendar preference
    * This function is called to specify calendar default hiddenDays.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_businessstart() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_businessstart); 
	}		
	
	/**
    * get_businessend - calendar preference
    * This function is called to specify calendar default hiddenDays.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_businessend() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_businessend); 
	}		
	
	/**
    * get_businessdays - calendar preference
    * This function is called to specify calendar default hiddenDays.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_businessdays() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_businessdays); 
	}		
	
	/**
    * get_apikey - calendar preference
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_googlekey() {    
		$key = $this->setting['cal_apikey']; 	 
		echo json_encode($key); 
	}	
	
	/**
    * get_schedulerkey - calendar scheduler preference
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_schedulerkey() {    
		$key = $this->setting['cal_schedulerkey']; 	 
		echo json_encode($key); 
	}		
	
	/**
    * get_editable - calendar preference
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_editable() {    
		$editable = $this->setting['cal_editable']; 	 
		echo json_encode($editable); 
	}	
	
	/**
    * get_weeknumberswithindays - calendar preference
    * This function is called to specify calendar default weeknumbers within days.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_weeknumberswithindays() {  
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_weeknumberswithindays); 
	}	
	
	/**
    * get_weeknumbers - calendar preference
    * This function is called to specify calendar default weeknumbers.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_weeknumbers() {  
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_weeknumbers); 
	}	
	
	/**
    * get_eventlimit - calendar preference
    * This function is called to specify calendar default eventlimit.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_eventlimit() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_eventlimit); 
	}
		
	/**
    * get_alldayslot - calendar preference
    * This function is called to specify calendar default alldayslot.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_alldayslot() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_alldayslot); 
	}	
	
	/**
    * get_slotduration - calendar preference
    * This function is called to specify calendar default view for slot duration.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_slotduration() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_slotduration); 
	}		
	
	/**
    * get_slotlabeling - calendar preference
    * This function is called to specify calendar default view for slot labeling.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_slotlabeling() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row();  
		echo json_encode($user->cal_slotlabeling); 
	}	
	
	/**
    * get_slotlabelformat - calendar preference
    * This function is called to specify calendar default view for slot time format.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_slotlabelformat() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row();  
		echo json_encode($user->cal_slotlabelformat); 
	}		
	
	/**
    * get_aspectratio - calendar preference
    * This function is called to specify calendar default view for slot duration.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_aspectratio() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_aspectratio); 
	}		
	
	/**
    * get_isrtl - calendar preference
    * This function is called to specify calendar default isrtl.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_isrtl() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		echo json_encode($user->cal_isrtl); 
	}	
	
	
	/**
    * defineProperties - calendar preference
    * This function is called to specify calendar default isrtl.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function defineProperties() { 
		// check user is logged in with permissions  
		$user = $this->ion_auth->user()->row(); 
		
		
		echo json_encode($this->calendar->jsonDefineProperties($user)); 
	}
	
     /**
    * json - Generates events by users
    * This function is called to specify multiple event sources.
    ****
    * @access public
    * @ Param none
    * @return none
    */
    public function json () {  	 
	    header("Content-Type: application/json"); 		
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 
			$user = $this->ion_auth->user()->row(); 
			echo json_encode($this->calendar->jsonEvents($user)); 
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 'location', 301);
		}			
    }
 
 	/**
    * rjson - Generates categories/resources by users
    * This function is called to specify multiple event sources.
    ****
    * @access public
    * @ Param none
    * @return none
    */
    public function rjson () {  	 
	    header("Content-Type: application/json"); 		
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {  
			$user = $this->ion_auth->user()->row(); 
			echo json_encode($this->calendar->jsonResources($user)); 
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 'location', 301);
		}			
    }
	
	/**
    * Generates get events by users and category
    * This function is called to specify multiple event categories.
    ****
    * @access public
    * @ Param none
    * @return none
    */
    public function jsoncat()  {  	 
	    header("Content-Type: application/json"); 		
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 
			$user = $this->ion_auth->user()->row();	 
			$category = $this->security->xss_clean($this->input->get('category')); 
			echo json_encode($this->calendar->jsonEventsCategory($category, $user->username));
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}			
		
    }	

	/**
    * get_eventsgroups display user groups
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
	public function jsongroups()	{ 	  
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 
			$user = $this->ion_auth->user()->row();
			// parse the user group to the view
			$group = $this->input->get('group');   
            echo json_encode($this->calendar->jsonEventsGroups($group, $user));   
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}
	
    /**
    * resize
    * This function is triggered when resizing stops and the event has changed in duration.
    ****
    * @access public
    * @ Param none
    * @return none
    */
    public function resize() {
        header("Content-Type: application/json");  
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 
		
			$data = array(
				'eid'         	=>  $this->security->xss_clean($this->input->post('eid')),
				'event'         =>  $this->security->xss_clean($this->input->post('event')),
				'daystart'      =>  $this->security->xss_clean($this->input->post('daystart')),
				'dayend'        =>  $this->security->xss_clean($this->input->post('dayend')),
				'allDay'        =>  $this->security->xss_clean($this->input->post('allDay')), 
				'hash'       	=>  $this->security->xss_clean($this->input->post('hash'))
			);			
	       
  		    echo $this->calendar->resize($data);	 
		
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}		
		
		 
    }
 
  
    /**
    * drop_event
    * This function triggered when dragging stops and the event has moved to a different day/time.
    ****
    * @access public
    * @ Param none
    * @return none
    */
    public function drop_event ( )  {
        header("Content-Type: application/json");  
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 
			
			$data = array(
				'eid'         	=>  $this->security->xss_clean($this->input->post('eid')),
				'event'         =>  $this->security->xss_clean($this->input->post('event')),
				'daystart'      =>  $this->security->xss_clean($this->input->post('daystart')),
				'dayend'        =>  $this->security->xss_clean($this->input->post('dayend')),
				'allDay'        =>  $this->security->xss_clean($this->input->post('allDay')),
				'resourceId'    =>  $this->security->xss_clean($this->input->post('resourceId')), 
				'hash'       	=>  $this->security->xss_clean($this->input->post('hash'))
			);			 
	 
		  
			echo $this->calendar->drop_event($data); 
		 
		
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}			
		
		
    }
 
    /**
    * drag_event
    * This function is called when a valid jQuery UI draggable has been dropped onto the calendar.
    ****
    * @access public
    * @ Param none
    * @return none
    */
   public function drag_event ( )  {
        header("Content-Type: application/json");  
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();	
			
			$lang = $user->lang; 
			setlocale(LC_ALL, $lang); 
			
			$eventid = random_string('numeric', 8);
			$event = $this->calendar->get_eventById($eventid);  

			if(!$event){ 
				$data = array(
					'id'         =>  $this->security->xss_clean($eventid), 
					'username'   =>  $this->security->xss_clean($user->username),
					'category'   =>  $this->security->xss_clean($this->input->post('category')),
					'title'      =>  $this->security->xss_clean($this->input->post('title')),
					'description'      =>  $this->security->xss_clean($this->input->post('description')),
					'rendering'      =>  $this->security->xss_clean($this->input->post('rendering')),
					'backgroundColor'  =>  $this->security->xss_clean($this->input->post('backgroundColor')),
					'borderColor'      =>  $this->security->xss_clean($this->input->post('borderColor')),
					'textColor'        =>  $this->security->xss_clean($this->input->post('textColor')),
					'start'      =>  strftime('%Y-%m-%d %H:%M:%S', $this->languages->langtotime($this->input->post('start'), $lang)),
					'end'        =>  strftime('%Y-%m-%d %H:%M:%S', $this->languages->langtotime($this->input->post('end'), $lang)),
					'allDay'     =>  $this->security->xss_clean($this->input->post('allDay')), 
					'hash'       	=>  $this->security->xss_clean($this->input->post('hash'))
				);
				echo $this->calendar->drag_drop_event($data); 
				$this->gmaps_model->add_marker($data['category'], $data['id'], $user->username, $data['title'], "pin2.png", "", $this->setting['site_latitude'], $this->setting['site_longitude'], "", $data['description']);
			} 
		
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}			
		
		
    }

    /**
    * Deletes the event
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */ 
	public function delete_event() {
		
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);		
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
		 		 
			$username = $user->username;			
			$data["message"] = "";
			
			$config = array(
				array(
					'field' => 'ic_event_title',
					'label' => lang('calendar_modal_eventname'),
					'rules' => 'trim|xss_clean'
				),	
				array(
					'field' => 'ic_event_starttime',
					'label' => lang('calendar_modal_eventbegin'),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'ic_event_endtime',
					'label' => lang('calendar_modal_eventend'),
					'rules' => 'trim|required|xss_clean'
				),				
				array(
					'field' => 'apptID',
					'label' => lang('calendar_modal_eventname'),
					'rules' => 'trim|required|numeric|xss_clean'
				),  
				array(
					'field' => 'userfile1',
					'label' => lang('attach'),
					'rules' => 'trim'
				) 				
			);
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($config);
			
			if ($this->form_validation->run() === FALSE) { 
				
					debug('Initialize validation - loading "profile/home" fields requirement');
					$data['message'] = form_error('ic_event_title'); 
					 
			} else {		
				$eid = $this->security->xss_clean($this->input->post('eid'));   
				$event = $this->security->xss_clean($this->input->post('apptID'));    
 
			    $this->calendar->delete_event($event);	
				 
			}
			
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
    }   
	
   /**
    * Add the event
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */	
	function add_event()   { 
 
 		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
	 	  		
			$lang = $user->lang;
			$username = $user->username;
			$status = "";
			$data["message"] = "";
			
			$config = array(
				array(
					'field' => 'ic_event_title',
					'label' => lang('calendar_modal_eventname'),
					'rules' => 'trim|required|min_length[3]|max_length[90]|xss_clean'
				),
				array(
					'field' => 'ic_event_desc',
					'label' => lang('calendar_modal_description'),
					'rules' => 'trim|max_length[1000]|xss_clean'
				),
				array(
					'field' => 'marker_category',
					'label' => lang('calendar_modal_category'),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'ic_event_starttime',
					'label' => lang('calendar_modal_eventbegin'),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'ic_event_endtime',
					'label' => lang('calendar_modal_eventend'),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'ic_event_urllink',
					'label' => lang('calendar_modal_eventend'),
					'rules' => 'trim|prep_url|xss_clean'
				),
				array(
					'field' => 'ic_event_shareit',
					'label' => lang('calendar_modal_eventshare'),
					'rules' => 'trim|required|numeric|xss_clean'
				),
				array(
					'field' => 'userfile1',
					'label' => lang('attach'),
					'rules' => 'trim'
				) 				
			);
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($config);
			
			if ($this->form_validation->run() === FALSE) { 
				
				   debug('Initialize validation - loading "profile/home" fields requirement');
				   $data['message'] = form_error('ic_event_title'); 
					 
			} else {
 
				setlocale(LC_ALL, $lang);  

				$id = random_string('numeric', 9);
				$title = $this->input->post('ic_event_title'); 
				$marker_category = $this->input->post('marker_category'); 
				$backgroundColor = $this->input->post('ic_event_bgcolor');
				$borderColor = $this->input->post('ic_event_bordercolor');
				$textColor = $this->input->post('ic_event_textcolor');
				$description = $this->input->post('ic_event_desc');
				$start = strftime('%Y-%m-%d %H:%M:%S', $this->languages->langtotime($this->input->post('ic_event_starttime'), $lang));
				$end =  strftime('%Y-%m-%d %H:%M:%S', $this->languages->langtotime($this->input->post('ic_event_endtime'), $lang));
				$url = $this->input->post('ic_event_urllink');
				$allDay = $this->input->post('ic_event_allday');			
				$rendering = $this->input->post('ic_event_rendering'); 
				$recurring = $this->input->post('ic_event_recurring'); 
				$endrecurring = $this->input->post('ic_event_endrecurring'); 
				$auth = $this->input->post('ic_event_shareit');
				$overlap = $this->input->post('ic_event_eventoverlap'); 
				$location = $this->input->post('ic_event_location');
				$markers_lat = $this->input->post('markers_clat');
				$markers_lng = $this->input->post('markers_clng');
	 						
				$markers_logo = "pin2.png";
				 
				if($rendering == "background") {$allDay = "true";}
								
				$rec=(int)$recurring;  
				$rid=(int)$id;  
				
				if($endrecurring && $rec==1 || $rec==7 || $rec==14 || $rec==30 || $rec==365){ 
				   $allDay = $allDay;
				   
					$event = [
						'start' => $start,
						'end'   => $end,
						'end_date' => $endrecurring
					];
					$event_start = strtotime($event['start']);
					$event_end = strtotime($event['end']);
					$event_length = (int)$event_end-$event_start;
					$end_recurring = strtotime($event['end_date']); 
	
					$recur = $this->recurrence->periods($event_start, $end_recurring, $rec, $event_length); 
				 
					foreach ($recur as $dates) {   
					
						$recur_id = $id++; 
						$start_datetime = $dates['start'];
						$end_datetime = $dates['end']; 
						 
						$this->calendar->add_event($recur_id, $rid, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start_datetime, $end_datetime, $url, $allDay, $rendering, $overlap, $recurring, $endrecurring, $auth, $location, $markers_lat, $markers_lng, $username);
						$this->gmaps_model->add_marker($marker_category, $recur_id, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description );
					} 				 
	  
				}else{
					 
					$this->calendar->add_event($id, $rid, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $rendering, $overlap, $recurring, $endrecurring, $auth, $location, $markers_lat, $markers_lng, $username); 
					$this->gmaps_model->add_marker($marker_category, $id, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description );
 				}
			
				$file_element_name = 'userfile1'; 

				if ($status != "error" && !$this->input->post('userfile1'))   {
			   
					$config['upload_path']	= './assets/attachments/';
					$config['file_name']	= $username.'_'.$_FILES['userfile1']['name'];
					$config['allowed_types']= $this->setting['attach_allowed_extension'];  
					$config['max_size']		= $this->setting['attach_max_size'];
					$config['xss_clean']	= FALSE;
					$config['encrypt_name'] = FALSE;

					$this->upload->initialize($config);

					if (!$this->upload->do_upload($file_element_name))	{ 
						 $status = 'error';
						 $data["message"] = $this->upload->display_errors('', ''); 
					}else { 
					    debug('Initialize upload - loading "home/index" attachment upload'); 						
						$file_data = $this->upload->data();	 
						$this->calendar->attachment($id, $auth, $file_data); 
					}
					@unlink($_FILES[$file_element_name]['name']);
				}

				if($auth < "0") {$this->notify->notify_admins('notify_message', $username, lang('notify_email_public_event'));}				
	  
			}
				   

		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	  
    }
	 
    /**
    * Update the event
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */	
   function update_event() {
 
 		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
	 		
			$lang = $user->lang;
			$username = $user->username;
			$status = "";
			$data['message'] = ""; 

  
			$config = array(
				array(
					'field' => 'ic_event_title',
					'label' => lang('calendar_modal_eventname'),
					'rules' => 'trim|required|min_length[3]|max_length[90]|xss_clean'
				),
				array(
					'field' => 'ic_event_desc',
					'label' => lang('calendar_modal_description'),
					'rules' => 'trim|max_length[1000]|xss_clean'
				),
				array(
					'field' => 'ic_event_starttime',
					'label' => lang('calendar_modal_eventbegin'),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'ic_event_endtime',
					'label' => lang('calendar_modal_eventend'),
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'ic_event_urllink',
					'label' => lang('calendar_modal_eventend'),
					'rules' => 'trim|prep_url|xss_clean'
				),
				array(
					'field' => 'ic_event_shareit2',
					'label' => lang('calendar_modal_eventshare'),
					'rules' => 'trim|required|numeric|xss_clean'
				),
				array(
					'field' => 'userfile2',
					'label' => lang('attach'),
					'rules' => 'trim'
				) 
			);
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($config);
			
			if ($this->form_validation->run() === FALSE) { 
			
				debug('Initialize validation - loading "profile/home" fields requirement');
				$data['message'] = form_error('ic_event_title'); 
					 
			} else {	 
		
				setlocale(LC_ALL, $lang);   
				$id = random_string('numeric', 10);  
				$eid = $this->input->post('eid');
				$event = $this->input->post('apptID'); 
				$title = $this->input->post('ic_event_title');
				$backgroundColor = $this->input->post('ic_event_bgcolor');
				$borderColor = $this->input->post('ic_event_bordercolor');
				$textColor = $this->input->post('ic_event_textcolor');
				$description = $this->input->post('ic_event_desc'); 
				$start = strftime('%Y-%m-%d %H:%M:%S', $this->languages->langtotime($this->input->post('ic_event_starttime'), $lang));
				$end =  strftime('%Y-%m-%d %H:%M:%S', $this->languages->langtotime($this->input->post('ic_event_endtime'), $lang));
				$url = $this->input->post('ic_event_urllink');
				$allDay = $this->input->post('ic_event_allday');
				$auth = $this->input->post('ic_event_shareit2');
				$rendering = $this->input->post('ic_event_rendering');
				$overlap = $this->input->post('ic_event_eventoverlap');
				$recurring = $this->input->post('ic_event_recurring'); 
				$endrecurring = $this->input->post('ic_event_endrecurring'); 			
				$location = $this->input->post('ic_event_location');
				$markers_lat = $this->input->post('markers_ulat');
				$markers_lng = $this->input->post('markers_ulng');			
				$marker_category = $this->input->post('marker_category2');  
				$markers_logo = "pin3.png";
  
				$file_element_name = 'userfile2'; 

				if ($status != "error")   {
			   
					$config['upload_path']	= './assets/attachments/';
					$config['file_name']	= $username.'_'.$_FILES['userfile2']['name'];
					$config['allowed_types']= $this->setting['attach_allowed_extension'];  
					$config['max_size']		= $this->setting['attach_max_size'];
					$config['xss_clean']	= FALSE;
					$config['encrypt_name'] = FALSE; 

					$this->upload->initialize($config);

					if (!$this->upload->do_upload($file_element_name))	{ 
						 $status = 'error'; 
						 $data["message"] = $this->upload->display_errors('', ''); 
					}else { 
					    debug('Initialize upload - loading "home/index" attachment upload');    
						$file_data = $this->upload->data();	 
						$this->calendar->attachment($event, $auth, $file_data); 
					}
					@unlink($_FILES[$file_element_name]['name']);
				}				
				

				 
				if($rendering == "background") {$allDay = "true";}
								
				$rec=(int)$recurring;
				$rid=(int)$id;  
				
				if($endrecurring && $rec==1 || $rec==7 || $rec==14 || $rec==30 || $rec==365){
  			
				  #Fix Recurring for updates
				  $allDay = $allDay;
				   
					$event = [
						'start' => $start,
						'end'   => $end,
						'end_date' => $endrecurring
					];
					$event_start = strtotime($event['start']);
					$event_end = strtotime($event['end']);
					$event_length = (int)$event_end-$event_start;
					$end_recurring = strtotime($event['end_date']); 
	
					$recur = $this->recurrence->periods($event_start, $end_recurring, $rec, $event_length); 
				 
					foreach ($recur as $dates) {   
					
						$recur_id = $id++; 
						$start_datetime = $dates['start'];
						$end_datetime = $dates['end']; 
						 
						$this->calendar->add_event($recur_id, $rid, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start_datetime, $end_datetime, $url, $allDay, $rendering, $overlap, $recurring, $endrecurring, $auth, $location, $markers_lat, $markers_lng, $username);
						$this->gmaps_model->add_marker($marker_category, $recur_id, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description );
					} 				
				
				
				
				
					if ($this->calendar->get_eventByEid($eid)){

						$this->calendar->update_events($eid, $event, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $rendering, $overlap, $location, $markers_lat, $markers_lng, $username);  
					
					
					
					
					
					}else{
						$this->calendar->add_event($id, $rid, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $rendering, $overlap, $recurring, $endrecurring, $auth, $location, $markers_lat, $markers_lng, $username);
					}	 
			 
				 
					if ($this->gmaps_model->get_markersById($event)){
						$this->gmaps_model->update_marker($marker_category, $event, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description);
					}else {
					   if ($this->calendar->get_eventById($event)){
							$this->gmaps_model->add_marker($marker_category, $event, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description );
						}
					}				
 						
					
				}else{
					 
					 if ($this->calendar->get_eventById($event)){
						$this->calendar->update_event($event, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $rendering, $overlap, $location, $markers_lat, $markers_lng, $username);
					 }else{
						$this->calendar->add_event($id, $rid, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $rendering, $overlap, $recurring, $endrecurring, $auth, $location, $markers_lat, $markers_lng, $username);
					 }	
						if ($this->gmaps_model->get_markersById($event)){
							$this->gmaps_model->update_marker($marker_category, $event, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description);
						}else {
						   if ($this->calendar->get_eventById($event)){
								$this->gmaps_model->add_marker($marker_category, $event, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description );
							}
						}	 	
				}			 

				if($auth < "0") {$this->notify->notify_admins('notify_message', $username, lang('notify_email_public_event'));}
			}	
	
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	  
	}
	

}

/* End of file home.php (cifullcalendar) */
/* Location: ./application/controllers/profile/home.php */