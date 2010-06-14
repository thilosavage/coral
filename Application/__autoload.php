<?php
// automatically includes classes
// it will browse all $_AUTOLOAD values as directories.
// set $_AUTOLOAD in /config.php
function __autoload($class_name) {
	global $_AUTOLOAD;
	foreach ($_AUTOLOAD as $directory){
		if (file_exists(site::root.$directory.$class_name.'.php')){
			require_once site::root.$directory.$class_name .'.php';
		}
	}
}
?>