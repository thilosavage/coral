<?php
class error {

	public static function run($error) {
		echo self::$error();
		exit;
	}
	
	public static function settings_error() {
		echo "<p>Open the file for this installation of Coral (i.e. /servers/local.php)</p>";
		echo "<p>Check your root constant and make sure it's your document root, including the path to your site</p>";
		echo "<p>Try this line -<br>";
		
		$script = str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']);
		$script = str_replace('index.php','',$script);		
		
		echo "const root = '".$_SERVER['DOCUMENT_ROOT'].$script."';<br>";
		echo "(include the trailing slash)</p>";
		echo "<a href='http://www.thilosavage.com/coral/installation' target='_blank'>Read Documentation</a>";
		exit;
	}
	
	public static function url_error() {
		echo "<p>Open the file for this installation of Coral (i.e. /servers/local.php)</p>";
		echo "<p>Check your root constant and make sure it's your document root, including the path to your site</p>";
		echo "<p>Try this line -<br>";
		
		$script = str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']);
		$script = str_replace('index.php','',$script);		
		
		echo "const root = '".$_SERVER['DOCUMENT_ROOT'].$script."';<br>";
		echo "(include the trailing slash)</p>";
		echo "<a href='http://www.thilosavage.com/coral/installation' target='_blank'>Read Documentation</a>";
		exit;
	}
	
	public static function no_config_file() {
		echo "<p>Coral has been installed. Now you need to configure it for you server.</p>";
		echo "Go to Application/config.php and add this line to the configuation paths:<br>";

		$script = str_replace($_SERVER['DOCUMENT_ROOT'],'',$_SERVER['SCRIPT_FILENAME']);
		$script = str_replace('index.php','',$script);

		echo "<em>\$_SERVERS['".$_SERVER['DOCUMENT_ROOT']."'] = 'local';</em></p>";
		echo "<a href='http://www.thilosavage.com/coral/installation' target='_blank'>Read Documentation</a>";
		exit;
	}
	
	public static function page_doesnt_exist($page) {
		echo "<p>No page called ".$page.".php exists.</p>";
		exit;
	}
	
	public static function layout_not_found($layout) {
		echo "<p>No layout like ".$layout.".php exists.</p>";
		exit;
	}
	
	public static function mysql_connection($error) {
		echo "<p>There was an error trying to connect to the MySQL database -</p>";
		echo "<em>".$error."</em>";
		echo "<p>Check your Application/server/ configuration file and make sure you have the<br />";
		echo "proper values for db_user, db_pass, and db_name</p>";
		exit;
	}		
	
}
?>