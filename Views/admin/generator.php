<?php

if (isset($_POST['create'])){
	$errors = array();
	
	$_POST['module'] = clean::letters($_POST['module']);
	$_POST['module'] = clean::nospaces($_POST['module']);
	$_POST['module'] = strtolower(($_POST['module']));
	
	echo "<h3>Creating framework elements for ".$_POST['module']."</h3>";
	

	$js_file = site::url."_javascript/_".$_POST['module'].".php";
	if (!file_exists($js_file)){
		$file = fopen($js_file, 'w') or die("can't open file");
		fwrite($file, "<script>\n\n</script>");
		fclose($file);	
	}
	else {
		$errors[] = "Didn't create a javascript file: ".$js_file." because it already exists.";
	}

	$css_file = site::url."_styles/_".$_POST['module'].".php";
	if (!file_exists($css_file)){
		$file = fopen($css_file, 'w') or die("can't open file");
		fwrite($file, "<style>\n\n</style>");
		fclose($file);	
	}
	else {
		$errors[] = "Didn't create a css file: ".$css_file." because it already exists.";
	}	

	$controllerName = strtolower($_POST['module'])."Controller";
	
	$controllerFileData = "";
	$controllerFileData .= "<?php \n";
	$controllerFileData .= "class ".$controllerName." extends Controller {\n\n";
	$controllerFileData .= "	function (){\n\n";
	$controllerFileData .= "		//";
	$controllerFileData .= "	}";
	$controllerFileData .= "}";

	$controller_file = site::url."Controllers/".$controllerName.".php";
	if (!file_exists($controller_file)){
		$file = fopen($controller_file, 'w') or die("can't open file");
		fwrite($file, $controllerFileData);
		fclose($file);	
	}
	else {
		$errors[] = "Didn't create a controller file: ".$controller_file." because it already exists.";
	}		
	
	
	$view_folder = site::url."Views/".$_POST['module'];
	if (!is_dir($view_folder)){
		mkdir($view_folder, 0644);
	}
	else {
		$errors[] = "Didn't create a view for: ".$view_folder." because it already exists.";
	}		

	if ($_POST['table'] !== ''){
	
		$modelName = ucwords($_POST['module']);

		$modelFileData = "";
		$modelFileData .= "<?php \n";
		$modelFileData .= "class ".ucwords($modelName)." extends Model {\n";
		$modelFileData .= "	protected \$table = '".$_POST['table']."';\n";
		$modelFileData .= "	protected \$id_field = '".$_POST['idfield']."';\n";	
		$modelFileData .= "	protected \$name_field = '".$_POST['namefield']."';\n";			
		$modelFileData .= "	protected \$order_by = '".$_POST['orderby']."';\n\n\n\n\n\n";
		$modelFileData .= "}";
		
		$model_file = site::url."Models/".$modelName.".php";
		if (!file_exists($model_file)){
			$file = fopen($model_file, 'w') or die("can't open file");
			fwrite($file, $modelFileData);
			fclose($file);	
		}
		else {
			$errors[] = "Didn't create a model file: ".$model_file." because it already exists.";
		}
	}

	if ($errors){
		foreach ($errors as $error){
			echo $error."<br>";
		}
	}
}

echo form::start(site::url.'admin/generator');
echo "Module name: ".form::input('module','','','','TEXT')."<br><br>";
echo "<div><em>Optional (If this controller has a model with it)</em></div>";

echo "Table name: ".form::input('table','','','','TEXT')."<br>";
echo "ID field: ".form::input('idfield','','','','TEXT')."<br>";
echo "Name field: ".form::input('namefield','','','','TEXT')."<br>";
echo "Order by: ".form::input('orderby','','','','TEXT')."<br>";

echo form::input('create','CREATE','','','SUBMIT');
echo "</form>";
?>