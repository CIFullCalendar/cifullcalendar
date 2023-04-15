<?php
/**
 * Settings Model class
 *
 * Communicate with the settings table in the database and all controllers (The middle guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/admin/settings
 */ 
 
class Setting_model extends CI_Model 
{
	
	private $table_settings = 'setting';

  
    public function __construct() {
		
		$this->load->helper('security'); 
		$this->load->database();
	}
	
    /**
    * Insert new settings value into settings table of the database
    * addSetting
    ****
    * @access public
    * @param varchar (name) 
    * @param varchar (value) 
    * @return id/false
    */
    public function addSetting($name, $value = '') { 
	
		$xname = $this->security->xss_clean($name);
		$xvalue = $this->security->xss_clean($value);
		
		$setting_name = url_title($xname, '-', TRUE);
		if (!$this->checkSettingExists($setting_name)) {
			$data = array(
			'name' => $xname,
			'value' => $value
			);
			// add the setting
			$this->db->insert($this->table_settings, $data);
			$setting = $this->getSettingByName($setting_name);
			// return the setting id
			return $setting->id;
		} else {
			// setting already exists... return FALSE
			return FALSE;
		}
    }

    /**
    * Check a setting exists and return TRUE or FALSE
    * checkSettingExists
    ****
    * @access public 
    * @param varchar (name) 
    * @param int (id)  
    * @return  TRUE or FALSE
    */
	public function checkSettingExists($name, $id = -1) {
		
		$xname = $this->security->xss_clean($name);
		
		$this->db->select('name');
		$this->db->where('name', $xname);
		if ($id != -1) {
			// ignore a particular setting id
			$this->db->where('id !=', $id);
		}
		$query = $this->db->get($this->table_settings);
		if ($query->num_rows() > 0) {
			return TRUE;
		}
		return FALSE;
    }

    /**
    * Update the setting or add it if it does not already exist
    * updateSetting
    ****
    * @access public 
    * @param varchar (name) 
    * @param varchar (value)  
    * @return none
    */
    public function updateSetting($name, $value) {
		
		$xname = $this->security->xss_clean($name);
		$xvalue = $this->security->xss_clean($value);
	
		// update the setting or add it if it does not already exist
		if ($this->checkSettingExists($xname)) {
			$data = array(
			'value' => $xvalue
			);
			$this->db->where('name', $xname);
			$this->db->update($this->table_settings, $data);
		} else {
			// setting does not exist so add it
			$this->addSetting($xname, $xvalue);
		}
    } 

    /**
    * Read the settings table by name and return the setting
    * getSettingByName
    ****
    * @access public 
    * @param varchar (name)  
    * @return string
    */
    public function getSettingByName($name) {
		// return the setting
		$this->db->where('name', $name);
		$this->db->limit(1);
		$query = $this->db->get($this->table_settings);
		if ($query->num_rows() > 0) {
			return $query->row()->value;
		}
		// no result
		return FALSE;
    }

    /**
    * Read the settings table by id and return the setting
    * getSettingByName
    ****
    * @access public 
    * @param ind (id)  
    * @return string
    */
    public function getSettingById($id) {
		// return the setting
		$this->db - where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_settings);
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		// no result
		return FALSE;
    }

    /**
    * Read the settings table and return all settings as an array
    * getEverySetting
    ****
    * @access public 
    * @param none 
    * @return array or false
    */
    public function getEverySetting() {
		// return all settings as an array
		$this->db->select('name,value');
		$query = $this->db->get($this->table_settings);
		if ($query->num_rows() > 0) {
			$settings_array = array();
			foreach ($query->result() as $row) {
			$settings_array[$row->name] = $row->value;
			}
			// return the settings
			return $settings_array;
		}
		// no results
		return FALSE;
    }
	


}

/* End of file setting_model.php */
/* Location: ./application/models/setting_model.php */