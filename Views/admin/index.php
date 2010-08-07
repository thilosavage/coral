<?php
/**********************************************

	Admin login view
	
**********************************************/
?>
<?php 
if ($error){
	echo "<div>".$error."</div>";
}
?>
<?php echo inc::form('admin',$formData); ?>