<?php
	
	require 'conexion.php';
	
	$usuario = $_POST['user'];
	$clave = $_POST['pass'];
	
	
	$sql = "INSERT INTO usuarios (user, pass, estado, id_tipo_usuario) VALUES ('$usuario', '$clave', 'inactivo','5')";
	$resultado = $mysqli->query($sql);
   
if($resultado) { 
         $_SESSION['username'] = $usuario;	
$data = mysqli_fetch_array($query);
				print_r($data);
				$_SESSION['active'] = true;
				$_SESSION['id'] = $data['id'];
				$_SESSION['user'] = $data['user'];
				$_SESSION['pass'] = $data['pass']; 
                $_SESSION['estado'] = $data['estado']; 
                $_SESSION['id_tipo_usuario'] = $data['id_tipo_usuario']; 
header("location: ../sistema/gerente/index.php");
        
} else { 
        "<h3>ERROR AL GUARDAR</h3> <a href=../logueo.php >SIGUIENTE</a>";
         
    } 
	
?>
?>