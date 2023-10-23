<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
// header('Content-Type: application/json; charset=utf-8');
mb_internal_encoding("UTF-8");

class AyudaVentasController 
{
       public static function ejecutarConsulta($sql){
		$mysqli = new mysqli("localhost", "grupoasi_cotizautos", "M1graci0n123", "grupoasi_cotizautos");
		$mysqli->set_charset("utf8");
        return $mysqli->query($sql);
	}


    //CONSULTA PARA LLENAR LA TABLA DE AYUDAVENTAS
    public static function obtenerAyudaVentas()
    {
        $consulta = "SELECT * FROM ayuda_ventas;";
        $resultado = AyudaVentasController::ejecutarConsulta($consulta);
        
        $array = array();
        while($row = $resultado->fetch_assoc()) {
            $array[] = $row;
        }

        print_r(json_encode($array));
    }

    public static function obtenerAyudaVenta($id)
    {
        $consulta = "SELECT * FROM ayuda_ventas WHERE id = $id;";
        $resultado = AyudaVentasController::ejecutarConsulta($consulta);
        $resultado = $resultado->fetch_assoc();
        print_r(json_encode($resultado));
    }

    public static function crearNombreArchivoSarlaft($idAyudaVenta, $aseguradora) {
        return $idAyudaVenta . '_' . $aseguradora . '_' . 'Sarlaft.pdf';
    }

    public static function crearNombreArchivoSarlaft2($idAyudaVenta, $aseguradora) {
        return $idAyudaVenta . '_' . $aseguradora . '_' . 'Sarlaft2.pdf';
    }

    public static function crearNombreArchivoClausulado($idAyudaVenta, $aseguradora) {
        return $idAyudaVenta . '_' . $aseguradora . '_' . 'Clausulado.pdf';
    }

    public static function editarAyudaVenta($post, $files) {
        $nombreArchivoClausulado = AyudaVentasController::crearNombreArchivoClausulado($post['id_ayuda_venta'], $post['aseguradora']);
        $nombreArchivoSarlaft = AyudaVentasController::crearNombreArchivoSarlaft($post['id_ayuda_venta'], $post['aseguradora']);
        $nombreArchivoSarlaft2 = AyudaVentasController::crearNombreArchivoSarlaft2($post['id_ayuda_venta'], $post['aseguradora']);
        // Editar datos
        $consulta = "UPDATE ayuda_ventas 
                SET linea_de_atencion = '" . $post['linea_de_atencion'] . "', 
                centro_de_inspeccion = '" . $post['centro_de_inspeccion'] . "', 
                continuidad = '" . $post['continuidad'] . "', 
                formas_de_pago = '" . $post['formas_de_pago'] . "', 
                tips_de_expedicion = '" . $post['tips_expedicion'] . "',
                link_clausulado = '" . $post['clausulado'] . "'
            WHERE id = " . $post['id_ayuda_venta'];
        $resultado = AyudaVentasController::ejecutarConsulta($consulta);
        if (count($files) > 0 && isset($files['sarlaft'])) {
            move_uploaded_file($files['sarlaft']['tmp_name'], 'pdf/sarlaft/' . $nombreArchivoSarlaft);
            $consulta = "UPDATE ayuda_ventas
            SET path_sarlaft = '" . $nombreArchivoSarlaft . "'
            WHERE id = " .$post['id_ayuda_venta'];
            $resultado = AyudaVentasController::ejecutarConsulta($consulta);
        }
        if (count($files) > 0 && isset($files['sarlaft2'])) {
            move_uploaded_file($files['sarlaft2']['tmp_name'], 'pdf/sarlaft2/' . $nombreArchivoSarlaft2);
            $consulta = "UPDATE ayuda_ventas
            SET path_sarlaft2 = '" . $nombreArchivoSarlaft2 . "'
            WHERE id = " .$post['id_ayuda_venta'];
            $resultado = AyudaVentasController::ejecutarConsulta($consulta);
        }
    }
    public static function editarSarlaftGeneric1( $files) {
        if (count($files) > 0 && isset($files['sarlaft'])) {

            $nombreArchivoSarlaft = "14_Sarlaft_Generico.pdf";
            move_uploaded_file($files['sarlaft']['tmp_name'], 'pdf/sarlaft/' . $nombreArchivoSarlaft);
        }
    }
    public static function editarSarlaftGeneric2( $files) {
        if (count($files) > 0 && isset($files['sarlaft'])) {

            $nombreArchivoSarlaft = "14_Sarlaft_Generico2.pdf";
            move_uploaded_file($files['sarlaft']['tmp_name'], 'pdf/sarlaft2/' . $nombreArchivoSarlaft);
        }
    }
}

$funcion = $_POST['funcion'];
if ($funcion == 'obtenerAyudaVentas') {
    AyudaVentasController::obtenerAyudaVentas();
}
if ($funcion == 'obtenerAyudaVenta') {
    $id = $_POST['id'];
    AyudaVentasController::obtenerAyudaVenta($id);
}
if ($funcion == 'editarAyudaVenta') {
    AyudaVentasController::editarAyudaVenta($_POST, $_FILES);
}
if ($funcion == 'editarSarlaftGeneric1') {
    AyudaVentasController::editarSarlaftGeneric1($_FILES);
}
if ($funcion == 'editarSarlaftGeneric2') {
    AyudaVentasController::editarSarlaftGeneric2($_FILES);
}



