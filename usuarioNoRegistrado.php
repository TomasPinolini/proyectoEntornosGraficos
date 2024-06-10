<?php 
  include("db.php"); 
  session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/menu.css">
    <title>Menu Usuario no Registrado</title>
</head>
<body>
    <div class="welcome"><img src="UTN_logo.png" alt="" class="logoutn">Bienvenido!</div>
    <div class="container text-center">
        <div class="row"><a class="button-link" href="menuNoR/todas_promociones.php">Visualizar todas las promociones</a></div>
        <div class="row"><a class="button-link" href="menuNoR/mailAdmin.php">Mail al Administrador</a></div>
    </div>
    <div class="container text-center">
        <div class="row"><button class="button-link logout" onclick="window.location.href='index.php'">Log In</button></div>
    </div>
</body>
</html>