<?php
/**
 * Feed_model class
 *
 * Communicate with the member table in the database and profile controller (The middle guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/feed
 */ 
 
class Feed_model extends CI_Model 
{

	private $table_events = 'events';
	private $approve_value = -3;
   
    public function __construct() {
	
	$this->load->helper('security');
	$this->load->database();
    }
 
 
	public function get_allfeeds ($limit)	{
		 
		$this->db->where('gid', $this->approve_value);
		$this->db->order_by('eid', 'desc');
		$this->db->limit($limit);
		return $this->db->get($this->table_events);
	} 

}

/* End of file feed_model.php */
/* Location: ./application/models/feed_model.php */