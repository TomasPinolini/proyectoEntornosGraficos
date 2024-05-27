<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Login-Register</title>
</head>
<body>
  <h1>Register</h1>
  <button onclick="redirectToLogIn()">Log In...</button>
  <form action="process_register.php" method="post" class="form">
    <div class="inp">
      <label for="email">Ingrese su dirección e-mail: </label>
      <input type="email" name="email" id="email" required />
    </div>
    <div class="inp">
      <label for="type">Tipo de usuario: </label>
      <select name="type" id="type" required>
        <option value="dueno">Dueño</option>
        <option value="cliente">Cliente</option>
      </select>
    </div>
    <div class="inp">
      <label for="password">Contraseña: </label>
      <input type="text" name="password" id="password" required />
    </div>
    <div class="inp">
      <label for="password_conf">Repita la contraseña: </label>
      <input type="text" name="password_conf" id="password_conf" required />
    </div>
    <input type="submit" name="submit" value="registro" />
    </div>
  </form>
</body>
</html>


