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
  $sql = "SELECT id_producto, nombre_producto, descripcion, precio_v FROM producto $where";
  $resultado1 = $mysqli->query($sql);

  $cli = $rowc['id_cliente'];
 
  $sql = "SELECT * from venta where id_clis = $cli ";
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
 .navbar-inverse .nav li a:hover{
  background-color: white;
  transition:all 0.5s ease 0s;
  color: #244c7c;

}
.sidenav {
      background-color: #f1f1f1;
      height: 100%;
      text-align: center;
      margin-bottom: 10%;    
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
    
    div.perfil {
    width: 95%;
    background-color: ;
    margin: 2% auto 2%;
    border:1px solid black;
    padding: 10px;
    box-sizing: border-box;
    }
    th {
      text-align: center;

    }
    .col-sm-8 {
      
      background-color: white;
      border-radius: 10px;
      border: 3px solid gray;
      margin: 30px 200px 100px;
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
        
        <li><a href="contactos.php"><span class="glyphicon glyphicon-earphone"></span> Contactos</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href=""><?php echo date("d/m/y"); ?></a></li>
        
        <li><a href="pedido.php"> <span class=" glyphicon glyphicon-shopping-cart"></span> Hacer un pedido</a></li>
        <li class="prendido"><a href="pedidos realizados.php"><span class="glyphicon glyphicon-time"></span> Pedidos Realizados</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
<br>
<br>
<br>


<div class="col-sm-12">

    <center><h1><img src="../../imagenes/seltzlogo.png" width="25%"></h1></center>      
  
  
</div>
<br>
<br>


  

    <div class="col-sm-8">

        <table class="table table-striped">
          <hr>
          <center><h2>Pedidos</h2></center>
          <p>
          <thead>
            
            <tr>
             
              <th>Fecha del pedido</th>
              <th>Total General</th>
              <th>Nro de Ticket</th>
              <th></th>
              
            </tr>
          </thead>
          
          <tbody>
            <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
              <tr>
              
                <td><?php echo $row['fecha_venta']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['numero_venta']; ?></td>
                <td><a href="#" data-href="../../php/eliminar_pedido.php?id_venta=<?php echo $row['id_venta'];?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></span></a></td>
               
               
              </tr>
            <?php } ?>
          </tbody>
        </table>  
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title" id="myModalLabel">Eliminar</h4>
            </div>
          
            <div class="modal-body">
              ¿Desea eliminar completamente su pedido?
            </div>
          
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <a class="btn btn-danger btn-ok">Eliminar</a>
            </div>
          </div>
        </div>
      </div>    
    </div>
    
      </div>    
    </div>
  </div>
  
</div>
    
    </div>    
</div>
 


<script>
      $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        
        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
      });
    </script>

<footer >
    <center><h5>Seltz S.A.</h5>
    <h5>2019</h5>
    <hr>
    <h5><img src="../../imagenes/katgo logo.png" width="2%"> KATGO! 3º BTI</h5>

    </center>
    
  </footer>

</body>
</html>
