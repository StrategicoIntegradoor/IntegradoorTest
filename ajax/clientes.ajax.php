<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	ACTIVAR CLIENTE
	=============================================*/	

	public $activarCliente;
	public $activarId;

	public function ajaxActivarCliente(){

		$tabla = "clientes";

		$item1 = "cli_estado";
		$valor1 = $this->activarCliente;

		$item2 = "id_cliente";
		$valor2 = $this->activarId;

		$respuesta = ModeloClientes::mdlActivarCliente($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id_cliente";
		$valor = $this->idCliente;
		
		$inter = "";

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor, $inter);

		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR EXISTENCIA DEL CLIENTE
	=============================================*/	

	public $validarDocumentoId;
	
	public $intermediario;

	public function ajaxValidarDocumentoId(){

		$item = "cli_num_documento";
		$valor = $this->validarDocumentoId;
		$inter = $this->intermediario;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor, $inter);

		echo json_encode($respuesta);

	}

	/*=============================================
	PERMITE CONSULTAR LOS CLIENTES DEL SISTEMA
	=============================================*/	
	
	public $buscarCliente;

	public function ajaxBuscarCliente(){

		$item = "buscarCliente";
        $valor = $this->buscarCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);
	
		echo json_encode($respuesta);

	}

	/*=============================================
	CARGA LOS TIPOS DE DOCUMENTO DE IDENTIDAD
	=============================================*/	

	// public $tipoDocId;

	// public function ajaxCargarTipoDocId(){

	// 	$item = "id_tipo_documento";
	// 	$valor = $this->tipoDocId;

	// 	$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

	// 	echo json_encode($respuesta);

	// }

}


/*=============================================
ACTIVAR CLIENTE
=============================================*/	

if(isset($_POST["activarCliente"])){

	$activarCliente = new AjaxClientes();
	$activarCliente -> activarCliente = $_POST["activarCliente"];
	$activarCliente -> activarId = $_POST["activarId"];
	$activarCliente -> ajaxActivarCliente();

}

/*=============================================
EDITAR CLIENTE
=============================================*/

if(isset($_POST["idCliente"])){

	$editar = new AjaxClientes();
	$editar -> idCliente = $_POST["idCliente"];
	$editar -> ajaxEditarCliente();

}

/*=============================================
VALIDAR EXISTENCIA DEL CLIENTE
=============================================*/

if(isset( $_POST["validarDocumentoId"])){

	$valDocumentoId = new AjaxClientes();
	$valDocumentoId -> validarDocumentoId = $_POST["validarDocumentoId"];
	$valDocumentoId -> intermediario = $_POST["intermediario"];
	$valDocumentoId -> ajaxValidarDocumentoId();

}

/*=============================================
PERMITE CONSULTAR LOS CLIENTES DEL SISTEMA
=============================================*/

if(isset($_POST["buscarCliente"])){

	$buscarCliente = new AjaxClientes();
	$buscarCliente -> buscarCliente = '%'.$_POST["buscarCliente"].'%';
	$buscarCliente -> ajaxBuscarCliente();

}

// /*=============================================
// CARGA LOS TIPOS DE DOCUMENTO DE IDENTIDAD
// =============================================*/
// if(isset($_POST["tipoDocId"])){

// 	$cargarTipoDocId = new AjaxClientes();
// 	$cargarTipoDocId -> tipoDocId = $_POST["tipoDocId"];
// 	$cargarTipoDocId -> ajaxCargarTipoDocId();

// }
