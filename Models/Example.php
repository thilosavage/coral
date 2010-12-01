<?php 
/**********************************************

	Most tables will have their own model
	
	Models are always the table name with the first letter uppercase
	
	Models should only be dealt with in Controllers
	
	For specifics on how to instantiate Models and
	load data from the database, see exampleController
	
**********************************************/

class Example extends Model {

	// this is straight forward
	protected $table = 'example';
	protected $id_field = 'example_id';
	protected $name_field = 'first_name';
	protected $order_by = 'example_id DESC';
	
	// example method
	// this would be put in a Controller
	// example:
	// (in Controllers/exampleController.php)
	//        $exampleObj = new Example;
	//        $exampleObj->getByFirstName('bob');
	//        print_r($example->rows);
	function getByFirstName($first_name){
		$this->clear();
		$this->values = array('first_name'=>$first_name);
		$this->load();
	}
	
}
?>