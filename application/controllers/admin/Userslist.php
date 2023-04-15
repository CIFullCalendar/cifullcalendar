<?php

 /**
 * Userslist controller class
 *
 * Displays the users source list
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		index.php/userslist
 */ 
 
class Userslist extends CI_Controller {

    /*
     *  Controller class constructor
     */

	public function __construct() {
	parent::__construct(); 
	$this->load->model('Fullcalendar_admin_model','calendar'); 
	$this->load->model('Fullcalendar_model');
	$this->load->model('Member_admin_model'); 
	$this->load->model('Member_model');  
	$this->load->model('Gmaps_model');
	$this->load->model('Category_model');
	$this->load->model('Eventsources_model');		
	$this->load->model('Page_model');  
		
	$this->load->helper('date');	
	$this->load->helper('security');
	$this->load->helper('form');
	$this->load->helper('url');
	
	$this->load->library('ion_auth');
	$this->load->library('Languages');
	$this->load->library('Notify');
	$this->load->library('upload');
	$this->load->library('image_lib'); 	
	$this->load->library('form_validation');	
	// load all settings into an array
	$this->setting = $this->Setting_model->getEverySetting();
    }

    /**
    * index - the users list in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */
	function index() { 
	
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('users');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = config_item('version');
		
		$data['message'] = "";    
		
		// check if user is logged in
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
			
			// load a page of users into an array for displaying in the view			
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(4)); 
			$data['allusers'] = $this->Member_admin_model->getAllUsers(0, $this->uri->segment(4));
		 
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();		 
		  
