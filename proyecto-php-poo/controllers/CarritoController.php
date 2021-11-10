<?php
require_once 'models/producto.php';

class carritoController{
	
	public function index(){//si carrito esta iniciado
		if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
			$carrito = $_SESSION['carrito'];
		}else{
			$carrito = array();
		}
		require_once 'views/carrito/index.php';
	}
	
	public function add(){//aagregar el producto selecioado a carrito
		if(isset($_GET['id'])){
			$producto_id = $_GET['id'];
		}else{
			header('Location:'.base_url);
		}
		
		if(isset($_SESSION['carrito'])){ //si carrito existe
			$counter = 0;
			foreach($_SESSION['carrito'] as $indice => $elemento){
				if($elemento['id_producto'] == $producto_id){
					$_SESSION['carrito'][$indice]['unidades']++;
					$counter++;//y se seeiona as de una ver el mismo producto , lo agrega y aumenta el contador en uno
				}
			}	
		}
		
		if(!isset($counter) || $counter == 0){
			// Conseguir producto
			$producto = new Producto();
			$producto->setId($producto_id);
			$producto = $producto->getOne();

			// Añadir al carrito
			if(is_object($producto)){
				$_SESSION['carrito'][] = array(
					"id_producto" => $producto->id,
					"precio" => $producto->precio,
					"unidades" => 1,
					"producto" => $producto
				);
			}
		}
		
		header("Location:".base_url."carrito/index");
	}
	
	public function delete(){//remover u producto
		if(isset($_GET['index'])){
			$index = $_GET['index'];
			unset($_SESSION['carrito'][$index]);
		}
		header("Location:".base_url."carrito/index");
	}
	
	public function up(){//aunmentar unidad de procuto
		if(isset($_GET['index'])){
			$index = $_GET['index'];
			$_SESSION['carrito'][$index]['unidades']++;
		}
		header("Location:".base_url."carrito/index");
	}
	
	public function down(){//dimunuir unnidaad de producto
		if(isset($_GET['index'])){
			$index = $_GET['index'];
			$_SESSION['carrito'][$index]['unidades']--;
			
			if($_SESSION['carrito'][$index]['unidades'] == 0){
				unset($_SESSION['carrito'][$index]);
			}
		}
		header("Location:".base_url."carrito/index");
	}
	
	public function delete_all(){//vaciar todo el carrito
		unset($_SESSION['carrito']);
		header("Location:".base_url."carrito/index");
	}
	
}