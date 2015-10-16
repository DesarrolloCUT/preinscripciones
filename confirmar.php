<?php
	$nombre = $_REQUEST['nombre'];
	$apellido = $_REQUEST['apellido'];
	$telefono = $_REQUEST['telefono'];
	$procedencia = $_REQUEST['procedencia'];
	$email = $_REQUEST['email'];
	$carrera = $_REQUEST['carrera'];
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
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
	      <h2>¿Confirma los datos ingresados?</h2>
	    </div>
	    
	    <form role="form" method="post">
	    	 <div class="row">
	    	 	<div class="panel panel-primary">
	    	 		<div class="panel-heading">
			             <h3 class="panel-title">Los datos que ingresó fueron los siguientes:</h3>
			           </div>			           
			           <div class="panel-body">
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
				           		<label>Teléfono: <?=$telefono?></label>
				           </div>
				           <div class="form-group">
				           		<label>E-mail: <?=$email?></label>
				           </div>
				           <div class="form-group">
				           		<label>Carrera: <?=$carrera?></label>
				           </div>
			           </div>
	    	 	</div>
	    	 </div>
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