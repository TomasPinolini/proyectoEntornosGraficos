<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "proyectoeg";
    $conn = "";

    $mysqli  = new mysqli(hostname: $db_server, username: $db_user, password: $db_pass, database: $db_name);
    
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    // $usuarios = mysqli_query($conn, "SELECT * FROM usuarios");
    // while($usuario = mysqli_fetch_array($usuarios)){
        // echo $usuario["codUsuario"], $usuario["nombreUsuario"] . "<br>";
    // };
    // echo mysqli_num_rows($usuarios);
    //if($conn){
        //echo"Yes";
    //}
    return $mysqli;

?>