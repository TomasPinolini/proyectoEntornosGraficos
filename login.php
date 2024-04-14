<?php

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
  <button onclick="redirectToRegister()">Register...</button>
  <form action="" method="get" class="form">
    <div class="inp">
      <label for="name">Enter your email: </label>
      <input type="text" name="email" id="email" required />
    </div>
    <div class="inp">
      <label for="email">Password: </label>
      <input type="text" name="password" id="password" required />
    </div>
    <div class="inp">
      <input type="submit" value="Log in!" />
    </div>
  </form>
</body>
</html>