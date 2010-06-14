<?php
class form {

	public function start($action= '', $method= 'post', $multipart= false, $extra = '') {
		$action = $action?$action:site::url;
		$method = 'method="'.$method.'" ';
		$multipart = $multipart?'enctype="multipart/form-data" ':'';
		return '<form action="'.$action.'" '.$method.$multipart.$extra.'>';
	}
	
	public function checkbox($name, $value, $check='', $extra = '', $id='') {
		$checked = (($check==='' && $_POST[$name]) || $check)?' checked':'';
		return '<input type="checkbox" '.self::_vars($id,$value,$name).$extra.$checked.'>';
	}
	
	public function radio($name, $value, $check='', $extra = '', $id='') {
		$checked = (($check==='' && $_POST[$name]) || $check)?' checked':'';
		return '<input type="radio" '.self::_vars($id,$value,$name).$extra.$checked.'>';	
	}
	
	public function input($name, $value='', $length='', $maxlen='', $extra = "", $id="") {
		return '<input type="text" '.self::_vars($id,$value,$name).'>';
	}
	
	public function pass($name, $value, $length, $maxlen, $type= "text", $checked="", $src= "", $extra = "", $id="") {
		return '<input type="password" '.self::_vars($id,$value,$name).$extra.$checked.'>';
	}
	
	public function submit($name, $value, $id='', $src= '', $extra = '') {
		return '<input type="submit" '.self::_vars($id,$value,$name).$extra.$checked.'>';
	}	

	public static function text($name, $value='', $rows= 5, $cols= 35, $id='', $extra = '') {
		$rawName = htmlentities($name);
		$name = ' name="'.$rawName.'" ';
		$rows = ' rows="'.htmlentities($rows).'" ';
		$cols = ' cols="'.htmlentities($cols).'" ';
		$id = ' id="'.($id?htmlentities($id):$rawName).'" ';
		return '<textarea '.$name.$rows.$cols.$id.' wrap=auto '.$extra.'>'.stripslashes($value).'</textarea>';
	}
	
	public static function end(){
		return "</form>";
	}
	
	public function _vars($id,$value,$name){
		$id = 'id="'.($id?htmlentities($id):htmlentities($name)).'" ';
		$value = 'value="'.htmlentities($value).'" ';
		$name = 'name="'.htmlentities($name).'" ';
		return $id.$name.$value;
	}	
	
}
?>
