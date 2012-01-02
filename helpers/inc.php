<?php
/**********************************************

	inc Class is for easy module and form includes
	as well as external JS and CSS files
	
	To include a content page, do
		echo inc::content('the-page');
	
	To pass data to it, do
		echo inc::content('the-page',$array_of_data);
	
	To include a form, do
		echo inc::form('form',$data);
	
	For JS and CSS, do
	
		echo inc::js('javascript-file.js');
		echo inc::css('css-file.css');
		
	Note that pages load faster with less external JS/CSS pages
	
	This framework provides a way to put all your JS/CSS files
	into one for faster loading
	
	Just start any JS or CSS file with an underscore and then do
		echo inc::css();
		echo inc::js();
		
	This will pack all the JS/CSS files that have an underscore
	into one file and call that
	
**********************************************/

class inc{
	
	public static function page($page,$data=array()){
		ob_start();
		$file = site::root.'/_pages/'.$page.'.php';
		
		if (file_exists($file)) {
			include($file);
		}
		else {
			echo error::page_doesnt_exist($page);
		}
		
		$bah = ob_get_contents();
		ob_end_clean();
		return $bah;
	}

	public static function module($module,$data=array()){
		ob_start();
		include(site::root.'_modules/'.$module.'.php');
		$bah = ob_get_contents();
		ob_end_clean();
		return $bah;
	}	
	
	public static function form($form,$data=array()){
		ob_start();
		include(site::root.'_forms/'.$form.'.php');
		$bah = ob_get_contents();
		ob_end_clean();
		return $bah;
	}
	
	public static function js($file='common.php',$path='javascript/',$passPath=true){
		$ret = "<script src='".site::url.$path.$file;
		$ret .= "' type='text/javascript'></script>";
		echo $ret;
	}
	public static function css($file='common.php',$path='styles/',$passPath=true){
		$ret = "<link href='".site::url.$path.$file;
		$ret .= "' rel='stylesheet' type='text/css' />";
		echo $ret;
	}
}
?>