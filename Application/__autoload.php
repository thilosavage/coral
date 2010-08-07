<?php
/**********************************************

	Automatically require classes
	
	You don't have to require_once to instantiate
	an object. Just instantiate/reference the class
	
	If you're ever typing require_once(a_class_file.php);
	You are adding unnecessary effort
	
	The autoload wil only scan folders in the $_AUTOLOAD array
	
	To add folders to this array
	go into Application/config.php
	
**********************************************/
function __autoload($class_name) {
	global $_AUTOLOAD;
	foreach ($_AUTOLOAD as $directory){
		if (file_exists(site::root.$directory.$class_name.'.php')){
			require_once site::root.$directory.$class_name .'.php';
		}
	}
}
?>