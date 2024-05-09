<?php 
  include("db.php"); 
  session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Dueño</title>
    <style>
        body {
            background-color: #f0f0f0; /* Cambia esto al color que prefieras */
        }

        .welcome {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .navbar a {
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            flex: 1 1 auto;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        @media (max-width: 600px) {
            .navbar a {
                flex: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="welcome">Bienvenido Dueño!</div>
    <div class="navbar">
        <a href="menuDue/ingresar_promo.php">Ingresar Promo</a>
        <a href="menuDue/gestion_descuentos.php">Gestion Descuentos</a>
        <a href="menuDue/uso_promos.php">Uso Promos</a>
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