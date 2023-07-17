<?php

require "../modelos/exequial.modelo.php";

class olivosController{

    public static function agregarOlivos(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $requestData = json_decode(file_get_contents('php://input'), true);
            $accion = $requestData['accion'];

            if (isset($accion)){

                if ($accion === 'nuevaCotizacion'){
                    date_default_timezone_set('America/Bogota');
                    $tabla = 'segurosexequiales';
                    $numeroCoti = $requestData['registro'];
                    $nombre = $requestData['nombre'];
                    $edad = $requestData['edad'];
                    $tipo = $requestData['tipo'];
                    $usuario = $requestData['usuario'];
                    $idUsuario = $requestData['idUsuario'];
                    $fecha = date("d-m-Y h:i:s");
                    $formatoFecha = "d-m-Y H:i:s";
                    $fecha = DateTime::createFromFormat($formatoFecha, $fecha);
                    if ($fecha) {
                        $fecha_registro = $fecha->format('Y-m-d H:i:s'); // Imprime la fecha formateada
                    } else {
                        echo "Error al parsear la fecha.";
                    }
                    
					$registro = ModelOlivos::mdlAgregarCoti($tabla, $numeroCoti, $nombre, $edad, $tipo, $usuario, $fecha_registro, $idUsuario);
					
                }

            }
        }

    }
}


$registro = new olivosController();
$registro->agregarOlivos();  