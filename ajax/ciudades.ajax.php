<?php

require_once "../controladores/ciudades.controlador.php";
require_once "../modelos/ciudades.modelo.php";

class AjaxCiudades{

    	/*=============================================
	EDITAR CIUDAD
	=============================================*/	

	// public $valor;

    public function ajaxMostrarCiudades(){

        $respuesta = ControladorCiudades::ctrMostrarCiudades();
        echo json_encode($respuesta);

    }

	public function ajaxEditarCiudad(){
        
		$item = "Codigo";
        $valor = $_POST['ciudad']; // Asignar el valor de la propiedad 'valor' a una variable local
		$respuesta = ControladorCiudades::ctrBuscarCiudades($item, $valor);

		echo json_encode($respuesta);

	}


}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $edit = new AjaxCiudades();
    $edit->ajaxEditarCiudad();
}


if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $term = $_GET["q"];
    $ciudades = ControladorCiudades::ctrMostrarCiudades();

    // $ciudades = json_encode($respuesta);

    // Lógica para obtener las ciudades según el término de búsqueda
    // Término de búsqueda ingresado por el usuario

    // Simulamos la respuesta con un array de ciudades
    // $ciudades = [];
    $ciudadesSelect2 = [];
    foreach ($ciudades as $ciudad) {
    $ciudadesSelect2[] = [
        "id" => $ciudad["Codigo"],
        "text" => $ciudad["Nombre"],

    ];
    }

    // foreach ($respuesta as $ciudad) {
    //     $ciudades[] = ["id" => $ciudad["id"], "text" => $ciudad["nombre"]];
    // }

    // Filtrar las ciudades que coinciden con el término de búsqueda
    $filteredCiudades = array_filter($ciudadesSelect2, function ($ciudad) use ($term) {
        return stripos($ciudad["text"], $term) !== false;
    });
    

    // Devolver las ciudades filtradas en formato JSON
    echo json_encode(array_values($filteredCiudades));
}

    



    // $show = new AjaxCiudades();
    // $show -> ajaxMostrarCiudad();

    // // Verificamos si la variable "ciudad" está presente en $_POST
    // if (isset($_POST['ciudad'])) {
    //     // Obtenemos el valor de "ciudad"
    //     $ciudad = $_POST['ciudad'];

    //     // Puedes hacer lo que necesites con el valor de "ciudad" aquí
    //     // Por ejemplo, puedes procesar los datos, realizar consultas a la base de datos, etc.

    //     // Luego, puedes devolver una respuesta si es necesario
    //     $respuesta = array('status' => 'success', 'message' => 'Datos recibidos correctamente');
    //     echo json_encode($respuesta);
    // } else {
    //     // Si la variable "ciudad" no está presente en $_POST, devuelve un mensaje de error
    //     $respuesta = array('status' => 'error', 'message' => 'Datos incompletos');
    //     echo json_encode($respuesta);
    // }