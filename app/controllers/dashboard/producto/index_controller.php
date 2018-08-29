<?php
require_once("../../app/models/producto.class.php");
require_once("../../app/models/categoria.class.php");
require_once("../../app/models/presentaciones.class.php");
try{
	//Controlador de productos
	$por_pagina=10;
	if (isset($_GET["pagina"])) {
	$pagina = $_GET["pagina"];
	}
	else {
	$pagina=1;
	}
	// la pagina inicia en 0 y se multiplica $por_pagina
	$empieza = ($pagina-1) * $por_pagina;

$producto = new Producto;
	if(isset($_POST['buscar_producto'])){
		$_POST = $producto->validateForm($_POST);
		$data_productos = $producto->searchProducto($_POST['busqueda_producto']);
		if($data_productos){
			$rows = count($data_productos);
			Page::showMessage(4, "Se encontraron $rows resuldatos", null);
		}else{
			Page::showMessage(4, "No se encontraron resultados", null);
			$data_productos = $producto->getProductos2($empieza, $por_pagina);
		}
	}else{
		$data_productos = $producto->getProductos2($empieza, $por_pagina);
	}	

	//Controlador de categorias
	$categoria = new Categoria;
	if(isset($_POST['buscar_categoria'])){
		$_POST = $categoria->validateForm($_POST);
		$data_categorias = $categoria->searchCategoria($_POST['busqueda_categoria']);
		if($data_categorias){
			$rows = count($data_categorias);
			Page::showMessage(4, "Se encontraron $rows resuldatos", null);
		}else{
			Page::showMessage(4, "No se encontraron resultados", null);
			$data_categorias = $categoria->getCategorias();
		}
	}else{
		$data_categorias = $categoria->getCategorias();
	}

	//Controlador de presentaciones
	$presentaciones = new Presentaciones;
	if(isset($_POST['buscar_presentacion'])){
		$_POST = $presentaciones->validateForm($_POST);
		$data_presentaciones = $presentaciones->searchPresentacion($_POST['busqueda_presentacion']);
		if($data_presentaciones){
			$rows = count($data_presentaciones);
			Page::showMessage(4, "Se encontraron $rows resuldatos", null);
		}else{
			Page::showMessage(4, "No se encontraron resultados", null);
			$data_presentaciones = $presentaciones->getPresentaciones();
		}
	}else{
		$data_presentaciones = $presentaciones->getPresentaciones();
	}


	if($data_productos){
		require_once("../../app/view/dashboard/producto/index_view.php");
	}else{
		require_once("../../app/view/dashboard/producto/index_view.php");
	}
}catch(Exception $error){
	Page::showMessage(2, $error->getMessage(), "../cuenta/");
}
?>