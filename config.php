<?php

// if you change this, you'll have to change it 3 times in the .htaccess as well
define("CO_WEB_PATH","web");

/**********************************************

	$_PROFILES is an array of all the locations of your website
	
	For every server that your site exists, you will have a line here
	
	Using this, you can have your website synchronized in ten
	places and have it work on all of them without annoying ifs
	
	To add a profile, add this line:
	
	$_PROFILES['YOUR DOCUMENT ROOT'] = '/path_to_framework/_profiles/your_name.php';
	
**********************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////  PUT YOUR CONFIGURATION PATHS HERE  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$_PROFILES['D:/xampp/htdocs'] = 'local';
$_PROFILES['/var/www/html'] = 'live';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add any folder with class files
// this will be used by the __autoload function in Application/__autoload.php
$_AUTOLOAD[] = "helpers/";
$_AUTOLOAD[] = "Application/";
$_AUTOLOAD[] = "Models/";
$_AUTOLOAD[] = "Controllers/";


// load configuration profile
$docroot = $_SERVER['DOCUMENT_ROOT'];

if (strpos($_SERVER['SCRIPT_FILENAME'],'/'.CO_WEB_PATH.'/')) {
	$d = "\$web = preg_replace(\"/\/".CO_WEB_PATH."\/([a-zA-Z\/.]*)/\",\"\",\$_SERVER['SCRIPT_FILENAME']);";
	eval($d);
	$profile = $web.'/servers/'.$_PROFILES[$docroot].'.php';
}
else {
	$ars = array($docroot,'index.php');
	$sitepath = str_replace($ars ,'',$_SERVER['SCRIPT_FILENAME']);
	$profile = $docroot.$sitepath.'servers/'.$_PROFILES[$docroot].'.php';
}

if (file_exists($profile)){
	require_once($profile);
}
else {
	require_once('Application/error.php');
	error::run('no_config_file');
}

class config {
	function __construct() {
		ini_set('display_errors', 1);
		error_reporting(E_STRICT);
		error_reporting(E_ALL);	
	}
}

?>