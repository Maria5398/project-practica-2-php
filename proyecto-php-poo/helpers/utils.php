<?php

class Utils{
	
	public static function deleteSession($name){ //eliminar sesion de un registro fallido
		if(isset($_SESSION[$name])){ // ya sea de registro de user o de producto
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
		}
		
		return $name;
	}
	
	public static function isAdmin(){//preguunta si hhizo sesion un admin
		if(!isset($_SESSION['admin'])){
			header("Location:".base_url); //si no es adminn rredirecona
		}else{
			return true;
		}
	}
	
	public static function isIdentity(){// ssesion user
		if(!isset($_SESSION['identity'])){
			header("Location:".base_url);//redirecciona
		}else{
			return true;
		}
	}
	
	public static function showCategorias(){//devolver un array de objetos (lista decategoria)
		require_once 'models/categoria.php';
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		return $categorias;
	}
	
	public static function statsCarrito(){
		$stats = array(
			
			'count' => 0,
			'total' => 0
		);
		
		if(isset($_SESSION['carrito'])){
			//si caarrito esta inicado
			$stats['count'] = count($_SESSION['carrito']);

			//recorro el carrito y ver todos loss productos
			foreach($_SESSION['carrito'] as $producto){
				//mmultiplica la cantidad del producto por el precio y los suma con los otros productos
				$stats['total'] += $producto['precio']*$producto['unidades'];
				//con += sumo el total de todos los productos
			}
		}
		
		return $stats;
	}
	
	public static function showStatus($status){//estado de envvio
		$value = 'Pendiente';
		
		if($status == 'confirm'){
			$value = 'Pendiente';
		}elseif($status == 'preparation'){
			$value = 'En preparación';
		}elseif($status == 'ready'){
			$value = 'Preparado para enviar';
		}elseif($status = 'sended'){
			$value = 'Enviado';
		}
		
		return $value;
	}
	
}
