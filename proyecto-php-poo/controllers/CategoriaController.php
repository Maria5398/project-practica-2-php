<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController{
	
	public function index(){
		Utils::isAdmin();
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		
		require_once 'views/categoria/index.php'; //vissta index
	}
	
	public function ver(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Conseguir categoria 
			$categoria = new Categoria();
			$categoria->setId($id);
			$categoria = $categoria->getOne();//mostrar categoria seleccionada
			
			// Conseguir productos;
			$producto = new Producto();
			$producto->setCategoria_id($id);
			$productos = $producto->getAllCategory();//muestra todos los producto de esa categgoria
		}
		
		require_once 'views/categoria/ver.php';//vsta
	}
	
	public function crear(){//si es admmiin mostrar vista de  crear categoria
		Utils::isAdmin();
		require_once 'views/categoria/crear.php';
	}
	
	public function save(){//si es admmin guardar la nueva categoria
		Utils::isAdmin();
	    if(isset($_POST) && isset($_POST['nombre'])){// si los datos me llagan por post
			// Guardar la categoria en bd
			$categoria = new Categoria();//crear nueva categoria
			$categoria->setNombre($_POST['nombre']);
			$save = $categoria->save();//guardar en la base de datos
		}
		header("Location:".base_url."categoria/index");// y me redirecciona mostrarndo la lista de cattegorias
	}
	
}