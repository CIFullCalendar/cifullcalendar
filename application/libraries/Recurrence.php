<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * Recurrence Library class
 *
 * Extension of the CI core classes and communicate with the controller (The side man)
 *
 * @package		ci_fullcalendar
 * @category    Library 
 * @author		sirdre & others 
 * @link		Application/libraries/recurrence
 */ 
  
class Recurrence {

	//global variable
	protected $CI;
	
	/**
	* Constructor
	*
	* @access    public
	*/
	function __construct() {
		$this->CI = &get_instance();
		
		$this->CI->load->helper('date');  
		$this->CI->load->helper('string'); 
		 
		log_message('debug', "Recurrence Class Initialized");
	}

	/**
	 * periods - Get dates between start and end date
	 * @param $start, $end, $interval, $length
	 * @return array
	 */
	public function periods($start, $end, $interval = 1, $length = 0) {
		
		if(!in_array($interval, [1, 7, 14, 30, 365]) || empty($start) || empty($end)){
			return [];
		}		
		
		try {  
 
			$endDateTime = strtotime(date('Y-m-d', $end) . ' 23:59:59'); 
			$datetimeArrays = $this->intervals($start, $endDateTime, $interval, $length);
			 
		} catch (Exception $e) {
			throw new Exception('Error: ' . $e );
		}
		
		return $datetimeArrays;
	}

	/**
	 * intervals - Get date array between given intervals
	 * @param $start, $end, $interval, $length
	 * @return array
	 */
	private function intervals($start, $end, $interval, $length) {
		
		if(!in_array($interval, [1, 7, 14, 30, 365]) || empty($start) || empty($end)){
			return [];
		}
		
		if($interval == 30){
			
			$next = $dates = new DateTime(date('Y-m-d', $start));
			$startTime = date(' H:i:s', $start);

			do {
				$st = $next->format("Y-m-d") . $startTime;
				$et = date('Y-m-d H:i:s', strtotime($st) + $eventLength);

				if (strtotime($et) <= $end)
					$return[] = ['start' => $st, 'end' => $et];

				$next = $this->monthly($dates, $next);
			} while ($end >= strtotime($next->format("Y-m-d")));
			
			return $return;			
			
		}else{
			
			$startDateTime = new DateTime(date('Y-m-d H:i:s', $start));
			$endDateTime = new DateTime(date('Y-m-d H:i:s', $end));

			$intervals = DateInterval::createFromDateString($interval . ' DAY');
			$periods = new DatePeriod($startDateTime, $intervals, $endDateTime);

			$startTime = date(' H:i:s', $start);
			
			foreach ($periods as $key => $dt) {
				$st = $dt->format('Y-m-d') . $startTime;
				$et = date('Y-m-d H:i:s', strtotime($st) + $length); 
				$return[] = ['start' => $st, 'end' => $et];
			}
			return $return;			
			
		}
		

	} 
	
 	/**
	 * monthly - Check and splits dates
	 * @param $start, $end, $interval, $length
	 * @return array
	 */
    private function monthly(DateTime $dates, DateTime $currentDate) {
        $month = clone $currentDate;
        $month->add(new DateInterval("P1M"));

        $next = clone $currentDate;
        $next->modify("last day of next month");

        if ($month->format("n") == $next->format("n")) {
            $recurDay = $dates->format("j");
            $daysInMon = $month->format("t");
            $currentDay = $currentDate->format("j");
            if ($recurDay > $currentDay && $recurDay <= $daysInMon) {
                $month->setDate($month->format("Y"), $month->format("n"), $recurDay);
            }
            return $month;
        } else {
            return $next;
        }
    }
}

/* End of file Recurrence.php */
/* Location: ./application/libraries/Recurrence.php */ 