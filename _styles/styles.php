<?php
$stylesFolder = '_styles/';
$stylesFile = 'styles.php';

$stylesPath = $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'];
$docRoot = str_replace($stylesFolder.$stylesFile,'',$stylesPath);
echo "/*";
require_once($docRoot.'config.php');
echo "*/";
$handler = opendir(site::root.$stylesFolder);
while ($file = readdir($handler)) {
	if ($file != '.' && $file != '..' && substr($file,0,1)=="_")
		$files[] = $file;
}
closedir($handler);

foreach ($files as $fileName){
	$path = site::root.$stylesFolder.$fileName;

	ob_start();
	include($path);
	$output = ob_get_clean(); 	
	$output = str_replace("<style>","", $output);
	$output = str_replace("</style>","", $output);
	echo $output;	
}
?>