<?php

/* Conectar a la base de datos*/
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$placa = $_POST['placa'];
// $numIdentificacion = $_POST['numIdentificacion'];
$aseguradora = $_POST['aseguradora'];
$valorPrima = str_replace('.', '', $_POST['valorPrima']);
$producto = $_POST['producto'];
$valorRC = str_replace('.', '', $_POST['valorRC']);
$PT = $_POST['PT'];
$PP = $_POST['PP'];
$CE = $_POST['CE'];
$GR = $_POST['GR'];
$logo = "vistas/img/logos/".$_POST['logo'];
$UrlPdf = $_POST['UrlPdf'];
$id = $_POST['id'];

$sql = "UPDATE ofertas SET Placa = '$placa', Aseguradora = '$aseguradora', 
        Prima = '$valorPrima', Producto = '$producto', ValorRC = '$valorRC', 
        PerdidaTotal = '$PT', PerdidaParcial = '$PP', ConductorElegido = '$CE',
        Grua = '$GR', logo = '$logo', UrlPdf = '$UrlPdf' WHERE id_oferta = $id;";

$res = mysqli_query($con, $sql);

echo json_encode($res, JSON_UNESCAPED_UNICODE);
