<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
$config['useragent']        = 'CodeIgniter';            // Mail engine switcher: 'CodeIgniter' or any mailer like PHPMailer
$config['protocol']         = '%PROTOCOL%';             // 'mail', 'sendmail', or 'smtp'
$config['mailpath']         = '/usr/sbin/sendmail';		// PHP mail path
$config['smtp_host']        = '%HOST%';					// outbound smtp host
$config['smtp_user']        = '%USER%';					// outbound smtp user email
$config['smtp_pass']        = '%PASS%';					// outbound smtp user password
$config['smtp_port']        = %PORT%;
$config['smtp_timeout']     = 5;                        // (in seconds)
$config['smtp_crypto']      = '%ENCRYPT%';              // '' or 'tls' or 'ssl'
$config['smtp_debug']       = 3;                        // SMTP debug level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
$config['wordwrap']         = TRUE;
$config['wrapchars']        = 76;
$config['mailtype']         = 'html';                   // 'text' or 'html'
$config['charset']          = 'UTF-8';                  // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
$config['validate']         = TRUE;
$config['priority']         = 3;                        // 1, 2, 3, 4, 5; on useragent NULL is a possible option, it means that X-priority header is not set at all
$config['crlf']             = "\r\n";                     // "\r\n" or "\n" or "\r"
$config['newline']          = "\r\n";                     // "\r\n" or "\n" or "\r"
$config['bcc_batch_mode']   = false;
$config['bcc_batch_size']   = 200;
$config['encoding']         = 'base64';                 // The body encoding. For CodeIgniter: '8bit', '7bit' or 'base64'.


/* End of file email.php */
/* Location: ./application/config/email.php */