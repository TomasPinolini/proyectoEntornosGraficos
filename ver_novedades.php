<?php 
  include("db.php"); 
  session_start();  
  $type = $_SESSION["tipoUsuario"]; 
  $novedades = mysqli_query($mysqli, "SELECT textoNovedad FROM novedades WHERE tipoUsuario = '$type'");
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>VER NOVEDADES</h1><br>
    
    <h3>Novedades:</h3>
    <ol>
        <?php
            foreach($novedades as $nov){
                $txtnov = $nov["textoNovedad"];
                echo "<li>$txtnov</li>";
            }
        ?>
    </ol>
    <br>
    <div>
    <button type="button" onclick="history.back()">Go Back</button>
    </div>
</body>
</html>
<?php
?>