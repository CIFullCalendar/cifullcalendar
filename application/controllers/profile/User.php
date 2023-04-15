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
class User extends CI_Controller {

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
   
   /**
    * edit - the event category in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */	
    function edit() { 
	
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
			 
			$tables = $this->config->item('tables','ion_auth');
			$data['upload_error'] = '';			
			$orig_file_name = '';
			$logo_path = 'assets/img/profile';
		  
						
				// set up form validation config
				$config = array( 
					array(
						'field' => 'fname',
						'label' => lang('profile_edit_fname'),
						'rules' => 'trim|required|min_length[2]|xss_clean'
					),
					array(
						'field' => 'lname',
						'label' => lang('profile_edit_lname'),
						'rules' => 'trim|required|min_length[2]|xss_clean'
					),
					array(
						'field' => 'address',
						'label' => lang('admin_table_address'),
						'rules' => 'trim|required|min_length[3]|max_length[150]|xss_clean'
					),						
					array(
						'field' => 'company',
						'label' => lang('profile_edit_company'),
						'rules' => 'trim|min_length[2]|xss_clean'
					),
					array(
						'field' => 'phone',
						'label' => lang('profile_edit_phone'),
						'rules' => 'trim|numeric|min_length[7]|max_length[15]|xss_clean'
					),
					array(
						'field' => 'email',
						'label' => lang('profile_edit_email'),
						'rules' => 'trim|required|valid_email|xss_clean'
					) 
				);
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
				 
				// validate the form data
				if ($this->form_validation->run() === FALSE) {
					 
					// validation failed - reload user with error message(s) 
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/user/index', 'nav_content' => $this->setting['current_theme'] . '/backend/user/nav', 'header_content' => $this->setting['current_theme'] . '/backend/user/header', 'footer_content' => $this->setting['current_theme'] . '/backend/user/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);	
					
				} else { 
				  
					// prepare data for adding to database 
					$data = array(
						'first_name' => $this->input->post('fname'),
						'last_name'  => $this->input->post('lname'),
						'address'    => $this->input->post('address'),
						'company'    => $this->input->post('company'),
						'phone'      => $this->input->post('phone'),
					);						 
							  
					// update the password if it was posted
					if ($user->email !== $this->input->post('email'))
					{
							// store a temporary key in the user record
							$temporary_key = $this->ion_auth->change_email_code($user->email);
							$keycode = site_url('profile/user/change_email/'.urlencode($this->input->post('email')).'/'.urlencode($temporary_key));
							// create the email message 
							$this->notify->notify_change_email_confirm('change_email', $user->email, $this->input->post('email'), $keycode);   
							
							$this->ion_auth->logout();
					}					
			 
					if (!empty($_FILES['userfile']['name'])) {
						$this->form_validation->set_error_delimiters('', '');
						// set up config for logo upload
						$config['upload_path'] = $logo_path;
						$config['allowed_types'] = $this->setting['profile_allowed_extensions'];
						$config['max_size'] = $this->setting['profile_max_upload_filesize'];
						$config['max_width'] = $this->setting['profile_max_upload_width'];
						$config['max_height'] = $this->setting['profile_max_upload_height'];
						$config['remove_spaces'] = TRUE;
						
						// store the file name and extension
						$extension = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
						$file_name = str_replace(' ', '_', $_FILES['userfile']['name']);
						$file_name = substr($file_name,0,strlen($file_name)-strlen($extension)-1);
						$file_name = str_replace('.', '_', $_FILES['userfile']['name']);
						
						// create a random number to append to the file name 
						$config['file_name'] = $file_name . '_' . random_string('numeric', 8) . '.' . $extension; 
						
						debug('Initialize upload - loading "profile/home" profile picture requirement');
						// initialize the library with config data
						$this->upload->initialize($config);
							 
							// attempt to upload the file					
						if (!$this->upload->do_upload()) {
							
							debug('Initialize upload - loading "profile/home" upload fail');
							$file_data = array('upload_data' => $this->upload->data());
							$mimetype= $file_data['upload_data']['file_type'];
							// if there was an error uploading, set the error message
							debug('there was a file uploading error... ' . $this->upload->display_errors()); 
							$data['message'] = $this->upload->display_errors();  
						} else {
							// upload successful 
							$data['message'] = array('upload_data' => $this->upload->data());
							// create a thumbnail image for displaying on theme settings page
							// this also includes a check that a valid image file was uploaded
							// set up config for image resizing
							$rename_file_name = $config['file_name'];
							$config['image_library'] = 'gd2';
							$config['source_image'] = $logo_path . $rename_file_name;
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 200;
							$config['height'] = 200;
							
							// initialize image library with config data
							$this->image_lib->initialize($config); 
							// update the user 
							if(!empty($rename_file_name)) {
								debug('file upload completed successfully');
								$this->Member_model->updateImage($user->id, $rename_file_name);
							}

						}
					}						
					
					// Only allow updating groups if user is admin
					if ($this->ion_auth->is_admin())
					{
						//Update the groups user belongs to
						$groupData = $this->input->post('groups');

						if (isset($groupData) && !empty($groupData)) {

							$this->ion_auth->remove_from_group('', $user->id);

							foreach ($groupData as $grp) {
								$this->ion_auth->add_to_group($grp, $user->id);
							}

						}
					}

					// check to see if we are updating the user
					if($this->ion_auth->update($user->id, $data)) {
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('message', $this->ion_auth->messages() ); 
						redirect('profile/home', 'location', 301);   

					}else {
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('message', $this->ion_auth->errors() ); 
						redirect('profile/user/edit/'.$user->username, 'location', 301);   

					}	
				
					
					 
				}
		 
		
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301);   
		} 
    }	
	
	
    /**
    * check the old email and reset the email address and notification 
    * change_email
    ****
    * @access public
    * @ Param $key
    * @ Return string with the last query 
    */
    function change_email($new_email,$key) { 
	
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('reset_password');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 	
		$data['message'] = "";
		
		// check key was provided  
		if (!empty($key) && !empty($new_email)) {
			// use key to find the user's email address
			$user_email = $this->ion_auth->getEmailFromKey($key);
			$user_name = $this->ion_auth->getUsernameFromKey($key);
			if ($user_email) { 
			   
					$change = $this->ion_auth->change_email($key, $user_email, $new_email);
					
					if ($change) {
						//if the password was successfully changed 
						debug('Initialize email reset - loading "profile/reset_email" success creating new password view'); 
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->notify->notify_change_email('reset_email', $user_email, $user_name, $new_email); 
						$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/login/reset_email', 'nav_content' => $this->setting['current_theme'] . '/frontend/login/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/login/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/login/footer');
						$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
					}else {
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('profile/login', 'refresh');
					}				
		 
			} else { 			
				debug('Initialize email reset - loading "profile/reset_email" email addresss not found');
				redirect('profile', 'location', 301);   
			}
		} else {
			
			debug('Initialize email reset - loading "profile/reset_email" no key provided view'); 
			redirect('profile/login', 'location', 301);      
		}
					
		 
    }	
	
	/**
    * change_password - update user password
    *
    ****
    * @access public
    * @ Param $username
    * @ Return string with the last query 
    */	 
	function change_password()
	{		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('user');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];
		$data['message'] = "";
		
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()){ 

			$user = $this->ion_auth->user()->row();

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
							 
			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			 
			
				$config = array(  
					array(
						'field' => 'old_password',
						'label' => lang('profile_change_old_password'),
						'rules' => 'required'
					),			
					array(
						'field' => 'new_password',
						'label' => lang('profile_change_new_password'), 
						'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_password_confirm]'
					),		
					array(
						'field' => 'new_password_confirm',
						'label' => lang('profile_change_new_password_confirm'), 
						'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_password]'
					)
				);
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);			
				
				
				if ($this->form_validation->run() == false)
				{
					// validation failed - reload user with error message(s)
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/user/change_password', 'nav_content' => $this->setting['current_theme'] . '/backend/user/nav', 'header_content' => $this->setting['current_theme'] . '/backend/user/header', 'footer_content' => $this->setting['current_theme'] . '/backend/user/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);	
				}
				else
				{
					$identity = $this->session->userdata('identity');

					$change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));
					
					if ($change)
					{
					//if the password was successfully changed
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$this->notify->notify_forgotten_password_complete('reset_password', $data['userinfo']->email, $data['userinfo']->username, $this->input->post('new_password')); 
					$this->ion_auth->logout();
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('profile/change_password', 'refresh');
					}
				}
			 
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301);   
		} 
		
	}	 	

	/**
    * reset password - final step for forgotten password
    *
    ****
    * @access public
    * @ Param $code
    * @ Return string with the last query 
    */	 	 
	public function reset_password($code = NULL){

		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('user');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];
		$data['message'] = "";
		
		if (!$code)	{
			show_404();
		}

		$data['userinfo'] = $this->ion_auth->forgotten_password_check($code);
		$data['usercode'] = $code;
		$data['message'] = '';
		
		if ($data['userinfo']){
			// if the code is valid then display the password reset form 
			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth'); 
			
				$config = array(  		
					array(
						'field' => 'new_password',
						'label' => lang('profile_change_new_password'), 
						'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_password_confirm]'
					),		
					array(
						'field' => 'new_password_confirm',
						'label' => lang('profile_change_new_password_confirm'), 
						'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_password]'
					)
				);
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);		 
				
				if ($this->form_validation->run() == FALSE)	{
					 
					// validation failed - reload user with error message(s)
					debug('Initialize validation - loading "reset_password/index" fail');	 
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/login/reset_password', 'nav_content' => $this->setting['current_theme'] . '/frontend/login/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/login/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/login/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);	
				
				}else{ 
				
					$change = $this->ion_auth->reset_password($data['userinfo']->email, $this->input->post('new_password_confirm'));
 
					if ($change){ 
						//if the password was successfully changed
						$this->ion_auth->clear_forgotten_password_code($code);
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->notify->notify_forgotten_password_complete('reset_password', $data['userinfo']->email, $data['userinfo']->username, $this->input->post('new_password')); 
						$this->ion_auth->clear_forgotten_password_code($code);
						$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/login/reset_password_complete', 'nav_content' => $this->setting['current_theme'] . '/frontend/login/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/login/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/login/footer');
						$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);			 
					
					}else{
						
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('profile/user/reset_password/' . $code, 'refresh');
					}
				}			
	 
			
		}else{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/login/user', 'nav_content' => $this->setting['current_theme'] . '/frontend/login/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/login/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/login/footer');
			$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);	
		}
	}	
	
   /**
    * delete - delete the user and events the database
    *
    ****
    * @access public
    * @ Param $id
    * @ Return string with the last query 
    */	
    function delete($id) {
				
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
						
			$data['userinfo'] = $this->Member_model->getUserById($user->id);				
			$data['pagename'] = $this->Page_model->getAllMembersPages(4, $this->uri->segment(4));
			
				// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
		
			$config = array(  
				array(
					'field' => 'password2',
					'label' => lang('profile_validation_password'),
					'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|xss_clean'
				)
			);
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules($config);
			 
			// validate the form data
			if ($this->form_validation->run() === FALSE) {
				 
				// validation failed - reload user with error message(s)								
				debug('Initialize validation - loading "user/index" fail');	 
				$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/user/index', 'nav_content' => $this->setting['current_theme'] . '/backend/user/nav', 'header_content' => $this->setting['current_theme'] . '/backend/user/header', 'footer_content' => $this->setting['current_theme'] . '/backend/user/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);	
				
			} else { 	
					
				$password = $this->input->post('password2');
				//authenticate
				if ($this->ion_auth->hash_password_db($user->id, $password)) {  
					
						debug('Initialize user deletion - loading "user/delete" delete user successfully');
						$username = $data['userinfo']->username;	 
						
						$this->Member_model->profile_del($id); 
						$this->Gmaps_model->profile_del($username);
						$this->Fullcalendar_model->profile_del($username);
						$this->Category_model->profile_del($username);
						$this->Eventsources_model->profile_del($username); 
						
						$this->notify->notify_user_deleted('notify_message', $data['userinfo']->email, $username, lang('notify_email_delete_user'));
						
						$this->auth->logout();		
						
						redirect('/profile/login', 301); 
				
				}else{
					
					debug('Initialize auth - loading "user/index" fail');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/user/index', 'nav_content' => $this->setting['current_theme'] . '/backend/user/nav', 'header_content' => $this->setting['current_theme'] . '/backend/user/header', 'footer_content' => $this->setting['current_theme'] . '/backend/user/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);	
				
				}
			}
		
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		} 	
		
		
    }
  
	/*
     * calendar_settings function
     *
     * display the settings of the fullcalendar requirements
     */	
	function calendar_settings() {
	
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('calendar');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];   
		$data['editable'] = $this->setting['cal_editable']; 	
		$data['message'] = "";
		
		// check if user is logged in
	    if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
 			
 			// load a page of events into an array for displaying in the view 
			$data['userinfo'] = $this->Member_model->getUserById($user->id);  
			$data['pagename'] = $this->Page_model->getAllMembersPages(4, $this->uri->segment(4));
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}			

			if ($this->input->post('calendar_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('profile/home', 'location', 301);}			
			} 
			
			if ($this->input->post('calendar_submit')) { 
					$config = array(
					array(
						'field' => 'cal_timezone',
						'label' => lang('cal_timezone'),
						'rules' => 'trim|required|xss_clean'
					),array(
						'field' => 'cal_language',
						'label' => lang('cal_language'),
						'rules' => 'trim|required|xss_clean'
					),					
					array(
						'field' => 'cal_defaultview',
						'label' => lang('cal_defaultview'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'cal_header_left',
						'label' => lang('cal_header_left'),
						'rules' => 'trim|required|xss_clean'
					),					
					array(
						'field' => 'cal_header_center',
						'label' => lang('cal_header_center'),
						'rules' => 'trim|required|xss_clean'
					),					
					array(
						'field' => 'cal_header_right',
						'label' => lang('cal_header_right'),
						'rules' => 'trim|required|xss_clean'
					),					
					array(
						'field' => 'cal_aspectratio',
						'label' => lang('cal_aspectratio'),
						'rules' => 'trim|required|xss_clean'
					),			
					array(
						'field' => 'cal_hiddendays',
						'label' => lang('cal_hiddendays'),
						'rules' => 'trim|xss_clean'
					),
					array(
						'field' => 'cal_weeknumberswithindays',
						'label' => lang('cal_weeknumbers_withindays'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'cal_weeknumbers',
						'label' => lang('cal_weeknumbers'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'cal_firstday',
						'label' => lang('cal_firstday'),
						'rules' => 'trim|required|numeric|xss_clean'
					),
					array(
						'field' => 'cal_businessdays',
						'label' => lang('cal_businesshours_opendays'),
						'rules' => 'trim|xss_clean'
					),					
					array(
						'field' => 'cal_businessstart',
						'label' => lang('cal_businesshours_start'),
						'rules' => 'trim|xss_clean'
					),					
					array(
						'field' => 'cal_businessend',
						'label' => lang('cal_businesshours_end'),
						'rules' => 'trim|xss_clean'
					),
					array(
						'field' => 'cal_slotduration',
						'label' => lang('cal_slotduration'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'cal_weeknumbers',
						'label' => lang('cal_weeknumbers'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'cal_eventlimit',
						'label' => lang('cal_eventlimit'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'cal_alldayslot',
						'label' => lang('cal_alldayslot'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'cal_slotlabeling',
						'label' => lang('cal_slotlabeling'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'cal_slotlabelformat',
						'label' => lang('cal_slotlabelformat'),
						'rules' => 'trim|required|xss_clean'
					),					
					array(
						'field' => 'cal_isrtl',
						'label' => lang('cal_isrtl'),
						'rules' => 'trim|required|xss_clean'
					),					
					array(
						'field' => 'cal_mintime',
						'label' => lang('cal_mintime'),
						'rules' => 'trim|required|xss_clean'
					),					
					array(
						'field' => 'cal_maxtime',
						'label' => lang('cal_maxtime'),
						'rules' => 'trim|required|xss_clean'
					)
					);
					
					$this->form_validation->set_error_delimiters('', '');
					$this->form_validation->set_rules($config); 
				
				// validate the form data
				if ($this->form_validation->run() === FALSE) {
				 
					// form not submitted so just show the form 
					debug('Initialize index - loading "user/calendar_settings" validation error view');
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/user/calendar_settings', 'nav_content' => $this->setting['current_theme'] . '/backend/user/nav', 'header_content' => $this->setting['current_theme'] . '/backend/user/header', 'footer_content' => $this->setting['current_theme'] . '/backend/user/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 					 

				} else { 
				 				 
					// prepare data for adding to database 
					$language = $this->input->post('cal_language');
					$timezone = $this->input->post('cal_timezone');
					$defaultview = $this->input->post('cal_defaultview');
					$header_left = $this->input->post('cal_header_left');
					$header_center = $this->input->post('cal_header_center');
					$header_right = $this->input->post('cal_header_right');	 				
					$aspectratio = $this->input->post('cal_aspectratio');	 				
					$hiddendays = $this->input->post('cal_hiddendays');
					$firstday = $this->input->post('cal_firstday');
					$businessdays = $this->input->post('cal_businessdays');
					$businessstart = $this->input->post('cal_businessstart');
					$businessend = $this->input->post('cal_businessend');
					$weeknumberswithindays = $this->input->post('cal_weeknumberswithindays');
					$weeknumbers = $this->input->post('cal_weeknumbers');
					$eventlimit = $this->input->post('cal_eventlimit');
					$alldayslot = $this->input->post('cal_alldayslot');
					$slotlabeling = $this->input->post('cal_slotlabeling');
					$slotlabelformat = $this->input->post('cal_slotlabelformat');
					$slotduration = $this->input->post('cal_slotduration');
					$isrtl = $this->input->post('cal_isrtl');
					$mintime = $this->input->post('cal_mintime');
					$maxtime = $this->input->post('cal_maxtime');
						  
					$this->Member_model->fullCalendarSettings($data['userinfo']->id, $language, $timezone, $defaultview, $header_left, $header_center, $header_right, $aspectratio,$hiddendays, $firstday, $businessdays, $businessstart, $businessend, $weeknumberswithindays, $weeknumbers, $eventlimit, $alldayslot, $slotlabeling, $slotlabelformat, $slotduration, $isrtl, $mintime,$maxtime);
					
					// reload the form 
					debug('Initialize index - loading "profile/user/calendar_settings" validation successful view'); 
					redirect('profile/user/calendar_settings', 'location', 301);  
					
				}
			 
			} else {
			
				// form not submitted so just show the form 
				debug('Initialize index - loading "user/calendar_settings" load submission view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/user/calendar_settings', 'nav_content' => $this->setting['current_theme'] . '/backend/user/nav', 'header_content' => $this->setting['current_theme'] . '/backend/user/header', 'footer_content' => $this->setting['current_theme'] . '/backend/user/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
			}
		
		} else {			 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 'location', 301);  
		}   
    }	
  
}

/* End of file user.php */
/* Location: ./application/controllers/profile/user.php */