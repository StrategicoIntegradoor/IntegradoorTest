<?php

$file = $_FILES['documento'];

$ruta = '../../vistas/recursos/cot-masivas/'.$file['name'];

$res = move_uploaded_file($file['tmp_name'], $ruta);

$header = NULL;
$data = array();

// obtenemos el archivo scv para poder leerlo
$handle = fopen($ruta, 'r');

//ignoramos la primera fila y leemos las siguientes 
while ($row = fgetcsv($handle, 1000, ';')) {
    if (!$header) { $header = $row; }
    else { $data[] = array_combine($header, $row); }
}

$cantPlacas = COUNT($data);

if($cantPlacas >= 50){
    echo "error cantidad";

    die();
}

fclose($handle);

foreach ($data as $key => $value) {

     echo $value['placa'];
    $value['esCeroKm'];
    $value['tipoDocumentoID'];
    $value['numDocumentoID'];
    $value['Nombre'];
    $value['Apellido1'];
    $value['Genero'];
    $value['FechaNacimiento'];
    $value['estadoCivil'];
    $value['celularAseg'];
    $value['direccionAseg'];
    $value['emailAseg'];
    $value['DptoCirculacion'];
    $value['CodigoMarca'];
    $value['CodigoLinea'];
    $value['CodigoClase'];
    $value['fasecoldaVeh'];
    $value['modeloVeh'];
    $value['valorFasecolda'];
    $value['LimiteRC'];
    $value['CoberturaEstado'];
    $value['ValorAccesorios'];
    $value['ciudadCirculacion'];
    $value['tipoServicio'];
    $value['CodigoVerificacion'];
    $value['Apellido2'];
    $value['AniosSiniestro'];
    $value['AniosAsegurados'];
    $value['NivelEducativo'];
    $value['Estrato'];
    $value['intermediario']; 

    

}

unlink($ruta);   

?>