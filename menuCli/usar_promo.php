<?php 
  include("../db.php"); 
  session_start();  
  $ddsemana = [1 => "Lunes", 2 => "Martes", 3 => "Miercoles", 4 => "Jueves", 5 => "Viernes", 6 => "Sabado", 0 => "Domingo"];
  $hoy = $ddsemana[date('w')];
  var_dump($_SESSION);
  $fechahoy = date("Y-m-d");
  $fechaHace6m = date("Y-m-d", strtotime("-6 months"));

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
    <div class="welcome"><img src="../UTN_logo.png" alt="" class="logoutn">Usar Promociones</div><br>
    <div class="table-container">
        <div class="form-container">
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
        </div>
    <?php if(isset($_POST["local"])): ?>
        <div class="form-container">
            <form action="" method="POST">
                <?php
                $cats = ["Inicial", "Medium", "Premium"];
                $codLocal = intval($_POST["local"]);
                switch($_SESSION["categoria_cliente"]){
                    case "Inicial":
                        $it = 1;
                        break;
                    case "Medium":
                        $it = 2;
                        break;
                    case "Premium":
                        $it = 3;
                        break;
                }
                for($i = 0; $i < $it; $i++){
                        $sqlPromos = "SELECT * FROM promociones WHERE codLocal = ? AND categoria_cliente = ?";
                        $stmt = $mysqli->prepare($sqlPromos);
                        $stmt->bind_param("ss", $codLocal, $cats[$i]);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $contador = 0;
                        while ($promo = $result->fetch_assoc()) {
                            $codPromo = $promo["codPromo"];
                            $desc = $promo["textoPromo"];
                            $dds = $promo["diasSemana"];
                            $fechaDesdePromo = $promo["fechaDesdePromo"];
                            $fechaHastaPromo = $promo["fechaHastaPromo"];
                            $sqlCuentaUsos = "SELECT * FROM usos_promociones";
                            $usos = mysqli_query($mysqli, $sqlCuentaUsos);
                            $contadorUsos = 0;
                            foreach($usos as $uso){
                                if(intval($uso["codCliente"]) === $_SESSION["codUsuario"] && intval($uso["codPromo"]) === $codPromo){
                                    $contadorUsos++;
                                }
                            }
                            if(strpos($dds, $hoy) !== false && 
                            $fechaDesdePromo <= $fechahoy && 
                            $fechaHastaPromo >= $fechahoy && 
                            $contadorUsos == 0){
                                $contador++;
                                echo "<div style='display: flex; align-items: center; width: 100%;'>
                                <input type='checkbox' id='promo_$codPromo' name='promos[]' value='$codPromo'>
                                <label for='promo_$codPromo'>$desc</label>
                            </div><br>";
                            }
                    }   
                }

                ?>
                <?php if($contador > 0): ?>
                    <input type="submit" value="Usar promo">
                <?php endif?>
            </form>
        </div>
    <?php endif ?>
    <button onclick="window.location.href='../MenuCliente.php'">Menu Cliente</button>
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
        
    }

    $sqlCuentaUsos = "SELECT * FROM usos_promociones";
    $usos = mysqli_query($mysqli, $sqlCuentaUsos);
    $contadorUsosT = 0;
    foreach($usos as $uso){
        if(intval($uso["codCliente"]) === $_SESSION["codUsuario"] && $uso["fechaUsoPromo"] > $fechaHace6m){
            $contadorUsosT++;
        }
    }

    if($contadorUsosT > 5){
        $categoria = "Premium";
        $sqlCatCliente = "UPDATE usuarios set categoria_cliente = ? WHERE codUsuario = ?"; 
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sqlCatCliente);
        $stmt->bind_param("ss", $categoria, $_SESSION["codUsuario"]);
        $stmt -> execute();
        $_SESSION["categoria_cliente"] = $categoria;
    }else if($contadorUsosT > 3){
        $categoria = "Medium";
        $sqlCatCliente = "UPDATE usuarios set categoria_cliente = ? WHERE codUsuario = ?"; 
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($sqlCatCliente);
        $stmt->bind_param("ss", $categoria, $_SESSION["codUsuario"]);
        $stmt -> execute();
        $_SESSION["categoria_cliente"] = $categoria;


    }

?>
