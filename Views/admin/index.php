<?php
////////////////////////////////////////////////////////////////
//    This is the public portion of the admin section        ///
//    The form is loaded from the inc class. Very nifty      ///
////////////////////////////////////////////////////////////////
?>
<?php echo $error?error::incorrectLogin():''; ?>
<?php echo inc::form('admin',$formData); ?>