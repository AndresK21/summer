<?php
require_once("../../app/models/cliente.class.php");
try{
    $cliente = new Cliente;
    if($cliente->setId_cliente($_SESSION['id_cliente_p'])){
        if(isset($_GET['id']) && $_SERVER['HTTP_REFERER']){
            if($cliente->readCliente()){
                if($cliente){
                    $data = $cliente->getVentas2($_GET['id']);
                }else{
                    throw new Exception(Database::getException());
                }
            }else{
                throw new Exception("Cliente inexistente");
            }
        }else{
            throw new Exception("pedido inexistente");
        }
    }else {
        throw new Exception("Cliente incorrecto");
    }
if($data){
    require_once("../../app/view/public/cuenta/detalle_view.php");
}else{
    Page::showMessage(3, "No hay compras disponibles", "../index/index.php");
}
}catch(Exception $error){
	Page::showMessage(2, $error->getMessage(), "../index/index.php");
}
?>