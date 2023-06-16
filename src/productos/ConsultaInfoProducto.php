<?php
require_once "../../modelos/conexion.php";

$producto = $_POST['producto'];

$stmt = Conexion::conectar()->prepare("SELECT * FROM asistencias WHERE `id_asistencias` = ".$producto);

$stmt -> execute();


$res = $stmt -> fetch(PDO::FETCH_ASSOC);

print_r(json_encode($res));
