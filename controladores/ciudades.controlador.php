<?php

class ControladorCiudades{

/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarCiudades(){

        $item = "ciudadesBolivar";
		$respuesta = ModeloCiudades::MdlMostrarCiudades($item);
        return $respuesta;
	}
	
	static public function ctrBuscarCiudades($item, $valor){

        $item2 = "ciudadesBolivar";
		$respuesta = ModeloCiudades::MdlBuscarCiudades($item, $valor, $item2);
        return $respuesta;
	}

}