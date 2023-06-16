<?php

/* Conectar a la base de datos*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$placa=$_POST['placa'];
$idCotizacion = $_POST['idCotizacion'];
$aseguradora=$_POST['aseguradora'];
$producto=$_POST['producto'];
$numCotizOferta = $_POST['numCotizOferta'];
$valorPrima = str_replace('.', '', $_POST['valorPrima']);
$recomendar = $_POST['recomendar'];


$sql = "UPDATE `ofertas` SET `recomendar` = '$recomendar' WHERE `Placa` LIKE '$placa' AND `NumCotizOferta` LIKE '$numCotizOferta' 
		AND `Aseguradora` LIKE '$aseguradora' AND `Producto` LIKE '$producto' AND `Prima` LIKE '$valorPrima' AND `id_cotizacion` = $idCotizacion";

$res = mysqli_query($con, $sql);
$num_rows = mysqli_affected_rows($con);

if ($num_rows > 0) {
	
	$data['Success'] = $res;
	$data['Message'] = 'La inserción fue exitosa';
	echo json_encode($data, JSON_UNESCAPED_UNICODE);
	
}else{
	$data['Success'] = $res;
	$data['Message'] = 'Error: ' . mysqli_error($con);
	echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
