<?php

require_once "../../modelos/conexion.php";

$aseguradora = $_POST['Aseguradora'];

$stmt = Conexion::conectar()->prepare("SELECT id_asistencias, producto FROM asistencias WHERE `aseguradora` LIKE '%".$aseguradora."%'");

$stmt -> execute();

// $res =  $stmt -> fetch(PDO::FETCH_ASSOC);

$selectProductos = "<option value=''>Elige un producto</option>";


while ($row3 = $stmt -> fetch(PDO::FETCH_ASSOC)) {

    $selectProductos .= "<option value=" . $row3['id_asistencias'] . ">" . $row3['producto'] . "</option>";
}

echo $selectProductos;
?>