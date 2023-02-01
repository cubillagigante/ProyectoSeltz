

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

    
  </style>
</head>
<body>
  <?php 
    echo "<h1>Tabla con imagenes</h1>";
    function valida_imagen($imagen){
      $rdo = 0;
      if(ereg("[Jj][Pp][Gg]",$imagen)) $rdo = 1;
      if(ereg("[Gg][Ii][Ff]",$imagen)) $rdo = 1;
      if(ereg("[Pp][Nn][Gg]",$imagen)) $rdo = 1;
      if(ereg("[Bb][Mm][Pp]",$imagen)) $rdo = 1;
    
      return $rdo;

    }
    echo "<table border=2>";
    $puntero = opendir('files');
    $img = 1;
    while (false!==($imagenes=readdir($puntero))) {
        if ($imagenes!="." && $imagenes!="..") {
            if ($img == 1) {
              echo "<tr>";
              echo "<td><a href='files/$imagenes'";
              echo "<img src='files/$imagenes'</img>";
              echo "</a></td>";
            }
              if ($img==4) {
                echo "</tr>";
                $img = 0;
              
              $img++;
            }
        }
    }
    closedir($puntero);
    echo "</table>";
  ?>
</body>
</html>
