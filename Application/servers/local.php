<?php
/**********************************************

	Configuration for the local development site
	
**********************************************/
class site extends config{
	const url = 'http://localhost/coral/';
	const root = 'C:/x/htdocs/coral/';
	const image = 'http://localhost/coral/images/';
	
	const user = 'admin';
	const password = '123';
	
	const homepage = 'home';
	const layout = 'default';
	
	const db_user = 'root';
	const db_pass = '';
	const db_name = 'test';
	const db_url = 'localhost';
	
	const debug = 1;
	
	function __construct(){
	
	}
	
}
?>