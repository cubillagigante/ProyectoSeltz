<?php
  require 'conexion.php';
  session_start();
  $usuario_sesion = $_SESSION['user'];

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
  $id = $_GET['id_pedido'];
  
  $sql = "SELECT * FROM producto, cliente WHERE id_pedido = '$id'";
  $resultado = $mysqli->query($sql);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Seltz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.css" rel="stylesheet">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script> 
  <style type="text/css">
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    body {
      font-family: "Square721 BT";
    }
    .navbar-inverse {
      margin-bottom: 50px auto 2px;
      border-radius: 0;

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
      background-color: #f1f1f1;  
    }
    
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
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
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="../sistema/cliente/index.php">Home</a></li>
        <li class="prendido"><a href="../sistema/cliente/C001.php">Hacer un pedido</a></li>
        <li><a href="../sistema/cliente/C002.php">Contactos</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $usuario_sesion?></a></li>
        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Carro</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="jumbotron">
  <div class="container text-center">
    
    <h1><img src="../imagenes/logo5.png" width="30%"></h1>      
    <p></p>
  </div>
</div>




<div class="container-fluid text-center">
  <div class="col-sm-20">  
    <hr>
    <h1><span class="glyphicon glyphicon-plus-sign"></span> Agregar al carrito</h1>
    <hr>
    <form class="form-horizontal" method="POST" action="../../php/guardar_pedido.php" autocomplete="off">
        
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">id</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="id_pedido" placeholder="Nombre" value="<?php echo $row['id_pedido']; ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Nombre del Cliente</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="nombre_cliente" placeholder="Nombre" value="<?php echo $row['nombre_cliente']; ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Nombre del Producto</label>
          <div class="col-sm-10">
            <input type="emtext" class="form-control" id="nombre" name="nombre_producto" placeholder="nombre del producto" value="<?php echo $row['nombre_producto']; ?>" required>
          </div>
        </div>
        <p>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Cantidad</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="cantidad_p" placeholder="cantidad del producto">
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Precio</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="precio_v" placeholder="Precio de compra" value="<?php echo $row['precio_v']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Fecha</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="fecha" placeholder="Precio de venta">
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Funcionario</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="funcionario" placeholder="Ingrese la ID Proveedor">
          </div>        
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Estado</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="estado" placeholder="Ingrese la ID Proveedor">
          </div>        
        </div>


        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-10">
            <a href="gerente.php" class="btn btn-default"><span class="glyphicon glyphicon-home"></span> Regresar</a>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>
          </div>
        </div>
        <p>
  </div>
      
</div>
<footer class="">
  
</footer>
</body>
</html>
