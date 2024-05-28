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
    <link rel="stylesheet" href="../styles/tables.css">
    <link rel="stylesheet" href="../styles/menues.css">
    <link rel="stylesheet" href="../styles/forms.css">
</head>
<body>
    <div class="welcome">Crear Novedad</div>
    <form class = "form" action="" method="post">
        <label for="novedad">Nueva notificación:</label><br>
        <textarea id="novedad" name="novedad"></textarea>

        <label for="startDate">Fecha de inicio:</label>
        <input type="date" id="startDate" name="startDate" value="<?php echo $today;?>"><br>

        <label for="endDate">Fecha de fin:</label>
        <input type="date" id="endDate" name="endDate">

        <label for="type">Tipo de usuario:</label>
        <select id="type" name="type">
            <option value="administrador">Administrador</option>
            <option value="dueno de local">Dueño de local</option>
            <option value="Premium">Cliente Premium</option>
            <option value="Medium">Cliente Medium</option>
            <option value="Inicial">Cliente Inicial</option>
        </select>

        <input type="submit" value="Subir notificación">
    </form>
    <div>
    <button onclick="window.location.href='../MenuAdmin.php'">Menu Admin</button>
    </div>
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