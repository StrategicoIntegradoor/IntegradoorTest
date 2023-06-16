<?php

require_once "../../modelos/conexion.php";

$stmt = Conexion::conectar()->prepare("SELECT DISTINCT aseguradora FROM asistencias");

$stmt -> execute();

$opciones = "<option value=''>Elige una aseguradora</option>";

while ($row3 = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    if($row3['aseguradora'] == "Liberty Seguros"){

    }else{

        $opciones .= "<option value=" . $row3['aseguradora'] . ">" . $row3['aseguradora'] . "</option>";
    }
}

// SURA


echo $opciones;

?>