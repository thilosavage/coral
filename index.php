<?php 
session_start();  

// require autoload
require_once('Application/__autoload.php');

// require config
require_once('config.php');

if (!class_exists('log')){
	require_once('Application/error.php');
	error::run('settings_error');
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