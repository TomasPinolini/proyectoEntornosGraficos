<?php 
  include("../db.php"); 
  session_start();  
  $today = date('Y-m-d');

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
    <form action="" method="post">
        <label for="novedad">Nueva notificación:</label><br>
        <textarea id="novedad" name="novedad"></textarea><br>

        <label for="startDate">Fecha de inicio:</label><br>
        <input type="date" id="startDate" name="startDate" value="<?php echo $today;?>"><br>

        <label for="endDate">Fecha de fin:</label><br>
        <input type="date" id="endDate" name="endDate"><br>

        <label for="type">Tipo de usuario:</label><br>
        <select id="type" name="type">
            <option value="administrador">Administrador</option>
            <option value="dueno de local">Dueño de local</option>
            <option value="cliente">Cliente</option>
        </select><br><br>

        <input type="submit" value="Subir notificación">
    </form><br>
    <div>
    <button onclick="window.location.href='../MenuAdmin.php'">Menu Admin</button>
    </div><br>
</body>
</html>
<?php
    if(isset($_POST["novedad"])){
        $sql = "INSERT INTO novedades (textoNovedad, fechaDesdeNovedad, fechaHastaNovedad, tipoUsuario) VALUES (?,?,?,?)";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param("ssss", $_POST["novedad"], $_POST["startDate"], $_POST["endDate"], $_POST["type"]);
        $stmt -> execute();
    }
?>