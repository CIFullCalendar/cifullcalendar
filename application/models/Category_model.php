<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Model class
 *
 * Communicate with the category table in the database; the category, home and gmaps controllers (The middle guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/category
 */ 
 
class Category_model extends CI_Model {
	
	protected $table_category = 'category';
	protected $table_events = 'events';
	protected $table_markers = 'markers';
	
	protected $private_value = 0;
	protected $public_value = -1;	
	
	
    public function __construct() {
	 $this->load->database();
	 $this->load->model('fullcalendar_model');	
	
	 $this->load->helper('security');
	
	 $this->load->library('ion_auth');		
	}	 
 
    /**
    * add - the event category in the database
    *
    ****
    * @access public
    * @ Param $username, $category_name, $category_desc
    * @ Return string with the last query 
    */		
    function add($username, $category_name, $category_desc, $category_bgcolor, $category_bcolor, $category_color ) {
	
		$xusername = $this->security->xss_clean($username);
		$data = array( 
			'username' => $xusername,
		    'category_name' => $category_name,
		    'category_desc' => $category_desc, 
		    'backgroundColor' => $category_bgcolor, 
		    'borderColor' => $category_bcolor, 
		    'textColor' => $category_color, 
		);
		$this->db->insert($this->table_category, $data);
    }
	
    /**
    * update - the event category in the database
    *
    ****
    * @access public
    * @ Param $id, $username, $category_name, $category_desc
    * @ Return string with the last query 
    */	
    function update($id, $username, $category_name, $category_desc, $category_bgcolor, $category_bcolor, $category_color ) {
	
		$xusername = $this->security->xss_clean($username);
		$data['username'] = $xusername;
		$data['category_name'] = $category_name;
		$data['category_desc'] = $category_desc; 
		$data['backgroundColor'] = $category_bgcolor; 
		$data['borderColor'] = $category_bcolor; 
		$data['textColor'] = $category_color; 
 
		$this->db->where('category_id', $id);
		$this->db->where('username', $xusername);
		$this->db->update($this->table_category, $data);
    }	

    /**
    * profile_del - the event category in the database
    *
    ****
    * @access public
    * @ Param $id, $username
    * @ Return string with the last query 
    */		
	function profile_del($username) { 
	
		$xusername = $this->security->xss_clean($username); 
		$this->db->where('username', $xusername);
		$this->db->delete($this->table_category);
    }	
	
    /**
    * delete - the event category in the database
    *
    ****
    * @access public
    * @ Param $id, $username
    * @ Return string with the last query 
    */		
	function delete($id, $username) { 
		$check = FALSE;
		
		$this->db->where('category_id', $id);
		$this->db->where('username', $username);
		$check = $this->db->delete($this->table_category);
		
		if($check == TRUE){
			$this->db->where('category', $id);
			$this->db->delete($this->table_events);		
			
			$this->db->where('markers_category_id', $id);
			$this->db->delete($this->table_markers); 
		}

    }

    /**
    * getCategoriesById - the event category in the database
    *
    ****
    * @access public
    * @ Param $id
    * @ Return string with the last query / False
    */
    function getCategoriesById($id) { 
	
		$this->db->where('category_id', $id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_category);
		
		if ($query->num_rows() > 0) {
		    $result = $query->result();
		    return $result[0];
		} 
		return FALSE;
    }	  
	
	/**
    * get_categories - the event category in the database
    *
    ****
    * @access public
    * @ Param $user
    * @ Return string with the last query 
    */		
    function get_categories($user) {
		
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($user->id)->result(); 
		$checked = 0;		
		
		$this->db->select('c.category_id, c.category_name, c.category_desc, c.backgroundColor, c.borderColor, c.textColor');
        $this->db->from($this->table_category . ' as c');
		
		$this->db->select('COUNT(e.category) AS count');
		$this->db->join($this->table_events . ' as e', 'c.category_id = e.category','left'); 
		   
		$this->db->where('c.username', $user->username); 
		foreach ($groups as $group){			
			foreach($currentGroups as $usergroup) { 
				  $checked = $usergroup->id;	 
			      $this->db->or_where('c.gid', $checked)->order_by('count', 'DESC'); 	
			}
			
		} 		 
		
        $this->db->order_by('count', 'desc');		
        $this->db->group_by('c.category_name');
		 
		$query = $this->db->get();
		 
		$jsoncategory = array();
        foreach ($query->result() as $entry)
        {
            $jsoncategory[] = array(
				'category_id'      	=> $entry->category_id,
				'category_name'     => $entry->category_name, 
				'category_desc'    	=> $entry->category_desc,
                'backgroundColor'	=> $entry->backgroundColor,
                'borderColor'		=> $entry->borderColor,
                'textColor'			=> $entry->textColor, 
				'count'				=> $entry->count,
				'token'			    => $this->security->get_csrf_hash(), 
            );
        } 
		
		return $jsoncategory;
	}	 
	
    /**
    * get_public_categories - the event category in the database
    *
    ****
    * @access public
    * @ Param $user
    * @ Return string with the last query 
    */		
    function get_public_categories() {
		 		
		$this->db->select('category_id, category_name, category_desc'); 
		   
		$this->db->where('gid', $this->public_value); 
		
        $this->db->order_by('category_name', 'desc');	 
		 
		$query = $this->db->get($this->table_category);
		
		// return the events
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		// no result
		return array();
	}
	
    /**
    * countCategories - the event category in the database
    *
    ****
    * @access public
    * @ Param $username
    * @ Return string with the last query 
    */	
    function countCategories($username) {  
		$xusername = $this->security->xss_clean($username);
		$query = $this->db->where('username', $xusername);
		$query = $this->db->count_all_results($this->table_category);
		
		return $query; 
    } 
	
}