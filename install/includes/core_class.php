<?php

class Core {

	// Function to validate the post data
	function validate_post($data) {
		return !empty($data['hostname']) && !empty($data['username']) && !empty($data['database']);
	}	
	
	// Function to validate the post data
	function validate_post_email($data)	{
		return !empty($data['protocol']) && !empty($data['smtp_host']) && !empty($data['smtp_user']) && !empty($data['smtp_pass']) && !empty($data['smtp_port']);
	}	
	
	// Function to validate the post data
	function validate_post_config($data) { 
		return !empty($data['uri_protocol']) && !empty($data['language']) && !empty($data['encryption_key']) && !empty($data['sess_cookie_name']) && !empty($data['sess_expiration']);
	}

	// Function to show an error
	function show_message($type,$message) {
		return $message;
	}

	// Function to write the config file
	function write_config($data) {

		// Config path
		$template_path 	= 'config/database.php';
		$output_path 	= '../application/config/database.php';

		// Open the file
		$database_file = file_get_contents($template_path);

		$new  = str_replace("%HOSTNAME%",$data['hostname'],$database_file);
		$new  = str_replace("%USERNAME%",$data['username'],$new);
		$new  = str_replace("%PASSWORD%",$data['password'],$new);
		$new  = str_replace("%DATABASE%",$data['database'],$new);

		// store database value in session
		session_start();
		$_SESSION['hostname'] = $data['hostname'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['password'] = $data['password'];
		$_SESSION['database'] = $data['database'];

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}	
	
	// Function to write the config file
	function write_config_email($data) {

		// Config path
		$template_path 	= 'config/email.php';
		$output_path 	= '../application/config/email.php';

		// Open the file
		$email_file = file_get_contents($template_path);

		$new  = str_replace("%PROTOCOL%",$data['protocol'],$email_file);
		$new  = str_replace("%HOST%",$data['smtp_host'],$new);
		$new  = str_replace("%USER%",$data['smtp_user'],$new);
		$new  = str_replace("%PASS%",$data['smtp_pass'],$new);
		$new  = str_replace("%PORT%",$data['smtp_port'],$new);
		$new  = str_replace("%ENCRYPT%",$data['smtp_crypto'],$new); 

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		} 
	}
	
	// Function to write the config file
	function write_config_config($data) {

		// Config path
		$template_path 	= 'config/config.php';
		$output_path 	= '../application/config/config.php';

		// Open the file
		$email_file = file_get_contents($template_path);

		$new  = str_replace("%INDEXPAGE%",$data['index_page'],$email_file);
		$new  = str_replace("%URIPROTOCOL%",$data['uri_protocol'],$new);
		$new  = str_replace("%LANGUAGE%",$data['language'],$new);
		$new  = str_replace("%ENCRYPTIONKEY%",$data['encryption_key'],$new);
		$new  = str_replace("%SESSCOOKIENAME%",$data['sess_cookie_name'],$new);
		$new  = str_replace("%SESSEXPIRATION%",$data['sess_expiration'],$new); 

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		} 
	}
}