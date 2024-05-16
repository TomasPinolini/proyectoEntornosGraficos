<?php 
  include("../db.php"); 
  session_start();  
  // var_dump($_SESSION);
  $nohaypromos = false;
  $option = "";
  $promos = mysqli_query($mysqli, "SELECT * FROM promociones WHERE estadoPromo = 'aprobada'");
  if(mysqli_num_rows($promos) === 0){
    $nohaypromos= true;
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
    <h1>MIRA LAS PROMOCIONES</h1>
    <br>
    <?php if($nohaypromos):?>
        <h3>No hay promos aprobadas para mostrar...</h3>
    <?php endif ?>
    <?php if(!$nohaypromos):?>
        <table border='1'>
            <tr>
                <th>Nombre Local</th>
                <th>Descripción</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Categoría Cliente</th>
                <th>Días de la Semana</th>
                <th>Código</th>
            </tr>    

            <?php
                while($promo = mysqli_fetch_array($promos)){
                    $codPromo = $promo["codPromo"];
                    $desc = $promo["textoPromo"];
                    $desde = $promo["fechaDesdePromo"];
                    $hasta = $promo["fechaHastaPromo"];
                    $cat = $promo["categoria_cliente"];
                    $dds = implode(", ", json_decode($promo["diasSemana"]));

                    $cod = $promo["codLocal"];
                    $sqlLocal = mysqli_fetch_array(mysqli_query($mysqli, "SELECT nombreLocal, codUsuario FROM locales WHERE codLocal = '$cod'"));
                    $nombreLocal = $sqlLocal["nombreLocal"];
                    $codDueno = $sqlLocal["codUsuario"];
                    $sqlDueno = mysqli_fetch_array(mysqli_query($mysqli, "SELECT nombreUsuario FROM usuarios WHERE codUsuario = '$codDueno'"));
                    $nombreDueno = $sqlDueno["nombreUsuario"];
                    
                    $idSelect = "id_".$codPromo;
                    $nameSelect = "aprobacion_".$codPromo; 
                    echo "<tr><td>$nombreLocal</td><td>$desc</td><td>$desde</td><td>$hasta</td><td>$cat</td><td>$dds</td><td>$codPromo</td>";
                }
            ?>
            </table><br>
            <?php endif ?>
    <div>
    <button onclick="window.location.href='../MenuCliente.php'">Menu Cliente</button>
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