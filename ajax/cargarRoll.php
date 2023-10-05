<?php


$mensaje = $_POST['saludo'];

$DB_host = "localhost";
$DB_user = "grupoasi_cotizautos";
$DB_pass = "M1graci0n123";
$DB_name = "grupoasi_cotizautos";


$enlace = mysqli_connect("$DB_host", "$DB_user", "$DB_pass", "$DB_name");

if(!$enlace ){

    die("Conexion Fallida ".mysqli_connect_error());

}
$idRol = $_POST['idRol'];

if($idRol == 1 || $idRol == 10){
    $query = "SELECT * FROM roles";
}else if($idRol == 12){
    $query = "SELECT * FROM roles WHERE id_rol IN (19, 11, 12)";
}
$ejecucion = mysqli_query($enlace,$query);
$opcion = "";
while($fila = $ejecucion->fetch_assoc()){
    $opcion.= "<option value =" . $fila['id_rol'].">". $fila['rol_descripcion']."</option>";
} 
echo $opcion;
    

?>