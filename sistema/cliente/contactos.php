<?php
  require '../../php/conexion.php';
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
  $sql = "SELECT id_pro, nombre_producto, descripcion, cantidad, precio_c, precio_v, nombre_proveedor FROM producto,proveedor $where";
  $resultado = $mysqli->query($sql);
  
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
    
    .navbar-inverse {
      margin-bottom: 50px auto 2px;
      border-radius: 0;
      position: fixed;
      width: 100%;
      z-index: 10;
      box-shadow: 0px 1px 5px 1px gray; 
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
.container-fluid {
    background-color: white;
  }
 .navbar-inverse .nav li a:hover{
  background-color: #fff;
  transition: all 1s ease 0s;
  color: #244c7c;
}

    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
      background-color: transparent;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #2E2E2E;
      padding: 10px;
      box-sizing: border-box;
      color: white;
    }
    .row {
      margin-top: 2%;
      margin-bottom: 2%; 
    }
    .col-sm-4 img {
      border-radius: 10px;
      box-shadow: -3px 3px 10px 1px gray;
    }
  </style>
</head>
<body background="../../imagenes/img5.jpg">
<nav class="navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="perfil.php"><span class="glyphicon glyphicon-user"></span> <?php echo $usuario_sesion?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="../../php/salir.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
        <li><a href="index.php"><span class=" glyphicon glyphicon-home"></span> Home</a></li>
        
        <li class="prendido"><a href="contactos.php"><span class="glyphicon glyphicon-earphone"></span> Contactos</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href=""><?php echo date("d/m/y"); ?></a></li>
        
        <li><a href="pedido.php"> <span class=" glyphicon glyphicon-shopping-cart"></span> Hacer un pedido</a></li>
        <li><a href="pedidos realizados.php"><span class="glyphicon glyphicon-time"></span> Pedidos Realizados</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="jumbotron">
  <div class="container text-center">
    <br>
    <br>
    <h1><img src="../../imagenes/seltzlogo.png" width="30%"></h1>      
    <p></p>
  </div>
</div>
<center>
 

<div class="container-fluid text-center">
  <div class="row content">

    <div class="col-sm-4">
    
     <h2><span class="glyphicon glyphicon-map-marker"></span></h2>
          <b><h3>Planta Industrial</b></h3>
          <h5>Av. San Roque González 1600 M.R Alonso, Paraguay</h5>
          <br>
          <img src="../../imagenes/planta.jpg">
    </div>
    <div class="col-sm-4">
       <h2><span class="glyphicon glyphicon-comment"></span></h2>
         
          <b><h3>Atencion al Cliente <p></p> </b>
          (+595 21) 289 0000</h3>
          <h5>
            Estamos disponibles en los siguientes horarios
          </h5>
          <h4><b>Verano</b></h4>
          <h5>Lunes a Viernes 07:00 a 19:00 hs <p></p>
            Sabados 07:00 a 16:00 hs
          </h5>
       <h4><b>Invierno</b></h4>
        <h5>Lunes a Viernes 07:00 a 18:00 hs <p></p>
            Sabados 07:00 a 15:00 hs
          </h5>
        </div>
        <div class="col-sm-4">
          <h2><span class="glyphicon glyphicon-list-alt"></span></h2>
         
          <b><h3>Administración</b></h3>
          <h3>(+595 21) 289 0100</h3>
           <h5>
            Te comunicamos con todos nuestros departamentos. <p></p>
            Lunes a Viernes 07:00 - 17:00 hs
          </h5>   
        </div>
</center>
  </div>
  </div>

<br>

<footer >
    <center><h5>Seltz S.A.</h5>
    <h5>2019</h5>
    <hr>
    <h5><img src="../../imagenes/katgo logo.png" width="2%"> KATGO! 3º BTI</h5>

    </center>
    
  </footer>
</body>
</html>
