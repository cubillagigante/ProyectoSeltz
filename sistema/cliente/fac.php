<?php 

require_once('../../php/conexion.php');



$usuario = "SELECT nombre_cliente, ci, ruc, direccion,nombre_producto, producto, precio_pro, fecha, total from cliente, pedidos, venta, producto where id_cliente = '2' and id_clis = '2' and cliente = '2' and id_producto = producto and num_ven = '1' and numero_venta = '1'" ;
  
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
        <p>Nombre/Razon Social:  '.$user1['nombre_cliente'].'</p>
        <p>Ruc:  '.$user1['ruc'].'</p>
        <p>CI:  '.$user1['ci'].'</p>
        <p>Dirección:  '.$user1['direccion'].'</p>
        <p>fecha:  '.$user1['fecha'].'</p>

        <thead>
          <tr>
            <th>Producto</th>
            <th>Precio</th>
          </tr>
        </thead>
  ';
  
  
  while ($user = $usuarios->fetch_assoc()) { 
      
  $content .= '
        <thead>
        <tr>
          
            <th>'.$user['nombre_producto'].'</th>
            <th>'.$user['precio_pro'].'</th>
        </tr>
        </thead>

  ';
  }


  
  $content .= '</table> <table border="1" cellpadding="5"><tr><th><p>Total:  '.$user1['total'].'</p></td></tr></table>';
  
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
<html>
<head>
	<title></title>
</head>
<body>


<form method="post">
                  <input type="hidden" name="reporte_name" value="<?php echo $h1; ?>">
                  <input type="submit" name="create_pdf" class="btn btn-danger pull-right" value="Generar PDF">
                </form>

</body>
</html>

