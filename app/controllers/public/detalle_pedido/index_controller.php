<?php
require_once("../../app/models/detalle_pedido.class.php");
require_once("../../app/models/cliente.class.php");
try{
    $detalle = new Detalle;
    if($detalle->setId_cliente($_SESSION['id_cliente_p'])){
        if($detalle->readCliente()){
            if($detalle){
                $data = $detalle->getVentas();
                $data2 = $detalle->getTotal();
            }else{
                throw new Exception(Database::getException());
            }
        }else{
            throw new Exception("Cliente inexistente");
        }
    }else {
        throw new Exception("Cliente incorrecto");
    }
    if(isset($_SESSION['id_pedido_p'])){
        $producto = new Detalle;
        if($producto->setId_pedido($_SESSION['id_pedido_p'])){
            $_SESSION['id_ult_pedi'] = $_SESSION['id_pedido_p'];
            if($producto->readDetalle2()){
                if(isset($_POST['comprar'])){
                    $_POST = $producto->validateForm($_POST);
                    if($producto->setEstado("1")){
                        if($producto->setId_cliente($_SESSION['id_cliente_p'])){
                            if($producto->getTotal2()){
                                if($producto->updateDetalle2()){
                                    $producto->updateEstado();
                                    if($producto->createPedido()){
                                        if($producto->getMaxId()){
                                            $_SESSION['id_pedido_p'] = $producto->getId_pedido();
                                            Page::showMessage(1, "Compra realizada", "../../app/view/public/detalle/reporte.php");
                                        }
                                    }else{
                                        throw new Exception("No se pudo realizar la compra (3)"); 
                                    }
                                }else{
                                    throw new Exception("No se pudo realizar la compra (1)");        
                                }
                            }else{
                                throw new Exception("No se pudo realizar la compra (4)"); 
                            } 
                        }else{
                            throw new Exception("No se pudo realizar la compra (2)"); 
                        }
                    }else{
                        throw new Exception("Estado incorrecto");
                    }
                }
            }else{
                Page::showMessage(2, "Producto inexistente", "index.php");
            }
        }else{
            Page::showMessage(2, "Producto incorrecto", "index.php");
        }
    }else{
        Page::showMessage(3, "Seleccione producto", "index.php");
    }

if($data){
    require_once("../../app/view/public/detalle/carrito_view.php");
}else{
    Page::showMessage(3, "No hay compras disponibles", "../categorias/categorias.php");
}
}catch(Exception $error){
	Page::showMessage(2, $error->getMessage(), "../index/index.php");
}
?>