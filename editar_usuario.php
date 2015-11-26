<?php 
	session_start();
	function formateoCedula($cadena){
	
		$cadena = str_replace(' ', '', $cadena);
		$cadena = str_replace('.', '', $cadena);
		$cadena = str_replace('-', '', $cadena);
		return $cadena;
	}
	include 'class/persistencia.php';
	setlocale(LC_TIME, 'es_ES.UTF-8');
	
	$p = new Persistencia();
	
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
    
	<script>
    function validateForm() {

	    var x = document.forms["myForm"]["nombre"].value;
	    if (x==null || x=="") {
	        alert("El Nombre es un dato que debe ingresar");
		document.forms["myForm"]["nombre"].focus();
	        return false;
	    }
	    x = document.forms["myForm"]["apellido"].value;
	    if (x==null || x=="") {
	        alert("El Apellido es un dato que debe ingresar");
		document.forms["myForm"]["apellido"].focus();
	        return false;
	    }
	    x = document.forms["myForm"]["telefono"].value;
	    if (x==null || x=="") {
	        alert("El Telefono es un dato que debe ingresar");
		document.forms["myForm"]["telefono"].focus();
	        return false;
	    }
	    x = document.forms["myForm"]["procedencia"].value;
	    if (x==null || x=="") {
	        alert("La ciudad/localidad de procedencia es un dato que debe ingresar");
		document.forms["myForm"]["procedencia"].focus();
	        return false;
	    }
	    x = document.forms["myForm"]["email"].value;
	    if (x==null || x=="") {
	        alert("El Email es un dato que debe ingresar");
		document.forms["myForm"]["email"].focus();
	        return false;
	    }
	}
</script>

  </head>

  <body role="document">
	  <div class="container theme-showcase" role="main">
	    <!-- Main jumbotron for a primary marketing message or call to action -->
	    <?php
	    if(isset($_REQUEST['id_user'])){
	    	$_SESSION['id_reserva']=$_REQUEST['id_reserva'];
	    	$cedula= $_REQUEST['id_user'];
	    	$usuario = $p->findUser($cedula);
	    
		    $nombre = $usuario['nombre'];
		    $apellido = $usuario['apellido'];
		    $procedencia = $usuario['procedencia'];
		    $telefono = $usuario['telefono'];
		    $email = $usuario['email'];
	    }else {

		    $cedula = formateoCedula($_REQUEST['cedula']);
		    $nombre = $_REQUEST['nombre'];
		    $apellido = $_REQUEST['apellido'];
		    $procedencia = $_REQUEST['procedencia'];
		    $telefono = $_REQUEST['telefono'];
		    $email = $_REQUEST['email'];
		    
		    $p->editUser($cedula, $nombre, $apellido, $procedencia, $telefono, $email);
		    unset($_REQUEST);
	    }
	    ?>

	    <div class="page-header">
	      <h1>Preinscripciones 2016</h1>
	      <h2>Editar los datos del usuario con C&eacute;dula <?=$cedula?></h2>
	    </div>
	    <form role="form" method="post" action="editar_usuario.php"  id="myForm" onsubmit="return validateForm()">
		    <div class="row">
			    <div class="col-sm-4">
			    	<div class="panel panel-primary">
					   <div class="panel-heading">
			             <h3 class="panel-title">Datos personales</h3>
			           </div>			           
			           <div class="panel-body">
			             	
			             	<label><i>Ingrese sus datos presonales. Los campos marcados con * son obligatorios.</i></label>
			             	
			             	<div class="form-group">
			               		<label for="name">Nombre*: </label>
			               		<input type="text" class="form-control" name="nombre" id="nombre" value="<?=$nombre?>"/>
			               	</div>
			               <div class="form-group">
			               		<label for="apellido">Apellido*: </label>
			               		<input type="text" class="form-control" name="apellido" id="apellido" value="<?=$apellido?>"/>
			               </div>
			               <div class="form-group">
			               		<label for="ciudad">Ciudad/Localidad de Origen*: </label>
			               		<input type="text" class="form-control" name="procedencia" id="procedencia" value="<?=$procedencia?>"/>
			               </div>
			               <div class="form-group">
			               		<label for="telefono">Tel&eacute;fono*: </label>
			               		<input type="text" class="form-control" name="telefono" id="telefono" value="<?=$telefono?>"/>
			               </div>
			               <div class="form-group">
			               		<label for="email">E-mail*: </label>
			               		<input type="text" class="form-control" name="email" id="email" value="<?=$email?>"/>
			               </div>	
			                <div class="form-group">
			               		<button type="submit" id="aceptar" class="btn btn-lg btn-primary">Aceptar</button>
			        		</div>
			        		<div class="form-group">
			        		<a href="editar_reserva.php?id_reserva=<?=$_SESSION['id_reserva']?>">
			        			<button type="button" id="regresar" class="btn btn-lg btn-primary">Regresar a la p&aacute;gina anterior</button></a>             
			
			           </div>
			    	</div>
			    </div>
			    		           
		    </div>
			<input type="hidden"  name="cedula" value="<?=$cedula?>"/>
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
