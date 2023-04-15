<?php

 /**
 * Calendarlist controller class
 *
 * Displays the users source list
 *
 * @package		cifullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		index.php/calendarlist
 */ 
 
class Calendarlist extends CI_Controller {

    /*
     *  Controller class constructor
     */
	public function __construct() {
	parent::__construct(); 
	$this->load->model('Fullcalendar_admin_model','calendar'); 
	$this->load->model('gmaps_admin_model');
	$this->load->model('gmaps_model');
	$this->load->model('Category_admin_model');	
	$this->load->model('Member_model'); 		
	$this->load->model('Page_model');
	
	$this->load->helper('string');
	$this->load->helper('date');	
	$this->load->helper('security');
	$this->load->helper('form');
	$this->load->helper('url');		
	
	$this->load->library('ion_auth');
	$this->load->library('Languages');
	$this->load->library('form_validation');	 
	$this->load->library('image_lib'); 	
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
		$data['page_title'] = lang('calendar');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];
		$data['key'] = $this->setting['cal_apikey'];
		$data['current_version'] = config_item('version');
 
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
			// load a page of events into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(4));	
			$data['allevents'] = $this->calendar->getAllEvents(0, $this->uri->segment(4));
			 
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();	 
	 
			if ($data['allevents']) {  
	 
				debug('Initialize index - loading "calendarlist/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/calendarlist/list', 'nav_content' => $this->setting['current_theme'] . '/backend/calendarlist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/calendarlist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/calendarlist/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
			} else {
				
				debug('Initialize index - loading "calendarlist/table_empty" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/calendarlist/empty', 'nav_content' => $this->setting['current_theme'] . '/backend/calendarlist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/calendarlist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/calendarlist/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}
			
		} else {		
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}     
	 
	}

	/**
    * get_allevents - calendar categories
    * This function is called to get members categories
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_allevents() { 
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) {  
		
			$allevents = $this->calendar->getAllEvents(0, $this->uri->segment(4)); 
			echo json_encode($allevents);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}	

    /**
    * edit - the event source in the database
    *
    ****
    * @access public
    * @ Param $id
    * @ Return string with the last query 
    */	
    function edit($eid) { 

		// set the page language
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']); 
		
		// set the site name, page title, meta keywords and meta description  			
		$data['site_name'] = $this->setting['site_name'];
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];
		$data['key'] = $this->setting['cal_apikey'];
		$data['timezone'] = $this->setting['site_timezone'];
		$data['message'] = "";	
			
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 

			$user = $this->ion_auth->user()->row();
	
			// load a page of events into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5)); 
  			$data['userinfo'] = $this->Member_model->getUserById($user->id); 
			$data['allcategories'] = $this->Category_admin_model->get_categories(0, $this->uri->segment(4));
			$data['groups'] = $this->ion_auth->groups()->result_array();  
			
			$data['events'] = $this->calendar->get_eventByEId($eid);
			if(empty($data['events'])) redirect('admin/queuelist', 301); 
			$data['page_title'] = $data['events']->title; 
			$data['pubDate'] = mdate('%M %d, %Y at %h:%m %a',strtotime($data['events']->pubDate));			
			
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
			
		  // check form data was submitted
			if ($this->input->post('submitEdit')) {	
			
				$config = array( 
					array(
						'field' => 'ic_event_title',
						'label' => lang('calendar_modal_eventname'),
						'rules' => 'trim|required|min_length[3]|max_length[150]|xss_clean'
					),
					array(
						'field' => 'ic_event_desc',
						'label' => lang('calendar_modal_description'),
						'rules' => 'trim|max_length[254]|xss_clean'
					),
					array(
						'field' => 'ic_event_starttime',
						'label' => lang('calendar_modal_eventbegin'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'ic_event_endtime',
						'label' => lang('calendar_modal_eventend'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'userfile1',
						'label' => lang('attach'),
						'rules' => 'trim'
					)    
				);
				
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
			 
				if ($this->form_validation->run() === FALSE) {
					debug('Initialize index - loading "admin/calendarlist" error view');
					$data['message']=(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/calendarlist/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/calendarlist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/calendarlist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/calendarlist/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
				
				} else {
					
					// prepare data for database
					$eids = $data['events']->eid; 
					$event = $data['events']->id; 
					$title = $this->input->post('ic_event_title');
					$backgroundColor = $this->input->post('ic_event_bgcolor');
					$borderColor = $this->input->post('ic_event_bordercolor');
					$textColor = $this->input->post('ic_event_textcolor');
					$description = $this->input->post('ic_event_desc');
					$start = $this->input->post('ic_event_starttime');
					$end = $this->input->post('ic_event_endtime');
					$url = $this->input->post('ic_event_urllink');
					$allDay = $this->input->post('ic_event_allday');
					$auth = $this->input->post('ic_event_shareit');
					$rendering = $this->input->post('ic_event_rendering'); 				
					$location = $this->input->post('ic_event_location');
					$markers_lat = $this->input->post('markers_ulat');
					$markers_lng = $this->input->post('markers_ulng');	  
			  
					$markers_logo = "pin3.png";
					if($rendering == "background") {$allDay = "true";} 
					$status = "";
					$file_element_name = 'userfile1'; 

					if ($status != "error")   {
				   
						$config['upload_path']	= './assets/attachments/';  
						$config['file_name']	= $user->username.'_'.$_FILES[$file_element_name]['name'];
						$config['allowed_types']= $this->setting['attach_allowed_extension'];  
						$config['max_size']		= $this->setting['attach_max_size'];
						$config['xss_clean']	= FALSE;
						$config['encrypt_name'] = FALSE; 

						$this->load->library('upload', $config);
						
						$this->upload->initialize($config);

						if (!$this->upload->do_upload($file_element_name))	{
						
							 $status = 'error'; 
							 $data["message"] = $this->upload->display_errors('', '');
						
						}else {
						
							debug('Initialize upload - loading "home/index" attachment upload');   
						
							$uploaddata = $this->upload->data();			
								
							$this->calendar->attachment($eids, $uploaddata['file_name']); 
							
						}
						@unlink($_FILES[$file_element_name]['name']);
					}						
						
					 
					$this->calendar->update_event($eids, $title, $data['events']->username, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $location, $markers_lat, $markers_lng);

					if ($this->gmaps_model->get_markersById($event)){
						$this->gmaps_admin_model->update_marker2($event, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description);
					}else {
					   if ($this->calendar->get_eventById($event)){
							$this->gmaps_admin_model->add_marker($event, $data['events']->username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description );
						}
					}	 
					 				
					// reload the form
					redirect('admin/calendarlist/edit/'.$eids, 301); 
				}
			
			} else { 
			
					debug('Initialize index - loading "admin/calendarlist" default view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/calendarlist/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/calendarlist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/calendarlist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/calendarlist/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 	
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
	
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
   
			$checkbox[] = $this->security->xss_clean($this->input->post('id'));		
		 
			for($i=0;$i<=$this->calendar->countCalendarEvents();$i++){
				$del_id = $checkbox[$i];
				$this->calendar->delete_event($del_id);
				$this->gmaps_model->delete_marker($del_id);
			}   
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
		
			// check from the database
			$cinfo = $this->calendar->get_eventById($id);
	 
			if ($cinfo) { 
				
				$this->calendar->delete_event($id);			
				$this->gmaps_model->delete_marker($id);
				
				@unlink($cinfo->filename);
				// reload the form
				redirect('admin/calendarlist', 301); 
			} else { 
				echo " <script>
						alert('Alert: ". lang('error_not_found_page_title') ."');
					history.go(-1);
				 </script>";
			} 	
			
		}else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}
		
	}
}

/* End of file calendarlist.php */
/* Location: ./application/controllers/calendarlist.php */