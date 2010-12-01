<?php
header("content-type: application/x-javascript");

// change your js folder if you want:
$js_folder = 'javascript';

$self = $js_folder.'/'.end(explode('/',$_SERVER['PHP_SELF']));
$docRoot = str_replace($self,'',$_SERVER['SCRIPT_FILENAME']);
$docRoot = str_replace('web/','',$docRoot);


echo "//"; // comment out errors returned by the config
require_once($docRoot.'config.php');

$handler = opendir(site::root.'web/'.$js_folder.'/');
while ($file = readdir($handler)) {
	if ($file != '.' && $file != '..' && substr($file,0,1)=="_")
		$files[] = $file;
}
closedir($handler);
?>

var siteUrl = '<?php echo site::url;?>';
var loader = '<img src="<?php echo site::url;?>images/loader.gif">';

<?php

foreach ($files as $fileName){
	$path = site::root.'web/'.$js_folder.'/'.$fileName;
	
	ob_start();
	include($path);
	$output = ob_get_clean(); 	
	$output = str_replace("<script>","", $output);
	$output = str_replace("</script>","", $output);
	echo $output;	
}
?>