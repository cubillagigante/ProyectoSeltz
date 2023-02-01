<?php

  require '../../php/conexion.php';

session_start();
  $usuario_sesion = $_SESSION['user'];
  $id_usuario = $_SESSION['id_usuario'];
  $tipo_user = $_SESSION['id_tipo_usuario']; 

  $sql1 = "SELECT * FROM funcionario where usuario_funcionario = '$id_usuario'";
  $resultado1 = $mysqli->query($sql1);

  $rowc = $resultado1->fetch_array(MYSQLI_ASSOC);
  
if(!isset($usuario_sesion))
  {
    header("location: ../logueo/index.php");
  }elseif($tipo_user != 5){
    header("location: ../cliente/index.php");
  }  
  $where = "";
  
  if(!empty($_POST))
  {
    $valor = $_POST['campo'];
    if(!empty($valor)){
      $where = "WHERE nombre LIKE '%$valor'";
    }
  }

  $fun = $rowc['id_funcionario'];
  
  $sql = "SELECT * FROM funcionario where id_funcionario = $fun";
  $resultado = $mysqli->query($sql);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link REL="SHORTCUT ICON" HREF="../../imagenes/iconfuncionario.ico">
  <title>Seltz-funcionario</title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-theme.css" rel="stylesheet">
    <script src="../../js/jquery-3.2.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script> 
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    body {
      font-family: calibri light;
      background-color: #0489B1;
    }
    
    .row.content {
      margin-bottom: 10%;
      height: 100%;
    }
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
       font-size:115%;
       text-align: center;
       position: fixed;
    }
    .sub {
      color: #086A87;
      background-color: white;
      border-radius: 10px;
      padding: 5px;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 0px;
      position: fixed;
      width: 100%;
      bottom: -15%;
  
    }
    .col-sm-9 {
      color: white;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <hr>
      <p>
        <center><img src="../../imagenes/logo5.png" width="50%"></center>
      </p>
      <hr>
        <ul class="nav nav-pills nav-stacked">
          <h5>Fecha de Hoy <?php echo date("d/m/y"); ?> <span class="glyphicon glyphicon-time"></span></h5>
        <li><a href="../../php/salir.php">Cerrar Sesión</a></li>
        <li class="active"><a href="cuenta.php"><span class="glyphicon glyphicon-user"></span> <?php echo $usuario_sesion?></a></li>
        <li><a href="index.php"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
      </ul><br>
    </div>
    
    
    <div class="col-sm-3"></div>
    <div class="col-sm-9">
      <center><h2>··Aquí puede cambiar los datos de su cuenta··</h2></center>
    <hr>
      <form class="form-horizontal" method="POST" action="../../php/update_cliente.php" autocomplete="off">
         
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-8">
            <input type="text"  class="form-control" id="nombre" name="nombre_funcionario" placeholder="Nombre" value="<?php echo $rowc['nombre_funcionario']; ?>" required>
          </div>

        </div>

        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">CI</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="ci" placeholder="ci" value="<?php echo $rowc['ci']; ?>" required>
          </div>
        </div>
        
        
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Genero</label>
          <div class="col-sm-8">
            <input type="emtext" class="form-control" id="nombre" name="genero" placeholder="Descripcion" value="<?php echo $rowc['genero']; ?>"required>
          </div>
        </div>
        <p>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Telefono</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="telefono" placeholder="cantidad del producto" value="<?php echo $rowc['telefono']; ?>"required>
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Celular</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="celular" placeholder="Precio de compra" value="<?php echo $rowc['celular']; ?>"required>
          
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Direccion</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="direccion" placeholder="Precio de venta" value="<?php echo $rowc['direccion']; ?>"required>
          </div>
        </div>

          <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Registro Auto</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="registro_auto" placeholder="Precio de venta" value="<?php echo $rowc['registro_auto']; ?>"required>
          </div>
        </div>
          <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Cargo</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="cargo" placeholder="Precio de venta" value="<?php echo $rowc['cargo']; ?>"required>
          </div>
        </div>

        <p>
        <center><input type="submit" id="enviar" name="enviar" value="Guardar cambios" class="btn btn-info" /></center>
        </p>
      </div>
    </form>  
  </div>
</div>

<footer>
<div class="container-fluid">
  <div class="row content">
    <h4><center>Desarrolladores</center></h4>
    <div class="col-sm-6">
      <center><SPAN class="titulo">Diego Cubilla</SPAN></center>
      <center>0972 168 930</center>
    </div>
    <div class="col-sm-6">
       <center><SPAN class="titulo">Katherine Saucedo</SPAN></center>
        <center><img src="">Nro</center>
    </div>
  
  </div>
</div>
 
</footer>

</body>
</html>
