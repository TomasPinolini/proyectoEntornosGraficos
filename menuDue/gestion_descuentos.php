<?php 
  include("../db.php"); 
  session_start();  
  $sql = "SELECT * FROM usos_promociones";
  $usos = mysqli_query($mysqli, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>GESTIÓN PROMOCIONES</h1><br>
    <form action="" method="post">
    <table border='1'>
        <tr>
            <th>----</th>
            <th>Código</th>
            <th>Cliente</th>
            <th>Local usado</th>
            <th>Fecha de uso</th>
        </tr>    

        <?php
            foreach($usos as $uso){
                $usoCodCliente = $uso["codCliente"];
                $usoCodPromo = $uso["codPromo"];
                $usoFecha = $uso["fechaUsoPromo"];
                $usoEstado = $uso["estado"];


                $sqlCliente = mysqli_query($mysqli, "SELECT nombreUsuario FROM usuarios WHERE codUsuario = '$usoCodCliente'");
                while ($row = $sqlCliente->fetch_assoc()) {
                    $nombreCliente = $row["nombreUsuario"];
                }
                
                $sqlCodLocalPromo = mysqli_query($mysqli, "SELECT codLocal from promociones WHERE codPromo = '$usoCodPromo'");
                while ($row = $sqlCodLocalPromo->fetch_assoc()) {
                    $codLocal = $row["codLocal"];
                }
                
                $sqlNomLocal = mysqli_query($mysqli, "SELECT * FROM locales WHERE codLocal = '$codLocal'");
                while ($row = $sqlNomLocal->fetch_assoc()) {
                    $nombreLocal = $row["nombreLocal"];
                    $codDueno = $row["codUsuario"];
                }
                if($codDueno === $_SESSION["codUsuario"] && $usoEstado === 'enviada'){
                    echo "
                    <tr>
                        <td>
                            <input type='checkbox' value='$usoCodPromo $usoCodCliente' name='usos[]'></input>
                        </td>
                        <td>$usoCodPromo</td>
                        <td>$nombreCliente</td>
                        <td>$nombreLocal</td>
                        <td>$usoFecha</td>
                    </tr>";
                }
            }
        ?>
    </table>
    <input type="submit" value="submit">
    <br>
    <div>
    <button onclick="window.location.href='../MenuDueno.php'">Menu Dueño</button>
    </div>
</body>
</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // var_dump($_POST["usos"]);
        foreach ($_POST["usos"] as $key => $value) {
            $keys = explode(" ", $value);
            $codPromo = $keys[0];
            $codCliente = $keys[1];
            $sql = "UPDATE usos_promociones SET estado = 'aceptada' WHERE codPromo = '$codPromo' AND codCliente = '$codCliente'";
            mysqli_query($mysqli, $sql);
        }
        header("Location: gestion_descuentos.php");
    }
?>