<?php
class factory {
	public static function build($route) {
		$controllerName = inflect::controller($route->controller);
		if (file_exists(site::root.'Controllers/'.$controllerName.'.php')) {
			return new $controllerName($route);
		}
		else {
			$route->id = $route->controller?$route->controller:site::homepage;
			$route->controller = 'index';
			$route->view = 'index';
			return new indexController($route);
		}	
	}
}
?>