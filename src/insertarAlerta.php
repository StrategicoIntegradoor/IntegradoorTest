<?php

require_once("../config/db.php");
require_once("../config/conexion.php");

$aseguradora = $_POST['aseguradora'];
$cantidadOfertas = $_POST['cantidadOfertas'];
$cotizacion = $_POST['cotizacion'];
$exito = $_POST['exito'];
$mensaje = $_POST['mensaje'];




if($aseguradora == "Previsora Seguros"){
    $aseguradora = "Previsora";
}elseif($aseguradora == "Seguros del Estado"){
    $aseguradora = "Estado";
}elseif($aseguradora == "Estado2"){
    $aseguradora = "Estado";
}elseif($aseguradora == "SBS Seguros"){
    $aseguradora = "SBS";
}elseif($aseguradora == "Seguros Bolivar"){
    $aseguradora = "Bolivar";
}elseif($aseguradora == "Axa Coplatria"){
    $aseguradora = "AXA";
}elseif($aseguradora == "HDI Seguros"){
    $aseguradora = "HDI";
}

// var_dump($aseguradora);
// var_dump($cantidadOfertas);
// var_dump($cotizacion);
// die();

// Verificar si ya existe una fila para la aseguradora
$sqlSelect = "SELECT * FROM `alertas_aseguradoras` WHERE `aseguradora` = '$aseguradora' AND `cotizacion` = '$cotizacion'";
$resultSelect = mysqli_query($con, $sqlSelect);

if ($resultSelect) {
    // if (mysqli_num_rows($resultSelect) > 0) {
    //     // La fila ya existe, puedes manejarlo según tus necesidades
    //     echo "La fila ya existe para la aseguradora: $aseguradora";
    // } else {
        // La fila no existe, realizar el INSERT
        $sqlInsert = "INSERT INTO `alertas_aseguradoras` (`cotizacion`, `aseguradora`, `mensaje`, `exitosa`, `ofertas_cotizadas`) VALUES ('$cotizacion', '$aseguradora', '$mensaje', '$exito', '$cantidadOfertas')";
        $resultInsert = mysqli_query($con, $sqlInsert);

        if ($resultInsert) {
            $data['Success'] = $resultInsert;
            $data['Message'] = 'La inserción fue exitosa';
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            $data['Success'] = $resultInsert;
            $data['Message'] = 'Error: ' . mysqli_error($con);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    // }
} else {
    echo "Error en la consulta: " . mysqli_error($con);
}

mysqli_close($con);
?>
