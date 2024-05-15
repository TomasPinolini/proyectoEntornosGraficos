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
    <h1>USOS PROMOCIONES</h1><br>
    <table border='1'>
        <tr>
            <th>Código</th>
            <th>Cliente</th>
            <th>Local usado</th>
            <th>Fecha de uso</th>
        </tr>    

        <?php
            foreach($usos as $uso){
                // var_dump($uso);
                // echo "<br>";
                $usoCodCliente = $uso["codCliente"];
                $usoCodPromo = $uso["codPromo"];
                $usoFecha = $uso["fechaUsoPromo"];

                $sqlCliente = mysqli_query($mysqli, "SELECT nombreUsuario FROM usuarios WHERE codUsuario = '$usoCodCliente'");
                while ($row = $sqlCliente->fetch_assoc()) {
                    $nombreCliente = $row["nombreUsuario"];
                }
                
                $sqlCodLocalPromo = mysqli_query($mysqli, "SELECT codLocal from promociones WHERE codPromo = '$usoCodPromo'");
                while ($row = $sqlCodLocalPromo->fetch_assoc()) {
                    $codLocal = $row["codLocal"];
                }
                
                $sqlNomLocal = mysqli_query($mysqli, "SELECT nombreLocal FROM locales WHERE codLocal = '$codLocal'");
                while ($row = $sqlNomLocal->fetch_assoc()) {
                    $nombreLocal = $row["nombreLocal"];
                }
                echo "<tr><td>$usoCodPromo</td><td>$nombreCliente</td><td>$nombreLocal</td><td>$usoFecha</td></tr>";
            }
        ?>
    </table><br>
    <div>
    <button onclick="window.location.href='../MenuAdmin.php'">Menu Admin</button>
    </div>
</body>
</html>
<?php


?>
