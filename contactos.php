
<!DOCTYPE html>
<html lang="en">
<head>
  <link REL="SHORTCUT ICON" HREF="imagenes/logo5.ico">
  <title>Seltz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
  <style type="text/css">
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    body {
      font-family: "Square721 BT";

    }
    body::after {
             content: "";
             background: url(imagenes/img5.jpg);
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
 transition: all 2s ease 0.5s;
} 
  .navbar-inverse .nav li a{
  color: white;

}
.container-fluid {
    background-color: white;
  }
 .navbar-inverse .nav li a:hover{
  background-color: #fff;
  transition: all 1s ease 0s;
  color: #244c7c;
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
    .row {
      margin-top: 2%;
      margin-bottom: 2%; 
    }
    .col-sm-4 img {
      border-radius: 10px;
      box-shadow: -3px 3px 10px 1px gray;
    }
  </style>
</head>
<body>

<nav class="navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href=""></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="sistema/logueo/index.php"><span class="glyphicon glyphicon-user"></span> Iniciar Sesión</a></li>
        <li><a href="index.php"><span class=" glyphicon glyphicon-home"></span> Home</a></li>
        
        <li class="prendido"><a href="contactos.php"><span class="glyphicon glyphicon-earphone"></span> Contactos</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php"><?php echo date("d/m/y"); ?></a></li>
        
        <li><a href="sistema/logueo/index.php"> <span class=" glyphicon glyphicon-shopping-cart"></span> Hacer un pedido</a></li>
        <li><a href="sistema/logueo/index.php"><span class="glyphicon glyphicon-time"></span> Pedidos Realizados</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="jumbotron">
  <div class="container text-center">
    <br>
    <br>
    <h1><img src="imagenes/logo5.png" width="30%"></h1>      
    <p></p>
  </div>
</div>
<center>
 

<div class="container-fluid text-center">
  <div class="row content">

    <div class="col-sm-4">
    
     <h2><span class="glyphicon glyphicon-map-marker"></span></h2>
          <b><h3>Planta Industrial</b></h3>
          <h5>Av. San Roque González 1600 M.R Alonso, Paraguay</h5>
          <br>
          <img src="imagenes/planta.jpg">
    </div>
    <div class="col-sm-4">
       <h2><span class="glyphicon glyphicon-comment"></span></h2>
         
          <b><h3>Atencion al Cliente <p></p> </b>
          (+595 21) 289 0000</h3>
          <h5>
            Estamos disponibles en los siguientes horarios
          </h5>
          <h4><b>Verano</b></h4>
          <h5>Lunes a Viernes 07:00 a 19:00 hs <p></p>
            Sabados 07:00 a 16:00 hs
          </h5>
       <h4><b>Invierno</b></h4>
        <h5>Lunes a Viernes 07:00 a 18:00 hs <p></p>
            Sabados 07:00 a 15:00 hs
          </h5>
        </div>
        <div class="col-sm-4">
          <h2><span class="glyphicon glyphicon-list-alt"></span></h2>
         
          <b><h3>Administración</b></h3>
          <h3>(+595 21) 289 0100</h3>
           <h5>
            Te comunicamos con todos nuestros departamentos. <p></p>
            Lunes a Viernes 07:00 - 17:00 hs
          </h5>   
        </div>
</center>
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
