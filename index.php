<?php
	require_once "Config/Config.php";	
	$route = !empty($_GET['url']) ? $_GET['url'] : "Home/index";
	$array = explode("/", $route);
	$controller = $array[0];
	$method = "index";
	$parameter = "";
	if (!empty($array[1])) {
		if(!empty($array[1] != "")) {
			$method = $array[1];
		}
	}
	if(!empty($array[2])){
		if (!empty($array[2]) != "") {
			for($i=2; $i < count($array); $i++) {
				$parameter .= $array[$i]. ",";
			}
			$parameter = trim($parameter, ",");
		}
	}
	require_once "Config/App/autoLoad.php";
	$dirControllers = "Controllers/".$controller.".php";
	if (file_exists($dirControllers)) {
		require_once $dirControllers;
		$controller = new $controller();
		if (method_exists($controller, $method)) {
			$controller -> $method($parameter);
		}else{
			echo "No existe el metodo";
		}
	} else {
		echo "No existe el controlador";
	}
?> 