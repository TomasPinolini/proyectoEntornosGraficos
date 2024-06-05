<?php
    session_start();
    $mail = null;
    $token = null;
    
    function generadorToken() {
        $characteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $tokenn = '';
        $max = strlen($characteres) - 1;
        for ($i = 0; $i < 6; $i++) { $tokenn .= $characteres[mt_rand(0, $max)]; }
        return $tokenn;
    }
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
    <h2>Cree su cuenta</h2>
    <div class="form">
      <form action="" method="post">
          <label for="email">Dirección email:</label>
          <input type="text" id="email" name="email" required />
          <input type="submit" value="Submit">
      </form>
    </div>


</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email"])) {
        $email = filter_input(INPUT_POST, "email");
        $given_token = generadorToken();
        $_SESSION["given_token"] = $given_token;
        $_SESSION["email"] = $email;
        $mail = require __DIR__ . "/mailer.php";
        $mail->setFrom("noreply@example.com");
        $mail->addAddress($email);
        $mail->Subject = "Reiniciar clave";
        $mail->Body = <<<END
                <p>Reniciá tu contrasena.</p>
                <p>Para verificar tu dirección de correo electrónico y cambiar tu contraseña, utiliza el siguiente código de verificación:</p>
                <h2 style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;">Código de Verificación: $given_token</h2>
                <p>Saludos</p>
            END;

            try {
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                exit;
            }
            header("Location: reset_pass2.php");
    }
}
?>