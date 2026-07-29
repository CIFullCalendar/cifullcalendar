<?php
/**
 * Member Admin Model class
 *
 * Communicate with the member table in the database and profile controller (The middle guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/profile
 */ 
 
class Member_admin_model extends CI_Model {

	protected $_table_members = 'users'; 
	protected $_table_groups = 'groups'; 
    protected $_table_login_attempts = 'login_attempts';
	
    function Member_admin_model() {
	 parent::__construct();
	 $this->load->database();
	 $this->load->helper('security');
	
	 $this->load->library('ion_auth');
    }
 
  	/**
    * Get result of the user profile by amount from the member table of the database
    * getAllUsers
    ****
    * @access public
    * @param int (limit)  
    * @param int (offset)  
    * @return true/false
    */
    function getAllUsers($limit, $offset = 0) {
		// return all users
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->_table_members);
		// return the users
		if ($query->num_rows() > 0) { 
			$users = array();
			foreach ($query->result() as $entry)
			{
				$users[] = array(
					'id'     					=> $entry->id, 
					'ip_address'     			=> $entry->ip_address, 
					'username'     				=> $entry->username,
					'password'   	  			=> $entry->password, 
					'email'						=> $entry->email, 
					'created_on'   				=> $entry->created_on, 
					'last_login'   				=> $entry->last_login, 
					'active'   					=> $entry->active, 
					'first_name'   				=> $entry->first_name, 
					'last_name'   				=> $entry->last_name, 
					'company'   				=> $entry->company, 
					'phone'   					=> $entry->phone, 
					'image'   					=> $entry->image, 
					'lang'   					=> $entry->lang, 
					'token'						=> $this->security->get_csrf_hash() 
				);
			}			
				
			return $users;			 
		}
		// no result
		return FALSE;
    }

  	/**
    * Get result of the users group from the member table of the database
    * getAllGroups
    ****
    * @access public
    * @param int (limit)  
    * @param int (offset)  
    * @return true/false
    */
    function getAllGroups() { 
		
		$query = $this->ion_auth->groups(); 
		
		// return the groups
		if ($query->num_rows() > 0) { 
			$groups = array();
			foreach ($query->result() as $entry)
			{
				$groups[] = array(
					'id'			=> $entry->id, 
					'name'     		=> $entry->name, 
					'description'   => $entry->description,
					'token'			=> $this->security->get_csrf_hash(),
				);
			}			
				
			return $groups;			 
		}
		// no result
		return FALSE;
    }
	
	/**
    * Get result of login attempts within the database
    * get_login_attempts
    ****
    * @access public
    * @param int (limit)  
    * @param int (offset)  
    * @return true/false
    */
    function get_login_attempts($limit = 0, $offset = 0) {
		// return all attempts
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->_table_login_attempts);
		// return the attempts
		if ($query->num_rows() > 0) { 
			$attempts = array();
			foreach ($query->result() as $entry) {
				$attempts[] = array( 
					'ip_address'     			=> $entry->ip_address, 
					'identity'     				=> $entry->login, 
					'timestamp' 				=> $entry->time 
				);
			}			
				
			return $attempts;			 
		}
		// no result
		return array();
    }
	
    /**
    * delete the user profile from the member table of the database
    * deleteUser
    ****
    * @access public
    * @param int (id)  
    * @return none
    */
    function profile_del($id) {  
		$xid = $this->security->xss_clean($id);
		$this->db->where('id', $xid);
		$this->db->delete($this->_table_members);
    }
	
    /**
    * countMembers - Count all events
	*
    ****
    * @access public
    * @ Param none
    * @ Return query
    */
    public function countMembers() {  
		return $this->db->count_all_results($this->_table_members);
    }    
	
	/**
    * countMembers - Count all events
	*
    ****
    * @access public
    * @ Param none
    * @ Return query
    */
    public function countGroups() {  
		return $this->db->count_all_results($this->_table_groups);
    }	 	

}

/* End of file user_model.php */
/* Location: ./application/models/member_model.php */