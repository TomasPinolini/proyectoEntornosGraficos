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
    <link rel="stylesheet" href="../styles/forms.css">
</head>
<body>
    <div class="welcome">Crear Novedad</div>
    <div class="form">
        <form action="" method="post">
        <div class="row-form">
            <label for="novedad">Nueva notificación:</label><br>
            <textarea id="novedad" name="novedad"></textarea>
        </div>
        <div class="row-form">
            <label for="startDate">Fecha de inicio:</label>
            <input type="date" id="startDate" name="startDate" value="<?php echo $today;?>"><br>
        </div>
        <div class="row-form">
            <label for="endDate">Fecha de fin:</label>
            <input type="date" id="endDate" name="endDate">
        </div>
            <div class="row-form">
            <label for="type">Tipo de usuario:</label>
            <select id="type" name="type">
                <option value="administrador">Administrador</option>
                <option value="dueno de local">Dueño de local</option>
                <option value="Premium">Cliente Premium</option>
                <option value="Medium">Cliente Medium</option>
                <option value="Inicial">Cliente Inicial</option>
            </select>
        </div>
        <div class="row-form">
            <input type="submit" value="Subir notificación">
        </div>

        </form>
    </div>
    <div>
    <button class="menu-btn" onclick="window.location.href='../MenuAdmin.php'">Menu Admin</button>
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