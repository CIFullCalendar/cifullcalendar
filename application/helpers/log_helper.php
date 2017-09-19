<?php
 
function debug($message) {

    $CI = & get_instance();
    $CI->load->model('Setting_model');
	
    if ($CI->Setting_model->getSettingByName('debug') == 1) {
		$visitor_ip_address = $_SERVER['REMOTE_ADDR'];
		log_message('debug', $visitor_ip_address . '- ' . $message);
    }
}

/* End of file log_helper.php */
/* Location: ./application/helpers/log_helper.php */