<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Feeds controller class
 *
 * Displays Feeds page
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/feeds
 */
 
class Feeds extends CI_Controller {


    protected $limit_value = 40;
	
    /*
     * Feed controller class constructor
     */
    public function __construct() {
	 parent::__construct();
	 $this->load->model('Feed_model', 'feeds');
	 $this->load->model('category_model');
 
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
	  
		debug('RSS Feed page | index function');	
		$data['lang'] = $this->setting['site_language'];		 
		
		$this->languages->get_lang($data['lang']);
		
	    $data['encoding'] = 'utf-8';
        $data['logo'] = $this->setting['site_logo'];
		$data['feed_name'] = $this->setting['site_name'];
        $data['feed_url'] = base_url();
        $data['page_description'] = $this->setting['meta_description']; 
        $data['creator_email'] = $this->setting['site_email']; 
		
        $data['posts'] = $this->feeds->get_allfeeds($this->limit_value);  
		$data['allcategories'] = $this->category_model->get_public_categories();
		
        header("Content-Type: application/rss+xml");	
		
		debug('Initialize index - loading "feed/index" view');
		$sections = array('body_content' => $this->setting['current_theme'] . '/frontend/feed/index');
		$this->template->load($this->setting['current_theme'] . '/frontend/feed/index', $sections, $data);
 
    }
	
  
}

/* End of file feeds.php */
/* Location: ./application/controllers/feeds.php */