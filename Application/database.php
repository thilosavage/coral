<?php
class database {
    private static $instance;

    private function __construct() {
		self::$instance = mysql_connect(site::db_url,site::db_user,site::db_pass);                                                         
		mysql_select_db(site::db_name,self::$instance);
	}
    public static function db(){
        if (!self::$instance){
            self::$instance = new database();
        }
        return self::$instance;
    }
	
	public function query($query){
		return mysql_query($query);
	}
	
	public static function models() {
		$models = '';
		$directory = opendir(site::root.'Models');
		
		while($file = readdir($directory)) {
			$dirs[] = $file;
			if (strlen($file) > 2) {
				$bits = explode(".",$file);
				$key = $bits[0];
				$val = $file;
				$models[$key] = $file;
			}
		}
		closedir($directory);
		return $models;
	}
}  
?>