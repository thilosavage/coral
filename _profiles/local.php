<?php
class  site{
	const url = 'http://localhost/coral/';
	const root = '/xampp/htdocs/coral/';
	
	const user = 'thilo';
	const password = 'chicken';
	
	const controller = 'index';
	const action = 'index';
	const id = '1';
	const layout = '_default';
	
	const db_user = 'maven';
	const db_pass = '123';
	const db_name = 'test';
	const db_url = 'localhost';
	
	const debug = 1;
	
	function __construct(){
		ini_set('display_errors', 1);
		error_reporting(E_STRICT);
		error_reporting(E_ALL);
	}
}
?>