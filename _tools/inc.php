<?php
class inc{
	var $data = array();

	public static function lude($path){
		require(site::root.$path);
		return ob_get_flush(); 
	}
	
	public function text($text){
		require(site::root.'_text'.$text.'.php');
		return ob_get_flush();
	}

	public static function form($form,$data=array()){
		include(site::root.'_forms/'.$form.'.php');
		return ob_get_flush();
	}

	function hook($file){
		if (file_exists($file.".php")){
			include($file.".php");
			return false;
		}
		else {
			return true;
		}
	}
	
	public static function js($file='compiler.php',$path='_javascript/',$passPath=true){
		$ret = "<script type='text/javascript' src='".site::url.$path.$file;
		$ret .= "' type='text/javascript'></script>";
		echo $ret;
	}
	public static function css($file='styles.php',$path='_styles/',$passPath=true){
		$ret = "<link href='".site::url.$path.$file;
		$ret .= "' rel='stylesheet' type='text/css' />";
		echo $ret;
	}
}
?>