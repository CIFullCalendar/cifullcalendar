<?php
 
/**
 * Settings management controller class
 *
 * Allows admin to edit site settings
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/admin/login
 */
  
 
class Settings extends CI_Controller {

    /*
     * Site_settings controller class constructor
     */

    function Settings() {
	parent::__construct();
	$this->load->model('Fullcalendar_admin_model','calendar'); 
	$this->load->model('gmaps_model');
	$this->load->model('Member_model');
	$this->load->model('Notification_model'); 
	$this->load->model('Setting_model'); 
	$this->load->model('Page_model');
		
	$this->load->helper('url'); 
	$this->load->helper('form'); 
		
	$this->load->library('ion_auth');
	$this->load->library('Languages');
	$this->load->library('form_validation');	
	// load all settings into an array
	$this->setting = $this->Setting_model->getEverySetting();
    }

    /*
     * index function (default)
     * 
     * display 'site_settings/edit' view, validate form data and update the database
     */

    function index() {

		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('settings_basic_name');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 		
		
		$data['site_email'] = $this->setting['site_email'];
		$data['site_timezone'] = $this->setting['site_timezone'];		
		$data['site_longitude'] = $this->setting['site_longitude'];		
		$data['site_latitude'] = $this->setting['site_latitude'];
		$data['cal_apikey'] = $this->setting['cal_apikey'];		
		$data['debug'] = $this->setting['debug'] > 0 ? 'CHECKED' : ''; 
		$data['captcha'] = $this->setting['captcha_verification'] > 0 ? 'CHECKED' : '';		
				
		$data['nav_class_b'] = 'class="active"';	
		$data['nav_class_c'] = '';		 
		$data['nav_class_p'] = '';	
 		$data['nav_class_i'] = '';	
		$data['nav_class_a'] = '';	
		$data['nav_class_t'] = '';	
		$data['nav_class_tpl'] = '';
		
		$data['message'] = ''; 
		
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row(); 
		
 			// load a page of users into an array for displaying in the view			
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(4));	  
	     
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
   
