<?php 
	$protocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? 'https://' : 'http://';
	$redir = $protocol . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']); 
	$admindir = str_replace('install/','',$redir); 
	
	
?><!DOCTYPE html>
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
	  
		  <li><a class="header-page-link" href="index.php" >Verify</a></li> 
          
          <li><a class="header-page-link" href="email.php">Email</a></li>
		  
          <li><a class="header-page-link" href="config.php">Config</a></li> 
		  
          <li><a class="header-page-link" href="database.php">Database</a></li> 
		  
          <li class="active"><a class="header-page-link" href="#">Admin</a></li>
          
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

	    <h2 id="config-admin">Successful</h2> 
		<h3>Installation is Successful!</h3>	
		<figure class="highlight">	
			<blockquote> 
				<p><a href="<?php echo $admindir.'login' ?>"> Calendar Area </a></p>
				<p><a href="<?php echo $admindir.'admin' ?>"> Admin Panel </a></p>
			</blockquote>	 
		</figure>	
		
	<p>Thank you for your support and purchase of &ldquo;CIFullcalendar v3&rdquo;. If you have any questions that are beyond the scope of this help file, please feel free to email. Thanks so much! No guarantees, but I'll do my best to assist.</p> 

	<div id="sourcesandcredits">
	<h2 id="sources-and-credits" >Sources and Credits</h2>

	<p>I've used the following images, icons, js or other files as listed.

	<ul>
		<li>Codeigniter by EllisLab, Inc., British Columbia Institute of Technology and contributors</li>
		<li>FullCalendar by Adam Shaw and contributors</li> 
		<li>JQuery with JQuery UI by jQuery Foundation and other contributors Licensed MIT</li>  
		<li>Moment.js & moment-timezone.js by Tim Wood, Iskren Chernev, and contributors</li>					
		<li>IonAuth by Ben Edmunds and contributors</li> 
		<li>Bootstrap by Twitter, Inc. and contributors</li>
		<li>Bootstrap-datetimepicker by Eonasdan and contributors</li>
		<li>Bootstrap-select by Silvio Moreto and contributors</li>				
		<li>Bootstrap-table by Zhixin Wen and contributors</li>	 
		<li>Font Awesome by @davegandy and contributors</li>					
		<li>Google Maps API v3 by Google</li> 
		<li>Summernote by Alan Hong and other contributors</li>
		<li>MarkerClusterer by Luke Mahe and contributors</li>	
		<li>CodeMirror by Marijn Haverbekeand contributors</li>	
		<li>jekyll-table-of-contents by Alex Ghiculescu contributors</li>	
		<li>jQuery Validation Plugin by Jörn Zaefferer contributors</li>	
		<li>CI Installer by Mike Crittenden and contributors</li>	
	</ul>				
	</div><!-- /#sourcesandcredits -->	
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