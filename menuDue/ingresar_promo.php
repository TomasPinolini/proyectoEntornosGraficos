<?php 
  include("../db.php"); 
  session_start();  
  $option = "";
  $codDueno = $_SESSION["user_id"];
  $locales = mysqli_query($conn, "SELECT * FROM locales WHERE codUsuario = '$codDueno'");
  while($local = mysqli_fetch_array($locales)){
    $codLocal = $local["codLocal"];
    $nombreLocal = $local["nombreLocal"];
    $ubicacionLocal = $local["ubicacionLocal"];
    $rubroLocal = $local["rubroLocal"];
    $option .= "<option value='$codLocal'>$nombreLocal</option>";
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
    <h1>INGRESAR PROMO</h1>
    <br>
    <form action="" method="POST" class="form">
    <div class="inp">
      <label for="descPromo">Describa la promoción: </label>
      <input type="text" name="descPromo" id="descPromo" required />
    </div>
    <div class="inp">
      <label for="fechaD">Desde que fecha será válida la oferta: </label>
      <input type="date" name="fechaD" id="fechaD" required min="2024-05-09"/>
    </div>
    <div class="inp">
      <label for="fechaH">Hasta que fecha será válida la oferta: </label>
      <input type="date" name="fechaH" id="fechaH" required />
    </div>
    <div class="inp">
      <label for="type">Para que tipo de cliente será válida: </label>
      <select id="tipoCli" name="tipoCli">
        <option value="Inicial">Inicial</option>
        <option value="Medium">Medium</option>
        <option value="Premium">Premium</option>
    </select><br>

    </div>
    <div class="inp">
    <label>Para qué día/s de la semana será válida:</label><br>
      <input type="checkbox" id="lunes" name="diaDeSemana[]" value="lunes">
      <label for="lunes">Lunes</label><br>

      <input type="checkbox" id="martes" name="diaDeSemana[]" value="martes">
      <label for="martes">Martes</label><br>

      <input type="checkbox" id="miercoles" name="diaDeSemana[]" value="miercoles">
      <label for="miercoles">Miércoles</label><br>

      <input type="checkbox" id="jueves" name="diaDeSemana[]" value="jueves">
      <label for="jueves">Jueves</label><br>

      <input type="checkbox" id="viernes" name="diaDeSemana[]" value="viernes">
      <label for="viernes">Viernes</label><br>

      <input type="checkbox" id="sabado" name="diaDeSemana[]" value="sabado">
      <label for="sabado">Sábado</label><br>

      <input type="checkbox" id="domingo" name="diaDeSemana[]" value="domingo">
      <label for="domingo">Domingo</label><br>

    </div>
    <div class="inp">
      <label for="type">Para que local/es será válida: </label>
      <select name="codLocal"><?php echo $option;?></select>
    </div>    
   <div class="inp">
      <input type="submit" value="submit" name="Login"/>
    </div>
  </form>
    <div>
    <button onclick="window.location.href='../MenuDueno.php'">Menu Dueno</button>
    </div>
</body>
</html>
<?php
  $descPromo = filter_input(INPUT_POST, "descPromo");
  $fechaD = filter_input(INPUT_POST, "fechaD");
  $fechaH = filter_input(INPUT_POST, "fechaH");
  $estado = "pendiente";
  $dds = isset($_POST["diaDeSemana"]) ? $_POST["diaDeSemana"] : array();
  $ddsJSON = json_encode($dds);  
  $tipoC = filter_input(INPUT_POST, "tipoCli");
  $codL = filter_input(INPUT_POST, "codLocal");

  

  if (empty($descPromo)) {
    echo "La descripción de la promoción es requerida.";
  } elseif (empty($fechaD)) {
      echo "La fecha de inicio es requerida.";
  } elseif (empty($fechaH)) {
      echo "La fecha de fin es requerida.";
  } elseif (empty($tipoC)) {
      echo "Se debe seleccionar al menos un tipo de cliente.";
  } elseif (empty($dds)) {
      echo "Se debe seleccionar al menos un día de la semana.";
  } elseif (empty($codLocal)) {
      echo "Se debe seleccionar al menos un local.";
  }else{
    $sql = "INSERT INTO promociones (textoPromo, fechaDesdePromo, fechaHastaPromo, categoria_cliente, diasSemana, estadoPromo, codLocal) 
    VALUES ('$descPromo', '$fechaD', '$fechaH', '$tipoC', '$ddsJSON', '$estado', '$codL')";
    mysqli_query($conn, $sql);
    header("Location: ../menuDueno.php");
  }

  mysqli_close($conn);

    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: login.php");
    }

?>