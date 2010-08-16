<?php
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
$_PROFILES['D:/xampp/htdocs'] = '/coral/_profiles/local';
$_PROFILES['YOUR DOCUMENT ROOT'] = '/PATH/_profiles/local';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
	echo "<p>Coral has been installed, but no configuration profile has been set.</p>";
	echo "Go to Application/config.php and add this line:<br>";
	echo "<em>\$_PROFILES['".$_SERVER['DOCUMENT_ROOT']."'] = '/newsite/_profiles/local';</em>";
	echo "<a href='http://www.thilosavage.com/coral/installation' target='_blank'>Read Documentation</a>";
	exit;
}

?>