<?php

require_once "conexion.php";

class ModeloClientes{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos){
		
		echo'<script>console.log("Ingreso al Metodo mdlIngresarCliente");</script>';

		//Genera un consecutivo unico en cada cotizacion que aumenta de a 1 si hay registros existentes.
		$stmt = Conexion::conectar()->prepare("SELECT cli_codigo FROM clientes ORDER BY id_cliente DESC LIMIT 1");
		$stmt->execute();

		if($stmt -> rowCount() <= 1) {
			$row = $stmt->fetch();
			$cod = substr($row[0], 4);
			$cli_codigo = "CLI-".($cod + 1);			
		}else{
			$cli_codigo = "CLI-1";				
		}

		$intermediario = $_SESSION["intermediario"];

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cli_codigo, cli_num_documento, cli_nombre, cli_apellidos, cli_fch_nacimiento, cli_genero, cli_telefono, cli_email, cli_estado, id_tipo_documento, id_estado_civil, id_Intermediario) 
												VALUES (:codigo, :documento, :nombre, :apellido, :nacimiento, :genero, :telefono, :email, :estado, :tipo_documento, :estado_civil, :id_Intermediario)");

		$stmt->bindParam(":codigo", $cli_codigo, PDO::PARAM_STR);
		$stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_INT);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":nacimiento", $datos["nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_INT);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":id_Intermediario", $intermediario, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	public function mdlMostrarClientes($tabla, $tabla2, $tabla3, $tabla4, $tabla5, $item, $valor, $inter){
		
		$condicion = "";
		$stmt = "";

		if($_SESSION["rol"] != 1){ $condicion = "AND $tabla5.id_usuario = :idUsuario"; }

		if($item != null){
            
			if( $item == 'cli_num_documento'){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2, $tabla3 WHERE $tabla.id_tipo_documento = $tabla2.id_tipo_documento 
														AND $tabla.id_estado_civil = $tabla3.id_estado_civil AND $tabla.id_Intermediario = :intermediario AND $item = :$item");

                $stmt->bindParam(":intermediario", $inter, PDO::PARAM_INT);
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();

				return $stmt -> fetch(PDO::FETCH_ASSOC);
				setcookie('if', 'if if');

			}
			else if($item == 'id_cliente'){
			    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2, $tabla3 WHERE $tabla.id_tipo_documento = $tabla2.id_tipo_documento 
														AND $tabla.id_estado_civil = $tabla3.id_estado_civil AND $item = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();

				return $stmt -> fetch(PDO::FETCH_ASSOC);
				setcookie('if', 'if if');
			}
			else if($item == 'buscarCliente'){
				setcookie('if', 'if else if');
				$stmt = Conexion::conectar()->prepare("SELECT cli_codigo, cli_num_documento, cli_nombre, cli_apellidos, $tabla.cli_estado, $tabla2.id_tipo_documento, 
														$tabla3.id_estado_civil, concat_ws(' ', cli_num_documento, cli_nombre, cli_apellidos) as nomcompleto 
														FROM $tabla, $tabla2, $tabla3 WHERE $tabla.id_tipo_documento = $tabla2.id_tipo_documento 
														AND $tabla.id_estado_civil = $tabla3.id_estado_civil AND $tabla.cli_estado = 1 
														AND concat_ws(' ', cli_num_documento, cli_nombre, cli_apellidos) LIKE :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();

				return $stmt -> fetchAll(PDO::FETCH_ASSOC);
			}			

		}else{

			$intermediario = $_SESSION["intermediario"];

		    // setcookie('if', 'else');
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla, $tabla2, $tabla3, $tabla5 WHERE $tabla.id_tipo_documento = $tabla2.id_tipo_documento 
													AND $tabla.id_estado_civil = $tabla3.id_estado_civil AND $tabla.id_Intermediario = :intermediario $condicion GROUP BY $tabla.id_cliente");
					
					$stmt->bindParam(":intermediario", $intermediario, PDO::PARAM_INT);
					
			if($_SESSION["rol"] != 1){ $stmt->bindParam(":idUsuario", $_SESSION["idUsuario"], PDO::PARAM_INT); }
			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTIVAR CLIENTE
	=============================================*/

	static public function mdlActivarCliente($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cli_codigo = :codigo, cli_num_documento = :documento, cli_nombre = :nombre, cli_apellidos = :apellido, 
												cli_fch_nacimiento = :nacimiento, cli_genero = :genero, cli_telefono = :telefono, cli_email = :email, cli_estado = :estado, 
												id_tipo_documento = :tipo_documento, id_estado_civil = :estado_civil WHERE id_cliente = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_INT);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":nacimiento", $datos["nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_INT);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
        MOSTRAR TIPO DE DOCUMENTO
	=============================================*/

	static public function mdlMostrarTipoDocumento($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch(PDO::FETCH_ASSOC);

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR EL ESTADO CIVIL
	=============================================*/

	static public function mdlMostrarEstadoCivil($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch(PDO::FETCH_ASSOC);

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll(PDO::FETCH_ASSOC);

		}

		$stmt -> close();

		$stmt = null;

	}

}

