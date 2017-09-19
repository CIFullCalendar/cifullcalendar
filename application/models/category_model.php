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
 
class Category_model extends CI_Model
{
	
	private $table_category = 'category';
	private $table_events = 'events';
	private $table_markers = 'markers';
	
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		$this->load->model('fullcalendar_model');	
		
		$this->load->helper('security');
				
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
	
		$xusername = $this->security->xss_clean($username);
		$this->db->where('category_id', $id);
		$this->db->where('username', $xusername);
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
    * getCategoryList - the event category in the database
    *
    ****
    * @access public
    * @ Param $limit, $offset = 0, $username
    * @ Return string with the last query 
    */		
    function getCategoryList($limit, $offset = 0, $username) {
 
		$xusername = $this->security->xss_clean($username);
		if (!$offset) {
		    $offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
		    $this->db->limit($limit, $offset);
		}
		$this->db->order_by('category_name', 'ASC');
		$query = $this->db->where('username', $xusername);
		$query = $this->db->get($this->table_category);
		 
		if ($query->num_rows() > 0) {
			$categories = array();
			foreach ($query->result() as $entry)
			{
				$categories[] = array(
					'category_id'     	=> $entry->category_id,
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
    * Get all results of the events category
    * getAllCategories
    ****
    * @access public
    * @param int (limit), int (offset)  
    * @return true/false
    */
    public function getAllCategories($limit, $offset = 0) {
		// return all events
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		} 
		$query = $this->db->get($this->table_category);
		// return the events
		if ($query->num_rows() > 0) {
			return $query->result();
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
    function countCategories($username) {  
		$xusername = $this->security->xss_clean($username);
		$query = $this->db->where('username', $xusername);
		$query = $this->db->count_all_results($this->table_category);
		
		return $query; 
    } 
	
}