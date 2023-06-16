<?php

    if (!isset($_FILES['archivo'])) return;

    $archivo = $_FILES['archivo'];
    $nombreArchivo = obtenerNombreArchivo($_POST['urlPdf']);
    $res = move_uploaded_file($archivo['tmp_name'], '../reportes/cotizaciones_manuales/' . $nombreArchivo);

    function obtenerNombreArchivo($ruta) {
        return explode('/', $ruta)[2];
    }
    