<?php 
    session_start();
    if(!isset($_SESSION["codUsuario"])){
        header("Location: login.php");
        exit;
    }else{
        $mysqli = require __DIR__ . "/db.php";
        $sql = "SELECT * FROM usuarios WHERE codUsuario = {$_SESSION["codUsuario"]}"; 
        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc(); 
        $mailUsuario = ucfirst(explode('@', $user["nombreUsuario"])[0]);
    }   
    // var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cliente</title>
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
    <div class="welcome">Bienvenido <?= htmlspecialchars($mailUsuario) ?>!</div>
    <div class="navbar">
        <a href="menuCli/ver_promos.php">Ver Promociones</a>
        <a href="menuCli/usar_promo.php">Utilizar Ofertas</a>
        <a href="ver_novedades.php">Ver Novedades</a>
    </div>
    <div>
        <button onclick="window.location.href='logout.php'">Log out</button>
    </div>
    
    
</body>
</html>