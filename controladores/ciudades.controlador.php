<?php

class ControladorCiudades{

/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarCiudades(){

        $item = "ciudadesbolivar";
		$respuesta = ModeloCiudades::MdlMostrarCiudades($item);
        return $respuesta;
	}
	
	static public function ctrBuscarCiudades($item, $valor){
		
        $item2 = "ciudadesbolivar";
		$respuesta = ModeloCiudades::MdlBuscarCiudades($item, $valor, $item2);
        return $respuesta;
	}

}