<?php
	
	require 'conexion.php';
	
	$nombre_funcionario = $_POST['nombre_funcionario'];
	$ci = $_POST['ci'];
	$genero = $_POST['genero'];
	$telefono = $_POST['telefono'];
	$celular = $_POST['celular'];
	$direccion = $_POST['direccion'];
	$registro_auto = $_POST['registro_auto'];
	$cargo = $_POST['cargo'];
	$id_usuario = $_POST['id_usuario'];
		
	$sql = "INSERT INTO funcionario(nombre_funcionario, ci, genero, telefono, celular, direccion, registro_auto, cargo, usuario_funcionario) VALUES 
	('$nombre_funcionario', '$ci', '$genero', '$telefono', '$celular','$direccion', '$registro_auto', '$cargo', '$id_usuario')";
	$resultado = $mysqli->query($sql);
	
		$sql1 = "UPDATE usuarios SET estado ='activo' WHERE id_usuario = '$id_usuario'";
	$resultado1 = $mysqli->query($sql1);
 
if($resultado > 0 and $resultado1 > 0){
        
header("location: ../sistema/funcionario/index.php");
        
} else { 
        "<h3>ERROR AL GUARDAR</h3> <a href=logueo/index.php >SIGUIENTE</a>";
         
    } 
	
?>
 
<html lang="es">
	<head>
	<title>Seltz</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.css" rel="stylesheet">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script> 
  	

	</head>
	<style type="text/css">
		 body {
        font-family: "Swis721 BlkCn BT";

      }
  	</style>
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado) { ?>
						<h3>REGISTRO GUARDADO</h3>
						<?php } else { ?>
						<h3>ERROR AL GUARDAR</h3>
					<?php } ?>
					
					<a href="../sistema/logueo/R001.php" class="btn btn-primary">Regresar</a>
					
				</div>
			</div>
		</div>
	</body>
</html>