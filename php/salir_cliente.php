<?php  
session_start();
session_destroy();
header("location: ../sistema/logueo/index.php");
exit();
?>