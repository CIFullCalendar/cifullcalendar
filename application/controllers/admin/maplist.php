<?php

 /**
 * Maplist controller class
 *
 * Displays the users source list
 *
 * @package		cifullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		index.php/maplist
 */ 
 
class Maplist extends CI_Controller {

    /*
     *  Controller class constructor
     */

   function Maplist() {
	parent::__construct(); 
	$this->load->model('Fullcalendar_admin_model','calendar');
	$this->load->model('gmaps_admin_model');
	$this->load->model('category_model');
	$this->load->model('Member_model'); 
	$this->load->model('Page_model');
	
	$this->load->helper('date');	
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
		$data['page_title'] = lang('maps');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['key'] = $this->setting['cal_apikey'];
		$data['current_version'] = $this->setting['current_version'];   	
 
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
			
			$data['allmarkers'] = $this->gmaps_admin_model->get_allmarkers(0, $this->uri->segment(4));			
			$data['allcategories'] = $this->category_model->getAllCategories(0, $this->uri->segment(4));			
			$data['allevents'] = $this->calendar->getAllEvents(0, $this->uri->segment(4)); 
			
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();	
			
			if ($data['allmarkers']) {  
	 
				debug('Initialize index - loading "maps/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/gmapslist/list', 'nav_content' => $this->setting['current_theme'] . '/backend/gmapslist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/gmapslist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/gmapslist/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
			} else {
				
				debug('Initialize index - loading "maps/table_empty" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/gmapslist/empty', 'nav_content' => $this->setting['current_theme'] . '/backend/gmapslist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/gmapslist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/gmapslist/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}
			
		} else {			 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}     
	 
	}
	
	/**
    * get_allmaps - maps locations
    * This function is called to get maps locations
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_allmaps() { 
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) {  
		
			$allmarkers = $this->gmaps_admin_model->get_allmarkers(0, $this->uri->segment(4)); 
			echo json_encode($allmarkers);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}	
	
    /**
    * edit - the event locations in the database
    *
    ****
    * @access public
    * @ Param $id
    * @ Return string with the last query 
    */	
    function edit($id) { 

		// set the page language
		$data['lang'] = $this->setting['site_language'];	
		$this->languages->get_lang($data['lang']);
		
		// set the site name, page title, meta keywords and meta description  
		$data['site_name'] = $this->setting['site_name']; 
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['key'] = $this->setting['cal_apikey'];
		$data['current_version'] = $this->setting['current_version']; 
			
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) {  
		
			$user = $this->ion_auth->user()->row();
			
 			// load a page of markers into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5)); 
			$data['userinfo'] = $this->Member_model->getUserById($user->id); 
			
			$data['markers'] = $this->gmaps_admin_model->get_markersById($id);  
			if(empty($data['markers'])) redirect('admin/maplist', 301);
			$data['page_title'] = $data['markers']->markers_name; 
			$data['pubDate'] = mdate('%M %d, %Y at %h:%m %a',strtotime($data['markers']->pubDate));		
	 
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
						'field' => 'markers_address',
						'label' => lang('admin_table_markers_address'),
						'rules' => 'trim|required|max_length[250]|xss_clean'
					),
					array(
						'field' => 'markers_lat',
						'label' => lang('lat'),
						'rules' => 'trim|required|is_numeric|xss_clean'
					),						
					array(
						'field' => 'markers_lng',
						'label' => lang('lng'),
						'rules' => 'trim|required|is_numeric|xss_clean'
					) 
				);
				
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
			 
				if ($this->form_validation->run() === FALSE) {
					 
					echo " <script>
							alert('Alert: ".  form_error('markers_address') ." ".  form_error('markers_lat') ." ".  form_error('markers_lng') ."');
						history.go(-1);
					 </script>";   
				
				} else {
					 
					// prepare data for database
					$event = $data['markers']->event_id;   
					$location = $this->input->post('markers_address');  
					$markers_lat = $this->input->post('markers_lat');  
					$markers_lng = $this->input->post('markers_lng');  
									
					$markers_logo = "pin2.png";  
					
					$this->gmaps_admin_model->update_marker($event, $markers_logo, $location, $markers_lat, $markers_lng);
					$this->calendar->update_eventForMarkers($event, $location, $markers_lat, $markers_lng);

								 
					// reload the form
					redirect('admin/maplist', 301); 
				 
				} 
				
			} else { 
			
				debug('Initialize index - loading "Maps/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/gmapslist/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/gmapslist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/gmapslist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/gmapslist/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 		 
					 
			}		 
			
		 		
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}
    }	

    /**
    * Delete - delete map locations in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function del_selected() {  
	
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) {  
		   
			$checkbox[] = $this->input->post('event_id');		
		 
			for($i=0;$i<=$this->calendar->countCalendarEvents();$i++){
				$del_id = $checkbox[$i];
				$this->calendar->delete_event($del_id); 
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
		
			$marker_valid = $this->gmaps_admin_model->get_markersById($id);
			
			if($marker_valid){
				
				$this->calendar->delete_event($marker_valid->event_id);	
				
				// reload the form
				redirect('admin/maplist', 301); 
			}else {
				
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

/* End of file Maplist.php */
/* Location: ./application/controllers/Maplist.php */