<?php

include "../conf/config.php";

try {

	$conn = new PDO('mysql:host=localhost;dbname=bedelia', 'root', 'root');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$where =" 1=1 ";
	$order_by="id";
	$rows=25;
	$current=1;
	$limit_l=($current * $rows) - ($rows);
	$limit_h=$limit_lower + $rows  ;
	
	
	//Handles Sort querystring sent from Bootgrid
	if (isset($_REQUEST['sort']) && is_array($_REQUEST['sort']) )
	  {
	    $order_by="";
	    foreach($_REQUEST['sort'] as $key=> $value)
			$order_by.=" $key $value";
		}
	
	//Handles search  querystring sent from Bootgrid 
	if (isset($_REQUEST['searchPhrase']) )
	  {
	    $search=trim($_REQUEST['searchPhrase']);
	  	$where.= " AND ( cedula LIKE '".$search."%' OR  carrera LIKE '".$search."%' OR  fecha LIKE '".$search."%' ) "; 
		}
	
	//Handles determines where in the paging count this result set falls in
	if (isset($_REQUEST['rowCount']) )  
	  $rows=$_REQUEST['rowCount'];
	
	 //calculate the low and high limits for the SQL LIMIT x,y clause
	  if (isset($_REQUEST['current']) )  
	  {
	   $current=$_REQUEST['current'];
		$limit_l=($current * $rows) - ($rows);
		$limit_h=$rows ;
	   }
	
	if ($rows==-1)
	$limit="";  //no limit
	else   
	$limit=" LIMIT $limit_l,$limit_h  ";
	   
	//NOTE: No security here please beef this up using a prepared statement - as is this is prone to SQL injection.
	//$sql="SELECT id, replace(movie,'\"','' ) as movie, year, rating_imdb,genre FROM films WHERE $where ORDER BY $order_by $limit";
	$sql="SELECT * FROM v_reservas WHERE ".$where." ORDER BY ".$order_by.$limit;
	//echo $sql;
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$results_array=$stmt->fetchAll(PDO::FETCH_ASSOC);
	//print_r($results_array);
	$json=json_encode( $results_array );
	//echo $json;
	
	$nRows=$conn->query("SELECT count(*) FROM v_reservas WHERE ".$where)->fetchColumn();   /* specific search then how many match */
	
	header('Content-Type: application/json'); //tell the broswer JSON is coming
	
	if (isset($_REQUEST['rowCount']) )  //Means we're using bootgrid library
		echo "{ \"current\":  $current, \"rowCount\":$rows,  \"rows\": ".$json.", \"total\": $nRows }";
	else
		echo $json;  //Just plain vanillat JSON output 
	exit;
}
catch(PDOException $e) {
    echo 'SQL PDO ERROR: ' . $e->getMessage();
}
?>