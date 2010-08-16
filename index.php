<?php 
session_start();  

// require autoload
require_once('Application/__autoload.php');

// require config
require_once('Application/config.php');

if (!class_exists(log)){
	echo "<p>Your configuration profile is working, but there is an error in your settings</p>";
	echo "<p>Open the configuration profile for this installation of Coral (i.e. _profiles/local.php)</p>";
	echo "<p>Check your root constant and make sure it's your document root, including the path to your site</p>";
	echo "<p>Example:<br>";
	echo "const root = 'D:/xampp/htdocs/yoursite/'<br>";
	echo "or<br>";
	echo "const root = '/var/www/html/yoursite/'<br>";
	echo "(include the trailing slash)</p>";
	echo "<a href='http://www.thilosavage.com/coral/installation' target='_blank'>Read Documentation</a>";
	exit;
}

$route = new route();
$controller = factory::build($route);
$controller->run($route);

if(site::debug)log::error("The application finished without any errors.");
site::debug?log::set(mysql_error()):'';
echo log::write();

// now gtfo
exit;
?>