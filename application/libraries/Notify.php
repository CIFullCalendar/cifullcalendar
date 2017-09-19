<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
 * Notifications Library class
 *
 * Extension of the CI core classes and communicate with the controller (The side man)
 *
 * @package		ci_fullcalendar
 * @category    Library
 * @author		sirdre
 * @link		Application/libraries/Notify
 */ 
  

class Notify {
	
	 
	private $CI; 
	
	/**
	 * Constructor. Get the notifications config files
	 */
	public function __construct()	{
		$this->CI =& get_instance(); 
		$this->CI->load->model('Setting_model');
		$this->CI->load->model('Member_model');
		$this->CI->load->model('Notification_model'); 
		
		$this->CI->load->library('email'); 	
		$this->CI->load->library('Languages'); 		
		$this->CI->load->library('ion_auth'); 
		
		$this->setting = $this->CI->Setting_model->getEverySetting();
		log_message('debug', "Notify library successfully initialized.");
	}
	
	/**
	 * template set for html email notification
	 * @access public
	 * @param $notify_type, $notify_message
	 * @return none / send email function
	 */
	public function notify_all($notify_type, $notify_message ){  
	
		$lang = $this->setting['site_language'];
		$this->CI->languages->get_lang($lang);
	 
		$email_message = $this->CI->Notification_model->getTableField(array('types' => $notify_type), 'body');
		$subject = $this->CI->Notification_model->getTableField(array('types' => $notify_type),'subject'); 
		$to = $this->CI->Notification_model->getAllEmails();
		$recipient = $this->CI->lang->line('members');
		
		$all_users = str_replace("{RECIPIENT}",$recipient,$email_message);
		$sender = str_replace("{SENDER}",$this->setting['site_email'],$all_users);
		$site_url = str_replace("{SITE_URL}",site_url(),$sender);
		$new_message = str_replace("{MESSAGE}",$notify_message,$site_url);
		$message = str_replace("{SITE_NAME}",$this->setting['site_name'],$new_message); 
 	 
		$this->_email($to, $subject, $message); 
	}	
	
	/**
	 * template set for html email notification
	 * @access public
	 * @param $notify_type, $by, $notify_message
	 * @return none / send email function
	 */
	public function notify_admins($notify_type, $by, $notify_message ){
		
		$lang = $this->setting['site_language'];
		$this->CI->languages->get_lang($lang);
	 
		$email_message = $this->CI->Notification_model->getTableField(array('types' => $notify_type), 'body');
		$subject = $this->CI->Notification_model->getTableField(array('types' => $notify_type),'subject'); 
		$to = $this->CI->Notification_model->getAllEmails(1);
		$recipient = $this->CI->lang->line('admin');
		
		$all_admins = str_replace("{RECIPIENT}",$recipient,$email_message);
		$sender = str_replace("{SENDER}",$by,$all_admins);
		$site_url = str_replace("{SITE_URL}",site_url(),$sender);
		$new_message = str_replace("{MESSAGE}",$notify_message,$site_url);
		$message = str_replace("{SITE_NAME}",$this->setting['site_name'],$new_message); 
 	 
		$this->_email($to, $subject, $message); 
	}
	
	/**
	 * template set for html email notification
	 * @access public
	 * @param $notify_type, $notify_message 
	 * @return none / send email function
	 */
	public function notify_users($notify_type, $notify_message ){  
	
		$lang = $this->setting['site_language'];
		$this->CI->languages->get_lang($lang);
		
		$email_message = $this->CI->Notification_model->getTableField(array('types' => $notify_type), 'body');
		$subject = $this->CI->Notification_model->getTableField(array('types' => $notify_type),'subject'); 
		$to = $this->CI->Notification_model->getAllEmails(2);
		$recipient = $this->CI->lang->line('user');
		$by = $this->CI->lang->line('admin');
		
		$all_users = str_replace("{RECIPIENT}",$recipient,$email_message);
		$sender = str_replace("{SENDER}",$by,$all_users);
		$site_url = str_replace("{SITE_URL}",base_url(),$sender);
		$new_message = str_replace("{MESSAGE}",$notify_message,$site_url);
		$message = str_replace("{SITE_NAME}",$this->setting['site_name'],$new_message); 
 	 
		$this->_email($to, $subject, $message); 
	}

	/**
	 * template set for notify_user_deleted email notification
	 * @access public
	 * @param $notify_type, $to, $recipient, $notify_message 
	 * @return none / send email function
	 */
	public function notify_user_deleted($notify_type, $to, $recipient, $notify_message ){  
	 
		$email_message = $this->CI->Notification_model->getTableField(array('types' => $notify_type), 'body');
		$subject = $this->CI->Notification_model->getTableField(array('types' => $notify_type),'subject'); 
		 
		$member = str_replace("{RECIPIENT}",$recipient,$email_message);
		$sender = str_replace("{SENDER}",$this->setting['site_email'],$member);
		$site_url = str_replace("{SITE_URL}",base_url(),$sender);
		$new_message = str_replace("{MESSAGE}",$notify_message,$site_url);
		$message = str_replace("{SITE_NAME}",$this->setting['site_name'],$new_message); 
 	 
		$this->_email($to, $subject, $message); 
	}
	
	
	/**
	 * template set for html email notification
	 * @access public
	 * @param $notify_type, $old_email, $new_email, $keycode
	 * @return none / send email function
	 */
	public function notify_change_email_confirm($notify_type, $old_email, $new_email, $keycode){  
	 
		$email_message = $this->CI->Notification_model->getTableField(array('types' => $notify_type), 'body');
		$subject = $this->CI->Notification_model->getTableField(array('types' => $notify_type),'subject');  		
		$to = $this->CI->Notification_model->checkEmail($old_email);
		 
		$keypass = str_replace("{KEY_URL}",$keycode,$email_message);
		$sender = str_replace("{SENDER}",$this->setting['site_email'],$keypass);
		$new_mail = str_replace("{NEW_EMAIL}",$new_email,$sender); 
		$site_url = str_replace("{SITE_URL}",base_url(),$new_mail); 
		$message = str_replace("{SITE_NAME}",$this->setting['site_name'],$site_url); 
  
		$this->_email($to, $subject, $message); 
	} 	

