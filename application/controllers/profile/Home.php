<?php
/**
 * User controller class
 *
 * Displays edit profile user page
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/profile/user/name/
 */ 
class Home extends CI_Controller {

    /*
     * User controller class constructor
     */
	public function __construct() {
		parent::__construct();
		$this->load->model('Member_model');
		$this->load->model('Gmaps_model');
		$this->load->model('Fullcalendar_model');
		$this->load->model('Category_model');
		$this->load->model('Eventsources_model');
		$this->load->model('Page_model');
		
		$this->load->helper('string');
		$this->load->helper('date');	 
		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->helper('url'); 
		
		$this->load->library('ion_auth');
		$this->load->library('Languages');
		$this->load->library('form_validation');	 
		$this->load->library('upload');
		$this->load->library('image_lib'); 
		$this->load->library('Notify');
		// load all settings into an array
		$this->setting = $this->Setting_model->getEverySetting();
    }
  
     /*
     * index - user function
     *
     * display 'profile/user' view
     */ 
	function index(){
	  
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('user');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];   
		
		$data['message'] = ""; 
		
		// check if user is logged in
	    if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
		   
			// pass the user to the view   
			$data['user'] = $user;
			$data['groups'] = $this->ion_auth->groups()->result_array();
			$data['currentGroups'] = $this->ion_auth->get_users_groups($user->id)->result();  	
			$data['userinfo'] = $this->Member_model->getUserById($user->id);				
			$data['pagename'] = $this->Page_model->getAllMembersPages(4, $this->uri->segment(4)); 
	 
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}				 
			 
			debug('Initialize index - loading "user/index" view');
			$sections = array('body_content' => $this->setting['current_theme'] . '/backend/user/index', 'nav_content' => $this->setting['current_theme'] . '/backend/user/nav', 'header_content' => $this->setting['current_theme'] . '/backend/user/header', 'footer_content' => $this->setting['current_theme'] . '/backend/user/footer');
			$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);	
		
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301);   

		} 						
    }
   
  
  
}

/* End of file home.php */
/* Location: ./application/controllers/profile/home.php */