<?php

/* Conectar a la base de datos*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$aseguradora = $_POST['aseguradora'];
$valorPrima = str_replace('.', '', $_POST['prima']);
$producto = $_POST['producto'];
$numCotizOferta = $_POST['numCotizOferta'];
$placa = $_POST['placa'];
$idCotizacion = $_POST['id_oferta'];
$valorRC = str_replace('.', '', $_POST['valorRC']);
$PT = $_POST['PT'];
$PP = $_POST['PP'];
$CE = $_POST['CE'];
$GR = $_POST['GR'];


if ($aseguradora == "Seguros Bolivar") {
	$logo = "vistas/img/logos/bolivar.png";
} else if ($aseguradora == "HDI Seguros") {
	$logo = "vistas/img/logos/hdi.png";
} else if ($aseguradora == "Seguros del Estado") {
	$logo = "vistas/img/logos/estado.png";
} else if ($aseguradora == "Axa Colpatria") {
	$logo = "vistas/img/logos/axa.png";
} else if ($aseguradora == "SBS Seguros") {
	$logo = "vistas/img/logos/sbs.png";
} else if ($aseguradora == "Allianz Seguros") {
	$logo = "vistas/img/logos/allianz.png";
} else if ($aseguradora == "Seguros Sura") {
	$logo = "vistas/img/logos/sura.png";
} else if ($aseguradora == "Seguros Mapfre") {
	$logo = "vistas/img/logos/mapfre.png";
} else if ($aseguradora == "Zurich Seguros") {
	$logo = "vistas/img/logos/zurich.png";
} else if ($aseguradora == "Aseguradora Solidaria") {
	$logo = "vistas/img/logos/solidaria.png";
} else if ($aseguradora == "Equidad Seguros") {
	$logo = "vistas/img/logos/equidad.png";
} else if ($aseguradora == "Liberty Seguros") {
	$logo = "vistas/img/logos/liberty.png";
}else if ($aseguradora == "Previsora") {
	$logo = "vistas/img/logos/previsora.png";
}









$numIdentificacion = $_POST['numIdentificacion'];




$UrlPdf = "";
$manual = $_POST['manual'];



$sql = "INSERT INTO `ofertas` (`id_oferta`, `Placa`, `Identificacion`, `NumCotizOferta`, `Aseguradora`, `Producto`, `Prima`,`ValorRC`, `PerdidaTotal`, `PerdidaParcial`, `ConductorElegido`, `Grua`, `logo`, `UrlPdf`, `id_cotizacion`, `Manual`) VALUES (NULL, '$placa', '$numIdentificacion', '$numCotizOferta', '$aseguradora', '$producto', '$valorPrima', '$valorRC', '$PT', '$PP', '$CE', '$GR', '$logo', '$UrlPdf', '$idCotizacion', $manual);";


$res = mysqli_query($con, $sql);
$num_rows = mysqli_affected_rows($con);
// printf("Columnas Afectadas (INSERT): %d\n", mysqli_affected_rows($con));

if ($num_rows > 0) {

	$data['Success'] = $res;
	$data['Message'] = 'La inserción fue exitosa';
	echo json_encode($data, JSON_UNESCAPED_UNICODE);
} else {
	$data['Success'] = $res;
	$data['Message'] = 'Error: ' . mysqli_error($con);
	echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
