<?php
session_start();//iniciar sesion
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function show_error(){//errores
	$error = new errorController();
	$error->index();
}

if(isset($_GET['controller'])){ //comprobar si me llaga el controlador por la url
	$nombre_controlador = $_GET['controller'].'Controller';//en caso de que llegue me genera la variable

}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){ //si no existe controler ni action
	$nombre_controlador = controller_default; //le da el valor de error
	
}else{
	show_error();
	exit();//en caso de que no se encuentre el archhivo se corta la ejecucion
}

if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador(); //si existe la class controlador se crea el objeto
	
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
		$action = $_GET['action'];// si existe la accion aciona el metodo
		$controlador->$action();
	}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
		$action_default = action_default;
		$controlador->$action_default();
	}else{
		show_error();
	}
}else{
	show_error();// si no existe muestrar el error
}

require_once 'views/layout/footer.php';


