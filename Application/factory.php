<?php
class factory {
	public function build($route) {
		$controllerName = inflect::controller($route->controller);
		if (file_exists(site::root.'Controllers/'.$controllerName.'.php')) {
			return new $controllerName($route);
		}
		else {
			exit('<p>Controller not found</p>');
		}	
	}
}
?>