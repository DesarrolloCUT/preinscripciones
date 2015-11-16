<?php
include_once 'dbconfig.php';
include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<!--  <a href="add-data.php?type=reserva" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Agregar Reserva</a>-->
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th># de Reserva</th>
     <th>C&eacute;dula</th>
     <th>Nombre</th>
     <th>Apellido</th>
     <th>E-mail</th>
     <th>Tel&eacute;fono</th>
     <th>Procedencia</th>
     <th>Carrera</th>
     <th>Fecha</th>
     <th>Hora</th>
     <th colspan="2" align="center"></th>
     </tr>
     <?php
		$query = "SELECT * FROM v_reservas";       
		$records_per_page=3;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataviewReservas($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'footer.php'; ?>