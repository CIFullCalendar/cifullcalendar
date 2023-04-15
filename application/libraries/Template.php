<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Template Library Class
 *
 * Extension of the CI core classes and communicate with the controller (The side man)
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Templates
 * @author      sirdre
 * @link        Application/libraries/Template
 */
class Template {

	//global variable
	protected $CI;
	
	/**
	* Constructor
	*
	* @access    public
	*/
	function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->helper('security'); 
		log_message('debug', "Template Class Initialized");
	}

	/**
	* Load template
	*
	* @access   public
	* @param    String, Array, Array, bool
	* @return   parsed view
	*/
	function load($template = '', $view = array(), $vars = array(), $return = FALSE)  {

		$phpfiles = array();
		// Check for partials to load
		if (count($view) > 0)  {
			
			// Load views into var array
			foreach ($view as $key => $file) {				  
			   $phpfiles[$key] = $this->CI->load->view($file, $vars, TRUE);
			} 
			// Merge into vars array
			$vars = array_merge($vars, $phpfiles);
		}

		// Load master template
		return $this->CI->load->view($template, $vars, $return);
	}
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */