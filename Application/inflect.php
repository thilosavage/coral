<?php
class inflect {
	public static function controller($controller) {
		return strtolower($controller).'Controller';
	}
	public static function controllerName($controllerName) {
		return strtolower(substr($controllerName, 0, -10));
	}
	public static function controllerFile($controller) {
		$controller = str_replace('controller','Controller',$controller);
		$controller = strpos($controller,'Controller')?$controller:$controller."Controller";
		return $controller.".php";
	}
}
?>