	/**
	 * template set for html email notification
	 * @access public
	 * @param $notify_type, $email, $username, $newEmail
	 * @return none / send email function
	 */
	public function notify_change_email($notify_type, $email, $username, $newEmail){  
	 
		$email_message = $this->CI->Notification_model->getTableField(array('types' => $notify_type), 'body');
		$subject = $this->CI->Notification_model->getTableField(array('types' => $notify_type),'subject');  		
		$to = $this->CI->Notification_model->checkEmail($newEmail);
		 
		$new_email = str_replace("{NEW_EMAIL}",$newEmail,$email_message);
		$old_email = str_replace("{EMAIL}",$email,$new_email);
		$user = str_replace("{USERNAME}",$username,$old_email);
		$site_url = str_replace("{SITE_URL}",base_url(),$user); 
		$message = str_replace("{SITE_NAME}",$this->setting['site_name'],$site_url); 
 	  
		$this->_email($to, $subject, $message); 
	} 
 	

	/**
	 * template set for notify_register email notification
	 * @access public
	 * @param $notify_type, $by, $email, $password
	 * @return none / send email function
	 */
	public function notify_register($notify_type, $by, $userid, $email, $activation){  
	 
		$email_message = $this->CI->Notification_model->getTableField(array('types' => $notify_type), 'body');
		$subject = $this->CI->Notification_model->getTableField(array('types' => $notify_type),'subject');   
		$to = $this->CI->Notification_model->checkEmail($email);
		$activate_url = base_url('register/activate/'.$userid.'/'.$activation);
		 
		$username = str_replace("{USERNAME}",$by,$email_message); 
		$usermail = str_replace("{EMAIL}",$email,$username);
		$activate = str_replace("{ACTIVATION_CODE}",$activation,$usermail);
		$sender = str_replace("{SENDER}",$this->setting['site_email'],$activate);
		$site_url = str_replace("{SITE_URL}",$activate_url,$sender); 
		$message = str_replace("{SITE_NAME}",$this->setting['site_name'],$site_url); 
 	 
		$this->_email($to, $subject, $message); 
	} 	
	
	/**
	 * template set for forgotten_password email notification
	 * @access public
	 * @param $notify_type, $email, $keycode
	 * @return none / send email function
	 */
	public function notify_forgotten_password($notify_type, $email, $keycode){  
	 
		$email_message = $this->CI->Notification_model->getTableField(array('types' => $notify_type), 'body');
		$subject = $this->CI->Notification_model->getTableField(array('types' => $notify_type),'subject');  		
		$to = $this->CI->Notification_model->checkEmail($email);
		 
		$keypass = str_replace("{KEY_URL}", site_url("profile/user/reset_password")."/".$keycode,$email_message);
		$sender = str_replace("{SENDER}",$this->setting['site_email'],$keypass);
		$site_url = str_replace("{SITE_URL}",base_url(),$sender); 
		$message = str_replace("{SITE_NAME}",$this->setting['site_name'],$site_url); 
  
		$this->_email($to, $subject, $message); 
	} 
	
	/**
	 * template set for html forgotten_password_complete notification
	 * @access public
	 * @param $notify_type, $email, $username, $newPassword
	 * @return none / send email function
	 */
	public function notify_forgotten_password_complete($notify_type, $email, $username, $newPassword){  
	 
		$email_message = $this->CI->Notification_model->getTableField(array('types' => $notify_type), 'body');
		$subject = $this->CI->Notification_model->getTableField(array('types' => $notify_type),'subject');  		
		$to = $this->CI->Notification_model->checkEmail($email);
		 
		$newpass = str_replace("{NEW_PASSWORD}",$newPassword,$email_message);
		$user = str_replace("{EMAIL}",$email,$newpass);
		$mail = str_replace("{USERNAME}",$username,$user);
		$site_url = str_replace("{SITE_URL}",base_url(),$mail); 
		$message = str_replace("{SITE_NAME}",$this->setting['site_name'],$site_url); 
 	  
		$this->_email($to, $subject, $message); 
	} 	
	
	/**
    * email users of new message
    * This function is called to mail users
    ****
    * @access public
    * @ Param $recipient, $subject, $message
    * @return none
    */	
	private function _email($recipient, $subject, $message) {  
		//switch control
		$next = true; 
		
		//get email queue data
		$to = $recipient;
	 
		//loop through and send emails 
		$found = false; //reset
		if ($next && is_array($to)) {
			for ($i = 0; $i < count($to); $i++) { 			
				//reset email settings
				//$this->CI->email->clear(); 
				//send
				$this->CI->email->from($this->setting['site_email']);
				$this->CI->email->to($to[$i]['email'].",");
				$this->CI->email->subject($this->setting['site_name'] . ': '. $subject);
				$this->CI->email->message($message);				 			
				
				$this->CI->email->send();  
				
				$found = true;
			}
		}  
	 
    } 
		
} 
	  
/* End of file Notify.php */
/* Location: ./application/libraries/Notify.php */