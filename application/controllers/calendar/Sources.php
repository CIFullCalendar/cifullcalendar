<?php

 /**
 * Sources controller class
 *
 * Displays the users source list
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		index.php/sources
 */  
class Sources extends CI_Controller {

    /*
     *  Controller class constructor
     */
	public function __construct() {
	parent::__construct(); 
	 $this->load->model('Fullcalendar_model','calendar');
	 $this->load->model('Member_model');
	 $this->load->model('Eventsources_model');
	 $this->load->model('Page_model');

	 $this->load->helper('security');
	 $this->load->helper('form');
	 $this->load->helper('url');

	 $this->load->library('ion_auth'); 
	 $this->load->library('Languages');
	 $this->load->library('Icalendar');
	 $this->load->library('upload');
	 $this->load->library('form_validation');  	
	 // load all settings into an array
	 $this->setting = $this->Setting_model->getEverySetting();
    }

    /**
    * index - the event source in the database
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
		$data['page_title'] = lang('sources_all_heading');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = config_item('version');
			
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 	
		
			$user = $this->ion_auth->user()->row();
			
			//load the data within view
			$data['userinfo'] = $this->Member_model->getUserById($user->id);
			$data['pagename'] = $this->Page_model->getAllMembersPages(4, $this->uri->segment(4));
			$data['message'] = '';
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
			// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}
			 
			// load a page of sources into an array for displaying in the view
			$data['sources'] = $this->Eventsources_model->getSourceList(0, $this->uri->segment(4), $user->username);
	   
			if ($data['sources']) { 
		  
				debug('Initialize index - loading "sources/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/sources/index', 'nav_content' => $this->setting['current_theme'] . '/backend/sources/nav', 'header_content' => $this->setting['current_theme'] . '/backend/sources/header', 'footer_content' => $this->setting['current_theme'] . '/backend/sources/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
			} else {
				
				debug('Initialize index - loading "categories/sources_empty" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/sources/empty', 'nav_content' => $this->setting['current_theme'] . '/backend/sources/nav', 'header_content' => $this->setting['current_theme'] . '/backend/sources/header', 'footer_content' => $this->setting['current_theme'] . '/backend/sources/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}
			
		} else {		
		
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301);    
		}       
	 
	}
	
	/**
    * get_sources - events sources
    * This function is called to get members sources
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_sources() { 
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 	
		
			$user = $this->ion_auth->user()->row(); 	
			$sources = $this->Eventsources_model->getSourceList(0, $this->uri->segment(4), $user->username);	 
			echo json_encode($sources);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301);   
		}
	}	
  
  
    /**
    * import - events are saved in ics format
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */			
	public function upload_ical() {
		debug('Initialize upload - loading "home/upload_file" uploading ICS files');
		// check user is logged in with permissions   
		
		 if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
		
			$user = $this->ion_auth->user()->row(); 
		 
			$status = "";
			$msg = "";
			$file_element_name = 'userfile';  
			
			if ($status != "error")   {
		   
				$config['upload_path']	= $this->setting['sync_path_location'];
				$config['allowed_types']= $this->setting['sync_allowed_extension'];  
				$config['max_size']		= $this->setting['sync_max_size'];
				$config['encrypt_name'] = FALSE;  

				$this->upload->initialize($config);

				if ($this->upload->do_upload($file_element_name))	{
				
					$data = $this->upload->data();
					$filename = $_FILES['userfile']['tmp_name'];
					 
					$this->calendar->import($user->username, $this->icalendar->parseFile($filename));
					
					redirect('calendar', 'location', 301); 	
				
				}else {

					 $status = 'error';
					 $msg = $this->upload->display_errors('', '');						
				}
				@unlink($_FILES[$file_element_name]);
			}
			
			redirect('calendar/sources', 'location', 301); 	
			
		}else {
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301); 
		}	  		 
    }	  
  
    /**
    * page - the event source in the database
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
		$data['page_title'] = lang('sources_add_new');
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
				redirect('calendar/sources', 'location', 301);	
			} 		
			
			// check form data was submitted
			if ($this->input->post('submitAdd')) {
				
				$config = array(
					array(
						'field' => 'source_name',
						'label' => lang('sources_input_name'),
						'rules' => 'trim|required|min_length[1]|max_length[50]|xss_clean'
					),
					array(
						'field' => 'source_url',
						'label' => lang('sources_input_url'),
						'rules' => 'trim|required|valid_url|xss_clean'
					) 
				);
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
				
				if ($this->form_validation->run() === FALSE) { 
					debug('validation failed - reload sources with error message(s)');
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/sources/add', 'nav_content' => $this->setting['current_theme'] . '/backend/sources/nav', 'header_content' => $this->setting['current_theme'] . '/backend/sources/header', 'footer_content' => $this->setting['current_theme'] . '/backend/sources/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);   					 
				} else {
	   
					// prepare data for database  
					$source_name = $this->input->post('source_name');
					$source_url = $this->input->post('source_url'); 
					
					$this->Eventsources_model->add($user->username, $source_name, $source_url);
					
					$data['message'] = lang('sources_message_success');
				  
					// reload the form
					redirect('calendar/sources', 'location', 301);     
				 }
 
			} else {
				// form not submitted so just show the form 
				debug('Initialize index - loading "calendar/sources/add" view');
				$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));		
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/sources/add', 'nav_content' => $this->setting['current_theme'] . '/backend/sources/nav', 'header_content' => $this->setting['current_theme'] . '/backend/sources/header', 'footer_content' => $this->setting['current_theme'] . '/backend/sources/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
			}
			
		}else {
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301);   
		}				 
	 
    }

    /**
    * edit - edit event sources in the database
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
 
	
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
			 		
			// check from the database
			$data['editsources'] =	$this->Eventsources_model->geteventSourcesById($id);
			if(empty($data['editsources'])) { redirect('calendar/sources', 'location', 301); }					
					
			// check form data was submitted
			if ($this->input->post('submitCancel')) { 
				redirect('calendar/sources', 'location', 301);	
			} 
			 
			// check form data was submitted
			if ($this->input->post('submitEdit')) {			
	 
				$config = array(
					array(
						'field' => 'source_name',
						'label' => lang('sources_input_name'),
						'rules' => 'trim|required|min_length[1]|max_length[50]|xss_clean'
					),
					array(
						'field' => 'source_url',
						'label' => lang('sources_input_url'),
						'rules' => 'trim|required|valid_url|xss_clean'
					) 
				);
				
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
			 
				if ($this->form_validation->run() === FALSE) {
					 
					debug('validation failed - reload sources with error message(s)');
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/sources/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/sources/nav', 'header_content' => $this->setting['current_theme'] . '/backend/sources/header', 'footer_content' => $this->setting['current_theme'] . '/backend/sources/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);  
				
				} else {
				 
					// prepare data for database
					$id = $data['editsources']->source_id; 
					$source_name = $this->input->post('source_name');
					$source_url = $this->input->post('source_url'); 
				 
					$this->Eventsources_model->update($id, $user->username, $source_name, $source_url );
					$data['message'] = lang('sources_message_success');
					
					// reload the form
					redirect('calendar/sources', 'location', 301);    
				}
		 
			} else {
				// form not submitted so load the data and show the form
				debug('Initialize index - loading "calendar/sources/index" view'); 
				$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/sources/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/sources/nav', 'header_content' => $this->setting['current_theme'] . '/backend/sources/header', 'footer_content' => $this->setting['current_theme'] . '/backend/sources/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);  
			}
		
		}else {
			debug('Initialize index - loading "login/index" view');
			redirect('profile/login', 'location', 301);   
		}			
		
		
    }	
	
	
	/**
    * Delete - delete sources in the database
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
			
			$checkbox[] = $this->security->xss_clean($this->input->post('source_id'));	 
			 
			for($i=0;$i<=$this->Eventsources_model->countSources();$i++){
				$del_id = $checkbox[$i]; 
			 	$this->Eventsources_model->delete($del_id, $user->username);	
			}    
			
		}else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('profile/login', 'location', 301); 
		}
		
	}	
	
    /**
    * del - the event source in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function del($id) { 
	
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 	
		
			$user = $this->ion_auth->user()->row();  
			
			$data['delsources'] = $this->Eventsources_model->geteventSourcesById($id);
			
			if ($data['delsources']) { 			 
			
				$this->Eventsources_model->delete($data['delsources']->source_id, $user->username);		
				// reload the form
				redirect('calendar/sources', 'location', 301);   
				
			}else {redirect('calendar/sources', 'location', 301);     }
		
		}else {	redirect('profile/login', 'location', 301);    }	
	}
 

}

/* End of file sources.php */
/* Location: ./application/controllers/sources.php */