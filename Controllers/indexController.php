<?php
////////////////////////////////////////////////////////////////////////
//	The index controller is very simple								 //
//	To see a more complex example, check the Example controller      //
///////////////////////////////////////////////////////////////////////
class indexController extends Controller {
	
	
	
	function prep(){
		// do something before anything
	}
	function index(){
		
		// The Model takes query data in two forms - values and arrays

		// VALUES
		// array(2,5,6);
		// this will query for the id_field to be either 2, 5, or 6

		// ARRAYS
		// array('id'=>2,'name'=>'sushi');
		// this will query for `id`='2' AND `name` = 'sushi'

		// there are a few ways to run the SQL query
		
		// simplest
		$test = new Test(2,6,7,8);
		$this->vars('data',$test->data);
		
		$test->data = $test->data[7];
		$test->data['test'] = 'sort';
		$test->save();
		
	}
	function documentation(){
		// documentation page
	}
	function ajax_sushi(){
		//
	}

}
?>