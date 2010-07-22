<?php
////////////////////////////////////////////////////////////
///  	Customize all your messages in one place          //
////////////////////////////////////////////////////////////
class message {

	static $style = 'font-weight: bold';
	
	public static function welcome(){
		return "<div style='".self::$style."'>This is a default welcome message.</div>";
	}
	
}
?>