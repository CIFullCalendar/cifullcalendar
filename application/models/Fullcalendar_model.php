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
 
class Fullcalendar_model extends CI_Model {

	protected $table_events = 'events';
	protected $table_queues = 'eventsqueues';
	protected $table_eventsqueues = 'eventsqueues';
	protected $table_category = 'category';
	protected $table_calendar_properties = 'users_calendar';
	protected $private_value = 0;
	protected $public_value = -1;
	
	//update the approve value
	protected $approve_value = -3;
	

    public function __construct() {
	$this->load->database();
	$this->load->model('gmaps_model');	
	
	$this->load->helper('string');
	$this->load->helper('security');
	
	$this->load->library('ion_auth'); 
    }
	
    /**
    * jsonPublicEvents - Reads public events from the database
    * Print data in json format
    ****
    * @access public
    * @param none
    * @return json events
    */   
    public function jsonPublicEvents()    {       
       
       $events = $this->db->select('*')->from($this->table_events)->where('gid', $this->approve_value)->order_by('start', 'desc')->get();
	   
        $jsonpublicevents = array();
        foreach ($events->result() as $entry)
        {
            $jsonpublicevents[] = array( 
                'id'     			=> $entry->id,
                'title'     		=> $entry->title,
				'resourceId'       	=> $entry->category,  				
				'backgroundColor'	=> $entry->backgroundColor,
                'borderColor'		=> $entry->borderColor,
                'textColor'			=> $entry->textColor,
                'description'   	=> $entry->description,
                'start'     		=> $entry->start, 
                'end'       		=> $entry->end,
                'allDay'    		=> ($entry->allDay=='true') ? true : false, 
                'url'       		=> $entry->url, 
				'recurdays'       	=> $entry->recurdays,  
				'rendering'       	=> $entry->rendering,  
				'overlap'       	=> ($entry->overlap=='true') ? true : false,
				'recurend'       	=> $entry->recurend, 
				'location'       	=> $entry->location, 
				'latitude' 			=> $entry->latitude, 
				'longitude'			=> $entry->longitude, 
				'filename'			=> $entry->filename, 
				'filesize'			=> $entry->filesize, 
				'alldayText'    	=> ($entry->allDay=='true') ? 'All Day' : '', 
				'filedata'			=> base64_encode($entry->fileblob)
            );
        }
       return $jsonpublicevents;
    }
	
    /**
    * jsonUserPublicEvents - Get public events from the database
    * Print data in json format
    ****
    * @access public
    * @param none
    * @return json events
    */   
    public function jsonUserPublicEvents($username)    {       
       
	   $xusername = $this->security->xss_clean($username);
       $events = $this->db->select('*')->from($this->table_events)->where('username', $xusername)->where('gid', $this->approve_value)->order_by('start', 'desc')->get();
	   
        $jsonpublicevents = array();
        foreach ($events->result() as $entry) {
            $jsonpublicevents[] = array( 
                'title'     		=> $entry->title,
				'resourceId'       	=> $entry->category,  			
				'backgroundColor'	=> $entry->backgroundColor,
                'borderColor'		=> $entry->borderColor,
                'textColor'			=> $entry->textColor,
                'description'   	=> $entry->description,
                'start'     		=> $entry->start, 
                'end'       		=> $entry->end,
				'allDay'    		=> ($entry->allDay=='true') ? true : false,   
                'url'       		=> $entry->url, 
				'recurdays'       	=> $entry->recurdays,  
				'rendering'       	=> $entry->rendering,  
				'overlap'       	=> ($entry->overlap=='true') ? true : false,
				'recurend'       	=> $entry->recurend, 
				'location'       	=> $entry->location, 
				'latitude' 			=> $entry->latitude, 
				'longitude'			=> $entry->longitude, 
				'filename'			=> $entry->filename, 
				'filesize'			=> $entry->filesize, 
				'filedata'			=> base64_encode($entry->fileblob), 
				'alldayText'    	=> ($entry->allDay=='true') ? 'All Day' : '', 
				'pubDate'			=> $entry->pubDate				
            );
        }
		
       return $jsonpublicevents;
    }	
	
