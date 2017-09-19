<?php
/**
 * Model class
 *
 * Communicate with the member table in the database and profile controller (The middle guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/profile
 */ 
 
class Sessions_model extends CI_Model 
{

    private $table_members = 'members';
    private $table_sessions = 'session';

    function Sessions_model() {
	parent::__construct();
	
	$this->load->helper('security');
	$this->load->database();
    }
 
   	/**
    * Get the result of all sessions of the database
    * getAllSessions
    ****
    * @access public
    * @param int (limit)  
    * @param int (offset)  
    * @return true/false
    */
    function getAllSessions($limit, $offset = 0) {
		// return all sessions
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		} 
		
		$query = $this->db->select('session_id, ip_address, user_agent, last_activity')->from($this->table_sessions)->order_by('last_activity', 'desc')->get();
		// return the sessions
		if ($query->num_rows() > 0) {
			$sessions = array();
			foreach ($query->result() as $entry)
			{
				$sessions[] = array(
					'session_id'     	=> $entry->session_id, 
					'ip_address'     	=> $entry->ip_address, 
					'user_agent'     	=> $entry->user_agent,
					'last_activity'     => $entry->last_activity, 
					'token'				=> $this->security->get_csrf_hash() 
				);
			}			
				
			return $sessions;
		}
		// no result
		return FALSE;
    }
	
	/**
    * Get result of the user profile by IP from the member table of the database
    * getUserByIP
    ****
    * @access public
    * @param int (id)  
    * @return true/false
    */
    function getUserByIP($ip) { 
		$this->db->where('ip_address', $ip);
		$this->db->limit(1);
		$query = $this->db->get($this->table_members);
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result[0];
		}
		// no result
		return FALSE;
    }
 
    /**
    * delSessions - delete all sessions by specific IP of the database
    * delSessions
    ****
    * @access public
    * @param int (id)  
    * @return none
    */
    function delSessions($id) {   
		$this->db->where('session_id', $id);
		$this->db->delete($this->table_sessions);
    }
	
	/**
    * Get all result and return count amount of all members from the member table of the database
    * countSessions
    ****
    * @access public
    * @param none 
    * @return count results
    */
    function countSessions() { 
		return $this->db->count_all_results($this->table_sessions);
    }
 
}

/* End of file sessions_model.php */
/* Location: ./application/models/sessions_model.php */