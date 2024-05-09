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
    <h1>NOVEDADES</h1>
    <br>
    <form action="guardar_novedad.php" method="post">
        <label for="novedad">Nueva notificación:</label><br>
        <textarea id="novedad" name="novedad"></textarea><br>

        <label for="startDate">Fecha de inicio:</label><br>
        <input type="date" id="startDate" name="startDate"><br>

        <label for="endDate">Fecha de fin:</label><br>
        <input type="date" id="endDate" name="endDate"><br>

        <label for="type">Tipo de usuario:</label><br>
        <select id="type" name="type">
            <option value="administrador">Administrador</option>
            <option value="dueno_de_local">Dueño de local</option>
            <option value="cliente">Cliente</option>
        </select><br>

        <input type="submit" value="Subir notificación">
    </form>
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