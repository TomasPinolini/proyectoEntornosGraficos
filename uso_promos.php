<?php 
  include("db.php"); 
  session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>USO PROMO</h1>
    <br>
    <div>
    <button onclick="window.location.href='MenuDueno.php'">Menu Dueno</button>
    </div>
</body>
</html>
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