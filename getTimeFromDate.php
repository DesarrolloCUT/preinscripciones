<?php
	include 'class/persistencia.php';
	$option= $_GET [ 'option' ];
	echo $option;
	$p = new Persistencia();
	
	$result = $p->freeTimeOnTheDate($option);
	foreach ($result as $row)
		 printf ( '<option value="%s">%s</option>' , $row['id_horario'] , $row['id_horario'] ) ; 	
?>