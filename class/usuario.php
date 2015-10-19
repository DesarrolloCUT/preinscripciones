<?php
class Usuario
{
    // Propiedades
    private $id_usuario;
    private $nombre;
    private $apellido;
    private $procedencia;
    private $telefono;
    private $email;
    
    function __construct() {
    	//constructor de la clase Usuario
    }
    
    function __construct($nombre,$apellido,$procedencia,$telefono,$email) {
    	//constructor de la clase Usuario
    	$this->id_usuario = $idUsuario;
    	$this->nombre = $nombre;
    	$this->apellido = $apellido;
    	$this->procedencia = $procedencia;
    	$this->telefono = $telefono;
    	$this->email = $email;
    }
    
    function __construct($idUsuario,$nombre,$apellido,$procedencia,$telefono,$email) {
    	//constructor de la clase Usuario
    	 $this->id_usuario = $idUsuario;
    	 $this->nombre = $nombre;
    	 $this->apellido = $apellido;
    	 $this->procedencia = $procedencia;
    	 $this->telefono = $telefono;
    	 $this->email = $email;
    }

    // Declaración de un método
    public function setIdUsuario($idUsuario) {
        $this->id_usuario = $idUsuario;
    }
    
    public function getIdUsuario() {
    	return $this->id_usuario;
    }
    
    public function setNombre($nombre) {
    	$this->nombre = $nombre;
    }
    
    public function getNombre() {
    	return $this->nombre;
    }
    
    public function setApellido($apellido) {
    	$this->apellido = $apellido;
    }
    
    public function getApellido() {
    	return $this->apellido;
    }
    
    public function setProcedencia($procedencia) {
    	$this->procedencia = $procedencia;
    }
    
    public function getProcedencia() {
    	return $this->procedencia;
    }
    
    public function setTelefono($telefono) {
    	$this->telefono = $telefono;
    }
    
    public function getTelefono() {
    	return $this->telefono;
    }
    
    public function setEmail($email) {
    	$this->email = $email;
    }
    
    public function getEmail() {
    	return $this->email;
    }
}
?>
