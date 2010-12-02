<?php
/**********************************************

	Configuration for the local development site
	
**********************************************/
class site extends config{
	const url = 'http://localhost/coral/';
	const root = '/xampp/htdocs/coral/';
	const image = 'http://localhost/coral/images/';
	
	const folder = 'web';
	
	const user = 'thilo';
	const password = 'chicken';
	
	const homepage = 'home';
	const layout = '_default';
	
	const db_user = 'maven';
	const db_pass = '123';
	const db_name = 'test';
	const db_url = 'localhost';
	
	const debug = 1;
	
}
?>