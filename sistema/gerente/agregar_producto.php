<?php
  require '../../php/conexion.php';
   session_start();
  $usuario_sesion = $_SESSION['user'];
  $id_usuario = $_SESSION['id_usuario'];
  $tipo_user = $_SESSION['id_tipo_usuario'];

  $where = "";
  
   if(!isset($usuario_sesion))
  {
    header("location: ../logueo/index.php");
  }elseif($tipo_user != 4){
    header("location: index.php");
  }

  $where = "";
  
  if(!empty($_POST))
  {
    $valor = $_POST['campo'];
    if(!empty($valor)){
      $where = "WHERE nombre LIKE '%$valor'";
    }
  }
  $sql = "SELECT id_proveedor, nombre_proveedor FROM proveedor $where";
  $resultado = $mysqli->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Seltz</title>
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
    .col-sm-5 {
      margin-left: 25%;
      position: fixed;
      background-color: #fff;
      height: 100%;
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
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;
      } 
      
    }
    h2 {
      color:#fff;
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
          <li class="usuario"><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $usuario_sesion?></a></li>
           <li><a href="../../php/salir_gerente.php"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a></li>
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="lista_de_productos.php"><span class="glyphicon glyphicon-list-alt"></span> Lista de Productos</a></li>
        <li class="active"><a href="agregar_producto.php"><span class="  glyphicon glyphicon-plus-sign"></span> Agregar Producto</a></li>
        </ul><br>
        <div class="input-group">
        </div>
      </div>
    

  <div class="col-sm-5">  
    <hr>
    <h1><span class="glyphicon glyphicon-plus-sign"></span> Agregar Producto Nuevo</h1>
    <hr>
    <form class="form-horizontal" method="POST" action="../../php/guardar_producto.php" enctype="multipart/form-data" autocomplete="off">


        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Producto</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="nombre_producto" placeholder="Nombre" required>
          </div>
        </div>
        
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Descripcion</label>
          <div class="col-sm-10">
            <input type="emtext" class="form-control" id="nombre" name="descripcion" placeholder="Descripcion" required>
          </div>
        </div>
        <p>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Cantidad</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="cantidad" placeholder="cantidad del producto">
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Precio Compra</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="precio_c" placeholder="Precio de compra">
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Precio Venta</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="precio_v" placeholder="Precio de venta">
          </div>
        </div>
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Proveedor</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nombre" name="id_proveedor" placeholder="Ingrese la ID Proveedor">
          </div>        
        </div>
        

        
        <div class="form-group">
          <label for="archivo" class="col-sm-2 control-label">Archivo</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="archivo" name="archivo" accept="image/jpg"/>
          </div>
        </div>
        
        


      
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-home"></span> Regresar</a>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>
          </div>
        </div>
        <p>
      </form>
  </div>
    
    <div class="col-sm-8">
      
    </div>   
    <div class="col-sm-4">
      <hr>
      <p>
        <center><h2>Lista de Proveedores</h2></center>
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
  
  </div>
</div>
</footer>

</body>
</html>
