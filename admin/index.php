<?php 

	include "../class/persistencia.php";

	$pdo = new Persistencia();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Preinscripciones 2015</title>
    <meta charset="iso-8859-1">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="width:90%;">
    		<div class="row">
    			<h3>Reservas</h3>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Agregar Reserva</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>N&uacute;mero de Reserva</th>
		                  <th>C&eacute;dula</th>
		                  <th>Nombre</th>
		                  <th>Apellido</th>
		                  <th>Procedencia</th>
		                  <th>Tel&eacute;fono</th>
		                  <th>E-mail</th>
		                  <th>Carrera</th>
		                  <th></th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
	 				   foreach ($pdo->getReservas() as $row) {
						   		echo '<tr>';
						   		echo '<td>'. $row['id'] . '</td>';
						   		echo '<td>'. $row['cedula'] . '</td>';
							   	echo '<td>'. $row['nombre'] . '</td>';
							   	echo '<td>'. $row['apellido'] . '</td>';
							   	echo '<td>'. $row['procedencia'] . '</td>';
							   	echo '<td>'. $row['telefono'] . '</td>';
							   	echo '<td>'. $row['email'] . '</td>';						   	
							   	echo '<td>'. $row['carrera'] . '</td>';
							   	echo '<td width=15%>';
							   	echo '<a class="btn" href="read.php?id='.$row['id'].'">Detalle</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Editar</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Borrar</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }

					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>
