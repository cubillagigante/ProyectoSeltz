<?php
	
	require 'conexion.php';
 
	$id = $_GET['id_pedido'];
	
	$sql = "DELETE FROM pedidos WHERE id_pedido = '$id'";
	$resultado = $mysqli->query($sql);

	header("location: ../sistema/cliente/pedido.php");
	
?>
 
