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

  if(!empty($_POST))
  {
    $valor = $_POST['campo'];
    if(!empty($valor)){
      $where = "WHERE nombre LIKE '%$valor'";
    }
  }
  $sql = "SELECT id_producto, nombre_producto, descripcion, cantidad, precio_c, precio_v, nombre_proveedor FROM producto,proveedor $where";
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

      }

    .row.content {height: 600px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* pie de página */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    .usuario {
      background-color: white;
      border-radius: 100px;
    }
    /* responsive  */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;}
      
      .row.table-responsive {
         text-align: center;
         margin: 0% 0.1% 0%;
      } 
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
        <li class="active"><a href="g001.php"><span class="glyphicon glyphicon-list-alt"></span> Lista de Productos</a></li>
        <li><a href="g002.php"><span class="  glyphicon glyphicon-plus-sign"></span> Agregar Producto</a></li></ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Escriba aquí para buscar el producto">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>

    
      
      
      <hr>

      <h1><span class="glyphicon glyphicon-list-alt"></span> Lista de Productos</h1>

      <hr> 

<div class="row table-responsive">

        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Producto</th>
              <th>Descripcion</th>
              <th>Cantidad</th>
              <th>Precio Compra</th>
              <th>Precio Venta</th>
              <th>Proveedor</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          
          <tbody>
            <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['id_producto']; ?></td>
                <td><?php echo $row['nombre_producto']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo $row['precio_c']; ?></td>
                <td><?php echo $row['precio_v']; ?></td>
                <td><?php echo $row['nombre_proveedor']; ?></td>
                <td><a href="modificar_producto.php?id_producto=<?php echo $row['id_producto']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td><a href="#" data-href="../../php/eliminar_producto.php?id_producto=<?php echo $row['id_producto']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

        <hr>
    </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
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



<footer class="container-fluid">
  <center><p>Desarrolladores</p>
  <p>Katherine Saucedo</p>
  <p>Diego Cubilla</p></center>
</footer>

    <script>
      $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        
        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
      });
    </script>
</body>
</html>
