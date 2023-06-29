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
            $response = $preRegistro-> mdlPreRegistro($email, $cedula, $tabla, $token, $nombre);
            
            if($response === true){
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

                //Configuraci贸n asunto y cuerpo del correo
                $mail->Subject = 'Registrate como asesor freelance con Grupo Asistencia';
                $message = '
                <!DOCTYPE html>
                <html lang="es">
                
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <style>
                
                    .button {            
                        border: none;
                        background: #000000;
                        color: #88d600 !important;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        margin: 4px 2px;
                        cursor: pointer;
                        font-size: 20px;
                    }
                    .black{
                        color: #000;
                    }
                    .h1-name{
                        margin-top: 280px;
                        margin-left: 28px;
                        font-size: 36px;
                        color: #88d600;
                    }
                    .h4-name{
                        margin-left: 28px;
                        font-size: 15px;
                        color: #88d600;
                    }
                    .container {
                        margin-bottom: 2%;
                    }
                
                    .td-style{
                        vertical-align: unset;
                    }
                
                    p{
                        margin-left: 28px;
                        font-size: 20px;
                        color: black;
                    }
                    @media screen and (max-width:600px) {
                        .h1-name{
                            margin-top: 320px;
                            margin-left: 28px;
                            font-size: 20px;
                            color: #e78238;
                        }
                        .h4-name{
                
                            margin-left: 28px;
                            font-size: 10px;
                            color: #e78238;
                        }
                        p{
                            margin-left: 28px;
                            font-size: 13px;
                            color: black;
                        }
                        .button {            
                            border: none;
                            background: #88d600;
                            color: #fff !important;
                            padding: 10px 20px;
                            text-align: center;
                            text-decoration: none;
                            margin: 4px 2px;
                            cursor: pointer;
                            font-size: 15px;
                        }
                        
                    }
                    </style>
                </head>
                
                <body>
                    <!--[if gte mso 9]>
                        <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                            <v:fill type="tile" src="https://www.integradoor.com/app/vistas/img/iregistro1.jpg" color="#7bceeb"/>
                        </v:background>
                    <![endif]-->
                    <div class="container" background="https://www.integradoor.com/app/vistas/img/iregistro1.jpg"> 
                        <table style="background-size:100% 100%;height:800px;width:600px" border="0" cellspacing="0" cellpadding="20" background="https://www.integradoor.com/app/vistas/img/iregistro1.jpg">
                            <tr>
                                <td>
                                    <h1 class="h1-name">Hola ' . $nombre . ',</h1>
                                    <p style="color:#2e2e2e !important;">A continuacion te ha sido enviada una solicitud de registro para usuarios freelance. En el presente correo se adjunta un token de seguridad junto con el enlace para llenar el formulario y empezar a disfrutar de los beneficios .</p>
                                    <h4 class="h4-name">Token: ' . $token . '</h4>
                                    <h4 class="h4-name">Haga click en el siguiente enlace para cambiar contraseña: https://integradoor.com/Test/invitacion</h4>
                                </td>
                            </tr>
                         
                        </table>
                    </div>
                </body>
                
                </html>';
                
                $mail->CharSet = 'UTF-8';
                $mail->Body = $message;
                $mail->IsHTML(true);

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

    static public function mdlPreRegistro($email, $cedula, $tabla, $token, $nombre){
        $id_rol = '19';
        $id_intermediario = '3';
        $telefono = '0';
        $email = '0';
        $estado = '0';
        $numCotizaciones = '0';
        $fechFin = '2023-12-31';
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usu_documento, usu_usuario, usu_password, id_rol, id_intermediario, tokenGuest, usu_nombre, usu_apellido, usu_telefono, usu_email, usu_estado, numCotizaciones, fechaFin) 
        VALUES ('$cedula','$cedula','$cedula','$id_rol','$id_intermediario','$token','$nombre','$nombre','$telefono','$email','$estado','$numCotizaciones','$fechFin')");
        if($stmt-> execute()){
            return true;
        }else{
            return "Error de conexi贸n: " . $stmt->errorInfo()[2];
        }
    }

}