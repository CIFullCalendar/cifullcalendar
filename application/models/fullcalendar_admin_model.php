<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Model class
 *
 * Communicate with the event table in the database; the home and profile controllers (The db guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/home
 */ 
 
class Fullcalendar_admin_model extends CI_Model {
	
	private $table_events = 'events';
	private $table_eventsqueues = 'eventsqueues';
	private $table_category = 'category';
	private $table_markers = 'markers';
	private $private_value = 0;
	private $public_value = -1;
	
	//update the approve value
	private $approve_value = -3;
   
   
   function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('gmaps_model');	
		
		$this->load->helper('security'); 
    }
 
	
    /**
    * jsonEvents - Reads the events database
    * Delivery and format json
    ****
    * @access private
    * @param none
    * @return json events
    */
   
	public function jsonEvents($username)    {       
	
	   $xusername = $this->security->xss_clean($username);
       $events = $this->db->select('*')->from($this->table_events)->order_by('start', 'desc')->get();
	   
        $jsonevents = array();
        foreach ($events->result() as $entry)
        {
            $jsonevents[] = array(
				'id'     			=> $entry->id,
				'gid'       		=> ($entry->gid == $this->approve_value) ? $this->public_value : $entry->gid, 
                'title'     		=> $entry->title,
                'username'     		=> $entry->username,
                'category'     		=> $entry->category,
                'backgroundColor'	=> $entry->backgroundColor,
                'borderColor'		=> $entry->borderColor,
                'textColor'			=> $entry->textColor,
                'description'   	=> $entry->description,
                'start'     		=> $entry->start,
                'allDay'    		=> ($entry->allDay=='true') ? 'All Day' : '',
                'end'       		=> $entry->end,
                'url'       		=> $entry->url, 
				'rendering'       	=> $entry->rendering,
				'overlap'       	=> ($entry->overlap=='true') ? true : false,
				'location'       	=> $entry->location, 
				'latitude' 			=> $entry->latitude, 
				'longitude'			=> $entry->longitude, 
				'filename'			=> $entry->filename,  
				'token'				=> $this->security->get_csrf_hash(), 
				
            );
        }
       echo json_encode($jsonevents);
    }
 
 
     /**
    * jsonEventsCategory - the event makers in the database
    *
    ****
    * @access public
    * @ Param $category, $gid
    * @ Return string with the last query 
    */		
	function jsonEventsCategory($category, $gid)
	{
		$events = $this->db->select('*')->from($this->table_events)->where('category', $category)->order_by('start', 'desc')->get();
  
        $jsonevents = array();
        foreach ($events->result() as $entry)
        {
            $jsonevents[] = array(
				'id'     			=> $entry->id,
				'gid'       		=> ($entry->gid == $this->approve_value) ? $this->public_value : $entry->gid, 
                'title'     		=> $entry->title,
                'category'     		=> $entry->category,
                'backgroundColor'	=> $entry->backgroundColor,
                'borderColor'		=> $entry->borderColor,
                'textColor'			=> $entry->textColor,
                'description'   	=> $entry->description,
                'start'     		=> $entry->start,
                'allDay'    		=> ($entry->allDay=='true') ? true : false,
                'end'       		=> $entry->end,
                'url'       		=> $entry->url, 
				'location'       	=> $entry->location, 
				'latitude' 			=> $entry->latitude, 
				'longitude'			=> $entry->longitude,  
				'token'				=> $this->security->get_csrf_hash(), 
				
            );
        }
       echo json_encode($jsonevents);
	}

    /**
    * profile_del - Delete members events from the database
    *
    ****
    * @access public
    * @ Param $username (event)
    * @ Return string with the last query
    */
    public function profile_del($username)  {
		
		$xusername = $this->security->xss_clean($username); 
		$this->db->where('username', $xusername);
        $this->db->delete($this->table_events);
		return $this->db->last_query();
    }		
	
	/**
    * delete_event - Delete the event from the database
    *
    ****
    * @access public
    * @ Param $ id (event)
    * @ Return string with the last query
    */
    public function delete_event($id)  {
		
		$xid = $this->security->xss_clean($id);
		$this->db->delete($this->table_eventsqueues,array('id'=>$xid));
        $this->db->delete($this->table_events,array('id'=>$xid));
        $this->db->delete($this->table_markers,array('event_id'=>$xid));
		return $this->db->last_query();
    }	
 	 
    /**
    * update_event - Update the event in from the database
    *
    ****
    * @access public
    * @ Param $event, $title, $username, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $location, $markers_lat, $markers_lng
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function update_event($event, $title, $username, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $location, $markers_lat, $markers_lng) {
		 
		 $xtitle = $this->security->xss_clean($title);
           $new_event = array(
			    'id' 				=> $event, 
				'gid' 				=> $auth,
			    'title' 			=> $xtitle, 
			    'username' 			=> $username, 
			    'backgroundColor' 	=> $backgroundColor,
			    'borderColor' 		=> $borderColor,
			    'textColor' 		=> $textColor,
				'description'		=> $description,
			    'start' 			=> $start,  
		        'end' 				=> $end,
		        'url' 				=> $url,				
			    'allDay' 			=> $allDay, 
				'location' 			=> $location,
				'latitude' 			=> $markers_lat, 
				'longitude' 		=> $markers_lng 
				
			); 
					
			$this->db->where('eid',$event);
			$this->db->update($this->table_events,$new_event); 
			$this->db->insert($this->table_eventsqueues,$new_event); 
			return $this->db->last_query();

	}        
	
	/**
    * approve_event - Update the event in from the database
    *
    ****
    * @access public
    * @ Param $event, $title, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $location, $markers_lat, $markers_lng
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function approve_event($event, $title, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $location, $markers_lat, $markers_lng) {
		 
		 $xtitle = $this->security->xss_clean($title);
           $new_event = array(
				'gid' 				=> $auth,
			    'title' 			=> $xtitle,  
			    'backgroundColor' 	=> $backgroundColor,
			    'borderColor' 		=> $borderColor,
			    'textColor' 		=> $textColor,
				'description'		=> $description,
			    'start' 			=> $start,  
		        'end' 				=> $end,
		        'url' 				=> $url,				
			    'allDay' 			=> $allDay, 
				'location' 			=> $location,
				'latitude' 			=> $markers_lat, 
				'longitude' 		=> $markers_lng 
				
			); 
					
			$this->db->where('id',$event); 
			$this->db->update($this->table_events,$new_event);
			$this->db->delete($this->table_eventsqueues,array('id'=>$event)); 
			return $this->db->last_query();

	}    

	/**
    * approve_chk_event - update approve event and remove the event from queue
    *
    ****
    * @access public
    * @ Param $ id (event)
    * @ Return string with the last query
    */
    public function approve_chk_event($id)  {
		
		$xid = $this->security->xss_clean($id);
		$this->db->where('id',$xid); 
		$this->db->update($this->table_events,array('gid'=>$this->approve_value));
		$this->db->delete($this->table_eventsqueues,array('id'=>$xid)); 
		return $this->db->last_query();
    }	
	
    /**
    * update_eventForMarkers - Update the event in from the database
    *
    ****
    * @access public
    * @ Param $event, $location, $markers_lat, $markers_lng
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function update_eventForMarkers($event, $location, $markers_lat, $markers_lng) {
		  
           $new_event = array( 			
				'location' 			=> $location,
				'latitude' 			=> $markers_lat, 
				'longitude' 		=> $markers_lng  
			); 
			 
			$this->db->where('id',$event);
			$this->db->update($this->table_events,$new_event);
			$this->db->update($this->table_eventsqueues,$new_event);
			return $this->db->last_query();
	}    	

	
	/**
    * Update the user attachments
    * updateImage
    ****
    * @access public
    * @param $eid, $image 
    * @return none
    */
    function attachment($eid, $filename) { 
		 
	    $attach = array(
			'filename' 	=> $filename
		); 
			
		$this->db->where('eid', $eid);
		$this->db->update($this->table_events, $attach);
		return $this->db->last_query();
    }
	
    /**
    * get_eventByEId - get the event by id from the database
    *
    ****
    * @access public
    * @ Param id
    * @ Return results/false
    */		
	public function get_eventByEId($eid) {
		// return the user
		$this->db->where('eid', $eid);
		$this->db->limit(1);
		$query = $this->db->get($this->table_events);
		if ($query->num_rows() > 0) {
		    $result = $query->result();
		    return $result[0];
		}
		// no result
		return FALSE;
    }     
	
    /**
    * get_eventById - get the event by id from the database
    *
    ****
    * @access public
    * @ Param id
    * @ Return results/false
    */		
	public function get_eventById($id) {
		// return the user
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_events);
		if ($query->num_rows() > 0) {
		    $result = $query->result();
		    return $result[0];
		}
		// no result
		return FALSE;
    }     
	
	/**
    * get_queuesById - get the event by id from the database
    *
    ****
    * @access public
    * @ Param id
    * @ Return results/false
    */		
	public function get_queuesById($id) {
		// return the user
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_eventsqueues);
		if ($query->num_rows() > 0) {
		    $result = $query->result();
		    return $result[0];
		}
		// no result
		return FALSE;
    }
	
	/**
    * getAllEvents - Get all results of the events
    * 
    ****
    * @access public
    * @param int (limit), int (offset)  
    * @return true/false
    */
    public function getAllEvents($limit, $offset = 0) {
		// return all events
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('eid', 'DESC');
		$query = $this->db->get($this->table_events);
		// return the events
		if ($query->num_rows() > 0) { 
			$jsonevents = array();
			foreach ($query->result() as $entry)
			{
				$jsonevents[] = array(
					'id'     			=> $entry->id, 
					'gid'     			=> $entry->gid, 
					'eid'     			=> $entry->eid, 
					'title'     		=> $entry->title,
					'username'     		=> $entry->username,
					'category'     		=> $entry->category,
					'backgroundColor'	=> $entry->backgroundColor,
					'borderColor'		=> $entry->borderColor,
					'textColor'			=> $entry->textColor,
					'description'   	=> $entry->description,
					'start'     		=> $entry->start,
					'end'       		=> $entry->end,
					'allDay'    		=> $entry->allDay,
					'url'       		=> $entry->url, 
					'rendering'       	=> $entry->rendering,
					'overlap'       	=> ($entry->overlap=='true') ? true : false,
					'location'       	=> $entry->location, 
					'latitude' 			=> $entry->latitude, 
					'longitude'			=> $entry->longitude, 
					'filename'			=> $entry->filename,  
					'pubDate'			=> $entry->pubDate, 
					'token'				=> $this->security->get_csrf_hash() 
				);
			}			
				
			return $jsonevents;
		}
		// no result
		return FALSE;
    }

	/**
    * getAllQueueEvents - Get all queue results of the events
    * 
    ****
    * @access public
    * @param int (limit), int (offset)  
    * @return true/false
    */
    public function getAllQueueEvents($limit, $offset = 0) {
		// return all events
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->table_eventsqueues);
		// return the events
		if ($query->num_rows() > 0) { 
			$jsonqueues = array();
			foreach ($query->result() as $entry)
			{
				$jsonqueues[] = array(
					'id'     			=> $entry->id, 
					'eid'     			=> $entry->eid, 
					'gid'     			=> $entry->gid, 
					'title'     		=> $entry->title,
					'username'     		=> $entry->username,
					'category'     		=> $entry->category,
					'backgroundColor'	=> $entry->backgroundColor,
					'borderColor'		=> $entry->borderColor,
					'textColor'			=> $entry->textColor,
					'description'   	=> $entry->description,
					'start'     		=> $entry->start, 
					'end'       		=> $entry->end,
					'allDay'    		=> $entry->allDay,
					'url'       		=> $entry->url, 
					'rendering'       	=> $entry->rendering,
					'overlap'       	=> ($entry->overlap=='true') ? true : false,
					'location'       	=> $entry->location, 
					'latitude' 			=> $entry->latitude, 
					'longitude'			=> $entry->longitude, 
					'filename'			=> $entry->filename,  
					'pubDate'			=> $entry->pubDate, 
					'token'				=> $this->security->get_csrf_hash() 
				);
			}			
				
			return $jsonqueues;
		}
		// no result
		return FALSE;
    }
	
     /**
    * get_eventname - get the event by name
    *
    ****
    * @access public
    * @ Param $eventname
    * @ Return id/false
    */		
	public function get_eventname($eventname) { 
	
		$xeventname = $this->security->xss_clean($eventname);
		
		$this->db->where('title', $xeventname);
		$query = $this->db->get($this->table_events);
		// return the category
		if ($query->num_rows() > 0) {
			$result = $query->row();
			$eventid = $result->id;
			return $eventid;
		}
		// no result
		return FALSE;
    }
	
 
     /**
    * search_admin - Search private event by name
    *
    ****
    * @access public
    * @ Param $title, $username
    * @ Return json
    */		
	public function search_admin($title, $username) {
	
		$xtitle = $this->security->xss_clean($title);
		
		$events = $this->db->select('*')->from($this->table_events)->like('title', $xtitle)->or_like('category', $xtitle)->or_like('location', $xtitle)->order_by('start', 'asc')->get();
  
        $jsonevents = array();
        foreach ($events->result() as $entry)
        {
            $jsonevents[] = array(
				'id'     			=> $entry->id,
				'gid'       		=> $entry->gid, 
                'title'     		=> $entry->title,
                'category'     		=> $entry->category,
                'backgroundColor'	=> $entry->backgroundColor,
                'borderColor'		=> $entry->borderColor,
                'textColor'			=> $entry->textColor,
                'description'   	=> $entry->description,
                'start'     		=> $entry->start,
                'allDay'    		=> ($entry->allDay=='true') ? true : false,
                'end'       		=> $entry->end,
                'url'       		=> $entry->url, 
				'location'       	=> $entry->location,  
				
            );
        }
       echo json_encode($jsonevents);	 

    }	
	
     /**
    * countCalendarEvents - Count all events
	*
    ****
    * @access public
    * @ Param none
    * @ Return query
    */
    public function countCalendarEvents() {  
		return $this->db->count_all_results($this->table_events);
    }    
	
	/**
    * countEventsQueues - Count all events
	*
    ****
    * @access public
    * @ Param none
    * @ Return query
    */
    public function countEventsQueues() {  
		return $this->db->count_all_results($this->table_eventsqueues);
    }	
	
}
 
/* End of file fulcalendar_admin_model.php */
/* Location: ./application/models/fulcalendar_admin_model.php */