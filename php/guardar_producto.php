<?php
	
	require 'conexion.php';
	
	$nombre_producto = $_POST['nombre_producto'];
	$descripcion = $_POST['descripcion'];
	$cantidad = $_POST['cantidad'];
	$precio_c = $_POST['precio_c'];
	$precio_v = $_POST['precio_v'];
	$id_proveedor = $_POST['id_proveedor'];
	
	
	
	 
  	$sql = "INSERT INTO producto(nombre_producto, descripcion, cantidad, precio_c, precio_v, id_proveedor, ruta_imagen) VALUES 
	('$nombre_producto', '$descripcion', '$cantidad', '$precio_c', '$precio_v', '$id_proveedor','vacio')";
	$resultado = $mysqli->query($sql);
	
	$id_insert = $mysqli->insert_id;
  
  	if($_FILES["archivo"]["error"]>0){
    echo "Error al cargar archivo"; 
    } else {
    
    $permitidos = array("image/jpeg","image/gif","image/png");
    $limite_kb = 200;
    
    if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){
      
      $ruta = '../sistema/gerente/files/'.$id_insert.'-';
      $archivo = $ruta.$_FILES["archivo"]["name"];
      $nombreimg = $_FILES["archivo"]["name"];
      if(!file_exists($ruta)){
        mkdir($ruta);
      }
      
      if(!file_exists($archivo)){
        
        $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
        
        if($resultado){
          echo "Archivo Guardado";
          } else {
          echo "Error al guardar archivo";
        }
        
        } else {
        echo "Archivo ya existe";
      }
      
      } else {
      echo "Archivo no permitido o excede el tamaño";
    }
    
  }
 



	$sql1 = "UPDATE producto SET ruta_imagen = '$nombreimg' where id_producto = '$id_insert'";
  	$result = $mysqli->query($sql1);


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
						<h3>PRODUCTO GUARDADO</h3>
						<?php } else { ?>
						<h3>ERROR AL GUARDAR</h3>
					<?php } ?>
					
					<a href="../sistema/gerente/lista_de_productos.php" class="btn btn-primary">Regresar</a>
					
				</div>
			</div>
		</div>
	</body>
</html>