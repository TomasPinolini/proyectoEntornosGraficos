<?php 
  include("../db.php"); 
  session_start();  
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
      <select name="tipoCli" id="tipoCli" required multiple>
        <option value="Inicial">Inicial</option>
        <option value="Medium">Medium</option>
        <option value="Premium">Premium</option>
      </select>
    </div>
    <div class="inp">
      <label for="type">Para que día/s de la semana será válida: </label>
      <select name="diaDeSemana" id="diaDeSemana" required multiple>
        <option value="lunes">Lunes</option>
        <option value="martes">Martes</option>
        <option value="miercoles">Miercoles</option>
        <option value="jueves">Jueves</option>
        <option value="viernes">Viernes</option>
        <option value="sabado">Sabado</option>
        <option value="domingo">Domingo</option>
      </select>
    </div>
    <div class="inp">
      <label for="type">Para que local/es será válida: </label>
      <select name="locales" id="locales" required multiple>
        <?php
            $stmt = $conn->prepare("SELECT * FROM locales WHERE codUsuario = ?");
            $stmt->bind_param('ss', $_SESSION["codUsuario"]);
            $stmt->execute();

            $result = $stmt->get_result();

            $locales = $result->fetch_assoc();

            $cantLocales = count($locales);

            for($i=0; $i < $cantLocales; $i++){
                $nombreLocal = $locales[$i].
            }

        
        ?>
      </select>
    </div>    

    <div class="inp">
      <input type="submit" value="login" name="login"/>
    </div>
  </form>
    <div>
    <button onclick="window.location.href='../MenuDueno.php'">Menu Dueno</button>
    </div>
</body>
</html>
<?php
     if (isset($_SESSION["email"])) {
        echo $_SESSION["email"] . "<br>";
    }

    if (isset($_SESSION["password"])) {
        echo $_SESSION["password"] . "<br>";
    }

    if(isset($_POST["logout"])){
        session_destroy();
        header("Location: login.php");
    }

?>