<?php

 /**
 * Group controller class
 *
 * Displays the users source list
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		index.php/group
 */ 
 
class Group extends CI_Controller {

    /*
     *  Controller class constructor
     */

   function Group() {
	parent::__construct(); 
	$this->load->model('Fullcalendar_admin_model','calendar');
	$this->load->model('gmaps_admin_model');	
	$this->load->model('Member_admin_model'); 
	$this->load->model('Member_model');   	
	$this->load->model('Ion_auth_model');   	
	$this->load->model('Page_model');
		
	$this->load->helper('date');	
	$this->load->helper('security');
	$this->load->helper('form');
	$this->load->helper('url');
	
	$this->load->library('ion_auth');
	$this->load->library('Languages');
	$this->load->library('Notify');
	$this->load->library('form_validation');	
	// load all settings into an array
	$this->setting = $this->Setting_model->getEverySetting();
    }

    /**
    * index - the group in the database
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
		$data['current_version'] = $this->setting['current_version'];   
			
		// load a page of users into an array for displaying in the view			
		$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(4));			
		
		$data['message'] = '';    
		
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
	 
			//list the groups
			$data['allgroups'] = $this->ion_auth->groups()->result(); 
			
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();		 
			
			if ($data['allgroups']) {  
	 
				debug('Initialize index - loading "group/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/group/index', 'nav_content' => $this->setting['current_theme'] . '/backend/group/nav', 'header_content' => $this->setting['current_theme'] . '/backend/group/header', 'footer_content' => $this->setting['current_theme'] . '/backend/group/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
			} else {
				
				debug('Initialize index - loading "group/empty" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/group/empty', 'nav_content' => $this->setting['current_theme'] . '/backend/group/nav', 'header_content' => $this->setting['current_theme'] . '/backend/group/header', 'footer_content' => $this->setting['current_theme'] . '/backend/group/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}
			
		} else {	
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');			
			redirect('admin/login', 301); 
		}     
	 
	}
	
	/**
    * get_allgroups - group info
    * This function is called to get group information
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_allgroups() { 
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) {  
		
			$allgroups = $this->Member_admin_model->getAllGroups();  
			echo json_encode($allgroups);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301);
		}
	}	
	
    /**
    * add - a group in the database
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
		$data['page_title'] = lang('create_group_title');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 
		// load a page of events into an array for displaying in the view
		$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5));			
		
		$data['allgroups'] = $this->ion_auth->groups()->result(); 
			
	    $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
	 
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$admin = $this->ion_auth->user()->row();
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $admin->image,  $admin->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $admin->image;;
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
						'field' => 'group_name',
						'label' => lang('edit_group_name_label'),
						'rules' => 'trim|required|alpha_dash|xss_clean'
					),	
					array(
						'field' => 'description',
						'label' => lang('edit_group_desc_label'),
						'rules' => 'trim|required|min_length[1]|xss_clean'
					)  
				);
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
				
				if ($this->form_validation->run() === FALSE) { 
				
					// validation failed - reload group with error message(s) 
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					redirect("admin/group", 'refresh');
						 
				} else {
	   
	   
					/*$additional_data = array( 
						'company'    => $this->input->post('company')
					);	*/
	   
					$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
					if($new_group_id)
					{ 
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("admin/group", 'refresh');
					}else{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect("admin/group", 'refresh');
					}
				
					
				 }
		
		}else { 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}
	 
    }

    /**
    * edit - the group in the database
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
		$data['page_title'] = lang('edit_group_title');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 
		
		// load a page of events into an array for displaying in the view
		$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5));	
			
	    $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
		  
		$data['group'] = $this->ion_auth->group($id)->row();
		$data['groups'] = $this->ion_auth->groups()->result(); 
		$data['readonly'] = $this->config->item('admin_group', 'ion_auth') === $data['group']->name ? 'readonly' : '';
		
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) {  
		
			$admin = $this->ion_auth->user()->row();  
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $admin->image,  $admin->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $admin->image;;
			} else {
			// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
			
			$data['userinfo'] = $this->Member_model->getUserById($admin->id);
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();			
			
			
			if($data['group']) {
				$config = array(
					array(
						'field' => 'group_name',
						'label' => lang('edit_group_name_label'),
						'rules' => 'trim|required|alpha_dash|xss_clean'
					),	
					array(
						'field' => 'description',
						'label' => lang('edit_group_desc_label'),
						'rules' => 'trim|required|min_length[1]|xss_clean'
					)  
				);
				
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
			 
				if ($this->form_validation->run() === FALSE) {
					 
					// validation failed - reload user with error message(s) 
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/group/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/group/nav', 'header_content' => $this->setting['current_theme'] . '/backend/group/header', 'footer_content' => $this->setting['current_theme'] . '/backend/group/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);   
				
				} else { 
			
					/*$additional_data = array( 
						'company'    => $this->input->post('company')
					);	*/
			
					$group_update = $this->ion_auth->update_group($data['group']->id, $this->input->post('group_name'), $this->input->post('description'));

					if($group_update)
					{ 
						$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
						redirect("admin/group", 'refresh');
					}else{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect("admin/group", 'refresh');
					}
				 
				}
				 
			}else{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin/group', 301); 
			}
			
		} else {
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
	function del_selected() {  
	
		// set the page language
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);	
	
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();   
			
			$checkbox[] = $this->security->xss_clean($this->input->post('id'));	 
			$groups = $this->ion_auth->groups()->result();  
			$check_defaults = ($this->config->item('admin_group', 'ion_auth') === $groups->name) ? TRUE : FALSE;
			 
			if($check_defaults === FALSE) {
				for($i=0;$i<=$this->Member_admin_model->countGroups();$i++){ 
					$this->ion_auth->delete_group($checkbox[$i]); 
				}  	 
			}else{$this->session->set_flashdata('message', lang('error_page_title'));} 
			
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/group', 301);  
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
			$groups = $this->ion_auth->groups()->result();  
			$check_defaults = ($this->config->item('admin_group', 'ion_auth') === $groups->name) ? TRUE : FALSE;
			 
			if($check_defaults === FALSE) {
			  
				$this->ion_auth->delete_group($this->security->xss_clean($id));
				
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('admin/group', 301); 
				
			}else{$this->session->set_flashdata('message', lang('error_page_title'));} 
		
		}else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}
	
	}
 

}

/* End of file Userslist.php */
/* Location: ./application/controllers/userslist.php */