			if ($this->input->post('settings_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('admin/settings', 301);}			
			}   
   
			// check form was submitted
			if ($this->input->post('settings_submit')) { 
					$config = array(
					array(
						'field' => 'site_name',
						'label' => lang('settings_form_site_name'),
						'rules' => 'trim|required|min_length[5]|max_length[100]|xss_clean'
					),
					array(
						'field' => 'site_email',
						'label' => lang('settings_form_site_email'),
						'rules' => 'trim|required|valid_email|min_length[5]|max_length[100]|xss_clean'
					),
					array(
						'field' => 'meta_keywords',
						'label' => lang('settings_form_meta_keywords'),
						'rules' => 'trim|max_length[255]|xss_clean'
					),
					array(
						'field' => 'meta_description',
						'label' => lang('settings_form_meta_description'),
						'rules' => 'trim|max_length[255]|xss_clean'
					),
					array(
						'field' => 'site_timezone',
						'label' => lang('settings_form_timezone'),
						'rules' => 'trim|required|min_length[9]|max_length[100]|xss_clean'
					),
					array(
						'field' => 'site_latitude',
						'label' => lang('settings_form_latitude'),
						'rules' => 'trim|required|min_length[5]|max_length[100]|xss_clean'
					),
					array(
						'field' => 'site_longitude',
						'label' => lang('settings_form_longitude'),
						'rules' => 'trim|required|min_length[5]|max_length[100]|xss_clean'
					),
					array(
						'field' => 'cal_apikey',
						'label' => lang('settings_form_apikey'),
						'rules' => 'trim|xss_clean'
					) 
					);
					
					$this->form_validation->set_error_delimiters('', '');
					$this->form_validation->set_rules($config); 
				
				// validate the form data
				debug('Initialize index - validate form data "settings/index" ');
				if ($this->form_validation->run() === FALSE) {
				 
					debug('Initialize index - loading "settings/index" form validation failed view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/index', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
					 
				} else { 
				 
					// update settings with form values
					$this->Setting_model->updateSetting('site_name', $this->input->post('site_name'));
					$this->Setting_model->updateSetting('site_email', $this->input->post('site_email'));
					$this->Setting_model->updateSetting('meta_keywords', $this->input->post('meta_keywords'));
					$this->Setting_model->updateSetting('meta_description', $this->input->post('meta_description'));
					$this->Setting_model->updateSetting('site_timezone', $this->input->post('site_timezone'));
					$this->Setting_model->updateSetting('site_latitude', $this->input->post('site_latitude'));
					$this->Setting_model->updateSetting('site_longitude', $this->input->post('site_longitude'));
					$this->Setting_model->updateSetting('cal_apikey', $this->input->post('cal_apikey'));
					$this->Setting_model->updateSetting('debug', isset($_POST['debug']) ? 1 : 0);
					$this->Setting_model->updateSetting('captcha_verification', isset($_POST['captcha']) ? 1 : 0);
			  
					// update setting array with updated values
					$this->setting = $this->Setting_model->getEverySetting();
					
					// prepare data to display in the view 
					$data['page_title'] = $this->setting['site_name'];
					$data['meta_keywords'] = $this->setting['meta_keywords'];
					$data['meta_description'] = $this->setting['meta_description'];  
					$data['current_version'] = $this->setting['current_version'];
					$data['site_timezone'] = $this->setting['site_timezone'];
					$data['site_latitude'] = $this->setting['site_latitude'];
					$data['site_longitude'] = $this->setting['site_longitude'];
					$data['cal_apikey'] = $this->setting['cal_apikey'];
					$data['debug'] = $this->setting['debug'] > 0 ? 'CHECKED' : '';
					$data['captcha'] = $this->setting['captcha_verification'] > 0 ? 'CHECKED' : '';
					
					// reload the form
					debug('Initialize index - loading "settings/index" validation successfully view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/index', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
				}
			} else {
				// form not submitted so just show the form
				debug('Initialize index - loading "settings/index" validation unsuccessful view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/index', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data);
			}
		 
	
		} else {
		// user not found, redirect to users list
		debug('Initialize index - loading "login/index" view');
		redirect('/admin/login', 301);

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
		$data['page_title'] = lang('settings_cal_name');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 		
		
		$data['site_timezone'] = $this->setting['site_timezone'];	
		
		$data['nav_class_b'] = '';	
		$data['nav_class_c'] = 'class="nav-item active open"';		 
		$data['nav_class_p'] = '';	
 		$data['nav_class_i'] = '';	
		$data['nav_class_a'] = '';	
		$data['nav_class_t'] = '';	
		$data['nav_class_tpl'] = ''; 	 
 
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();  

 			// load a page of events into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5));	 
			$data['userinfo'] = $this->Member_model->getUserById($user->id); 
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}		
			  
			// prepare data to display in the view  
			$data['defaultview'] = $this->setting['cal_defaultview'];
			$data['header_left'] = $this->setting['cal_header_left']; 
			$data['header_center'] = $this->setting['cal_header_center']; 
			$data['header_right'] = $this->setting['cal_header_right']; 			 
			$data['firstday'] = $this->setting['cal_firstday'];   
			$data['hiddendays'] = $this->setting['cal_hiddendays']; 
			$data['businessdays'] = $this->setting['cal_businessdays']; 
			$data['businessstart'] = $this->setting['cal_businessstart']; 
			$data['businessend'] = $this->setting['cal_businessend']; 
			$data['editable'] = $this->setting['cal_editable']; 			
			$data['weeknumbers'] = $this->setting['cal_weeknumbers'];   
			$data['eventlimit'] = $this->setting['cal_eventlimit'];   
			$data['alldayslot'] = $this->setting['cal_alldayslot'];   
			$data['slotduration'] = $this->setting['cal_slotduration'];  			 
			$data['slotlabeling'] = $this->setting['cal_slotlabeling'];  			 
			$data['aspectratio'] = $this->setting['cal_aspectratio'];   
			$data['mintime'] = $this->setting['cal_mintime'];   
			$data['maxtime'] = $this->setting['cal_maxtime'];   
			$data['isrtl'] = $this->setting['cal_isrtl'];   
  
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();	   
  
			if ($this->input->post('calendar_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('admin/settings', 301);}			
			}
			
			
			if ($this->input->post('calendar_submit')) { 
					$config = array(
					array(
						'field' => 'cal_defaultview',
						'label' => lang('cal_defaultview'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'cal_header_left',
						'label' => lang('cal_header_left'),
						'rules' => 'trim|xss_clean'
					),					
					array(
						'field' => 'cal_header_center',
						'label' => lang('cal_header_center'),
						'rules' => 'trim|xss_clean'
					),					
					array(
						'field' => 'cal_header_right',
						'label' => lang('cal_header_right'),
						'rules' => 'trim|xss_clean'
					),					
					array(
						'field' => 'cal_hiddendays',
						'label' => lang('cal_hiddendays'),
						'rules' => 'trim|xss_clean'
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
						'field' => 'cal_editable',
						'label' => lang('cal_editable'),
						'rules' => 'trim|required|xss_clean'
					),					
					array(
						'field' => 'cal_isrtl',
						'label' => lang('cal_isrtl'),
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
						'field' => 'cal_alldayslot',
						'label' => lang('cal_alldayslot'),
						'rules' => 'trim|required|xss_clean'
					),						
					array(
						'field' => 'cal_slotduration',
						'label' => lang('cal_slotduration'),
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
						'field' => 'cal_aspectratio',
						'label' => lang('cal_aspectratio'),
						'rules' => 'trim|required|xss_clean'
					),					
					array(
						'field' => 'cal_eventlimit',
						'label' => lang('cal_eventlimit'),
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
					debug('Initialize index - loading "settings/fullcalendar" failed view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/fullcalendar', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					 
				} else { 
				 
					// update theme with form values
					$this->Setting_model->updateSetting('cal_defaultview', $this->input->post('cal_defaultview'));
					$this->Setting_model->updateSetting('cal_header_left', $this->input->post('cal_header_left'));
					$this->Setting_model->updateSetting('cal_header_center', $this->input->post('cal_header_center')); 
					$this->Setting_model->updateSetting('cal_header_right', $this->input->post('cal_header_right')); 
					$this->Setting_model->updateSetting('cal_hiddendays', $this->input->post('cal_hiddendays')); 
					$this->Setting_model->updateSetting('cal_editable', $this->input->post('cal_editable'));
					$this->Setting_model->updateSetting('cal_firstday', $this->input->post('cal_firstday')); 
					$this->Setting_model->updateSetting('cal_weeknumbers', $this->input->post('cal_weeknumbers')); 
					$this->Setting_model->updateSetting('cal_eventlimit', $this->input->post('cal_eventlimit')); 					 
					$this->Setting_model->updateSetting('cal_alldayslot', $this->input->post('cal_alldayslot')); 					 
					$this->Setting_model->updateSetting('cal_slotduration', $this->input->post('cal_slotduration')); 					 
					$this->Setting_model->updateSetting('cal_slotlabeling', $this->input->post('cal_slotlabeling')); 					 
					$this->Setting_model->updateSetting('cal_slotlabelformat', $this->input->post('cal_slotlabelformat')); 					 
					$this->Setting_model->updateSetting('cal_businessdays', $this->input->post('cal_businessdays')); 					 
					$this->Setting_model->updateSetting('cal_businessstart', $this->input->post('cal_businessstart')); 					 
					$this->Setting_model->updateSetting('cal_businessend', $this->input->post('cal_businessend')); 	 
					$this->Setting_model->updateSetting('cal_aspectratio', $this->input->post('cal_aspectratio')); 
					$this->Setting_model->updateSetting('cal_mintime', $this->input->post('cal_mintime')); 
					$this->Setting_model->updateSetting('cal_maxtime', $this->input->post('cal_maxtime')); 
					$this->Setting_model->updateSetting('cal_isrtl', $this->input->post('cal_isrtl')); 
			  
					// update setting array with updated values
					$this->setting = $this->Setting_model->getEverySetting();  
					
					// reload the form 
				debug('Initialize index - loading "settings/calendar_settings" default submission view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/calendar_settings', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
				}
			 
			} else {
			
				// form not submitted so just show the form 
				debug('Initialize index - loading "settings/calendar_settings" default submission view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/calendar_settings', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
			}
		
		} else {			 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}   
    }	
		
	/*
     * picture function
     *
     * display the settings of the picture preference
     */	
	function picfile() {
	
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('settings_pic_name');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 		
		
		$data['nav_class_b'] = '';	
		$data['nav_class_c'] = '';		 
		$data['nav_class_p'] = 'class="nav-item active open"';
 		$data['nav_class_i'] = '';	
		$data['nav_class_a'] = '';	
		$data['nav_class_t'] = '';	
		$data['nav_class_tpl'] = '';
		
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();  
 			
			// load a page of events into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5));				
			$data['userinfo'] = $this->Member_model->getUserById($user->id);	
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
			// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}		
	
			// prepare data to display in the view 
			$data['max_upload_width'] = $this->setting['profile_max_upload_width'];
			$data['max_upload_height'] = $this->setting['profile_max_upload_height']; 
			$data['max_upload_filesize'] = $this->setting['profile_max_upload_filesize'];  
			$data['allowed_extensions'] = $this->setting['profile_allowed_extensions']; 
			
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();	 			
			
			if ($this->input->post('profile_pic_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('admin/settings', 301);}			
			}  
  
			if ($this->input->post('profile_pic_submit')) { 
					$config = array(
					array(
						'field' => 'max_upload_width',
						'label' => lang('profile_max_upload_width'),
						'rules' => 'trim|required|is_natural|min_length[3]|max_length[6]|xss_clean'
					),
					array(
						'field' => 'max_upload_height',
						'label' => lang('profile_max_upload_height'),
						'rules' => 'trim|required|is_natural|min_length[3]|max_length[6]|xss_clean'
					),
					array(
						'field' => 'max_upload_filesize',
						'label' => lang('profile_max_upload_filesize'),
						'rules' => 'trim|required|is_natural|min_length[3]|max_length[6]|xss_clean'
					),
					array(
						'field' => 'allowed_extensions',
						'label' => lang('profile_allowed_extensions'),
						'rules' => 'trim|required|min_length[3]|max_length[70]|xss_clean'
					)  
					);
					
					$this->form_validation->set_error_delimiters('', '');
					$this->form_validation->set_rules($config); 
				
				// validate the form data
				debug('Initialize index - validate form data "settings/index" ');
				if ($this->form_validation->run() === FALSE) {
				 
					// form not submitted so just show the form 
					debug('Initialize index - loading "settings/pic_file" view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/pic_file', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					 
				} else { 
				 
					// update theme with form values
					$this->Setting_model->updateSetting('profile_max_upload_width', $this->input->post('max_upload_width'));
					$this->Setting_model->updateSetting('profile_max_upload_height', $this->input->post('max_upload_height'));
					$this->Setting_model->updateSetting('profile_max_upload_filesize', $this->input->post('max_upload_filesize'));
					$this->Setting_model->updateSetting('profile_allowed_extensions', $this->input->post('allowed_extensions'));
			  
					// update setting array with updated values
					$this->setting = $this->Setting_model->getEverySetting();  
					
					// reload the form 
					debug('Initialize index - loading "Theme/index" validation successful view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/pic_file', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
				}
			 
			} else {
			
				// form not submitted so just show the form 
				debug('Initialize index - loading "Theme/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/pic_file', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 					
			}
		
		} else {			 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}   
    }
	
	/*
     * icsfile function
     *
     * display the settings of the ICS file requirements
     */	
	function icsfile() {
	
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('settings_file_name');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 

		$data['nav_class_b'] = '';	
		$data['nav_class_c'] = '';		 
		$data['nav_class_p'] = '';
 		$data['nav_class_i'] = 'class="nav-item active open"';
		$data['nav_class_a'] = '';	
		$data['nav_class_t'] = '';	
		$data['nav_class_tpl'] = ''; 
		  
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();   

 			// load a page of events into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5));	 
			$data['userinfo'] = $this->Member_model->getUserById($user->id); 
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}		
			  
			// prepare data to display in the view  
			$data['sync_path_location'] = $this->setting['sync_path_location'];
			$data['sync_allowed_extension'] = $this->setting['sync_allowed_extension']; 
			$data['sync_max_size'] = $this->setting['sync_max_size'];  
			
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();	 			
			
			if ($this->input->post('file_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('admin/settings', 301);}			
			} 
  
			if ($this->input->post('file_submit')) { 
					$config = array(
					array(
						'field' => 'sync_path_location',
						'label' => lang('sync_path_location'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'sync_allowed_extension',
						'label' => lang('sync_allowed_extension'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'sync_max_size',
						'label' => lang('sync_max_size'),
						'rules' => 'trim|required|is_natural|min_length[3]|max_length[6]|xss_clean'
					)   
					);
					
					$this->form_validation->set_error_delimiters('', '');
					$this->form_validation->set_rules($config); 
				
				// validate the form data
				debug('Initialize index - validate form data "settings/index" ');
				if ($this->form_validation->run() === FALSE) {
				 
					// form not submitted so just show the form 
					debug('Initialize index - loading "Theme/index" view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/ics_file', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					 
				} else { 
				 
					// update theme with form values
					$this->Setting_model->updateSetting('sync_path_location', $this->input->post('sync_path_location'));
					$this->Setting_model->updateSetting('sync_allowed_extension', $this->input->post('sync_allowed_extension'));
					$this->Setting_model->updateSetting('sync_max_size', $this->input->post('sync_max_size')); 
			  
					// update setting array with updated values
					$this->setting = $this->Setting_model->getEverySetting();  
					
					// reload the form 
					debug('Initialize index - loading "settings/ics_file" validation successful view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/ics_file', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
				}
			 
			} else {
			
				// form not submitted so just show the form 
				debug('Initialize index - loading "Theme/index" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/ics_file', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
			}
		
		} else {			 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}   
    }

	/*
     * icsfile function
     *
     * display the settings of the ICS file requirements
     */	
	function attachments() {
	
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('settings_attach_name');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 	

		$data['nav_class_b'] = '';	
		$data['nav_class_c'] = '';		 
		$data['nav_class_p'] = '';
 		$data['nav_class_i'] = '';
		$data['nav_class_a'] = 'class="nav-item active open"';
		$data['nav_class_t'] = '';	
		$data['nav_class_tpl'] = '';
		 
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row(); 

			// load a page of events into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5));	
			$data['userinfo'] = $this->Member_model->getUserById($user->id);  	
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}		
			
			// prepare data to display in the view  
			$data['attach_allowed_extension'] = $this->setting['attach_allowed_extension'];
			$data['attach_max_size'] = $this->setting['attach_max_size']; 
			
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();	 			
			
			if ($this->input->post('file_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('admin/settings', 301);}			
			} 
  
			if ($this->input->post('file_submit')) { 
					$config = array(
					array(
						'field' => 'attach_allowed_extension',
						'label' => lang('attach_allowed_extension'),
						'rules' => 'trim|required|xss_clean'
					),
					array(
						'field' => 'attach_max_size',
						'label' => lang('attach_max_size'),
						'rules' => 'trim|required|is_natural|min_length[3]|max_length[6]|xss_clean'
					)   
					);
					
					$this->form_validation->set_error_delimiters('', '');
					$this->form_validation->set_rules($config); 
				
				// validate the form data
				debug('Initialize index - validate form data "settings/index" ');
				if ($this->form_validation->run() === FALSE) {
				 
					// form not submitted so just show the form 
					debug('Initialize index - loading "Theme/index" view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/attach_file', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					 
				} else { 
				 
					// update theme with form values
					$this->Setting_model->updateSetting('attach_allowed_extension', $this->input->post('attach_allowed_extension'));
					$this->Setting_model->updateSetting('attach_max_size', $this->input->post('attach_max_size'));
			  
					// update setting array with updated values
					$this->setting = $this->Setting_model->getEverySetting();  
					
					// reload the form 
					debug('Initialize index - loading "settings/attach_file" validation successful view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/attach_file', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
				}
			 
			} else {
			
				// form not submitted so just show the form 
				debug('Initialize index - loading "settings/attach_file" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/attach_file', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
			}
		
		} else {			 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}   
    }

    /*
     * theme function
     *
     * display the settings and language of the theme
     */	
	function theme() {
	
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('settings_theme_name');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 	

		$data['nav_class_b'] = '';	
		$data['nav_class_c'] = '';		 
		$data['nav_class_p'] = '';
 		$data['nav_class_i'] = '';
		$data['nav_class_a'] = '';
		$data['nav_class_t'] = 'class="nav-item active open"';	
		$data['nav_class_tpl'] = ''; 
		  
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();  
		
			// load a page of events into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5));			 
			
			$data['userinfo'] = $this->Member_model->getUserById($user->id);
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
			// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}		

			
			// load available site themes into an array
			$themepath = "./application/views/";
			$data['themes'] = glob($themepath . '*', GLOB_ONLYDIR);
			
			// get name of current site theme
			$current_theme = ucwords(strtolower(str_replace("_", " ", $this->Setting_model->getSettingByName('current_theme'))));
			// update the data to show just the theme names and not the paths
			foreach ($data['themes'] as $theme => $key) {
				$data['themes'][$theme] = ucwords(strtolower(str_replace("_", " ", str_ireplace($themepath, '', $data['themes'][$theme]))));
				if ($data['themes'][$theme] == $current_theme) {
					// when the current theme is found, store the name
					$data['selected_theme'] = $theme;
				}
			} 
			
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();	 			
			
			if ($this->input->post('theme_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('admin/settings', 301);}			
			}   			
 
			if ($this->input->post('theme_submit')) {
				debug('form was submitted');
				// set up form validation config
				$config = array(
				array(
					'field' => 'theme',
					'label' => 'theme',
					'rules' => 'trim|required|xss_clean'
				)
				);
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
 	 
				if ($this->form_validation->run() === FALSE) { 
				
					// validation failed - reload page with error message(s) 
					debug('Initialize index - loading "settings/index" form validation failed view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/theme', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
				} else {
				 		
					// update settings with form values
					$this->Setting_model->updateSetting('current_theme', strtolower(str_replace(" ","_",$data['themes'][$this->input->post('theme')])));
					$this->Setting_model->updateSetting('site_language', $this->input->post('language'));
 
					// prepare data to display in the view
					$data['themes'] = glob($themepath . '*', GLOB_ONLYDIR);
					// get name of current site theme
					$current_theme = ucwords(strtolower(str_replace("_", " ", $this->Setting_model->getSettingByName('current_theme'))));
					
					// update the data to show just the theme names and not the paths
					foreach ($data['themes'] as $theme => $key) {
						$data['themes'][$theme] = ucwords(strtolower(str_replace("_", " ", str_ireplace($themepath, '', $data['themes'][$theme]))));
						if ($data['themes'][$theme] == $current_theme) {
						// when the current theme is found, store the name
						$data['selected_theme'] = $theme;
						}
					}
										
					// update setting array with updated values
					$this->setting = $this->Setting_model->getEverySetting();
					
					// validation successful
					debug('Initialize index - loading "settings/theme" validation successful view');
					redirect('admin/settings/theme', 301); 

				}
			
			} else {
			
				// form not submitted so just show the form 
				debug('Initialize index - loading "settings/theme" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/theme', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
			}
		
		} else {			 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}   
    }
	
    /*
     * template function
     *
     * display the template settings
     */	
	function template($notify_type = "notify_message") {
	
		// set the page template, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['page_title'] = lang('settings_template_name');
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version']; 	
 
		$data['nav_class_b'] = '';	
		$data['nav_class_c'] = '';		 
		$data['nav_class_p'] = '';
 		$data['nav_class_i'] = '';
		$data['nav_class_a'] = '';
		$data['nav_class_t'] = '';	
		$data['nav_class_tpl'] = 'class="nav-item active open"';	 
		  
		// check if user is logged in
	    if ($this->ion_auth->is_admin()) { 
		
			$user = $this->ion_auth->user()->row();   
		
			// load a page of events into an array for displaying in the view
			$data['pagename'] = $this->Page_model->getAllPages(8, $this->uri->segment(5));			 
			
			$data['userinfo'] = $this->Member_model->getUserById($user->id);
			
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $data['userinfo']->image,  $data['userinfo']->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $data['userinfo']->image;;
			} else {
			// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}		
			
			// prepare data to display in the view  
			$data['msg_subject'] = $this->Notification_model->getTableField(array('types' => $notify_type), 'subject');
			$data['msg_body'] = $this->Notification_model->getTableField(array('types' => $notify_type), 'body');	
			$data['notify_type'] = $this->Notification_model->getTableField(array('types' => $notify_type), 'types');	
			$data['msg_id'] = $this->Notification_model->getTableField(array('types' => $notify_type), 'id');	
			 
			// display amount summary
			$data['events_count'] = $this->calendar->countCalendarEvents();
			$data['queue_count'] = $this->calendar->countEventsQueues();
			$data['gmaps_count'] = $this->gmaps_model->countlocationMarkers();
			$data['users_count'] = $this->Member_model->countUsers();	 			 
			 
			if ($this->input->post('template_cancel')) { 
				$last_page = $this->session->userdata('last_page'); 
				if (trim($last_page) !== '') { 
					redirect($last_page, 301);
				}else{redirect('admin/settings/template', 301);}			
			}   			
 
			if ($this->input->post('template_submit')) { 
				// set up form validation config
				$config = array(
				array(
					'field' => 'template_title',
					'label' => 'template_title',
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'template_body',
					'label' => 'template_body',
					'rules' => 'trim|required'
				)
				);
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules($config);
 	 
				if ($this->form_validation->run() === FALSE) { 
				
					// validation failed - reload page with error message(s) 
					debug('Initialize index - loading "settings/index" form validation failed view');
					$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/template', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
					$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
				} else {
				 		
					// update settings with form values 
					$id = $data['msg_id'];
					$subject = $this->input->post('template_title');			
					$body = $this->input->post('template_body');  
					
					$this->Notification_model->update_template($id, $subject, $body);
					// validation successful
					debug('Initialize index - loading "settings/template" validation successful view');
					redirect('admin/settings/template/'.$notify_type, 301); 

				}
			
			} else {
			
				// form not submitted so just show the form 
				debug('Initialize index - loading "settings/template" view');
				$sections = array('body_content' => $this->setting['current_theme'] . '/backend/settings/template', 'nav_content' => $this->setting['current_theme'] . '/backend/settings/nav', 'header_content' => $this->setting['current_theme'] . '/backend/settings/header', 'footer_content' => $this->setting['current_theme'] . '/backend/settings/footer');
				$this->template->load($this->setting['current_theme'] . '/backend/masterpage', $sections, $data); 
					
			}
		
		} else {			 
			// user not found, redirect to users list
			debug('Initialize index - loading "login/index" view');		
			redirect('admin/login', 301); 
		}   
    }
	
	
}

/* End of file settings.php */
/* Location: ./application/controllers/admin/settings.php */