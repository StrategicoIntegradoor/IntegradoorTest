<?php
    
    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    require_once "../modelos/alerta_aseguradora.modelo.php";

    class AlertaAseguradora {
        
        public function obtenerAlertas($cotizacion) {
            $resultado = ModeloAlertaAseguradora::mdlObtenerAlertas($cotizacion);   
            if (!$resultado) { return false; }

            print_r(json_encode($resultado));
        }
    }

    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['obtenerAlertas'])) {
        $alertaAseguradora = new AlertaAseguradora();
        $alertaAseguradora->obtenerAlertas($data['cotizacion']);
    }
?>