<?php

$rutaAbsoluta = dirname(__DIR__) . '/libraries/src';
require_once "conexion.php";
require_once $rutaAbsoluta.'/PHPMailer.php';
require_once $rutaAbsoluta.'/SMTP.php';
require_once $rutaAbsoluta.'/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class ModeloInvitacion{

    static public function mdlBuscarIdentificacion($email, $cedula, $nombre, $tabla, $item){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $cedula, PDO::PARAM_STR);
		$stmt -> execute();
		$resultado = $stmt -> fetch(PDO::FETCH_ASSOC);

		if($resultado === false){

        function generarToken() {
            $token = openssl_random_pseudo_bytes(16); 
            $token = bin2hex($token); 
            return $token;
            }
            $token = generarToken();
            $preRegistro = new ModeloInvitacion();
            $response = $preRegistro-> mdlPreRegistro($email, $cedula, $tabla, $token);
            if($response){

                // Configuracion SMTP
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.office365.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = 'correopruebaSMTP@outlook.com';
                $mail->Password = 'Seguros35.';

                // Configurar el remitente y destinatario del correo
                $emailString = $email;
                // echo $emailString;
                $mail->setFrom('correopruebaSMTP@outlook.com', 'Equipo Integradoor');
                $mail->addAddress($emailString, 'Usuario');

                //Configuración asunto y cuerpo del correo
                $mail->Subject = 'Email invitacion free lance SGA';
                $mail->Body = 'Buen dia estimad@ '.$nombre.', a continuacion se envía un formato para completar el registro en la plataforma de cotizaciones Integradoor. En el presente correo se adjunta un token de seguridad junto con el enlace para llenar el formulario. Token de seguridad: '. $token.' y el enlace para completar el cambio de contraseña es: http://localhost/appPruebasDemo2/invitacion';

                    //Manjeo de respuestas
                    if ($mail->send()) {
                        $response = array('success' => 'Registro exitoso');
                        $jsonResponse = json_encode($response);
                        echo $jsonResponse;
                    } else {
                        $response = array('success' => false, 'message' => 'Error al enviar el correo');
                        $jsonResponse = json_encode($response);
                        return $jsonResponse;
                    }
            }else{
                $response = array('error' => 'Error de conexion');
                $jsonResponse = json_encode($response);
                echo $jsonResponse;
            }
        }else{
            $response = array('error' => 'Documento existente en la BDD');
			$jsonResponse = json_encode($response);
        	echo $jsonResponse;
        }
    }

    static public function mdlPreRegistro($email, $cedula, $tabla, $token){
        $id_rol = '19';
        $id_intermediario = '3';
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usu_documento, usu_usuario, usu_password, id_rol, id_intermediario, tokenGuest) 
        VALUES ('$cedula','$cedula','$cedula','$id_rol','$id_intermediario','$token')");
        if($stmt-> execute()){
            return true;
        }else{
            return "Error de conexión: " . $stmt->errorInfo()[2];
        }
    }

}