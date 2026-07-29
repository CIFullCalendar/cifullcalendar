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
 
class Category_admin_model extends CI_Model {
	
	protected $table_category = 'category';
	protected $table_events = 'events';
	protected $table_markers = 'markers'; 
	protected $private_value = 0;
	protected $public_value = -1;
	
	//update the approve value
	protected $approve_value = -3;
	
	function __construct() {
	 parent::__construct();
	 $this->load->database();  
	 $this->load->helper('security'); 
	}	 
 
    /**
    * add - the event category in the database
    *
    ****
    * @access public
    * @ Param $category_group, $username, $category_name, $category_desc, $category_bgcolor, $category_bcolor, $category_color 
    * @ Return string with the last query 
    */		
    function add($category_group, $username, $category_name, $category_desc, $category_bgcolor, $category_bcolor, $category_color ) {
	 
		$data = array( 
			'gid' => $category_group,
			'username' => $username,
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
    * @ Param $id, $category_group, $username, $category_name, $category_desc, $category_bgcolor, $category_bcolor, $category_color
    * @ Return string with the last query 
    */	
    function update($id, $category_group, $category_name, $category_desc, $category_bgcolor, $category_bcolor, $category_color ) {
	 
		$data['gid'] = $category_group; 
		$data['category_name'] = $category_name;
		$data['category_desc'] = $category_desc; 
		$data['backgroundColor'] = $category_bgcolor; 
		$data['borderColor'] = $category_bcolor; 
		$data['textColor'] = $category_color; 
  
		$this->db->where('category_id', $id); 
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
	function delete($id) { 
	 
		$this->db->where('category_id', $id); 
		$this->db->delete($this->table_category);
		
		$this->db->where('category', $id);
		$this->db->delete($this->table_events);		
		
		$this->db->where('markers_category_id', $id);
		$this->db->delete($this->table_markers);
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
    * @ Param $limit, $offset = 0, $username
    * @ Return string with the last query 
    */		
    function get_categories($limit, $offset = 0) {
  
		if (!$offset) {
		    $offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
		    $this->db->limit($limit, $offset);
		}
		$this->db->order_by('category_name', 'ASC');  
		$query = $this->db->get($this->table_category);
		 
		if ($query->num_rows() > 0) {
			$categories = array();
			foreach ($query->result() as $entry) {
				
				$groups = $this->ion_auth->group($entry->gid)->row(); 
				
				$categories[] = array(
					'category_id'     	=> $entry->category_id, 
					'groups'			=> (empty($groups)) ? ($this->private_value == $entry->gid) ? 'Private' : 'Public' : $groups->name,
					'username'       	=> $entry->username,
					'category_name'     => $entry->category_name,
					'category_desc'     => $entry->category_desc,
					'backgroundColor'	=> $entry->backgroundColor,
					'borderColor'		=> $entry->borderColor,
					'textColor'			=> $entry->textColor, 
					'token'				=> $this->security->get_csrf_hash(),
				);
			}			
			
		    return $categories;
		}
		// no result
		return FALSE;
    }
  
    /**
    * countCategories - the event category in the database
    *
    ****
    * @access public
    * @ Param $username
    * @ Return string with the last query 
    */	
    function countCategories() {   
		$query = $this->db->count_all_results($this->table_category);
		
		return $query; 
    } 
	
}