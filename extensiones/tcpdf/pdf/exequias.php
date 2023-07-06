<?php
session_start();
date_default_timezone_set('America/Bogota');

// Incluye la biblioteca TCPDF principal (busca la ruta de instalación).
require_once('tcpdf_include.php');

$tipoPlan = $_GET['tipoPlan'];
if($tipoPlan == 1){

$imagen = '../../../vistas/img/logos/9.png';
$nombreUsuario = 'Usuario';
$identificador = $_GET['cotizacion'];

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

// Agregar una página al PDF
$pdf->AddPage();

// Cargar la imagen y obtener sus dimensiones
$imagenData = getimagesize($imagen);
$ancho = $imagenData[0];
$alto = $imagenData[1];

// Agregar la imagen al PDF
$pdf->Image($imagen, 5, 10, $ancho, $alto, '', '', '', false, 300, '', false, false, 0);

$pdf->SetFontSize(10);
$pdf->SetXY(28, 27);
$pdf->Cell(25, 6, $identificador, 0, 1, '');


$imagen1 = '../../../vistas/img/logos/10.png';

$pdf->AddPage();

$imagenData1 = getimagesize($imagen1);
$ancho1 = $imagenData1[0];
$alto1 = $imagenData1[1];

$pdf->Image($imagen1, 5, 10, $ancho1, $alto1, '', '', '', false, 300, '', false, false, 0);

// Guardar el PDF en un archivo y descargarlo

$pdf->Output('cotizacionPlanExequialPersonal'.$identificador.'.pdf', 'D');
// $pdf->Output(__DIR__ . '/ensayos 9.pdf', 'D');
exit; // Asegúrate de finalizar la ejecución del script después de enviar el PDF

}else if($tipoPlan == 2){

$imagen = '../../../vistas/img/logos/11.png';
$nombreUsuario = 'Usuario';
$identificador = $_GET['cotizacion'];

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

// Agregar una página al PDF
$pdf->AddPage();

// Cargar la imagen y obtener sus dimensiones
$imagenData = getimagesize($imagen);
$ancho = $imagenData[0];
$alto = $imagenData[1];

// Agregar la imagen al PDF
$pdf->Image($imagen, 5, 10, $ancho, $alto, '', '', '', false, 300, '', false, false, 0);

$pdf->SetFontSize(10);
$pdf->SetXY(28, 27);
$pdf->Cell(25, 6, $identificador, 0, 1, '');


$imagen1 = '../../../vistas/img/logos/10.png';

$pdf->AddPage();

$imagenData1 = getimagesize($imagen1);
$ancho1 = $imagenData1[0];
$alto1 = $imagenData1[1];

$pdf->Image($imagen1, 5, 10, $ancho1, $alto1, '', '', '', false, 300, '', false, false, 0);

// Guardar el PDF en un archivo y descargarlo
$pdf->Output(__DIR__ . '/ensayos 9.pdf', 'D');
exit; // Asegúrate de finalizar la ejecución del script después de enviar el PDF

}
?>
