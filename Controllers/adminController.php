<?php
/**********************************************

	Admin controller
	
	This is just like any other Controller except that
	it extends Admin, which makes it off limits
	unless the user is logged in as an admin
	
**********************************************/
class adminController extends Admin{

	var $unprotected_actions = array('index');
	
	function index(){
		$error = isset($_POST['submit'])?$this->_process():false;
		$this->vars('error',$error);
		$formData = array('Please','log','in','to','the','admin');
		$this->vars('formData',$formData);
		if (isset($_SESSION['admin']))$this->redirect('admin/manager');
	}	
	
	function manager() {
	}
	
	function generator(){
	}
}
?>