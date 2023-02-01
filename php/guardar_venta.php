<?php
	
	require 'conexion.php';
	
	$cliente = $_GET['id_cliente'];
	$fecha = date("d/m/y");
	$total = $_GET['total'];
	$estado_fac = 'Activo';
	$nun_ven = $_GET['num_ven'];
	$venta = 1 + $nun_ven;	
	
	$sql = "INSERT INTO venta(fecha_venta, total, estado_fac, numero_venta, id_clis) VALUES 
	('$fecha', '$total','$estado_fac','$venta','$cliente')";
	$resultado = $mysqli->query($sql);
	

	header("location: ../sistema/cliente/pedido.php");
?>
 

