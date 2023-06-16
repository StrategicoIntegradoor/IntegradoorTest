<?php

/* Conectar a la base de datos*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$id = $_POST['id'];

$sql = "SELECT * FROM ofertas WHERE id_oferta = $id;";
$res = mysqli_query($con, $sql);
$data = $res->fetch_assoc();

echo json_encode($data, JSON_UNESCAPED_UNICODE);
