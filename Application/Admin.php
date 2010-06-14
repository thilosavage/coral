<?php
/**********************************************

	You can make any controller extend Admin
	
	This will block out anyone who isn't logged in as admin
	With the exception of any view added to this array
	var $unprotected_actions = array();
	
	Example:
	var $unprotected_actions = array('index');
	This allows people to view site.com/admin/index
	Without having to log in
	
**********************************************/

class Admin extends Controller {
	var $layout = '_admin';
	var $unprotected_actions = array();
	
	// keep out the riff raff
	function prepare() {
		if (!in_array($this->_view, $this->unprotected_actions) && !isset($_SESSION['admin'])) {
			$this->session('return_to', $this->route);
			$this->redirect('admin/index');
		}
	}
	
	// process login information
	function _process(){
		if ($_POST['name'] == site::user && $_POST['pass'] == site::password) {
			$_SESSION['admin'] = 1;
			$this->redirect('admin/manager');
		}
		else {
			return true;
		}
	}
	
	// forgot what this thing does
	function logout() {
		unset($_SESSION['admin']);
		$this->redirect('admin/index');
	}
}