<?php 
  include("../db.php"); 
  session_start();  
  // var_dump($_SESSION);
  $dont_have = false;
  $option = "";
  $codDueno = $_SESSION["codUsuario"];
  $locales = mysqli_query($mysqli, "SELECT * FROM locales WHERE codUsuario = '$codDueno'");
  if(mysqli_num_rows($locales) === 0){
    $dont_have = true;
  }else{
    while($local = mysqli_fetch_array($locales)){
      $codLocal = $local["codLocal"];
      $nombreLocal = $local["nombreLocal"];
      $ubicacionLocal = $local["ubicacionLocal"];
      $rubroLocal = $local["rubroLocal"];
      $option .= "<option value='$codLocal'>$nombreLocal</option>";
    }
  }
  $today = date('Y-m-d');

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/forms.css">
    <title>Ingresar Promo</title>
</head>
<body>
    <div class="welcome">Ingresar Promo</div>
    <?php if(!$dont_have):?>
      <div class="form">
        <form action="" method="POST">
          <div class="row-form">
            <label for="descPromo">Describa la promoción: </label>
            <input type="text" name="descPromo" id="descPromo" required />
          </div>
          <div class="row-form">
            <label for="fechaD">Desde que fecha será válida la oferta: </label>
            <input type="date" name="fechaD" id="fechaD" required min="2024-05-09" value="<?php echo $today;?>"/>
          </div>
          <div class="row-form">
            <label for="fechaH">Hasta que fecha será válida la oferta: </label>
            <input type="date" name="fechaH" id="fechaH" required />
          </div>
          <div class="row-form">
            <label for="type">Para que tipo de cliente será válida: </label>
            <select id="tipoCli" name="tipoCli">
              <option value="Inicial">Inicial</option>
              <option value="Medium">Medium</option>
              <option value="Premium">Premium</option>
            </select>
          </div>

          <div class="row-form">
            <label>Día/s de la semana válida:</label>
            <div class="dds">
              <input class="dds-inp" type="checkbox" id="Lunes" name="diaDeSemana[]" value="lunes">
              <label for="lunes">Lunes</label>
            </div>
            <div class="dds">
              <input class="dds-inp" type="checkbox" id="Martes" name="diaDeSemana[]" value="martes">
              <label for="martes">Martes</label>
            </div>
            <div class="dds">
              <input class="dds-inp" type="checkbox" id="Miercoles" name="diaDeSemana[]" value="miercoles">
              <label for="miercoles">Miércoles</label>
            </div>
            <div class="dds">
              <input class="dds-inp" type="checkbox" id="Jueves" name="diaDeSemana[]" value="jueves">
              <label for="jueves">Jueves</label>
            </div>
            <div class="dds">
              <input class="dds-inp" type="checkbox" id="Viernes" name="diaDeSemana[]" value="viernes">
              <label for="viernes">Viernes</label>
            </div>
            <div class="dds">
              <input class="dds-inp" type="checkbox" id="Sabado" name="diaDeSemana[]" value="sabado">
              <label for="sabado">Sábado</label>
            </div>
            <div class="dds">
              <input class="dds-inp" type="checkbox" id="Domingo" name="diaDeSemana[]" value="domingo">
              <label for="domingo">Domingo</label>
            </div>

          </div>
          <div class="row-form">
            <label for="type">Para que local/es será válida: </label>
            <select name="codLocal"><?php echo $option;?></select>
          </div>    
          <div class="row-form">
            <input type="submit" value="submit" name="Login"/>
          </div>
        </form>
      </div>
    <?php endif ?>
    <?php if($dont_have):?>
      <h3>No posee locales como para programarle promociones todavía...</h3>
    <?php endif ?>

    <div class="menu-btn"><button onclick="window.location.href='../MenuDueno.php'">Menu Dueño</button></div>

</body>
</html>
<?php
  if(isset($_POST["descPromo"])){
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
      mysqli_query($mysqli, $sql);
      header("Location: ../menuDueno.php");
    }

    mysqli_close($mysqli);
  }
?>