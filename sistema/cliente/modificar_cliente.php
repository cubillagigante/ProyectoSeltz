<?php
	require 'conexion.php';
	$where = "";
  
  if(!empty($_POST))
  {
    $valor = $_POST['campo'];
    if(!empty($valor)){
      $where = "WHERE nombre LIKE '%$valor'";
    }
  }
	$id = $_GET['id_producto'];
	
	$sql = "SELECT * FROM producto, proveedor WHERE id_producto = '$id'";
	$resultado = $mysqli->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);
	
?>
<html lang="es">
	<head>
		<link REL="SHORTCUT ICON" HREF="../../imagenes/logo5.ico">
    <title>Seltz</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.css" rel="stylesheet">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script> 
	</head>
	<style type="text/css">
		 body {
        font-family: "Swis721 BlkCn BT";

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
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 600px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    .col-sm-9 {
      width: 50%;
    }
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;
      } 
      .col-sm-9 {
      width: 100%;
    }
    }
	</style>
	<title>Seltz</title>
	<body>

		
<div class="container-fluid">
  <div class="row content">
      <div class="col-sm-3 sidenav">
        <p>
          <center><img src="../imagenes/logo5.png" width="50%"></center>
        </p>
        <ul class="nav nav-pills nav-stacked">
        	<hr>
          <li class="active"><a href="../sistema/logueo/index.php">Cerrar Sesión</a></li>
          
        </ul><br>
        <div class="input-group">
        </div>
      </div>
    

  <div class="col-sm-9">  
    <hr>
    <h1><span class="glyphicon glyphicon-cog"></span> Modificar Producto</h1>
    <hr>
    <form class="form-horizontal" method="POST" action="update_producto.php" autocomplete="off">
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">id Producto</label>
          <div class="col-sm-10">
            <input type="text" readonly=»readonly» class="form-control" id="nombre" name="id_producto" placeholder="Nombre" value="<?php echo $row['id_producto']; ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Nombre del Producto</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="nombre_producto" placeholder="Nombre" value="<?php echo $row['nombre_producto']; ?>" required>
          </div>
        </div>
        
        
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Descripcion</label>
          <div class="col-sm-10">
            <input type="emtext" class="form-control" id="nombre" name="descripcion" placeholder="Descripcion" value="<?php echo $row['descripcion']; ?>"required>
          </div>
        </div>
        <p>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Cantidad</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="cantidad" placeholder="cantidad del producto" value="<?php echo $row['cantidad']; ?>"required>
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Precio Compra</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="precio_c" placeholder="Precio de compra" value="<?php echo $row['precio_c']; ?>"required>
          
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Precio Venta</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="precio_v" placeholder="Precio de venta" value="<?php echo $row['precio_v']; ?>"required>
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Proveedor</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="id_proveedor" placeholder="Ingrese la ID Proveedor" value="<?php echo $row['id_proveedor']; ?>"required>
          </div>        
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a href="../sistema/gerente/g001.php" class="btn btn-default"><span class="glyphicon glyphicon-home"></span> Regresar</a>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>
          </div>
        </div>
        <p>
	</form>  
  	</div>

<div class="row content">
    <div class="col-sm-3 sidenav">
      <p>
        <center><h1>Lista de Proveedores</h1></center>
      </p>
      <hr>
      <table class="table table-striped">
          <thead>
            <tr>
              <th>ID Proveedor</th>
              <th>Nombre-Proveedor</th>
              
              
            </tr>
          </thead>
          
          <tbody>
            <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['id_proveedor']; ?></td>
                <td><?php echo $row['nombre_proveedor']; ?></td>
               
                
                
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <div class="input-group">

      </div>
    </div>
</div>
<footer >
    <center><h4>[Desarrolladores]</h4>
     
    <h5>Diego cubilla +595 0972 168 930</h5>
     
    <h5>Katherine Saucedo +595 0961 358 381</h5>
    </center>
    
  </footer>
	</body>
</html>