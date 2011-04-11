<?php
/**********************************************

	All your controllers should extend Controller
	
	This is the carburator of the engine that is your site
	
	It is fairly straight forward, and only 100 lines,
	which makes it scalable and understandable
	
**********************************************/
class exampleController extends Controller {

	function _prepare(){
	
		// do something before anything to prepare the controller
		
		// say you want every action in the Example Controller to 
		// make a session increment 1, do 
		
		//$_SESSION['useless_incrementor']++;
		
		// this will add one any time someone access this
		//controller no matter what action
		
	}
	
	function quote(){
	
		// methods within the Controller are called actions
		// the URL string will determine the Controller and action
		// example -- this function will be called when someone goes to
			// yoursite.com/example/something
		
		// a third variable is an argument passed to the function
			// yoursite.com/example/something/hello
			// will run this function and pass hello as the argument
			
		// A word about how the Controller interacts with Models
	
		// The Model takes query data in two forms - values and arrays

		// VALUES
		// array(2,5,6);
		// this will query for the id_field to be either 2, 5, or 6

		// ARRAYS
		// array('id'=>2,'name'=>'sushi');
		// this will query for `id`='2' AND `name` = 'sushi'

		// there are several ways to load the database rows into the object
		
		// simplest
		$testObj = new Example(2,6,7,8);
		// this loads the rows 2, 6, 7, and 8 into $test->rows
		
		// you can just load one row
		$testObj = new Example(7);
		// and use $test->row
		
		// to make a more complex query
		$testObj = new Example(array('name'=>'bob'));
		// this will load all the rows where the name field is set to bob
		
		// this can all be expanded upon and broken out into pieces
		$testObj = new Example;
		$testObj->values = array('firstname'=>'bob', 'lastname'=>'jones');
		$testObj->logic = 'AND';
		$testObj->sort_order = 'occupation DESC';
		$testObj->load();
		// this will load all the rows where firstname is bob and lastname is jones
		// and sort them by occupation descending
		
		// send the data to the view
		$this->vars('data',$testObj->rows);
		
		// to save data, do this
		$testObj = new Example;
		$testObj->set['firstname'] = 'bob';
		$testObj->set['lastname'] = 'jones';
		$testObj->save();
		
		// you could also do
		$testObj = new Example;
		$vars = array('firstname'=>'bob','lastname'=>'jones');
		$testObj->save($vars);
		
		// or even simpler
		$testObj = new Example;
		$testObj->save(array('firstname'=>'bob','lastname'=>'jones'));
		
		
		// Every action should have a view.  The view handles the
		// displaying of the information rendered by the Controller
		// the view for this function would be located in Views/example/something.php
		// Data is sent to the view using $this->vars('name',$data);
		// example --
		$elipsis = '...';
		$this->vars('elipsis',$elipsis);
		// now in the view, i could echo $my_greeting and it would echo hello
		
	}
	
	function ajax_exampleQuoteLoad(){
		
		// this example is stupid and is only to demonstrate AJAX
		// AJAX requests have a view just like all the others
		// except they belong in Views/view/ajax
		
		$quotes[] = "A random quote";
		$quotes[] = "Another random quote";
		$quotes[] = "Never sniff a gift goat in the lips";
		
		$quoteNumber = rand(0,count($quotes)-1);
		$quote = $quotes[$quoteNumber];
		$this->vars('quote',$quote);
		
	}
}
?>