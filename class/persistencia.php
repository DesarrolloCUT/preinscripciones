<?php

//include "conf/config.php";

$host="localhost";
$user="root";
$password="root";
$database="bedelia";

class Persistencia
{
	function __construct() {
		//constructor de la clase Persistencia
		try {
			echo "host".$host.$user.$password;
			
			$mbd = new PDO('mysql:host='.$host.';dbname='.$database.'', $user, $password);
			$mbd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch (PDOException $e) {
    		print "¡Error!: " . $e->getMessage() . "<br/>";
    		die();
		}
	}


	public function saveUser($nombre,$apellido,$procedencia,$telefono,$email){
		try {
		$user = new Usuario($nombre, $apellido, $procedencia, $telefono, $email);
		
		$sth = $mbd->prepare ('INSERT INTO usuarios (nombre, apellido, procedencia, telefono, email) values (:nombre, :apellido, :procedencia, :telefono, :email)');
		$STH->execute((array)$user);
		}
		catch (Exception $e) {
    		print "¡Error!: " . $e->getMessage() . "<br/>";
    		die();
		}
	}
}
?>