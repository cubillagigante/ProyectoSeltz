<?php

	
	require 'conexion.php';
	


    $nombre_p = $_POST['nombre_cliente'];
	$direccion = $_POST['direccion'];
	$ci = $_POST['ci'];
    $ruc = $_POST['ruc'];
    $telefono = $_POST['telefono'];
    $celular = $_POST['celular'];
    $id_usuario = $_POST['id_usuario'];
    
	
	
	$sql = "INSERT INTO cliente (nombre_cliente, direccion, ci, ruc, telefono, celular, usuario_cliente) VALUES ('$nombre_p', '$direccion', '$ci', '$ruc', '$telefono', '$celular', '$id_usuario')";
	$resultado = $mysqli->query($sql);
 
   	$sql1 = "UPDATE usuarios SET estado ='activo' WHERE id_usuario = '$id_usuario'";
	$resultado1 = $mysqli->query($sql1);
 
if($resultado > 0 and $resultado1 > 0){
        
header("location: ../sistema/cliente/index.php");
        
} else { 
        "<h3>ERROR AL GUARDAR</h3> <a href=logueo/index.php >SIGUIENTE</a>";
         
    } 
	
?>