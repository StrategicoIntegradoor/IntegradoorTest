<?php

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";
				$tabla2 = "roles";
				$tabla3 = "intermediario";
				$tabla4 = "permisosintegradoor";

				$item = "usu_usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::mdlUsuariosLogin($tabla, $tabla2, $tabla3,$tabla4, $item, $valor);
			
				if($respuesta["usu_usuario"] == $_POST["ingUsuario"] && $respuesta["usu_password"] === $encriptar ){
					if($respuesta["usu_estado"] == 1){
						
					
					
						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["idUsuario"] = $respuesta["id_usuario"];
						$_SESSION["nombre"] = $respuesta["usu_nombre"];
						$_SESSION["apellido"] = $respuesta["usu_apellido"];
						$_SESSION["usuario"] = $respuesta["usu_usuario"];
						$_SESSION["foto"] = $respuesta["usu_foto"];
						$_SESSION["rol"] = $respuesta["id_rol"];
						$_SESSION["intermediario"] = $respuesta["id_Intermediario"];
						$_SESSION["cotRestantes"] = $respuesta["numCotizaciones"];
						$_SESSION["fechaLimi"] = $respuesta["fechaFin"];
						$_SESSION["permisos"] = $respuesta;

		


						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

						date_default_timezone_set('America/Bogota');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "usu_ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id_usuario";
						$valor2 = $respuesta["id_usuario"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						

						if($ultimoLogin == "ok"){
						
								echo '<script>

									window.location = "inicio";

								</script>';
						}			
					
					}else{

						echo '<br>
							<div class="alert alert-danger">Esta cuenta esta bloqueada. Indica otra cuenta o comunicate con tu administrador</div>';

					}
				}else{
					echo '<br>
									<div class="alert alert-danger">Usuario y/o Contraseña incorrecta. Vuelve a intentarlo o selecciona ¿Se te olvido la contraseña? para cambiarla</div>';
				}

			}	

		}

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario(){
	
		

		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellido"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoDocIdUser"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
			   preg_match('/^[a-zA-Z0-9_\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCargo"])){

				// Convierto el usuario a Minisculas
				$nuevoUsuario = strtolower($_POST["nuevoUsuario"]);

			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				// if(isset($_FILES["nuevaFoto"]["tmp_name"])){

				// 	list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

				// 	$nuevoAncho = 500;
				// 	$nuevoAlto = 500;

				// 	/*=============================================
				// 	CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				// 	=============================================*/

				// 	$directorio = "vistas/img/usuarios/".$nuevoUsuario;

				// 	mkdir($directorio, 0755);

				// 	/*=============================================
				// 	DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				// 	=============================================*/

				// 	if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

				// 		/*=============================================
				// 		GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				// 		=============================================*/

				// 		$aleatorio = mt_rand(100,999);

				// 		$ruta = "vistas/img/usuarios/".$nuevoUsuario."/".$aleatorio.".jpg";

				// 		$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

				// 		$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// 		imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				// 		imagejpeg($destino, $ruta);

				// 	}

				// 	if($_FILES["nuevaFoto"]["type"] == "image/png"){

				// 		/*=============================================
				// 		GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				// 		=============================================*/

				// 		$aleatorio = mt_rand(100,999);

				// 		$ruta = "vistas/img/usuarios/".$nuevoUsuario."/".$aleatorio.".png";

				// 		$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

				// 		$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// 		imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				// 		imagepng($destino, $ruta);

				// 	}

				// }


				
				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				// var_dump($_POST);
				// die();
				$datos = array("nombre" => $_POST["nuevoNombre"],
							   "apellido" => $_POST["nuevoApellido"],
					           "documento" => $_POST["nuevoDocIdUser"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
							   "genero" => $_POST["nuevoGenero"],
					           "rol" => $_POST["nuevoRol"],
							   "telefono" => $_POST["nuevoTelefono"],
							   "email" => $_POST["nuevoEmail"],
							   "cargo" => $_POST["nuevoCargo"],
							   "maxCotizaciones" => $_POST["maxCot"],  
							   "intermediario" => $_POST["Intermediario"],
							   "fechaLimite" => $_POST["fecLim"],
							   "fechaNacimiento" => $_POST["AgregfechNacimiento"],
							   "direccion" => $_POST["AgregDireccion"],
							   "ciudad" => $_POST["ingciudadCirculacion"],
							   "tipoDocumento" => $_POST["agregarTipoDocumento"],
					           "foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal.fire({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

					swal.fire({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";
		$tabla2 = "roles";
		$tabla3= "intermediario";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $tabla2, $tabla3, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellido"] &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocIdUser"])) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
			   preg_match('/^[a-zA-Z0-9_\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/', $_POST["editarEmail"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCargo"])){

				// Convierto el usuario a Minisculas
				$editarUsuario = strtolower($_POST["editarUsuario"]);

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$editarUsuario;

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$editarUsuario."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$editarUsuario."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuarios";

				// if($_POST["editarPassword"] != ""){

				// 	if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

				// 		$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				// 	}else{

				// 		echo'<script>
						

				// 				swal.fire({
				// 					  type: "error",
				// 					  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
				// 					  showConfirmButton: true,
				// 					  confirmButtonText: "Cerrar"
				// 					  }).then(function(result) {
				// 						if (result.value) {

				// 						window.location = "usuarios";

				// 						}
				// 					})

				// 		  	</script>';

				// 		  	return;

				// 	}

				// }else{

				// 	$encriptar = $_POST["passwordActual"];

				// // }
				// var_dump($_POST["ciudad2"]);
				// die();
				
				if($_POST["ciudad2"] == NULL){
				$datos = array("nombre" => $_POST["editarNombre"],
							   "apellido" => $_POST["editarApellido"],
							   "documento" => $_POST["editarDocIdUser"],
							   "tipoDocumento" => $_POST["editarTipoDocumento"],
							   "usuario" => $_POST["editarUsuario"],
							//    "password" => $encriptar,
							   "genero" => $_POST["editarGenero"],
							   "fechNacimiento" => $_POST["fechNacimiento"],
							   "direccion" => $_POST["editarDireccion"],
							   "rol" => $_POST["editarRol"],
							   "telefono" => $_POST["editarTelefono"],
							   "email" => $_POST["editarEmail"],
							   "cargo" => $_POST["editarCargo"],
							   "intermediario" => $_POST["Intermediario2"],
							   "maxCotEdi" => $_POST["maxiCot"],
							   "fechaLimEdi" => $_POST["fechaLimEdi"],
							   "ciudad" => $_POST["codigoCiudadActual"],
							   "foto" => $ruta);
				}else{
					$datos = array("nombre" => $_POST["editarNombre"],
							   "apellido" => $_POST["editarApellido"],
							   "documento" => $_POST["editarDocIdUser"],
							   "tipoDocumento" => $_POST["editarTipoDocumento"],
							   "usuario" => $_POST["editarUsuario"],
							//    "password" => $encriptar,
							   "genero" => $_POST["editarGenero"],
							   "fechNacimiento" => $_POST["fechNacimiento"],
							   "direccion" => $_POST["editarDireccion"],
							   "rol" => $_POST["editarRol"],
							   "telefono" => $_POST["editarTelefono"],
							   "email" => $_POST["editarEmail"],
							   "cargo" => $_POST["editarCargo"],
							   "intermediario" => $_POST["Intermediario2"],
							   "maxCotEdi" => $_POST["maxiCot"],
							   "fechaLimEdi" => $_POST["fechaLimEdi"],
							   "ciudad" => $_POST["ciudad2"],
							   "foto" => $ruta);
				}

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
				
				var_dump($respuesta);
				die();

				if($respuesta == "ok"){

					echo'<script>

					swal.fire({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

											window.location = "usuarios";
							

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal.fire({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				// Convierto el usuario a Minisculas
				$usuario = strtolower($_GET["usuario"]);

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$usuario);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal.fire({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}


}
	


