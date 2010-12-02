<?php
/**********************************************

	All your controllers should extend Controller
	
	This is the carburator of the engine that is your site
	
	It is fairly straight forward, and only 100 lines,
	which makes it scalable and understandable
	
**********************************************/
abstract class Controller {

	protected $model;
	protected $controller;
	protected $view;

	var $route = '';
	var $id = '';
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
		$this->_prepare();
		$this->{$this->view}($this->id);
		$this->render_layout();
	}	
	
	// This is mostly to be used in extensions,
	//  but you can put default _prepare stuff here
	//  Also you can use this _prepare as well as
	//  an extension by adding
	//         self::_prepare();
	//  within the extended method
	function _prepare() {
	}
	
	protected function render_layout() {
		$path = site::root.CO_WEB_PATH.'/layouts/'.$this->layout.'.php';
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
	
	public function vars($name, $value) {
		$this->vars[$name] = $value;
	}
}
?>