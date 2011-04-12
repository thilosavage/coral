<?php
/**********************************************

	This script will create framework elements
	
	Say you want a module for generating quotes
	
	You could go into admin, go to the generator
	
	Type in 'quote' as the Controller name
	
	Enter in some actions
		Maybe.. index, test, load_all
		
	Enter in some AJAX actions
		Maybe.. quoteLoadAll, quoteFindOne
		
	Specify it to create a JS/CSS file for the new Controller
	
	Create a Model for the Controller
		Maybe..
			Table name: Quotes
			ID field: quote_id
			Name field: quote
			Order by: date
			
	This won't create the database table for you
	
	Note that this script doesn't follow the
	design pattern of this framework
	It is more a utility script rather than
	framework helper
	
**********************************************/

if (isset($_POST['create'])){
	$messages = array();
	
	if ($_POST['module']) {
		
		//$_POST['module'] = str::justLetters($_POST['module']);
		$_POST['module'] = strtolower(($_POST['module']));
		
		echo "<h5>Creating framework elements for ".$_POST['module']."</h5>";
		
		if ($_POST['js']){
			$js_file = site::root."_js/".$_POST['module'].".js.php";
			if (!file_exists($js_file)){
				$file = fopen($js_file, 'w') or die("can't open file");
				fwrite($file, "<script>\n\n</script>");
				fclose($file);
				$messages[] = $js_file." created";
			}
			else {
				$messages[] = "Didn't create a javascript file: ".$js_file." because it already exists.";
			}
		}
		
		if ($_POST['css']) {
			$css_file = site::root."_css/".$_POST['module'].".css.php";
			if (!file_exists($css_file)){
				$file = fopen($css_file, 'w') or die("can't open file");
				fwrite($file, "<style>\n\n</style>");
				fclose($file);
				$messages[] = $css_file." created";
				
			}
			else {
				$messages[] = "Didn't create a css file: ".$css_file." because it already exists.";
			}
		}

		$actions = explode(',',$_POST['actions']);
		foreach ($actions as $k => $action){
			$action = trim($action);
			$action = str_replace(' ','_',$action);
			$actions[$k] = $action;
		}
		
		$ajaxs = explode(',',$_POST['ajax']);
		foreach ($ajaxs as $k => $ajax){
			$ajax = trim($ajax);
			$ajax = str_replace(' ','_',$ajax);
			$ajaxs[$k] = $ajax;
		}	
		
		$controllerName = strtolower($_POST['module'])."Controller";
		
		$controllerFileData = "";
		$controllerFileData .= "<?php \n";
		$controllerFileData .= "class ".$controllerName." extends Controller {\n\n";
		
		if ($actions){
			foreach ($actions as $action){
				$controllerFileData .= "	function ".$action."(){\n\n";
				$controllerFileData .= "	}\n";	
			}
		}
		if ($ajaxs){
			foreach ($ajaxs as $ajax){
				$controllerFileData .= "	function ajax_".$ajax."(){\n\n";
				$controllerFileData .= "	}\n";	
			}
		}	
		
		$controllerFileData .= "}\n";

		$controller_file = site::root."Controllers/".$controllerName.".php";
		if (!file_exists($controller_file)){
			$file = fopen($controller_file, 'w') or die("can't open file");
			fwrite($file, $controllerFileData);
			fclose($file);
			$messages[] = $controller_file." created";
		}
		else {
			$messages[] = "Didn't create a controller file: ".$controller_file." because it already exists.";
		}		
		
		
		$view_folder = site::root."Views/".$_POST['module'];
		if (!is_dir($view_folder)){
		
			mkdir($view_folder, 0644);
			mkdir($view_folder.'/ajax', 0644);
			
			if ($actions){
				foreach ($actions as $action){
					$action_file = site::root."Views/".$_POST['module']."/".$action.".php";
					$file = fopen($action_file, 'w') or die("can't open file");
					fwrite($file, '');
					fclose($file);
					$messages[] = $action_file." created";
				}
			}
			
			if ($ajaxs){
				foreach ($ajaxs as $ajax){
					$ajax_file = site::root."Views/".$_POST['module']."/ajax/".$ajax.".php";
					$file = fopen($ajax_file, 'w') or die("can't open file");
					fwrite($file, '');
					fclose($file);
					$messages[] = $ajax_file." created";
				}
			}		
			
			
		}
		else {
			$messages[] = "Didn't create any views for: ".$view_folder." because it already exists.";
		}
	}

	if ($_POST['table'] !== ''){
	
		$modelName = ucwords($_POST['table']);
		
		$_POST['namefield'] = $_POST['namefield']?$_POST['namefield']:$_POST['idfield'];
		$_POST['orderby'] = $_POST['orderby']?$_POST['orderby']:$_POST['idfield'];
		
		$modelFileData = "";
		$modelFileData .= "<?php \n";
		$modelFileData .= "class ".ucwords($modelName)." extends Model {\n";
		$modelFileData .= "	protected \$table = '".$_POST['table']."';\n";
		$modelFileData .= "	protected \$id_field = '".$_POST['idfield']."';\n";	
		$modelFileData .= "	protected \$name_field = '".$_POST['namefield']."';\n";			
		$modelFileData .= "	protected \$order_by = '".$_POST['orderby']."';\n\n\n\n\n\n";
		$modelFileData .= "}";
		
		$model_file = site::root."Models/".$modelName.".php";
		if (!file_exists($model_file)){
			$file = fopen($model_file, 'w') or die("can't open file");
			fwrite($file, $modelFileData);
			fclose($file);
			$messages[] = $model_file." created";
		}
		else {
			$messages[] = "Didn't create a model file: ".$model_file." because it already exists.";
		}
	}

	if ($messages){
		foreach ($messages as $message){
			echo $message."<br>";
		}
		
	echo "<hr>";
	
	}
}

// this form is not in _forms
// I feel it would clutter things
// this form is more an application tool than a site "form"
echo "<h2>Generate Controller</h2>";
echo "<div style='font-size: 12px;'>";
	echo form::start(site::url.'admin/generator');
	echo "Controller name: ".form::input('module')."<br><br>";
	echo "Actions (comma separated):<br>".form::text('actions','','','',1,80)."<br>";
	echo "Ajax Actions (leave out the prefix):<br>".form::text('ajax','','','',1,80)."<br>";
	echo form::checkbox('js','js',true)." create JS file<br>";
	echo form::checkbox('css','css',true)." create CSS file<br>";
	echo form::submit('create','CREATE')."<br>";
echo "</div>";
echo "<hr>";
echo "<h2>Generate Model</h2>";
echo "<div style='font-size: 12px;'>";
	echo "Table name: ".form::input('table')."<br>";
	echo "ID field: ".form::input('idfield')."<br>";
	echo "Name field: ".form::input('namefield')."<br>";
	echo "Order by: ".form::input('orderby')."<br>";
	echo form::submit('create','CREATE')."<br>";
	echo "</form>";
echo "</div>";
?>