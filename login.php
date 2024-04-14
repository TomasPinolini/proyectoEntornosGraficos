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
      <input type="submit" value="login" />
    </div>
  </form>
</body>
</html>

<?php
  if(isset($_POST["login"])){
    /* Necesitamos que este if corrobore 
    que los datos coincidan con algún 
    usuario de la base.
    */
    if(!empty($_POST["email"]) && !empty($_POST["password"])){
      $_SESSION["email"] = $_POST["email"];
      $_SESSION["password"] = $_POST["password"];      

      header("Location: home.php");
    }else{
      echo "Faltan datos a ingresar.";
    }

  }

?>