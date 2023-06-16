<?php

    require_once "conexion.php";

    class ModeloAlertaAseguradora {
        static public function mdlObtenerAlertas($cotizacion) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM alertas_aseguradoras WHERE cotizacion = $cotizacion");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
