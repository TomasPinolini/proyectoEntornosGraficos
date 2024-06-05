<?php
session_start();
var_dump($_SESSION);
$given_token = $_SESSION["given_token"];
$email = $_SESSION["email"];
$mysqli = require __DIR__ . "/db.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/forms.css">
    <title>Reiniciar contraseña</title>
</head>
<body>
    <div class="form" style="margin: 10px 10px;">
        <form action="" method="post">

            <label for="token">Token recibido:</label>
            <input type="text" id="token" name="token" required />

            <label for="pass">Contraseña nueva:</label>
            <input type="text" id="pass" name="pass" required />

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["token"]) && isset($_POST["pass"])){
        $token = $_POST["token"];
        if($token != $given_token){
            echo "<p>Token incorrecto.</p>";
        }
        $new_pass = $_POST["pass"];
        $sql_update = "UPDATE usuarios SET claveUsuario = ? WHERE nombreUsuario = ?";
        $stmt_update = $mysqli->prepare($sql_update);
        $stmt_update->bind_param("ss", $new_pass, $email);
        $stmt_update->execute();
        $stmt_update->close();

        $mysqli->close();
        header("Location: index.php");

    } 
}
?>
