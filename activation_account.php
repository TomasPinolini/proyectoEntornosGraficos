<?php

    $token = $user["token_activation"];

    $mysqli = require __DIR__ . "/db.php";

    $sql = "SELECT * FROM usuarios WHERE token_activation = ?";

    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param("s", $token);

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if ($user === null) {
        die("token not found");
    }

    $sql = "UPDATE usuarios SET token_activation = NULL WHERE codUsuario = ?";

    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param("s", $user["codUsuario"]);

    $stmt->execute();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Account Activated</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Account Activated</h1>

    <p>Account activated successfully. You can now
       <a href="login.php">log in</a>.</p>

</body>
</html>