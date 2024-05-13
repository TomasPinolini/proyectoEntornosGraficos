<?php 
  include("../db.php"); 
  session_start();  
//   $usuarios = mysqli_query($conn, "SELECT * FROM usuarios");
//   while($usuario = mysqli_fetch_array($usuarios)){
  $option = "";
  $duenos = mysqli_query($conn, "SELECT * FROM usuarios WHERE tipoUsuario = 'dueno de local'");
  while($dueno = mysqli_fetch_array($duenos)){
    $codUsuario = $dueno["codUsuario"];
    $nombreUsuario = $dueno["nombreUsuario"];
    $option .= "<option value = '$codUsuario'>$nombreUsuario</option>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CREAR LOCALES</h1>
    <br>
    <form action="" method="post">
        <label for="name">Nombre:</label><br>
        <input type="text" id="name" name="name"><br>
        
        <label for="location">Ubicación:</label><br>
        <input type="text" id="location" name="location"><br>
        
        <label for="rubro">Rubro:</label><br>
        <select id="rubro" name="rubro">
            <option value="gastronomia">Gastronomía</option>
            <option value="indumentaria">Indumentaria</option>
            <option value="perfumeria">Perfumería</option>
        </select><br>
        <label for="dueno">Dueño:</label><br>
        <select id="dueno" name="dueno">
            <?php echo $option;?>
        </select><br>
        
        <input type="submit" value="Submit">
    </form><br>
    <div>
    <button onclick="window.location.href='../MenuAdmin.php'">Menu Admin</button>
    </div>
</body>
</html>
<?php

$nomLocal = filter_input(INPUT_POST, "name");
$ubiLocal = filter_input(INPUT_POST, "location");
$rubroLocal = filter_input(INPUT_POST, "rubro");
$duenoLocal = filter_input(INPUT_POST, "dueno");

if(empty($nomLocal)){
  echo "El nombre es requerido.";
}elseif(empty($ubiLocal)){
  echo "La ubicación es requerido.";
}elseif(empty($rubroLocal)){
    echo "El rubro del local es requerido.";
}elseif(empty($duenoLocal)){
    echo "El dueño del local es requerido.";
}else{
  $sql = "INSERT INTO locales (nombreLocal, ubicacionLocal, rubroLocal, codUsuario) 
  VALUES ('$nomLocal', '$ubiLocal', '$rubroLocal', '$duenoLocal')";
  mysqli_query($conn, $sql);
  header("Location: ../menuAdmin.php");
}
mysqli_close($conn);
    //  if (isset($_SESSION["email"])) {
    //     echo $_SESSION["email"] . "<br>";
    // }

    // if (isset($_SESSION["password"])) {
    //     echo $_SESSION["password"] . "<br>";
    // }

    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: login.php");
    }

?>