<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
	$nombre = $_POST['nombre'];
	$documentacion = $_POST['documentacion'];
	
	if($crud->updateCarrera($id,$nombre,$documentacion))
	{
		$msg = "<div class='alert alert-info'>
				<strong>Registro actualizado con &eacute;xito</strong>  <a href='index.php'>INICIO</a>
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>¡ERROR!</strong>  mientras se actualizaba el registro.
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud->getIDCarrera($id));	
}

?>
<?php include_once 'header_withoutMenu.php'; ?>


<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 
     <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Nombre</td>
            <td><input type='text' name='nombre' class='form-control' value="<?php echo $nombre; ?>" required></td>
        </tr>
 
        <tr>
            <td>Documentaci&oacute;n</td>
            <td><textarea rows="20" cols="50" name='documentacion' class='form-control'><?php echo $documentacion; ?></textarea></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Actualizar este registro
				</button>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>
