<?php
/**********************************************

	Admin login view
	
**********************************************/
?>
<?php
if ($error){
	echo "<div>There was an error. Try again</div>";
}
?>
<?php echo inc::form('admin-login',$data); ?>