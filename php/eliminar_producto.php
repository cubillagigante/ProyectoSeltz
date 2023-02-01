<?php
	require 'conexion.php';
 
	$id = $_GET['id_producto'];
	
	$sql = "DELETE FROM producto WHERE id_producto = '$id'";
	$resultado = $mysqli->query($sql);
	
	eliminarDir('../sistema/gerente/files/'.$id);
	
	function eliminarDir($carpeta)
	{
		foreach(glob($carpeta . "/*") as $archivos_carpeta)
		{
			if (is_dir($archivos_carpeta))
			{
				eliminarDir($archivos_carpeta);
			}
			else
			{
				unlink($archivos_carpeta);
			}
		}
		rmdir($carpeta);
	}
	
	header("location: ../sistema/gerente/lista_de_productos.php");
	
?>
 