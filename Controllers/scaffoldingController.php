<?php
/**********************************************

	This is my make-shift scaffolding which is sort of a phpmyadmin lite.
	It will give you database management automatically based on your Models 
	
**********************************************/
class scaffoldingController extends Admin {

	// use the admin layout
	var $layout = 'admin';
	
	// i dont want any of these pages allowed to the public
	var $unprotected_actions = array();
	
	function index($code) {
		$this->vars('code',$code);
		$this->vars('models',$models = database::models());
	}
	
	function table($table) {
		$tableObj = new $table('all');
		$this->vars('rows',$tableObj->rows);
		$this->vars('tableName',$table);
		$this->vars('fields',$tableObj->getFields());
	} 
	
	function edit($id) {
		$tableObj = new $_GET['table'];
		
		if (!$id) {
			$fieldData = $tableObj->getFields();
		}
		else {
			$tableObj->values = $id;
			$tableObj->load();
			$fieldData = $tableObj->row;
		}
		
		$this->vars('table', $_GET['table']);
		$this->vars('id', $id);
		$this->vars('fields', $fieldData);
	}
	
	function save($id) {
		$tableObj = new $_GET['table'];
		$tableObj->set = $_POST['data'];
		$saveID = $tableObj->save($id);
		$this->redirect('scaffolding/table/'.$_GET['table']);
	}
	
	function delete($id) {
		$tableObj = new $_GET['table'];
		$tableObj->delete($id);
		$this->redirect('scaffolding/table/'.$_GET['table']);
	}
}
?>