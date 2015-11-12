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
	       $(function(){
	           $('#carrera').change(function(){
	               console.log($(this));
	               $.get( "getDateFromRecurse.php" , { option : $(this).val() } , function ( data ) {
	                   $ ( '#fecha' ) . html ( data ) ;
	               } ) ;
	           });
	  });
 </script>
  </head>

  <body role="document">
	  <div class="container theme-showcase" role="main">
	    <!-- Main jumbotron for a primary marketing message or call to action -->
	    <?php if ($reserva!=0){
	    	
	    	$carrera = $reserva['id_recurso'];
	    	$cedula = $reserva['id_usuario'];
	    	$id_fecha = $reserva['id_fecha'];
	    	$id_hora = $reserva['id_hora'];
	    	
	    	$usuario = $p->findUser($cedula);
	    	$nombre = $usuario['nombre'];
	    	$apellido = $usuario['apellido'];
	    	$procedencia = $usuario['procedencia'];
	    	$telefono = $usuario['telefono'];
	    	$email = $usuario['email'];
	    	
	    ?>

	    <div class="page-header">
	      <h1>Preinscripciones 2015</h1>
	      <h2>Editar la reserva a preinscripci&oacute;n Nro. <?=$id_reserva?></h2>
	    </div>
	    <form role="form" method="post" action="resumen.php" id="myForm" onsubmit="return validateForm()">
		    <div class="row">
			    <div class="col-sm-4">
			    <div class="panel panel-primary">
					
			           <div class="panel-heading">
			             <h3 class="panel-title">Datos personales</h3>
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
			               <div class="form-group">
			               		<a href="editar_usuario.php?id_user=<?=$cedula?>&id_reserva=<?=$id_reserva?>">Editar los datos del usuario</a>
			               </div>
			               <div class="form-group">    
			               <label for="carrera">Carrera a inscribirse: </label>
			           		<select class="form-control" name="carrera" id="carrera" value="<?=$carrera?>">
			           				<!-- <option >Seleccione una carrera</option> -->
			           			    <?php 
                                                                        
                                    $result = $p->getCarreras();

                                    foreach ($result as $row){?>
                                    	<option value="<?=$row['id']?>"<?php echo ($carrera == $row['id'])?'selected=selected"':'';?>><?=$row['nombre']?></option>
                                    <?php } ?>
			           		</select>
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
                                                                        
                                    $datos = $p->dateResourceAvailable($carrera);
									foreach ($datos as $fila){?>
										<option value="<?=$fila['id']?>"<?php echo ($fila['id']==$id_fecha)?'selected="selected"':''?>><?=utf8_decode($fila['fecha'])?></option>
                                <?php } ?>
			           		</select>
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
			           			<option value="<?=$id_hora?>" selected="selected"><?=$p->getTimeFromId($id_hora)?></option>
			           			<?php
									
									$datos2 = $p->getTimeOnTheDate($id_fecha);

									foreach ($datos2 as $fila2){?>
										<option value="<?=$fila2['id_horario']?>"><?=$fila2['hora']?></option>
								<?php } ?>
			           		</select>
			        </div>
		            <div class="form-group">
			               		<button type="submit" id="siguiente3" class="btn btn-lg btn-primary">Siguiente</button>
			        </div>
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
            <input type="hidden"  name="reserva_realizada" value="<?=$id_reserva?>"/>
	    </form>
	    <?php }
	    	else{?>
	    <div class="page-header">
	      <h1>Preinscripciones 2015</h1>
	      <h2>La reserva Nro. <?=$id_reserva?> no existe. Contactese con el soporte del sitio reservas@cut.edu.uy o ingrese una nueva.</h2>
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
