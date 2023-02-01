<?php
  require_once('../../php/conexion.php');
  session_start();
  $usuario_sesion = $_SESSION['user'];
  $id_usuario = $_SESSION['id_usuario'];
  $tipo_user = $_SESSION['id_tipo_usuario'];

    $where = "";


  if(!isset($usuario_sesion))
  {
    header("location: ../logueo/index.php");
  }elseif($tipo_user != 4){
    header("location: ../../index.php");
  }
  

  $sql1 = "SELECT * FROM producto, cliente $where";
  $resultado1 = $mysqli->query($sql1);
  
  $sql = "SELECT * FROM pedidos, producto, cliente WHERE cliente = id_cliente and producto = id_producto";
  $resultado = $mysqli->query($sql); 


if(isset($_POST['create_pdf'])){
  require_once('../../tcpdf/tcpdf.php');
  
  $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
  
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Miguel Caro');
  $pdf->SetTitle($_POST['reporte_name']);
  
  $pdf->setPrintHeader(false); 
  $pdf->setPrintFooter(false);
  $pdf->SetMargins(20, 10, 20, false); 
  $pdf->SetAutoPageBreak(true, 20); 
  $pdf->SetFont('Helvetica', '', 10);
  $pdf->addPage();

  $content = '';
  
  $content .= '
    <div class="row">
          <div class="col-md-12">
              <h1 style="text-align:center;">'.$_POST['reporte_name'].'</h1>
        <center><h1>Informe del mes </h1><center>     
      <table border="1" cellpadding="5">
        <thead>
          <tr>
            <th>Nombre del cliente</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Estado</th>
           
          </tr>
        </thead>
  ';
  
  
  while ($row=$resultado->fetch_assoc()) { 
      if($row['estado']=='PENDIENTE'){  $color= '#f5f5f5'; }else{ $color= '#fbb2b2'; }
  $content .= '
    <tr bgcolor="'.$color.'">
            <td>'.$row['nombre_cliente'].'</td>
            <td>'.$row['nombre_producto'].'</td>
            <td>'.$row['precio_v'].'</td>
            <td>'.$row['estado'].'</td>
            
        </tr>
  ';
  }
  
  $content .= '</table>';
  
  $content .= '
    <div class="row padding">
          <div class="col-md-12" style="text-align:center;">
              <span>Pdf Creator </span><a href="http://www.redecodifica.com">By Miguel Angel</a>
            </div>
        </div>
      
  ';
  
  $pdf->writeHTML($content, true, 0, true, 0);

  $pdf->lastPage();
  $pdf->output('Reporte.pdf', 'I');
}

?>
  

  


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Seltz</title>
  <link REL="SHORTCUT ICON" HREF=".ico">
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-theme.css" rel="stylesheet">
    <script src="../../js/jquery-3.2.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script> 
    <style>
      body {
        font-family: "Swis721 BlkCn BT";
        background-color: #0489B1;
      }
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      margin-bottom: 10%;
      height: auto;
    }
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
      position: fixed;
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

    .usuario {
      background-color: white;
      border-radius: 100px;
    }
    h1 {
      color: #ffffff;
    }
    h5 {
      color:#fff;
    }
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
        position: relative;
      }
      .row.content {height: auto;}
       
      footer {
        position: relative;
      }
    
    }
    

    thead {
      background-color: #A9E2F3;
      color: #086A87;

    }
    table {
      background-color: white;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
        <p>
            <center><img src="../../imagenes/logo5.png" width="50%"></center>
      </p>
        <hr>
        <ul class="nav nav-pills nav-stacked">

          <li class="usuario"><a href="cuenta.php"><span class="glyphicon glyphicon-user"></span> <?php echo $usuario_sesion?> </a></li>
          <li><a href="../../php/salir.php"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a></li>
        <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="lista_de_productos.php"><span class="glyphicon glyphicon-list-alt"></span> Lista de Productos</a></li>
        <li><a href="agregar_producto.php"><span class="  glyphicon glyphicon-plus-sign"></span> Agregar Producto</a></li>
        <li><a href="../logueo/registrar_usuario_funcionario.php">Nuevo Funcionario</a></li>
      </ul><br>

      <div class="input-group">
        <input type="text" class="form-control" placeholder="Escriba aquí para buscar Pedido">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>

    </div>
    <div class="col-sm-3">
    </div>
    <div class="col-sm-9">
      <hr>
      <p>
         <h5><span class="glyphicon glyphicon-time"></span> Fecha de hoy <?php echo date("d/m/y"); ?></h5>
      <hr>

      <center><h1><span class="glyphicon glyphicon-signal"></span> Recaudación Semanal</h1></center>

      <hr>      
<div class="row table-responsive">
  <div class="col-sm-12">
        <table class="table table-striped">
          <thead>
            <tr>
             <th>ID Pedido</th>
              <th>Cliente</th>
              <th>Producto</th>
              <th>Precio</th>
              <th>Estado del pedido</th>
            </tr>
          </thead>
          
          <tbody>
            <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['id_pedido']; ?></td>
                <td><?php echo $row['nombre_cliente']; ?></td>
                <td><?php echo $row['nombre_producto']; ?></td>
                <td><?php echo $row['precio_v']; ?></td>
                <td><?php echo $row['estado']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>    
        <hr>
      
      
     
    </div>
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
  <form method="post">
                  <input type="hidden" name="reporte_name">
                  <input type="submit" name="create_pdf" class="btn btn-danger pull-right" value="Generar PDF">
                </form> 
  </div>
</div>
 
</footer>

</body>
</html>
