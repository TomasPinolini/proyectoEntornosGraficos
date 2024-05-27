<?php
  session_start();
  if($_POST["password"] !== $_POST["password_conf"]){
    die("Las contraseñas no coinciden.");
  }
  
  if($_POST["type"] === "cliente"){
    $activation_token = bin2hex(random_bytes(16));
    // $_SERVER["token_activation"] = $activation_token;
  }
  

  $email = filter_input(INPUT_POST, "email");
  $type = filter_input(INPUT_POST, "type");
  $password = filter_input(INPUT_POST, "password");
  $typeCli = "";

  $mysqli = require __DIR__ . "/db.php";

  if (!$mysqli) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO usuarios (nombreUsuario, claveUsuario, tipoUsuario, 
    categoria_cliente, token_activation) VALUES (?, ?, ?, ?, ?)";

  $stmt = $mysqli->stmt_init();
  
  if(! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli.error);
  }
  
  if($type == "cliente"){
    $typeCli = "Inicial";

    $mail = require __DIR__ . "/mailer.php";
    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Account Activation";
    $mail->Body = <<<END

    Click <a href="https://localhost\eg\proyecto\activation_account.php?token=$activation_token">here</a> 
    to activate your account.

    END;

    try{
        $mail->send();
    }catch (Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        exit;
    }

  }else{
    $type = 'dueno de local';
  }

  $stmt->bind_param("sssss",$email, $password, $type, $typeCli, $activation_token);

  if($stmt -> execute()){
    header("Location: registrado.php");
    exit;
  }else{
    print_r($mysqli->errno);
    if($mysqli->errno === 1062){
      die("Email already taken.");
    }
  }
?>