<?php
  
  require_once('../../php/conexion.php');
  session_start();
  $usuario_sesion = $_SESSION['user'];
  $id_usuario = $_SESSION['id_usuario'];
  $tipo_user = $_SESSION['id_tipo_usuario']; 

  
  $sqlc = "SELECT * FROM cliente where usuario_cliente = '$id_usuario'";
  $resultadoc = $mysqli->query($sqlc);
  $rowc=$resultadoc->fetch_array(MYSQLI_ASSOC);


  


  if(!isset($usuario_sesion))
  {
    header("location: ../logueo/index.php");
  }elseif($tipo_user != 1){
    header("location: index.php");
  }
  
 
  $fecha = date("d/m/y");
  $cli = $rowc['id_cliente'];
  

  $sqlventa = "SELECT * FROM venta ORDER BY numero_venta DESC LIMIT 1;" ;
  $resultado_venta = $mysqli->query($sqlventa);
  $row_venta = $resultado_venta->fetch_array(MYSQLI_ASSOC);
  if ($sqlventa) {
    $num = 1 + $row_venta['numero_venta'];
    $venta = $row_venta['numero_venta'];
  }
  


  $sqlcarrito = "SELECT * from pedidos, producto where cliente = $cli and producto = id_producto and estado = 'PENDIENTE' and fecha = '$fecha' and num_ven > '$venta'";
  $resultado_carrito = $mysqli->query($sqlcarrito);
  

  $sqlcarrito2 = "SELECT * from pedidos where cliente = $cli ";
  $resultado_carrito2 = $mysqli->query($sqlcarrito2);
  $row12 = $resultado_carrito2->fetch_array(MYSQLI_ASSOC);

if ($row12 == "") {

  $booleano = '1';

}
else {
  $booleano = '2';

}


  $sqltotal = "SELECT SUM(precio_pro) from pedidos where estado = 'PENDIENTE' and fecha = '$fecha' and num_ven > '$venta'" ;
  $resultado_total = $mysqli->query($sqltotal);
  $row_total = $resultado_total->fetch_array(MYSQLI_ASSOC);



$usuario = "SELECT * from cliente, pedidos, venta, producto where id_cliente = '$cli' and id_clis = '$cli' and cliente = '$cli' and id_producto = producto and num_ven = '$venta' and numero_venta = num_ven " ;
  
 $usuarios=$mysqli->query($usuario);
 
 $usuario2 = "SELECT fecha from pedidos, venta, producto where id_clis = '$cli' and cliente = '$cli' and num_ven = '$venta' and numero_venta = num_ven " ;
  
 $usuarios2=$mysqli->query($usuario2);
  $us = $usuarios2->fetch_array(MYSQLI_ASSOC);
 
 
  
