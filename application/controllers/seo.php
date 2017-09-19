<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sitemaps controller class
 *
 * Displays Sitemaps page
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/Sitemaps
 */
 
class Seo extends CI_Controller {

    /*
     * Feed controller class constructor
     */

    function Seo() {
	parent::__construct(); 
	$this->load->model('Page_model');
 
	$this->load->helper('url');
	$this->load->helper('xml');
	$this->load->helper('text');

	$this->load->library('Languages');

	// load all settings into an array
	$this->setting = $this->Setting_model->getEverySetting();
    }

    /*
     * index function
     *
     * displays the site Feed page
     */

    function index() {
	   
	   // set the page language and others
		$data['lang'] = $this->setting['site_language']; 
		$this->languages->get_lang($data['lang']); 
		
		$data['encoding'] = 'utf-8'; 
        $data['logo'] = $this->setting['site_logo'];
		$data['site_name'] = $this->setting['site_name'];
		
		$data['allpages'] = $this->Page_model->getAllPublicPages(0);
		
        header("Content-Type: text/xml;charset=iso-8859-1");
		
		debug('Initialize index - loading "sitemaps/index" view');
		$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/sitemaps/index');
		$this->template->load($this->setting['current_theme'] . '/frontend/sitemaps/index', $sections, $data);
 
    }
	
  
}

/* End of file feeds.php */
/* Location: ./application/controllers/feeds.php */