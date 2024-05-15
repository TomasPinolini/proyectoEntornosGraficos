<?php 
  include("../db.php"); 
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
    <h1>APROBAR DUEÑOS</h1>
    <br>

    <form action="" method="POST">
        <table border='1'>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Aprobación</th>
            </tr>    

            <?php
                $sql = "SELECT * FROM usuarios WHERE tipoUsuario = 'dueno de local'";
                $data = mysqli_query($mysqli, $sql);
                while($dueno = mysqli_fetch_array($data)){
                    $codUsuario = $dueno["codUsuario"];
                    $email = $dueno["nombreUsuario"];
                    echo "<tr><td>$codUsuario</td><td>$email</td>";
                    echo "<td><input type='checkbox' name='delete_ids[]' value='$codUsuario'>Borrar</td></tr>";
                }
            ?>
        </table>
        <input type="submit" value="submit">
    </form>
    <div>
    <button onclick="window.location.href='../MenuAdmin.php'">Menu Admin</button>
    </div>
</body>
</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["delete_ids"]) && is_array($_POST["delete_ids"])) {
            foreach ($_POST["delete_ids"] as $key => $value) {
                $codU = mysqli_real_escape_string($mysqli, $value);
                
                $sqlDueno = "DELETE FROM usuarios WHERE codUsuario = '$codU'";
                $sqlDuenoResult = mysqli_query($mysqli, $sqlDueno);

            }
        }
        header("Location: " . $_SERVER['PHP_SELF']);
    }
    // header("Location: ../menuAdmin.php");


?>

