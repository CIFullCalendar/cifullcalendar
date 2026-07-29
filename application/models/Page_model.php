<?php
/**
 * Page Model class
 *
 * Communicate with the settings table in the database and all controllers (The middle guy)
 *
 * @package		ci_fullcalendar
 * @category    Models
 * @author		sirdre
 * @link		/admin/page 
 */ 
class Page_model extends CI_Model 
{

	protected $table_pages = 'pages';
	
	protected $access_public_pages = 0; 
	
    function Page_model() {
	parent::__construct();
	$this->load->database();
	$this->load->helper('security');
	
	$this->load->library('ion_auth'); 
    }

    /**
    * Add new pages to the table of the database
    * addPage
    ****
    * @access public
    * @param $user, $title, $content, $meta_keywords, $meta_description, $access
    * @return none
    */
    function addPage($user, $title, $content, $meta_keywords, $meta_description, $access) {
		// check the page name is unique and append a number if it is not
		$name_add = 2;
		$title = trim($title);
		$seo_name = url_title($title, '-', TRUE);
		$safe_seo_name = convert_accented_characters($seo_name);
		
		while ($this->_checkSeoNameExists($safe_seo_name)) {
			// keep trying numbers until the title is unique
			$safe_seo_name = $seo_name . '-' . $name_add;
			$name_add++;
		}
		$data = array(
			'uname' => $user->username,
			'title' => $title,
			'seo' => $safe_seo_name,
			'content' => $content,
			'meta_keywords' => $meta_keywords,
			'meta_description' => $meta_description,
			'access' => $access
		);
		// add the page
		$this->db->insert($this->table_pages, $data);
    }

    /**
    * Update existing pages to the table of the database
    * updatePage
    ****
    * @access public
    * @param $id, $name, $content, $meta_keywords, $meta_description, $access
    * @return none
    */
    function updatePage($id, $name, $content, $meta_keywords, $meta_description, $access) {
	 
		$name_add = 2;
		$name = trim($name);
		$seo_name = url_title($name, '-', TRUE);
		$safe_seo_name = convert_accented_characters($seo_name);
		while ($this->_checkSeoNameExists($safe_seo_name, $id)) {
			// keep trying numbers until the title is unique
			$safe_seo_name = $seo_name . '-' . $name_add;
			$name_add++;
		}
		$data = array(
			'title' => $name,
			'seo' => $safe_seo_name,
			'content' => $content,
			'meta_keywords' => $meta_keywords,
			'meta_description' => $meta_description,
			'access' => $access,
		);
		// update the page
		$this->db->where('id', $id);
		$this->db->update($this->table_pages, $data);
    }

    /**
    * Delete existing pages to the table of the database
    * delPage
    ****
    * @access public
    * @param $id, $uname
    * @return none
    */
    function delPage($id, $uname) {
		// delete the page
		$this->db->where('id', $id);
		$this->db->where('uname', $uname);
		$this->db->delete($this->table_pages);
    }   
	
   /**
    * delete the user profile from the member table of the database
    * deleteUser
    ****
    * @access public
    * @param string (uname)  
    * @return none
    */
	function profile_del($uname) {  
		$xuname = $this->security->xss_clean($uname);
		$this->db->where('uname', $xuname);
		$this->db->delete($this->table_pages);
    }

    /**
    * Check existing pages to the table of the database
    * _checkSeoNameExists
    ****
    * @access public
    * @param $seo_name, $id = -1
    * @return TRUE/FALSE
    */
    function _checkSeoNameExists($seo_name, $id = -1) {
		// check the page name is not already being used
		$this->db->select('seo');
		$this->db->where('seo', $seo_name);
		// optionally ignore a particular page
		// this is used when editing so the current name of a page can be ignored
		if ($id != -1) {
			$this->db->where('id !=', $id);
		}
		// return TRUE if the title exists, FALSE if not
		$query = $this->db->get($this->table_pages);
		if ($query->num_rows() > 0) {
			return TRUE;
		}
		return FALSE;
    }

