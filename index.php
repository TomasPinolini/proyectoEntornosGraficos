<?php
session_start();
function generadorToken() {
    $characteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    $max = strlen($characteres) - 1;
    for ($i = 0; $i < 6; $i++) { $token .= $characteres[mt_rand(0, $max)]; }
    return $token;
}
$login_invalid = false;
$validated = true;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["login"])) {
        $mysqli = require __DIR__ . "/db.php";

        $sql = sprintf("SELECT * FROM usuarios WHERE nombreUsuario = '%s'",
            $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($_POST["password"] === $user["claveUsuario"] && 
                $_POST["email"] === $user["nombreUsuario"] && 
                $user["token_activation"] === null) {
                $_SESSION = $user;
                switch ($user["tipoUsuario"]) {
                    case "administrador":
                        header("Location: MenuAdmin.php");
                        break;
                    case "dueno de local":
                        header("Location: MenuDueno.php");
                        break;
                    case "cliente":
                        header("Location: MenuCliente.php");
                        break;
                }
                exit;
            } else if (isset($user["token_activation"])) {
                $validated = false;
            }        
        }else{
            $login_invalid = true;
        }
    } elseif (isset($_POST["register"])) {
        // Registration process
        if ($_POST["password"] !== $_POST["password_conf"]) {
            die("Las contraseñas no coinciden.");
        }

        $email = filter_input(INPUT_POST, "email");
        $type = filter_input(INPUT_POST, "type");
        $password = filter_input(INPUT_POST, "password");
        $typeCli = "";
        $activation_token = null;


        $mysqli = require __DIR__ . "/db.php";

        if (!$mysqli) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO usuarios (nombreUsuario, claveUsuario, tipoUsuario, 
            categoria_cliente, token_activation) VALUES (?, ?, ?, ?, ?)";

        $stmt = $mysqli->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        if ($type == "cliente") {
            $activation_token = generadorToken();
            $typeCli = "Inicial";

            $mail = require __DIR__ . "/mailer.php";
            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
            $mail->Subject = "Account Activation";
            $mail->Body = <<<END
                <p>Bienvenido cliente!</p>
                <p>Gracias por registrarte en nuestro sitio web. Para verificar tu dirección de correo electrónico, utiliza el siguiente código de verificación:</p>
                <h2 style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;">Código de Verificación: $activation_token</h2>
                <p>Si no solicitaste esta verificación, puedes ignorar este correo electrónico. Si tienes alguna pregunta, no dudes en contactarnos.</p>
                <p>Saludos,<br>El equipo de nuestro sitio web</p>
            END;

            try {
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                exit;
            }
        } else {
            $type = 'dueno de local';
        }

        $stmt->bind_param("sssss", $email, $password, $type, $typeCli, $activation_token);

        if ($stmt->execute()) {
            if($type == "cliente"){
                header("Location: registrado.php");
            }else{
                header("Location: index.php");
            }
            exit;
        } else {
            if ($mysqli->errno === 1062) {
                die("Email already taken.");
            } else {
                die("SQL error: " . $mysqli->error);
            }
        }
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <div class="cont">
        <div class="form sign-in">
            <h2>Bienvenido!</h2>
            <?php if ($login_invalid): ?>
                <br><em>Usuario o contraseña incorrecto, intente de nuevo.</em>
            <?php endif ?>
            <?php if (!$validated): ?>
                <br><em>Confirme el registro antes de ingresar.</em><br>
            <?php endif ?>
            <form action="" method="POST">
                <label>
                    <span>Correo electrónico</span>
                    <input type="email" name="email" required />
                </label>
                <label>
                    <span>Contraseña</span>
                    <input type="password" name="password" required />
                </label>
                <p class="forgot-pass"><a href="reset_pass.php">Olvido su contraseña?</a></p>
                <input type="submit" name="login" class="submit" value="Sign In">
            </form>
        </div>

        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h3>Todavía no tiene cuenta? Registrese aquí!</h3>
                </div>
                <div class="img__text m--in">
                    <h3>Si ya tiene una cuenta activa, ingrese aquí!.</h3>
                </div>
                <div class="img__btn">
                    <span class="m--up">Registrarse</span>
                    <span class="m--in">Ingresar</span>
                </div>
            </div>
            <div class="form sign-up" style="display:none;">
                <h2>Cree su cuenta</h2>
                <form action="" method="POST">
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" required />
                    </label>
                    <label>
                        <span>Tipo de usuario</span><br>
                        <select name="type" required>
                            <option value="dueno">Dueño</option>
                            <option value="cliente">Cliente</option>
                        </select>
                    </label>
                    <label>
                        <span>Contraseña</span>
                        <input type="password" name="password" required />
                    </label>
                    <label>
                        <span>Repita la contraseña</span>
                        <input type="password" name="password_conf" required />
                    </label>
                    <input type="submit" name="register" class="submit" value="Ingresar">
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.img__btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s--signup');
            document.querySelector('.sign-in').style.display = document.querySelector('.sign-in').style.display === 'none' ? 'block' : 'none';
            document.querySelector('.sign-up').style.display = document.querySelector('.sign-up').style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>
</html>