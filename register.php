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
      <label for="name">Enter your name: </label>
      <input type="text" name="name" id="name" required />
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
      <input type="submit" value="Register!" />
    </div>
  </form>
</body>
</html>