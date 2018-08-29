<?php
require_once("../../app/models/detalle_pedido.class.php");//Llama el modelo de prodcutos
require_once("../../app/models/producto.class.php");
try{
	if(isset($_GET['id'])){//Llama el id de producto
		$producto = new Detalle;
		$product = new Producto;
		if($producto->setId_detalle($_GET['id'])){ //Estableve el id en la variable para usarla despues
			if($producto->readDetalle()){
				$existencia = $producto->getCantidad();
				if(isset($_POST['actualizar'])){
					$_POST = $producto->validateForm($_POST);
                    if($producto->setCantidad($_POST['cantidad'])){
						$id = $producto->getId();
						if($existencia < $_POST['cantidad']){
							$diferencia = $_POST['cantidad'] - $existencia;
							$product->updateCantidad1($diferencia, $id);
							if($producto->updateDetalle3()){ //Edita la categoria
								Page::showMessage(1, "Cantidad modificada", "index.php");
							}else{
								throw new Exception(Database::getException());
							}
							//sacar diferrencia y restarlo al inventario
						}else if($existencia > $_POST['cantidad']){
							$diferencia = $existencia - $_POST['cantidad'];
							$product->updateCantidad2($diferencia, $id);
							if($producto->updateDetalle3()){ //Edita la categoria
								Page::showMessage(1, "Cantidad modificada", "index.php");
							}else{
								throw new Exception(Database::getException());
							}
						}else if($existencia = $_POST['cantidad']){
							if($producto->updateDetalle3()){ //Edita la categoria
								Page::showMessage(1, "Cantidad modificada", "index.php");
							}else{
								throw new Exception(Database::getException());
							}
						}else{
							throw new Exception("Ha habido un problema");
						}
												                        
                    }else{
                        throw new Exception("Cantidad incorrecta");
                    }   
				}
			}else{
				throw new Exception("Producto inexistente");
			}	
		}else{
			throw new Exception("Producto incorrecto");
		}
	}else{
		Page::showMessage(3, "Seleccione producto", "index.php");
	}
}catch (Exception $error){
	Page::showMessage(2, $error->getMessage(), "index.php");
}
require_once("../../app/view/public/detalle/update_view.php");
?>