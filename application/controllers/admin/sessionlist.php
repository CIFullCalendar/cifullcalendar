<?php

 /**
 * Sessionlist controller class
 *
 * Displays the users source list
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		index.php/sessionlist
 */ 
 
class Sessionlist extends CI_Controller {

    /*
     *  Controller class constructor
     */

   function Sessionlist() {
	parent::__construct();  
	$this->load->model('Fullcalendar_admin_model','calendar');
	$this->load->model('gmaps_admin_model');
	$this->load->model('Member_model');    
	$this->load->model('Sessions_model'); 		
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
		$data['page_title'] = lang('users');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
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
			$data['allsessions'] = $this->Sessions_model->getAllSessions(0, $this->uri->segment(4));
	
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();
	
			if ($data['allsessions']) {  
	 
				debug('Initialize index - loading "sessions/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/sessionlist/list', 'nav_content' => $this->setting['current_theme'] . '/backend/sessionlist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/sessionlist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/sessionlist/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
			} else {
				
				debug('Initialize index - loading "sessions/table_empty" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/sessionlist/empty', 'nav_content' => $this->setting['current_theme'] . '/backend/sessionlist/nav', 'header_content' => $this->setting['current_theme'] . '/backend/sessionlist/header', 'footer_content' => $this->setting['current_theme'] . '/backend/sessionlist/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}
			
		} else {	
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');			
			redirect('admin/login', 301); 
		}     
	 
	}
	
	/**
    * get_allsessions - all sessions info
    * This function is called to get users information
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_allsessions() { 
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$allsessions = $this->Sessions_model->getAllSessions(0, $this->uri->segment(4)); 
			echo json_encode($allsessions);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}	
 
    /**
    * del - delete profile in the database
    *
    ****
    * @access public
    * @ Param none
    * @ Return string with the last query 
    */		
	function del_selected() {  
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 

			$user = $this->ion_auth->user()->row(); 
			
			$checkbox[] = $this->input->post('id');	
			 
			if ($user->username) { 				
			 
				for($i=0;$i<=$this->Sessions_model->countSessions();$i++){
					$del_id = $checkbox[$i]; 
				//	$data['offset'] = $i;
					$this->Sessions_model->delSessions($del_id); 
				}  
					
			}else {redirect('admin/sessionlist', 301);  }
			
		}else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}
		
	}
 

}

/* End of file Sessionlist.php */
/* Location: ./application/controllers/Sessionlist.php */