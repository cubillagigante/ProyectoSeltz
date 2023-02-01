<?php
  require '../../php/conexion.php';
  
  session_start();
  $usuario_sesion = $_SESSION['user'];
  $id_usuario = $_SESSION['id_usuario'];
  
  $sqlc = "SELECT id_cliente FROM cliente where usuario_cliente = '$id_usuario'";
  $resultadoc = $mysqli->query($sqlc);

  $rowc = $resultadoc->fetch_array(MYSQLI_ASSOC);

  if(!isset($usuario_sesion))
  {
    header("location: ../logueo/index.php");
  }
  
  $where = "";
  
  if(!empty($_POST))
  {
    $valor = $_POST['campo'];
    if(!empty($valor)){
      $where = "WHERE nombre LIKE '%$valor'";
    }
  }
   $cli = $rowc['id_cliente'];

  $sql = "SELECT * FROM cliente where usuario_cliente = $id_usuario and id_cliente = $cli";
  $resultado = $mysqli->query($sql);
  $row = $resultado->fetch_array(MYSQLI_ASSOC);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link REL="SHORTCUT ICON" HREF="../../imagenes/logo5.ico">
  <title>Seltz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-theme.css" rel="stylesheet">
    <script src="../../js/jquery-3.2.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script> 
  <style type="text/css">
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    body {
      font-family: "Square721 BT";
    }
    body::after {
             content: "";
             background: url(../../imagenes/img5.jpg);
             opacity: 0.2;
             top: 0;
             left: 0;
             bottom: 0;
             right: 0;
             position: absolute;
             z-index: -1;   
           }
    .navbar-inverse {
      border-radius: 0;
      position: fixed;
      width: 100%;
      z-index: 10;
      box-shadow: 0px 1px 5px 1px gray;
      
    }
    .row {
      background-color: transparent;
    }
    .prendido {
      background-color: #63A2EE;
    }
    .navbar-inverse .container-fluid {
 background-color: #244c7c;
 box-shadow: 0px -5px 6px 0px gray;
 transition: all 2s ease 0.5s;
    }
  .navbar-inverse .nav li a{
  color: white;
}
 .navbar-inverse .nav li a:hover{
  background-color: white;
  transition:all 0.5s ease 0s;
  color: #244c7c;

}
.sidenav {
      background-color: transparent;

      
    }
    .navbar-brand {
      background-color: white;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: -10px;
      
      background-color: transparent;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {

      background-color: ;
      padding: 25px;
    }
    
    div.perfil {
    width: 95%;
    background-color: ;
    margin: 2% auto 2%;

    padding: 10px;
    border-radius: 100px;
    box-sizing: border-box;
    }

    input {
      text-align: center;
    }
    
  </style>
</head>
<body>
<nav class="navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="perfil.php" ><span class="glyphicon glyphicon-user"></span> <?php echo $usuario_sesion?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="../../php/salir.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
        <li><a href="index.php"><span class=" glyphicon glyphicon-home"></span> Home</a></li>
        
        <li><a href="contactos.php"><span class="glyphicon glyphicon-earphone"></span> Contactos</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href=""><?php echo date("d/m/y"); ?></a></li>
        
        <li><a> <span class=" glyphicon glyphicon-shopping-cart"></span> Hacer un pedido</a></li>
        <li><a href="pedidos realizados.php"><span class="glyphicon glyphicon-time"></span> Pedidos Realizados</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="jumbotron">
  <div class="container text-center">
    <br>
    <br>
    <h1>configure aquí su cuenta</h1>      
    
  </div>

</div>

<div class="container-fluid text-center">
  <div class="row content">

    
    <div class="col-sm-6">
       
               
               <div class="perfil"><img src="../../imagenes/perfil-vacio.png" width="45%">
               </div>
               
    </div>  
    <div class="col-sm-5">
         
    <form class="form-horizontal" method="POST" action="../../php/update_cliente.php" autocomplete="off">
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label"></label>
          <div class="col-sm-8">
            <input type="hidden"  class="form-control" id="nombre" name="id_cliente" placeholder="Nombre" value="<?php echo $row['id_cliente']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-8">
            <input type="text"  class="form-control" id="nombre" name="nombre_cliente" placeholder="Nombre" value="<?php echo $row['nombre_cliente']; ?>" required>
          </div>

        </div>

        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Direccion</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="direccion" placeholder="direccion" value="<?php echo $row['direccion']; ?>" required>
          </div>
        </div>
        
        
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">CI</label>
          <div class="col-sm-8">
            <input type="emtext" class="form-control" id="nombre" name="ci" placeholder="Descripcion" value="<?php echo $row['ci']; ?>"required>
          </div>
        </div>
        <p>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">RUC</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="ruc" placeholder="cantidad del producto" value="<?php echo $row['ruc']; ?>"required>
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Telefono</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="telefono" placeholder="Precio de compra" value="<?php echo $row['telefono']; ?>"required>
          
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Celular</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="celular" placeholder="Precio de venta" value="<?php echo $row['celular']; ?>"required>
          </div>
        </div>
                <input type="submit" id="enviar" name="enviar" value="Guardar cambios" class="btn btn-info" />

        </div>
        
</form>
    





</body>
</html>
