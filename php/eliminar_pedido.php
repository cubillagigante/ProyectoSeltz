<?php
	require 'conexion.php';
 
	$id = $_GET['id_venta'];
	
	$sql = "DELETE FROM venta WHERE id_venta = '$id'";
	$resultado = $mysqli->query($sql);
	
	
	header("location: ../sistema/cliente/pedidos realizados.php");
	
?>
 