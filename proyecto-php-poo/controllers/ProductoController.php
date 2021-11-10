<?php
require_once 'models/producto.php';

class productoController{
	
	public function index(){
		$producto = new Producto();
		$productos = $producto->getRandom(6);//limitede productos en index es de 6
	
		// renderizar vista
		require_once 'views/producto/destacados.php';
	}
	
	public function ver(){ // verific								 
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		
			$producto = new Producto();
			$producto->setId($id);
			
			$product = $producto->getOne();
			
		}
		require_once 'views/producto/ver.php';
	}
	
	public function gestion(){
		Utils::isAdmin();//ssi sos admmin muestrame todos los productos
		
		$producto = new Producto();
		$productos = $producto->getAll();
		
		require_once 'views/producto/gestion.php'; //mostrar los productos en esta vista
	}
	
	public function crear(){ //formulaario para crear producto
		Utils::isAdmin();
		require_once 'views/producto/crear.php';//renderiza esta vista
	}
	
	public function save(){//guardar producto creado
		Utils::isAdmin();
		if(isset($_POST)){ //si los datos fueron enviados por post
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
			$precio = isset($_POST['precio']) ? $_POST['precio'] : false;
			$stock = isset($_POST['stock']) ? $_POST['stock'] : false;
			$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
			// $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
			
			if($nombre && $descripcion && $precio && $stock && $categoria){ //si estan estos datos
				$producto = new Producto();
				$producto->setNombre($nombre);//recordar siempre ingresar todos los datos  que requiere la base de datos
				$producto->setDescripcion($descripcion);
				$producto->setPrecio($precio);
				$producto->setStock($stock);
				$producto->setCategoria_id($categoria);
				
				// Guardar la imagen
				if(isset($_FILES['imagen'])){ //si hay una img
					$file = $_FILES['imagen'];
					$filename = $file['name'];//nombre del archivo
					$mimetype = $file['type'];//tipo de archivo
						// solo se permite img con estos formatos
					if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

						if(!is_dir('uploads/images')){//si no existe el directorio , crear uno con los permissos
							mkdir('uploads/images', 0777, true);
						}

						$producto->setImagen($filename);
						//nombre temporal , subido en esa carpeta
						move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
					}
				}
				
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$producto->setId($id);
					
					$save = $producto->edit();
				}else{
					$save = $producto->save();//guardar product
				}
				
				if($save){//si sse guardo de forma correcta 
					$_SESSION['producto'] = "complete";//excito
				}else{
					$_SESSION['producto'] = "failed";//fallo
				}
			}else{
				$_SESSION['producto'] = "failed";
			}
		}else{
			$_SESSION['producto'] = "failed";
		}
		header('Location:'.base_url.'producto/gestion');//si se guarddo de forma correctanos redirecciona
	}
	//editar un product ya existente
	public function editar(){
		Utils::isAdmin();
		if(isset($_GET['id'])){//si llega el id indicado
			$id = $_GET['id'];
			$edit = true;
			
			$producto = new Producto();
			$producto->setId($id);
			
			$pro = $producto->getOne();//consulta de base de dato para editar el producto selecionado
			
			require_once 'views/producto/crear.php';
			
		}else{
			header('Location:'.base_url.'producto/gestion');
		}
	}
	//eliminar producyto
	public function eliminar(){
		Utils::isAdmin(); //este metodo solo lo puede realizar un administrador
		
		if(isset($_GET['id'])){//si existe el id indicado
			$id = $_GET['id'];
			$producto = new Producto();
			$producto->setId($id);
			
			$delete = $producto->delete();
			if($delete){
				$_SESSION['delete'] = 'complete';
			}else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		
		header('Location:'.base_url.'producto/gestion');//si see elimino de  forrma exiitossa nos envia a gestion
	}
	
}