    /**
    * jsonEvents - Get members events from the database
    * Print data in json format
    ****
    * @access private
    * @param none
    * @return json events
    */   
	public function jsonEvents($user)    {        
	 
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($user->id)->result(); 
		$checked = 0;
		
		$this->db->select('*')->from($this->table_events);
		$this->db->where('username', $user->username);
		foreach ($groups as $group){			
			foreach($currentGroups as $usergroup) { 
				  $checked = $usergroup->id;	
			      $this->db->or_where('gid', $checked)->order_by('start', 'desc'); 	
			}
			
		} 
			
		$events = $this->db->get();
	 
        $jsonevents = array();
        foreach ($events->result() as $entry) {

            $jsonevents[] = array( 
                'eid'     			=> $entry->eid,
				'id'     			=> $entry->id,
				'gid'       		=> ($entry->gid == $this->approve_value) ? $this->public_value : $entry->gid, 
				'username'       	=> $entry->username, 
                'title'     		=> $entry->title,
				'resourceId'       	=> $entry->category, 
                'category'     		=> $entry->category,
                'backgroundColor'	=> $entry->backgroundColor,
                'borderColor'		=> $entry->borderColor,
                'textColor'			=> $entry->textColor,
                'description'   	=> $entry->description,
                'start'     		=> $entry->start,
				'end'       		=> $entry->end,
                'allDay'    		=> ($entry->allDay=='true') ? true : false,                
                'url'       		=> $entry->url,
				'recurdays'       	=> $entry->recurdays,  
				'rendering'       	=> $entry->rendering,     
				'overlap'       	=> ($entry->overlap=='true') ? true : false,
				'recurend'       	=> $entry->recurend,  
				'location'       	=> $entry->location, 
				'latitude' 			=> $entry->latitude, 
				'longitude'			=> $entry->longitude, 
				'filename'			=> $entry->filename,   
				'filesize'			=> $entry->filesize, 
				'filedata'			=> base64_encode($entry->fileblob), 			
				'token'				=> $this->security->get_csrf_hash()
				
            );
        }
		
       return $jsonevents;
    }
	
	/**
    * category - the event makers in the database
    * Print data in json format
    ****
    * @access public
    * @ Param events
    * @ Return string with the last query 
    */		
	function jsonEventsCategory($category, $username)	{
		
		if(!empty($category)) {

			$this->db->select('*')->from($this->table_events);   
			$this->db->where("category in (". implode(",",array($category)) .")");  
		 
			$events = $this->db->get();		 
	  
			$jsonevents = array();
			foreach ($events->result() as $entry)
			{
				$jsonevents[] = array( 
					'eid'     			=> $entry->eid,
					'id'     			=> $entry->id,
					'gid'       		=> ($entry->gid == $this->approve_value) ? $this->public_value : $entry->gid, 
					'username'       	=> $entry->username,
					'title'     		=> $entry->title,
					'resourceId'       	=> $entry->category, 
					'category'     		=> $entry->category,
					'backgroundColor'	=> $entry->backgroundColor,
					'borderColor'		=> $entry->borderColor,
					'textColor'			=> $entry->textColor,
					'description'   	=> $entry->description,
					'start'     		=> $entry->start,
					'end'       		=> $entry->end,
					'allDay'    		=> ($entry->allDay=='true') ? true : false,
					'url'       		=> $entry->url, 
					'recurdays'       	=> $entry->recurdays,  
					'recurend'       	=> $entry->recurend,
					'overlap'       	=> ($entry->overlap=='true') ? true : false, 
					'location'       	=> $entry->location, 
					'latitude' 			=> $entry->latitude, 
					'longitude'			=> $entry->longitude, 
					'filename'			=> $entry->filename,   
					'filesize'			=> $entry->filesize, 
					'filedata'			=> base64_encode($entry->fileblob), 
					'token'			    => $this->security->get_csrf_hash(), 
					
				);
			}
		  
		  
		  return $jsonevents;
	 
		}	   
	}
	
    /**
    * jsonPublicResources - Get members public resources from the database
    * resources
    ****
    * @access public
    * @param none
    * @return json events
    */   
	public function jsonPublicResources()    {        
	  
		$groups = $this->ion_auth->groups()->result_array(); 
		$checked = 0; 

		$this->db->select('*')->from($this->table_category); 
		foreach ($groups as $group){			 
			  $checked = $this->public_value;	
			  $this->db->or_where('gid', $checked)->order_by('category_name', 'ASC');  
		} 
			
		$categories = $this->db->get(); 
		
        $jsonresources = array();
        foreach ($categories->result() as $entry)
        {
            $jsonresources[] = array(
				'id'     			=> $entry->category_id, 
				'title'       		=> $entry->category_name, 
				'eventColor'       	=> $entry->backgroundColor,     
            );
        }
		
       return $jsonresources;
    }    
	
