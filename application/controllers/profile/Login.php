<?php

/**
 * Login controller class
 *
 * Displays login page
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/profile/login
 */
 class Login extends CI_Controller {

    /*
     * Login controller class constructor

     */
	public function __construct() {
	parent::__construct();  
	$this->load->helper('date');
	$this->load->helper('security');  
	
	$this->load->library('ion_auth');
	$this->load->library('Languages');
	$this->load->library('form_validation');  
	// load all settings into an array 
	$this->setting = $this->Setting_model->getEverySetting();
    }

    /*
     * index function (default)
     *
     * display login form
     */ 
	function index()	{
		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('profile_login');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];  
 
		$data['message'] = '';		
		  
		$config = array(
			array(
			'field' => 'login_username',
			'label' => lang('username'),
			'rules' => 'trim|required|min_length[4]|max_length[95]|xss_clean'
			),
			array(
			'field' => 'login_password',
			'label' => lang('password'),
			'rules' => 'trim|required|min_length[6]|xss_clean'
			)
		);
				
		//validate form input
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth')); 
		$this->form_validation->set_rules($config); 

		if ($this->form_validation->run() == true) {
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('login_username'), $this->input->post('login_password'), $remember)) { 
				//redirect to the home page
				$last_page = $this->session->userdata('last_page'); 
				$this->session->set_flashdata('message', $this->ion_auth->messages()); 
					// clear 'last_page' session variable
				if (!empty($last_page) || $last_page != "logout") {
					// if a url was stored, redirect to it now
					debug('Initialize login - loading "profile/login" redirect user to previously visited page... '.$last_page);
					redirect($last_page, 'location', 301);   
				}
				// no stored url so redirect to profile page  
				redirect('profile', 'location', 301);   
			
			}else{ 
				
				// log in failed, reload page with message	 	 
				$data['message'] = '<div class="m-alert m-alert--outline alert alert-warning alert-dismissible" role="alert" >'.lang('profile_login_auth_fail').'<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button><span></span></div>';		
				$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/login/user', 'nav_content' => $this->setting['current_theme'] . '/frontend/login/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/login/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/login/footer');
				$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data);	
					 
			}
		} else 	{
			
			if ($this->ion_auth->logged_in()) {redirect('calendar', 301);}
			// log in failed, reload page with message	
			debug('Initialize login - loading "profile/login" log in failed ');	 
			$data['message']= '<div class="m-alert m-alert--outline alert alert-warning alert-dismissible" role="alert" >'.(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))).'<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button><span></span></div>';	
			$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/login/user', 'nav_content' => $this->setting['current_theme'] . '/frontend/login/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/login/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/login/footer');
			$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data);	
		}
	}
 
}

/* End of file login.php */
/* Location: ./application/controllers/profile/login.php */