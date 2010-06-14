<?php
class adminController extends Admin{

	var $unprotected_actions = array('index');
	
	function index(){
		$error = isset($_POST['submit'])?$this->_process():false;
		$this->set('error',$error);
		$formData = array('Please','log','in','to','the','admin');
		$this->set('formData',$formData);
		if (isset($_SESSION['admin']))$this->redirect('admin/manager');
	}	
	
	function manager() {
	}
	
	function generator(){
	}
}
?>