	/**
    * jsonResources - Get members resources from the database
    * resources
    ****
    * @access public
    * @param Array
    * @return json events
    */   
	public function jsonResources($user)    {        
	  
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($user->id)->result(); 
		$checked = 0;
		
		$this->db->select('*')->from($this->table_category);
		$this->db->where('username', $user->username); 
		foreach ($groups as $group){			
			foreach($currentGroups as $usergroup) { 
				  $checked = $usergroup->id;	 
			      $this->db->or_where('gid', $checked)->order_by('category_name', 'ASC'); 	
			}
			
		} 
			
		$categories = $this->db->get(); 
		
        $jsonresources = array();
        foreach ($categories->result() as $entry)
        {
            $jsonresources[] = array(
				'id'     			=> $entry->category_id, 
				'title'       		=> $entry->category_name, 
				'eventColor'       	=> $entry->backgroundColor,     
            );
        }
       
	   return $jsonresources;
    }

    /**
    * jsonEventsGroups - the event groups in the database
    * Print data in json format
    ****
    * @access public
    * @ Param $group, $user
    * @ Return string with the last query 
    */		
	function jsonEventsGroups($group, $user){ 
     
		if(empty($group)) {
			return '';
		}
		$this->db->select('*')->from($this->table_events);   
		$this->db->where("gid in (". implode(",",array($group)) .")");  
     
		$events = $this->db->get();
		
        $jsonevents = array();
        foreach ($events->result() as $entry)
        {
            $jsonevents[] = array( 
                'eid'     			=> $entry->eid,
				'id'     			=> $entry->id,
				'gid'       		=> ($entry->gid == $this->approve_value) ? $this->public_value : $entry->gid, 
				'username'       	=> $entry->username,
                'title'     		=> $entry->title,
				'resourceId'       	=> $entry->category, 
                'category'     		=> $entry->category,
                'backgroundColor'	=> $entry->backgroundColor,
                'borderColor'		=> $entry->borderColor,
                'textColor'			=> $entry->textColor,
                'description'   	=> $entry->description,
                'start'     		=> $entry->start,
				'end'       		=> $entry->end,
                'allDay'    		=> ($entry->allDay=='true') ? true : false,
                'url'       		=> $entry->url, 
				'recurdays'       	=> $entry->recurdays,  
				'recurend'       	=> $entry->recurend,
				'overlap'       	=> ($entry->overlap=='true') ? true : false, 
				'location'       	=> $entry->location, 
				'latitude' 			=> $entry->latitude, 
				'longitude'			=> $entry->longitude, 
				'filename'			=> $entry->filename,   
				'filesize'			=> $entry->filesize, 
				'filedata'			=> base64_encode($entry->fileblob),  
				'token'			    => $this->security->get_csrf_hash(), 
				
            );
        }
  
	    return $jsonevents;
	}	
	
	
	/**
    * jsonDefineProperties - Get members events from the database
    * Print data in json format
    ****
    * @access private
    * @param none
    * @return json events
    */   
	public function jsonDefineProperties($user)    {        
	  	
		$this->db->select('*')->from($this->table_calendar_properties);
		$this->db->where('user_id', $user->id);
 
			
		$props = $this->db->get();
	 
        $results = array();
        foreach ($props->result() as $entry) {

            $results[] = array( 
				'id'					=> $entry->id,	
				'cal_timezone'			=> $entry->cal_timezone,	
				'cal_defaultview'		=> $entry->cal_defaultview,
				'cal_header_left'		=> $entry->cal_header_left,
				'cal_header_center'		=> $entry->cal_header_center,
				'cal_header_right'		=> $entry->cal_header_right,
				'cal_editable'			=> $entry->cal_editable,
				'cal_firstday'			=> $entry->cal_firstday,
				'cal_businessstart'		=> $entry->cal_businessstart,
				'cal_businessend'		=> $entry->cal_businessend,
				'cal_businessdays'		=> $entry->cal_businessdays,
				'cal_hiddendays'		=> $entry->cal_hiddendays,
				'cal_isrtl'				=> $entry->cal_isrtl,
				'cal_weeknumbers'		=> $entry->cal_weeknumbers,
				'cal_weeknumberswithindays'		=> $entry->cal_weeknumberswithindays,
				'cal_eventlimit'	=> $entry->cal_eventlimit,
				'cal_alldayslot'		=> $entry->cal_alldayslot,
				'cal_slotduration'		=> $entry->cal_slotduration,
				'cal_slotlabeling'		=> $entry->cal_slotlabeling,
				'cal_slotlabelformat'	=> $entry->cal_slotlabelformat,
				'cal_aspectratio'		=> $entry->cal_aspectratio,
				'cal_mintime'			=> $entry->cal_mintime,
				'cal_maxtime'			=> $entry->cal_maxtime,
				'cal_maxtime'			=> $entry->cal_maxtime,				
				'token'				=> $this->security->get_csrf_hash()
				
            );
        }
		
       return $results;
    }
	
