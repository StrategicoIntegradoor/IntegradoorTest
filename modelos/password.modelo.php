<?php

$rutaAbsoluta = dirname(__DIR__) . '/libraries/src';


require_once "conexion.php";
require_once $rutaAbsoluta.'/PHPMailer.php';
require_once $rutaAbsoluta.'/SMTP.php';
require_once $rutaAbsoluta.'/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class ModeloPassword{

    static public function mdlBuscarCorreo($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		$resultado = $stmt -> fetch(PDO::FETCH_ASSOC);
        $nombre= $resultado['usu_nombre'];
		if($resultado){
			function generarToken() {

				$token = openssl_random_pseudo_bytes(16); // Genera una cadena aleatoria de 16 bytes
				$token = bin2hex($token); // Convierte los bytes en una cadena hexadecimal
				return $token;
			}
			
			$token = generarToken();
			if($token){
				// $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios (tokenPassword) VALUES (:token)");
				// $stmt -> bindParam(':token', $token);
				// $stmt -> execute();
			$encriptado = md5($token);
			$usuarioId = $resultado['id_usuario'];
			$emailString = $resultado['usu_email'];

			$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET tokenPassword = :token WHERE id_usuario = :id AND usu_email = :email");
			$stmt->bindParam(':token', $encriptado);
			$stmt->bindParam(':id', $usuarioId);
			$stmt->bindParam(':email', $emailString);
			$stmt->execute();
			}
			
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
			$emailString = $resultado['usu_email'];
			// echo $emailString;
			$mail->setFrom('correopruebaSMTP@outlook.com', 'Equipo Integradoor');
			$mail->addAddress($emailString, 'Usuario');

			//Configuración asunto y cuerpo del correo
			$mail->Subject = 'Email cambio de contraseña';
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
                
                <div class="container" background="https://www.integradoor.com/app/vistas/img/iregistro1.jpeg"> 
                    <table style="background-size:100% 100%;height:800px;width:600px" border="0" cellspacing="0" cellpadding="20" background="https://www.integradoor.com/app/vistas/img/iregistro1.jpeg">
                        <tr>
                            <td>
                                <h1 class="h1-name">Hola ' . $nombre . ',</h1>
                                <p style="color:#2e2e2e !important;">Se registra una solicitud de cambio de contraseña. En el presente correo se adjunta un token de seguridad junto con el enlace para llenar el formulario de cambio de contraseña.</p>
                                <h4 class="h4-name">Token: ' . $token . '</h4>
                                <h4 class="h4-name">Haga click en el siguiente enlace para cambiar contraseña: https://integradoor.com/app/change</h4>
                            </td>
                        </tr>
                     
                    </table>
                </div>
            </body>
            
            </html>';
            
            $mail->CharSet = 'UTF-8';
            
            $mail->Body  =  $message;

            $mail->IsHTML(true);
  

			// Enviar el correo
			$require= $mail->send();
			//var_dump($emailString);
			
			if ($require) {
				// $item = new ModeloPassword();
				// $item->mdlEspera($usuarioId);
				$response = array('success' => true, 'message' => 'Correo enviado correctamente');
				$jsonResponse = json_encode($response);
        		echo $jsonResponse;
			} else {
				$response = array('success' => false, 'message' => 'Error al enviar el correo');
				$jsonResponse = json_encode($response);
    			return $jsonResponse;
			}
		}else {
			$response = array('error' => 'Busqueda no encontrada');
			$jsonResponse = json_encode($response);
        	echo $jsonResponse;
		}	
	}

	static public function mdlBuscarDocumento($tabla, $item, $valor, $claveN, $claveNv, $token){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		$response = $stmt -> fetch(PDO::FETCH_ASSOC);
		$jsonResponse = json_encode($response);


		if (is_array($response)) {
			$tokenPassword = $response['tokenPassword']; 
			$crypt = md5($token);
			if($claveN !== $claveNv){
				return array('error' => 'No coinciden las contraseñas');
			}else if($tokenPassword !== $crypt){
				return array('error' => 'No coincide el token de seguridad');
			}else if($claveN === $claveNv && $tokenPassword === $crypt){
				return $response;
			}
		}else{
			$response = array('error' => 'No se encuentra el documento!');
			return $response;
		}
	}

	static public function mdlCambiarClave($tabla, $idUsuario, $claveNv){

        $encriptar = crypt($claveNv, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
		$idUsuario = intval($idUsuario);
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usu_password = :usu_password WHERE id_usuario = :id");
		$stmt->bindParam(':usu_password', $encriptar);
		$stmt->bindParam(':id', $idUsuario);
		$stmt->execute();
		$cambio = $stmt->execute();

		if ($cambio === true) {

			return true;
		} else {
			return false;
		}
	}

    static public function mdlBorrarToken($tabla, $idUsuario){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tokenPassword = NULL WHERE id_usuario = :id");
        // $stmt->bindParam(':tokenPassword', NULL);
		$stmt->bindParam(':id', $idUsuario);
		$stmt->execute();

    }

	// FUNCION BORRA TOKEN DESPUES DE CIERTO TIEMPO
	static public function mdlEspera($usuarioId){
		$tabla = "usuarios";
		usleep(60000000);
		$item = new ModeloPassword();
		$item->mdlBorrarToken($tabla, $usuarioId);

	} 
}