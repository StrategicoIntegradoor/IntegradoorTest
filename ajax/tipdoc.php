<?php

$DB_host = "localhost";
$DB_user = "grupoasi_cotizautos";
$DB_pass = "M1graci0n123";
$DB_name = "grupoasi_cotizautos";


$enlace = mysqli_connect("$DB_host", "$DB_user", "$DB_pass", "$DB_name");

if(!$enlace ){

    die("Conexion Fallida ".mysqli_connect_error());

}

$query = "SELECT * FROM tipos_documentos";
$ejecucion = mysqli_query($enlace,$query);
$opcion = "";
while($fila = $ejecucion->fetch_assoc()){
    $opcion.= "<option value =" . $fila['id_tipo_documento'].">". $fila['tip_doc_abreviatura']."</option>";
} 
echo $opcion;
    

?>