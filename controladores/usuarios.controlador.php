<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario()
	{

		if (isset($_POST["ingUsuario"])) {

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])) {

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";
				$tabla2 = "roles";
				$tabla3 = "intermediario";
				$tabla4 = "permisosintegradoor";

				/**
				 * tablas aseguradoras para el llamado de web service
				 */


				$tablaAseguradora1 = "Credenciales_Allianz";
				$tablaAseguradora2 = "Credenciales_AXA";
				$tablaAseguradora3 = "Credenciales_Bolivar";
				$tablaAseguradora4 = "Credenciales_Equidad";
				$tablaAseguradora5 = "Credenciales_Estado";


				$tablaAseguradora6 = "Credenciales_HDI";
				$tablaAseguradora7 = "Credenciales_Liberty";
				$tablaAseguradora8 = "Credenciales_Mapfre";
				$tablaAseguradora9 = "Credenciales_Previsora";

				$tablaAseguradora10 = "Credenciales_SBS";
				$tablaAseguradora11 = "Credenciales_Solidaria";
				$tablaAseguradora12 = "Credenciales_Zurich";

				$item = "usu_usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::mdlUsuariosLogin($tabla, $tabla2, $tabla3, $tabla4, $item, $valor, $tablaAseguradora1, $tablaAseguradora2, $tablaAseguradora3, $tablaAseguradora4, $tablaAseguradora5, $tablaAseguradora6, $tablaAseguradora7, $tablaAseguradora8, $tablaAseguradora9, $tablaAseguradora10, $tablaAseguradora11, $tablaAseguradora12);

				if ($respuesta["usu_usuario"] == $_POST["ingUsuario"] && $respuesta["usu_password"] === $encriptar) {
					if ($respuesta["usu_estado"] == 1) {



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
						$_SESSION["cotRestantesInter"] = $respuesta["Num_cot_plan"];

						/**
						 * Variable de sesion donde va guardar la imagen
						 */
						$_SESSION["imagenIntermediario"] = $respuesta["urlLogo"];

						/**
						 * Variable de sesion donde va guardar la informacion de la bd
						 */

						//ALLIANZ
						$_SESSION["cre_alli_sslcertfile"] = $respuesta["cre_alli_sslcertfile"];
						$_SESSION["cre_alli_sslkeyfile"] = $respuesta["cre_alli_sslkeyfile"];
						$_SESSION["cre_alli_passphrase"] = $respuesta["cre_alli_passphrase"];
						$_SESSION["cre_alli_partnerid"] = $respuesta["cre_alli_partnerid"];
						$_SESSION["cre_alli_agentid"] = $respuesta["cre_alli_agentid"];
						$_SESSION["cre_alli_partnercode"] = $respuesta["cre_alli_partnercode"];
						$_SESSION["cre_alli_agentcode"] = $respuesta["cre_alli_agentcode"];

						//AXA
						$_SESSION["cre_axa_sslcertfile"] = $respuesta["cre_axa_sslcertfile"];
						$_SESSION["cre_axa_sslkeyfile"] = $respuesta["cre_axa_sslkeyfile"];
						$_SESSION["cre_axa_passphrase"] = $respuesta["cre_axa_passphrase"];
						$_SESSION["cre_axa_codigoDistribuidor"] = $respuesta["cre_axa_codigoDistribuidor"];
						$_SESSION["cre_axa_idTipoDistribuidor"] = $respuesta["cre_axa_idTipoDistribuidor"];
						$_SESSION["cre_axa_codigoDivipola"] = $respuesta["cre_axa_codigoDivipola"];
						$_SESSION["cre_axa_canal"] = $respuesta["cre_axa_canal"];
						$_SESSION["cre_axa_validacionEventos"] = $respuesta["cre_axa_validacionEventos"];

						//BOLIVAR
						$_SESSION["cre_bol_api_key"] = $respuesta["cre_bol_api_key"];
						$_SESSION["cre_bol_claveAsesor"] = $respuesta["cre_bol_claveAsesor"];

						//EQUIDAD
						$_SESSION["cre_equ_usuario"] = $respuesta["cre_equ_usuario"];
						$_SESSION["cre_equ_contraseña"] = $respuesta["cre_equ_contraseña"];
						$_SESSION["cre_equ_codigo_sucursal"] = $respuesta["cre_equ_codigo_sucursal"];
						$_SESSION["cre_equ_token"] = $respuesta["cre_equ_token"];
						$_SESSION["cre_equ_fecha_token"] = $respuesta["cre_equ_fecha_token"];

						//ESTADO
						$_SESSION["cre_est_usuario"] = $respuesta["cre_est_usuario"];
						$_SESSION["cre_equ_contrasena"] = $respuesta["cre_equ_contrasena"];
						$_SESSION["Cre_Est_Entity_Id"] = $respuesta["Cre_Est_Entity_Id"];
						$_SESSION["cre_est_zona"] = $respuesta["cre_est_zona"];

						//HDI
						$_SESSION["cre_hdi_codSucursal"] = $respuesta["cre_hdi_codSucursal"];
						$_SESSION["cre_hdi_CodigoAgente"] = $respuesta["cre_hdi_CodigoAgente"];
						$_SESSION["cre_hdi_usuario"] = $respuesta["cre_hdi_usuario"];
						$_SESSION["cre_hdi_contrasena"] = $respuesta["cre_hdi_contrasena"];

						//LIBERTY
						$_SESSION["cre_lib_cookieToken"] = $respuesta["cre_lib_cookieToken"];
						$_SESSION["cre_lib_cookieRequest"] = $respuesta["cre_lib_cookieRequest"];
						$_SESSION["cre_lib_authorization"] = $respuesta["cre_lib_authorization"];
						$_SESSION["cre_lib_codigoAgenteGestion"] = $respuesta["cre_lib_codigoAgenteGestion"];
						$_SESSION["cre_lib_aplicacionCliente"] = $respuesta["cre_lib_aplicacionCliente"];
						$_SESSION["cre_lib_ip"] = $respuesta["cre_lib_ip"];
						$_SESSION["cre_lib_requestID"] = $respuesta["cre_lib_requestID"];
						$_SESSION["cre_lib_terminal"] = $respuesta["cre_lib_terminal"];

						//MAPFRE
						$_SESSION["cre_map_codCliente"] = $respuesta["cre_map_codCliente"];
						$_SESSION["cre_map_codigoOficinaAsociado"] = $respuesta["cre_map_codigoOficinaAsociado"];
						$_SESSION["cre_map_codigoIntermediario"] = $respuesta["cre_map_codigoIntermediario"];
						$_SESSION["cre_map_username"] = $respuesta["cre_map_username"];
						$_SESSION["cre_map_password"] = $respuesta["cre_map_password"];
						$_SESSION["cre_map_codigonivel3GA"] = $respuesta["cre_map_codigonivel3GA"];
						
						//PREVISORA
						$_SESSION["cre_pre_AgentCodeListCoin"] = $respuesta["cre_pre_AgentCodeListCoin"];
						$_SESSION["cre_pre_AgentAgencyTypeCode"] = $respuesta["cre_pre_AgentAgencyTypeCode"];
						$_SESSION["cre_pre_ParticipationCia"] = $respuesta["cre_pre_ParticipationCia"];
						$_SESSION["cre_pre_AgentCode"] = $respuesta["cre_pre_AgentCode"];
						$_SESSION["cre_pre_Username"] = $respuesta["cre_pre_Username"];
						$_SESSION["cre_pre_Password"] = $respuesta["cre_pre_Password"];

						//SBS
						$_SESSION["cre_sbs_usuario"] = $respuesta["cre_sbs_usuario"];
						$_SESSION["cre_sbs_contraseña"] = $respuesta["cre_sbs_contraseña"];

						//SOLIDARIA
						$_SESSION["cre_sol_cod_sucursal"] = $respuesta["cre_sol_cod_sucursal"];
						$_SESSION["cre_sol_cod_per"] = $respuesta["cre_sol_cod_per"];
						$_SESSION["cre_sol_cod_tipo_agente"] = $respuesta["cre_sol_cod_tipo_agente"];
						$_SESSION["cre_sol_cod_agente"] = $respuesta["cre_sol_cod_agente"];
						$_SESSION["cre_sol_cod_pto_vta"] = $respuesta["cre_sol_cod_pto_vta"];
						$_SESSION["cre_sol_grant_type"] = $respuesta["cre_sol_grant_type"];
						$_SESSION["cre_sol_Cookie_token"] = $respuesta["cre_sol_Cookie_token"];
						$_SESSION["cre_sol_token"] = $respuesta["cre_sol_token"];
						$_SESSION["cre_sol_fecha_token"] = $respuesta["cre_sol_fecha_token"];

						//ZURICH
						$_SESSION["cre_zur_nomUsu"] = $respuesta["cre_zur_nomUsu"];
						$_SESSION["cre_zur_passwd"] = $respuesta["cre_zur_passwd"];
						$_SESSION["cre_zur_intermediaryEmail"] = $respuesta["cre_zur_intermediaryEmail"];
						$_SESSION["cre_zur_Cookie"] = $respuesta["cre_zur_Cookie"];
						$_SESSION["cre_zur_token"] = $respuesta["cre_zur_token"];
						$_SESSION["cre_zur_fecha_token"] = $respuesta["cre_zur_fecha_token"];




						
						







						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

						date_default_timezone_set('America/Bogota');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha . ' ' . $hora;

						$item1 = "usu_ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id_usuario";
						$valor2 = $respuesta["id_usuario"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);



						if ($ultimoLogin == "ok") {

							echo '<script>

									window.location = "inicio";

								</script>';
						}
					} else {

						echo '<br>
							<div class="alert alert-danger">Esta cuenta esta bloqueada. Indica otra cuenta o comunicate con tu administrador</div>';
					}
				} else {
					echo '<br>
									<div class="alert alert-danger">Usuario y/o Contraseña incorrecta. Vuelve a intentarlo o selecciona ¿Se te olvido la contraseña? para cambiarla</div>';
				}
			}
		}
	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario()
	{



		if (isset($_POST["nuevoUsuario"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellido"]) &&
				preg_match('/^[0-9]+$/', $_POST["nuevoDocIdUser"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
				preg_match('/^[a-zA-Z0-9_\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCargo"])
			) {

				// Convierto el usuario a Minisculas
				$nuevoUsuario = strtolower($_POST["nuevoUsuario"]);

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/" . $nuevoUsuario;

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $nuevoUsuario . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["nuevaFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $nuevoUsuario . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}



				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array(
					"nombre" => $_POST["nuevoNombre"],
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
					"foto" => $ruta
				);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if ($respuesta == "ok") {

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
			} else {

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

	static public function ctrMostrarUsuarios($item, $valor)
	{

		$tabla = "usuarios";
		$tabla2 = "roles";
		$tabla3 = "intermediario";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $tabla2, $tabla3, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario()
	{

		if (isset($_POST["editarUsuario"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellido"] &&
					preg_match('/^[0-9]+$/', $_POST["editarDocIdUser"])) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
				preg_match('/^[a-zA-Z0-9_\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/', $_POST["editarEmail"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCargo"])
			) {

				// Convierto el usuario a Minisculas
				$editarUsuario = strtolower($_POST["editarUsuario"]);

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/" . $editarUsuario;

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["fotoActual"])) {

						unlink($_POST["fotoActual"]);
					} else {

						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $editarUsuario . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["editarFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $editarUsuario . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuarios";

				if ($_POST["editarPassword"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {

						echo '<script>
						

								swal.fire({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

						return;
					}
				} else {

					$encriptar = $_POST["passwordActual"];
				}

				$datos = array(
					"nombre" => $_POST["editarNombre"],
					"apellido" => $_POST["editarApellido"],
					"documento" => $_POST["editarDocIdUser"],
					"usuario" => $_POST["editarUsuario"],
					"password" => $encriptar,
					"genero" => $_POST["editarGenero"],
					"rol" => $_POST["editarRol"],
					"telefono" => $_POST["editarTelefono"],
					"email" => $_POST["editarEmail"],
					"cargo" => $_POST["editarCargo"],
					"intermediario" => $_POST["Intermediario2"],
					"maxCotEdi" => $_POST["maxCotEdi"],
					"fechaLimEdi" => $_POST["fechaLimEdi"],
					"foto" => $ruta
				);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

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
			} else {

				echo '<script>

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

	static public function ctrBorrarUsuario()
	{

		if (isset($_GET["idUsuario"])) {

			$tabla = "usuarios";
			$datos = $_GET["idUsuario"];

			if ($_GET["fotoUsuario"] != "") {

				// Convierto el usuario a Minisculas
				$usuario = strtolower($_GET["usuario"]);

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/' . $usuario);
			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

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
