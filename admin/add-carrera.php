<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-save']))
{
	$nombre = $_POST['nombre'];
	$documentacion = $_POST['documentacion'];
	
	if($crud->createCarrera($nombre,$documentacion))
	{
		header("Location: add-carrera.php?inserted");
	}
	else
	{
		header("Location: add-carrera.php?failure");
	}
}
?>
<?php include_once 'header_withoutMenu.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
    <strong>Registro insertado con &eacute;xito</strong>
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>¡ERROR!</strong> mientras se actualizaba el registro.
	</div>
	</div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Nombre</td>
            <td><input type='text' name='nombre' class='form-control' value="<?=$nombre?>" required></td>
        </tr>
 
        <tr>
            <td>Documentaci&oacute;n</td>
            <td><textarea rows="20" cols="50" name='documentacion' class='form-control'><?=$documentacion?></textarea></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Crear Nuevo Registro
        </tr>
 
    </table>
</form>
     
     
</div>
