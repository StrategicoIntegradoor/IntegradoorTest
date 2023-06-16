<?php
session_start();

$DB_host = "localhost";
$DB_user = "grupoasi_cotizautos";
$DB_pass = "M1graci0n123";
$DB_name = "grupoasi_cotizautos";
$enlace = mysqli_connect("$DB_host", "$DB_user", "$DB_pass", "$DB_name");

if(!$enlace ){
    die("Conexion Fallida ".mysqli_connect_error());
}


if($_SESSION["rol"] == 18 ||$_SESSION["rol"] == 10 ||$_SESSION["rol"] == 1){
    $query = "SELECT * FROM intermediario";
}else{
    $query = "SELECT * FROM intermediario WHERE id_intermediario =".$_SESSION["intermediario"] ;
}

$ejecucion = mysqli_query($enlace,$query);
$opcion = "";
while($fila = $ejecucion->fetch_assoc()){
    $opcion.= "<option value =" . $fila['id_Intermediario'].">". $fila['nombre']."</option>";
} 
echo $opcion;
    

?>