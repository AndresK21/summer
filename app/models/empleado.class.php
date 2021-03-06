<?php
class Empleado extends Validator{
	//Declaración de propiedades
	private $id_empleado = null;
	private $nombre_completo = null;
	private $correo_electronico = null;
	private $nombre_usuario = null;
	private $contrasena = null;
	private $imagen = null;
	private $fecha = null;
	private $fecha2 = null;
	private $estado = null;
	private $ip = null;
	private $nombre_correo = null;
	private $email = null;

	//Métodos para sobrecarga de propiedades
	public function setId_empleado($value){
		if($this->validateId($value)){
			$this->id_empleado = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getId_empleado(){
		return $this->id_empleado;
	}
	public function setEstado($value){
		if($this->validateId($value)){
			$this->estado = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getEstado(){
		return $this->estado;
	}
	
	public function setNombre($value){
		if($this->validateAlphabetic($value, 1, 200)){
			$this->nombre_completo = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getNombre(){
		return $this->nombre_completo;
	}

	public function setCorreo($value){
		if($this->validateEmail($value)){
			$this->correo_electronico = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getCorreo(){
		return $this->correo_electronico;
	}

	public function setUsuario($value){
		if($this->validateAlphanumeric($value, 1, 20)){
			$this->nombre_usuario = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getUsuario(){
		return $this->nombre_usuario;
	}

	public function setContrasena($value){
		if($this->validatePassword($value)){
			$this->contrasena = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getContrasena(){
		return $this->contrasena;
	}
	public function setContrasena2($value){
		if($this->validatePassword2($value)){
			$this->contrasena = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getContrasena2(){
		return $this->contrasena;
	}

	public function setImagen($file){
		if($this->validateImage($file, $this->imagen, "../../web/img/empleados/", 500, 500)){
			$this->imagen = $this->getImageName();
			return true;
		}else{
			return false;
		}
	}
	public function getImagen(){
		return $this->imagen;
	}
	public function unsetImagen(){
		if(unlink("../../../img/empleados/".$this->imagen)){
			$this->imagen = null;
			return true;
		}else{
			return false;
		}
	}

	public function setFecha($value){
		if($this->validateAlphanumeric($value, 1, 30)){
			$this->fecha = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getFecha(){
		return $this->fecha;
	}
	public function setFecha2($value){
		if($this->validateAlphanumeric($value, 1, 30)){
			$this->fecha2 = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getFecha2(){
		return $this->fecha2;
	}
	public function setIp($value){
		if($this->validateAlphanumeric($value, 1, 20)){
			$this->ip = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getIp(){
		return $this->ip;
	}


	public function setNombreCorreo($value){
		if($this->validateAlphabetic($value, 1, 150)){
			$this->nombre_correo = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getNombreCorreo(){
		return $this->nombre_correo;
	}
	public function setMail($value){
		if($this->validateEmail($value)){
			$this->email = $value;
			return true;
		}else{
			return false;
		}
	}
	public function getMail(){
		return $this->email;
	}

	//Métodos para manejar la sesión del usuario
	public function checkUsuarios(){
		$sql = "SELECT id_empleado FROM empleado WHERE nombre_usuario = ?";
		$params = array($this->nombre_usuario);
		$data = Database::getRow($sql, $params);
		if($data){
			$this->id_empleado = $data['id_empleado'];
			return true;
		}else{
			return false;
		}
	}
	public function checkUsuarios2(){
		$sql = "SELECT id_empleado, nombre_usuario, correo_electronico FROM empleado WHERE correo_electronico = ?";
		$params = array($this->email);
		$data = Database::getRow($sql, $params);
		if($data){
			$this->id_empleado = $data['id_empleado'];
			$this->nombre_usuario = $data['nombre_usuario'];
			$this->email = $data['correo_electronico'];
			return true;
		}else{
			return false;
		}
	}
	public function checkPermisos(){
		$sql = "SELECT nombre_completo FROM empleado WHERE id_empleado = ?";
		$params = array($this->id_empleado);
		$data = Database::getRow($sql, $params);
		if($data){
			$this->nombre_completo = $data['nombre_completo'];
			return true;
		}else{
			return false;
		}
	}
	public function checkContrasena(){
		$sql = "SELECT contrasena, estado, fecha_bloqueo FROM empleado WHERE id_empleado = ?";
		$params = array($this->id_empleado);
		$data = Database::getRow($sql, $params);
		if(password_verify($this->contrasena, $data['contrasena'])){
			$this->estado = $data['estado'];
			$this->fecha2 = $data['fecha_bloqueo'];
			return true;
		}else{
			return false;
		}
	}
	public function changeContrasena(){
		$hash = password_hash($this->contrasena, PASSWORD_DEFAULT);
		$sql = "UPDATE empleado SET contrasena = ?, fecha_registro = ? WHERE id_empleado = ?";
		$fech = date('Y-m-d h:i:s');
		$params = array($hash, $fech, $this->id_empleado);
		return Database::executeRow($sql, $params);
	}
	public function logOut(){
		return session_destroy();
	}

	//Metodos para manejar el CRUD
	public function getEmpleados(){
		$sql = "SELECT id_empleado, nombre_completo, correo_electronico, nombre_usuario, imagen FROM empleado ORDER BY nombre_completo";
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	public function getEmpleados2($empieza, $por_pagina){
		$sql = "SELECT id_empleado, nombre_completo, correo_electronico, nombre_usuario, contrasena, imagen FROM empleado ORDER BY nombre_completo LIMIT $empieza, $por_pagina";
		$params = array(null);
		return Database::getRows($sql, $params);
	}
	public function searchEmpleado($value){
		$sql = "SELECT id_empleado, nombre_completo, correo_electronico, nombre_usuario, imagen FROM empleado WHERE nombre_completo LIKE ? ORDER BY nombre_completo";
		$params = array("%$value%");
		return Database::getRows($sql, $params);
	}
	public function createEmpleado(){
		$hash = password_hash($this->contrasena, PASSWORD_DEFAULT);
		$sql = "INSERT INTO empleado(nombre_completo, correo_electronico, nombre_usuario, contrasena, imagen, fecha_registro, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$fech = date('y-m-d');
		$params = array($this->nombre_completo, $this->correo_electronico, $this->nombre_usuario, $hash, $this->imagen, $fech, 1);
		return Database::executeRow($sql, $params);
	}
	public function readEmpleado(){
		$sql = "SELECT nombre_completo, correo_electronico, nombre_usuario, imagen, fecha_registro, ip FROM empleado WHERE id_empleado = ?";
		$params = array($this->id_empleado);
		$user = Database::getRow($sql, $params);
		if($user){
			$this->nombre_completo = $user['nombre_completo'];
			$this->correo_electronico = $user['correo_electronico'];
			$this->nombre_usuario = $user['nombre_usuario'];
			$this->imagen = $user['imagen'];
			$this->fecha = $user['fecha_registro'];
			$this->ip = $user['ip'];
			return true;
		}else{
			return null;
		}
	}
	public function updateEmpleado(){
		$sql = "UPDATE empleado SET nombre_completo = ?, correo_electronico = ?, nombre_usuario = ?, imagen = ? WHERE id_empleado = ?";
		$params = array($this->nombre_completo, $this->correo_electronico, $this->nombre_usuario, $this->imagen, $this->id_empleado);
		return Database::executeRow($sql, $params);
	}
	public function updateEmpleado2(){
		$sql = "UPDATE empleado SET nombre_completo = ?, correo_electronico = ?, nombre_usuario = ? WHERE id_empleado = ?";
		$params = array($this->nombre_completo, $this->correo_electronico, $this->nombre_usuario, $this->id_empleado);
		return Database::executeRow($sql, $params);
	}
	public function deleteEmpleado(){
		$sql = "DELETE FROM empleado WHERE id_empleado = ?";
		$params = array($this->id_empleado);
		return Database::executeRow($sql, $params);
	}


	public function updateContra($contra){
		$hash = password_hash($contra, PASSWORD_DEFAULT);
		$sql = "UPDATE empleado SET contrasena = ? WHERE correo_electronico = ?";
		$params = array($hash, $this->email);
		return Database::executeRow($sql, $params);
	}
	public function updateEstado($user){
		$sql = "UPDATE empleado SET estado = 0, fecha_bloqueo = ? WHERE nombre_usuario = ?";
		$fech = date('Y-m-d h:i:s');
		$params = array($fech, $user);
		return Database::executeRow($sql, $params);
	}
	public function updateEstado2($user){
		$sql = "UPDATE empleado SET estado = 1 WHERE nombre_usuario = ?";
		$params = array($user);
		return Database::executeRow($sql, $params);
	}
	public function insertIp(){
		$sql = "UPDATE empleado SET ip = ? WHERE nombre_usuario = ?";
		$params = array($this->ip, $this->nombre_usuario);
		return Database::executeRow($sql, $params);
	}
	public function unsetIp($usuario){
		$sql = "UPDATE empleado SET ip = null WHERE nombre_usuario = ?";
		$params = array($usuario);
		return Database::executeRow($sql, $params);
	}
}
?>