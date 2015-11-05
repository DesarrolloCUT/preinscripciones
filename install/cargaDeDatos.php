<?php
include '../conf/config.php';

try {
	$manangerConnection = new PDO('mysql:host=localhost;dbname=bedelia', 'root', 'root');
	$manangerConnection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	$manangerConnection->beginTransaction();
	
	for ($i=1;$i<34;$i++){
		for ($j=1;$j<19;$j++){
			$sentencia = $manangerConnection->prepare ("INSERT INTO horarios_fechas (id_horario,id_fecha) values (?,?)");
			$result = $sentencia->execute(array($i,$j));
			
		}
		
	}
	$manangerConnection->commit();
			
}
catch (PDOException $e) {
	echo "¡Error!: " . $e->getMessage() . "<br/>";
	die();
}
?>
