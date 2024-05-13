<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "proyectoeg";
    $conn = "";

    try{
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    }catch(mysqli_sql_exception){
        echo"Nahhh";
    }
    // $usuarios = mysqli_query($conn, "SELECT * FROM usuarios");
    // while($usuario = mysqli_fetch_array($usuarios)){
        // echo $usuario["codUsuario"], $usuario["nombreUsuario"] . "<br>";
    // };
    // echo mysqli_num_rows($usuarios);
    //if($conn){
        //echo"Yes";
    //}

?>