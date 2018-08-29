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
				if(isset($_POST['eliminar'])){
					$id = $producto->getId();
					if($producto->deleteDetalle()){ //Elimina el producto
						$product->updateCantidad2($existencia, $id);
						Page::showMessage(1, "elemento eliminado", "index.php");
					}else{
						throw new Exception(Database::getException());
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
require_once("../../app/view/public/detalle/delete_view.php");
?>