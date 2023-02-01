<?php  
require 'conexion.php';
session_start();
 
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];


$query = mysqli_query($mysqli,"select * from usuarios where user = '$usuario' and pass = '$clave'");

$result = mysqli_num_rows($query);

if($result > 0)
{	$_SESSION['username'] = $usuario;	
$data = mysqli_fetch_array($query);
				print_r($data);
				$_SESSION['active'] = true;
				$_SESSION['id_usuario'] = $data['id_usuario'];
				$_SESSION['user'] = $data['user'];
				$_SESSION['pass'] = $data['pass'];
				$_SESSION['estado'] = $data['estado'];
				$_SESSION['id_tipo_usuario'] = $data['id_tipo_usuario'];


				if($_SESSION['estado']=='activo'){


					if($_SESSION['id_tipo_usuario'] ==  '5')
					{

						header("location: ../sistema/funcionario/index.php");

					}				
					elseif ($_SESSION['id_tipo_usuario'] == '4') {
						header("location: ../sistema/gerente/index.php");
					}
					elseif ($_SESSION['id_tipo_usuario'] == '1') {
						header("location: ../sistema/cliente/index.php");
					}

				}else{
					echo 'error al tratar de ingresa';
				}
				if ($_SESSION['estado']=='inactivo'){
					
					if ($_SESSION['id_tipo_usuario'] == '5') {

						header("location: ../sistema/logueo/Registro_funcionario.php");
					}
					elseif ($_SESSION['id_tipo_usuario'] == '1') {

						header("location: ../sistema/Logueo/R001.php");
					}
				}

}else{
	echo "Datos Incorrectos";
	header("location: ../sistema/logueo/index.php");
}
?>