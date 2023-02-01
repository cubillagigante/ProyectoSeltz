<?php
	
	require 'conexion.php';
	
	$usuario = $_POST['user'];
	$clave = $_POST['pass'];
	
	
	$sql = "INSERT INTO usuarios (user, pass, estado, id_tipo_usuario) VALUES ('$usuario', '$clave', 'inactivo','1')";
	$resultado = $mysqli->query($sql);
   
if($resultado) { 
        
header("location: ../sistema/logueo/index.php");
        
} else { 
        "<h3>ERROR AL GUARDAR</h3> <a href=../logueo.php >SIGUIENTE</a>";
         
    } 
	
?>