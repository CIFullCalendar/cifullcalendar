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
class Gmaps_admin_model extends CI_Model
{
	
	private $table_markers = 'markers';
	
	
	function __construct()
	{
		parent::__construct();  
		$this->load->database();	
		$this->load->helper('security');
			
	}
	
	
	/**
    * Get all markers results 
    * getAllEvents
    ****
    * @access public
    * @param int (limit), int (offset)  
    * @return true/false
    */
    public function get_allmarkers($limit, $offset = 0) {
		// return all events
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('markers_id', 'DESC');
		$query = $this->db->get($this->table_markers);
		// return the events
		if ($query->num_rows() > 0) {
			$markers = array();
			foreach ($query->result() as $entry)
			{
				$markers[] = array(
					'markers_id'     	 => $entry->markers_id,
					'markers_category_id'=> $entry->markers_category_id,
					'event_id' 			 => $entry->event_id,
					'username'    		 => $entry->username,
					'markers_name'		 => $entry->markers_name,
					'markers_logo'		 => $entry->markers_logo,
					'markers_address'	 => $entry->markers_address,
					'markers_lat'	 	 => $entry->markers_lat,
					'markers_lng'	 	 => $entry->markers_lng,
					'markers_url'	 	 => $entry->markers_url,
					'markers_desc'	 	 => $entry->markers_desc,
					'token'				 => $this->security->get_csrf_hash(),
				);
			}			
			
		    return $markers;
		}
		// no result
		return FALSE;
    }	
 
    /**
    * get the location by id the database
    *
    ****
    * @access public
    * @ Param id
    * @ Return results/false
    */		
	public function get_markersById($id) {
		// return the user
		$this->db->where('markers_id', $id);
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
    * update_marker - update the event markers in the database
    *
    ****
    * @access public
    * @ Param $event, $markers_logo, $location, $markers_lat, $markers_lng
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function update_marker($event, $markers_logo, $location, $markers_lat, $markers_lng) {
		
		$xevent = $this->security->xss_clean($event);
           $update_marker = array(  
			    'markers_logo' => $markers_logo,
			    'markers_address' => $location,  
		        'markers_lat' => $markers_lat,
		        'markers_lng' => $markers_lng 
			);  
		
			$this->db->where('event_id',$xevent);
			$this->db->update($this->table_markers,$update_marker);
			return $this->db->last_query();	
	} 
	
     /**
    * update_marker2 - update the event markers in the database
    *
    ****
    * @access public
    * @ Param $marker_category, $event, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description, $del
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function update_marker2($event, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description) {
		  
		 $xtitle = $this->security->xss_clean($title);
		 $xlocation = $this->security->xss_clean($location);
		 $xurl = $this->security->xss_clean($url);
		 $xdescription = $this->security->xss_clean($description);
		 
           $update_marker = array( 
			    'markers_name' => $xtitle,
			    'markers_logo' => $markers_logo,
			    'markers_address' => $xlocation,  
		        'markers_lat' => $markers_lat,
		        'markers_lng' => $markers_lng,				
			    'markers_url' => $xurl,			    
				'markers_desc' => $xdescription	
			);  
		
			$this->db->where('event_id',$event);
			$this->db->update($this->table_markers,$update_marker);
			return $this->db->last_query();	
	}
    
	/**
    * add_marker - add the event makers in the database
    *
    ****
    * @access public
    * @ Param $event_id, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description
    * @ Return string with the last query 
    */		
	public function add_marker($event, $username, $title, $markers_logo, $location, $markers_lat, $markers_lng, $url, $description ) {
					 
			$xtitle = $this->security->xss_clean($title);
	 
           $new_marker = array( 
			    'event_id' => $event,
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
			
}

/* End of file Gmaps_admin_model.php */
/* Location: ./application/models/Gmaps_admin_model.php */