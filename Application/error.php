<?php
class error {

	function run($error) {
		echo self::$error();
		exit;
	}
	
	function settings_error() {
		$error = "<p>Your configuration profile is working, but there is an error in your settings</p>";
		$error .= "<p>Open the configuration profile for this installation of Coral (i.e. _profiles/local.php)</p>";
		$error .= "<p>Check your root constant and make sure it's your document root, including the path to your site</p>";
		$error .= "<p>Example:<br>";
		$error .= "const root = 'D:/xampp/htdocs/yoursite/'<br>";
		$error .= "or<br>";
		$error .= "const root = '/var/www/html/yoursite/'<br>";
		$error .= "(include the trailing slash)</p>";
		$error .= "<a href='http://www.thilosavage.com/coral/installation' target='_blank'>Read Documentation</a>";
		return $error;
	}
	
	function no_config_file() {
		$error = "<p>Coral has been installed, but no configuration profile has been set.</p>";
		$error .= "Go to Application/config.php and add this line:<br>";
		$error .= "<em>\$_PROFILES['".$_SERVER['DOCUMENT_ROOT']."'] = '/newsite/_profiles/local';</em>";
		$error .= "<a href='http://www.thilosavage.com/coral/installation' target='_blank'>Read Documentation</a>";
		return $error;
	}
}
?>