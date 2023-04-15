<?php defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * Home controller class
 *
 * Displays the admin dashboard
 *
 * @package		cifullcalendar+
 * @category    Controller
 * @author		sirdre
 * @link		index.php/home
 */  
 
class Home extends CI_Controller {

    /*
     * Home controller class constructor
     */

	public function __construct() {
	parent::__construct();  
	$this->load->model('Member_model');
	$this->load->model('Member_admin_model');
	$this->load->model('Fullcalendar_admin_model','calendar');
	$this->load->model('gmaps_model');		
	$this->load->model('Eventsources_model'); 
	$this->load->model('Page_model');
	
	$this->load->helper('date');	 
	$this->load->helper('security');
	$this->load->helper('form');
	$this->load->helper('url'); 
	
	$this->load->library('ion_auth');
	$this->load->library('Languages');
	$this->load->library('form_validation');  
	$this->load->library('Icalendar');  
	$this->load->library('upload');
	$this->load->library('image_lib');
	
	// load all settings into an array
	$this->setting = $this->Setting_model->getEverySetting();
    }

    /*
     * index function (default)
     *
     * display manager home page
     */

    function index() { 
	 
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('dashboard');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['key'] = $this->setting['cal_apikey'];
		$data['current_version'] = config_item('version');
		
		// check if the user is logged in 
	    if ($this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
			 
			$data['userinfo'] = $this->Member_model->getUserById($user->id);
	
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
			
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();
			
			// load a page of custom pages into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(4));				
			$data['users_list'] = $this->Member_admin_model->getAllUsers(0); 
			$data['attempts'] = $this->Member_admin_model->get_login_attempts(0);  
	 
			// display home page
			debug('Initialize index - loading "admin/index" view');
			$sections = array('body_content' => $this->setting['current_theme'] . '/backend/admin/index', 'nav_content' => $this->setting['current_theme'] . '/backend/admin/nav', 'header_content' => $this->setting['current_theme'] . '/backend/admin/header', 'footer_content' => $this->setting['current_theme'] . '/backend/admin/footer');
			$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
  
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301); 
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
		if ($this->ion_auth->is_admin()) {
			$category = $this->security->xss_clean($this->input->get('category'));
			$marker = $this->gmaps_model->get_all($category); 
			echo json_encode($marker); 
		} else { 
			redirect('/admin/login', 301); 
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
	
		// check if the user is logged in 
	    if ($this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();  
			$category = $this->gmaps_model->category($user->username);
			
			echo json_encode($category);
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301); 
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
		
		// check if the user is logged in 
	    if ($this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();   
			$category = $this->Eventsources_model->getSourceList(20,0,$user->username);
			
			echo json_encode($category);
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301); 
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
	public function search() { 
		// check if the user is logged in 
	    if ($this->ion_auth->is_admin()) { 
			$user = $this->ion_auth->user()->row();	 
			$title = $this->security->xss_clean($this->input->get('title'));  
			echo $this->calendar->search_admin($title, $user->username); 
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301); 
		} 	
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
		$lang = $this->setting['site_language'];	 
		echo json_encode($lang); 
	}     
	
	/**
    * get_timezone get timezone timedate format
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_timezone() { 
		// check if the user is logged in 
	    if ($this->ion_auth->is_admin()) { 
			$datetime = new DateTime('now', new DateTimeZone($this->setting['site_timezone']));
			$datetime_string = $datetime->format('c');  
			echo json_encode($datetime_string);
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301); 
		} 
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
			$datetime_string = $this->setting['site_timezone']; 
			echo json_encode($datetime_string);
	 
	}	
	/**
    * get_defaultview events and shows
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_defaultview() {  
			$defaultview = $this->setting['cal_defaultview'];  
			echo json_encode($defaultview); 
	}	
	
	/**
    * get_header_left - headers buttons
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_header_left() { 
 		
			$header_left = $this->setting['cal_header_left'];  
			echo json_encode($header_left);
	 
	}
	
	/**
    * get_header_center - headers buttons
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_header_center() { 
 		
			$header_center = $this->setting['cal_header_center'];  
			echo json_encode($header_center);
 
	}	
	
	/**
    * get_header_center - headers buttons
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_header_right() { 
 	
			$header_right = $this->setting['cal_header_right']; 
			echo json_encode($header_right); 
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
		$firstday = $this->setting['cal_firstday'];  
		echo json_encode($firstday); 
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
		$cal_mintime = $this->setting['cal_mintime'];
		echo json_encode($cal_mintime); 
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
		$cal_maxtime = $this->setting['cal_maxtime'];  
		echo json_encode($cal_maxtime); 
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
		$aspectratio = $this->setting['cal_aspectratio'];	 
		echo json_encode($aspectratio);  
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
    * get_hiddenDays - calendar preference
    * This function is called to specify calendar default hiddenDays.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_hiddendays() {  
		$hiddendays = $this->setting['cal_hiddendays']; 
		echo json_encode($hiddendays); 
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
		$businessstart = $this->setting['cal_businessstart'];  
		echo json_encode($businessstart); 
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
		$businessend = $this->setting['cal_businessend'];  
		echo json_encode($businessend); 
	}		
	
	/**
    * get_businessdays - calendar preference
    * This function is called to specify calendar default hiddenDays.
    ****
    * @access public
    * @Param none
    * @return none
    */
 	public function get_businessdays() {  
		$businessdays = $this->setting['cal_businessdays'];  
		echo json_encode($businessdays); 
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
		$weeknumberswithindays = $this->setting['cal_weeknumberswithindays'];
		echo json_encode($weeknumberswithindays); 
	}	
	 
	/**
    * get_weeknumbers - calendar preference
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_weeknumbers() {  
		$weeknumbers = $this->setting['cal_weeknumbers']; 
		echo json_encode($weeknumbers); 
	}	
	
	/**
    * get_eventlimit - calendar preference
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_eventlimit() {   
		$eventlimit = $this->setting['cal_eventlimit'];  
		echo json_encode($eventlimit); 
	}
		
	/**
    * get_alldayslot - calendar preference
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_alldayslot() {   
		$alldayslot = $this->setting['cal_alldayslot']; 
		echo json_encode($alldayslot); 
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
		$slotlabeling = $this->setting['cal_slotlabeling'];	 
		echo json_encode($slotlabeling); 
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
		$slotformat = $this->setting['cal_slotlabelformat'];	 
		echo json_encode($slotformat); 
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
		$slotduration = $this->setting['cal_slotduration'];	 
		echo json_encode($slotduration); 
	}
	
	/**
    * get_isrtl - calendar preference
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_isrtl() {  
		$isrtl = $this->setting['cal_isrtl'];  
		echo json_encode($isrtl); 
	}		
	
     /**
    * Generates events by users
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
    public function json () {  	  
	    header("Content-Type: application/json"); 		
		// check if the user is logged in 
	    if ($this->ion_auth->is_admin()) { 
			$user = $this->ion_auth->user()->row();		 
			echo json_encode($this->calendar->jsonEvents($user->username));
			
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301); 
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
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
    public function jsoncat ( )  {  	 	
	    header("Content-Type: application/json"); 		
		// check if the user is logged in 
	    if ($this->ion_auth->is_admin()) { 
			$user = $this->ion_auth->user()->row();		  
			$category = $this->security->xss_clean($this->input->get('category')); 
			echo json_encode($this->calendar->jsonEventsCategory($category, $user->username));
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301); 
		}
    }
  

}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */