<script>
/**********************************************

	To keep everything organized, use this naming convention:
	[Controller][Thing][Action]
	
	For example, this file is _example.php
	So all the AJAX in this file will call to the Example controller
	And all the function names will start with example
	A function that loads a quote would look like
	
**********************************************/

function exampleQuoteLoad(){
	// siteUrl is set in js.php
	// all PHP ajax actions are appended by ajax_
	$.post(siteUrl+'example/ajax_exampleQuoteLoad',function(data){
		$('#quote').html(data.quote);
	},'json');
}

</script>