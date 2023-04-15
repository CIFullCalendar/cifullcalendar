<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Database Error</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" /> 
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> 	
  
		 <style type="text/css">
		  
			a {
				color: #337ab7;
				text-decoration: none;
			}
			.btn {
				display: inline-block;
				margin-bottom: 0;
				font-weight: 400;
				text-align: center;
				text-transform: uppercase;
				vertical-align: middle;
				touch-action: manipulation;
				cursor: pointer;
				border: 1px solid transparent;
				white-space: nowrap;
				padding: 6px 12px;
				font-size: 14px;
				line-height: 1.42857;
				border-radius: 4px;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
			.btn.focus, .btn:focus, .btn:hover {
				color: #333;
				text-decoration: none;
			}
			.btn.btn-outline.red {
				border-color: #e7505a;
				color: #e7505a;
				background: 0 0;
			} 
			.btn.btn-outline.red:hover {
				border-color: #e7505a;
				color: #fff;
				background-color: #e7505a;
			}

			 
			code {
				font-family: Consolas, Monaco, Courier New, Courier, monospace;
				font-size: 12px;
				background-color: #f9f9f9;
				border: 1px solid #D0D0D0;
				color: #002166;
				display: block;
				margin: 14px 0 14px 0;
				padding: 12px 10px 12px 10px;
			}
					 
			.page-404 {
			  text-align: center; }

			.page-404 .number {
			  position: relative; 
			  display: inline-block;
			  letter-spacing: -10px;
			  margin-top: 0px;
			  margin-bottom: 10px;
			  line-height: 128px;
			  font-size: 128px;
			  font-weight: 300;
			  color: #e7505a;
			  text-align: right; }

			.page-404 .details {
			  margin-left: 40px;
			  display: inline-block;
			  padding-top: 0px;
			  text-align: left; }
 
			.page-500 {
			  text-align: center; }

			.page-500 .number {
			  display: inline-block;
			  letter-spacing: -10px;
			  line-height: 128px;
			  font-size: 128px;
			  font-weight: 300;
			  color: #ec8c8c;
			  text-align: right; }

			.page-500 .details {
			  margin-left: 40px;
			  display: inline-block;
			  text-align: left; }
 
			.page-404-full-page {
			  overflow-x: hidden;
			  padding: 20px;
			  margin-bottom: 20px;
			  background-color: #fafafa !important; }

			.page-404-full-page .details input {
			  background-color: #ffffff; }

			.page-404-full-page .page-404 {
			  margin-top: 100px; }
 
			.page-500-full-page {
			  overflow-x: hidden;
			  padding: 20px;
			  background-color: #fafafa !important; }

			.page-500-full-page .details input {
			  background-color: #ffffff; }

			.page-500-full-page .page-500 {
			  margin-top: 100px; }
 
			.page-404-3 {
			  background: #000 !important; }

			.page-404-3 .page-inner img {
			  right: 0;
			  bottom: 0;
			  z-index: -1;
			  position: absolute; }

			.page-404-3 .error-404 {
			  color: #fff;
			  text-align: left;
			  padding: 70px 20px 0; }

			.page-404-3 h1 {
			  color: #fff;
			  font-size: 130px;
			  line-height: 160px; }

			.page-404-3 h2 {
			  color: #fff;
			  font-size: 30px;
			  margin-bottom: 30px; }

			.page-404-3 p {
			  color: #fff;
			  font-size: 16px; }

			@media (max-width: 480px) {
			  .page-404 .number,
			  .page-500 .number,
			  .page-404 .details,
			  .page-500 .details {
				text-align: center;
				margin-left: 0px; }
			  .page-404-full-page .page-404 {
				margin-top: 30px; }
			  .page-404-3 .error-404 {
				text-align: left;
				padding-top: 10px; }
			  .page-404-3 .page-inner img {
				right: 0;
				bottom: 0;
				z-index: -1;
				position: fixed; } }
		</style>
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" page-500-full-page">
        <div class="row">
            <div class="col-md-12 page-500"> 
                <div class=" details">
                    <h3><?php echo $heading; ?></h3>
                    <p> 
					<?php echo $message; ?></p> 
                </div>
            </div>
        </div> 
    
    </body>

</html>