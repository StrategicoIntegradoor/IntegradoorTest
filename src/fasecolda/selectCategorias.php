<?php

require_once("../../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$consulta = mysqli_query($con, 'SELECT categoria FROM clasificacion ORDER BY categoria ASC');
$selectCategorias = "";
$selectCategorias .= "<option value=''>Seleccione la Clase</option>";
while ($row = mysqli_fetch_assoc($consulta)) {
    $selectCategorias .= "<option value=" . $row['categoria'] . ">" . $row['categoria'] . "</option>";
}

echo $selectCategorias;
