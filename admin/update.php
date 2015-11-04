<?php 
	
	require  "../class/persistencia.php";
	
	setlocale(LC_TIME, 'es_ES.UTF-8');

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
		
	if ( !empty($_POST)) {
		// keep track validation errors
		$cedulaError = null;
		$carreraError = null;
		$fechaError = null;
		$horaError = null;
		
		// keep track post values
		$cedula = $_POST['cedula'];
		$carrera = $_POST['$carrera'];		
		$fecha = $_POST['fecha'];
		$hora = $_POST['hora'];

		
		// validate input
		$valid = true;
		if (empty($cedula)) {
			$cedulaError = 'Por favor ingresa la cédula';
			$valid = false;
		}
		
		if (empty($carrera)) {
			$carreraError = 'Por favor ingresa la carrera';
			$valid = false;
		} 
		
		if (empty($fecha)) {
			$fechaError = 'Por favor ingresa la fecha';
			$valid = false;
		}
		
		if (empty($hora)) {
			$horaError = 'Por favor ingresa la hora';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = new Persistencia();
			$pdo->editBooking_carrera($id, $carrera);
			$pdo->editBooking_fecha($id, $fecha);
			$pdo->editBooking_hora($id, $hora);
			header("Location: index.php");
		}
	} else {

		$pdo = new Persistencia();
		$result = $pdo->findBooking($id);
		$cedula = $result['id_usuario'];
		$carrera = $result['id_recurso'];
		$fecha = $result['id_fecha'];
		$hora = $result['id_hora'];
		
		
	}
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
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Editar reserva</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($cedulaError)?'error':'';?>">
					    <label class="control-label">C&eacute;dula</label>
					    <div class="controls">
					      	<input name="cedula" type="text"  placeholder="Cédula" value="<?php echo !empty($cedula)?$cedula:'';?>">
					      	<?php if (!empty($cedulaError)): ?>
					      		<span class="help-inline"><?php echo $cedulaError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($carreraError)?'error':'';?>">
					    <label class="control-label">Carrera</label>
					    <div class="controls">
					    	<select class="form-control" name="carrera" id="carrera">
					      	<!--  <input name="carrera" type="text" placeholder="Carrera" value="<?php //echo !empty($carrera)?$carrera:'';?>">-->
					      	<?php                                    
                                    $cs = $pdo->getCarreras();

                                    foreach ($cs as $row){
                                    	echo ($row['id']==$carrera)?"<option value='".$row['id']."' selected>".$row['nombre']."</option>":"<option value='".$row['id']."'>".$row['nombre']."</option>";
                                     } ?>
                            </select>
					      	<?php if (!empty($carreraError)): ?>
					      		<span class="help-inline"><?php echo $carreraError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($fechaError)?'error':'';?>">
					    <label class="control-label">Fecha</label>
					    <div class="controls">
					    <select class="form-control" name="fecha" id="fecha">
					      	<?php 
					      			$fs = $pdo->getDates();

                                    foreach ($fs as $row){
                                    	echo ($row['id']==$fecha)?"<option value='".$row['id']."' selected>".$row['fecha']."</option>":"<option value='".$row['id']."'>".$row['fecha']."</option>";
                                    } ?>
					      	<?php if (!empty($fechaError)): ?>
					      		<span class="help-inline"><?php echo $fechaError;?></span>
					      	<?php endif;?>
					    </select>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($horaError)?'error':'';?>">
					    <label class="control-label">Hora</label>
					    <div class="controls">
					    <select class="form-control" name="hora" id="hora">
					      	<?php 
					      			$hs = $pdo->getTimes();

                                    foreach ($hs as $row){
                                    	echo ($row['id']==$fecha)?"<option value='".$row['id']."' selected>".$row['hora']."</option>":"<option value='".$row['id']."'>".$row['hora']."</option>";
                                    } ?>
					      	<?php if (!empty($horaError)): ?>
					      		<span class="help-inline"><?php echo $horaError;?></span>
					      	<?php endif;?>
					    </select>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="index.php">Regresar</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>