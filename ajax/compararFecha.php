<?php


session_start();
$id = $_SESSION['idUsuario'];
$fecha = $_POST['fecha'];


$DB_host = "localhost";
$DB_user = "grupoasi_cotizautos";
$DB_pass = "M1graci0n123";
$DB_name = "grupoasi_cotizautos";


$enlace = mysqli_connect("$DB_host", "$DB_user", "$DB_pass", "$DB_name");

if(!$enlace ){

    die("Conexion Fallida ".mysqli_connect_error());

}
$query = "SELECT * FROM `cotizaciones` WHERE `cot_fch_cotizacion` LIKE '%$fecha%' AND `id_usuario` = $id";
$ejecucion = mysqli_query($enlace,$query);
echo mysqli_num_rows($ejecucion);
    
?>