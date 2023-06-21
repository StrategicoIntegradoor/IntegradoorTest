<?php

require "../modelos/invitacion.modelo.php";


class GuestController{

    static public function authValidate(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $requestData = json_decode(file_get_contents('php://input'), true);

            $accion = $requestData['accion'];

            if($accion === 'verificarCC'){

                $tabla = "usuarios";
                $item = "usu_documento";
                $email = $requestData['correo'];
                $cedula = $requestData['cc'];
                $nombre = $requestData['nombre'];
                $response = ModeloInvitacion::mdlBuscarIdentificacion($email, $cedula, $nombre, $tabla, $item);
                if(isset($response['success'])){
                    return $response;
                } else {
                    echo $response;
                }
            }
        }
    }

}

$validate = new GuestController();
$validate->authValidate();  