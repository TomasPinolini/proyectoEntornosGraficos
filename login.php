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
  <form action="" method="POST" class="form">
    <div class="inp">
      <label for="name">Enter your email: </label>
      <input type="text" name="email" id="email" required />
    </div>
    <div class="inp">
      <label for="password">Password: </label>
      <input type="text" name="password" id="password" required />
    </div>
    <div class="inp">
      <input type="submit" value="login" name="login"/>
    </div>
  </form>
  <div>
    <button onclick="window.location.href='MenuAdmin.php'">Menu Admin</button>
  </div>
  <div>
    <button onclick="window.location.href='MenuDueno.php'">Menu Dueno</button>
  </div>
  <div>
    <button onclick="window.location.href='MenuCliente.php'">Menu Cliente</button>
  </div>
  <div>
    <button onclick="window.location.href='usuarioNoRegistrado.php'">Usuarios No Registrados</button>
  </div>
</body>
</html>

<?php
  if(isset($_POST["login"])){
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombreUsuario = ? AND claveUsuario = ?");
    $stmt->bind_param('ss', $_POST["email"], $_POST["password"]);
    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if($user){
      $_SESSION["user_id"] = ["codUsuario"]; 
      $_SESSION["email"] = $user["nombreUsuario"]; 
      $_SESSION["password"] = $user["claveUsuario"];  
      $_SESSION["tipoUsuario"] = $user["tipoUsuario"];  
      $_SESSION["catCliente"] = $user["categoria_cliente"];  

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
    } else {
      echo "Invalid email or password.";
    }
  }

?>