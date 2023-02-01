<?php
	
	require 'conexion.php';
	
    $id = $_GET['id_pedido'];
	
	
		
	$sql = "UPDATE pedidos SET estado = 'CONCRETADO' WHERE id_pedido = '$id'";
	$resultado = $mysqli->query($sql);

	header("location: ../sistema/funcionario/index.php");
?>
	
 
