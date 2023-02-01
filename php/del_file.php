<?php
	
	$file = $_POST['id_producto'];
	
	if(is_file($file)){
		chmod($file,0777);
		if(!unlink($file)){
		echo false;
		}
	}
	
	header("location: ../sistema/gerente/lista_de_productos.php");
?>