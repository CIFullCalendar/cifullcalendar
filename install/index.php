<?php

$php_version_success = false;
$mysql_success = false;
$curl_success = false;
$mbstring_success = false;
$intl_success = false;
$json_success = false;
$mysqlnd_success = false;
$xml_success = false;
$gd_success = false;
$timezone_success = false;
$zlib_success = false;

$php_version_required = "8.2";
$current_php_version = PHP_VERSION;

//check required php version
if (version_compare($current_php_version, $php_version_required) >= 0) {
    $php_version_success = true;
}

//check mySql 
if (function_exists("mysqli_connect")) {
    $mysql_success = true;
}

//check curl 
if (function_exists("curl_version")) {
    $curl_success = true;
}

//check mbstring 
if (extension_loaded('mbstring')) {
    $mbstring_success = true;
}

//check intl 
if (extension_loaded('intl')) {
    $intl_success = true;
}

//check json 
if (extension_loaded('json')) {
    $json_success = true;
}

//check mysqlnd 
if (extension_loaded('mysqlnd')) {
    $mysqlnd_success = true;
}

//check xml 
if (extension_loaded('xml')) {
    $xml_success = true;
}

//check gd
if (extension_loaded('gd') && function_exists('gd_info')) {
    $gd_success = true;
}

$timezone_settings = ini_get('date.timezone');
if ($timezone_settings) {
    $timezone_success = true;
}

if (!ini_get("zlib.output_compression")) {
    $zlib_success = true;
}

//check if all requirements
if ($php_version_success && $mysql_success && $curl_success && $mbstring_success && $gd_success && $timezone_success && $intl_success && $json_success && $mysqlnd_success && $xml_success && $zlib_success) {
    $all_requirement_success = true;
} else {
    $all_requirement_success = false;
}

$writeable_directories = array(
    'cache' => '/system/writable/cache',
    'debugbar' => '/system/writable/debugbar',
    'logs' => '/system/writable/logs',
    'session' => '/system/writable/session',
    'uploads' => '/system/writable/uploads',
    'modules' => '/system/app/Modules',
    'env' => '/system/.env',
    'files' => '/assets/img',
    'routes' => '/index.php'
);

foreach ($writeable_directories as $value) {
    if (!is_writeable(".." . $value)) {
        $all_requirement_success = false;
    }
}

$dashboard_url = $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
$dashboard_url = preg_replace('/install.*/', '', $dashboard_url); 
if (!empty($_SERVER['HTTPS'])) {
    $dashboard_url = 'https://' . $dashboard_url;
} else {
    $dashboard_url = 'http://' . $dashboard_url;
}

include "view/index.php";
