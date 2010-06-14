<?php
// 		write to a log file in times of need
// 		just put:
//      	log::set($dataYouWantPut); 
//		and you can find it in the root area
//		or write a custom log file with:
//          log::write($data,$file,$path);
class log {
	static $data;
	public static function set($data){
		self::$data .= $data."\r\n";
	}
	
	public static function error($data){
		$num = rand(1000,2000);
		$errorNum = '';
		if (class_exists('site')){
			$errorNum = site::debug?"[error#".$num."]":"Turn debug mode on to enable logging. Be sure to turn it off when you're done.";
		}
		$data = $data."\r\n".$errorNum;
		self::write($data,"error.txt");
	}

	public static function write($data='', $file = "log.txt", $path = ''){
		$data = $data?$data:self::$data;
		$doc_root = class_exists('site')?site::root:'';
		$Handle = fopen($doc_root.$path.$file, 'w');
		$num = rand(1000,2000);
		$errorNum='';
		if ($file == "log.txt" && $path == ''){
			$errorNum = class_exists('site')?"[log#".$num."]":"Turn debug mode on to enable logging. Be sure to turn it off when you're done.";
		}
		fwrite($Handle, $data.$errorNum);
		fclose($Handle);
	}
}
?>