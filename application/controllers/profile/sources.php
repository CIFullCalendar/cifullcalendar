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
    function Sources() {
	parent::__construct(); 
	$this->load->model('Member_model');
	$this->load->model('Eventsources_model');
	$this->load->model('Page_model');

	$this->load->helper('security');
	$this->load->helper('form');
	$this->load->helper('url');

	$this->load->library('ion_auth'); 
	$this->load->library('Languages');
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
		$data['current_version'] = $this->setting['current_version']; 
			
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
			redirect('/profile/login', 301); 
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
			redirect('/profile/login', 301);
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
	 
		// check user is logged in with permissions
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 	
		
			$user = $this->ion_auth->user()->row(); 
		 
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
			
					echo " <script>
						alert('Failed: ".  form_error('source_name') ." ".  form_error('source_url') ." ');
						history.go(-1);
					 </script>";   
					 
			} else {
   
				// prepare data for database  
				$source_name = $this->input->post('source_name');
				$source_url = $this->input->post('source_url'); 
				
				$this->Eventsources_model->add($user->username, $source_name, $source_url );
				$data['message'] = lang('sources_message_success');
			  
				// reload the form
				redirect('profile/sources', 301);  
			 }
 
			 
		}else {
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301); 
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
	
		// check user is logged in with permissions 
		if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) { 	
		
			$user = $this->ion_auth->user()->row();  
			
			// check from the database
			$data['editId'] = $this->Eventsources_model->geteventSourcesById($id);
		
			if ($data['editId']) { 
	 
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
					 
						echo " <script>
								alert('Failed: ".  form_error('source_name') ." ".  form_error('source_url') ." ');
							history.go(-1);
						 </script>";   
				
				} else {
				 
					// prepare data for database
					$id = $this->input->post('source_id'); 
					$source_name = $this->input->post('source_name');
					$source_url = $this->input->post('source_url'); 
				 
					$this->Eventsources_model->update($id, $user->username, $source_name, $source_url );
					$data['message'] = lang('sources_message_success');
					
					// reload the form
					redirect('profile/sources', 301);  
				}
		 
			} else {
				redirect('profile/sources', 301);  
			}
		
		}else {
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301); 
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
			$data['delId'] = $this->Eventsources_model->geteventSourcesById($id);
			if ($data['delId']) { 			 
			
				$this->Eventsources_model->delete($id, $user->username);		
				// reload the form
				redirect('profile/sources', 301); 
				
			}else {redirect('profile/sources', 301);  }
		
		}else {	redirect('/profile/login', 301); }	
	}
 

}

/* End of file sources.php */
/* Location: ./application/controllers/sources.php */