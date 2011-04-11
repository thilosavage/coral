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
		
		
		if (isset($_SESSION['admin']))
			$this->redirect('admin/manager');		
			
		$data['user'] = '';
		$error = false;

		if (!empty($_POST)) {
			$error = $this->_process();
			$data['user'] = $_POST['user'];
		}
		
		$this->vars('error',$error);
		$this->vars('data',$data);
		

	}	
	
	function manager() {
	}
	
	function generator(){
	}
}
?>