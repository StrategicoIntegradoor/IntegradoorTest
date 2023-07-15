<?php

require_once "conexion.php";

class ModeloUsuarios
{


	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $tabla2, $tabla3, $item, $valor)
	{

		if ($item != null) {

			if ($item == 'id_usuario' || $item == 'usu_usuario' || $item == 'usu_documento') {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2 WHERE $tabla.id_rol = $tabla2.id_rol AND $item = :$item");

				$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
				$stmt->execute();

				return $stmt->fetch(PDO::FETCH_ASSOC);
			}
		} else {

			if ($_SESSION["rol"] == 18 || $_SESSION["rol"] == 10 || $_SESSION["rol"] == 1) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2 WHERE $tabla.id_rol = $tabla2.id_rol");

				$stmt->execute();

				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} else {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2 WHERE $tabla.id_rol = $tabla2.id_rol AND id_intermediario =" . $_SESSION["intermediario"]);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
		}


		$stmt->close();

		$stmt = null;
	}



	/*=============================================
	PERMISOS USUARIOS
	=============================================*/

	static public function mdlUsuariosLogin($tabla, $tabla2, $tabla3, $tabla4, $item, $valor, $tablaAseguradora1)
	{


		$tabla = "usuarios";
		$tabla2 = "roles";
		$tabla3 = "intermediario";
		$tabla4 = "permisosintegradoor";

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

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2,$tabla4,$tablaAseguradora1, $tablaAseguradora2, $tablaAseguradora3, $tablaAseguradora4, $tablaAseguradora5, $tablaAseguradora6, $tablaAseguradora7, $tablaAseguradora8, $tablaAseguradora8, $tablaAseguradora9, $tablaAseguradora10, $tablaAseguradora11, $tablaAseguradora12 WHERE $tabla.id_rol = $tabla2.id_rol AND $tabla.id_rol = $tabla4.idRol AND $tablaAseguradora1.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora2.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora3.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora4.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora5.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora6.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora7.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora8.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora9.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora10.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora11.id_Intermediario = $tabla.id_Intermediario AND $tablaAseguradora12.id_Intermediario = $tabla.id_Intermediario AND $item = :$item");
		$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
		$stmt->execute();


		return $stmt->fetch(PDO::FETCH_ASSOC);

		$stmt->close();
		$stmt = null;
	}










	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos)
	{


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usu_documento, usu_nombre, usu_apellido, usu_usuario, usu_password, usu_genero, usu_telefono, usu_email, 
																	usu_cargo, usu_foto, usu_estado, id_rol, id_Intermediario, numCotizaciones, fechaFin) 
																	VALUES (:documento, :nombre, :apellido, :usuario, :password, :genero, :telefono, :email, :cargo, :foto, 1, :rol, :intermediario, :maxCot,  :fechaLimite )");

		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_INT);
		$stmt->bindParam(":intermediario", $datos["intermediario"], PDO::PARAM_INT);
		$stmt->bindParam(":maxCot", $datos["maxCotizaciones"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaLimite", $datos["fechaLimite"], PDO::PARAM_STR);




		echo '<script>

		swal({

			type: "success",
			title: "' . $datos["intermediario"] . '",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"

		}).then(function(result){

			if(result.value){
			
				window.location = "usuarios";

			}

		});
	

		</script>';



		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usu_documento = :documento, usu_nombre = :nombre, usu_apellido = :apellido, usu_password = :password, 
												usu_genero = :genero, usu_telefono = :telefono, usu_email = :email, usu_cargo = :cargo, usu_foto = :foto, id_rol = :rol, id_Intermediario = :intermediario, numCotizaciones = :maxCotEdi, fechaFin = :fechaLimEdi
												WHERE usu_usuario = :usuario");

		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":intermediario", $datos["intermediario"], PDO::PARAM_STR);
		$stmt->bindParam(":maxCotEdi", $datos["maxCotEdi"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaLimEdi", $datos["fechaLimEdi"], PDO::PARAM_STR);
		$stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
}
