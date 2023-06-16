<?php

	/* Conectar a la base de datos*/
	require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos


	$buscar = $_POST['buscar'];
	$data = array();
	
	$sql = "SELECT * FROM marca_veh WHERE marca LIKE '%$buscar%'";
	$res = mysqli_query($con,$sql);
	$num_rows = mysqli_num_rows($res);

	if ($num_rows > 0) {
		while($row = mysqli_fetch_assoc($res)) {
			$item = array(
				'marcaveh' => $row['marca']
			);
			array_push($data, $item);
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		
	}else{
		echo json_encode(array('mensaje' => 'No hay Registros'), JSON_UNESCAPED_UNICODE);
	}

?>
