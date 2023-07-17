<?php
session_start();
date_default_timezone_set('America/Bogota');

// Incluye la biblioteca TCPDF principal (busca la ruta de instalación).
require_once('tcpdf_include.php');

$tipoPlan = $_GET['tipoPlan'];
if($tipoPlan == 'Plan Muy Personal'){

$imagen = '../../../vistas/img/logos/9.png';
$identificador = $_GET['txtNombre'];
$cotizacion = $_GET['cotizacion'];

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

// Agregar una página al PDF
$pdf->AddPage();

// Cargar la imagen y obtener sus dimensiones
$imagenData = getimagesize($imagen);
$ancho = $imagenData[0];
$alto = $imagenData[1];

// Agregar la imagen al PDF
$pdf->Image($imagen, 0, 0, $ancho, $alto, '', '', '', false, 300, '', false, false, 0);

$pdf->SetFontSize(12);

$pageWidth = $pdf->GetPageWidth();
$mensajeWidth = $pdf->GetStringWidth(' # '.$cotizacion);


$x = $pageWidth - $mensajeWidth - 33;


$pdf->SetXY(10.5, 0);
$pdf->Cell(0, 40.5, 'Hola '.$identificador.'!', 0, 1, '');

$pdf->SetFontSize(8); // Reducir el tamaño de la letra a 10
$pdf->SetTextColor(0, 128, 0); 
$pdf->SetXY($x, 0); // Establecer la posición X nuevamente
$pdf->Cell(0, 35, 'Cotizacion # '.$cotizacion, 0, 1, '');

$imagen1 = '../../../vistas/img/logos/10.png';

$pdf->AddPage();

$imagenData1 = getimagesize($imagen1);
$ancho1 = $imagenData1[0];
$alto1 = $imagenData1[1];

$pdf->Image($imagen1, 5, 0, $ancho1, $alto1, '', '', '', false, 300, '', false, false, 0);

$pdf->SetFontSize(10);
$pdf->SetXY(14, $pdf->getPageHeight() - 40);

// Establecer color azul solo para el enlace
$pdf->SetTextColor(0, 0, 0);
$pdf->Write(0, 'Paga fácil a través de corresponsales bancarios, Efecty, Baloto, Gane o PSE en: ');

// Restablecer el color predeterminado para el texto restante
$pdf->SetTextColor(0, 0, 255);

$pdf->SetFont('helvetica', '', 10);
$pdf->SetXY(141, $pdf->GetY());
$pdf->Write(0, 'https://cali.losolivos.co/pagos-pse/');


$pdf->Output('Plan_Exequial_Personal_'.$identificador.'.pdf', 'I');
// $pdf->Output(__DIR__ . '/ensayos 9.pdf', 'D');
exit; // Asegúrate de finalizar la ejecución del script después de enviar el PDF

// SEGUNDA HOJA
}else if($tipoPlan == 'Plan Nuestra Familia'){

$identificador = $_GET['txtNombre'];
$imagen = '../../../vistas/img/logos/11.png';
$cotizacion = $_GET['cotizacion'];

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

// Agregar una página al PDF
$pdf->AddPage();

// Cargar la imagen y obtener sus dimensiones
$imagenData = getimagesize($imagen);
$ancho = $imagenData[0];
$alto = $imagenData[1];

// Agregar la imagen al PDF
$pdf->Image($imagen, 0, 0, $ancho, $alto, '', '', '', false, 300, '', false, false, 0);

$pdf->SetFontSize(12);

$pageWidth = $pdf->GetPageWidth();
$mensajeWidth = $pdf->GetStringWidth('# '.$cotizacion);


$x = $pageWidth - $mensajeWidth - 33;


$pdf->SetXY(10.5, 0);
$pdf->Cell(0, 40.5, 'Hola '.$identificador.'!', 0, 1, '');

$pdf->SetFontSize(8); // Reducir el tamaño de la letra a 10
$pdf->SetTextColor(0, 128, 0); 
$pdf->SetXY($x, 0); // Establecer la posición X nuevamente
$pdf->Cell(0, 35, 'Cotizacion # '.$cotizacion, 0, 1, '');

$imagen1 = '../../../vistas/img/logos/10.png';

$pdf->AddPage();

$imagenData1 = getimagesize($imagen1);
$ancho1 = $imagenData1[0];
$alto1 = $imagenData1[1];

$pdf->Image($imagen1, 5, 0, $ancho1, $alto1, '', '', '', false, 300, '', false, false, 0);

$pdf->SetFontSize(10);
$pdf->SetXY(14, $pdf->getPageHeight() - 40);

// Establecer color azul solo para el enlace
$pdf->SetTextColor(0, 0, 0);
$pdf->Write(0, 'Paga fácil a través de corresponsales bancarios, Efecty, Baloto, Gane o PSE en: ');

// Restablecer el color predeterminado para el texto restante
$pdf->SetTextColor(0, 0, 255);

$pdf->SetFont('helvetica', '', 10);
$pdf->SetXY(141, $pdf->GetY());
$pdf->Write(0, 'https://cali.losolivos.co/pagos-pse/');


$pdf->Output('Plan_Exequial_Familia_'.$identificador.'.pdf', 'I');
// $pdf->Output(__DIR__ . '/ensayos 9.pdf', 'D');
exit; // Asegúrate de finalizar la ejecución del script después de enviar el PDF

}
?>
