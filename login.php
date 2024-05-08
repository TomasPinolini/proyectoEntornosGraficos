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
</body>
</html>

<?php
  // if(isset($_POST["login"])){
  //   echo "xxxxxxxxxxxxx";
  // if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //   $password= test_input($_POST["password"]);
  //   $email = test_input($_POST["email"]);
  // }

  if(isset($_POST["login"])){
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND password = ?");
    $stmt->bind_param('ss', $_POST["email"], $_POST["password"]);
    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if($user){
      $_SESSION["user_id"] = $user["id"]; 
      $_SESSION["email"] = $_POST["email"]; 
      $_SESSION["password"] = $_POST["password"]; 

      header("Location: home.php");
      exit;
    } else {
      echo "Invalid email or password.";
    }
  }

?>