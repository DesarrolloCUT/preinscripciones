<!-- <option >Seleccione una fecha</option> -->
<?php

include 'class/persistencia.php';
setlocale(LC_TIME, 'es_ES.UTF-8');	
$option= $_GET ['option'];

$p = new Persistencia();

$datos = $p->dateResourceAvailable($option);
//print_r($datos);
foreach ($datos as $fila){?>
		<option value="<?=$fila['id']?>"><?=utf8_encode($fila['fecha'])?></option>
<?php } ?>