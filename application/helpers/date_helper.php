<?php
 
function relativeTime($dt=NULL, $precision=2) {

    $CI = & get_instance();
    $CI->lang->load('date');
 
	$years = $CI->lang->line(('date_year')); 
	$months = $CI->lang->line(('date_month'));
	$weeks = $CI->lang->line(('date_week'));
	$days = $CI->lang->line(('date_day'));
	$hours = $CI->lang->line(('date_hour'));
	$minutes = $CI->lang->line(('date_minute'));
	$seconds = $CI->lang->line(('date_second'));
 
    $output = "";
    $passed = "";
	
	$times=array(	365*24*60*60	=> $years,
					30*24*60*60		=> $months,
					7*24*60*60		=> $weeks,
					24*60*60		=> $days,
					60*60			=> $hours,
					60				=> $minutes,
					1				=> $seconds);
					
	if(empty($dt)|| $dt == 0){
		$output = '';
	}else{
		$passed=time()-$dt;	
	}
	
	
	if($passed == 0) {
		
		$output = 'Never';
	}
	else if($passed < 5) {
		
		$output='less than 5 '.$seconds.' ago';
	
	} else {
		
		$output=array();
		$exit=0;
		
		foreach($times as $period=>$name)
		{
			if($exit>=$precision || ($exit>0 && $period<60)) break;
			
			$result = floor($passed/$period);
			if($result>0)
			{
				$output[]=$result.' '.$name.($result==1?'':'s');
				$passed-=$result*$period;
				$exit++;
			}
			else if($exit>0) $exit++;
		}
				
		$output=implode(' and ',$output).' ago';
	}
	
	return $output;
} 

/* End of file date_helper.php */
/* Location: ./application/helpers/date_helper.php */

?>