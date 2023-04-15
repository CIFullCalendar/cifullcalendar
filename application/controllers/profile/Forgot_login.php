<?php

/**
 * Page controller class
 *
 * Displays forgot login page
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/profile/forgot_login
 */  
class Forgot_login extends CI_Controller {

    /*
     * Forgot_login controller class constructor
     */ 
	public function __construct() {
	 parent::__construct();				
	 $this->load->model('Member_model'); 
		 
	 $this->load->helper('string'); 
	 $this->load->helper('security');
	 $this->load->helper('form');
	 $this->load->helper('url'); 
	 $this->load->helper('email'); 
	
	 $this->load->library('ion_auth');
	 $this->load->library('Languages');
	 $this->load->library('form_validation');		
	 $this->load->library('email');

	 // load all settings into an array
	 $this->setting = $this->Setting_model->getEverySetting();
    }

    /*
     * index function (default)
     *
     * display forgot login form
     */ 
    function index() {
		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('recover_password');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 		
		
		$data['message'] = "";
		$identity_column = "";
		$identity_error = "";
		
		if ($this->ion_auth->logged_in()) {
			redirect("profile", 'location', 301);
		}
		
			// set up form validation config 
			$config = array(
				array(
				'field' => 'identity',
				'label' => lang('forgot_login_identity'),
				'rules' => 'trim|required|xss_clean'
				)
			);
			
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($config);
			 
			// validate the form data
			if ($this->form_validation->run() === FALSE) {
				// validation failed - reload page with error message(s) 
				debug('validation failed - loading "forgot_login/forgot_login" view');
				$data['message'] = '<span class="badge badge-warning">'.(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))).'</div>';	
				$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/login/forgot_login', 'nav_content' => $this->setting['current_theme'] . '/frontend/login/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/login/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/login/footer');
				$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data);
				
			} else { 
				
				$identity = $this->input->post('identity');
				 
				$identity_column = (valid_email($identity)) ? $this->config->item('identity','ion_auth') : "username";
				$identify = $this->ion_auth->where($identity_column, $identity)->users()->row(); 

				if(empty($identify)) { 
				 			
					$identity_error = lang('forgot_login_identity_not_found');
					$data['message'] = '<span class="badge badge-warning">' . $this->session->set_flashdata('message', $identity_error) . '</div>';
					redirect("profile/forgot_login", 'location', 301); //we should display a confirmation page here instead of the login page				
				 
				}else{
					// run the forgotten password method to email an activation code to the user
					$forgotten = $this->ion_auth->forgotten_password($identify->{$identity_column});
					 
					if ($forgotten) { 	 
						// if there were no errors
						$data['message'] = $this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("profile/login", 'location', 301); //we should display a confirmation page here instead of the login page 
					
					}else {
						$data['message'] = '<span class="badge badge-warning">' . $this->session->set_flashdata('message', $this->ion_auth->errors()) . '</div>';
						$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/login/forgot_login', 'nav_content' => $this->setting['current_theme'] . '/frontend/login/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/login/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/login/footer');
						$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data);
					}	 
					
				} 
	 
			} 
			
    }

}

/* End of file forgot_login.php */
/* Location: ./application/controllers/profile/forgot_login.php */