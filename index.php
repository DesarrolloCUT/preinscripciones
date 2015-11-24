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
    	var x = document.forms["myForm2"]["id_reserva"].value;
	    if (x==null || x=="") {
	        alert("El nro. de reserva es un dato que debe ingresar");
		document.forms["myForm2"]["id_reserva"].focus();
	        return false;
	    }
	    
	}
    function validateForm2() {
    	var x = document.forms["myForm3"]["id_reserva"].value;
	    if (x==null || x=="") {
	        alert("El nro. de reserva es un dato que debe ingresar");
		document.forms["myForm3"]["id_reserva"].focus();
	        return false;
	    }
	    
	}
</script>
  </head>    
     <body role="document">
	  <div class="container theme-showcase" role="main">
	    <!-- Main jumbotron for a primary marketing message or call to action -->
	    <div class="page-header">
	      <h1>Preinscripciones 2015</h1>
	      <h2>Carreras en la Sede Tacuaremb&oacute; de la UdelaR.</h2>
	    </div>
	    
		<div class="row">
			    <div class="col-sm-4">
				    <div class="panel panel-primary">
					    <div class="panel-heading">
					             <h3 class="panel-title">Realizar una reserva nueva</h3>
					    </div>	
					    <form role="form" method="post" action="nueva_reserva.php" id="myForm">		           
				        <div class="panel-body">
				             	<div class="form-group">
				               		<input type="submit" class="btn btn-lg btn-primary" name="aceptar" id="aceptar" value="ACEPTAR"/>
				               	</div>
				        </div>
				        </form>
				    </div>
			 	</div>
			 	<div class="col-sm-4">
			 		<div class="panel panel-success">
					    <div class="panel-heading">
					             <h3 class="panel-title">Editar una reserva existente</h3>
					    </div>	
					    <form role="form" method="post" action="editar_reserva.php" id="myForm2" onsubmit="return validateForm()">		           
				        <div class="panel-body">
				             	<div class="form-group">
				             		<label for="name">Ingrese el numero de reserva(*): </label>
				             		<input type="text" class="form-control" name="id_reserva" id="id_reserva"/>
				               		
				               	</div>
				               	<div class="form-group">
				               		<input type="submit" class="btn btn-lg btn-success" name="aceptar" id="aceptar" value="ACEPTAR" />
				               	</div>
				        </div>
				        </form>
				    </div>
			 	</div>
			 	<div class="col-sm-4">
			 		<div class="panel panel-danger">
					    <div class="panel-heading">
					             <h3 class="panel-title">Borrar una reserva existente</h3>
					    </div>	
					    <form role="form" method="post" action="borrar_reserva.php" id="myForm3" onsubmit="return validateForm2()">		           
				        <div class="panel-body">
				             	<div class="form-group">
				             		<label for="name">Ingrese el numero de reserva(*): </label>
				             		<input type="text" class="form-control" name="id_reserva" id="id_reserva"/>
				               		
				               	</div>
				               	<div class="form-group">
				               		<input type="submit" class="btn btn-lg btn-danger" name="aceptar" id="aceptar" value="ACEPTAR" />
				               	</div>
				        </div>
				        </form>
				    </div>
			 	</div>
		</div>    
	  </div>
	
	</body>
	</html>