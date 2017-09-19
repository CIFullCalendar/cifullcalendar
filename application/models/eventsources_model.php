<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model class
 *
 * Communicate with the source table in the database; the source and home controllers (The middle guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/source
 */ 
 
class Eventsources_model extends CI_Model
{
	
	private $table_eventsources = 'eventsources';
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
		$this->load->database();		
	}
	 
    /**
    * add - add a new event source in the database
    *
    ****
    * @access public
    * @ Param $username, $source_name, $source_url
    * @ Return string with the last query 
    */		
    function add($username, $source_name, $source_url) {
	
		$xusername = $this->security->xss_clean($username);
		$data = array( 
			'username' => $xusername,
		    'source_name' => $source_name,
		    'source_url' => $source_url 
		);
		$this->db->insert($this->table_eventsources, $data);
    }
	
    /**
    * update - update the event source in the database
    *
    ****
    * @access public
    * @ Param $id, $username, $source_name, $source_url
    * @ Return string with the last query 
    */	
    function update($id, $username, $source_name, $source_url ) {
	
		$xusername = $this->security->xss_clean($username);
		$data['username'] = $xusername;
		$data['source_name'] = $source_name;
		$data['source_url'] = $source_url; 
 
		$this->db->where('source_id', $id);
		$this->db->where('username', $xusername);
		$this->db->update($this->table_eventsources, $data);
    }	

    /**
    * delete - the event source in the database
    *
    ****
    * @access public
    * @ Param $id, $username
    * @ Return string with the last query 
    */		
	function delete($id, $username) {  
		$xusername = $this->security->xss_clean($username);
		$this->db->where('source_id', $id);
		$this->db->where('username', $xusername);
		$this->db->delete($this->table_eventsources);
    }
	
	/**
    * profile_del - delete the event source by username from the database
    *
    ****
    * @access public
    * @ Param $id, $username
    * @ Return string with the last query 
    */		
	function profile_del($username) { 	
		$xusername = $this->security->xss_clean($username);
		$this->db->where('username', $xusername);
		$this->db->delete($this->table_eventsources);
    }
	
    /**
    * getSourceList - the event source in the database
    *
    ****
    * @access public
    * @ Param $limit, $offset = 0, $username
    * @ Return string with the last query 
    */		
    function getSourceList($limit, $offset = 0, $username) {
 
		$xusername = $this->security->xss_clean($username);
		if (!$offset) {
		    $offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
		    $this->db->limit($limit, $offset);
		}
		$this->db->order_by('source_name', 'ASC');
		$query = $this->db->where('username', $xusername);
		$query = $this->db->get($this->table_eventsources);
		 
		if ($query->num_rows() > 0) {
			
			$sources = array();
			foreach ($query->result() as $entry)
			{
				$sources[] = array(
					'source_id'   		=> $entry->source_id, 
					'username'     		=> $entry->username, 
					'source_name'     	=> $entry->source_name,
					'source_url'     	=> $entry->source_url,
					'token'				=> $this->security->get_csrf_hash() 
				);
			}			
				
			return $sources;			 
		}
		// no result
		return FALSE;
    }
	
    /**
    * geteventSourcesById - the event sources in the database
    *
    ****
    * @access public
    * @ Param $id
    * @ Return string with the last query / False
    */
    function geteventSourcesById($id) { 
	
		$this->db->where('source_id', $id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_eventsources);
		
		if ($query->num_rows() > 0) {
		    $result = $query->result();
		    return $result[0];
		} 
		return FALSE;
    }

    /**
    * countSources - the event source in the database
    *
    ****
    * @access public
    * @ Param $username
    * @ Return string with the last query 
    */	
    function countSources($username) {  
		$xusername = $this->security->xss_clean($username);
		$query = $this->db->where('username', $xusername);
		$query = $this->db->count_all_results($this->table_eventsources);
		
		return $query; 
    }	
	
}

/* End of file Eventsources_model.php */
/* Location: ./application/models/Eventsources_model.php */