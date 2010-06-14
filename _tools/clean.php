<?php
class clean {
	public static function letters($str){
		return preg_replace("/[^a-zA-Z]/", "", $str);
	}

}
?>