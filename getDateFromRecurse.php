<!-- <option >Seleccione una fecha</option> -->
<?php

include 'class/persistencia.php';
setlocale(LC_TIME, 'es_UY.UTF-8');	
$option= $_GET ['option'];

$p = new Persistencia();

$datos = $p->dateResourceAvailable($option);
//print_r($datos);
foreach ($datos as $fila){?>
		<option value="<?=$fila['id']?>"><?=utf8_decode($fila['fecha'])?></option>
<?php } ?>
