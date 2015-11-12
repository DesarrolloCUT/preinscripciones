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
			$result = $sentencia->execute(array($cedula,$nombre,$apellido,$procedencia,$email,$telefono));
			
			$lastID = $this->manangerConnection->lastInsertId();
			
			$this->manangerConnection->commit();
			
			return $lastID;

		}
		catch(PDOException $e) {
    		echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
		
	}
	
	public function editUser($cedula,$nombre,$apellido,$procedencia,$telefono,$email){
		try {
	
			$sentencia = $this->manangerConnection->prepare ("UPDATE usuarios SET nombre = ? , apellido = ? , procedencia = ? , email = ? , telefono = ? WHERE cedula = ?");
			$result = $sentencia->execute(array($nombre,$apellido,$procedencia,$email,$telefono,$cedula));
				
			return 1;
	
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
			
			$sentencia2 = $this->manangerConnection->prepare ("UPDATE horarios_fechas SET usado = 1 WHERE id_fecha = ? AND id_horario = ?");
			$result2 = $sentencia2->execute(array($id_fecha,$id_horario));
				
			$this->manangerConnection->commit();
				
			return $lastID;
	
		}
		catch(PDOException $e) {
			echo "¡Error! Function newBooking: " . $e->getMessage() . "<br/>";
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
	
	public function editBooking($id,$id_carrera,$id_fecha,$id_hora)
	{
		try {
			
			$this->manangerConnection->beginTransaction();
			
			$sentencia1 = $this->manangerConnection->prepare("UPDATE `horarios_fechas` as h 
															SET h.`usado` = 0
															WHERE EXISTS 
															(SELECT * FROM `reservas` as r 
															 WHERE r.`id_hora` = h.`id_horario` 
															 AND r.`id_fecha` = h.`id_fecha` 
															 AND r.id = ?)");
			$result1 = $sentencia1->execute(array($id));
			
			$sentencia2 = $this->manangerConnection->prepare ("UPDATE reservas SET id_recurso = ?, id_fecha = ?, id_hora = ?, update_date = CURRENT_TIMESTAMP WHERE id = ?");
			$result2 = $sentencia2->execute(array($id_carrera, $id_fecha, $id_hora, $id));
			
			$sentencia3 = $this->manangerConnection->prepare ("UPDATE horarios_fechas SET usado = 1 WHERE id_fecha = ? AND id_horario = ?");
			$result3 = $sentencia3->execute(array($id_fecha,$id_hora));
			
			$this->manangerConnection->commit();
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function editBooking_carrera($id,$id_carrera)
	{
		try {
			$sentencia = $this->manangerConnection->prepare ("UPDATE reservas SET id_recurso = :carrera WHERE id = :id");
	
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
		
			$query_result = $this->manangerConnection->query ("SELECT hf.id_horario, h.hora FROM horarios_fechas hf, horarios h WHERE hf.usado = 0 AND hf.id_fecha = ".$id_fecha." AND hf.id_horario = h.id ");
			
			if ($query_result){
				$i=0;
				foreach($query_result as $row) {
					$result[$i]['id_horario'] = $row['id_horario'];
					$result[$i]['hora']=$row['hora'];
					$i=$i+1;
				}
			
			/*if ($result){
				$filas = $sentencia->fetch();*/
				return $result;
			}else 
				return 0;
		
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function getTimeOnTheDate($id_fecha){
		try {
	
			$query_result = $this->manangerConnection->query ("SELECT hf.id_horario, h.hora FROM horarios_fechas hf, horarios h WHERE hf.id_fecha = ".$id_fecha." AND hf.id_horario = h.id ");
				
			if ($query_result){
				$i=0;
				foreach($query_result as $row) {
					$result[$i]['id_horario'] = $row['id_horario'];
					$result[$i]['hora']=$row['hora'];
					$i=$i+1;
				}
					
				/*if ($result){
					$filas = $sentencia->fetch();*/
				return $result;
			}else
				return 0;
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function dateResourceAvailable($id_recurso){
		try {
	
			$query_result = $this->manangerConnection->query ("SELECT f.id, f.fecha 
					                                           FROM fechas f, disponibilidad d, carreras c 
					                                           WHERE f.id = d.id_fecha AND d.id_recurso = c.id AND c.id = ".$id_recurso);
				
			if ($query_result){
				$i=0;
				foreach($query_result as $row) {
					$result[$i]['id'] = $row['id'];
					$result[$i]['fecha']=strftime("%A, %d de %B del %Y",strtotime($row['fecha']));
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
	
	public function getDateFromId($id_fecha){
		try {
				
			$query_result = $this->manangerConnection->query ("SELECT fecha FROM fechas WHERE id = ".$id_fecha);
	
			if ($query_result){
				foreach($query_result as $row) {
					$result = strftime("%A, %d de %B del %Y",strtotime($row['fecha']));
				}
	
				return $result;
			}else
				return 0;
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function getTimeFromId($id_hora){
		try {
	
			$query_result = $this->manangerConnection->query ("SELECT hora FROM horarios WHERE id = ".$id_hora);
	
			if ($query_result){
				foreach($query_result as $row) {
					$result = $row['hora'];
				}
	
				return $result;
			}else
				return 0;
	
		}
		catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function getTimes(){
		try {
				
			$query_result = $this->manangerConnection->query ("SELECT * FROM horarios");
	
			if ($query_result){
				$i=0;
				foreach($query_result as $row) {
					$result[$i]['id'] = $row['id'];
					$result[$i]['hora']= $row['hora'];
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
	
	public function findNameCarreraFromId($id_recurso){
		try {
			$query_result = $this->manangerConnection->query ("SELECT nombre FROM carreras WHERE id = ".$id_recurso);
			
			if ($query_result){

				foreach($query_result as $row) {
					$result=$row['nombre'];

				}
			
				return $result;
			}else
				return 0;
		}catch(PDOException $e) {
	  		echo "¡Error!: " . $e->getMessage() . "<br/>";
	  	}
	}
	
	public function findDocCarreraFromId($id_recurso){
		try {
			$query_result = $this->manangerConnection->query ("SELECT documentacion FROM carreras WHERE id = ".$id_recurso);
				
			if ($query_result){
	
				foreach($query_result as $row) {
					$result=$row['documentacion'];
	
				}
					
				return $result;
			}else
				return 0;
		}catch(PDOException $e) {
			echo "¡Error!: " . $e->getMessage() . "<br/>";
		}
	}
	
	public function getReservas(){
		try{
			$query_result = $this->manangerConnection->query ("SELECT * FROM v_reservas ORDER BY id DESC");
			
			if ($query_result){
				$i=0;
				foreach($query_result as $row) {
					$result[$i]['id'] = $row['id'];
					$result[$i]['cedula']=$row['cedula'];
					$result[$i]['nombre']=$row['nombre'];
					$result[$i]['apellido']=$row['apellido'];
					$result[$i]['procedencia']=$row['procedencia'];
					$result[$i]['email']=$row['email'];
					$result[$i]['telefono']=$row['telefono'];
					$result[$i]['carrera']=$row['carrera'];
					$result[$i]['fecha']=$row['fecha'];
					$result[$i]['hora']=$row['hora'];
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