    /**
    * drag_drop_event - Change the date of an event in the database
    *
    ****
    * @access public
    * @ Param $ data
    * @ Return string with the last query (this should be overridden in production)
    */
    public function drag_drop_event($data)    {
	
        extract($data);
        $new_event = array(
            'id' =>  $id,
            'username' =>  $username,
            'category' =>  $category,
            'title' =>  $title,
            'description' =>  $description,
            'rendering' =>  $rendering,
            'backgroundColor' =>  $backgroundColor,
            'borderColor' =>  $borderColor,
            'textColor' =>  $textColor,
            'start' =>  $start,
            'end'   =>  $end,
            'allDay' =>  $allDay
        );
         
        $this->db->insert($this->table_events,$new_event);
        return $this->db->last_query();
    }    
	/**
    * Change the date of an event in the database
    *
    ****
    * @access public
    * @ Param $ data
    * @ Return string with the last query (this should be overridden in production)
    */
    public function drop_event($data)    {
	
        extract($data);
        $new_event = array(
            'start' =>  $daystart,
            'end'   =>  $dayend,
            'allDay' =>  $allDay,
			'category' => $resourceId,
        );
		
	 	if (!empty($event)) { 
			$this->db->where('id',$event);
			$this->db->update($this->table_events,$new_event);
			return $this->db->last_query();
		}
		// no result
		return FALSE;  
    }
 
    /**
    * Changes the dates of an event in the database
    *
    ****
    * @access public
    * @ Param $ data
    * @ Return string with the last query (this should be overridden in production)
    */
    public function resize($data)    {
	
        extract($data);
        $new_event = array(
            'start' =>  $daystart,
            'end'   =>  $dayend,
			'allDay' =>  $allDay 
        );
       
	 	if (!empty($event)) { 
			$this->db->where('id',$event);
			$this->db->update($this->table_events,$new_event);
			return $this->db->last_query(); 
		}
		// no result
		return FALSE;   
    }

    /**
    * profile_del the event in the database
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
    * delete_event - clears the event in the database
    *
    ****
    * @access public
    * @ Param $ id (event)
    * @ Return string with the last query
    */
    public function delete_event($id)  {
		 
		$file = $this->get_eventById($id);
		if($file->filename != ''){
			unlink('./assets/attachments/' . $file->filename);  
		} 
		$this->gmaps_model->delete_marker($id);	
			 
        $this->db->delete($this->table_events,array('id'=>$id));
        $this->db->delete($this->table_queues,array('id'=>$id));
		return $this->db->last_query();
    }	
  
