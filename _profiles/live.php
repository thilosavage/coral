<?php
/**********************************************

	Configuration for the live site
	
**********************************************/
class  site{
	const url = 'http://www.thilosavage.com/';
	const root = '/var/www/html/';
	const image = 'http://www.thilosavage.com/_images/';
	
	const user = 'thilo';
	const password = 'chicken';
	
	const homepage = 'home';
	const layout = '_default';
	
	const db_user = '';
	const db_pass = '';
	const db_name = '';
	const db_url = 'localhost';
	
	const debug = 1;
	
	function __construct(){
		ini_set('display_errors', 1);
		error_reporting(E_STRICT);
		error_reporting(E_ALL);
	}
}
?>