			if ($data['allusers']) {  
	 
				debug('Initialize index - loading "users/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/userslist/list', 'nav_content' => $this->setting['current_theme'] . '/backend/userslist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/userslist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/userslist/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
			} else {
				
				debug('Initialize index - loading "users/table_empty" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/userslist/empty', 'nav_content' => $this->setting['current_theme'] . '/backend/userslist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/userslist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/userslist/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}
			
		} else {	
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');			
			redirect('admin/login', 301); 
		}     
	 
	}
	
	/**
    * get_allusers - users info
    * This function is called to get users information
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_allusers() { 
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) {     
			$users = $this->ion_auth->users();  
			if ($users->num_rows() > 0) { 
				$allusers = array();
				foreach ($users->result() as $entry) {
					
					$groups = $this->ion_auth->get_users_groups($entry->id)->result();
					
					$allusers[] = array(
						'id'     					=> $entry->id,  
						'username'     				=> $entry->username,   
						'first_name'   				=> $entry->first_name, 
						'last_name'   				=> $entry->last_name, 
						'email'   					=> $entry->email,     
						'groups'   					=> $groups,   
					);
				}	 
				
				echo json_encode($allusers);		 
			}			
			// no result
			return FALSE;
			
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301);
		}
	}	
	
    /**
    * add - users in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */	
	function add() {
	 
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language']; 
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('user');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 
		
		$data['message'] = "";   
		
	    $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
	 
		// check if user is logged in
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
		   
				$config = array(
					array(
						'field' => 'uname',
						'label' => lang('admin_table_username'),
						'rules' => 'trim|required|is_unique[' . $tables['users'] . '.username]|xss_clean'
					),	
					array(
						'field' => 'fname',
						'label' => lang('admin_table_fname'),
						'rules' => 'trim|required|min_length[1]|xss_clean'
					),
					array(
						'field' => 'lname',
						'label' => lang('admin_table_lname'),
						'rules' => 'trim|required|min_length[1]|xss_clean'
					),
					array(
						'field' => 'address',
						'label' => lang('admin_table_address'),
						'rules' => 'trim|required|min_length[3]|max_length[150]|xss_clean'
					),					
					array(
						'field' => 'email',
						'label' => lang('admin_table_email'),
						'rules' => 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]|xss_clean'
					),
					array(
						'field' => 'company',
						'label' => lang('admin_table_company'),
						'rules' => 'trim|min_length[3]|max_length[150]|xss_clean'
					),
					array(
						'field' => 'phone',
						'label' => lang('admin_table_phone'),
						'rules' => 'trim|xss_clean'
					),
					array(
						'field' => 'password',
						'label' => lang('admin_table_password'),
						'rules' => 'trim|required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]|xss_clean'
					),
					array(
						'field' => 'password_confirm',
						'label' => lang('edit_user_validation_password_confirm_label'),
						'rules' => 'trim|required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|xss_clean'
					)  
				);
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
				
				if ($this->form_validation->run() === FALSE) { 
				
					// validation failed - reload user with error message(s) 
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/userslist/add', 'nav_content' => $this->setting['current_theme'] . '/backend/userslist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/userslist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/userslist/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);   
						 
				} else {
	   
					// prepare data for adding to database 
					$email    = strtolower($this->input->post('email'));
					$identity = $this->input->post('uname');
					$password = $this->input->post('password'); 
					
					$additional_data = array(
						'first_name' => $this->input->post('fname'),
						'last_name'  => $this->input->post('lname'),
						'address'    => $this->input->post('address'),
						'company'    => $this->input->post('company'),
						'phone'      => $this->input->post('phone'),
						'status'     => $this->input->post('status')
					);	
			 
					
					if ($this->ion_auth->register($identity, $password, $email, $additional_data)) {
						// check to see if we are creating the user
						// redirect them back to the admin page 
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("admin/userslist", 'refresh'); 
					}else{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect("admin", 'refresh'); 
					} 
					
				 }
				  
				
		}else { 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}
	 
    }

    /**
    * edit - the users in the database
    *
    ****
    * @access public
    * @ Param $id
    * @ Return string with the last query 
    */	
    function edit($id) {  
	
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language']; 
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('admin_modal_edit_user');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 
		
		// load a page of events into an array for displaying in the view
		$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5));	
			
	    $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
		
		
		if(empty($id)){
			redirect('admin/userslist', 'location', 301); 
		}
		
		$user = $this->ion_auth->user($id)->row();
		$data['user'] = $user;
		$data['groups'] = $this->ion_auth->groups()->result_array();
		$data['currentGroups'] = $this->ion_auth->get_users_groups($id)->result();	  
		
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) {  
		
			$admin = $this->ion_auth->user()->row();  
			$data['userinfo'] = $this->Member_model->getUserById($admin->id);
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $admin->image,  $admin->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $admin->image;;
			} else {
			// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}			
		
			$data['upload_error'] = '';			
			$orig_file_name = '';
			$logo_path = 'assets/img/profile';		
		
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();		
		

			
				$config = array( 	
					array(
						'field' => 'fname',
						'label' => lang('admin_table_fname'),
						'rules' => 'trim|required|min_length[1]|xss_clean'
					),
					array(
						'field' => 'lname',
						'label' => lang('admin_table_lname'),
						'rules' => 'trim|required|min_length[1]|xss_clean'
					),
					array(
						'field' => 'address',
						'label' => lang('admin_table_address'),
						'rules' => 'trim|required|min_length[3]|max_length[150]|xss_clean'
					),
					array(
						'field' => 'company',
						'label' => lang('admin_table_company'),
						'rules' => 'trim|min_length[3]|max_length[150]|xss_clean'
					),
					array(
						'field' => 'phone',
						'label' => lang('admin_table_phone'),
						'rules' => 'trim|xss_clean'
					),
					array(
						'field' => 'email',
						'label' => lang('admin_table_email'),
						'rules' => 'trim|required|valid_email|xss_clean'
					),
					array(
						'field' => 'status',
						'label' => lang('edit_user_groups_heading'),
						'rules' => 'trim|xss_clean'
					),
					array(
						'field' => 'password',
						'label' => lang('admin_table_password'),
						'rules' => 'trim|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]|xss_clean'
					),
					array(
						'field' => 'password_confirm',
						'label' => lang('edit_user_validation_password_confirm_label'),
						'rules' => 'trim|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|xss_clean'
					)  
				);
				
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
			 
				if ($this->form_validation->run() === FALSE) {
					 
					// validation failed - reload user with error message(s) 
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/userslist/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/userslist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/userslist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/userslist/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);   
				
				} else {
					 
					// prepare data for adding to database 
					$data = array(
						'first_name' => $this->input->post('fname'),
						'last_name'  => $this->input->post('lname'),
						'address'    => $this->input->post('address'),
						'company'    => $this->input->post('company'),
						'email'   	 => $this->input->post('email'),
						'phone'      => $this->input->post('phone'),
						'active'     => $this->input->post('status'),
					);						 
							  
					// update the password if it was posted
					if ($this->input->post('password') && $this->ion_auth->is_admin())	{
						$data['password'] = $this->input->post('password');
					}					 
					 
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {
						if ($this->ion_auth->is_admin()){
							$this->ion_auth->remove_from_group('', $user->id);
						}else{
							foreach ($groupData as $rgrp) {
								if (!((0 <= $rgrp) && ($rgrp <= 8))) { 
								$this->ion_auth->remove_from_group('', $user->id);
								}
							} 
						}
						foreach ($groupData as $grp) {
							// Only allow updating groups if user is interns
							if ($this->ion_auth->is_admin()){
								$this->ion_auth->add_to_group($grp, $user->id);
							}else{
								//Update the groups user belongs to  
								if (!((0 <= $grp) && ($grp <= 8))) {  
									$this->ion_auth->add_to_group($grp, $user->id); 
								}
							}	 	
						} 
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
					
					 
					// check to see if we are updating the user
					if($this->ion_auth->update($user->id, $data))
					{
						// redirect them back to the admin page if admin, or to the base url if non admin 					
						$this->session->set_flashdata('message', $this->ion_auth->messages() ); 
						redirect('admin/userslist/edit/'.$id, 'location', 301);

					}else{
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('message', $this->ion_auth->errors() ); 
						redirect('admin/userslist/edit/'.$id, 'location', 301);

					}	
				 
				}
				 
			
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 'location', 301); 
		}
    }	
	
    /**
    * Delete - delete profile in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function del_selected() {  
	
		// set the page language
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);	
	
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();   
			
			$checkbox[] = $this->security->xss_clean($this->input->post('id'));	 
			 
				for($i=0;$i<=$this->Member_admin_model->countMembers();$i++){
					$del_id = $checkbox[$i]; 
					$userdata = $this->Member_model->getUserById($del_id);
					if ($user) { 
						$this->Member_admin_model->profile_del($userdata->id);	 
						$this->Gmaps_model->profile_del($userdata->username);
						$this->Fullcalendar_model->profile_del($userdata->username);
						$this->Category_model->profile_del($userdata->username);
						$this->Eventsources_model->profile_del($userdata->username); 			
						$this->Page_model->profile_del($userdata->username); 	
					}else {redirect('admin/userslist', 301);  }
				}   			
				$this->notify->notify_user_deleted('notify_message', $user->email, $user->username, lang('notify_email_delete_user'));
				
	 
		}else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}
		
	}
	
    /**
    * Delete - delete profile in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function del($id) { 
	
		// set the page language
		$data['lang'] = $this->setting['site_language']; 
		
		$this->languages->get_lang($data['lang']);	
		
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 

			$user = $this->ion_auth->user()->row();  
		
			$userinfo = $this->Member_model->getUserById($id);
	 
			if ($userinfo) { 
			 
			 
				$this->Member_admin_model->profile_del($userinfo->id);		
				 
				$this->Gmaps_model->profile_del($userinfo->username);
				$this->Fullcalendar_model->profile_del($userinfo->username);
				$this->Category_model->profile_del($userinfo->username);
				$this->Eventsources_model->profile_del($userinfo->username); 			
				$this->Page_model->profile_del($userinfo->username); 			 
  
				$this->notify->notify_user_deleted('notify_message', $userinfo->email, $userinfo->username, lang('notify_email_delete_user'));
				 
				// reload the form
				redirect('admin/userslist', 301); 
				
			}else {redirect('admin/userslist', 301);  }
		
		}else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}
	
	}
 

}

/* End of file Userslist.php */
/* Location: ./application/controllers/userslist.php */