<?php 
  include("db.php"); 
  session_start();  
  $type = $_SESSION["tipoUsuario"];
  if($type === 'cliente'){
    $type = $_SESSION["categoria_cliente"];
  } 
  $fechahoy = date("Y-m-d");
  $novedades = mysqli_query($mysqli, "SELECT * FROM novedades WHERE tipoUsuario = '$type'");
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/tablas.css">
    <title>Document</title>
</head>
<body>
    <div class="welcome">Ver Novedades</div>    
    <div class="table-container">
        <h3>Novedades:</h3>
        <table>
                <?php
                    foreach($novedades as $nov){
                        $fechaDesdeNovedad = $nov["fechaDesdeNovedad"];
                        $fechaHastaNovedad = $nov["fechaHastaNovedad"];
                        $txtnov = $nov["textoNovedad"];
                        if($fechaDesdeNovedad <= $fechahoy && $fechaHastaNovedad >= $fechahoy ){
                            echo "<tr><td>$txtnov (Del $fechaDesdeNovedad al $fechaHastaNovedad)</td></tr>";
                        }
                    }
                ?>
        </table>
    </div>
    <button type="button" onclick="history.back()">Go Back</button>
</body>
</html>
<?php
?>