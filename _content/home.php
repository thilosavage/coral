<?php
/**********************************************

	This is an example content page.. 
	
	Content pages can be accessed from anywhere
	but typically you should only call them from a view
	
	Like this (without .php)
	$content = inc::content('name-of-file');
	
	You can pass data to the content pages through $data
	
**********************************************/

echo "<div>The framework is working successfully".$data['blah']."</div>";
echo "<div>".button::route('example/quote', 'View a working AJAX example')."</div>";
echo "<div>".button::route('admin', 'Go to admin section')."</div>";

?>