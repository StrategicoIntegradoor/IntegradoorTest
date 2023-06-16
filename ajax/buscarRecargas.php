<?php

session_start();
$id = $_SESSION['idUsuario'];
$rol = $_SESSION['rol'];
$fecha = $_POST['fecha'];
$inter = $_SESSION['intermediario'];


$DB_host = "localhost";
$DB_user = "grupoasi_cotizautos";
$DB_pass = "M1graci0n123";
$DB_name = "grupoasi_cotizautos";

 

$enlace = mysqli_connect("$DB_host", "$DB_user", "$DB_pass", "$DB_name");
if(!$enlace ){

    die("Conexion Fallida ".mysqli_connect_error());
}

    $query = "SELECT Num_recargas FROM `intermediario` WHERE `id_Intermediario` = $inter";
   
    $ejecucion = mysqli_query($enlace,$query);
    // echo mysqli_num_rows($ejecucion);
    
    $fila = mysqli_fetch_assoc($ejecucion);
    echo ($fila["Num_recargas"]);
    

    
?>