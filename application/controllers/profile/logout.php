<?php

/**
 * Page controller class
 *
 * Displays login page
 *
 * @package		ci_fullcalendar
 * @category    Controller
 * @author		sirdre
 * @link		/profile/logout
 */

class Logout extends CI_Controller {

    /*
     * Logout controller class constructor
     */
    function Logout() {
	parent::__construct();
	$this->load->helper('url'); 
	
	$this->load->library('Languages');
	$this->load->library('ion_auth'); 
    }

    /*
     * index function (default)
     *
     * log user out
     */
    function index() {  
	
		debug('Initialize logout - loading "profile/logout" view');	
		// check if the user is logged in 
	    if ($this->ion_auth->logout()) { 
			// redirect them to the login page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('/profile/login', 301); 
		}else{
			$this->session->set_flashdata('message', $this->ion_auth->error());
			redirect('/profile/login', 301);			
		}
		
    }

}

/* End of file logout.php */
/* Location: ./application/controllers/profile/logout.php */