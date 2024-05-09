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
    <h1>APROBAR DUENOS</h1>
    <br>
    <div>
    <button onclick="window.location.href='MenuAdmin.php'">Menu Admin</button>
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