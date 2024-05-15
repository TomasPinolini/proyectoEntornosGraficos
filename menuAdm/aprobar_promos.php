<?php 
  include("../db.php"); 
  session_start();  
  $sql = "SELECT * FROM promociones WHERE estadoPromo = 'pendiente'";
  $data = mysqli_query($mysqli, $sql);
  $pendientes = mysqli_num_rows($data);
  $hayono = false;
  if($pendientes !== 0){
    $hayono = true;
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
    <h1>APROBAR PROMOS</h1>
    <?php if($hayono):?>
        <form action="" method="post">
            <table border='1'>
                <tr>
                    <th>Descripción</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Categoría Cliente</th>
                    <th>Días de la Semana</th>
                    <th>Nombre Local</th>
                    <th>Aprobación</th>
                </tr>    

                <?php
                    while($promo = mysqli_fetch_array($data)){
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
                        echo "<tr><td>$desc</td><td>$desde</td><td>$hasta</td><td>$cat</td><td>$dds</td><td>$nombreLocal</td>";
                        echo "<td><select id='$idSelect' name='$nameSelect'>
                                    <option value='pendiente' selected disabled>Seleccione:</option>
                                    <option value='aprobada'>Aprobar</option>
                                    <option value='denegada'>Denegar</option>
                                </select></td></tr>";
                    }
                ?>
            </table>
            <input type="submit" value="submit">
        </form>
    <?php endif?>
    <?php if(!$hayono):?>
        <h3>No hay promociones pendientes a aprobar o denegar...</h3>
    <?php endif?>

    <div>
    <button onclick="window.location.href='../MenuAdmin.php'">Menu Admin</button>
    </div>
</body>
</html>
<?php
    if (mysqli_num_rows($data) > 0 and $_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $key => $value) {
            $estado = mysqli_real_escape_string($mysqli, $value);
            echo $value;
            $sql = "UPDATE promociones SET estadoPromo = '$estado' WHERE codPromo = '$codPromo'";
            mysqli_query($mysqli, $sql);
        }
        header("Location: aprobar_promos.php");
    }
?>