<?php
/**********************************************

	Put all your forms in this folder to keep them organized
	How do you get these forms on a page? Here's one way: 
		include(site::url.'_forms/admin.php');
		
	Yuck! That is ugly. Let's do it more better. Do this:
		echo inc::form('admin');  
		
	Yes! Very clean. And it's in a string! Beautiful! 
	
**********************************************/

?>
<?php
echo form::start(site::url.'admin/index');
echo "Username: ".form::input('name', '')."<br>";
echo "Password: ".form::input('pass', '')."<br>";
echo "Useless checkbox? ".form::checkbox('checkbox','value')."<br>";
echo form::submit('submit','login');
echo "</form>";
?>