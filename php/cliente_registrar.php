<?php
	
	require 'conexion.php';
	
	$nombre_producto = $_POST['nombre_cliente'];
	$descripcion = $_POST['direccion'];
	$cantidad = $_POST['ci'];
	$precio_c = $_POST['ruc'];
	$precio_v = $_POST['telefono'];
	$id_proveedor = $_POST['celular'];
		
	$sql = "INSERT INTO cliente(nombre_cliente, direccion, ci, ruc, telefono, celular, usuario_cliente) VALUES 
	('$nombre_producto', '$descripcion', '$cantidad', '$precio_c', '$precio_v', '$id_proveedor','1')";
	$resultado = $mysqli->query($sql);
	
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