<?php

require_once("../../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../config/conexion.php"); //Contiene funcion que conecta a la base de datos
require 'categorias.php';

if ($_POST['clasveh']) {
	$id = $_POST['clasveh'];

	print_r($id);

	$ejecutar = ejecutar($id);

	switch ($ejecutar) {

		case "MOTOCICLETA":
			$sql = "SELECT * FROM fasecolda WHERE clase='" . $ejecutar . "' GROUP BY marca ORDER BY marca asc";
			break;
		case "AUTOMOVIL":
			$sql = "SELECT * FROM fasecolda WHERE clase='" . $ejecutar . "' GROUP BY marca ORDER BY marca asc";
			break;

		case "clase='CAMIONETA REPAR' OR clase='CAMIONETA PASAJ.' OR clase='CAMPERO'":
			$sql = "SELECT * FROM fasecolda WHERE (" . $ejecutar . ") GROUP BY marca ORDER BY marca asc";
			break;

		case "clase='PICKUP DOBLE CAB' OR clase='PICKUP SENCILLA'":
			$sql = "SELECT * FROM fasecolda WHERE (" . $ejecutar . ") GROUP BY marca ORDER BY marca asc";
			break;

		case "clase='MOTOCARRO' OR clase='ISOCARRO'":
			$sql = "SELECT * FROM fasecolda WHERE (" . $ejecutar . ") GROUP BY marca ORDER BY marca asc";
			break;

		case 'FURGONETA':
			$sql = "SELECT * FROM fasecolda WHERE clase='" . $ejecutar . "' GROUP BY marca ORDER BY marca asc";
			break;

		case "BUS / BUSETA / MICROBUS":
			$sql = "SELECT * FROM fasecolda WHERE clase='" . $ejecutar . "' GROUP BY marca ORDER BY marca asc";
			break;

		case "clase='CAMION' OR clase='CARROTANQUE' OR clase='FURGON' OR clase='REMOLCADOR' OR clase='VOLQUETA' OR clase='UNIMOG'":
			$sql = "SELECT * FROM fasecolda WHERE (" . $ejecutar . ") GROUP BY marca ORDER BY marca asc";
			break;
	}

	$consulta = mysqli_query($con, $sql);

	$selectMarca = "";
	$selectMarca .= "<option value=''>Seleccione la Marca</option>";

	while ($row = mysqli_fetch_assoc($consulta)) {
		$selectMarca .= "<option value='" . $row['marca'] . "'>" . $row['marca'] . "</option>";
	}

	echo $selectMarca;
}
