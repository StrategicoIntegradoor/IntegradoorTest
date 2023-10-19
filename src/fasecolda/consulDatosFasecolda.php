<?php

/* Conectar a la base de datos*/
require_once("../../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../config/conexion.php"); //Contiene funcion que conecta a la base de datos


$codFasecolda = $_POST['fasecolda'];
$edadVehiculo = $_POST['modelo'];

$res = mysqli_query($con, "SELECT * FROM fasecolda WHERE codigo ='$codFasecolda' AND `$edadVehiculo` <> 0  GROUP BY codigo ORDER BY id_fasecolda");
$num_rows = mysqli_num_rows($res);
$data = $res->fetch_assoc();

if ($num_rows >= 1) {
    
    $data['estado'] = true;
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
}else{    
	$data = array('estado' => false, 'mensaje' => 'No hay Registros.');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

