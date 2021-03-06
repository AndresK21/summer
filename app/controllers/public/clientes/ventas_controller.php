<?php
require_once("../../app/models/cliente.class.php");
require_once("../../app/models/detalle_pedido.class.php");
try{
    $cliente = new Cliente;
    $producto = new Detalle;
    if($cliente->setId_cliente($_SESSION['id_cliente_p'])){
        if($cliente->readCliente()){
            if($cliente){
                $data = $cliente->getVentas();
            }else{
                throw new Exception(Database::getException());
            }
        }else{
            throw new Exception("Cliente inexistente");
        }
    }else {
        throw new Exception("Cliente incorrecto");
    }
if($data){
    require_once("../../app/view/public/cuenta/ventas_view.php");
}else{
    Page::showMessage(3, "No hay compras disponibles", "../index/index.php");
}
}catch(Exception $error){
	Page::showMessage(2, $error->getMessage(), "../index/index.php");
}
?>