<?php

error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files. 

$config_writable = is_writable('../application/config/'); 
$uploads_writable = is_writable('../assets/');
$uploads_attachments_writable = is_writable('../assets/attachments/');
$uploads_ics_writable = is_writable('../assets/ics/');
$uploads_captcha_writable = is_writable('../assets/captcha/');
$sitemap_writable = is_writable('../sitemap.xml');

$permissions_fail = $config_writable !== TRUE || $sitemap_writable !== TRUE || $uploads_writable !== TRUE || $uploads_attachments_writable !== TRUE || $uploads_ics_writable !== TRUE || $uploads_captcha_writable !== TRUE;
	
// Only load the classes in case the user submitted the form
if($_POST) { 
	$protocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? 'https://' : 'http://';
	$redir = $protocol . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
	header( 'Location: ' . $redir . 'email.php' ); 
}

?> 
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Getting started</title>
	<meta name="description" content="A server-side dynamic web application that is responsive to any layout of a viewing screen">
	<meta name="author" content="sirdre">
	
	<meta property="og:site_name" content="CIFullCalendar - a calendar web application">
	<meta property="og:type" content="website">
	<meta property="og:title" content="CIFullCalendar - a calendar web application">
	<meta property="og:url" content="https://cifullcalendar.com/docs">
	<meta property="og:image" content="/img/icons/icon_192x192.png">
	<meta property="og:description" content="A server-side dynamic web application that is responsive to any layout of a viewing screen">
	
	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="https://cifullcalendar.com/docs">
	<meta name="twitter:title" content="CIFullCalendar - a calendar web application">
	<meta name="twitter:description" content="A server-side dynamic web application that is responsive to any layout of a viewing screen">
	<meta name="twitter:image" content="/img/icons/icon_180x180.png">
	<meta name="twitter:site" content="@SenorDre">
	<meta name="twitter:domain" content="https://cifullcalendar.com">	
	
	<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="./assets/img/icons/icon_ios_57x57.png">
	<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/icons/icon_ios_76x76.png">
	<link rel="apple-touch-icon" sizes="120x120" href="./assets/img/icons/icon_ios_120x120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="./assets/img/icons/icon_ios_152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="./assets/img/icons/icon_ios_180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="./assets/img/icons/android_icon_192x192.png"> 

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="./assets/js/html5shiv.js"></script>
	<![endif]--> 
	<link href="./assets/css/bootstrap.css" rel="stylesheet">
	<link href="./assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
    <link href="./assets/main.css"  rel="stylesheet" > 

	<link href="./assets/css/codemirror.min.css" rel="stylesheet" type="text/css" >
	<link href="./assets/css/monokai.min.css" rel="stylesheet" type="text/css" >	
	 
  </head>
  
  <body class="doc">

  <header class="navbar navbar-default navbar-fixed-top fix-navbar" role="navigation">
  <div class="page-container header-page-container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle">
        <span class="sr-only">Toggle</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <a class="navbar-brand fix-header-brand header-bi" href="/"><span class="ir">CIFullCalendar v3</span></a>
      <a href="https://cifullcalendar.com/v3" id="demo">
        <span class="fa fa-calendar"></span>
      </a>	  	  
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav"> 
	  
		  <li class="active"><a class="header-page-link" href="#" >Verify</a></li> 
          
          <li><a class="header-page-link" href="#">Email</a></li>
		  
		  <li><a class="header-page-link" href="#">Config</a></li> 
		  
          <li><a class="header-page-link" href="#">Database</a></li> 
		  
		  <li><a class="header-page-link" href="#">Admin</a></li>
          
          <li><a class="header-page-link" href="//sirdre.com">Support</a></li> 
        
      </ul> 
    </div>
  </div>
</header>   

