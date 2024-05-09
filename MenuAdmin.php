<?php 
  include("db.php"); 
  session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Administrador</title>
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
    <div class="welcome">Bienvenido Administrador!</div>
    <div class="navbar">
        <a href="gestion_ofertas.php">Gestionar Ofertas</a>
        <a href="crear_locales.php">Crear Locales</a>
        <a href="aprobar_duenos.php">Aprobar Duenos</a>
        <a href="aprobar_promos.php">Aprobar Promos</a>
        <a href="novedades.php">Crear Novedades</a>
        <a href="uso_desc.php">Uso Descuentos</a>
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