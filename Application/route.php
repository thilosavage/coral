<?php
// create route object from: website.com/[controller]/[view]/[id]
// feel free to mess with this if you desire to destroy your website's functionality
class route {
	var $route;
	var $controller = '';
	var $model = '';
	var $view = '';
	var $id = '';
	var $full = '';
	public function __construct() {
		$this->route = self::get();
		$_SESSION['physAdd'] = $this->route;
		$this->full = $this->route;
		$urlArgs = explode('/', $this->route);
		$this->controller = ($urlArgs[0])?$urlArgs[0]:'';
		$this->view = (@$urlArgs[1])?$urlArgs[1]:'home';
		if (isset($urlArgs[2])){
			$hasID = explode("?",$urlArgs[2]);
			$this->id = ($hasID[0])?$hasID[0]:'';
		}
	}
	
	// get your route
	public static function get() {
		$pageURL = 'http';
		//JD made the assumption we would never use https. 
		//the code for it is directly below, commented out, incase we ever use it.
		//if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$pageURL = str_replace(site::url,"",$pageURL, $filtered);
		
		if (!$filtered){
			$pageURL = str_replace(str_replace('www.','',site::url),'',$pageURL, $filtered);
		}
		
		if (!$filtered){
			error::url_error();
		}

		return $pageURL;
	}	
}
?>