<?php
/**********************************************

	$_PROFILES is an array of all the locations of your website
	
	Using this, you can have your website synchronized in ten
	places and have it work on all of them without annoying ifs
	
	To add a profile, add this line:
	
	$_PROFILES['YOUR DOCUMENT ROOT'] = '/path_to_framework/_profiles/your_name.php';
	
**********************************************/
$_PROFILES['D:/xampp/htdocs'] = '/coral/_profiles/local';
$_PROFILES['/home/jumping4/public_html/ts'] = '/_profiles/live';

// library classes
$_AUTOLOAD[] = "_library/";

// helper classes
$_AUTOLOAD[] = "_buttons/";
$_AUTOLOAD[] = "_messages/";
$_AUTOLOAD[] = "_tools/";

// framework classes
$_AUTOLOAD[] = "Application/";
$_AUTOLOAD[] = "Models/";
$_AUTOLOAD[] = "Controllers/";



// load configuration profile
$docroot = $_SERVER['DOCUMENT_ROOT'];
$profile = $docroot.$_PROFILES[$docroot].'.php';
if (file_exists($profile)){
	require_once($profile);
}
else {
	exit('Error - No configuration profile found. Check the config file.');
}
?>