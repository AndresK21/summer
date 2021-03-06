<?php
class Valoraciones extends Validator{
	//Declaración de propiedades
	private $id_valoracion = null;
	private $estrellas = null;
	private $id_producto = null;
	private $id_cliente = null;

	//Métodos para sobrecarga de propiedades
	public function setId_valoracion($value){
		if($this->validateId($value)){
			$this->id_valoracion = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getId_valoracion(){
		return $this->id_valoracion;
	}

	public function setId_cliente($value){
		if($this->validateId($value)){
			$this->id_cliente = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getId_cliente(){
		return $this->id_cliente;
	}
	
	public function setEstrellas($value){ 
			$this->estrellas = $value;
	}
	public function getEstrellas(){
		return $this->estrellas;
	}

	public function setId_producto($value){
		if($this->validateId($value)){
			$this->id_producto = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getId_producto(){
		return $this->id_producto;
	}
	//Metodos para manejar el CRUD
	public function getValoraciones(){
		$sql = "SELECT id_valoracion, estrellas, id_producto FROM valoraciones ORDER BY estrellas";
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	public function getValoracionesProducto(){
		$sql = "SELECT valoraciones.id_producto, valoraciones.id_valoracion, cliente.nombre_usuario FROM valoraciones INNER JOIN cliente ON cliente.id_cliente = valoraciones.id_cliente WHERE id_producto = ?";
		$params = array($this->id_producto);
		return Database::getRows($sql, $params);
	}
	public function getValoracionesProducto2($empieza, $por_pagina){
		$sql = "SELECT valoraciones.id_producto, valoraciones.id_valoracion, cliente.nombre_usuario FROM valoraciones INNER JOIN cliente ON cliente.id_cliente = valoraciones.id_cliente WHERE id_producto = ? AND LIMIT $empieza, $por_pagina";
		$params = array($this->id_producto);
		return Database::getRows($sql, $params);
	}
	public function getValoracionesP(){
		$sql = "SELECT ROUND(AVG(estrellas))AS estrella,valoraciones.id_producto, valoraciones.id_valoracion, cliente.nombre_usuario FROM valoraciones INNER JOIN cliente ON cliente.id_cliente = valoraciones.id_cliente WHERE id_producto = ? ";
		$params = array($this->id_producto);
		return Database::getRows($sql, $params);
	}
	public function getEstrellasPromedio(){
		$sql = "SELECT ROUND(AVG(estrellas)) AS Estrellas FROM valoraciones WHERE id_producto = ? ";
		$params = array($this->id_producto);
		return Database::getRows($sql, $params);
	}

	public function getValoraciones2(){
		$sql = "SELECT id_valoracion, id_producto FROM valoraciones WHERE id_producto = ?";
		$params = array($this->id_producto);
		return Database::getRows($sql, $params);
	}
	public function readProducto(){
		$sql = "SELECT id_producto, nombre, cantidad, precio FROM producto WHERE id_producto = ?";
		$params = array($this->id_producto);
		$producto = Database::getRow($sql, $params);
		if($producto){
			$this->id_producto = $producto['id_producto'];
			return true;
		}else{
			return null;
		}
	}
	public function searchValoracion($value){
		$sql = "SELECT id_valoracion, estrellas, nombre FROM valoraciones INNER JOIN productos USING(id_productos) WHERE estrellas LIKE ? ORDER BY estrellas";
		$params = array("%$value%");
		return Database::getRows($sql, $params);
	}
	public function createValoracion(){
		$sql = "INSERT INTO valoraciones(estrellas, id_producto, id_cliente) VALUES (?,?,?)";
		$params = array($this->estrellas, $this->id_producto, $this->id_cliente);
		return Database::executeRow($sql, $params);
	}
	public function readValoracion(){
		$sql = "SELECT estrellas, id_producto FROM valoraciones WHERE id_valoracion = ?";
		$params = array($this->id_valoracion);
		$valoracion = Database::getRow($sql, $params);
		if($valoracion){
			$this->estrellas = $valoracion['estrellas'];
			$this->id_producto = $valoracion['id_producto'];
			return true;
		}else{
			return null;
		}
	}
	public function updateValoracion(){
		$sql = "UPDATE valoraciones SET estrellas = ?, id_producto = ? WHERE id_valoracion = ?";
		$params = array($this->estrellas, $this->id_producto, $this->id_valoracion);
		return Database::executeRow($sql, $params);
	}
	public function deleteValoracion(){
		$sql = "DELETE FROM valoraciones WHERE id_valoracion = ?";
		$params = array($this->id_valoracion);
		return Database::executeRow($sql, $params);
	}
}
?>