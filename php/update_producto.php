<?php
	
	require 'conexion.php';
	
    $id= $_POST['id_producto'];
	$nombre = $_POST['nombre_producto'];
	$descripcion = $_POST['descripcion'];
	$cantidad = $_POST['cantidad'];
	$precio_c = $_POST['precio_c'];
	$precio_v = $_POST['precio_v'];
	$id_proveedor = $_POST['id_proveedor'];
		
	$sql = "UPDATE producto SET nombre_producto='$nombre', descripcion='$descripcion', cantidad='$cantidad', precio_c='$precio_c', precio_v = '$precio_v', id_proveedor='$id_proveedor' WHERE id_producto = '$id'";
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
						<h3>REGISTRO MODIFICADO</h3>
						<?php } else { ?>
						<h3>ERROR AL MODIFICAR</h3>
					<?php } ?>
					
					<a href="../sistema/gerente/g001.php" class="btn btn-primary">Regresar</a>
					
				</div>
			</div>
		</div>
	</body>
</html>