<?php
session_start();

/* Conectar a la base de datos*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$placa = $_POST['placa'];
$esCeroKm = $_POST['esCeroKm'];
$idCliente = $_POST['idCliente'];
$tipoDocumento = $_POST['tipoDocumento'];
$numIdentificacion = $_POST['numIdentificacion'];
$Nombre = $_POST["Nombre"];
$Apellido = $_POST["Apellido"];
$FechaNacimiento = $_POST["FechaNacimiento"];
$Genero = $_POST["Genero"];
$EstCivil = $_POST["EstadoCivil"];
$Celular = $_POST["Celular"];
$Correo = $_POST["Correo"];
$Direccion = $_POST["direccionAseg"];
$CodigoClase = $_POST["CodigoClase"];
$Clase = $_POST["Clase"];
$Marca = $_POST['Marca'];
$Modelo = $_POST['Modelo'];
$Linea = $_POST['Linea'];
$Fasecolda = $_POST['Fasecolda'];
$ValorAsegurado = $_POST["ValorAsegurado"];
$tipoUsoVehiculo = $_POST["tipoUsoVehiculo"];
$tipoServicio = $_POST["tipoServicio"];
$Departamento = $_POST["Departamento"];
$Ciudad = $_POST["Ciudad"];
$benefOneroso = $_POST["benefOneroso"];
$idCotizacion = $_POST["idCotizacion"];
$idUsuario = $_SESSION["idUsuario"];
$mundial = $_POST["mundial"];
// var_dump($CodigoClase);
// var_dump($mundial);
// die();

// VALIDAMOS SI VIENE EL CODIGO DEL CLIENTE Y DE LO CONTRARIO SE CREA EN LA BD
if ($idCliente == "") {

	// CONSULTAMOS EL ULTIMO CODIGO INSERTADO Y LE SUMAMOS 1 PARA CREAR EL CODIGO DEL NUEVO CLIENTE
	$respCodCliente = mysqli_query($con, "SELECT `cli_codigo` FROM clientes ORDER BY `id_cliente` DESC LIMIT 1");
	$rowsCodCliente = mysqli_num_rows($respCodCliente);

	if ($rowsCodCliente <= 1) {
		$row = $respCodCliente->fetch_assoc();
		$cod = substr($row["cli_codigo"], 4);
		$cli_codigo = "CLI-".($cod + 1);
	}
	else{
		$cli_codigo = "CLI-1";
	}

	$intermediario = $_SESSION["intermediario"];

	// INSERCIÓN DATOS DEL CLIENTE
	$sqlCliente = "INSERT INTO `clientes` (`id_cliente`, `cli_codigo`, `cli_num_documento`, `cli_nombre`, `cli_apellidos`, `cli_fch_nacimiento`, 
											`cli_genero`, `cli_telefono`, `cli_email`, `cli_estado`, `id_tipo_documento`, `id_estado_civil` , `id_Intermediario`) 
					VALUES (NULL, '$cli_codigo', '$numIdentificacion', '$Nombre', '$Apellido', '$FechaNacimiento', '$Genero', '$Celular', 
									'$Correo', 1, '$tipoDocumento', '$EstCivil', '$intermediario');";

	$resCliente = mysqli_query($con, $sqlCliente);
	$num_rows = mysqli_affected_rows($con);

	if ($num_rows > 0) {
		$data['Message 1'] = 'Cliente creado exitosamente';
		
		$respIdCliente = mysqli_query($con, "SELECT `id_cliente` FROM clientes ORDER BY `id_cliente` DESC LIMIT 1");
		$arrIdCliente = $respIdCliente->fetch_assoc();
		$idCliente = $arrIdCliente["id_cliente"];
		
	}else{
		$data['Message 1'] = 'Error cliente: ' . mysqli_error($con);
	}
	
} else {
    // The client exists    
    $sqlClient = "UPDATE clientes SET id_tipo_documento = '$tipoDocumento', cli_num_documento = '$numIdentificacion', cli_nombre = '$Nombre', 
                    cli_apellidos = '$Apellido', cli_genero = '$Genero', id_estado_civil = '$EstCivil', cli_email = '$Correo', 
                    cli_telefono = '$Celular' WHERE id_cliente = $idCliente";
    $resClient = mysqli_query($con, $sqlClient);
    $num_rows = mysqli_affected_rows($con);
    
    if ($num_rows > 0) {
		$data['Message 1'] = 'Cliente actualizado exitosamente';
		
		$respIdCliente = mysqli_query($con, "SELECT `id_cliente` FROM clientes WHERE id_cliente = $idCliente");
		$arrIdCliente = $respIdCliente->fetch_assoc();
		$idCliente = $arrIdCliente["id_cliente"];
		
	}else{
		$data['Message 1'] = 'Error cliente: ' . mysqli_error($con);
	}
}


// VALIDA SI VIENE EL ID DE LA COTIZACION PARA CREAR O ACTUALIZAR EL REGISTRO
if($idCotizacion == ""){

	// CONSULTAMOS EL ULTIMO CODIGO INSERTADO Y LE SUMAMOS 1 PARA CREAR EL CODIGO DE LA NUEVA COTIZACIÓN
	$respCodCotizacion = mysqli_query($con, "SELECT `cot_codigo` FROM cotizaciones ORDER BY `id_cotizacion` DESC LIMIT 1");
	$rowsCodCotizacion = mysqli_num_rows($respCodCotizacion);

	if ($rowsCodCotizacion <= 1) {
		$row = $respCodCotizacion->fetch_assoc();
		$cod = substr($row["cot_codigo"], 4);
		$cot_codigo = "COT-".($cod + 1);
	}else{
		$cot_codigo = "COT-1";
	}

	// INSERCIÓN DATOS DE LA COTIZACION REALIZADA
	$sql = "INSERT INTO `cotizaciones` (`id_cotizacion`, `cot_codigo`, `cot_fch_cotizacion`, `cot_placa`, `cot_cerokm`, `cot_cod_clase`, `cot_clase`, 
										`cot_marca`, `cot_modelo`, `cot_linea`, `cot_fasecolda`, `cot_valor_asegurado`, `cot_tip_uso`, `cot_tip_servicio`, `cot_departamento`, 
										`cot_ciudad`, `cot_bnf_oneroso`, `id_cliente`, `id_usuario`, `cot_mundial`) 
								VALUES (NULL, '$cot_codigo', current_timestamp(), '$placa', '$esCeroKm', '$CodigoClase', '$Clase', '$Marca', '$Modelo', '$Linea', '$Fasecolda', 
										'$ValorAsegurado', '$tipoUsoVehiculo', '$tipoServicio', '$Departamento', '$Ciudad', '$benefOneroso', '$idCliente', '$idUsuario', $mundial);";

	$res = mysqli_query($con, $sql);
	$num_rows = mysqli_affected_rows($con);

	if ($num_rows > 0) {
		$data['Message 2'] = 'Cotización creada exitosamente';
		
		$sql2 = "SELECT id_cotizacion FROM `cotizaciones` WHERE `cot_placa` LIKE '$placa' AND `id_cliente` LIKE '$idCliente' ORDER BY `id_cotizacion` DESC LIMIT 1";	
		$res2 = mysqli_query($con, $sql2);
		$arrIdCotizacion = $res2->fetch_assoc();

		$data['id_cotizacion'] = $arrIdCotizacion["id_cotizacion"];
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		
	}else{
		$data['Message 2'] = 'Error cotización: ' . mysqli_error($con);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

}
else{
	// ELIMINA LAS OFERTAS PREVIAMENTE COTIZADAS
	$sqlDelete = "DELETE FROM `ofertas` WHERE `id_cotizacion` = '$idCotizacion'";
	$resDelete = mysqli_query($con, $sqlDelete);
	$num_rows_deleted = mysqli_affected_rows($con);

	if ($num_rows_deleted > 0) { $data['Message 3'] = 'Ofertas previas eliminadas'; }
	else{ $data['Message 3'] = 'Error cotización: ' . mysqli_error($con); }

	
	// ACTUALIZA LA INFORMACION DEL VEHICULO
	$sqlUpdate = "UPDATE cotizaciones SET `cot_fasecolda` = '$Fasecolda', `cot_valor_asegurado` = '$ValorAsegurado', `cot_tip_uso` = '$tipoUsoVehiculo', 
											`cot_tip_servicio` = '$tipoServicio', `cot_departamento` = '$Departamento', `cot_ciudad` = '$Ciudad', 
											`cot_bnf_oneroso` = '$benefOneroso', `id_cliente` = '$idCliente' WHERE `id_cotizacion` = '$idCotizacion'";	
	$resUpdate = mysqli_query($con, $sqlUpdate);
	$num_rows_update = mysqli_affected_rows($con);

	if ($num_rows_update > 0) {
		$data['Message 4'] = 'Cotización actualizada';
		$data['id_cotizacion'] = $idCotizacion;
		echo json_encode($data, JSON_UNESCAPED_UNICODE);

	}else{
		$data['id_cotizacion'] = $idCotizacion;
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

}
