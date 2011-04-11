<?php
header("content-type: application/x-javascript");

// change your css folder if you want:
$css_folder = 'styles';

$url_parts = explode('/',$_SERVER['PHP_SELF']);
$self = $css_folder.'/'.end($url_parts);
$docRoot = str_replace($self,'',$_SERVER['SCRIPT_FILENAME']);
$docRoot = str_replace('public/','',$docRoot);

echo "/*";
require_once($docRoot.'config.php');
echo "*/";

$handler = opendir(site::root.'_css');
while ($file = readdir($handler)) {
	if ($file != '.' && $file != '..')
		$files[] = $file;
}
closedir($handler);

foreach ($files as $fileName){
	$path = site::root.'_css/'.$fileName;
	
	ob_start();
	include($path);
	$output = ob_get_clean(); 	
	$output = str_replace("<style>","", $output);
	$output = str_replace("</style>","", $output);
	echo $output;	
}
?>