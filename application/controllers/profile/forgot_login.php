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

    function Forgot_login() {
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
		
		$data['message'] = '';
		 
		
	    // check form was submitted
	    if ($this->input->post('login_forgot_submit')) {
			// set up form validation config 
			$config = array(
				array(
				'field' => 'identity', 
				'rules' => 'trim|required|xss_clean'
				)
			);
			
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($config);
			 
			// validate the form data
			if ($this->form_validation->run() === FALSE) {
				// validation failed - reload page with error message(s) 
				debug('validation failed - loading "forgot_login/forgot_login" view');
				$data['message'] = '<span class="badge badge-warning">' . (validation_errors()) ? validation_errors() : $this->session->flashdata('message'). '</div>';   
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/login/forgot_login', 'nav_content' => $this->setting['current_theme'] . '/backend/login/nav', 'header_content' => $this->setting['current_theme'] . '/backend/login/header', 'footer_content' => $this->setting['current_theme'] . '/backend/login/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
			} else { 
			
				$identity_column = valid_email($this->input->post('identity')) ? $this->config->item('identity','ion_auth') : 'username';
				$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row(); 

				if(empty($identity)) {

					if($identity_column != 'email')
					{
						$this->ion_auth->set_error('forgot_login_email');
					}
					else
					{
					   $this->ion_auth->set_error('forgot_password_email_not_found');
					}

					$data['message'] = $this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect("profile/forgot_login", 'refresh');
				}
				
				// run the forgotten password method to email an activation code to the user
				$forgotten = $this->ion_auth->forgotten_password($identity->{$identity_column});

				if ($forgotten)
				{
				// if there were no errors
				$data['message'] = $this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("profile/login", 'refresh'); //we should display a confirmation page here instead of the login page
				}
				else
				{
				$data['message'] = $this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("profile/forgot_login", 'refresh');
				}		 
	 
			}
	    } else {
		
			debug('Initialize email - loading "profile/forgot_login" form not submitted');
			$sections = array('body_content' => $this->setting['current_theme'] . '/backend/login/forgot_login', 'nav_content' => $this->setting['current_theme'] . '/backend/login/nav', 'header_content' => $this->setting['current_theme'] . '/backend/login/header', 'footer_content' => $this->setting['current_theme'] . '/backend/login/footer');
			$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			
	    }
 
    }

}

/* End of file forgot_login.php */
/* Location: ./application/controllers/profile/forgot_login.php */