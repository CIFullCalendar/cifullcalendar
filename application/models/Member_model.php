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
 
class Member_model extends CI_Model 
{

    protected $table_members = 'users';
	
    protected $table_members_groups = 'users_groups';
	
    protected $table_captcha = 'captcha';

    public function __construct() {
	$this->load->database();	
	$this->load->helper('security');
	$this->load->helper('date');
	
    }
	
    /**
    * captchaImage - Display new captcha image
    * captchaImage
    ****
    * @access public
    * @param array (cinfo), $expiration 
    * @return none
    */ 
    function captchaImage($cinfo, $expiration) {
 
		$this->captchaClear($expiration);
		
		$cap_data = array(
			'captcha_time' => $cinfo['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $this->security->xss_clean($cinfo['word'])
		);
		// insert temporary captcha data
		$query = $this->db->insert_string($this->table_captcha, $cap_data);
		$this->db->query($query);
		
		return $cinfo['image'];
	
    }
	
	/**
    * captchaVerify - Verify a genuine user/memeber
    * captchaVerify
    ****
    * @access public
    * @param $captcha, $expiration 
    * @return none
    */ 
    function captchaVerify($captcha, $expiration) { 

		$this->captchaClear($expiration);
	
		$this->db->where('word', $captcha);
		$this->db->limit(1);
		$query = $this->db->get($this->table_captcha);
		
		if ($query->num_rows() > 0) { 
			$result = $query->result();
			return $result[0];
		}
		// no result
		return FALSE;  
    }	
	
	/**
    * captchaClear - Purge obsolete captchas database records
    * register
    ****
    * @access public
    * @param $expiration 
    * @return none
    */ 
    function captchaClear($expiration) {  
		
		if ($expiration) {   
		
			$this->db->where('captcha_time <', time() - $expiration, FALSE); 
			return $this->db->delete($this->table_captcha);
		}
		// no result
		return FALSE;  
    }
	
   /**
    * Update the user profile image from the member table of the database
    * updateImage
    ****
    * @access public
    * @param $userid, $image 
    * @return none
    */
    function updateImage($userid, $image) { 
		
		$data['image'] = $image;
		
		$this->db->where('id', $userid);
		$this->db->update($this->table_members, $data);
	
    }
	
    /**
    * delete the user profile from the member table of the database
    * profile_del
    ****
    * @access public
    * @param int (id)  
    * @return none
    */
    function profile_del($id) {  
		$xid = $this->security->xss_clean($id);
		$this->db->where('id', $xid);
		$this->db->delete($this->table_members);
    }

	/**
    * Get result of the user profile by id from the member table of the database
    * getUserById
    ****
    * @access public
    * @param int (id)  
    * @return true/false
    */
    function getUserById($id) {
		 
		$this->db->where('id', $id);
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
    * Get result of the user profile by username from the member table of the database
    * getUserByUsername
    ****
    * @access public
    * @param varchar (uname)  
    * @return true/false
    */
    function getUserByUsername($uname, $id = 0) {
		
		$xusername = $this->security->xss_clean($uname);
		$xid = $this->security->xss_clean($id);
		
		$this->db->where('username', $xusername); 
		if ($xid > 0) {
			$this->db->where('id !=', $xid);
		}
		$this->db->limit(1);
		$query = $this->db->get($this->table_members);
		// return the user
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result[0];
		}
		// no result
		return FALSE;
    }
	 
	/**
    * Check against the database if image name exist in directory
    * userImageExists
    ****
    * @access public
    * @param varchar (image)  
    * @param int (id)  
    * @return true/false
    */
    function userImageExists($image, $id = 0) {
		
		$xid = $this->security->xss_clean($id);
		
		$this->db->where('image', $image);
		// ignore a user id... this is optional and is used when you want to ignore the current user when editing
		if ($xid > 0) {
			$this->db->where('id !=', $xid);
		}
		$this->db->limit(1);
		$query = $this->db->get($this->table_members);
		// return number of users with this image
		if ($query->num_rows() > 0) {
			return $query->row()->id;
		}
		// no other users
		return FALSE;
    }
	 
	/**
    * Check if member email address exists in users table... to prevent duplicates
    * userEmailExists
    ****
    * @access public
    * @param int (email)  
    * @param int (id)  
    * @return true/false
    */
    function userEmailExists($email, $id = 0) {
		
		$xemail = $this->security->xss_clean($email);
		$xid = $this->security->xss_clean($id);
		
		$this->db->where('email', $xemail);
		// ignore a user id... this is optional and is used when you want to ignore the current user when editing
		if ($xid > 0) {
			$this->db->where('id !=', $xid);
		}
		$this->db->limit(1);
		$query = $this->db->get($this->table_members);
		// return number of users with this email address
		if ($query->num_rows() > 0) {
			return $query->row()->id;
		}
		// no other users
		return FALSE;
    }
 
	
	/**
    * Update the calendar settings by users 
    * fullCalendarSettings
    ****
    * @access public
    * @param $id, $language, $timezone, $defaultview, $header_left, $header_center, $header_right, $aspectratio, $hiddendays, $firstday, $businessdays, $businessstart, $businessend, $weeknumbers, $eventlimit, $alldayslot, $slotduration, $isrtl
    * @return none
    */
    function fullCalendarSettings($id, $language, $timezone, $defaultview, $header_left, $header_center, $header_right, $aspectratio, $hiddendays, $firstday, $businessdays, $businessstart, $businessend, $weeknumberswithindays, $weeknumbers, $eventlimit, $alldayslot, $slotlabeling, $slotlabelformat, $slotduration, $isrtl, $mintime, $maxtime) {
		 
		$data['lang'] = $language;
		$data['cal_timezone'] = $timezone;
		$data['cal_defaultview'] = $defaultview;
		$data['cal_header_left'] = $header_left;
		$data['cal_header_center'] = $header_center;
		$data['cal_header_right'] = $header_right;
		$data['cal_aspectratio'] = $aspectratio;
		$data['cal_hiddendays'] = $hiddendays;
		$data['cal_firstday'] = $firstday;
		$data['cal_businessdays'] = $businessdays;
		$data['cal_businessstart'] = $businessstart;
		$data['cal_businessend'] = $businessend;
		$data['cal_weeknumberswithindays'] = $weeknumberswithindays;
		$data['cal_weeknumbers'] = $weeknumbers;
		$data['cal_eventlimit'] = $eventlimit;
		$data['cal_alldayslot'] = $alldayslot;
		$data['cal_slotlabeling'] = $slotlabeling;
		$data['cal_slotduration'] = $slotduration;
		$data['cal_slotlabelformat'] = $slotlabelformat;
		$data['cal_isrtl'] = $isrtl;
		$data['cal_mintime'] = $mintime;
		$data['cal_maxtime'] = $maxtime;
		
		$this->db->where('id', $id);
		$this->db->update($this->table_members, $data);
    }
	
	/**
    * Get all result and return count amount of all members from the member table of the database
    * countUsers
    ****
    * @access public
    * @param none 
    * @return count results
    */
    function countUsers() { 
		return $this->db->count_all_results($this->table_members);
    }
	
	/**
    * Count the number of users for a particular group, default is 1
    * login
    ****
    * @access public
    * @param int (group)    
    * @return true/false
    */
    function countUsersForLevel($group = 1) {
		// count the number of users for a particular group, default is 1
		$this->db->where('group_id >=', $group);
		// return number of users
		return $this->db->count_all_results($this->table_members_groups);
    }
}

/* End of file member_model.php */
/* Location: ./application/models/member_model.php */