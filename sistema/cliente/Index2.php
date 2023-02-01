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
      background-color: #f2f2f2;
      padding: 25px;
    }
    

  </style>
</head>

<body>

 
            
 
          

          <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>

              <div class="col-sm-4"> 
                 <div class="panel panel-primary">
                 <div class="panel-heading">Seltz Lady</div>
                <div class="panel-body"><center>

                  <img src="../gerente/files/<?php echo $row['id_producto']; ?>/<?php echo $row['ruta_imagen']; ?>" class="img-responsive" style="width:50%" alt="Image">
                
                </center></div>
                <div class="panel-footer"><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Agregar a carrito</a><a href="#"><p><span class="glyphicon glyphicon-eye-open"></span></p> Ver</a></div>
                </div>
              </div>

    <?php } ?>
  
</body>
</html>
