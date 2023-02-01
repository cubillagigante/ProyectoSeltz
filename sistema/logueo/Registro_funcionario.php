<?php

require '../../php/conexion.php';
  session_start();
  $usuario_sesion = $_SESSION['user'];
  $id_usuario = $_SESSION['id_usuario']; 

  

  if(!isset($usuario_sesion))
  {
    header("location: ../logueo/index.php");
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<link REL="SHORTCUT ICON" HREF="../../imagenes/logo5.ico">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sis-Seltz</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-theme.css" rel="stylesheet">
    <script src="../../js/jquery-3.2.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script> 
<style type="text/css">
	body {
		color: #fff;
		background: #244c7c;
	}
	.form-control {
        min-height: 41px;
		background: #fff;
		box-shadow: none !important;
		border-color: #e3e3e3;
	}
	.form-control:focus {
		border-color: #70c5c0;
	}
    .form-control, .btn {        
        border-radius: 2px;
    }
	.login-form {
		width: 350px;
		margin: 0 auto;
		padding: 100px 0 30px;		
	}
	.login-form form {
		color: #7a7a7a;
		border-radius: 2px;
    	margin-bottom: 15px;
        font-size: 13px;
        background: #ececec;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;	
        position: relative;	
    }
	.login-form h2 {
		font-size: 22px;
        margin: 35px 0 25px;
    }
	.login-form .avatar {
		position: absolute;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: -50px;
		width: 95px;
		height: 95px;
		border-radius: 50%;
		z-index: 9;
		background: #fff;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
	.login-form .avatar img {
		width: 100%;
		margin: 20% auto 0%;
	}	
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .btn {        
        font-size: 16px;
        font-weight: bold;
		background: #70c5c0;
		border: none;
		margin-bottom: 20px;
    }
	.login-form .btn:hover, .login-form .btn:focus {
		background: #50b8b3;
        outline: none !important;
	}    
	.login-form a {
		color: #fff;
		text-decoration: underline;
	}
	.login-form a:hover {
		text-decoration: none;
	}
	.login-form form a {
		color: #7a7a7a;
		text-decoration: none;
	}
	.login-form form a:hover {
		text-decoration: underline;
	}
	.btn a {
		color: white;
	}
</style>
</head>
<body>
<button type="button" class="btn btn-danger"><a href="../../php/salir.php">Cerrar Sesión <span class="glyphicon glyphicon-time"></span></button></a> 
<div class="login-form">
   
    <form action="../../php/registro_funcionario.php" method="post">
		<p>
		<div class="avatar">
			<img src="../../imagenes/logo5.png" alt="Avatar">
		</div>
        <h2 class="text-center">Datos del Funcionario</h2>   
        <div class="form-group">
        	<input type="text" class="form-control" name="nombre_funcionario" placeholder="Nombre de Funcionario" required="required">
        </div>
		<div class="form-group">
            <input type="text" class="form-control" name="ci" placeholder="CI" required="required">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="genero" placeholder="Genero" required="required">
        </div>
         <div class="form-group">
            <input type="text" class="form-control" name="direccion" placeholder="direccion" required="required">
        </div>  
        <div class="form-group">
            <input type="text" class="form-control" name="telefono" placeholder="Telefono" required="required">
        </div> 
        <div class="form-group">
            <input type="text" class="form-control" name="celular" placeholder="Celular" required="required">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="registro_auto" placeholder="Registro Auto" required="required">
        </div>
         <div class="form-group">
            <input type="text" class="form-control" name="cargo" placeholder="Cargo" required="required">
        </div>       
		<input type="hidden" name="id_usuario" value=<?php echo $id_usuario ?>>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Registrar</button>
        </div>
		
    </form>

   
</div>
</body>
</html>                            