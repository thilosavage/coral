<?php
header("content-type: application/x-javascript");

// change your js folder if you want:
$js_folder = 'javascript';

$url_parts = explode('/',$_SERVER['PHP_SELF']);
$self = $js_folder.'/'.end($url_parts);
$docRoot = str_replace($self,'',$_SERVER['SCRIPT_FILENAME']);
$docRoot = str_replace('public/','',$docRoot);

echo "/*";
require_once($docRoot.'config.php');
echo "*/";

$handler = opendir(site::root.'_js/');
while ($file = readdir($handler)) {
	if ($file != '.' && $file != '..')
		$files[] = $file;
}
closedir($handler);
?>

var siteUrl = '<?php echo site::url;?>';
var loader = '<img src="<?php echo site::url;?>images/loader.gif">';

<?php

foreach ($files as $fileName){
	$path = site::root.'_js/'.$fileName;
	
	ob_start();
	include($path);
	$output = ob_get_clean(); 	
	$output = str_replace("<script>","", $output);
	$output = str_replace("</script>","", $output);
	echo $output;	
}
?>