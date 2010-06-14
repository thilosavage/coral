<?php
////////////////////////////////////////////////////////////////////////////////
//	This is my make-shift scaffolding which is sort of a phpmyadmin lite.     //
//	It will give you database management automatically based on your Models   //
////////////////////////////////////////////////////////////////////////////////

class scaffoldingController extends Admin {

	// use the admin layout
	var $layout = '_admin';
	
	// i dont want any of these pages allowed to the public
	var $unprotected_actions = array();
	
	function index($code) {
		$this->set('code',$code);
		$this->set('models',$models = database::models());
	}
	
	function table($table) {
		$tableObj = new $table(array('id>' => '0'));
		$this->set('rows',$tableObj->data);

		$this->set('tableName',$table);
		$this->set('fields',$tableObj->getFields());
				
		
	} 
	
	function edit($id) {
		$tableObj = new $_GET['table'];
		
		if (!$id) {
			echo "Asdf";
			$fieldData = $tableObj->getFields();
		}
		else {
			$tableObj->values = $id;
			$tableObj->load();
			$fieldData = $tableObj->data;
		}
		
		$this->set('table', $_GET['table']);
		$this->set('id', $id);
		$this->set('fields', $fieldData[$id]);
	}
	
	function save($id) {
		$tableObj = new $_GET['table'];
		$tableObj->data = $_POST['data'];
		$tableObj->data['id'] = $id;
		$saveID = $tableObj->save();
		$this->redirect('scaffolding/table/'.$_GET['table']);
	}
	
	function delete($id) {
		$tableObj = new $_GET['table'];
		$tableObj->delete($id);
		$this->redirect('scaffolding/table/'.$_GET['table']);
	}
}
?>