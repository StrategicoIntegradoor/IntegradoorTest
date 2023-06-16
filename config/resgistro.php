<?php
	 include_once 'conexion.php';


	 date_default_timezone_set('America/Bogota');

	

	$placa=$_POST['placa'];
    $f_system=date("Y-m-d h:i:s A");


    $query = "INSERT INTO BitacoraSOAT (Paso1,
										Fecha1
										) VALUES (
										'$placa', 
										'$f_system
										')";
									$valor = $conexion->query($query);

?>