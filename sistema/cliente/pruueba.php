<?php
  
  require_once('../../php/conexion.php');
  session_start();
  $usuario_sesion = $_SESSION['user'];
  $id_usuario = $_SESSION['id_usuario'];
  $tipo_user = $_SESSION['id_tipo_usuario']; 

  
  $sqlc = "SELECT id_cliente FROM cliente where usuario_cliente = '$id_usuario'";
  $resultadoc = $mysqli->query($sqlc);

  $rowc = $resultadoc->fetch_array(MYSQLI_ASSOC);

  


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
  $num = 1 + $row_venta['numero_venta'];
  $venta = $row_venta['numero_venta'];


  $sqlcarrito = "SELECT * from pedidos, producto where cliente = '$cli' and producto = id_producto and estado = 'PENDIENTE' and fecha = '$fecha' and num_ven > '$venta'";
  $resultado_carrito = $mysqli->query($sqlcarrito);





  $sqltotal = "SELECT SUM(precio_pro) from pedidos where estado = 'PENDIENTE' and fecha = '$fecha' and num_ven > '$venta'" ;
  $resultado_total = $mysqli->query($sqltotal);
  $row_total = $resultado_total->fetch_array(MYSQLI_ASSOC);





$usuario = "SELECT nombre_cliente, ci, ruc, direccion,nombre_producto, producto, precio_pro, fecha, total from cliente, pedidos, venta, producto where id_cliente = '$cli' and id_clis = '$cli' and cliente = '$cli' and id_producto = producto and num_ven = '$venta' and numero_venta = num_ven" ;
  
 $usuarios=$mysqli->query($usuario);
 $user1=$usuarios->fetch_assoc();
 
 

  
if(isset($_POST['create_pdf'])){
  require_once('../../tcpdf/tcpdf.php');
  
  $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
  
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Miguel Caro');
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
        
      <table border="1" cellpadding="5">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Precio</th>
            
          </tr>
        </thead>
  ';
  
  
  while ($user=$usuarios->fetch_assoc()) { 
  if($user['total']>'10000'){  $color= '#f5f5f5'; }else{ $color= '#fbb2b2'; }
  $content .= '
    <tr bgcolor="'.$color.'">
            <td>'.$user['producto'].'</td>
            <td>'.$user['nombre_producto'].'</td>
            <td>'.$user['precio_pro'].'</td>
            
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
  </style>
</head>
<body>

<form method="post">
                  <input type="hidden" name="reporte_name">
                  <input type="submit" name="create_pdf" class="btn btn-danger pull-right" value="Generar PDF">
                </form>
</body>
</html>
