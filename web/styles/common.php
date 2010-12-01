<?php
header("content-type: application/x-javascript");

// change your js folder if you want:
$css_folder = 'styles';

$self = $css_folder.'/'.end(explode('/',$_SERVER['PHP_SELF']));
$docRoot = str_replace($self,'',$_SERVER['SCRIPT_FILENAME']);
$docRoot = str_replace('web/','',$docRoot);


echo "/*";
require_once($docRoot.'config.php');
echo "*/";

$handler = opendir(site::root.'web/'.$css_folder.'/');
while ($file = readdir($handler)) {
	if ($file != '.' && $file != '..' && substr($file,0,1)=="_")
		$files[] = $file;
}
closedir($handler);

foreach ($files as $fileName){
	$path = site::root.'web/'.$css_folder.'/'.$fileName;
	
	ob_start();
	include($path);
	$output = ob_get_clean(); 	
	$output = str_replace("<style>","", $output);
	$output = str_replace("</style>","", $output);
	echo $output;	
}
?>