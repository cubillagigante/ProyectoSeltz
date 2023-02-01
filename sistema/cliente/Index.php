<?php
  
  require '../../php/conexion.php';
session_start();
  $usuario_sesion = $_SESSION['user'];
  $tipo_user = $_SESSION['id_tipo_usuario'];
  if(!isset($usuario_sesion))
  {
    header("location: ../logueo/index.php");
  }elseif($tipo_user != 1){
    header("location: ../../index.php");
  }

  $where = "";


  if(!empty($_POST))
  {
    $valor = $_POST['campo'];
    if(!empty($valor)){
      $where = "WHERE nombre_producto LIKE '%$valor%'";
    }
  }

  $sql = "SELECT * FROM producto";
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
    
    }
  .navbar-inverse .nav li a{
  color: white;
}
 .navbar-inverse .nav li a:hover{
  background-color: #fff;
  transition:all 0.5s ease 0s;
  color: #244c7c;

}
  .container-fluid {
    background-color: white;
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
        <li class="prendido"><a href="index.php"><span class=" glyphicon glyphicon-home"></span> Home</a></li>
        
        <li><a href="contactos.php"><span class="glyphicon glyphicon-earphone"></span> Contactos</a></li>
        
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
<div class="container-fluid text-center">
  <hr>
  <p>Busque aquí su producto</p>  
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <b>Nombre: </b><input type="text" id="campo" name="campo" />
          <input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
        </form>
      
<hr>
<div class="container">    
  <div class="row">
    
      <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>

              <div class="col-sm-4"> 
                 <div class="panel panel-primary">
                 <div class="panel-heading"><?php echo $row['nombre_producto']; ?></div>
                <div class="panel-body"><center>

                  <img src="../gerente/files/<?php echo $row['id_producto']; ?>/<?php echo $row['ruta_imagen']; ?>" class="img-responsive" style="width:50%" alt="Image">
                
                </center></div>
                <div class="panel-footer"><a href="../descripcion_producto.php?id_producto=<?php echo $row['id_producto'];?>"><span class="glyphicon glyphicon-eye-open"></span> Ver</a></div>
                </div>
              </div>

    <?php } ?>      
         
                 
    </div>

    
  </div>
</div><br><br>


<footer >
    <center><h5>Seltz S.A.</h5>
    <h5>2019</h5>
    <hr>
    <h5><img src="../../imagenes/katgo logo.png" width="2%"> KATGO! 3º BTI</h5>

    </center>
    
  </footer>
</body>
</html>
