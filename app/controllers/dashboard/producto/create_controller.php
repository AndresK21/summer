<?php
require_once("../../app/models/producto.class.php");
try{
    $producto = new Producto;
    if(isset($_POST['crear'])){ //Establece que el controlador funciona si el post tiene ese nombre
        $_POST = $producto->validateForm($_POST);
        if($producto->setNombre($_POST['nombre'])){
            if($producto->setCantidad($_POST['cantidad'])){
                if($producto->setPrecio($_POST['precio'])){
                    if(is_uploaded_file($_FILES['archivo']['tmp_name'])){
                        if($producto->setImagen($_FILES['archivo'])){
                            if($producto->setId_categoria($_POST['categoria'])){
                                if($producto->setId_presentacion($_POST['presentacion'])){
                                    if($producto->createProducto()){ //Crea el producto
                                        Page::showMessage(1, "Producto creado", "index.php");
                                    }else{
                                    throw new Exception("No se pudo crear el producto");        
                                    }                                           
                                }else{
                                    throw new Exception("Presentacion incorrecta");
                                }
                            }else{
                                throw new Exception("Seleccione una categoría");
                            }
                        }else{
                            throw new Exception($producto->getImageError());
                        }
                    }else{
                        throw new Exception("Seleccione una imagen");
                    }
                }else{
                    throw new Exception("Precio incorrecto");
                }
            }else{
                throw new Exception("Cantidad incorrecta");
            }
        }else{
            throw new Exception("Nombre incorrecta");
        }
    }
}catch (Exception $error){
    Page::showMessage(2, $error->getMessage(), null);
}
require_once("../../app/view/dashboard/producto/create_producto_view.php");
?>