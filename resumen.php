
<?php

include "class/persistencia.php";

try {
	$nombre = $_REQUEST['nombre'];
	$apellido = $_REQUEST['apellido'];
	$procedencia = $_REQUEST['procedencia'];
	$telefono = $_REQUEST['telefono'];
	$email = $_REQUEST['email'];
	
	echo "parametros recibidos: ". array($_REQUEST);
	
	//$p = new Persistencia();
	//$p->saveUser($nombre, $apellido, $procedencia, $telefono, $email);
	
}catch (Exception $e){
	echo "Error: ".$e->getMessage()."<br>";
}
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
	      <h3>Se confirmó su inscripción a la carrera <?php $carrera;?> de para el día <?php $fecha;?> a la hora <?php $hora;?>. Deberá presentar en ese momento la siguiente documentación:</h3>
	      <p><?php $documentacion;?></p>
	      
	      <h3>Su número de inscripción es <?=$id_reserva?></h3>
	      <p>Lugar de la inscripción:<p>
	      <ul>
	      	<li>Centro Univesitario de Tacuarembó
	      	<li>Dirección: Joaquín Suárez 215, Tacuarembó.   		
	      	
	      </ul>
	      <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=-55.988420248031616%2C-31.715737462953218%2C-55.970503091812134%2C-31.70747746408136&amp;layer=mapnik&amp;marker=-31.711612119025453%2C-55.979461669921875" style="border: 1px solid black"></iframe><br/><small><a href="http://www.openstreetmap.org/?mlat=-31.71161&amp;mlon=-55.97946#map=17/-31.71161/-55.97946">Ver mapa más grande</a></small>
	    </div>
	    
	    
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