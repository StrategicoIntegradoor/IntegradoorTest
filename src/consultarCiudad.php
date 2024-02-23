<?php

/* Conectar a la base de datos*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$codigo = $_POST['data'];
$codigoV = "";


if ($codigo == 32) {
	$codigoV = 30;
} else if ($codigo == 2) {
	$codigoV = 2;
} else if ($codigo == 4) {
	$codigoV = 4;
} else if ($codigo == 5) {
	$codigoV = 4;
} else if ($codigo == 7) {
	$codigoV = 5;
} else if ($codigo == 8) {
	$codigoV = 6;
} else if ($codigo == 9) {
	$codigoV = 7;
} else if ($codigo == 13) {
	$codigoV = 11;
} else if ($codigo == 15) {
	$codigoV = 13;
} else if ($codigo == 16) {
	$codigoV = 14;
} else if ($codigo == 20) {
	$codigoV = 18;
} else if ($codigo == 21) {
	$codigoV = 19;
} else if ($codigo == 22) {
	$codigoV = 20;
} else if ($codigo == 23) {
	$codigoV = 21;
} else if ($codigo == 24) {
	$codigoV = 22;
} else if ($codigo == 26) {
	$codigoV = 24;
} else if ($codigo == 27) {
	$codigoV = 25;
} else if ($codigo == 29) {
	$codigoV = 27;
} else if ($codigo == 30) {
	$codigoV = 28;
} else if ($codigo == 31) {
	$codigoV = 29;
} else if ($codigo == 12) {
	$codigoV = 12;
} else if ($codigo == 11) {
	$codigoV = 11;
}else if ($codigo == 10) {
	$codigoV = 10;
}else if ($codigo == 25) {
	$codigoV = 25;
}

if ($codigo == 5) {
	$sql = "SELECT DISTINCT `Nombre`,`Departamento`,`Codigo` FROM `ciudadesbolivar` WHERE `Codigo` LIKE '4000' ORDER BY `Nombre` ASC";
} else if ($codigo == 6) {
	$sql = "SELECT DISTINCT `Nombre`,`Departamento`,`Codigo` FROM `ciudadesbolivar` WHERE `Codigo` LIKE '14000' ORDER BY `Nombre` ASC";
} else {
	$sql = "SELECT DISTINCT `Nombre`,`Departamento`,`Codigo` FROM `ciudadesbolivar` WHERE `Departamento` = $codigoV ORDER BY `Nombre` ASC";
}

$res = mysqli_query($con, $sql);
$num_rows = mysqli_num_rows($res);

if ($num_rows > 0) {
	while ($row = mysqli_fetch_array($res)) {
		$data[] = $row;
	}
	echo json_encode($data, JSON_UNESCAPED_UNICODE);
} else {
	$data['mensaje'] = "No hay Registros";
	echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
