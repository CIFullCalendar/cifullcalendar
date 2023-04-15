<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Register controller class
 *
 * Displays the Register page
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/register
 */
 
class Register extends CI_Controller {

    /*
     * User controller class constructor
     */

    public function __construct() {
		parent::__construct();
		$this->load->model('Member_model');
		$this->load->model('Notification_model');
		
		$this->load->helper('captcha');
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->helper('security');  
		
		$this->load->library('ion_auth'); 
		$this->load->library('Languages');
		$this->load->library('form_validation');
		$this->load->library('Notify'); 
		// load all settings into an array
		$this->setting = $this->Setting_model->getEverySetting();
    }

    /*
     * register function
     *
     * display 'profile/register' view, validate form data and add new user to the database
     */
 
	function index() {
		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('register');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = config_item('version');
		
		$data['keywords'] = '';
		$data['error_message'] = '';
		$data['message'] = '';
		
		$tables = $this->config->item('tables','ion_auth');
		
		// set up config for captcha images
		$vals = array(
			'img_path' => './assets/captcha/',
			'img_url' => base_url() . 'assets/captcha/'
		); 
		
		$cinfo = create_captcha($vals);	
		$expiration = 100;  //update expiration time if new members require more time to validate
		$data['captcha_image'] = $this->Member_model->captchaImage($cinfo, $expiration);		
		$data['vcaptcha'] = $this->setting['captcha_verification']; 		

        if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 
			redirect("profile", 'refresh');
        } 
		
		// check form data was submitted
		if ($this->input->post('user_submit')) {
			// set up form validation config 		
			$config = array(
			array(
				'field' => 'identity',
				'label' => lang('profile_register_uname'),
				'rules' => 'trim|required|min_length[4]|max_length[95]|is_unique[' . $tables['users'] . '.username]|xss_clean'
			),
			array(
				'field' => 'password',
				'label' => lang('profile_register_password'),
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]'
			),
			array(
				'field' => 'password_confirm',
				'label' => lang('profile_register_password'),
				'rules' => 'trim|required|matches[password]'
			),			
			array(
				'field' => 'email',
				'label' => lang('profile_register_email'),
				'rules' => 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]|xss_clean'
			),			
			array(
				'field' => 'phone',
				'label' => lang('profile_register_phone'),
				'rules' => 'trim|numeric|min_length[7]|max_length[15]|xss_clean'
			),
			array(
				'field' => 'captcha',
				'label' => lang('profile_register_captcha'),
				'rules' => 'trim|xss_clean'
			) 
			);
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($config);
			
			// validate the form data
			if ($this->form_validation->run() === FALSE) {
				debug('Initialize form - loading "register/index" validation unsuccessful');			
				// validation failed - reload user with error message(s)
				$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))); 
				$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/register/index', 'nav_content' => $this->setting['current_theme'] . '/frontend/register/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/register/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/register/footer');
				$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data); 				
				
			} else { 
				// prepare data for adding to database	  
				$image = "default.png";  
				$identity = $this->input->post('identity');
				$email    = strtolower($this->input->post('email')); 
				$password = $this->input->post('password');  
				$additional_data = array( 
					'phone'      => $this->input->post('phone'),
				); 
				$captcha = $this->input->post('captcha');
				$captcha_success = $this->Member_model->captchaVerify($captcha, $expiration);
		 
				if ($captcha_success !== FALSE){  
					if ($this->ion_auth->register($identity, $password, $email, $additional_data)){  
						debug('Initialize form - loading "register/index" successful registration view'); 
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("profile", 'location', 301);
					}else{
						debug('Initialize form - loading "register/index" unsuccessful registration view');
						$this->session->set_flashdata('message', $this->ion_auth->errors()); 
						redirect('profile/login', 301);
					} 	 
				}else if (($data['vcaptcha'] == 0) && $captcha_success == FALSE){  
				
					if ($this->ion_auth->register($identity, $password, $email, $additional_data)){  
						debug('Initialize form - loading "register/index" successful registration view'); 
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("profile", 'location', 301);
					}else{
						debug('Initialize form - loading "register/index" unsuccessful registration view');
						$this->session->set_flashdata('message', $this->ion_auth->errors()); 
						redirect('profile/login', 301);
					} 
				}else{
				  
					debug('Initialize form - loading "register/index" unsuccessful captcha');
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : lang('error_captcha'))); 
					$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/register/index', 'nav_content' => $this->setting['current_theme'] . '/frontend/register/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/register/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/register/footer');
					$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data); 				
				}

			}
	 
		} else {
			// form was not submitted so just show the form
			debug('Initialize form - loading "register/index" default view');
		    (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/register/index', 'nav_content' => $this->setting['current_theme'] . '/frontend/register/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/register/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/register/footer');
			$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data);
			
		}	
      
    }
	
    /*
     * activate function
     *
     * activate the new user to the database
     */	 
	function activate($id, $code=false)	{
		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('register');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = config_item('version');
		
		$data['keywords'] = '';
		$data['error_message'] = '';
		$data['message'] = '';
        $activation = '';

		// set up config for captcha images
		$vals = array(
			'img_path' => './assets/captcha/',
			'img_url' => base_url() . 'assets/captcha/'
		); 
		
		$cinfo = create_captcha($vals);	
		$expiration = 300;  
		$data['captcha_image'] = $this->Member_model->captchaImage($cinfo, $expiration);		
		$data['vcaptcha'] = $this->setting['captcha_verification']; 		

        if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 
			redirect("profile", 'location', 301);
        } 		
		
		if ($code !== false){
			
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation){
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			$data['message'] = '<span class="badge badge-info">'.$this->ion_auth->messages().'</div>';    
			$sections = array('body_content' => $this->setting['current_theme'] . '/backend/login/user', 'nav_content' => $this->setting['current_theme'] . '/backend/login/nav', 'header_content' => $this->setting['current_theme'] . '/backend/login/header', 'footer_content' => $this->setting['current_theme'] . '/backend/login/footer');
			$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);	
		}
		else{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			$data['message'] = '<span class="badge badge-info">'.$this->ion_auth->errors().'</div>';    
			$sections = array('body_content' => $this->setting['current_theme'] . '/backend/login/forgot_login', 'nav_content' => $this->setting['current_theme'] . '/backend/login/nav', 'header_content' => $this->setting['current_theme'] . '/backend/login/header', 'footer_content' => $this->setting['current_theme'] . '/backend/login/footer');
			$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
		}
	}		
	
	    
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */