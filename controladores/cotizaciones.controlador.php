<?php

class ControladorCotizaciones{

	/*=============================================
	MOSTRAR COTIZACIONES
	=============================================*/

	static public function ctrMostrarCotizaciones($item, $valor){

		session_start();
		$tabla = "cotizaciones";
		$tabla2 = "clientes";
		$tabla3 = "tipos_documentos";
		$tabla4 = "estados_civiles";
		$tabla5 = "usuarios";
		$tabla6 = "ciudadesbolivar";
		

		$respuesta = ModeloCotizaciones::mdlMostrarCotizaciones($tabla, $tabla2, $tabla3, $tabla4, $tabla5, $tabla6, $item, $valor);
				
		return $respuesta;

	}


	/*=============================================
	MOSTRAR COTIZACIONES "OFERTAS"
	=============================================*/
	
	static public function ctrMostrarCotizaOfertas($item, $valor){

		$tabla = "ofertas";

		$respuesta = ModeloCotizaciones::ctrMostrarCotizaOfertas($tabla, $item, $valor);

		return $respuesta;

	}	


	/*=============================================
	ELIMINAR COTIZACIÓN
	=============================================*/

	static public function ctrEliminarCotizacion(){

		if(isset($_GET["idCotizacion"])){

			$tabla = "cotizaciones";
			$tabla2 = "ofertas";
			$datos = $_GET["idCotizacion"];

			$respuesta = ModeloCotizaciones::mdlEliminarCotizaciones($tabla, $tabla2, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La cotización ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "inicio";

								}
							})

				</script>';

			}		

		}

	}
	

	/*=============================================
	RANGO FECHAS COTIZACIONES
	=============================================*/	

	static public function ctrRangoFechasCotizaciones($fechaInicialCotizaciones, $fechaFinalCotizaciones){

		$tabla = "cotizaciones";
		$tabla2 = "clientes";
		$tabla3 = "tipos_documentos";
		$tabla4 = "estados_civiles";
		$tabla5 = "usuarios";
		$tabla6 = "intermediario";

		$respuesta = ModeloCotizaciones::mdlRangoFechasCotizaciones($tabla, $tabla2, $tabla3, $tabla4, $tabla5,$tabla6, $fechaInicialCotizaciones, $fechaFinalCotizaciones);

		return $respuesta;
		
	}
	

}