    /**
    * add the event in the database
    *
    ****
    * @access public
    * @ Param $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $location, $markers_lat, $markers_lng, $username
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function add_event($id, $rid, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $rendering, $overlap, $recurring, $endrecurring, $auth, $location, $markers_lat, $markers_lng, $username) {
		
			$xusername = $this->security->xss_clean($username);
			$xtitle = $this->security->xss_clean($title); 
		  
			   $new_event = array(
					'id'	=> $id,
					'rid'	=> $rid,					
					'gid' => $auth,
					"title" => $xtitle,
					'category' => $marker_category,
					'backgroundColor' => $backgroundColor,
					'borderColor' => $borderColor,
					'textColor' => $textColor,
					'description' => $description,
					'start' => $start,  
					'end' => $end,
					'url' => $url,				
					'allDay' => $allDay, 
					'rendering' => $rendering,
					'overlap' => $overlap,
					'recurdays' => $recurring, 
					'recurend' => $endrecurring,
					'location' => $location, 
					'latitude' => $markers_lat, 
					'longitude' => $markers_lng, 
					'username' => $xusername
					
				); 				
			
			if($auth == $this->public_value){				
				$this->db->insert($this->table_events,$new_event);
				$this->db->insert($this->table_eventsqueues, $new_event);
				return $this->db->last_query();				
			}else if($auth == $this->private_value || $auth > -2){
				$this->db->insert($this->table_events, $new_event);
				return $this->db->last_query();		
			}
			
		// no result
		return FALSE;
	}
 
    /**
    * update the event in the database
    *
    ****
    * @access public
    * @ Param $event, $title, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $location, $markers_lat, $markers_lng, $username
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function update_event($event, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $rendering, $overlap, $location, $markers_lat, $markers_lng, $username) {
		 
		 $xusername = $this->security->xss_clean($username);
		 $xtitle = $this->security->xss_clean($title);
           $new_event = array(
			    'id' 				=> $event,
				'gid' 				=> $auth,
			    'title' 			=> $xtitle,
				'category'			=> $marker_category,
			    'backgroundColor' 	=> $backgroundColor,
			    'borderColor' 		=> $borderColor,
			    'textColor' 		=> $textColor,
				'description'		=> $description,
			    'start' 			=> $start,  
		        'end' 				=> $end,
		        'url' 				=> $url,				
			    'allDay' 			=> $allDay, 
				'rendering' 		=> $rendering,
				'overlap' 			=> $overlap,				
				'location' 			=> $location,
				'latitude' 			=> $markers_lat, 
				'longitude' 		=> $markers_lng, 
				'username' 			=> $xusername
			); 
			
			if($auth == $this->public_value){
				$this->db->where('id',$event);				 
				$this->db->update($this->table_events,$new_event);
				$this->db->insert($this->table_eventsqueues,$new_event);
				return $this->db->last_query();		
			}else if($auth == $this->private_value || $auth > -2){
				$this->db->where('id',$event);
				$this->db->update($this->table_events,$new_event);
				return $this->db->last_query(); 	
			}  
			
		// no result
		return FALSE;
	}     
	
	/**
    * update the recurring event in the database
    *
    ****
    * @access public
    * @ Param $event, $title, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $location, $markers_lat, $markers_lng, $username
    * @ Return string with the last query (this should be overridden in production)
    */		
	public function update_events($eid, $event, $title, $marker_category, $backgroundColor, $borderColor, $textColor, $description, $start, $end, $url, $allDay, $auth, $rendering, $overlap, $location, $markers_lat, $markers_lng, $username) {
		 
		 $xusername = $this->security->xss_clean($username);
		 $xtitle = $this->security->xss_clean($title);
           $new_event = array(
			    'eid' 				=> $eid,
			    'id' 				=> $event,
				'gid' 				=> $auth,
			    'title' 			=> $xtitle,
				'category'			=> $marker_category,
			    'backgroundColor' 	=> $backgroundColor,
			    'borderColor' 		=> $borderColor,
			    'textColor' 		=> $textColor,
				'description'		=> $description,
			    'start' 			=> $start,  
		        'end' 				=> $end,
		        'url' 				=> $url,				
			    'allDay' 			=> $allDay, 
				'rendering' 		=> $rendering,
				'overlap' 			=> $overlap,				
				'location' 			=> $location,
				'latitude' 			=> $markers_lat, 
				'longitude' 		=> $markers_lng, 
				'username' 			=> $xusername
			); 
			
			if($auth == $this->public_value){
				$this->db->where('eid',$eid);				 
				$this->db->update($this->table_events,$new_event);
				$this->db->insert($this->table_eventsqueues,$new_event);
				return $this->db->last_query();		
			}else if($auth == $this->private_value || $auth > -2){
				$this->db->where('eid',$eid);
				$this->db->update($this->table_events,$new_event);
				return $this->db->last_query(); 	
			}  
			
		// no result
		return FALSE;
	}
 
 
	/**
    * mark_reminded public event by id
    *
    ****
    * @access public
    * @ Param $eid
    * @ Return int
    */	
	public function mark_reminded($eid)  {
		return $this->db->where('eid', $eid)->update($this->table_events, array('reminder' => 1));
	}
   
	/**
    * Update the user attachments
    * updateImage
    ****
    * @access public
    * @param $eid, $blob 
    * @return none
    */
    function attachment($id, $auth, $blob) { 
		$attached_data = file_get_contents($blob['full_path']);//get the content of the image using its path 
	    $attach = array(
			'filename' 	=> $blob['file_name'], 
			'filesize' 	=> $blob['file_size'],
			'fileblob' 	=> $attached_data
		); 

		if($auth == $this->public_value){
			$this->db->where('id', $id)->update($this->table_events, $attach); 
			$this->db->where('id', $id)->update($this->table_eventsqueues, $attach);  
			return $this->db->last_query();	 	
		}else{
			$this->db->where('id', $id);
			$this->db->update($this->table_events, $attach); 
			return $this->db->last_query();	 
		}		

    }
	
     /**
    * get the event by id the database
    *
    ****
    * @access public
    * @ Param id
    * @ Return results/false
    */		
	function get_eventById($id) { 
	
		$query = $this->db->select('*') 
						  ->where('id', $id)
						  ->limit(1)
						  ->order_by('id', 'desc')
						  ->get($this->table_events); 
		if ($query->num_rows() > 0) {
		   // $result = $query->result();
		   return $query->row();
		}
		// no result
		return FALSE;
    }

