<?php
session_start();

/* Conectar a la base de datos*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos


$tipoDocumento = $_POST['tipoDocumento'];
$numDocumento = $_POST['numDocumento'];
$intermediario = $_SESSION["intermediario"];

$res = mysqli_query($con, "SELECT * FROM `clientes` WHERE `cli_num_documento` LIKE '$numDocumento' AND `id_Intermediario` = '$intermediario' ");
$num_rows = mysqli_num_rows($res);
$data = $res->fetch_assoc();

if ($num_rows >= 1) {

    $data['estado'] = true;
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    
}else{    
	$data = array('estado' => false, 'mensaje' => '! Es un Cliente Nuevo ¡');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

