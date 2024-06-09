<?php 
    session_start();
    if(!isset($_SESSION["codUsuario"])){
        header("Location: index.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/menu.css">
</head>
<body>
    <div class="welcome"><img src="UTN_logo.png" alt="" class="logoutn">Bienvenido <?= htmlspecialchars($mailUsuario) ?>!</div>
    <img src="UTN_logo.jpg" alt="" class="logoutn">
    <div class="container text-center">
        <div class="row"><a class="button-link"href="menuCli/ver_promos.php">Ver Promociones</a></div>
        <div class="row"><a class="button-link"href="menuCli/usar_promo.php">Utilizar Ofertas</a></div>
        <div class="row"><a class="button-link"href="ver_novedades.php">Ver Novedades</a></div>
    </div>
    <div class="container text-center">
        <div class="row"><button class="button-link logout" onclick="window.location.href='logout.php'">Log out</button></div>
    </div>

</body>
</html>