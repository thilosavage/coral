<?php
/**********************************************

	Configuration for the live site
	
**********************************************/
class site extends config{
	const url = 'http://www.thilosavage.com/';
	const root = '/var/www/html/';
	const image = 'http://www.thilosavage.com/images/';
	
	const user = 'admin';
	const password = '123';
	
	const homepage = 'home';
	const layout = 'default';
	
	const db_user = '';
	const db_pass = '';
	const db_name = '';
	const db_url = 'localhost';
	
	const debug = 0;
	
	function __construct(){
		ini_set('display_errors', 0);
	}
}
?>