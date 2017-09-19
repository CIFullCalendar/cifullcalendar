<?php
 
/**
 * Page controller class
 *
 * Displays the Pages created by administrators
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/register
 */
 
class Pages extends CI_Controller {

    /*
     * Pages controller class constructor
     */

    function Pages() {
	parent::__construct();
	$this->load->model('Fullcalendar_admin_model','calendar');
	$this->load->model('gmaps_admin_model');	 
	$this->load->model('Member_model');  
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
	
	 /*
     * index function
     *
     * display a custom page
     */
    function index() {
		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('pages');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];   
		
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();
		
			// load a page of custom pages into an array for displaying in the view			
			$data['userinfo'] = $this->Member_model->getUserById($user->id);
			$data['groups'] = $this->ion_auth->groups()->result_array(); 
			
			$data['pagename'] = $this->Page_model->getAllPages(8);				
			$data['allpages'] = $this->Page_model->getAllPages(0, $this->uri->segment(4));	   
			
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
			
			if ($data['allpages']) {
		
				// show the custom pages page
				debug('Initialize index - loading "admin/pages/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/pages/index', 'nav_content' => $this->setting['current_theme'] . '/backend/pages/nav', 'header_content' => $this->setting['current_theme'] . '/backend/pages/header', 'footer_content' => $this->setting['current_theme'] . '/backend/pages/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
			} else {
				// no data... show the 'no pages' page
				debug('Initialize page empty - loading "admin/pages/empty" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/pages/empty', 'nav_content' => $this->setting['current_theme'] . '/backend/pages/nav', 'header_content' => $this->setting['current_theme'] . '/backend/pages/header', 'footer_content' => $this->setting['current_theme'] . '/backend/pages/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}		
		
		}		
		

    }

	/**
    * get_allpages - calendar categories
    * This function is called to get members categories
    ****
    * @access public
    * @ Param none
    * @return none
    */
 	public function get_allpages() { 
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) {  
		
			$allpages = $this->Page_model->get_pages(0, $this->uri->segment(4)); 
			echo json_encode($allpages);
		}else {			
			debug('Initialize index - loading "login/index" view');
			redirect('/profile/login', 301);
		}
	}	
	
    /*
     * add function
     *
     * display 'page/add' view, validate form data and add new page to the database
     */
    function add() {
		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('pages');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];    
			
		$data[] = '';	 
		
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
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
			
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();			
			
			if ($this->input->post('page_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('admin/pages', 301);}			
			} 			
			
			// check form data was submitted
			if ($this->input->post('page_submit')) {
				// set up form validation config
				$config = array(
					array(
						'field' => 'title',
						'label' => lang('page_title'),
						'rules' => 'trim|required|min_length[5]|max_length[150]|xss_clean'
					),
					array(
						'field' => 'content',
						'label' => lang('page_content'),
						'rules' => 'trim|required|min_length[5]'
					),
					array(
						'field' => 'meta_keywords',
						'label' => lang('page_meta_keywords'),
						'rules' => 'trim|max_length[255]|xss_clean'
					),
					array(
						'field' => 'meta_description',
						'label' => lang('page_meta_description'),
						'rules' => 'trim|max_length[255]|xss_clean'
					),
					array(
						'field' => 'access',
						'label' => lang('access'),
						'rules' => 'trim|required|max_length[2]|xss_clean'
					)
				);
				
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
				
				// validate the form data
				if ($this->form_validation->run() === FALSE) {
					
					// validation failed - reload page with error message(s)
					debug('Initialize index - loading "admin/pages" validation failed');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/pages/add', 'nav_content' => $this->setting['current_theme'] . '/backend/pages/nav', 'header_content' => $this->setting['current_theme'] . '/backend/pages/header', 'footer_content' => $this->setting['current_theme'] . '/backend/pages/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
		
				} else {
					
					debug('Initialize index - loading "admin/pages" validation successful'); 
					$title = $this->input->post('title');
					$content = $this->input->post('content');
					$meta_keywords = str_replace('"','',$this->input->post('meta_keywords'));
					$meta_description = str_replace('"','',$this->input->post('meta_description'));
					$access = $this->input->post('access');
					
					$this->Page_model->addPage($user, $title, $content, $meta_keywords, $meta_description, $access);
				  
					redirect('/admin/pages', 301); 
				
				}
			} else {
				// form not submitted so just show the form 
				debug('Initialize index - loading "admin/pages/add" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/pages/add', 'nav_content' => $this->setting['current_theme'] . '/backend/pages/nav', 'header_content' => $this->setting['current_theme'] . '/backend/pages/header', 'footer_content' => $this->setting['current_theme'] . '/backend/pages/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}
			
		}else{
			redirect('admin/login', 301); 
		}
    }

	/*
	* edit page function
	*
	* display 'page/edit' view, validate form data and modify page
	*/

    function edit($id) {
		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('pages');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];   
			
		$data[] = '';	
		
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();
			
			// load a page of events into an array for displaying in the view
			$data['userinfo'] = $this->Member_model->getUserById($user->id);
			$data['groups'] = $this->ion_auth->groups()->result_array(); 
			$data['pageinfo'] = $this->Page_model->getPageById($id);
			$data['pagename'] = $this->Page_model->getAllPages(8);				
			$data['allpages'] = $this->Page_model->getAllPages(0);				

			if(empty($data['pageinfo'])) redirect('admin/pages', 301);
	
			$data['pubdate'] = mdate('%M %d, %Y at %h:%m %a',strtotime($data['pageinfo']->pubdates));
	
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

			if ($this->input->post('page_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('admin/pages', 301);}			
			} 
			
			// check form data was submitted
			if ($this->input->post('page_submit')) {
				
				// set up form validation config
				$config = array(
				array(
					'field' => 'title',
					'label' => lang('page_title'),
					'rules' => 'trim|required|min_length[5]|max_length[150]|xss_clean'
				),
				array(
					'field' => 'content',
					'label' => lang('page_content'),
					'rules' => 'trim|required|min_length[5]'
				),
				array(
					'field' => 'meta_keywords',
					'label' => lang('page_meta_keywords'),
					'rules' => 'max_length[255]|xss_clean'
				),
				array(
					'field' => 'meta_description',
					'label' => lang('page_meta_description'),
					'rules' => 'max_length[255]|xss_clean'
				),
				array(
					'field' => 'access',
					'label' => lang('access'),
					'rules' => 'trim|required|xss_clean'
				)
				);
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
				// validate the form data
				debug('validate form data');
				if ($this->form_validation->run() === FALSE) {
					
					debug('validation failed - reload page with error message(s)');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/pages/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/pages/nav', 'header_content' => $this->setting['current_theme'] . '/backend/pages/header', 'footer_content' => $this->setting['current_theme'] . '/backend/pages/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
				} else {
					
					$title = $this->input->post('title');
					$content = auto_typography($this->input->post('content'));
					$meta_keywords = str_replace('"','',$this->input->post('meta_keywords'));
					$meta_description = str_replace('"','',$this->input->post('meta_description'));
					$access = $this->input->post('access');
					
					// update the page
					$this->Page_model->updatePage($id, $title, $content, $meta_keywords, $meta_description, $access); 
					
					redirect('/admin/pages/edit/'.$id, 301);
					
				}
			} else {
				// form not submitted so load the data and show the form
				debug('Initialize index - loading "admin/pages/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/pages/edit', 'nav_content' => $this->setting['current_theme'] . '/backend/pages/nav', 'header_content' => $this->setting['current_theme'] . '/backend/pages/header', 'footer_content' => $this->setting['current_theme'] . '/backend/pages/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				
			}			
			
		} else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');
			redirect('/admin/login', 301);

		} 
	  

    }

    /**
    * del_selected - delete profile in the database
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
			 
			for($i=0;$i<=$this->Page_model->countPages();$i++){
				$del_id = $checkbox[$i]; 
			 	$this->Page_model->delPage($del_id, $user->username); 
			}  
				 
		}else {
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
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
	
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();
			
			$username = $user->username;		
			$delPage = $this->Page_model->getPageById($id);
			
			if ($delPage && $username) { 
				$this->Page_model->delPage($id, $username); 	
				redirect('admin/pages', 301);
 				
			}else {
			echo "<script>
					alert('Alert: ". lang('error_not_found_page_title') ."');
					history.go(-1);
				 </script>";
			}
			
		}else{
			redirect('admin/login', 301); 
		}
	}
	

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
