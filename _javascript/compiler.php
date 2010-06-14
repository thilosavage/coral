<?php
$jsFolder = '_javascript/';
$jsFile = 'compiler.php';

$jsPath = $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'];
$docRoot = str_replace($jsFolder.$jsFile,'',$jsPath);
echo "//"; // comment out errors returned by the config
require_once($docRoot.'config.php');

$handler = opendir(site::root.$jsFolder);
while ($file = readdir($handler)) {
	if ($file != '.' && $file != '..' && substr($file,0,1)=="_")
		$files[] = $file;
}
closedir($handler);
?>

var siteUrl = '<?php echo site::url;?>';
var loader = '<img src="<?php echo site::url;?>_images/loader.gif">';

<?php

foreach ($files as $fileName){
	$path = site::root.$jsFolder.$fileName;
	
	ob_start();
	include($path);
	$output = ob_get_clean(); 	
	$output = str_replace("<script>","", $output);
	$output = str_replace("</script>","", $output);
	echo $output;	
}
?>