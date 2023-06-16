<?php
include_once '../../config/dbconfig.php';
require 'categorias.php';
//require 'funciones.php';
//require 'funcionesBD.php';

if ($_POST['clasveh'] != "" && $_POST['MarcaVeh'] != "" && $edadVeh = $_POST['edadVeh'] && $lineaVeh = $_POST['lineaVeh'] && $refe = $_POST['refe'] && $refe2 = $_POST['refe2']) {
	$clasveh = $_POST['clasveh'];
	$MarcaVeh = $_POST['MarcaVeh'];
	$edadVeh = $_POST['edadVeh'];
	$lineaVeh = $_POST['lineaVeh'];
	$refe = $_POST['refe'];
	$refe2 = $_POST['refe2'];

	$ejecutar = ejecutar($clasveh);

	//$ip = getRealIP();

	switch ($ejecutar) {
		case "MOTOCICLETA":

			$stmt = $DB_con->prepare("select * FROM fasecolda WHERE clase='$ejecutar' AND marca=:MarcaVeh AND `$edadVeh` <> 0 AND referencia1=:lineaVeh AND referencia2=:refe AND referencia3=:refe2 GROUP BY codigo ORDER BY id_fasecolda");
			$stmt->execute(array(':MarcaVeh' => $MarcaVeh, ':lineaVeh' => $lineaVeh, ':refe' => $refe, ':refe2' => $refe2));
			$verConfig = $stmt->fetch(PDO::FETCH_ASSOC);
			break;
			//------------------------------------------------------------------------------------
		case "AUTOMOVIL":

			$stmt = $DB_con->prepare("select * FROM fasecolda WHERE clase='$ejecutar' AND marca=:MarcaVeh AND `$edadVeh` <> 0 AND referencia1=:lineaVeh AND referencia2=:refe AND referencia3=:refe2 GROUP BY codigo ORDER BY id_fasecolda");
			$stmt->execute(array(':MarcaVeh' => $MarcaVeh, ':lineaVeh' => $lineaVeh, ':refe' => $refe, ':refe2' => $refe2));
			$verConfig = $stmt->fetch(PDO::FETCH_ASSOC);
			break;
			//------------------------------------------------------------------------------------
		case "FURGONETA":

			$stmt = $DB_con->prepare("select * FROM fasecolda WHERE clase='$ejecutar' AND marca=:MarcaVeh AND `$edadVeh` <> 0 AND referencia1=:lineaVeh AND referencia2=:refe AND referencia3=:refe2 GROUP BY codigo ORDER BY id_fasecolda");
			$stmt->execute(array(':MarcaVeh' => $MarcaVeh, ':lineaVeh' => $lineaVeh, ':refe' => $refe, ':refe2' => $refe2));
			$verConfig = $stmt->fetch(PDO::FETCH_ASSOC);
			break;
			//------------------------------------------------------------------------------------
		case "BUS / BUSETA / MICROBUS":

			$stmt = $DB_con->prepare("select * FROM fasecolda WHERE clase='$ejecutar' AND marca=:MarcaVeh AND `$edadVeh` <> 0 AND referencia1=:lineaVeh AND referencia2=:refe AND referencia3=:refe2 GROUP BY codigo ORDER BY id_fasecolda");
			$stmt->execute(array(':MarcaVeh' => $MarcaVeh, ':lineaVeh' => $lineaVeh, ':refe' => $refe, ':refe2' => $refe2));
			$verConfig = $stmt->fetch(PDO::FETCH_ASSOC);
			break;
			//--------------------------------------------------------------------------------------
		case "clase='CAMIONETA REPAR' OR clase='CAMIONETA PASAJ.' OR clase='CAMPERO'":

			$stmt = $DB_con->prepare("select * FROM fasecolda WHERE marca=:MarcaVeh AND `$edadVeh` <> 0 AND referencia1=:lineaVeh AND referencia2=:refe AND referencia3=:refe2  and (" . $ejecutar . ")  GROUP BY codigo ORDER BY id_fasecolda");
			$stmt->execute(array(':MarcaVeh' => $MarcaVeh, ':lineaVeh' => $lineaVeh, ':refe' => $refe, ':refe2' => $refe2));
			$verConfig = $stmt->fetch(PDO::FETCH_ASSOC);
			break;
			//------------------------------------------------------------------------------------
		case "clase='PICKUP DOBLE CAB' OR clase='PICKUP SENCILLA'":

			$stmt = $DB_con->prepare("select * FROM fasecolda WHERE marca=:MarcaVeh AND `$edadVeh` <> 0 AND referencia1=:lineaVeh AND referencia2=:refe AND referencia3=:refe2  and (" . $ejecutar . ")  GROUP BY codigo ORDER BY id_fasecolda");
			$stmt->execute(array(':MarcaVeh' => $MarcaVeh, ':lineaVeh' => $lineaVeh, ':refe' => $refe, ':refe2' => $refe2));
			$verConfig = $stmt->fetch(PDO::FETCH_ASSOC);
			break;
			//------------------------------------------------------------------------------------------
		case "clase='MOTOCARRO' OR clase='ISOCARRO'":

			$stmt = $DB_con->prepare("select * FROM fasecolda WHERE marca=:MarcaVeh AND `$edadVeh` <> 0 AND referencia1=:lineaVeh AND referencia2=:refe AND referencia3=:refe2  and (" . $ejecutar . ")  GROUP BY codigo ORDER BY id_fasecolda");
			$stmt->execute(array(':MarcaVeh' => $MarcaVeh, ':lineaVeh' => $lineaVeh, ':refe' => $refe, ':refe2' => $refe2));
			$verConfig = $stmt->fetch(PDO::FETCH_ASSOC);
			break;
			//-----------------------------------------------------------------------------------------
		case "clase='CAMION' OR clase='CARROTANQUE' OR clase='FURGON' OR clase='REMOLCADOR' OR clase='VOLQUETA' OR clase='UNIMOG'":
			$stmt = $DB_con->prepare("select * FROM fasecolda WHERE marca=:MarcaVeh AND `$edadVeh` <> 0 AND referencia1=:lineaVeh AND referencia2=:refe AND referencia3=:refe2  and (" . $ejecutar . ")  GROUP BY codigo ORDER BY id_fasecolda");
			$stmt->execute(array(':MarcaVeh' => $MarcaVeh, ':lineaVeh' => $lineaVeh, ':refe' => $refe, ':refe2' => $refe2));
			$verConfig = $stmt->fetch(PDO::FETCH_ASSOC);
			break;
	}

	$data['result'] = $verConfig;
	echo json_encode($data);

	//------------------------------------------------------------------------------------------------------
	//------------------------------------------------------------------------------------------------------


}

?>
