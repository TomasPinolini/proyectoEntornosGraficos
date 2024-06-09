<?php 
session_start(); 
include("db.php"); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <link rel="stylesheet" href="styles/menues.css">
    <link rel="stylesheet" href="styles/forms.css">
    <title>Login-Register</title>
</head>
<body style="margin: 3%;">
    <h2>Enter Your 6-Digit Token</h2>
        <form action="" method="POST">
            <label for="token">Token:</label>
            <input type="text" id="token" name="token" title="Please enter a 6-digit number." required><br><br>
            <input type="submit" value="Verify">
        </form>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $given_token = $_POST["token"];
    $sql_update = "UPDATE usuarios SET token_activation = NULL WHERE token_activation = ?";
    $stmt_update = $mysqli->prepare($sql_update);
    $stmt_update->bind_param("s", $given_token);
    $stmt_update->execute();
    $stmt_update->close();

    $mysqli->close();
    header("Location: menuCliente.php");
}
?>