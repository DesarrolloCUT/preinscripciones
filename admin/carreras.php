<?php
include_once 'dbconfig.php';
include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-carrera.php" class="btn btn-large btn-info lightview" ><i class="glyphicon glyphicon-plus"></i> &nbsp; Agregar Carrera</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>	
     <tr>
     <th># de Carrera</th>
     <th>Nombre</th>
     <th>Documentaci&oacute;n</th>
     <th colspan="2" align="center"></th>
     </tr>
     <?php
		$query = "SELECT * FROM carreras";       
		$records_per_page=10;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataviewCarreras($newquery);
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