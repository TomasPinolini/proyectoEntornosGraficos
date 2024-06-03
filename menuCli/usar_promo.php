<?php 
  include("../db.php"); 
  session_start();  
  $ddsemana = [1 => "lunes", 2 => "martes", 3 => "miercoles", 4 => "jueves", 5 => "viernes", 6 => "sabado", 0 => "domingo"];
  $hoy = $ddsemana[date('w')];
  $fechahoy = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/tablas.css">
    <link rel="stylesheet" href="../styles/forms.css">

    <title>Usar Promocion</title>
</head>
<body>
    <div class="welcome">Usar Promociones</div><br>
    <div class="table-container">
    <form action="" method="POST">
        <select name="local" id="local">
            <option value='' selected disabled>Seleccione:</option>
            <?php
                $sqlLocales = "SELECT * FROM locales";
                $locales = mysqli_query($mysqli, $sqlLocales);
                while($local = mysqli_fetch_array($locales)){
                    $codLocal = $local["codLocal"];
                    $nombreLocal = $local["nombreLocal"];
                    echo "<option value='$codLocal'>$nombreLocal</option>";
                }
            ?>
        </select>
        <input type="submit" value="Buscar promociones">
    </form>
    <?php if(isset($_POST["local"])): ?>
        <form action="" method="post">
            <?php
               $sqlPromos = "SELECT * FROM promociones WHERE codLocal = ? AND categoria_cliente = ?";
               $stmt = $mysqli->prepare($sqlPromos);
               $stmt->bind_param("ss", $_POST["local"], $_SESSION["categoria_cliente"]);
               $stmt->execute();
               $result = $stmt->get_result();
               $contador = 0;
               while ($promo = $result->fetch_assoc()) {
                    $codPromo = $promo["codPromo"];
                    $desc = $promo["textoPromo"];
                    $dds = $promo["diasSemana"];
                    $fechaDesdePromo = $promo["fechaDesdePromo"];
                    $fechaHastaPromo = $promo["fechaHastaPromo"];
                    if(strpos($dds, $hoy) !== false && $fechaDesdePromo <= $fechahoy && $fechaHastaPromo >= $fechahoy ){
                        $contador++;
                        echo "<input type='checkbox' name='promos[]' value='$codPromo'>$desc</input><br>";
                    }
                }   
            ?>
            <?php if($contador > 0): ?>
            <input type="submit" value="Usar promo">
            <?php endif?>
        </form>
    <?php endif ?>

    <br><div>
    <button onclick="window.location.href='../MenuCliente.php'">Menu Cliente</button>
    </div>
</body>
</html>

<?php
    if(isset($_POST["promos"])){
        $promos = $_POST["promos"];
        $today = date('Y-m-d');
        foreach ($promos as $promo) {
            $sql = "INSERT INTO usos_promociones (codCliente, codPromo, fechaUsoPromo, estado) VALUES (?,?,?, 'enviada')";
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param("sss", $_SESSION["codUsuario"], $promo, $today);
            $stmt -> execute();
        }
    
        $sqlCuentaUsos = "SELECT codCliente FROM usos_promociones";
        $usos = mysqli_query($mysqli, $sqlCuentaUsos);
        $contador = 0;
        foreach($usos as $uso){
            if($uso["codCliente"] === $_SESSION["codUsuario"]){
                $contador++;
            }
        }

        if($contador > 5){
            $categoria = "Premium";
            $sqlCatCliente = "UPDATE usuarios set categoria_cliente = ? WHERE codUsuario = ?"; 
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($sqlCatCliente);
            $stmt->bind_param("ss", $categoria, $_SESSION["codUsuario"]);
            $stmt -> execute();
        }else if($contador > 3){
            $categoria = "Medium";
            $sqlCatCliente = "UPDATE usuarios set categoria_cliente = ? WHERE codUsuario = ?"; 
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($sqlCatCliente);
            $stmt->bind_param("ss", $categoria, $_SESSION["codUsuario"]);
            $stmt -> execute();
        }


    }

?>
