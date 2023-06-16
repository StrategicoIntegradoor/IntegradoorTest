<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoNumDocIdCliente"])){

			if(preg_match('/^[0-9]+$/', $_POST["nuevoTipoDocIdCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoNumDocIdCliente"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreCliente"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoDiaNacCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoMesNacCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoAnioNacCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoGeneroCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoEstCivilCliente"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefonoCliente"]) &&
			   preg_match('/^[a-zA-Z0-9_\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/', $_POST["nuevoEmailCliente"])){

				$fecha_nacimiento = $_POST["nuevoAnioNacCliente"].'-'.$_POST["nuevoMesNacCliente"].'-'.$_POST["nuevoDiaNacCliente"];

			   	$tabla = "clientes";

			   	$datos = array("tipo_documento"=>$_POST["nuevoTipoDocIdCliente"],
							   "documento"=>$_POST["nuevoNumDocIdCliente"],
							   "nombre"=>$_POST["nuevoNombreCliente"],
				   			   "apellido"=>$_POST["nuevoApellidoCliente"],
					           "nacimiento"=>$fecha_nacimiento,
					           "genero"=>$_POST["nuevoGeneroCliente"],
					           "estado_civil"=>$_POST["nuevoEstCivilCliente"],
					           "telefono"=>$_POST["nuevoTelefonoCliente"],
					           "email"=>$_POST["nuevoEmailCliente"],
					           "estado"=>1);

			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal.fire({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal.fire({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor, $inter){

		$tabla = "clientes";
		$tabla2 = "tipos_documentos";
		$tabla3 = "estados_civiles";
		$tabla4 = "cotizaciones";
		$tabla5 = "usuarios";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $tabla2, $tabla3, $tabla4, $tabla5, $item, $valor, $inter);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarNumDocIdCliente"])){

			if(preg_match('/^[0-9]+$/', $_POST["editarTipoDocIdCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarNumDocIdCliente"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreCliente"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDiaNacCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarMesNacCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarAnioNacCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarGeneroCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarEstCivilCliente"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefonoCliente"]) &&
			   preg_match('/^[a-zA-Z0-9_\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/', $_POST["editarEmailCliente"])){

				$fecha_nacimiento = $_POST["editarAnioNacCliente"].'-'.$_POST["editarMesNacCliente"].'-'.$_POST["editarDiaNacCliente"];

			   	$tabla = "clientes";

			   	$datos = array("id"=>$_POST["idCliente"],
							   "codigo"=>$_POST["codCliente"],
							   "tipo_documento"=>$_POST["editarTipoDocIdCliente"],
							   "documento"=>$_POST["editarNumDocIdCliente"],
							   "nombre"=>$_POST["editarNombreCliente"],
				   			   "apellido"=>$_POST["editarApellidoCliente"],
					           "nacimiento"=>$fecha_nacimiento,
					           "genero"=>$_POST["editarGeneroCliente"],
					           "estado_civil"=>$_POST["editarEstCivilCliente"],
					           "telefono"=>$_POST["editarTelefonoCliente"],
					           "email"=>$_POST["editarEmailCliente"],
					           "estado"=>$_POST["idEstado"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal.fire({
						  type: "success",
						  title: "El cliente ha sido actualizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal.fire({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal.fire({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}		

		}

	}


	/*=============================================
	MOSTRAR TIPO DE DOCUMENTO
	=============================================*/

	static public function ctrMostrarTipoDocumento($item, $valor){

		$tabla = "tipos_documentos";

		$respuesta = ModeloClientes::mdlMostrarTipoDocumento($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR EL ESTADO CIVIL
	=============================================*/

	static public function ctrMostrarEstadoCivil($item, $valor){

		$tabla = "estados_civiles";

		$respuesta = ModeloClientes::mdlMostrarEstadoCivil($tabla, $item, $valor);

		return $respuesta;

	}


}

