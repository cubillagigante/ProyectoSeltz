<?php
	
	require 'conexion.php';
	
	$cliente = $_GET['id_cliente'];
	$producto = $_GET['id_producto'];
	$precio_v = $_GET['precio_v'];
	$estado = 'PENDIENTE';
	$fecha = date("d/m/y");
	$nun_ven = $_GET['num_ven'];
	$venta = 1 + $nun_ven;	
	$sql = "INSERT INTO pedidos(cliente, producto, precio_pro, estado, fecha, num_ven) VALUES 
	('$cliente', '$producto','$precio_v','$estado','$fecha', '$venta')";
	$resultado = $mysqli->query($sql);
	

	header("location: ../sistema/cliente/pedido.php");
?>
 

