<?php
	
	require 'conexion.php';
	
    $id= $_POST['id_cliente'];
	$nombre = $_POST['nombre_cliente'];
	$direccion = $_POST['direccion'];
	$ci = $_POST['ci'];
	$ruc = $_POST['ruc'];
	$telefono = $_POST['telefono'];
	$celular = $_POST['celular'];
		
	$sql = "UPDATE cliente SET nombre_cliente='$nombre', direccion='$direccion', ci='$ci', ruc = '$ruc', telefono ='$telefono', celular ='$celular' WHERE id_cliente = '$id'";
	$resultado = $mysqli->query($sql);

	header("location: ../sistema/cliente/perfil.php");
?>
	
 
