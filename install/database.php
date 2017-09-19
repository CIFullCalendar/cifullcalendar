<?php

error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.
  
$config_db_writable = is_file('config/database.php');
$config_writable = is_writable('../application/config'); 

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		// } else if ($database->update_tables($_POST) == false) {
			// $message = $core->show_message('error',"The profile tables could not be updated, please verify your settings.");
		}else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod 'application/config/database.php' file to 777");
		}

		// If no errors, redirect to registration page
		if(!isset($message)) {
			$protocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? 'https://' : 'http://';
			$redir = $protocol . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
			header( 'Location: ' . $redir . 'admin.php');	 
		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
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
	  
		  <li><a class="header-page-link" href="index.php">Verify</a></li> 
          
          <li><a class="header-page-link" href="email.php">Email</a></li>
		  
          <li><a class="header-page-link" href="config.php">Config</a></li> 
		  
          <li class="active"><a class="header-page-link" href="#">Database</a></li> 
		  
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
	 
	    <h2 id="database-settings">Database Settings</h2> 
		<h3>Please provide details for a successful installation!</h3>	
		
		<?php if($config_db_writable && $config_writable) { ?>    
			<?php if(isset($message)) {echo '<blockquote>' . $message . '</blockquote>';}?> 
		<?php } else { ?>
			<blockquote>
			<p>Please make the "application/config/database.php" file writable.</p> 
			<p><strong>Example</strong>: <code>chmod 777 "application/config/database.php"</code></p>
			</blockquote>
		<?php } ?>
	  
		<form class="form-horizontal" name="install_form" id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			
		  <div class="form-group">
		    <label for="" class="col-md-2 control-label">Hostname</label>
		    <div class="col-md-5">
		      <input type="text" class="form-control" id="hostname" name="hostname" placeholder="">
		      <span class="help-block pull-right" for="hostname"></span>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="" class="col-md-2 control-label">Username</label>
		    <div class="col-md-5">
		      <input type="text" class="form-control" id="username" name="username" placeholder="">
		      <span class="help-block pull-right" for="username"></span>
		    </div>
		  </div>
		    <div class="form-group">
		    <label for="password" class="col-md-2 control-label"> Password </label>
		    <div class="col-md-5">
		      <input type="password" class="form-control" id="password" name="password" placeholder="">
		      <span class="help-block pull-right" for="password"></span>
		    </div>
		  </div>
		    <div class="form-group">
		    <label for="" class="col-md-2 control-label">Database</label>
		    <div class="col-md-5">
		      <input type="text" class="form-control" id="database" name="database" placeholder="">
		      <span class="help-block pull-right" for="database"></span>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-md-5">
		      <input type="submit" name="settings_submit" id="button" class="btn btn-next " value="Next Step" />
		    </div>
		  </div>
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
