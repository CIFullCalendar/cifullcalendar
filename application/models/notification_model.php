<?php
/**
 * Model class
 *
 * Communicate with the member table in the database and profile controller (The middle guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/libraries
 */ 
 
class Notification_model extends CI_Model 
{

    private $table_members = 'users';
    private $table_groups = 'users_groups';
    private $table_templates = 'templates';

    function Notification_model() {
	parent::__construct();
	
	$this->load->helper('security');
	$this->load->database();
    }
 

    public function getTableField($where_criteria = array(), $table_field) { 
		return $this->db->select($table_field)->where($where_criteria)->get($this->table_templates)->row()->$table_field; 
		 
	} 
	
   	/**
    * Get the result of all templates of the database
    * getAllSessions
    ****
    * @access public
    * @param int (limit), int (offset)  
    * @return true/false
    */
    public function getAllTemplates($limit, $offset = 0) {
		// return all sessions
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		} 
		
		$query = $this->db->select('id, types, subject, body')->from($this->table_templates)->order_by('id', 'desc')->get();
		// return the templates
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		// no result
		return FALSE;
    }
	
	/**
    * Check against the database if emails exist in directory
    * getAllEmails
    ****
    * @access public
    * @param $group
    * @return true/false
    */
    public function getAllEmails($group = "") { 
	
		$this->db->select('email');
		$this->db->from($this->table_members);
		$this->db->join($this->table_groups, $this->table_groups.'.user_id = '.$this->table_members.'.id', 'inner');
		if(!empty($group)){ 
			$this->db->where(array($this->table_groups.'.group_id' => $group));
		}		
	 	$this->db->order_by('email', 'desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			 return $query->result_array();   
		}
		// no result
		return FALSE;	 
    }	
	
	/**
    * Check against the database if emails exist in directory
    * getAllEmails
    ****
    * @access public
    * @param $uname
    * @return true/false
    */
    public function getEmailByUsername($uname = "") { 
	
		if(!empty($uname)){
			$this->db->select('email');
			$this->db->where('uname', $uname);
			$this->db->limit(1); 
			$query = $this->db->get($this->table_members);
			
			if ($query->num_rows() > 0) {
				 return $query->result_array();   
			}
		}		 
		// no result
		return FALSE;	 
    }

	/**
    * Check against the database if emails exist in directory
    * chkEmail
    ****
    * @access public
    * @param $uname
    * @return true/false
    */
    public function checkEmail($email = "") { 
	
		if(!empty($email)){
			$this->db->select('email');
			$this->db->where('email', $email);
			$this->db->limit(1); 
			$query = $this->db->get($this->table_members);
			
			if ($query->num_rows() > 0) {
				 return $query->result_array();   
			}
		}		 
		// no result
		return FALSE;	 
    }	
 
 
    /**
    * update the event in the database
    * update_template
    ****
    * @access public
    * @ Param $id, $subject, $body
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function update_template($id, $subject, $body) {
		  
	   $template = array(
			'id' 			=> $id,
			'subject' 		=> $subject,
			'body'			=> $body 
		); 

		$this->db->where('id',$id);
		$this->db->update($this->table_templates,$template);
		return $this->db->last_query(); 
	}
	
    /**
    * del - delete all templates by id in the database
    * del
    ****
    * @access public
    * @param int (id)  
    * @return none
    */
    public function del($id) {   
		$this->db->where('id', $id);
		$this->db->delete($this->table_templates);
    }
	
	/**
    * Get all result and return count amount of all templates table of the database
    * countSessions
    ****
    * @access public
    * @param none 
    * @return count results
    */
    public function countNotifications() { 
		return $this->db->count_all_results($this->table_templates);
    }
 
}

/* End of file Notification_model.php */
/* Location: ./application/models/Notification_model.php */