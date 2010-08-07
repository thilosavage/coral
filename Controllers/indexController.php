<?php
/**********************************************

	Your index controller is special because it is default
	
	If the first argument in the URL string is not recognized
	as a Controller, it will use the index Controller and index method
	
	Controllers and their actions are what decide what
	the user sees/does. It works like this:
	
	yoursite.com/controller/action
	
	If I go to yoursite.com/index/sushi
	It will point to the sushi action of this Controller
	
	However, if I go to
	yoursite.com/not-a-controller
	
	It will display content/not-a-controller.php
	
	You can always use content files in other
	Controllers by using
	$content = inc::content('content-file');
	
	This quick fast index/index way is just for speed
	
**********************************************/

class indexController extends Controller {
	// index should be the only method in here
	// if your site is bigger than one level
	// create new controllers for your pages
	function index(){
		$this->layout = '_default';
		$data['blah'] = '!!!!';
		$this->vars('data',$data);
	}
}
?>