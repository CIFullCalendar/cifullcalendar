<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Icalendar Library class
 *
 * Extension of the CI core classes and communicate with the controller (The side man)
 *
 * @package		ci_fullcalendar
 * @category    Libraries
 * @author		sirdre
 * @link		Application/libraries/Icalendar
 */ 
 
 
class Icalendar { 

	//global variable
	protected $CI;
	
	/** @var \DateTimeZone */
	public $timezone;
	
	/** @var array */
	public $data;	
	
	/** @var array */
	public $properties;	
	
	/**
	* Constructor
	*
	* @access public
	*/	
	function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->helper('date');
		log_message('debug', "ICal Class Initialized");  
    } 
	
	/**
	 * @param $file
	 * @param null $callback
	 * @return array|null
	 * @throws \RuntimeException
	 * @throws \InvalidArgumentException
	 */
	public function parseFile($file, $callback = null) {
		if (!$handle = fopen($file, 'r')) {
			throw new \RuntimeException('Can\'t open file ' . $file . ' for reading');
			 log_message('debug', "ICal - Can\'t open file ' . $file . ' for reading");
		}
		fclose($handle);
		return $this->parseComponents(file_get_contents($file), $callback);
	}
	
	/**
	 * parseComponents - get Calendar Components string
	 * 
	 * @param $string, $callback
	 * @return array|null
	 * @throws \RuntimeException
	 * @throws \InvalidArgumentException
	 */
	public function parseComponents($string, $callback = null) {
		$this->data = array();
		if (!preg_match('/BEGIN:VCALENDAR/', $string)) {
			throw new \InvalidArgumentException('Invalid ICAL data format');
			 log_message('debug', "ICal - Invalid ICAL data format");
		}
		$counters = array();
		$section = 'VCALENDAR';
		// Replace \r\n with \n
		$string = str_replace("\r\n", "\n", $string);
		// Unfold multi-line strings
		$string = str_replace("\n ", "", $string);
		foreach (explode("\n", $string) as $row) {
			switch ($row) {
				case 'BEGIN:DAYLIGHT':
				case 'BEGIN:VALARM':
				case 'BEGIN:VTIMEZONE':
				case 'BEGIN:VFREEBUSY':
				case 'BEGIN:VJOURNAL':
				case 'BEGIN:STANDARD':
				case 'BEGIN:VTODO':
				case 'BEGIN:VEVENT':
					$section = substr($row, 6);
					$counters[$section] = isset($counters[$section]) ? $counters[$section] + 1 : 0;
					continue 2; // while
					break;
				case 'END:DAYLIGHT':
				case 'END:VALARM':
				case 'END:VTIMEZONE':
				case 'END:VFREEBUSY':
				case 'END:VJOURNAL':
				case 'END:STANDARD':
				case 'END:VEVENT':
				case 'END:VTODO':
				case 'END:VCALENDAR':
					continue 2; // while
					break;
			}
			list($key, $para, $value) = $this->parseValues($row);
			if ($callback) {
				// call user function for processing line
				call_user_func($callback, $row, $key, $para, $value, $section, $counters[$section]);
			} else {
				if ($section === 'VCALENDAR') {
					$this->data[$key] = $value;
				} else {
					$this->data[$section][$counters[$section]][$key] = $value;
				}
			}
		}
		return ($callback) ? null : $this->data;
	}
 	/**
	* parseValues - get VEVENT string
	*
	* @access	public
	* @param	none
	* @return	array
	*/ 	
	private function parseValues($row) {
		//implement iCalendar Specification http://www.kanzaki.com/docs/ical/
		$properties = array(
			  'CALSCALE', 'METHOD', 'PRODID', 'VERSION'
			, 'ATTACH', 'CATEGORIES', 'CLASS', 'COMMENT', 'DESCRIPTION', 'GEO', 'LOCATION', 'PRIORITY', 'RESOURCES', 'STATUS', 'SUMMARY' 
			, 'COMPLETED', 'DTEND', 'DUE', 'DTSTART', 'DURATION', 'FREEBUSY', 'TRANSP'
			, 'TZID', 'TZNAME', 'TZOFFSETFROM', 'TZOFFSETTO', 'TZURL'
			, 'ATTENDEE', 'CONTACT', 'ORGANIZER', 'RECURRENCE-ID', 'RELATED-TO', 'URL', 'UID'
			, 'EXDATE', 'EXRULE', 'RDATE', 'RRULE'
			, 'ACTION', 'REPEAT', 'TRIGGER'
			, 'CREATED', 'DTSTAMP', 'LAST-MODIFIED', 'SEQUENCE'
		);		
		preg_match('#^([\w-]+);?(.*?):(.*)$#i', $row, $matches);

		$key = false;
		$para = null;
		$value = null;
		
		if ($matches) {
			$key = $matches[1];
			$para = $matches[2];
			$value = $matches[3];
			$timezone = null;
			if ($key === 'X-WR-TIMEZONE' || $key === 'TZID') {
				if (preg_match('#(\w+/\w+)$#i', $value, $matches)) {
					$value = $matches[1];
					$this->timezone = new \DateTimeZone($value);
				}else{
					$this->timezone = $value;
				}			
			}
			// get property parameters 
			if ($para && preg_match_all('#(?<key>[^=;]+)=(?<value>[^;]+)#', $para, $matches, PREG_SET_ORDER)) {
				$para = array();
				foreach ($matches as $match) {
					if ($match['key'] === 'TZID') {
 
						try {
							if (preg_match('#(\w+/\w+)$#i', $match['value'], $matches)) {
								$para[$match['key']] = $timezone = new \DateTimeZone($match['value']);
							}else{
								$para[$match['key']] = $timezone = $match['value'];
							}
						} catch (\Exception $e) {
							$para[$match['key']] = $match['value'];
							 log_message('debug', "Olson TZ Exception: ". $para[$match['key']] ." tz format");
						}
					}
				}
			}
		
		}
		// process simple dates with timezone
		if ($key === 'DTSTAMP' || $key === 'LAST-MODIFIED' || $key === 'CREATED' ) {
			if (preg_match('#(\w+/\w+)$#i', $this->timezone, $matches)) {
				$value = new \DateTime($value, ($timezone ?: $this->timezone));
			}else{
				$value = new \DateTime($value);
			}			
			
		}
		
		//Get starting and ending day by values \,
        if (($key == "DTSTART") or ($key == "DTEND")){
			if($value){	
				$my_arr=explode("T",$value);
				$cdate=$my_arr[0]; 
				list($key, $cdate) = $this->ical_dt_date($key, $value);
		    }else {
				list($value) = $this->ical_dt_format($value);
		    }
        }       
		//match parameters by values
		if ($key === 'RRULE' && preg_match_all('#(?<key>[^=;]+)=(?<value>[^;]+)#', $value, $matches, PREG_SET_ORDER)) {
			$para = null;
			$value = array();
			foreach ($matches as $match) {
				$value[$match['key']] = $match['value'];
			}
		}
		
		//split by comma, escape \,
		if ($key === 'CATEGORIES') {
			$value = filter_var($value, FILTER_SANITIZE_STRING);
		}
 
		//get attachments filename match	
		if ($key === "ATTACH" && filter_var($value, FILTER_VALIDATE_URL)){
			$value = filter_var($matches[1], FILTER_SANITIZE_URL); 
		}			
		
		//get url match	
		if ($key === "URL" && filter_var($value, FILTER_VALIDATE_URL)){
			$value = filter_var($value, FILTER_SANITIZE_URL);
		}	
		
		//filter contents and replace for db purposes
		if (in_array($key, $properties) || strpos($key, 'X-') === 0) {
			
			$arr = array("\\\\" => "\\", "\\N" => "\n", "\\n" => "\n", "\\;" => ";", "'" => "\'", "\\," => ",");
			
			if (is_array($value)) {
				foreach ($value as &$var) {
					$var = strtr($var, $arr);
				}
			} else {
				$value = $value;
			}
		}
		return array($key, $para, $value);
	}
	
 	/**
	* getEvents - get VEVENT string
	*
	* @access	public
	* @param	none
	* @return	array
	*/ 
	public function getEvents() {
		return isset($this->data['VEVENT']) ? $this->data['VEVENT'] : array();
	}
	/**
	* getAlarms - get VTODO string
	*
	* @access	public
	* @param	none
	* @return	array
	*/ 	
	public function getTodo() {
		return isset($this->data['VTODO']) ? $this->data['VTODO'] : array();
	}
 	/**
	* getAlarms - get VALARM string
	*
	* @access	public
	* @param	none
	* @return	array
	*/ 	
	public function getAlarms() {
		return isset($this->data['VALARM']) ? $this->data['VALARM'] : array();
	}
 	/**
	* getTimezones - get VTIMEZONE string
	*
	* @access	public
	* @param	none
	* @return	array
	*/ 	
	public function getTimezones() {
		return isset($this->data['VTIMEZONE']) ? $this->data['VTIMEZONE'] : array();
	}
	
 	/**
	* ical_dt_date - recognise date data after semi-colon and equal
	*
	* @access	public
	* @param	$key, $value;
	* @return	array
	*/ 	
    public function ical_dt_date($key, $value) {
        $value = $this->ical_dt_format($value);

        $temp = explode(";", $key);

        if (empty($temp[1])) {  
            return array($key, $value);
        }

        $key = $temp[0];
        $temp = explode("=", $temp[1]);
        $return_value[$temp[0]] = $temp[1];
        $return_value['unixtime'] = $value;

        return array($key, $return_value);
    }	
	
 	/**
	* ical_dt_datetime - check for date-time format 
	*
	* @access	public
	* @param	$icalDate;
	* @return	function string
	*/ 
    public function ical_dt_datetime($icalDate) { 
	
        $icalDate = str_replace('T', '', $icalDate); 
        $icalDate = str_replace('Z', '', $icalDate); 

        $pattern  = '/([0-9]{4})';   // 1: YYYY
        $pattern .= '([0-9]{2})';    // 2: MM
        $pattern .= '([0-9]{2})';    // 3: DD
        $pattern .= '([0-9]{0,2})';  // 4: HH
        $pattern .= '([0-9]{0,2})';  // 5: MM
        $pattern .= '([0-9]{0,2})/'; // 6: SS
        preg_match($pattern, $icalDate, $date); 

        // Unix timestamp can't represent dates before 1970
        if ($date[1] <= 1970) {
            return false;
        } 
        // Unix timestamps after 03:14:07 UTC 2038-01-19 might cause an overflow
        // if 32 bit integers are used.
        $timestamp = mktime((int)$date[4], 
                            (int)$date[5], 
                            (int)$date[6], 
                            (int)$date[2],
                            (int)$date[3], 
                            (int)$date[1]);
        return  $timestamp;
    }
	
 	/**
	* ical_dt_format - check for date format
	*
	* @access	public
	* @param	$ical_date;
	* @return	function string
	*/ 	
    public function ical_dt_format($ical_date) { 	
		preg_match('/([0-9]{4})([0-9]{2})([0-9]{2})/', $ical_date, $data); 
		return mktime(0, 0, 0, $data[2], $data[3], $data[1]); 
    }	
	
	/**
	 * getSortedEvents - Return sorted eventlist as array or false if calendar is empty
	 *
	 * @access	public
	 * @param	none; 
	 * @return array|boolean
	 */
	public function getSortedEvents() {
		if ($events = $this->getEvents()) {
			usort(
				$events, function ($a, $b) {
					return $a['DTSTART'] > $b['DTSTART'];
				}
			);
			return $events;
		}
		return array();
	}
	
	/**
	 * getReverseSortedEvents - Return sorted eventlist as array or false if calendar is empty
	 *
	 * @access	public
	 * @param	none; 
	 * @return array|boolean
	 */	
	public function getReverseSortedEvents() {
		if ($events = $this->getEvents()) {
			usort(
				$events, function ($a, $b) {
					return $a['DTSTART'] < $b['DTSTART'];
				}
			);
			return $events;
		}
		return array();
	}
}

/* End of file ICalendar.php */
/* Location: ./application/libraries/ICalendar.php */