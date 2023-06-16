<?php

require "../modelos/password.modelo.php";

  class PasswordController {

	static public function postValidate(){

        
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$requestData = json_decode(file_get_contents('php://input'), true);
            

			if (isset($requestData['accion'])) {
			  $accion = $requestData['accion'];
		
			  if ($accion === 'enviarCorreo') {
				if (isset($requestData['correo'])) {
					$email = $requestData['correo'];
					$mail = new PasswordController();
					$mail->enviarCorreo($email);
				}
			  } else { 
					if($accion === 'verificarToken'){

					}else{
					$response = ['success' => false, 'message' => 'Error al enviar el correo'];
					echo $response;
				}
			  }
			}
		  }
	}

	function enviarCorreo($email){
				
			$tabla = "usuarios";
			$item = "usu_email";
			$valor = $email;

			$respuesta = ModeloPassword::mdlBuscarCorreo($tabla, $item ,$valor);
		}


	function postCambio(){
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$requestData = json_decode(file_get_contents('php://input'), true);
		  
			if (isset($requestData['accion']) && isset($requestData['cc'])){
			  $accion = $requestData['accion'];
		
			  if ($accion === 'verificarToken') {
				if (isset($requestData['cc'])) {
					$token = $requestData['security'];
					$documento = $requestData['cc'];
					$claveN = $requestData['first'];
					$claveNv = $requestData['last']; 
					$item = new PasswordController();
					$item->verificarDocumento($documento, $claveN, $claveNv, $token);
				}
			  } else {
				$response = ['success' => false, 'message' => 'Error al ingresar token o documento'];
				echo $response;
			  }
			}
		  }

	}

	function verificarDocumento($documento, $claveN, $claveNv, $token){

			$tabla = "usuarios";
			$item = "usu_documento";
			$valor = $documento;

			$respuesta = ModeloPassword::mdlBuscarDocumento($tabla, $item ,$valor, $claveN, $claveNv, $token);

			if(!isset($respuesta['error'])){
				$idUsuario = $respuesta['id_usuario']; 
				$cambio = ModeloPassword::mdlCambiarClave($tabla, $idUsuario, $claveNv);
				if ($cambio){
                    $item = ModeloPassword::mdlBorrarToken($tabla, $idUsuario);
					$response = array('success' => 'OK');
					echo json_encode($response);
				}else{
					echo array('error' => 'No se pudo actualizar la contraseña, problemas de conexión');
				}
            }else{
				echo json_encode($respuesta); 
			}
	}

	}

	 $password = new PasswordController();
	 $password->postValidate();  

	 $passwordChange = new PasswordController();
	 $passwordChange->postCambio(); 
	








