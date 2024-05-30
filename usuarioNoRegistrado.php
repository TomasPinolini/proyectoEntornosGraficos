<?php 
  include("db.php"); 
  session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Usuario no Registrado</title>
</head>
<body>
    <div class="welcome">Bienvenido Usuario no Registrado!</div>
    <div class="navbar">
        <a href="todas_promociones.php">Visualizar todas las promociones</a>
    <?php
         if (isset($_SESSION["email"])) {
            echo $_SESSION["email"] . "<br>";
        }
    
        if (isset($_SESSION["password"])) {
            echo $_SESSION["password"] . "<br>";
        }

        if(isset($_POST["logout"])){
            session_destroy();
            header("Location: login.php");
        }

    ?>  
    </div>
    <div>
    <button onclick="window.location.href='login.php'">Log in</button>
    </div>
</body>
</html>