<?php
class Presentaciones extends Validator{
	//Declaración de propiedades
	private $id_presentacion = null;
	private $presentacion = null;

	//Métodos para sobrecarga de propiedades
	public function setId_presentacion($value){
		if($this->validateId($value)){
			$this->id_presentacion = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getId_presentacion(){
		return $this->id_presentacion;
	}
	
	public function setPresentacion($value){
		if($this->validateAlphanumeric($value, 1, 80)){
			$this->presentacion = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getPresentacion(){
		return $this->presentacion;
	}

	//Metodos para el manejo del CRUD
	public function getPresentaciones(){
		$sql = "SELECT id_presentacion, presentacion FROM presentaciones ORDER BY presentacion";
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	public function searchPresentacion($value){
		$sql = "SELECT id_presentacion, presentacion FROM presentaciones WHERE presentacion LIKE ? ORDER BY presentacion";
		$params = array("%$value%");
		return Database::getRows($sql, $params);
	}
	public function createPresentacion(){
		$sql = "INSERT INTO presentaciones(presentacion) VALUES (?)";
		$params = array($this->presentacion);
		return Database::executeRow($sql, $params);
	}
	public function readPresentacion(){
		$sql = "SELECT presentacion FROM presentaciones WHERE id_presentacion = ?";
		$params = array($this->id_presentacion);
		$presentacion = Database::getRow($sql, $params);
		if($presentacion){
			$this->presentacion = $presentacion['presentacion'];
			return true;
		}else{
			return null;
		}
	}
	public function updatePresentacion(){
		$sql = "UPDATE presentaciones SET presentacion = ? WHERE id_presentacion = ?";
		$params = array($this->presentacion, $this->id_presentacion);
		return Database::executeRow($sql, $params);
	}
	public function deletePresentacion(){
		$sql = "DELETE FROM presentaciones WHERE id_presentacion = ?";
		$params = array($this->id_presentacion);
		return Database::executeRow($sql, $params);
	}
}
?>