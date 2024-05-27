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