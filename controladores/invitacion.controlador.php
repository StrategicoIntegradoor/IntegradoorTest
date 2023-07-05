<?php

require "../modelos/registro.modelo.php";

class invitationController{

    public static function authValidate(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $requestData = json_decode(file_get_contents('php://input'), true);

            $accion = $requestData['accion'];

            if($accion === 'verificarCodigo'){

                $tabla = "usuarios";
                $item = "tokenGuest";
                $clave = $requestData['clave'];
                $nombre = $requestData['nombre'];
                $apellido = $requestData['apellido'];
                $tipo_documento = '0';
                $identificacion = $requestData['identificacion'];
                $dia_nacimiento = $requestData['dia_nacimiento'];
                $mes_nacimiento = $requestData['mes_nacimiento'];
                $anio_nacimiento = $requestData['anio_nacimiento'];
                $genero = $requestData['genero'];
                $direccion = $requestData['direccion'];
                $ciudad = $requestData['ciudad'];
                $telefono = '0';
                $celular = $requestData['celular'];
                $correo_electronico = $requestData['correo_electronico'];
                $contrasena = $requestData['contrasena'];
                $confirmar_contrasena = $requestData['confirmar_contrasena'];
                $accion = $requestData['accion'];
                
                if($contrasena === $confirmar_contrasena){

                $response = ModeloRegistroFreeLancer::mdlBuscarCodigo($clave, $nombre, $apellido, $tipo_documento, $identificacion, $dia_nacimiento, $mes_nacimiento, $anio_nacimiento, $genero, $direccion, $ciudad, $telefono, $celular, $correo_electronico, $contrasena, $confirmar_contrasena, $accion, $tabla, $item) ;

                if($response == true){

                    $usuario = $identificacion;
                    $response = ModeloRegistroFreeLancer::mdlRegistrarFreeLancer($nombre, $apellido, $direccion, $ciudad, $usuario, $confirmar_contrasena, $genero, $telefono, $correo_electronico, $dia_nacimiento, $mes_nacimiento, $anio_nacimiento, $tabla, $clave);

                    if($response == true){
                        $item = ModeloRegistroFreeLancer::mdlEliminarToken($usuario, $tabla);
                    } else {
                        echo $response;
                        // echo json_encode(['error' => 'Error de registro']);
                    }
                }
                
            }else{$response = array('error' => 'Fallo contrasenas');
                        $jsonResponse = json_encode($response);
                        echo $jsonResponse;
                        }
        }
    }


}}

$validate = new invitationController();
$validate->authValidate();  

// var_dump($request);
// die();