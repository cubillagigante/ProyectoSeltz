<?php

  require_once('../../php/conexion.php');

session_start();
  $usuario_sesion = $_SESSION['user'];
  $id_usuario = $_SESSION['id_usuario'];
  $tipo_user = $_SESSION['id_tipo_usuario']; 
  if(!isset($usuario_sesion))
  {
    header("location: ../logueo/index.php");
  }elseif($tipo_user != 5){
    header("location: ../../index.php");
  }
  
 

  $where = "";
  
  
  $sql1 = "SELECT * FROM producto, cliente $where";
  $resultado1 = $mysqli->query($sql1);



  $sql = "SELECT * from pedidos, producto, cliente where cliente = id_cliente and producto = id_producto and estado = 'PENDIENTE'" ;
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
         
        <h1>Informe del dia</h1>  
      <table border="1" cellpadding="5">
        <thead>
          <tr>
            <th>Nombre cliente</th>
            <th>nombre Producto</th>
            <th>Precio</th>
            <th>Direccion</th>
            <th>Estado</th>
            
          </tr>
        </thead>
  ';
  
  
  while ($row = $resultado->fetch_assoc()) { 
      if($row['estado']=='PENDIENTE'){  $color= '#f5f5f5'; }else{ $color= '#fbb2b2'; }
  $content .= '
    <tr bgcolor="'.$color.'">
            <td>'.$row['nombre_cliente'].'</td>
            <td>'.$row['nombre_producto'].'</td>
            <td>'.$row['precio_v'].'</td>
            <td>'.$row['direccion'].'</td>
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
 if(!empty($_POST))
  {
    $valor = $_POST['campo'];
    if(!empty($valor)){
      $where = "WHERE nombre LIKE '%$valor'";
    }
  }
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

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
    thead {
      background-color: #A9E2F3;
      color: #086A87;

    }
    table {
      background-color: white;
    }
    h1 {
      color: #fff;

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
          <li><a href="cuenta.php"><span class="glyphicon glyphicon-user"></span> <?php echo $usuario_sesion?></a></li>
          
          
        <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        
   
      </ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="escriba aquí para buscar al cliente">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-9">
      
      <hr>
      <center><h1>Bienvenido Funcionario/a <span class="sub"><?php echo $usuario_sesion?></span></h1></center>
      
      <hr>
   

      
<div class="row table-responsive">
  <div class="col-sm-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>CLIENTE</th>
              <th>PRODUCTO</th>
              <th>PRECIO VENTA</th>
              <th>DIRECCION</th>
              <th>ESTADO</th>
              <th></th>
            </tr>
          </thead>
          
          <tbody>
            <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['id_pedido']; ?></td>
                <td><?php echo $row['nombre_cliente']; ?></td>
                <td><?php echo $row['nombre_producto']; ?></td>

                <td><?php echo $row['precio_v']; ?></td>
                <td><?php echo $row['direccion']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <td><a href="#" data-href="../../php/update_estado.php?id_pedido=<?php echo $row['id_pedido']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-ok"></span></a></td>
              
               
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
        </div>
        <hr>
      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Paso de seguridad</h4>
          </div>
          
          <div class="modal-body">
            ¿Pedido Concretado?
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
            <a class="btn btn-danger btn-ok">si</a>
          </div>
        </div>
      </div>
    </div>
     
    </div>
  </div>
</div>

<footer>
<div class="container-fluid">
  <div class="row content">
    <br>
    <h4><center>Desarrolladores</center></h4>
    <div class="col-sm-2">
      <center><SPAN class="glyphicon glyphicon-ok"></SPAN> Diego Cubilla</center>
      <center>0972 168 930</center>
    </div>
    <div class="col-sm-2">
       <center><SPAN class="glyphicon glyphicon-ok"></SPAN> Katherine Saucedo</center>
        <center><img src="">Nro</center>
    </div>
  <div class="col-sm-4">
       <CENTER>
  <form method="post">
                  <input type="hidden" name="reporte_name">
                  <input type="submit" name="create_pdf" class="btn btn-danger pull-right" value="Generar informe">
                </form>
</DIV>
              </CENTER>
  
  </div>
</div>
 
</footer>
 <script>
      $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        
        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
      });
    </script>
</body>
</html>
