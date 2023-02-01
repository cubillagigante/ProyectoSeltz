<?php
	
	require 'conexion.php';
	
    
	
	//$rs = mysql_query("SELECT MAX(id_producto) AS id_producto FROM producto");
	//if ($row = mysql_fetch_row($rs)) {
	//$id = trim($row[0]);
	//}
		
	$rs = mysql_query("SELECT @@identity AS id_producto");
	if ($row = mysql_fetch_row($rs)) {
	$id = trim($row[0]);
	}
		
	$sql1 = "UPDATE producto SET ruta_imagen = '$nombreimg' where id_producto = '$rs'";
  	$result = $mysqli->query($sql1);

	header("location: ../sistema/gerente/lista_de_productos.php");
?>
	
 
