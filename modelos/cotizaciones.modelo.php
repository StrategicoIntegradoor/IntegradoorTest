<?php

require_once "conexion.php";

class ModeloCotizaciones{

	/*=============================================
	MOSTRAR COTIZACIONES
	=============================================*/

	static public function mdlMostrarCotizaciones($tabla, $tabla2, $tabla3, $tabla4, $tabla5, $tabla6, $item, $valor){

		if($item != null){

			if($item == 'id_cotizacion'){
				
				
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2, $tabla3, $tabla4, $tabla5, $tabla6 
														WHERE $tabla.id_cliente = $tabla2.id_cliente AND $tabla.id_usuario = $tabla5.id_usuario 
														AND $tabla.cot_ciudad = $tabla6.Codigo AND $tabla2.id_tipo_documento = $tabla3.id_tipo_documento 
														AND $tabla2.id_estado_civil = $tabla4.id_estado_civil AND $tabla.id_cotizacion = :$item AND $tabla5.id_Intermediario = :idIntermediario");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> bindParam(":idIntermediario", $_SESSION["intermediario"], PDO::PARAM_INT);
				
				$stmt -> execute();
				
				return $stmt ->fetch(PDO::FETCH_ASSOC);

			}

		}

		$stmt -> close();
		
		$stmt = null;

	}

	/*=============================================
	MOSTRAR COTIZACIONES "OFERTAS"
	=============================================*/

	static public function ctrMostrarCotizaOfertas($tabla, $item, $valor){

		if($item != null){

			if($item == 'id_cotizacion'){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $tabla.id_cotizacion = :$item ORDER BY Aseguradora");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				
				return $stmt ->fetchAll(PDO::FETCH_ASSOC);

			}

		}

		$stmt -> close();
		
		$stmt = null;

	}

	/*=============================================
	ELIMINAR COTIZACIONES
	=============================================*/

	static public function mdlEliminarCotizaciones($tabla, $tabla2, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla2 WHERE $tabla2.id_cotizacion LIKE :id");
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
		$stmt -> execute();

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $tabla.id_cotizacion LIKE :id");
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS COTIZACIONES
	=============================================*/

	static public function mdlRangoFechasCotizaciones($tabla, $tabla2, $tabla3, $tabla4, $tabla5,$tabla6, $fechaInicialCotizaciones, $fechaFinalCotizaciones){
			
		$condicion = "";
		if($_SESSION["permisos"]["Verlistadodecotizacionesdelaagencia"] != "x"){ $condicion = "AND $tabla.id_usuario = :idUsuario"; }

		if($fechaInicialCotizaciones == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2, $tabla3, $tabla4, $tabla5 WHERE $tabla.id_cliente = $tabla2.id_cliente AND $tabla.id_usuario = $tabla5.id_usuario AND $tabla2.id_tipo_documento = $tabla3.id_tipo_documento AND $tabla2.id_estado_civil = $tabla4.id_estado_civil AND usuarios.id_Intermediario = :idIntermediario $condicion ");
			
			$stmt->bindParam(":idIntermediario", $_SESSION["intermediario"], PDO::PARAM_INT);

			if($_SESSION["permisos"]["Verlistadodecotizacionesdelaagencia"] != "x"){ 
				$stmt->bindParam(":idUsuario", $_SESSION["idUsuario"], PDO::PARAM_INT);
				
				
			}
			
			
			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);
			print_r($stmt);
			die();

		}else if($fechaInicialCotizaciones == $fechaFinalCotizaciones){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2, $tabla3, $tabla4, $tabla5 WHERE $tabla.id_cliente = $tabla2.id_cliente
													AND $tabla.id_usuario = $tabla5.id_usuario AND $tabla2.id_tipo_documento = $tabla3.id_tipo_documento 
													AND $tabla2.id_estado_civil = $tabla4.id_estado_civil AND cot_fch_cotizacion LIKE '%$fechaFinalCotizaciones%' AND usuarios.id_Intermediario = :idIntermediario $condicion");

			$stmt -> bindParam(":cot_fch_cotizacion", $fechaFinalCotizaciones, PDO::PARAM_STR);
			$stmt->bindParam(":idIntermediario",$_SESSION["intermediario"], PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinalCotizaciones2 = new DateTime($fechaFinalCotizaciones);
			$fechaFinalCotizaciones2 ->add(new DateInterval("P1D"));
			$fechaFinalCotizacionesMasUno = $fechaFinalCotizaciones2->format("Y-m-d");

			if($fechaFinalCotizacionesMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2, $tabla3, $tabla4, $tabla5 WHERE $tabla.id_cliente = $tabla2.id_cliente
														AND $tabla.id_usuario = $tabla5.id_usuario AND $tabla2.id_tipo_documento = $tabla3.id_tipo_documento 
														AND $tabla2.id_estado_civil = $tabla4.id_estado_civil AND cot_fch_cotizacion 
														BETWEEN '$fechaInicialCotizaciones' AND '$fechaFinalCotizacionesMasUno'AND usuarios.id_Intermediario = :idIntermediario $condicion");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2, $tabla3, $tabla4, $tabla5 WHERE $tabla.id_cliente = $tabla2.id_cliente
														AND $tabla.id_usuario = $tabla5.id_usuario AND $tabla2.id_tipo_documento = $tabla3.id_tipo_documento 
														AND $tabla2.id_estado_civil = $tabla4.id_estado_civil AND cot_fch_cotizacion 
														BETWEEN '$fechaInicialCotizaciones' AND '$fechaFinalCotizaciones' AND usuarios.id_Intermediario = :idIntermediario $condicion");

			}
			$stmt->bindParam(":idIntermediario",$_SESSION["intermediario"], PDO::PARAM_INT);
			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);

		}

	}


}
