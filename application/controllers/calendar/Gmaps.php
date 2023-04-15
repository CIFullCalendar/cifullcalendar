<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 /**
 * Home controller class
 *
 * Displays user event locations on google map
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/gmaps
 */
class Gmaps extends CI_Controller {
 
	/*
     *  Controller class constructor
    */
	public function __construct() {
	parent::__construct(); 
	$this->load->model('gmaps_model');	
	$this->load->model('category_model');	
	$this->load->model('Member_model'); 
	$this->load->model('Page_model'); 
	
	$this->load->helper('date');	 
	$this->load->helper('security');
	$this->load->helper('form');
	$this->load->helper('url'); 
	
	$this->load->library('ion_auth'); 
	$this->load->library('Languages');
	$this->load->library('form_validation');  
	// load all settings into an array
	$this->setting = $this->Setting_model->getEverySetting();
    }
	
    /**
    * Display template
    * This function displays the gmaps 
    ****
    * @access public/private
    * @ Param none
    * @return none
    */	
	public function index()	{
	
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('locations_all_heading');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['key'] = $this->setting['cal_apikey'];
		$data['current_version'] = config_item('version');
 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 	
		
			$user = $this->ion_auth->user()->row();
		 	
			//load the data and shown 
			$data['userinfo'] = $this->Member_model->getUserById($user->id); 
			$data['pagename'] = $this->Page_model->getAllMembersPages(4, $this->uri->segment(4));
			 
				// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists($data['userinfo']->image, $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url() . 'assets/img/profile/' . $data['userinfo']->image;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = './assets/img/profile/default.png';
			}		
			 
			debug('Initialize index - loading "gmaps/index" view');
			$sections = array('body_content' => $this->setting['current_theme'] . '/backend/gmaps/index', 'nav_content' => $this->setting['current_theme'] . '/backend/gmaps/nav', 'header_content' => $this->setting['current_theme'] . '/backend/gmaps/header', 'footer_content' => $this->setting['current_theme'] . '/backend/gmaps/footer');
			$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
		
		}else{
		 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	 
	}
	
    /**
    * get_marker - get the events latitude and longitude and display accurate location
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */	
	public function get_marker() {		
				
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 	
		
			$user = $this->ion_auth->user()->row();
			 
			$category = $this->security->xss_clean($this->input->get('category'));
			$marker = $this->gmaps_model->get($category, $user->username);;
			
			echo json_encode($marker);
		}else{
		 	// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}

	/**
    * get_category - display all categories related to each events.
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */	
	public function get_category()	{
		
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 	
		
			$user = $this->ion_auth->user()->row();
			
			$category = $this->gmaps_model->category($user->username);		
			echo json_encode($category);
		}else{
		 	// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}
}

/* End of file gmaps.php */
/* Location: ./application/controllers/gmaps.php */