	/**
    * get the event by eid the database
    * 
    ****
    * @access public
    * @ Param id
    * @ Return results/false
    */		
	function get_eventByEid($eid) { 
	
		$query = $this->db->select('*') 
						  ->where('eid', $eid)
						  ->limit(1)
						  ->order_by('eid', 'desc')
						  ->get($this->table_events); 
		if ($query->num_rows() > 0) {
		   // $result = $query->result();
		   return $query->row();
		}
		// no result
		return FALSE;
    }	
	
	/**
    * import event by user
    *
    ****
    * @access public
    * @ Param $eventname
    * @ Return id
    */		
	public function import($username, $ical_data) {
	
		$xusername = $this->security->xss_clean($username); 
		$gid = $this->public_value;
		$location = ""; 
		$recurdays = 0;
		$url = "";
		$allday = "true";
		$getTime = "";
		$filename = "";
		
		$sqlstr = "INSERT into ".$this->db->dbprefix($this->table_events)."(id,gid,username,start,end,allDay,url,title,location,description,recurdays,category,backgroundColor,borderColor,textColor,latitude,longitude,filename) VALUES  ";
		if (!empty($ical_data['VEVENT']) || !empty($ical_data['UID'])) {
			foreach ($ical_data['VEVENT'] as $key => $data) {
				
				# Replace HTML tags	
				$search = array("/'/","/\,/");   
				$replace = array("\'","\,");					
				 			
				$insert_id = random_string('numeric', 5);
				
				//get StartDate And StartTime
				$start_dttimearr = $this->security->xss_clean($data['DTSTART']); 
				if(!empty($start_dttimearr)){
					$getTime=explode("T",$start_dttimearr);
					if(!empty($getTime[1])){
						$allday="false";						
					}else{$allday="true";}
					$insert_start = date("Y-m-d H:i:s", strtotime(strtolower($start_dttimearr))); 
				}
				//get EndDate And EndTime
				$end_dttimearr = $this->security->xss_clean($data['DTEND']); 
				if(!empty($end_dttimearr)){
					$getTime=explode("T",$end_dttimearr);
					if(!empty($getTime[1])){
						$allday="false";						
					}else{$allday="true";}
					$insert_end = date("Y-m-d H:i:s", strtotime(strtolower($end_dttimearr))); 
				}

				if (!empty($data['URL'])) {
					$url = $this->security->xss_clean($data['URL']);
				}else{$url = "";}				
				
				if (!empty($data['RRULE'])) { 
					 $recur = $this->security->xss_clean($data['RRULE']); 
					 
					 if($recur == "DAILY") {
						 $recurdays = 1;
					 }else if($recur == "WEEKLY") {
						 $recurdays = 7;
					 }else if($recur == "MONTHLY") {
						 $recurdays = 30;
					 }else if($recur == "YEARLY") {
						 $recurdays = 30;
					 }
					 
				}else{$recurdays = 0;}								
				
				if (!empty($data['DESCRIPTION'])) {
					$raw_description = $this->security->xss_clean($data['DESCRIPTION']); 
					$description = preg_replace($search, $replace, $raw_description); 
				}else{$description = "";}	
				
				if (!empty($data['SUMMARY'])) {
					$raw_summary = $this->security->xss_clean($data['SUMMARY']);
					$summary = preg_replace($search, $replace, $raw_summary); 
				}else{$summary = "";}	
								
				if (!empty($data['LOCATION'])) {
					$raw_location = $this->security->xss_clean($data['LOCATION']);
					$location = preg_replace($search, $replace, $raw_location); 
				}else{$location = "";}					
									
				if (!empty($data['GEO'])) {
					$geo = explode(';', $data['GEO']);
					$latitude = $this->security->xss_clean($geo[0]);
					$longitude = $this->security->xss_clean($geo[1]);
				}else{$latitude = 0;$longitude = 0;}	

				if (!empty($data['CATEGORIES'])) {
					$raw_category = $this->security->xss_clean($data['CATEGORIES']);
					$category = preg_replace($search, $replace, $raw_category); 
				}else{$category = "";}	
				
				if (!empty($data['BACKGROUNDCOLOR'])) {
					$bgcolor = $this->security->xss_clean($data['BACKGROUNDCOLOR']);
				}else{$bgcolor = "";}		
				
				if (!empty($data['BORDERCOLOR'])) {
					$bordercolor = $this->security->xss_clean($data['BORDERCOLOR']);
				}else{$bordercolor = "";}	
				
				if (!empty($data['TEXTCOLOR'])) {
					$textcolor = $this->security->xss_clean($data['TEXTCOLOR']);
				}else{$textcolor = "";}	
				
				if (!empty($data['CLASS'])) {
					if($data['CLASS'] == "PUBLIC") {$gid = $this->public_value; }else{$gid = $this->private_value;}
				}					
				
				if (!empty($data['ATTACH'])) {
					$filename = $this->security->xss_clean($data['ATTACH']);
				}	
				
				$sqlstr.="('" . $insert_id . "','" . $gid . "','" . $xusername . "','" . $insert_start . "','" . $insert_end . "','" . $allday . "','" . $url . "','" . $summary . "','" . $location . "','" . $description . "','" . $recurdays . "','" . $category . "','" . $bgcolor . "','" . $bordercolor . "','" . $textcolor . "','" . $latitude . "','" . $longitude . "','" . $filename . "')";
				$sqlstr.=",";
			}
			
			$sqlstr = rtrim($sqlstr, ','); 
			$this->db->query($sqlstr); 
			return $this->db->last_query();  
		}
			
    }	
     /**
    * export public event by name
    *
    ****
    * @access public
    * @ Param $eventname
    * @ Return id
    */		
	public function export($username, $id = 0, $timezone, $lang) { 
		 
		$xusername = $this->security->xss_clean($username); 
		$xid = $this->security->xss_clean($id); 
		$transp = "";
		$ics_data = "";
		$filepath = "";
		$rec = "";
		$uri = "";
		
		$ics_data .= "BEGIN:VCALENDAR\n";
		$ics_data .= "PRODID:-//SIRDRE//CIFULLCALENDAR//". strtoupper($lang) ."\n";
		$ics_data .= "VERSION:2.0\n";		
		$ics_data .= "CALSCALE:GREGORIAN\n";		
		$ics_data .= "METHOD:PUBLISH\n";
		$ics_data .= "X-WR-CALNAME: ". strtoupper($xusername) ." CALENDAR\n";

		# Change the timezone if needed
		$ics_data .= "X-WR-TIMEZONE:". $timezone ."\n";
		
		if($xid == 0) {
		  $events = $this->db->select('*')->from($this->table_events)->where('username', $xusername)->order_by('start', 'ASC')->get();
		}else {
		  $events = $this->db->select('*')->from($this->table_events)->where('username', $xusername)->where('id', $xid)->order_by('start', 'ASC')->get();
		}
		
			foreach ($events->result() as $entry) {
				$id 				= $entry->id;				
				$gid 				= $entry->gid;
				$start_date 		= $entry->start;
				$start_time 		= $entry->start;
				$end_date 			= $entry->end;
				$end_time 			= $entry->end;
				$title 				= $entry->title;
				$url 				= $entry->url;
				$location 			= $entry->location;
				$description 		= $entry->description;
				$backgroundColor 	= $entry->backgroundColor;
				$borderColor 		= $entry->borderColor;
				$textColor 			= $entry->textColor;
				$rendering 			= $entry->rendering;
				$recurdays 			= $entry->recurdays;
				$recurend 			= $entry->recurend;
				$category 			= $entry->category;
				$latitude 			= $entry->latitude;
				$longitude 			= $entry->longitude;
				$filename 			= $entry->filename;
				 
				# Replace HTML tags				
				$search = array("/<br>/","/&amp;/","/&rarr;/","/&larr;/","/,/","/;/");
				$replace = array("\\n","&","-->","<--","\\,","\\;");    
				
				$title = preg_replace($search, $replace, $title);
				$location = preg_replace($search, $replace, $location);
				$description = preg_replace($search, $replace, $description);
				$url = preg_replace($search, $replace, $url);
				
				$attach = base_url("assets/attachments/".$filename);
								
				if($recurdays==0){
					$rec = "";
				}else if($recurdays==1){
					$rec = "RRULE:FREQ=DAILY\n";
				}else if($recurdays==7){
					$rec = "RRULE:FREQ=WEEKLY\n";
				}else if($recurdays==30){
					$rec = "RRULE:FREQ=MONTHLY\n";
				}else if($recurdays==365){
					$rec = "RRULE:FREQ=YEARLY\n";
				} 
				
				if($rendering == "background") {$transp = "TRANSPARENT"; }else {$transp = "OPAQUE";} 
				if($gid == $this->public_value) {$class = "PUBLIC"; }else{$class = "PRIVATE"; } 
				if($filename != ''){ $filepath = "ATTACH;FMTTYPE=application/postscript:".$attach."\n";	}else {$filepath = "";}
				if($url != ''){ $uri = "URL:".$url."\n";}else {$uri = "";}
				
				# print ICS contents
				$ics_data .= "BEGIN:VEVENT\n";
				$ics_data .= "DTSTAMP:" . date('Ymd') . "T" . date('His') . "Z\n";
				$ics_data .= "UID:" . $id . "@". $xusername ."\n";
				$ics_data .= "CREATED:" . date('Ymd', strtotime($start_date)) . "T" . date('His', strtotime($start_time)) . "Z\n";
				$ics_data .= "LAST-MODIFIED:" . date('Ymd') . "T" . date('His') . "Z\n";
				$ics_data .= "SEQUENCE:0\n";				
				$ics_data .= "STATUS:CONFIRM\n";
				$ics_data .= "SUMMARY:". $title ."\n";	
				$ics_data .= "DESCRIPTION:" . $description . "\n";				
				$ics_data .= "DTSTART:" . date('Ymd', strtotime($start_date)) . "T" . date('His', strtotime($start_time)) . "\n";
				$ics_data .= "DTEND:" . date('Ymd', strtotime($end_date)) . "T" . date('His', strtotime($end_time)) . "\n";
				$ics_data .= "TRANSP:" . $transp . "\n";				
				$ics_data .= "LOCATION:" . $location . "\n";
				$ics_data .= "GEO:" . $latitude . ";" . $longitude . "\n";
				$ics_data .= "CATEGORIES:" . $category . "\n";
				$ics_data .= "BACKGROUNDCOLOR:" . $backgroundColor . "\n";
				$ics_data .= "BORDERCOLOR:" . $borderColor . "\n";
				$ics_data .= "TEXTCOLOR:" . $textColor . "\n"; 
				$ics_data .= "CLASS:" . $class . "\n";
				$ics_data .= "" . $uri . "";
				$ics_data .= "" . $rec . "";
				$ics_data .= "" . $filepath . ""; 
				$ics_data .= "END:VEVENT\n";
			}
			$ics_data .= "END:VCALENDAR\n";
			
			return $ics_data;
		
    }	
      
