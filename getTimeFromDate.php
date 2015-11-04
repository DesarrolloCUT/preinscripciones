<?php
	include 'class/persistencia.php';
	$option= $_GET ['option' ];
	
	$p = new Persistencia();
	
	$datos = $p->freeTimeOnTheDate($option);
	//print_r($datos);
	foreach ($datos as $fila){?>
		<option value="<?=$fila['id_horario']?>"><?=$fila['hora']?></option>
<?php } ?>
