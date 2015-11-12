<?php
session_start();
function formateoCedula($cadena){

	$cadena = str_replace(' ', '', $cadena);
	$cadena = str_replace('.', '', $cadena);
	$cadena = str_replace('-', '', $cadena);
	return $cadena;
}

include "class/persistencia.php";
	setlocale(LC_TIME, 'es_ES.UTF-8');

    $cedula = formateoCedula($_REQUEST['cedula']);
	$nombre = $_REQUEST['nombre'];
	$apellido = $_REQUEST['apellido'];
	$procedencia = $_REQUEST['procedencia'];
	$telefono = $_REQUEST['telefono'];
	$email = $_REQUEST['email'];
	$carrera = $_REQUEST['carrera'];
	
	$p = new Persistencia();
	$nomCarrera = $p->findNameCarreraFromId($carrera);
		
	$fecha = $_REQUEST['fecha'];
	$hora = $_REQUEST['hora'];
	
	
	
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Preinscripciones 2015</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
    <!-- Bootstrap theme -->
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
    
    <script src="bootstrap/assets/js/jquery-2.1.4.min.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>

  <body role="document">
		<?php 
		
		
		$reserva = $p->findBooking_user($cedula);
		
		if ($reserva == 0){
		
			$textFecha = utf8_decode($p->getDateFromId($fecha));
			$textHora = $p->getTimeFromId($hora);
		
		?>
	  <div class="container theme-showcase" role="main">
	    <!-- Main jumbotron for a primary marketing message or call to action -->
	    <div class="page-header">
	      <h1>Preinscripciones 2015</h1>
	      <h2>Confirmar los datos ingresados</h2>
	    </div>
	    
	    <form role="form" method="post" action="resumen.php">
	    	 <div class="row">
	    	 	<div class="panel panel-primary">
	    	 		<div class="panel-heading">
			             <h3 class="panel-title">Los datos que ingres&oacute; fueron los siguientes:</h3>
			        </div>			           
			        <div class="panel-body">
			           	   <div class="form-group">
				           		<label>C&eacute;dula: <?=$cedula?></label>
				           </div>
				           <div class="form-group">
				           		<label>Nombre: <?=$nombre?></label>
				           </div>
				           <div class="form-group">
				           		<label>Apellido: <?=$apellido?> </label>
				           </div>
				           <div class="form-group">
				           		<label>Ciudad/Localidad: <?=$procedencia?></label>
				           </div>
				           <div class="form-group">
				           		<label>Tel&eacute;fono: <?=$telefono?></label>
				           </div>
				           <div class="form-group">
				           		<label>E-mail: <?=$email?></label>
				           </div>
				           <div class="form-group">
				           		<label>Carrera: <?=$nomCarrera?></label>
				           </div>
				           <div class="form-group">
				           		<label>Fecha: <?=$textFecha?></label>
				           </div>
				           <div class="form-group">
				           		<label>Hora: <?=$textHora?></label>
				           </div>
			           </div>
	    	 	</div>
	    	 </div>
	    	 <input type="hidden"  name="cedula" value="<?=$cedula?>"/>
	    	 <input type="hidden"  name="nombre" value="<?=$nombre?>"/>
             <input type="hidden"  name="apellido" value="<?=$apellido;?>"/>
             <input type="hidden"  name="telefono" value="<?=$telefono?>"/>
             <input type="hidden"  name="procedencia" value="<?=$procedencia?>"/>
             <input type="hidden"  name="email" value="<?=$email?>"/>	
             <input type="hidden"  name="carrera" value="<?=$carrera?>"/>
             <input type="hidden"  name="nomCarrera" value="<?=$nomCarrera?>"/>
             <input type="hidden"  name="fecha" value="<?=$fecha?>"/>
             <input type="hidden"  name="hora" value="<?=$hora?>"/>
	    	<div class="form-group">
				<button type="submit" class="btn btn-lg btn-primary">Confirmar</button>
			</div>
			<div class="form-group">
				<a href="index.php?cedula=<?=$cedula?>&nombre=<?=$nombre?>&apellido=<?=$apellido;?>&telefono=<?=$telefono?>&procedencia=<?=$procedencia?>&email=<?=$email?>&carrera=<?=$carrera?>&fecha=<?=$fecha?>&hora=<?=$hora?>"><button type="button" class="btn btn-lg btn-danger">Cambiar</button></a>
			</div>
	    </form>
	   </div>
	   <?php 
		}else{
			$id_reserva_realizada = $reserva['id'];
			$creation_date = $reserva['creation_date'];
			$update_date = $reserva['update_date'];
			$carrera_reserva = $reserva['id_recurso'];
			$fecha_reserva = $reserva['id_fecha'];
			$hora_reserva = $reserva['id_hora'];
			
			$nomCarrera_reserva = $p->findNameCarreraFromId($carrera_reserva);
			
			$textFecha_reserva = utf8_decode($p->getDateFromId($fecha_reserva));
			
			$textHora_reserva = $p->getTimeFromId($hora_reserva);
			
			if (!isset($update_date))
				$last_update = $creation_date;
			else 
				$last_update = $update_date;
			
		?>
		 <div class="container theme-showcase" role="main">
		    <!-- Main jumbotron for a primary marketing message or call to action -->
		    <div class="page-header">
		      <h1>Preinscripciones 2015</h1>
		      <h2>ATENCI&Oacute;N - UD. ya tiene una reserva realizada en este sistema</h2>
		    </div>	
		    <form role="form" method="post" action="resumen.php">
		     <div class="row">
	    	 	<div class="panel panel-primary">
	    	 		<div class="panel-heading">
			             <h3 class="panel-title"><b><?=$nombre?> <?=$apellido?></b>, los datos que ingres&oacute; el <?=strftime("%A, %d de %B del %Y a las %H:%m",strtotime($last_update))?> fueron los siguientes:</h3>
			        </div>	
			   	
			
				<div class="panel-body">

				           <div class="form-group">
				           		<label>Carrera a la que se preinscribi&oacute;: <?=$nomCarrera_reserva?></label>
				           </div>
				           <div class="form-group">
				           		<label>Fecha elegida: <?=$textFecha_reserva?></label>
				           </div>
				           <div class="form-group">
				           		<label>Hora elegida: <?=$textHora_reserva?></label>
				           </div>

				           <?php if ($carrera != $carrera_reserva){
				           			$documentacion = $p->findDocCarreraFromId($carrera);
				           ?>
				           <div class="form-group">
				           		<label>Si quiere usar esta fecha y hora para preinscribirse a la carrera <?=$nomCarrera?>, debe concurrrir a con la siguiente documentaci&oacute;n:</label>
				           		<p><?=$documentacion?></p>
				           </div>
				           <?php }?>
			           </div>
				</div>
			</div>
			<input type="hidden"  name="cedula" value="<?=$cedula?>"/>
	    	<input type="hidden"  name="nombre" value="<?=$nombre?>"/>
            <input type="hidden"  name="apellido" value="<?=$apellido;?>"/>
            <input type="hidden"  name="telefono" value="<?=$telefono?>"/>
            <input type="hidden"  name="procedencia" value="<?=$procedencia?>"/>
            <input type="hidden"  name="email" value="<?=$email?>"/>	
            <input type="hidden"  name="carrera" value="<?=$carrera?>"/>
            <input type="hidden"  name="nomCarrera" value="<?=$nomCarrera?>"/>
            <input type="hidden"  name="fecha" value="<?=$fecha?>"/>
            <input type="hidden"  name="hora" value="<?=$hora?>"/>
            
            <input type="hidden"  name="reserva_realizada" value="<?=$id_reserva_realizada?>"/>
            
	    	<div class="form-group">
	    	<a href="resumen2.php?id_reserva=<?=$id_reserva_realizada?>&cedula=<?=$cedula?>&nombre=<?=$nombre?>&apellido=<?=$apellido;?>&telefono=<?=$telefono?>&procedencia=<?=$procedencia?>&email=<?=$email?>&carrera=<?=$carrera_reserva?>&nomCarrera=<?=$nomCarrera_reserva?>&fecha=<?=$textFecha_reserva?>&hora=<?=$textHora_reserva?>">
	    		<button type="button" class="btn btn-lg btn-primary">&iquest;Desea mantener esa reserva?</button>
	    	</a>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-lg btn-danger">Actualiza la reserva con los datos que ingres&oacute; ahora</button>
			</div>
	    </form>
		</div>
		<?php 
		}
	   
	   ?>
	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
	    <script src="bootstrap/assets/js/docs.min.js"></script>
	    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>

</html>