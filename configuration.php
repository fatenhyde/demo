<?php
session_start(); 
include_once 'csrfp/libs/csrf/csrfprotector.php';

//Initialise CSRFGuard library
csrfProtector::init();
/* global configuration */
$config = "gst.php";
$lang = 'bm';
define('HOME',dirname( __FILE__ ));
define('APPNAME', 'databankgst');
define('DS', DIRECTORY_SEPARATOR);

/* for relative path reference */
define('RHOME', "/".APPNAME);

/* application specific configuration */
include_once $config;
?>
