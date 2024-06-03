<?php 
  include("../db.php"); 
  session_start();  
  $option = "";
  $duenos = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE tipoUsuario = 'dueno de local'");
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
    <link rel="stylesheet" href="../styles/tables.css">
    <link rel="stylesheet" href="../styles/menues.css">
    <link rel="stylesheet" href="../styles/forms.css">
</head>
<body>
  <div class="welcome">Crear Local</div>
  <div class="form">
    <form action="" method="post">
      <div class="row-form">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name">
      </div>
      <div class="row-form">
        <label for="location">Ubicación:</label>
        <input type="text" id="location" name="location">
      </div>
      <div class="row-form">
        <label for="rubro">Rubro:</label>
        <select id="rubro" name="rubro">
            <option value="gastronomia">Gastronomía</option>
            <option value="indumentaria">Indumentaria</option>
            <option value="perfumeria">Perfumería</option>
        </select>
      </div>
      <div class="row-form">
        <label for="dueno">Dueño:</label>
        <select id="dueno" name="dueno">
            <?php echo $option;?>
        </select>
      </div>
      <div class="row-form">        
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>
  <div class="menu-btn"><button onclick="window.location.href='../MenuAdmin.php'">Menu Admin</button></div>
</body>
</html>
<?php
if(isset($_POST["name"])){
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
    mysqli_query($mysqli, $sql);
    header("Location: ../menuAdmin.php");
  }
  mysqli_close($mysqli);

}
?>