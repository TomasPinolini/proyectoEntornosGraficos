<?php 
  include("db.php"); 
  session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login-Register</title>
</head>
<body>
  <button onclick="redirectToLogIn()">Log In...</button>
  
  <form action="" method="post" class="form">
    <div class="inp">
      <label for="email">Ingrese su dirección e-mail: </label>
      <input type="email" name="email" id="email" required />
    </div>
    <div class="inp">
      <label for="type">Tipo de usuario: </label>
      <select name="type" id="type" required>
        <option value="admin">Administrador</option>
        <option value="dueno">Dueño</option>
        <option value="cliente">Cliente</option>
      </select>
    </div>
    <div class="inp">
      <div class="inp">
        <label for="password">Contraseña: </label>
        <input type="text" name="password" id="password" required />
      </div>
      <input type="submit" name="submit" value="Registro" />
    </div>
  </form>
</body>
</html>

<?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = filter_input(INPUT_POST, "email");
    $type = filter_input(INPUT_POST, "type");
    $password = filter_input(INPUT_POST, "password");

    if(empty($email)){
      echo "La dirección email es requerida.";
    }elseif(empty($type)){
      echo "El tipo de usuario es requerido.";
    }elseif(empty($password)){
      echo "La contraseña es requerida.";
    }else{
      // Falta q corrobore q no haya un usuario registrado
      // con ese email ya.
      $sql = "INSERT INTO usuarios (email, password, tipo) VALUES ('$email', '$password', '$type')";
      mysqli_query($conn, $sql);
      header("Location: login.php");

    }
  }
  mysqli_close($conn);
?>