	/**
    * search public event by name
    *
    ****
    * @access public
    * @ Param $title
    * @ Return id
    */		
	public function search($title) {
	
		 $xtitle = $this->security->xss_clean($title);
		
		if(!empty($xtitle)){
			$events = $this->db->select('*')->from($this->table_events)->where('gid', $this->approve_value)->like('title', $xtitle)->order_by('start', 'asc')->get();

			$jsonevents = array();
			foreach ($events->result() as $entry){
				$jsonevents[] = array(
					'id'     			=> $entry->id,
					'gid'       		=> $entry->gid, 
					'title'     		=> $entry->title,
					'resourceId'       	=> $entry->category, 
					'category'     		=> $entry->category,
					'backgroundColor'	=> $entry->backgroundColor,
					'borderColor'		=> $entry->borderColor,
					'textColor'			=> $entry->textColor,
					'description'   	=> $entry->description,
					'start'     		=> $entry->start,
					'end'       		=> $entry->end,
					'allDay'    		=> ($entry->allDay=='true') ? true : false,
					'url'       		=> $entry->url, 
					'location'       	=> $entry->location,  
					'filename'			=> $entry->filename, 
					
				);
			}
			echo json_encode($jsonevents);	 
		}

    }
 
     /**
    * search private event by name
    *
    ****
    * @access public
    * @ Param $title, $username
    * @ Return id
    */		
	public function search_private($title, $username) { 
		
		if(!empty($title)){
			$events = $this->db->select('*')->from($this->table_events)->where('username', $username)->like('title', $title)->order_by('start', 'asc')->get();

			$jsonevents = array();
			foreach ($events->result() as $entry){
				$jsonevents[] = array(
					'id'     			=> $entry->id,
					'gid'       		=> $entry->gid, 
					'title'     		=> $entry->title,
					'resourceId'       	=> $entry->category, 
					'category'     		=> $entry->category,
					'backgroundColor'	=> $entry->backgroundColor,
					'borderColor'		=> $entry->borderColor,
					'textColor'			=> $entry->textColor,
					'description'   	=> $entry->description,
					'start'     		=> $entry->start,                
					'end'       		=> $entry->end,
					'allDay'    		=> ($entry->allDay=='true') ? true : false,
					'url'       		=> $entry->url, 
					'location'       	=> $entry->location,  
					'filename'			=> $entry->filename, 
					
				);
			}
			
			return json_encode($jsonevents);	 
		}

    }	
	
     /**
    * countCalendarEvents - Admin reviews
	*
    ****
    * @access public
    * @ Param $title, $username
    * @ Return id
    */
    public function countEventsByUsername($username) {  
	
		$xusername = $this->security->xss_clean($username);
		
		$this->db->where('username', $xusername); 
		$this->db->where('gid', $this->approve_value); 		
		return $this->db->count_all_results($this->table_events);
    }	
	
}
 
/* End of file fulcalendar.php */
/* Location: ./application/models/fulcalendar.php */