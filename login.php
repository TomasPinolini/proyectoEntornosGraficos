<?php  
  session_start();
  $is_invalid = false;
  $validated = true;

  if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $mysqli = require __DIR__ . "/db.php";
    
    $sql = sprintf("SELECT * FROM usuarios WHERE nombreUsuario = '%s'",
        $mysqli -> real_escape_string($_POST["email"]));
    
    $result = $mysqli -> query($sql);

    $user = $result -> fetch_assoc();
    
    if($_POST["password"] === $user["claveUsuario"] && 
          $user["token_activation"]=== null){
      
      $_SESSION = $user;
      switch($user["tipoUsuario"]){
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
    }else if(isset($user["token_activation"])){
      $validated = false;
    }
    $is_invalid = true;
}
?>
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
  <h1>Log In</h1>
  <button onclick="redirectToRegister()">Register...</button>
  <?php if($is_invalid):?>
    <br><em>Log In inválido</em>
  <?php endif ?>
  <?php if(!$validated):?>
    <br><em>Confirme el registro.</em><br>
  <?php endif ?>
  <form action="process_login.php" method="POST" class="form">
    <div class="inp">
      <label for="name">Enter your email: </label>
      <input type="email" name="email" id="email" 
      value = "<?= htmlspecialchars($_POST["email"] ?? "") ?>"/>
    </div>
    <div class="inp">
      <label for="password">Password: </label>
      <input type="text" name="password" id="password" required />
    </div>
    <div class="inp">
      <input type="submit" value="login" name="login"/>
    </div>
  </form>
</body>
</html>
