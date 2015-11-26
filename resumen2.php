
<?php


include "class/persistencia.php";

setlocale(LC_TIME, 'es_ES.UTF-8');

session_start();

$verifica = $_SESSION["verifica"];

if ($verifica == 1){
	unset($_SESSION['verifica']);
	
	try {
		$id_reserva = $_REQUEST['id_reserva'];
		$cedula = $_REQUEST['cedula'];
		$nombre = $_REQUEST['nombre'];
		$apellido = $_REQUEST['apellido'];
		$procedencia = $_REQUEST['procedencia'];
		$telefono = $_REQUEST['telefono'];
		$email = $_REQUEST['email'];
		$carrera = $_REQUEST['carrera'];
		$nomCarrera = $_REQUEST['nomCarrera'];
		$fecha = $_REQUEST['fecha'];
		$hora = $_REQUEST['hora'];
		
		$id_reserva_realizada = $_REQUEST['reserva_realizada'];
		
		unset($_SESSION['verifica']);
			
		$p = new Persistencia();
		$documentacion= $p->findDocCarreraFromId($carrera);
				
	}catch (Exception $e){
		echo "Error: ".$e->getMessage()."<br>";
	}
}else {
	echo "<META HTTP-EQUIV='Refresh' CONTENT='0; url=index.php'>";
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="iso-8859-1"><meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Preinscripciones 2016</title>

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
	      <h1>Preinscripciones 2016</h1>
	      <h3>Le recordamos su inscripci&oacute;n a la carrera <b><?=$nomCarrera?></b> para el d&iacute;a <b><?=$fecha?></b> a la hora <b><?=$hora?></b>. Deber&aacute; presentar en ese momento la siguiente documentaci&oacute;n:</h3>
	      <p><?=$documentacion?></p>
	      
	      <h3>Su n&uacute;mero de inscripci&oacute;n es <b><?=$id_reserva?></b></h3>
	      <p>Lugar de la inscripci&oacute;n:<p>
	      <ul>
	      	<li>Centro Univesitario de Tacuaremb&oacute;
	      	<li>Direcci&oacute;n: Joaqu&iacute;n Su&aacute;rez 215, Tacuaremb&oacute;.   		
	      	
	      </ul>
	      <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=-55.988420248031616%2C-31.715737462953218%2C-55.970503091812134%2C-31.70747746408136&amp;layer=mapnik&amp;marker=-31.711612119025453%2C-55.979461669921875" style="border: 1px solid black"></iframe><br/><small><a href="http://www.openstreetmap.org/?mlat=-31.71161&amp;mlon=-55.97946#map=17/-31.71161/-55.97946">Ver mapa m&aacute;s grande</a></small>
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
