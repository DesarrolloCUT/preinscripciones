<?php

//
include "class/persistencia.php";

$p = new Persistencia();

$nombreCarrera = "carrera3";
$doc="";

//echo $p->newCarrera($nombreCarrera, $doc);
//$p->saveUser(12345678,"Víctor", "Viana", "Paso de los Toros", "098555666", "vicalex@vera.com.uy");

//$p->editCarrera_nombre(9, $nombreCarrera);

//print_r($p->findUser(12345678));

$result = $p->getCarreras();
foreach ($result as $row)
	echo $row['id']. ' - '. $row['nombre']. ' - '. $row['documentacion']. '<br />';

?>