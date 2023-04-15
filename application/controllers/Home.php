<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home controller class
 *
 * Displays Home page
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/home
 */ 
 
class Home extends CI_Controller {

    /*
     * Home controller class constructor
     */

   public function __construct() {
	 parent::__construct();
	 $this->load->model('Fullcalendar_model','calendar');
	 $this->load->model('Member_model');  
	 $this->load->model('Page_model');  
	
	 $this->load->helper('directory');
	 $this->load->helper('date');	 
	 $this->load->helper('url');	 
	 $this->load->helper('form');	
	 $this->load->helper('security');

	 $this->load->library('ion_auth'); 
	 $this->load->library('Languages');	
 	 $this->load->library('form_validation');
	
	 // load all settings into an array
	 $this->setting = $this->Setting_model->getEverySetting();
	//$this->output->enable_profiler(TRUE);
    }

    /*
     * index function
     *
     * displays the site home page
     */

    function index() {
	  
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = $this->setting['site_name'];
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['key'] = $this->setting['cal_apikey'];
		$data['current_version'] = config_item('version');
		
		$data['timezone'] = $this->setting['site_timezone'];  		 
						 
		// check if the user is logged in 
	    if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
	     
			$data['userinfo'] = $this->Member_model->getUserById($user->id);
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
		}		
		
		$data['pagename'] = $this->Page_model->getAllPublicPages(4, $this->uri->segment(4));
		
		debug('Initialize index - loading "home/index" view');
		$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/home/index', 'nav_content' => $this->setting['current_theme'] . '/frontend/home/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/home/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/home/footer');
		$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data);
 
    }
	
    /**
    * view - query events by title
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
    function view($username) {
	  
		debug('home page | view function');	
		// set the page title, meta keywords and meta description 
		$data['page_title'] = $this->setting['site_name'] . ' - ' . $username;
		$data['site_name'] = $this->setting['site_name'];
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['key'] = $this->setting['cal_apikey'];
		$data['current_version'] = config_item('version');
 
		$data['timezone'] = $this->setting['site_timezone'];	
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['userinfo'] = $this->Member_model->getUserByUsername($username);
		$data['allevents'] = $this->calendar->countEventsByUsername($username);
		
	    if ($data['userinfo']) {
	    //load the data and shown

			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
		
		debug('Initialize index - loading "user/index" view');
		$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/user/index', 'nav_content' => $this->setting['current_theme'] . '/frontend/user/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/user/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/user/footer');
		$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);			

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
		$data['current_version'] = config_item('version');
	  
		debug('Initialize export - loading "home/index" ics export'); 
		$filename = "visitor_export_". now() .".ics";
		header("Content-type:text/calendar");
		header("Content-Disposition: attachment; filename=$filename");  
		
		$timezone = $this->setting['site_timezone']; 
		echo $this->calendar->export("", $id, $timezone, $data['lang']); 
	
	}
	
    /**
    * Search - query events by title
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function search() {
	
		header("Content-Type: application/json");   
	 
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('title','title','trim|min_length[3]|max_length[90]|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {  
			$title = $this->security->xss_clean($this->input->get('title')); 
			echo $this->calendar->search($title);
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
	
		debug('Initialize lang - loading "home/lang" get language');  
		
		$lang = $this->setting['site_language'];	
		
		echo json_encode($lang);
	}	

	/**
    * get_timezone events and shows
    * This function convert string tz to time-zone date
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_timezone() {
	 		
		$datetime = new DateTime('now', new DateTimeZone($this->setting['site_timezone']));
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
    * get_hiddendays - calendar preference
    * This function is called from calendar.custom.js
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
    * @ Param none
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
		// check user is logged in with permissions  
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
    * get_slotduration - calendar preference
    * This function is called to specify calendar default view for slot duration.
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_slotduration() { 
	
		$alldayslot = $this->setting['cal_slotduration'];  
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
    * Generates frontend public events
    * This function is called from calendar.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
	function json (){  	  
	    header("Content-Type: application/json"); 	 
        echo json_encode($this->calendar->jsonPublicEvents());
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
		echo json_encode($this->calendar->jsonPublicResources());  
    }
	
     /**
    * Generates user unique url public events
    * This function is called from calendar.user.custom.js
    ****
    * @access public
    * @ Param none
    * @return none
    */
	function ujson ($username){  	 
	    header('Access-Control-Allow-Origin: *'); 
	    header("Content-Type: application/json");  
        echo json_encode($this->calendar->jsonUserPublicEvents($username));
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */