<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Model class
 *
 * Communicate with the markers table in the database; the gmaps, category and home controllers (The middle guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/gmaps
 */ 
class Gmaps_model extends CI_Model 
{
	
    private $table_markers = 'markers';
	private $table_category = 'category';
	 
	function __construct()	{
	parent::__construct();  
	
	$this->load->helper('security');
	$this->load->database();		
	}
	
    /**
    * get - the event makers in the database
    *
    ****
    * @access public
    * @ Param events
    * @ Return string with the last query 
    */			
	function get($category, $username)
	{
		if($category != 'undefined'){
			$this->db->where('markers_category_id', $category);
		}
		
		$this->db->where('username', $username);
		$query = $this->db->get($this->table_markers);
		$result = $query->result_array();
		
		return $result;
	}
	
    /**
    * get all - the event makers in the database
    *
    ****
    * @access public
    * @ Param events
    * @ Return string with the last query 
    */			
	function get_all($category)
	{
		if($category != 'undefined'){
			$this->db->where('markers_category_id', $category);
		}
	 
		$query = $this->db->get($this->table_markers);
		$result = $query->result_array();
		
		return $result;
	}
	
    /**
    * category - the event makers in the database
    *
    ****
    * @access public
    * @ Param events
    * @ Return string with the last query 
    */		
	function category($username) {
		
		$this->db->select(''.$this->table_category.'.category_id, '.$this->table_category.'.category_name, COUNT(markers_category_id) AS count');
        $this->db->from($this->table_category);
        $this->db->where(''.$this->table_category.'.username', $username);
        $this->db->order_by('count', 'desc');

		$this->db->join($this->table_markers, ''.$this->table_category.'.category_id = '.$this->table_markers.'.markers_category_id','left');
        $this->db->group_by(''.$this->table_category.'.category_name');
		 
		$query = $this->db->get();
		
		$result = $query->result_array();
		
		return $result;
	}
	
    /**
    * get_events - the event makers in the database
    *
    ****
    * @access public
    * @ Param events
    * @ Return string with the last query 
    */			
	function get_events($events)
	{
		if($events != 'undefined'){
			$this->db->where('event_id', $events);
		} 
		$query = $this->db->get($this->table_markers);
		$result = $query->result_array();
		
		return $result;
	}

    /**
    * get the markers by id the database
    *
    ****
    * @access public
    * @ Param id
    * @ Return results/false
    */		
	public function get_markersById($id) {
		// return the user
		$this->db->where('event_id', $id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_markers);
		if ($query->num_rows() > 0) {
		    $result = $query->result();
		    return $result[0];
		}
		// no result
		return FALSE;
    }
	
    /**
    * add_marker - add the event makers in the database
    *
    ****
    * @access public
    * @ Param $marker_category, $event_id, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description
    * @ Return string with the last query 
    */		
	public function add_marker($marker_category, $event_id, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description ) {
					
			$xcategory = $this->security->xss_clean($marker_category);
			$xtitle = $this->security->xss_clean($title);
	 
           $new_marker = array(
			    'markers_category_id' => $xcategory,
			    'event_id' => $event_id,
			    'username' => $username,
			    'markers_name' => $title,
			    'markers_logo' => $markers_logo,
			    'markers_address' => $location,  
		        'markers_lat' => $markers_lat,
		        'markers_lng' => $markers_lng,				
			    'markers_url' => $url,			    
				'markers_desc' => $description	
			); 
			
		$this->db->insert($this->table_markers, $new_marker);
	    return $this->db->last_query();

	}
 	
    /**
    * update_marker - update the event markers in the database
    *
    ****
    * @access public
    * @ Param $marker_category, $event, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description, $del
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function update_marker($marker_category, $event, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description) {
		 
		 $xevent = $this->security->xss_clean($event);
		 $xtitle = $this->security->xss_clean($title);
           $update_marker = array(
			    'markers_category_id' => $marker_category,
			    'username' => $username,
			    'markers_name' => $xtitle,
			    'markers_logo' => $markers_logo,
			    'markers_address' => $location,  
		        'markers_lat' => $markers_lat,
		        'markers_lng' => $markers_lng,				
			    'markers_url' => $url,			    
				'markers_desc' => $description	
			);  
		
			$this->db->where('event_id',$xevent);
			$this->db->update($this->table_markers,$update_marker);
			return $this->db->last_query(); 
	}
	
	/**
    * delete_marker - Delete a marker for the event in the database
    *
    ****
    * @access public
    * @ Param $id (event)
    * @ Return string with the last query
    */
    public function delete_marker($id)  {
		
		$xid = $this->security->xss_clean($id);
        $this->db->delete($this->table_markers,array('event_id'=>$xid));
		return $this->db->last_query();
    }	

	/**
    * profile_del - Delete a marker for the event in the database
    *
    ****
    * @access public
    * @ Param $username (event)
    * @ Return string with the last query
    */
    public function profile_del($username)  {
		
		$xusername = $this->security->xss_clean($username); 
		$this->db->where('username', $xusername);
		$this->db->delete($this->table_markers);
		return $this->db->last_query();
    }	
	
    /**
    * countlocationMarkers - Admin reviews
	*
    ****
    * @access public
    * @ Param none
    * @ Return id
    */
    public function countlocationMarkers() {  
		return $this->db->count_all_results($this->table_markers);
    }	
	
}

/* End of file gmaps_model.php */
/* Location: ./application/models/gmaps_model.php */