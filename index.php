<?php 
	include 'class/persistencia.php';
	setlocale(LC_TIME, 'es_ES.UTF-8');
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
    
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="bootstrap/assets/js/jquery-2.1.4.min.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script>
    $(document).ready(function(){
    	
    	$('#panelFecha').hide();
    	$('#panelHora').hide();
		$("#siguiente1").on( "click", function() {
			$('#panelFecha').show(); //muestro mediante id
			$('#fecha').focus(); //pongo el foco en el control
		 });
		$("#siguiente2").on( "click", function() {
			$('#panelHora').show(); //muestro mediante id
			$('#hora').focus(); //pongo el foco en el control

		});
	});
	</script>
	<script>
    function validateForm() {
    	var x = document.forms["myForm"]["cedula"].value;
	    if (x==null || x=="") {
	        alert("La cedula es un dato que debe ingresar");
		document.forms["myForm"]["cedula"].focus();
	        return false;
	    }
	    x = document.forms["myForm"]["nombre"].value;
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
<script>
       $(function(){
                $('#fecha').change(function(){
                    console.log($(this));
                    $.get( "getTimeFromDate.php" , { option : $(this).val() } , function ( data ) {
                        $ ( '#hora' ) . html ( data ) ;
                    } ) ;
                });
       });
 </script>
  </head>

  <body role="document">
	  <div class="container theme-showcase" role="main">
	    <!-- Main jumbotron for a primary marketing message or call to action -->
	    <div class="page-header">
	      <h1>Preinscripciones 2015</h1>
	      <h2>Carreras en la Sede Tacuaremb&oacute; de la UdelaR.</h2>
	    </div>
	    <form role="form" method="post" action="confirmar.php" id="myForm" onsubmit="return validateForm()">
		    <div class="row">
			    <div class="col-sm-4">
			    <div class="panel panel-primary">
					
			           <div class="panel-heading">
			             <h3 class="panel-title">Datos personales</h3>
			           </div>			           
			           <div class="panel-body">
			             	<label><i>Ingrese sus datos presonales. Los campos marcados con * son obligatorios.</i></label>
			             	<div class="form-group">
			               		<label for="name">C&eacute;dula de identidad*: </label>
			               		<input type="text" class="form-control" name="cedula" id="cedula"/>
			               	</div>
			             	<div class="form-group">
			               		<label for="name">Nombre*: </label>
			               		<input type="text" class="form-control" name="nombre" id="nombre"/>
			               	</div>
			               <div class="form-group">
			               		<label for="apellido">Apellido*: </label>
			               		<input type="text" class="form-control" name="apellido" id="apellido"/>
			               </div>
			               <div class="form-group">
			               		<label for="ciudad">Ciudad/Localidad de Origen: </label>
			               		<input type="text" class="form-control" name="procedencia" id="procedencia"/>
			               </div>
			               <div class="form-group">
			               		<label for="telefono">Tel&eacute;fono: </label>
			               		<input type="text" class="form-control" name="telefono" id="telefono"/>
			               </div>
			               <div class="form-group">
			               		<label for="email">E-mail*: </label>
			               		<input type="text" class="form-control" name="email" id="email"/>
			               </div>
			               <div class="form-group">    
			               <label for="carrera">Carrera a inscribirse: </label>
			           		<select class="form-control" name="carrera" id="carrera">
			           			    <?php 
                                    $p = new Persistencia();
                                    
                                    $result = $p->getCarreras();

                                    foreach ($result as $row){?>
                                    	<option value="<?=$row['id']?>"><?=$row['nombre']?></option>
                                    <?php } ?>
			           		</select>
			           		</div>
			               <div class="form-group">
			               		<button type="button"  id="siguiente1" class="btn btn-lg btn-primary">Elegir fecha</button>
			               </div>
			             
			
			           </div>
			    </div>
			    </div>
			    <div class="col-sm-4">
			    <div class="panel panel-primary" id="panelFecha">
			
			           <div class="panel-heading">
			             <h3 class="panel-title">Fecha</h3>
			           </div>
			           
			           <div class="panel-body">
			           	<label><i>Elija una fecha para su inscripci&oacute;n. Solo se mostrar&aacute;n las disponibles.</i></label>
			           	<div class="form-group">    
			           		<select class="form-control" name="fecha" id="fecha">

			           			<?php 
                                    $p = new Persistencia();

                                    $result = $p->getDates();

                                    foreach ($result as $row){?>
                                    	<option value="<?=$row['id']?>"><?=$row['fecha']?></option>
                                 <?php } ?>
			           		</select>
			           	</div>
			           	<div class="form-group">
			               		<button type="button"  id="siguiente2" class="btn btn-lg btn-primary">Elegir horario</button>
			            </div>
			           </div>
			    </div>
			    </div>
			    <div class="col-sm-4">
		    <div class="panel panel-primary" id="panelHora">
		
		           <div class="panel-heading">
		             <h3 class="panel-title">Horario</h3>
		           </div>
		           <div class="panel-body">
		           	<label><i>Elija una hora para su inscripci&oacute;n. Solo se mostrar&aacute;n las disponibles para la fecha previamente elegida.</i></label>
		            <div class="form-group">    
			           		<select class="form-control" name="hora" id="hora">
			           			<option>10:00</option>
			           		</select>
			        </div>
		            <div class="form-group">
			               		<button type="submit" id="siguiente3" class="btn btn-lg btn-primary">Siguiente</button>
			        </div>
		           </div>
		    </div>
		    </div>
		    </div>
		    <!--<div class="form-group">
				<button type="submit" class="btn btn-lg btn-primary" id="btnEnviar" >Enviar</button>
			</div>-->
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
