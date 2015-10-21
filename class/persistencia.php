<?php

include "../conf/config.php";

class Persistencia
{	

	private $manangerConnection;
	
	function __construct() {
		//constructor de la clase Persistencia

		try {
			
			$this->manangerConnection = new PDO('mysql:host=localhost;dbname=bedelia', 'root', 'root');
			$this->manangerConnection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );	
		}
		catch (PDOException $e) {
    		echo "¡Error!: " . $e->getMessage() . "<br/>";
    		die();
		}

	}

	public function newCarrera($nombre,$documentacion)
	{
		try {
			$this->manangerConnection->beginTransaction();
			
			$sentencia = $this->manangerConnection->prepare ("INSERT INTO carreras (nombre,documentacion) values (?,?)");
			$result = $sentencia->execute(array($nombre,$documentacion));	
			$lastID = $this->manangerConnection->lastInsertId();
			
			$this->manangerConnection->commit();
			
			return $lastID;
			
		}
		catch(PDOException $e) {
				echo "¡Error!: " . $e->getMessage() . "<br/>";
			}
	}
	
    public function editCarrera_nombre($id,$nombre)
	{
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE carreras SET nombre = :nombre WHERE id = :id");

			$result = $sentencia->execute(array(":nombre" => $nombre,":id" => $id));					
						
			}
			catch(PDOException $e) {
				echo "¡Error!: " . $e->getMessage() . "<br/>";
			}
	}
	
	public function editCarrera_documentacion($id,$documentacion)
	{
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE carreras SET documentacion = :documentacion WHERE id = :id");
	
			$result = $sentencia->execute(array(":documentacion" => $documentacion,":id" => $id));
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function newUser($cedula,$nombre,$apellido,$procedencia,$telefono,$email){
		try {
			$this->manangerConnection->beginTransaction();

			$sentencia = $this->manangerConnection->prepare ("INSERT INTO usuarios ( cedula , nombre , apellido , procedencia , email , telefono ) VALUES (?,?,?,?,?,?)");
			$result = $sentencia->execute(array($cedula,$nombre,$apellido,$procedencia,$telefono,$email));
			
			$lastID = $this->manangerConnection->lastInsertId();
			
			$this->manangerConnection->commit();
			
			return $lastID;

		}
		catch(PDOException $e) {
    		echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
		
	}
	
	public function findUser($cedula){
		try {
	
			$sentencia = $this->manangerConnection->prepare ("SELECT * FROM usuarios WHERE cedula = ?");
			$result = $sentencia->execute(array($cedula));
			
			if ($result){
				$fila = $sentencia->fetch();
				return $fila;
			}else 
				return 0;
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	
	}
	
	public function newBooking($id_usuario,$id_carrera,$id_fecha,$id_horario){
		try {
			$this->manangerConnection->beginTransaction();
	
			$sentencia = $this->manangerConnection->prepare ("INSERT INTO reservas ( id_usuario , id_recurso , id_fecha , id_hora ) VALUES (?,?,?,?)");
			$result = $sentencia->execute(array($id_usuario,$id_carrera,$id_fecha,$id_horario));
				
			$lastID = $this->manangerConnection->lastInsertId();
				
			$this->manangerConnection->commit();
				
			return $lastID;
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	
	}
	
	public function findBooking($id_booking){
		try {
	
			$sentencia = $this->manangerConnection->prepare ("SELECT * FROM reservas WHERE id = ?");
			$result = $sentencia->execute(array($id_booking));
			
			if ($result){
				$fila = $sentencia->fetch();
				return $fila;
			}else 
				return 0;
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	
	}
	
	public function findBooking_user($id_user){
		try {
	
			$sentencia = $this->manangerConnection->prepare ("SELECT * FROM reservas WHERE id_usuario = ?");
			$result = $sentencia->execute(array($id_user));
				
			if ($result){
				$fila = $sentencia->fetch();
				return $fila;
			}else 
				return 0;
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	
	}
	
	public function editBooking_carrera($id,$id_carrera)
	{
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE reservas SET id_carrera = :carrera WHERE id = :id");
	
			$result = $sentencia->execute(array(":carrera" => $id_carrera,":id" => $id));
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function editBooking_fecha($id,$id_fecha)
	{
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE reservas SET id_fecha = :fecha WHERE id = :id");
	
			$result = $sentencia->execute(array(":fecha" => $id_fecha,":id" => $id));
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function editBooking_hora($id,$id_hora)
	{
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE reservas SET id_hora = :hora WHERE id = :id");
	
			$result = $sentencia->execute(array(":hora" => $id_hora,":id" => $id));
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function newHorario($horario)
	{
		try {
			$this->manangerConnection->beginTransaction();
				
			$sentencia = $this->manangerConnection->prepare ("INSERT INTO horarios (hora) values (?)");
			$result = $sentencia->execute(array($horario));
			$lastID = $this->manangerConnection->lastInsertId();
				
			$this->manangerConnection->commit();
				
			return $lastID;
				
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function editHorario($id_hora){
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE horarios SET hora = :hora WHERE id = :id");
		
			$result = $sentencia->execute(array(":hora" => $hora,":id" => $id));
		
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function newFecha($fecha)
	{
		try {
			$this->manangerConnection->beginTransaction();
	
			$sentencia = $this->manangerConnection->prepare ("INSERT INTO fechas (hora) values (?)");
			$result = $sentencia->execute(array($fecha));
			$lastID = $this->manangerConnection->lastInsertId();
	
			$this->manangerConnection->commit();
	
			return $lastID;
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function editFecha($id_fecha){
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE fechas SET fecha = :hora WHERE id = :id");
	
			$result = $sentencia->execute(array(":fecha" => $fecha,":id" => $id));
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function newHorarioFecha($horario,$fecha){
		try{
			$this->manangerConnection->beginTransaction();
			
			$sentencia = $this->manangerConnection->prepare ("INSERT INTO horarios_fechas (id_horario,id_fecha) values (?,?)");
			$result = $sentencia->execute(array($horario));
			$lastID = $this->manangerConnection->lastInsertId();
			
			$this->manangerConnection->commit();
			
			return $lastID;
			
		}catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function deleteHorarioFecha($id_horario_fecha){
		try{
				
			$sentencia = $this->manangerConnection->prepare ("DELETE FROM horarios_fechas WHERE id = ?");
			$result = $sentencia->execute(array($id_horario_fecha));
				
		}catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function toAssingHorarioFecha($id_hora_fecha){
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE horarios_fechas SET usado = 1 WHERE id = :id");
	
			$result = $sentencia->execute(array(":fecha" => $fecha,":id" => $id));
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function deallocateHorarioFecha($id_hora_fecha){
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE horarios_fechas SET usado = 0 WHERE id = :id");
	
			$result = $sentencia->execute(array(":fecha" => $fecha,":id" => $id));
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function freeTimeOnTheDate($id_fecha){
		try {
		
			$sentencia = $this->manangerConnection->prepare ("SELECT id_horario FROM horarios_fechas WHERE usado = 0 AND id_fecha = ?");
			$result = $sentencia->execute(array($id_fecha));
				
			if ($result){
				$fila = $sentencia->fetch();
				return $fila;
			}else 
				return 0;
		
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function getDates(){
		try {
			
			$query_result = $this->manangerConnection->query ("SELECT * FROM fechas");
	
			if ($query_result){
				$i=0;
				foreach($query_result as $row) {
					$result[$i]['id'] = $row['id'];
					$result[$i]['fecha']= strftime("%A, %d de %B del %Y",strtotime($row['fecha']));
					$i=$i+1;
				}
	
				return $result;
			}else
				return 0;
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function getCarreras(){
	  	try {
	  	
	  		$query_result = $this->manangerConnection->query ("SELECT * FROM carreras");
	  			
	  		if ($query_result){
	  			$i=0;
	  			foreach($query_result as $row) {
	  				$result[$i]['id'] = $row['id'];
	  				$result[$i]['nombre']=$row['nombre'];
	  				$result[$i]['documentacion']=$row['documentacion'];
	  				$i=$i+1;
	  			}
	  			
	  			return $result;
	  		}else
	  			return 0;
	  	
	  	}
	  	catch(PDOException $e) {
	  		echo "¡Error!: " . $e->getMessage() . "<br/>";
	  	}
	}
}
?>