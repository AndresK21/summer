<?php
class Categoria extends Validator{
	//Declaración de propiedades
	private $id_categoria = null;
	private $categoria = null;

	//Métodos para sobrecarga de propiedades
	public function setId_categoria($value){
		if($this->validateId($value)){
			$this->id_categoria = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getId_categoria(){
		return $this->id_categoria;
	}
	
	public function setCategoria($value){
		if($this->validateAlphanumeric($value, 1, 80)){
			$this->categoria = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getCategoria(){
		return $this->categoria;
	}

	//Metodos para el manejo del CRUD
	public function getCategorias(){
		$sql = "SELECT id_categoria, categoria FROM categoria ORDER BY categoria";
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	public function searchCategoria($value){
		$sql = "SELECT id_categoria, categoria FROM categoria WHERE categoria LIKE ? ORDER BY categoria";
		$params = array("%$value%");
		return Database::getRows($sql, $params);
	}
	public function createCategoria(){
		$sql = "INSERT INTO categoria(categoria) VALUES (?)";
		$params = array($this->categoria);
		return Database::executeRow($sql, $params);
	}
	public function readCategoria(){
		$sql = "SELECT categoria FROM categoria WHERE id_categoria = ?";
		$params = array($this->id_categoria);
		$categoria = Database::getRow($sql, $params);
		if($categoria){
			$this->categoria = $categoria['categoria'];
			return true;
		}else{
			return null;
		}
	}
	public function updateCategoria(){
		$sql = "UPDATE categoria SET categoria= ? WHERE id_categoria = ?";
		$params = array($this->categoria, $this->id_categoria);
		return Database::executeRow($sql, $params);
	}
	public function deleteCategoria(){
		$sql = "DELETE FROM categoria WHERE id_categoria = ?";
		$params = array($this->id_categoria);
		return Database::executeRow($sql, $params);
	}
}
?>