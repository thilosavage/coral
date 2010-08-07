<?php
/**********************************************

	A way to keep track of your buttons
	Not necessary
	But if you have fifteen "Add to playlist" buttons on your site
	it's easier to come here and change one thing rather than
	go through the site and copy/paste the new button 15 times
	
	Just sayin....

**********************************************/

class button{
	public static function route($route,$text,$class=''){
		$ret = "<a href='".site::url.$route."'";
		$ret .= " class='".$class."'";
		$ret .= ">".$text."</a>";
		return $ret;
	}
	public static function link($url,$text,$class=''){
		$ret = "<a href='".$url."'";
		$ret .= " class='".$class."'";
		$ret .= ">".$text."</a>";
		return $ret;		
	}
	// this is an example of an AJAX button
	// then in content or views or whatever, I can just do:
	//  echo button::my_ajax_button();
	public static function my_ajax_button(){
		$button = "<span class='loginWindowLoad'>Login!!!!!!</span>";
		return $button;
	}
}
?>