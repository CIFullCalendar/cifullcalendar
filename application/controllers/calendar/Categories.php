<?php
 
 /**
 * Categories controller class
 *
 * Displays the users categories list
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		index.php/categories
 */
 
class Categories extends CI_Controller {

	/*
     *  Controller class constructor
     */

	public function __construct() {
	parent::__construct(); 
	$this->load->model('Member_model');   
	$this->load->model('Category_model');
	$this->load->model('Page_model');

	$this->load->helper('string');
	$this->load->helper('date');	
	$this->load->helper('security');
	$this->load->helper('form');
	$this->load->helper('url');
	$this->load->helper('typography');
	
	$this->load->library('ion_auth');
	$this->load->library('Languages');
	$this->load->library('form_validation');
	// load all settings into an array
	$this->setting = $this->Setting_model->getEverySetting();
    }

    /**
    * index - the event category in the database
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
		$data['page_title'] = lang('submenu_dropdown_all_categories');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = config_item('version');
		
		// check user is logged in with permissions
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {	
		
			$user = $this->ion_auth->user()->row();
		
			// load a page of custom pages into an array for displaying in the view			
			$data['userinfo'] = $this->Member_model->getUserById($user->id); 			
			$data['pagename'] = $this->Page_model->getAllMembersPages(4, $this->uri->segment(4));
			$data['message'] = '';
			$data['groups'] = $this->ion_auth->groups()->result_array(); 
						
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	  		 		
  
			// load a page of users into an array for displaying in the view
			$data['categories'] = $this->Category_model->get_categories($user);	
			
			if ($data['categories']) { 
				// show the custom categories page
				debug('Initialize index - loading "calendar/categories/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/categories/index', 'nav_content' => $this->setting['current_theme'] . '/backend/categories/nav', 'header_content' => $this->setting['current_theme'] . '/backend/categories/header', 'footer_content' => $this->setting['current_theme'] . '/backend/categories/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
				
			} else {
				// no data... show the 'no categories' page
				debug('Initialize page empty - loading "calendar/categories/empty" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/categories/empty', 'nav_content' => $this->setting['current_theme'] . '/backend/categories/nav', 'header_content' => $this->setting['current_theme'] . '/backend/categories/header', 'footer_content' => $this->setting['current_theme'] . '/backend/categories/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}				
		 
		
		} else {			 
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301); 
		}    	 
	 
	}
	
	/**
    * get_categories - calendar categories
    * This function is called to get members categories
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_categories() { 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row(); 		
			$categories  = $this->Category_model->get_categories($user);		
			
			echo json_encode($categories);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301); 
		}
	}			
	
    /**
    * add - the event category in the database
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
		$data['page_title'] = lang('categories_add_new');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = config_item('version');
		$data['message'] = "";
		
		// check user is logged in with permissions
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {	
		
			$user = $this->ion_auth->user()->row();  
			
			// load a page of events into an array for displaying in the view
			$data['userinfo'] = $this->Member_model->getUserById($user->id);
			$data['groups'] = $this->ion_auth->groups()->result_array(); 
			$data['pagename'] = $this->Page_model->getAllMembersPages(4, $this->uri->segment(4)); 
	 
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
			 	 
			if ($this->input->post('submitCancel')) { 
				redirect('calendar/categories', 'location', 301);	
			} 		
			
			// check form data was submitted
			if ($this->input->post('submitAdd')) {
				
				$config = array(
					array(
						'field' => 'category_name',
						'label' => lang('categories_input_name'),
						'rules' => 'trim|required|min_length[2]|max_length[50]|xss_clean'
					),
					array(
						'field' => 'category_desc',
						'label' => lang('categories_input_description'),
						'rules' => 'trim|required|min_length[2]|max_length[150]|xss_clean'
					),
					array(
						'field' => 'category_bgcolor',
						'label' => lang('calendar_modal_colorbackground'),
						'rules' => 'trim|min_length[2]|max_length[11]'
					),
					array(
						'field' => 'category_bcolor',
						'label' => lang('calendar_modal_colorborder'),
						'rules' => 'trim|min_length[2]|max_length[11]'
					),
					array(
						'field' => 'category_color',
						'label' => lang('calendar_modal_colortext'),
						'rules' => 'trim|min_length[2]|max_length[11]'
					) 
				); 
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
				
				if ($this->form_validation->run() === FALSE) { 
				
					debug('validation failed - reload categories with error message(s)');
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/categories/add', 'nav_content' => $this->setting['current_theme'] . '/backend/categories/nav', 'header_content' => $this->setting['current_theme'] . '/backend/categories/header', 'footer_content' => $this->setting['current_theme'] . '/backend/categories/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);   
						 
				} else {
	   
					// prepare data for database    
					$category_name = $this->input->post('category_name');
					$category_desc = $this->input->post('category_desc');
					$category_bgcolor = $this->input->post('category_bgcolor');
					$category_bcolor = $this->input->post('category_bcolor');
					$category_color = $this->input->post('category_color');
				 
					$this->Category_model->add($user->username, $category_name, $category_desc, $category_bgcolor, $category_bcolor, $category_color);
					$data['message'] = lang('categories_message_success');
				  
					// reload the list
					debug('Initialize index - loading "categories/index" view'); 
					redirect('calendar/categories', 'location', 301);   
				}
			
			} else {
				// form not submitted so just show the form 
				debug('Initialize index - loading "calendar/categories/add" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/categories/add', 'nav_content' => $this->setting['current_theme'] . '/backend/categories/nav', 'header_content' => $this->setting['current_theme'] . '/backend/categories/header', 'footer_content' => $this->setting['current_theme'] . '/backend/categories/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}			
				 
		} else {
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301); 
		}
	 
    }

    /**
    * edit - the event category in the database
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
		$data['page_title'] = lang('categories_add_new');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = config_item('version');
		$data['message'] = "";
		  
		
		// check user is logged in with permissions
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {	
		
			$user = $this->ion_auth->user()->row();  
			
			// load a page of events into an array for displaying in the view
			$data['userinfo'] = $this->Member_model->getUserById($user->id);
			$data['groups'] = $this->ion_auth->groups()->result_array();  
			$data['pagename'] = $this->Page_model->getAllPages(8);				
			$data['allpages'] = $this->Page_model->getAllPages(0);	 
			
			$data['editcategory'] = $this->Category_model->getCategoriesById($id); 
			if(empty($data['editcategory'])) { redirect('calendar/categories', 'location', 301); } 
	
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
			 		

			// check form data was submitted
			if ($this->input->post('submitCancel')) { 
				redirect('calendar/categories', 'location', 301);	
			} 

			// check form data was submitted
			if ($this->input->post('submitEdit')) {			

				$config = array(
					array(
						'field' => 'category_name',
						'label' => lang('categories_input_name'),
						'rules' => 'trim|required|min_length[2]|max_length[50]|xss_clean'
					),
					array(
						'field' => 'category_desc',
						'label' => lang('categories_input_description'),
						'rules' => 'trim|required|min_length[2]|max_length[150]|xss_clean'
					),
					array(
						'field' => 'category_bgcolor',
						'label' => lang('calendar_modal_colorbackground'),
						'rules' => 'trim|min_length[2]|max_length[11]'
					),
					array(
						'field' => 'category_bcolor',
						'label' => lang('calendar_modal_colorborder'),
						'rules' => 'trim|min_length[2]|max_length[11]'
					),
					array(
						'field' => 'category_color',
						'label' => lang('calendar_modal_colortext'),
						'rules' => 'trim|min_length[2]|max_length[11]'
					)  
				);
				$this->form_validation->set_error_delimiters('', ''); 
				$this->form_validation->set_rules($config);
			 
				if ($this->form_validation->run() === FALSE) {
					 
					debug('validation failed - reload categories with error message(s)');
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/categories/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/categories/nav', 'header_content' => $this->setting['current_theme'] . '/backend/categories/header', 'footer_content' => $this->setting['current_theme'] . '/backend/categories/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);  
				
				} else {
				 
					// prepare data for database
					$category_id = $data['editcategory']->category_id; 
					$category_name = $this->input->post('category_name');
					$category_desc = $this->input->post('category_desc'); 
					$category_bgcolor = $this->input->post('category_bgcolor');
					$category_bcolor = $this->input->post('category_bcolor');
					$category_color = $this->input->post('category_color'); 
				 
					$this->Category_model->update($category_id, $user->username, $category_name, $category_desc, $category_bgcolor, $category_bcolor, $category_color );
					$data['message'] = lang('categories_message_success');
					
					// reload the list
					debug('Initialize index - loading "categories/index" view'); 
					redirect('calendar/categories', 'location', 301);  
				} 
				
			} else {
				// form not submitted so load the data and show the form
				debug('Initialize index - loading "calendar/categories/index" view'); 
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/categories/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/categories/nav', 'header_content' => $this->setting['current_theme'] . '/backend/categories/header', 'footer_content' => $this->setting['current_theme'] . '/backend/categories/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
			}				
		
		} else {
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301); 
		}		
		
    }	

	/**
    * Delete - delete categories in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function del_selected() {  
	
		// check user is logged in with permissions
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {	 
			
			$user = $this->ion_auth->user()->row();
			
			$checkbox[] = $this->security->xss_clean($this->input->post('category_id'));	 
			 
			for($i=0;$i<=$this->Category_model->countCategories();$i++){
				$del_id = $checkbox[$i]; 
			 	$this->Category_model->delete($del_id, $user->username);	
			}    
			
		}else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('profile/login', 'location', 301); 
		}
		
	}
	
    /**
    * del - delete event category in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function del($id) { 
	
		// check user is logged in with permissions
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()){ 
		
			$user = $this->ion_auth->user()->row();
		
			$data['category'] = $this->Category_model->getCategoriesById($id);
			
			if ($data['category']) {  
				$this->Category_model->delete($data['category']->category_id, $user->username);	 
				// reload the form
				redirect('calendar/categories', 'location', 301);
				
			}else {redirect('calendar/categories', 'location', 301); }
		
		}else {redirect('profile/login', 'location', 301);  }
	}	  

}

/* End of file categories.php */
/* Location: ./application/controllers/calendar/categories.php */