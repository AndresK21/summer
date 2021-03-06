<?php
require_once("../../app/models/categoria.class.php");
try{
    $categoria = new Categoria;
    if(isset($_POST['crear_categoria'])){ //El controlador funciona si el post del formulario se llama aasi
        $_POST = $categoria->validateForm($_POST);
        if($categoria->setCategoria($_POST['categoria'])){
            if($categoria->createCategoria()){ //Crea una categoria
                Page::showMessage(1, "Categoría creada", "index.php");
            }else{
                throw new Exception(Database::getException());
            }
        }else{
            throw new Exception("categoria incorrecto");
        }
    }
}catch(Exception $error){
    Page::showMessage(2, $error->getMessage(), null);
}
require_once("../../app/view/dashboard/categoria/create_view.php");
?>