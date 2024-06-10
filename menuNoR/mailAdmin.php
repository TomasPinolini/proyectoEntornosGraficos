<?php
    session_start();
    include("../db.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/forms.css">
    <title>Mail al administrador</title>
</head>
<body>
  <div class="welcome"><img src="../UTN_logo.png" alt="" class="logoutn">Envío correo</div>
  <form action="" method="POST">
      <label for="emailp">Dirección email proveniente:</label>
      <input type="email" id="emailp" name="emailp" required />
      
      <label for="asunto">Asunto:</label>
      <input type="text" id="asunto" name="asunto" required />
      
      <label for="cuerpo">Cuerpo:</label>
      <textarea id="cuerpo" name="cuerpo" required></textarea>
      
      <input type="submit" value="Submit">
  </form>
  <button onclick="window.location.href='../usuarioNoRegistrado.php'">Menu Usuario no Registrado</button>


</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["emailp"])) {
        $emailP = $_POST["emailp"];
        $asunto = filter_input(INPUT_POST, "asunto");
        $cuerpo = filter_input(INPUT_POST, "cuerpo");
        
        $sql = "SELECT * FROM usuarios WHERE tipoUsuario = 'administrador' LIMIT 1";
        $result = mysqli_query($mysqli, $sql);

        if ($result) {
          $usuario = mysqli_fetch_assoc($result);
          if ($usuario) {
            $mailAdmin = $usuario["nombreUsuario"];
            $mail = require __DIR__ . "/../mailer.php";
            $mail->setFrom("$emailP");
            $mail->addAddress($mailAdmin);
            $mail->Subject = $asunto;
            $mail->Body = $cuerpo;
      
            try {
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
                exit;
            }
            header("Location: ../index.php");          } else {
              echo "No se encontró ningún usuario administrador.";
          }
          mysqli_free_result($result);
      } else {
          echo "Error al ejecutar la consulta: " . mysqli_error($mysqli);
      }
      mysqli_close($mysqli);

    }
}
?>