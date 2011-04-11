<?php
/**********************************************

	$_SERVERS is an array that contains information for all the locations of your project
	
	For every server that your project exists, you will have a $_SERVERS line
	
	Using this, you can have your website synchronized in ten
	places and have it work on all of them without if/thens or subversion ignores
	
	To add an installation, add this line:
	
	$_SERVER['YOUR DOCUMENT ROOT'] = '/path_to_framework/servers/location';
	
**********************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////  PUT YOUR CONFIGURATION PATHS HERE  ////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$_SERVERS['C:/x/htdocs'] = 'local'; // example

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

if (empty($_SERVERS[$docroot])) {
	require_once('Application/error.php');
	error::run('no_config_file');
}
// if a file is being requested in public folder
else if (strpos($_SERVER['SCRIPT_FILENAME'],'/public/')) {
	$d = "\$web = preg_replace(\"/\/public\/([a-zA-Z\/.]*)/\",\"\",\$_SERVER['SCRIPT_FILENAME']);";
	eval($d);
	$profile = $web.'/Application/servers/'.$_SERVERS[$docroot].'.php';
}
// for everything else
else {
	$ars = array($docroot,'index.php');
	$sitepath = str_replace($ars ,'',$_SERVER['SCRIPT_FILENAME']);
	$profile = $docroot.$sitepath.'Application/servers/'.$_SERVERS[$docroot].'.php';
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