    /**
    * Get existing pages in url format from the database
    * getPageBySeoName
    ****
    * @access public
    * @param $param, $access
    * @return Query/FALSE
    */
    function getPageBySeoName($param, $user) {		
		 
		$uid = (!empty($user)) ? $user->id : FALSE; 
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($uid)->result();   
		
		$page = $this->_getPageBySEO($param); 
		if($page) { 
		
			foreach ($groups as $group){	
				foreach($currentGroups as $usergroup) {  
					if($usergroup->id == $page->access){
						$query = $this->db->select('*')->from($this->table_pages)->where('seo', $param)->where('access', $page->access)->get();  
						if ($query->num_rows() > 0) {
							return $query->row();
						}	 
					} 
				}   
			} 	 
			if($page->access == $this->access_public_pages){
				$query2 = $this->db->select('*')->where('access', $this->access_public_pages)->where('seo', $param)->limit(1)->get($this->table_pages);
				if ($query2->num_rows() > 0) {
					return $query2->row();
				}	
			}						
			 
		} 
			 
		// no result
		return FALSE;
    }

	
    /**
    * Get existing pages by seo from the database
    * _getPageBySEO
    ****
    * @access public
    * @param $id
    * @return Query/FALSE
    */
    private function _getPageBySEO($seo) {
		 
		// return the page
		$this->db->where('seo', $seo);
		$this->db->limit(1);
		$query = $this->db->get($this->table_pages);
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result[0];
		}
		
		// no result
		return FALSE;
    }    
	
	/**
    * Get existing pages by id from the database
    * getPageById
    ****
    * @access public
    * @param $id
    * @return Query/FALSE
    */
    function getPageById($id) {
		// return the page
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_pages);
		if ($query->num_rows() > 0) {
			$result = $query->result();
			return $result[0];
		}
		// no result
		return FALSE;
    }
	
	/**
    * Get all existing pages from the database
    * get_pages
    ****
    * @access public
    * @param $limit, $offset
    * @return none
    */
    function get_pages($limit, $offset = 0) {  
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->table_pages);
		$jsonpages = array();
		// return the pages
		if ($query->num_rows() > 0) { 
			foreach ($query->result() as $entry)
			{
				$jsonpages[] = array(
					'id'     			=> $entry->id,      
					'uname'     		=> $entry->uname,      
					'title'     		=> $entry->title,      
					'seo'     			=> $entry->seo,      
					'content'     		=> $entry->content,      
					'meta_keywords'     => $entry->meta_keywords,      
					'meta_description'  => $entry->meta_description,      
					'access'  			=> $entry->access,      
					'pubdates'  		=> $entry->pubdates,      
					'token'				=> $this->security->get_csrf_hash(),  
				);
			}
			return $jsonpages;
		}  
		// no results
		return FALSE;
    } 

    /**
    * Get all existing pages from the database
    * getAllPages
    ****
    * @access public
    * @param $limit, $offset
    * @return none
    */
    function getAllPages($limit, $offset = 0) { 
	
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->table_pages);
		// return the pages
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		// no results
		return FALSE;
    }       	
	
	/**
    * Get all public pages from the database
    * getAllPages
    ****
    * @access public
    * @param $limit, $offset
    * @return none
    */
    function getAllPublicPages($limit, $offset = 0) { 
	
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}
		
		$this->db->where('access', $this->access_public_pages);
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->table_pages);
		// return the pages
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		// no results
		return FALSE;
    }
	
	/**
    * Get all members pages from the database
    * getAllPages
    ****
    * @access public
    * @param $limit, $offset
    * @return none
    */
    function getAllMembersPages($limit, $offset = 0) {
			
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups()->result(); 
		$checked = 0;
		
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}		
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}

		foreach ($groups as $group){			
			foreach($currentGroups as $usergroup) { 
				  $checked = $usergroup->id;				 
			}
			$query = $this->db->select('*')->from($this->table_pages)->where('access', $checked)->order_by('id', 'DESC')->get();
		} 			
		// return the pages
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		// no results
		return FALSE;
    }	
	
	/**
    * Get all administrator pages from the database
    * getAllPages
    ****
    * @access public
    * @param $limit, $offset
    * @return none
    */
    function getAllAdminPages($limit, $offset = 0) {
		// return all pages
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups()->result(); 
		$checked = 0;
		
		// offset is used in pagination
		if (!$offset) {
			$offset = 0;
		}		
		// if a limit more than zero is provided, limit the results
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}

		foreach ($groups as $group){			
			foreach($currentGroups as $usergroup) { 
				  $checked = $usergroup->id;				 
			}
			$query = $this->db->select('*')->from($this->table_pages)->where('access', $checked)->order_by('id', 'DESC')->get();
		} 		
		// return the pages
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		// no results
		return FALSE;
    } 
	
    /**
    * Count existing pages to the table of the database
    * countPages
    ****
    * @access public
    * @param none
    * @return none
    */
    function countPages() {
		// return the total number of pages
		return $this->db->count_all_results($this->table_pages);
    }	
	
}

/* End of file page_model.php */
/* Location: ./application/models/page_model.php */