<div class="page-container">
  <div class="row">
    <div class="col-md-3 doc-nav">
      <h2>Installation</h2> 
      <div class="bs-page-sidebar" side-navbar role="complementary">
        <div id="toc"></div>
      </div>
    </div>
    <div class="col-md-9 doc-content-wrap">
      <div class="doc-content" role="main"> 
				
		<h2 id="server-config-checks">Server Config Checks</h2> 
		
		<h3 id="check-permissions">Checking file and directory permissions</h3>
		<figure class="highlight">	
			<p><b>"application/config"</b> directory is <?php echo $config_writable ? '<span class="cp">writeable <i class="fa fa-check"></i></span>' : '<span class="k">not writeable <i class="fa fa-times"></i></span>'; ?></p>
			<p><b>"assets"</b> directory is <?php echo $uploads_writable ? '<span class="cp">writeable <i class="fa fa-check"></i></span>' : '<span class="k">not writeable <i class="fa fa-times"></i></span>'; ?></p>
			<p><b>"assets/attachments"</b> directory is <?php echo $uploads_attachments_writable ? '<span class="cp">writeable <i class="fa fa-check"></i></span>' : '<span class="k">not writeable <i class="fa fa-times"></i></span>'; ?></p>
			<p><b>"assets/ics"</b> directory is <?php echo $uploads_ics_writable ? '<span class="cp">writeable <i class="fa fa-check"></i></span>' : '<span class="k">not writeable <i class="fa fa-times"></i></span>'; ?></p>
			<p><b>"assets/captcha"</b> directory is <?php echo $uploads_captcha_writable ? '<span class="cp">writeable <i class="fa fa-check"></i></span>' : '<span class="k">not writeable <i class="fa fa-times"></i></span>'; ?></p>
			<p><b>"sitemap.xml"</b> file is <?php echo $sitemap_writable ? '<span class="cp">writeable <i class="fa fa-check"></i></span>' : '<span class="k">not writeable <i class="fa fa-times"></i></span>'; ?></p>  
		</figure>
 
		<h3 id="check-server-settings">Checking <b>RECOMMENDED</b> PHP server settings</h3>
		
		<figure class="highlight">	
			<p><span>date.timezone</span>
			<?php 
			$date_timezone = ini_get('date.timezone');
			echo (empty($date_timezone)) ? '<span class="k">A default timezone is required <i class="fa fa-calendar-times-o"></i></span>  ' : '<span class="cp"> '.ini_get('date.timezone').' <i class="fa fa-check"></i></span>';
			?></p>
			
			<p><span>post_max_size</span>
			<?php 
			$post_max_size = ini_get('post_max_size') + 0;
			echo ($post_max_size < 8) ? '<span class="k">Require at least 8M</span>  ' : '<span class="cp">' . ini_get('post_max_size') . ' <i class="fa fa-check"></i></span>';
			?></p>
			
			<p><span>upload_max_filesize</span>
			<?php
			$upload_max_filesize = ini_get('upload_max_filesize') + 0;
			echo ($upload_max_filesize < 8) ? '<span class="k">Require at least 8M</span>  ' : '<span class="cp">' . ini_get('upload_max_filesize') . ' <i class="fa fa-check"></i></span>';
			?></p>
			
			<p><span>upload_max_filesize</span>
			<?php 
			$upload_max_filesize = ini_get('upload_max_filesize') + 0;
			echo ($upload_max_filesize < 8) ? '<span class="k">Require at least 8M</span>  ' : '<span class="cp">' . ini_get('upload_max_filesize') . ' <i class="fa fa-check"></i></span>';
			?></p>
			
			<p><span>safe_mode</span>
			<?php $safe_mode = ini_get('safe_mode');
			echo ($safe_mode == 1) ? '<span class="k">On <i class="fa fa-times"></i></span>' : '<span class="cp">Off <i class="fa fa-check"></i></span>';
			?></p>		
		
			<p><span>default_charset</span>
			<?php 
			$default_charset = ini_get('default_charset');
			echo ($default_charset == 1) ? '<span class="k"><i class="fa fa-times"></i></span>' : '<span class="cp">' . ini_get('default_charset') . ' <i class="fa fa-check"></i></span>';
			?></p>
			
			<p><span>magic_quotes_gpc</span>
			<?php 
			$magic_quotes_gpc = ini_get('magic_quotes_gpc');
			echo ($magic_quotes_gpc == 1) ? '<span class="k"><i class="fa fa-times"></i></span>' : '<span class="cp">' . ini_get('magic_quotes_gpc') . ' <i class="fa fa-check"></i></span>';
			?></p>
			
			<p><span>register_globals</span>
			<?php 
			$register_globals = ini_get('register_globals');
			echo ($register_globals == 1) ? '<span class="k"><i class="fa fa-times"></i></span>' : '<span class="cp">' . ini_get('register_globals') . ' <i class="fa fa-check"></i></span>';
			?></p>
			
		</figure> 
 
		<h3 id="check-php-configuration">Checking <b>RECOMMENDED</b> PHP server functions</h3> 
		<figure class="highlight">	 
		
			<p><span>OPENSSL Support:</span> 
			<?php $openssl = extension_loaded('openssl'); 
			echo ($openssl == TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>

			<p><span>MySQLi Support:</span>
			<?php $mysqli_connect = function_exists('mysqli_connect');
			echo ($mysqli_connect == TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>			
			
			<p><span>MCrypt Support:</span>
			<?php $mcrypt_encrypt = function_exists('mcrypt_encrypt');
			echo ($mcrypt_encrypt == TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>
			
			<p><span>FInfo Support:</span>
			<?php $finfo_file = function_exists('finfo_file');
			echo ($finfo_file == TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>
			
			<p><span>cURL Support:</span>
			<?php  
			$cURL = function_exists('curl_init');
			echo ($cURL) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k">php cURL extension is required<i class="fa fa-times"></i></span>';
			?></p>  
			
			<p><span>URL Rewriting (mod_rewrite):</span>
			<?php  
			$filename = $redir . 'url_rewrite.php';
			$handle = @fopen($filename, "r");
			if ($handle !== FALSE) { 
				$contents = @fread($handle, 100);
				@fclose($handle);
				$rewrite_fail = trim($contents) !== 'yes';
			} else {
				$rewrite_unknown = TRUE;
			} 
			echo (trim($contents) == 'yes') ? '<span class="cp">URL Rewriting Supported <i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; 
			?></p> 
			
			<?php if (function_exists('gd_info')) { 
			$gd_array = gd_info();
			?>
			<p><span>GD Version:</span>
			<?php echo '<span class="cp">' . $gd_array['GD Version'] . ' <i class="fa fa-check"></i></span>';?></p>
			<p><span>FreeType Support:</span>
			<?php echo ($gd_array['FreeType Support'] === TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>
			<p><span>FreeType Linkage:</span>
			<?php echo ($gd_array['FreeType Linkage']) ? '<span class="cp">'.$gd_array['FreeType Linkage'].'<i class="fa fa-check"></i></span>' : '<span class="k">'.$gd_array['FreeType Linkage'].'<i class="fa fa-times"></i></span>'; ?></p>
			<p><span>GIF Read Support:</span>
			<?php echo ($gd_array['GIF Read Support'] === TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>	<p><span>GIF Create Support:</span>
			<?php echo ($gd_array['GIF Create Support'] === TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>
			<p><span>JPEG Support:</span>
			<?php echo (($gd_array['JPEG Support'] === TRUE) OR ($gd_array['JPG Support'] === TRUE)) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>
			<p><span>PNG Support:</span>
			<?php echo ($gd_array['PNG Support'] === TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>
			<p><span>WBMP Support:</span>
			<?php echo ($gd_array['WBMP Support'] === TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>
			<p><span>XBM Support:</span>
			<?php echo ($gd_array['XBM Support'] === TRUE) ? '<span class="cp"><i class="fa fa-check"></i></span>' : '<span class="k"><i class="fa fa-times"></i></span>'; ?></p>
			
			<?php } else { ?>
			<p><span>No GD Support:</span>
			<?php echo '<span class="k">php GD extension is required <i class="fa fa-times"></i></span>'; $gd_fail = TRUE; 	} ?></p> 
			
			
		</figure>
		
		
	<h2 id="test-mail-function">Test Mail Function</h2> 
		
		<?php  
		$headers = 'From: install@cifullcalendar.com' . "\r\n" .
			'Reply-To: do_not_reply@cifullcalendar.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		if (mail('andre@sirdre.com', 'Installation Test', 'CIFullCalendar Installation Test', $headers)) {
		?>
		<h3><b>The mail server seems to be responding correctly <span class="cp"><i class="fa fa-check"></i></span></b></h3>
		<blockquote>This is just a simple email function test - you might need to check your mail settings if you have any problems with your site sending emails.</blockquote>
		<?php } else { ?>
		<h3><b>Email Test failed <span class="k"><i class="fa fa-times"></i></span></b></h3>
		<blockquote>Please check your mail server and settings.</blockquote> 
		<?php $mail_fail = TRUE; } ?>
		
	
	<h2 id="test-results">Test Results</h2>  
	
	
	<?php if (($gd_fail === FALSE) && ($cURL === FALSE) && ($openssl === FALSE) && ($mcrypt_encrypt === FALSE) && ($finfo_file === FALSE) && ($rewrite_fail === FALSE) && ($rewrite_unknown === FALSE) && ($mail_fail === FALSE) && ($permissions_fail === FALSE)) {
	?>
	<h2><b>Your server meets all the requirements for running CIFullCalendar! <span class="cp"><i class="fa fa-check"></i></span></b></h2>
	<?php
	} else {
	if ($openssl === FALSE) {
		echo '<p><b>Your server does not have the OpenSSL extension installed - you can still run the script but you will not be able to grab images from remote sites when you create reviews</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
	if ($mysqli_connect === FALSE) {
		echo '<p><b>Your server does not have the MySQLi Connect extension installed - you can still run the script but you will not be able to grab images from remote sites when you create reviews</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
	if ($mcrypt_encrypt === FALSE) {
		echo '<p><b>Your server does not have the Mcrypt encrypt extension installed - you can still run the script but you will not be able to grab images from remote sites when you create reviews</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
	if ($finfo_file === FALSE) {
		echo '<p><b>Your server does not have the Finfo file extension installed - you can still run the script but you will not be able to grab images from remote sites when you create reviews</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
	if ($cURL === FALSE) {
		echo '<p><b>Your server does not have the cURL extension installed - you can still run the script but you will not be able to grab images from remote sites when you create reviews</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
	if ($rewrite_fail === TRUE) {
		echo '<p><b>URL rewriting is not working correctly or is not enabled. You can continue to install the script but URLs will not work until you have fixed this</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
	if ($rewrite_unknown === TRUE) {
		echo '<p><b>Could not confirm that URL rewriting is enabled or working correctly. You can continue to install the script but if some URLs give you "not found" errors, you should check URL rewriting is enabled</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
	if ($gd_fail === TRUE) {
		echo '<p><b>You do not have GD enabled - this is used to resize images and for security features when visitors post comments on your site (CAPTCHA). If you run the script without it, these functions will not work correctly and you might see error messages</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
	if ($mail_fail === TRUE) {
		echo '<p><b>The mail server did not respond to a simple email test. This means your site will not be able to send out emails</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
	if ($permissions_fail === TRUE) {
		echo '<p><b>Not all the required files and directories are writeable. You will not be able to install and run the script until you have made them writeable</b> <span class="k"><i class="fa fa-times"></i></span></p>';
	}
		echo '<blockquote>If you need help with the requirements above, you should contact your hosting provider.</blockquote>';
	} 
	?>
	<form class="form-horizontal" name="install_form" id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
		<input type="submit" name="settings_submit" id="button" class="btn btn-next " value="Next Step" />
	</form>			 
	  
	<!-- jQuery & JavaScript -->  
	<script src="./assets/lib/js/jquery-1.11.1.min.js"></script>
	<script src="./assets/js/jquery.validate.min.js"></script>
	<script src="./assets/js/form-validation.js"></script> 

	<script src="./assets/js/bootstrap.js"></script> 

	<script type="text/javascript" src="./assets/js/codemirror.min.js"></script>
	<script type="text/javascript" src="./assets/js/xml.min.js"></script>
	<script type="text/javascript" src="./assets/js/formatting.min.js"></script>
	  
	<!-- for website --> 
	<script src="./assets/js/toc.js"></script>
	<script src="./assets/js/sidebar.js"></script> 		
     </div>
      <footer class="doc-footer"> 
		<p>CIFullcalendar v3 - created and maintained by <a href="https://www.sirdre.com">Sir.Dre</a></p> 
      </footer>
    </div>
  </div>
</div>
 
  </body>
</html>