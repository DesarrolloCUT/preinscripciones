<?php

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
	
	$fecha = $_REQUEST['fecha'];
	$hora = $_REQUEST['hora'];
	
	$p = new Persistencia();
	$nomCarrera = $p->findNameCarreraFromId($carrera);
	$textFecha = utf8_decode($p->getDateFromId($fecha));
	$textHora = $p->getTimeFromId($hora);
	
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
				<a href="index.php"><button type="button" class="btn btn-lg btn-danger">Cambiar</button></a>
			</div>
	    </form>
	   </div>
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