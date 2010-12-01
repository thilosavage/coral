<?php
/**********************************************

	Yes this HTML could go in a file in _content
	and then called with
		echo inc::content('quote-module');
		
	But it's only two lines of code..
	
	Maybe if the quote generator was to be used
	like a module and went in many places around
	the site, it would go in a _content file
	This way it could be loaded from any Controller or View
	
**********************************************/

echo "<div class='fakelink exampleQuoteLoad'>Generate a random quote".$elipsis."</div>";
echo "<div id='quote'></div>";
?>