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
 
class Page extends CI_Controller {

    /*
     * Pages controller class constructor
     */

    function Page() {
	parent::__construct();
	$this->load->model('Page_model');
	$this->load->model('Member_model');
	  
	$this->load->helper('security'); 
	$this->load->helper('url'); 
	
	$this->load->library('ion_auth'); 
	$this->load->library('Languages');	
	// load all settings into an array
	$this->setting = $this->Setting_model->getEverySetting();
    }

	 /*
     * index function
     *
     * display a custom page index
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
		
		// check user is logged in
	    if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
			 		 
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $user->image,  $user->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $user->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
		}		
		
		$data['pagename'] = $this->Page_model->getAllPublicPages(4, $this->uri->segment(4));
		 
		$data['allpages'] = $this->Page_model->getAllPublicPages(0);
		if ($data['allpages']) {
			  
			debug('Initialize index - loading "page/title" pages view');
			$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/page/list', 'nav_content' => $this->setting['current_theme'] . '/frontend/page/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/page/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/page/footer');
			$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data); 
			
		} else {
			// page not found so show not found page
			debug('page not found - show 404 not found page');
			show_404();
		}
 
    }
	
	 /*
     * title function
     *
     * display a custom page contents
     */
    function title($page_name) {
		
		// set the page language, site name, page title, meta keywords and meta description  
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
		$data['site_name'] = $this->setting['site_name'];
		$data['meta_keywords'] = $this->setting['meta_keywords'];
		$data['meta_description'] = $this->setting['meta_description'];  
		$data['current_version'] = $this->setting['current_version'];  
		
		$data['pagename'] = $this->Page_model->getAllPublicPages(4, $this->uri->segment(4));
		
		// check user is logged in
	    if ($this->ion_auth->logged_in() || $this->ion_auth->is_admin()) {
			
			$user = $this->ion_auth->user()->row();
			 		 
			// if there is a site logo, get the path to the image file
			if ($this->Member_model->userImageExists( $user->image,  $user->id) !== '') {
				$data['current_logo'] = base_url().'assets/img/profile/'. $user->image;;
			} else {
				// no logo so leave it blank
				$data['current_logo'] = base_url().'assets/img/profile/default.png';
			}	
			// check page access
			$data['page'] = $this->Page_model->getPageBySeoName($page_name, $user);	
					
		}else {			
			$data['page'] = $this->Page_model->getPageBySeoName($page_name, FALSE);	
		}

		
		if ($data['page']) {
			
			// set the page title, meta keywords, description and version  
			$data['page_seo'] = $data['page']->seo; 
			$data['page_title'] = $data['page']->title; 
			$data['meta_keywords'] = str_replace('"', '', $data['page']->meta_keywords);
			$data['meta_description'] = str_replace('"', '', $data['page']->meta_description);  
			$data['current_version'] = $this->setting['current_version'];		
			
			$data['page_content'] = $data['page']->content; 
			
			debug('Initialize index - loading "page/title"  ' . $page_name . ' view');
			$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/page/index', 'nav_content' => $this->setting['current_theme'] . '/frontend/page/nav', 'header_content' => $this->setting['current_theme'] . '/frontend/page/header', 'footer_content' => $this->setting['current_theme'] . '/frontend/page/footer');
			$this->template->load($this->setting['current_theme'] . '/frontend/masterpage', $sections, $data);		
			
		} else {
			// page not found so show not found page
			debug('page not found - show 404 not found page');
			show_404();
		}
    }

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
