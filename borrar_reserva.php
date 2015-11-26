<?php 
	include 'class/persistencia.php';
	setlocale(LC_TIME, 'es_ES.UTF-8');
	
	session_start();
	$verifica = 1;
	$_SESSION["verifica"] = $verifica;
	
	$id_reserva = $_REQUEST['id_reserva'];
	
	$p = new Persistencia();
	
	$reserva = $p->findBooking($id_reserva);
	
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
    
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
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
	    <?php if ($reserva!=0){
	    	
	    	$nomCarrera = $p->findNameCarreraFromId($reserva['id_recurso']);
	    	$cedula = $reserva['id_usuario'];
	    	$fecha = utf8_decode($p->getDateFromId($reserva['id_fecha']));
	    	$hora = $p->getTimeFromId($reserva['id_hora']);
	    	
	    	$usuario = $p->findUser($cedula);
	    	$nombre = $usuario['nombre'];
	    	$apellido = $usuario['apellido'];
	    	$procedencia = $usuario['procedencia'];
	    	$telefono = $usuario['telefono'];
	    	$email = $usuario['email'];
	    	
	    ?>

	    <div class="page-header">
	      <h1>Preinscripciones 2016</h1>
	      <h2>Editar la reserva a preinscripci&oacute;n Nro. <?=$id_reserva?></h2>
	    </div>
	    <form role="form" method="post" action="resumen3.php" id="myForm" onsubmit="return validateForm()">
		    <div class="row">
		    <div class="col-sm-4">
			    <div class="panel panel-danger">
			           <div class="panel-heading">
			             <h3 class="panel-title">Ser&aacute;n borrados los siguientes datos personales</h3>
			           </div>			           
			           <div class="panel-body">
			             	
			             	<div class="form-group">
			               		<label for="name">C&eacute;dula de identidad: <?=$cedula?></label>			  
			               	</div>
			             	<div class="form-group">
			               		<label for="name">Nombre: <?=$nombre?></label>
			               	</div>
			               <div class="form-group">
			               		<label for="apellido">Apellido: <?=$apellido?></label>
					       </div>
			               <div class="form-group">
			               		<label for="ciudad">Ciudad/Localidad de Origen: <?=$procedencia?></label>
			               </div>
			               <div class="form-group">
			               		<label for="telefono">Tel&eacute;fono: <?=$telefono?></label>
			               </div>
			               <div class="form-group">
			               		<label for="email">E-mail: <?=$email?></label>
			               </div>
			           </div>

			    </div>
			    </div>
			     <div class="col-sm-4">
			     <div class="panel panel-danger">
			           <div class="panel-heading">
			             <h3 class="panel-title">Ser&aacute; borrada la siguiente reserva</h3>
			           </div>			           
			           <div class="panel-body">
			            <div class="form-group">    
			               <label for="carrera">Carrera a inscribirse: <?=$nomCarrera?></label>
			           	   </div>	
			           	   <div class="form-group">    
			               <label for="carrera">Fecha reservada: <?=$fecha?></label>
			           	   </div>	
			           	   <div class="form-group">    
			               <label for="carrera">Hora reservada: <?=$hora?></label>
			           	   </div>
			           </div>
			     </div>
			     <div class="form-group">
			               		<button type="submit" id="borrar" class="btn btn-lg btn-danger">BORRAR</button>
			        </div>
			</div>    
				
		    </div>
			<input type="hidden"  name="cedula" value="<?=$cedula?>"/>
	    	<input type="hidden"  name="nombre" value="<?=$nombre?>"/>
            <input type="hidden"  name="apellido" value="<?=$apellido;?>"/>
            <input type="hidden"  name="telefono" value="<?=$telefono?>"/>
            <input type="hidden"  name="procedencia" value="<?=$procedencia?>"/>
            <input type="hidden"  name="email" value="<?=$email?>"/>
            <input type="hidden"  name="nomCarrera" value="<?=$nomCarrera?>"/>
            <input type="hidden"  name="fecha" value="<?=$fecha?>"/>
            <input type="hidden"  name="hora" value="<?=$hora?>"/>
            <input type="hidden"  name="id_reserva" value="<?=$id_reserva?>"/>
	    </form>
	    <?php }
	    	else{?>
	    <div class="page-header">
	      <h1>Preinscripciones 2015</h1>
	      <h2>La reserva Nro. <?=$id_reserva?> no existe. Contactese con el soporte del sitio informatica@cut.edu.uy o ingrese una nueva.</h2>
	    </div>	
	    <?php }?>
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
