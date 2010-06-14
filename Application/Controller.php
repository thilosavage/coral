<?php
// makes the core controller stuff
// keep in mind that you can use any of these methods inside your controllers
abstract class Controller {

	protected $_model;
	protected $_controller;
	protected $_view;

	var $vars = array();
	var $action = '';
	var $layout = site::layout;
	
	public function __construct($route) {
		$this->route = $route->full;
		$this->controller = $route->controller;
		$this->model = $route->model;
		$this->view = $route->view;
		$this->id = $route->id;
	}      

	public function run() {
		if (substr($this->view,0,5) == "ajax_"){
		$request = $_SERVER[ 'HTTP_X_REQUESTED_WITH' ];
		if ($request == 'XMLHttpRequest' || site::debug) {
				$this->layout = '_ajax';
			}
			else {
				exit("<p>Access denied.</p>");
			}
		}
		$this->prep();
		$this->{$this->view}($this->id);
		$this->render_layout();
	}	
	
	function prep() {
	}
	
	protected function render_layout() {
		$path = site::root.'_layouts/'.$this->layout.'.php';
		if (file_exists($path)) {
			include $path;
		}
		else {
			log::error('Layout page not found');
			exit('Layout not found');
		}
	}
	
	protected function render_view() {
	
		if ($this->vars) {
			foreach ($this->vars as $_name => $_value) {
				$$_name = $_value;
			}		
		}	
	
		$ajaxExt = $this->layout=='_ajax'?'/ajax':'';
		$path = site::root.'Views/'.$this->controller.$ajaxExt.'/'.str_replace('ajax_','',$this->view).'.php';
	
		if (file_exists($path)) {
			include $path;
		}
		else {
			log::error('View page not found');
			exit('View not found');
		}				
	}
	
	function session($key, $value = '') {
		if ($value) $_SESSION[$key] = $value;
		return isset($_SESSION[$key])?$_SESSION[$key]:false;
	}
	
	function redirect($route) {
		header('Location: '.site::url.$route);
		exit;
	}
	
	public function set($name, $value) {
		$this->vars[$name] = $value;
	}
}
?>