if(isset($_POST['create_pdf'])){
  require_once('../../tcpdf/tcpdf.php');
  
  $pdf = new TCPDF('P', 'mm', 'oficio', true, 'UTF-8', false);
  
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Reporte');
  $pdf->SetTitle($_POST['reporte_name']);
  
  $pdf->setPrintHeader(false); 
  $pdf->setPrintFooter(false);
  $pdf->SetMargins(20, 20, 20, false); 
  $pdf->SetAutoPageBreak(true, 20); 
  $pdf->SetFont('Helvetica', '', 10);
  $pdf->addPage();

  $content = '';
  
  $content .= '
    <div class="row">
          <div class="col-md-12">
              <h1 style="text-align:center;">'.$_POST['reporte_name'].'</h1>
      <center><h1>Comprobante de Compra</h1></center> 



      <table border="1" cellpadding="5">
        <p> Nombre/Razon Social:  '.$rowc['nombre_cliente'].'</p>
        <p> Ruc:  '.$rowc['ruc'].'</p>
        <p> CI:  '.$rowc['ci'].'</p>
        <p> Dirección:  '.$rowc['direccion'].'</p>
        <p> fecha:  '.$us['fecha'].'</p>
        
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
          
          </tr>
        </thead>
        
  ';
  
  
  while ($ro = $usuarios->fetch_assoc()) { 
      
 $content .= '
    <thead>
    <tr>
          
            <td>'.$ro['nombre_producto'].'</td>
            <td>'.$ro['descripcion'].'</td>
            <td>'.$ro['precio_pro'].'</td>

    </tr>
    </thead>

  '
  ;
  }

  
  $content .= '</table> ';
  
  $content .= 
  '
    
      <p><H2>Total:  '.$row_venta['total'].'</H2></p>
  ';
  
  $pdf->writeHTML($content, true, 0, true, 0);

  $pdf->lastPage();
  $pdf->output('Reporte.pdf', 'I');
}




 $where = "";


  if(!empty($_POST))
  {
    $valor = $_POST['campo'];
    if(!empty($valor)){
      $where = "WHERE id_producto LIKE '%$valor%'";
    }
  }
  $sql = "SELECT id_producto, nombre_producto, descripcion, precio_v FROM producto $where";
  $resultado1 = $mysqli->query($sql);

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
      margin-bottom: 0px;
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
    .subt {
      background-color: ;
      border-radius: 100px;
      padding: 5px;
      border:1px solid gray;

    }
    .sidenav {
      background-color: #fff;
      height: 100%;
      text-align: center;
      margin-bottom: 10%;    
    }
  
    .col-sm-12 {
      border: 2px solid gray;
      border-radius: 20px;
    }
    .col-sm-4{
      border: 1px solid gray;
    }
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
      background-color: transparent;
    }
   
    /* Add a gray background color and some padding to the footer */
     .total {
      background-color: #0489B1;
      color: white;
      padding: 10px;
      position: fixed;
      width: 30%;
      bottom: 0%;
      right: 1%;
      box-sizing: border-box;
      box-shadow: 0px 0px 5px 2px gray;
    }
    footer {
      background-color: #2E2E2E;
      padding: 10px;
      box-sizing: border-box;
      color: white;
    }
    h4 {
      font-family: century gothic;
      text-align: center;
    }
    th {
      text-align: center;
      background-color: white;
    }
    .container-fluid {
      background-color: transparent;
    }
    .centrarpdf {
      margin: 0px 150px 0px;
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
        
        <li class="prendido"><a href="pedido.php"> <span class=" glyphicon glyphicon-shopping-cart"></span> Hacer un pedido</a></li>
        <li><a href="pedidos realizados.php"><span class="glyphicon glyphicon-time"></span> Pedidos Realizados</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid text-center">
  <div class="row content">
 <br>
 <br>
 <br>
<div class="col-sm-8">

    <center><h1><img src="../../imagenes/seltzlogo.png" width="35%"></h1>      


<br>
<div class="col-sm-12 sidenav">
       <hr>
      
      
         <a href="index.php">Actualizar <span class="glyphicon glyphicon-repeat"></span></a>    
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <b>Nombre: </b><input type="text" id="campo" name="campo" />
          <input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
        </form>
      

    
        
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Producto</th>
              <th>Descripcion</th>
              <th>Precio Venta</th>
              <th></th>
            </tr>
          </thead>
          
          <tbody>
            <?php  while($row = $resultado1->fetch_array(MYSQLI_ASSOC)) { ?>
              

              <tr>
                
                <td><?php echo $row['id_producto']; ?></td>
                <td><?php echo $row['nombre_producto']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['precio_v']; ?></td>
                <td><a href="../../php/guardar_pedido.php?id_cliente=<?php echo $rowc['id_cliente'];?>&id_producto=<?php echo $row['id_producto'];?>&precio_v=<?php echo $row['precio_v'];?>&num_ven=<?php echo $row_venta['numero_venta']?>"><span class="glyphicon glyphicon-plus"></span></span></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
    
    </div>  








    
  </div>


   
    
    <div class="col-sm-4 sidenav">
        <hr>
         
        <h1>Ticket Nº <?php echo  $num; ?></h1>
        <p>
         
<?php    

if ( $booleano == '1') {
  echo $dos ="Haga click en el icono + <br>para agregar su pedido al carrito";

}
if ( $row_total['SUM(precio_pro)'] == "" and $booleano =='2') {
  echo $uno ="Imprima el ticket de su pedido anterior";

  echo '<div class="centrarpdf"><form method="post"><input type="hidden" name="reporte_name"><input type="submit" name="create_pdf" class="btn btn-danger pull-right" value="Imprimir"></form></div>';

}

?>

        
  
        <table class="table table-striped">
          <thead>
            
            <tr>
              
          
              <th>Producto</th>
              <th>Precio</th>
              <th></th>
            </tr>
          </thead>
          
          <tbody>
            <?php while($rowcarrito = $resultado_carrito->fetch_array(MYSQLI_ASSOC)) { ?>
                
               
              <tr>
                
                <td><?php echo $rowcarrito['nombre_producto']; ?></td>
                <td><?php echo $rowcarrito['precio_pro']; ?></td>


                
              

                <td><a href="#" data-href="../../php/eliminar_carrito.php?id_pedido=<?php echo $rowcarrito['id_pedido']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
               


              </tr>
            <?php } ?>
          </tbody>
           
                           
         <?php    
 if ( $row_total['SUM(precio_pro)'] != "")
{  

echo '
          
<a href="../../php/guardar_venta.php?id_cliente='.$rowc["id_cliente"].'&total='.$row_total["SUM(precio_pro)"].'&num_ven='.$row_venta["numero_venta"].'"><span class="glyphicon glyphicon-ok"></span> Confirmar Compra</a>
         
';

echo '<h4>Total: '.$row_total["SUM(precio_pro)"].' gs</h4>';
}

?>



        </table>  
      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title" id="myModalLabel">Eliminar</h4>
            </div>
          
            <div class="modal-body">
              ¿Desea eliminar este Producto?
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
