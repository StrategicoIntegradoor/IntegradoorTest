<?php

require_once("../../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../config/conexion.php"); //Contiene funcion que conecta a la base de datos
require 'categorias.php';

if ($_POST['id']) {
	$id = $_POST['id'];
	$ejecutar = ejecutar($id);

	$sql = "";
	switch ($ejecutar) {

		case "MOTOCICLETA":

			$sql = "SELECT * FROM fasecolda WHERE clase='" . $ejecutar . "' and (marca='AUTECO' or marca='YAMAHA' or marca='HONDA' OR marca='AKT' OR marca='SUZUKI' OR marca='KYMCO' OR marca='HERO' or marca='TVS' or marca='KAWASAKI' or marca='SIGMA') GROUP BY marca ORDER BY marca asc";
			break;

		case "AUTOMOVIL":

			$sql = "SELECT * FROM fasecolda WHERE clase='" . $ejecutar . "' and (marca='CHEVROLET' or marca='RENAULT' or marca='NISSAN' or marca='KIA' or marca='MAZDA' or marca='FORD' or marca='TOYOTA' or marca='HYUNDAI' or marca='VOLKSWAGEN' or marca='SUZUKI') GROUP BY marca ORDER BY marca asc";
			break;

		case "clase='CAMIONETA REPAR' OR clase='CAMIONETA PASAJ.' OR clase='CAMPERO'":

			$sql = "SELECT * FROM fasecolda WHERE (" . $ejecutar . ") and (marca='NISSAN' or marca='RENAULT' or marca='TOYOTA' or marca='FORD' or marca='CHEVROLET' or marca='AUDI') GROUP BY marca ORDER BY marca asc";
			break;

		case "clase='PICKUP DOBLE CAB' OR clase='PICKUP SENCILLA'":
			$sql = "SELECT * FROM fasecolda WHERE (" . $ejecutar . ") and (marca='NISSAN' or marca='RENAULT' or marca='TOYOTA' or marca='FORD' or marca='CHEVROLET') GROUP BY marca ORDER BY marca asc";
			break;

		case "clase='MOTOCARRO' OR clase='ISOCARRO'":

			$sql = "SELECT * FROM fasecolda WHERE (" . $ejecutar . ") GROUP BY marca ORDER BY marca asc";
			break;

		case 'FURGONETA':
			$sql = "SELECT * FROM fasecolda WHERE clase='" . $ejecutar . "' GROUP BY marca ORDER BY marca asc";
			break;

		case "BUS / BUSETA / MICROBUS":
			$sql = "SELECT * FROM fasecolda WHERE clase='" . $ejecutar . "' and (marca='CHEVROLET' or marca='HINO' or marca='SCANIA' or marca='VOLVO' or marca='AGRALE' or marca='HYUNDAI' or marca='IVECO' or marca='JAC' or marca='RENAULT' or marca='MERCEDES BENZ' or marca='VOLKSWAGEN' or marca='KIA')GROUP BY marca ORDER BY marca asc";
			break;


		case "clase='CAMION' OR clase='CARROTANQUE' OR clase='FURGON' OR clase='REMOLCADOR' OR clase='VOLQUETA' OR clase='UNIMOG'":

			$sql = "SELECT * FROM fasecolda WHERE (" . $ejecutar . ") and (marca='CHEVROLET' or marca='HINO' OR marca='FOTON' or marca='JAC' or marca='NISSAN' or marca='INTERNATIONAL' or marca='FREIGHTLINER' or marca='KENWORTH' or marca='RENAULT') GROUP BY marca ORDER BY marca asc";
			break;
	}

	$consulta = mysqli_query($con, $sql);

	$selectMarca = "";
	$selectMarca .= "<option value=''>Seleccione la Marca</option>";

	while ($row = mysqli_fetch_assoc($consulta)) {
		$selectMarca .= "<option value=" . $row['marca'] . ">" . $row['marca'] . "</option>";
	}

	$selectMarca .= "<option VALUE='Mas'>--Mas--</option>";

	echo $selectMarca;
}
