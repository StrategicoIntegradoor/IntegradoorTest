<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Bogota');

// Incluye la biblioteca TCPDF principal (busca la ruta de instalación).
require_once('tcpdf_include.php');


//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,array(150,  255), true, 'UTF-8', false);
$pdf = new TCPDF (PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
// $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$identificador = $_GET['cotizacion'];

$server = "localhost";
$user = "root";
$password = ""; //poner tu propia contraseña, si tienes una.
$bd = "grupoasi_cotizautos";

$conexion = mysqli_connect($server, $user, $password, $bd);
if (!$conexion) {
	die('Error de Conexión: ' . mysqli_connect_errno());
}
$conexion->set_charset("utf8");


$query2 = "SELECT *	FROM cotizaciones, clientes WHERE cotizaciones.id_cliente = clientes.id_cliente AND `id_cotizacion` = $identificador";
$valor2 = $conexion->query($query2);
$fila = mysqli_fetch_array($valor2);

// :::::::::::::::::::::::Query para imagen logo::::::::::::::::::::::::::.
$intermediario = $_SESSION['intermediario'];
$queryLogo = "SELECT urlLogo FROM intermediario  WHERE id_Intermediario = $intermediario";
$valorLogo = $conexion->query($queryLogo);
$valorLogo = mysqli_fetch_array($valorLogo);
$valorLogo = $valorLogo['urlLogo'];



$query3 = "SELECT DISTINCT Aseguradora FROM ofertas WHERE `id_cotizacion` = $identificador";
$valor3 = $conexion->query($query3);
$fila2 = mysqli_num_rows($valor3);

// Consulta las aseguradoras que fueron selecionadas para visualizar en el PDF
$queryAsegSelec = "SELECT DISTINCT Aseguradora FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$valorAsegSelec = $conexion->query($queryAsegSelec);
$asegSelecionada = mysqli_num_rows($valorAsegSelec);

// Consultar cuantas Ofertas fueron selecionadas para visualizarlas en el PDF
// $queryPDF = "SELECT pdf FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
// $valorPDF = $conexion->query($queryPDF);
// $ofertasPDF = mysqli_num_rows($valorPDF);


$fechaCotiz = substr($fila['cot_fch_cotizacion'], 0, -9);
$fechaVigencia = date("d-m-Y", strtotime($fechaCotiz));

$placa = $fila["cot_placa"];
$modelo = $fila["cot_modelo"];
$marca = $fila["cot_marca"];
$linea = $fila["cot_linea"];
$fasecolda = $fila["cot_fasecolda"];
$valorA = number_format($fila["cot_valor_asegurado"], 0, '.', '.');
$clase = claseV($fila["cot_clase"]);
$servicio = servise($fila["cot_tip_servicio"]);
$departamento = DptoVehiculo($fila["cot_departamento"]);
$codCiudad = $fila["cot_ciudad"];

// Consulta la Ciudad a partir del codigo
$respNomCiudad = $conexion->query("SELECT `Nombre` FROM `ciudadesbolivar` WHERE `Codigo` = $codCiudad");
$nomCiudad = $respNomCiudad->fetch_assoc();
$explodeCiudad = explode('-', $nomCiudad["Nombre"]);
$ciudad = $explodeCiudad[0];

$rest = substr($placa, 0, 3);
$rest2 = substr($placa, -3);

$identificacion = $fila["cli_num_documento"];
$nombre = $fila["cli_nombre"];
$apellido = $fila["cli_apellidos"];
$edad = calculaedad($fila["cli_fch_nacimiento"]);
$genero = $fila["cli_genero"];

if ($genero == 1) {
	$nomGenero = "Masculino";
} else if ($genero == 2) {
	$nomGenero = "Femenino";
}

$idUsuario = $fila["id_usuario"];
$respAsesor = $conexion->query("SELECT usu_nombre, usu_apellido, usu_telefono, usu_email FROM usuarios WHERE id_usuario = $idUsuario");
$asesor = $respAsesor->fetch_assoc();

$nomAsesor = $asesor["usu_nombre"] . ' ' . $asesor["usu_apellido"];
$telAsesor = $asesor["usu_telefono"];
$emailAsesor = $asesor["usu_email"];

// $fecha = $fila["f_registro"];
// $newDate = date("d/m/Y", strtotime($fecha));
// $real = "";

// if ($consecutivo >= 0 && $consecutivo <= 9) {
// 	$real = "MJN715" . $consecutivo;
// } else if ($consecutivo >= 10 && $consecutivo <= 99) {
// 	$real = "0000" . $consecutivo;
// } else if ($consecutivo >= 100 && $consecutivo <= 999) {
// 	$real = "000" . $consecutivo;
// } else if ($consecutivo >= 1000 && $consecutivo <= 9999) {
// 	$real = "00" . $consecutivo;
// }

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Seguros Grupo Asistencia');
$pdf->SetTitle('Parrilla de Cotizaciones');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(12, 12, 12, 12);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(12);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.

$pdf->SetFont('dejavusanscondensed', '', 11);

// Add a page
// This method has several options, check the source code documentation for more information.


$pdf->AddPage();

//$pdf->Image('../../../vistas/img/logos/imagencotizador.jpg', -5, 0, 0, 92, 'JPG', '', '', true, 160, '', false, false, 0, false, false, false);
//$pdf->Image('../../../vistas/img/logos/cheque.png', 99.5, 159.5, 0, 0, 'PNG', '', '', true, 160, '', false, false, 0, false, false, false);

$pdf->Image('../../../vistas/img/logos/imagencotizador2.jpg', -5, 0, 0, 92, 'JPG', '', '', true, 200, '', false, false, 0, false, false, false);


// :::::::::::::::.prueba:::::::::::::::

$pdf->Image('../../../vistas/img/logosIntermediario/'.$valorLogo, 8, 13, 0, 20, 'PNG', '', '', true, 160, '', false, false, 0, false, false, false);


// ================================================


$pdf->Image('../../../vistas/img/logos/cheque.png', 80.5, 150.5, 0, -12, 'PNG', '', '', true, 160, '', false, false, 0, false, false, false);

//$pdf->Image('images/img/QUIMERA_BONO_FINAL3.jpg', 0, 130, 0, 117, 'JPG', '', '', false, 140, '', false, false, 0, false, false, false);

$pdf->SetFont('dejavusanscondensed', '', 2);

$pdf->SetFont('dejavusanscondensed', 'B', 9);
$pdf->SetXY(171, 3);
$pdf->SetTextColor(104, 104, 104);
$pdf->Cell(25, 6, "Cotización #". $identificador ."", 0, 1, '');




$pdf->SetFont('dejavusanscondensed', 'B', 12);
$pdf->SetXY(98, 19.2);
$pdf->SetTextColor(235, 135, 39);
$pdf->Cell(25, 6, "  " . strtoupper($rest) . "" . strtoupper($rest2), 0, 1, '');


$pdf->SetFont('dejavusanscondensed', '', 7);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(18, 53);
$pdf->Cell(35, 6, $modelo, 0, 1, '');

$pdf->SetXY(155, 24);
$pdf->Cell(25, 6, strtoupper($nombre) . " " . strtoupper($apellido), 0, 1, '');

$pdf->SetXY(166, 31.5);
$pdf->Cell(25, 6, $identificacion, 0, 1, '');

$pdf->SetXY(138, 39.2);
$pdf->Cell(25, 6, $edad . " Años", 0, 1, '');

$pdf->SetXY(169.5, 39.2);
$pdf->Cell(25, 6, $nomGenero, 0, 1, '');

$pdf->SetXY(38, 53);
$pdf->Cell(35, 6, $marca . " " . $linea, 0, 1, '');

$pdf->SetXY(16, 63);
$pdf->Cell(25, 6, $clase, 0, 1, '');

$pdf->SetXY(44, 63);
$pdf->Cell(25, 6, $servicio, 0, 1, '');

$pdf->SetXY(72, 63);
$pdf->Cell(25, 6, $fasecolda, 0, 1, '');

$pdf->SetXY(16, 73);
$pdf->Cell(25, 6, "$ " . $valorA, 0, 1, '');

$pdf->SetXY(69, 73);
$pdf->Cell(25, 6, strtoupper($departamento), 0, 1, '');

$pdf->SetXY(39, 73);
$pdf->Cell(25, 6, $ciudad, 0, 1, '');

$pdf->SetXY(35, 79);
$pdf->Cell(25, 6, "8 DIAS A PARTIR DEL " . $fechaVigencia, 0, 1, '');

$pdf->SetXY(155, 56);
$pdf->Cell(25, 6, strtoupper($nomAsesor), 0, 1, '');

$pdf->SetXY(153, 64.1);
$pdf->Cell(25, 6, strtoupper($emailAsesor), 0, 1, '');

$pdf->SetXY(155, 72);
$pdf->Cell(25, 6, strtoupper($telAsesor), 0, 1, '');

$pdf->SetXY(155, 75);
$pdf->Cell(25, 6, strtoupper('Test'), 0, 1, '');

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('dejavusanscondensed', 'BI', 15);
//$pdf->Cell(180, 0, 'Hemos cotizado ' . $asegSelecionada . ' aseguradoras, a continuación', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(180, 0, 'te presentamos un comparativo de precios', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(46.5, 93);
$pdf->Cell(10, 0, 'Hemos ', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'BI', 15);
$pdf->SetTextColor(103, 181, 252);
$pdf->SetXY(90.5, 93);
$pdf->Cell(10, 0, 'cotizado ' . $asegSelecionada . ' aseguradoras,', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');




$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(145.5, 93);
$pdf->Cell(10, 0, 'a continuación ', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(98, 101);
$pdf->Cell(10, 0, 'te presentamos un comparativo de precios', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'B', 9);
$pdf -> StartTransform();
$pdf->SetXY(203, 250);
$pdf -> Rotate(90);
$pdf -> setAlpha(0.5);
$pdf->SetTextColor(104, 104, 104);
$pdf->Cell(25, 6, "Elaborado por Software Integradoor propiedad del proveedor tecnológico Strategico Technologies SAS BIC Nit: 901.542.216-8", 0, 1, '');
$pdf->StopTransform();




// ::::::::::::::::::::::::::::prueba:::::::::::::::::::::::::



// ::::::::::::::::::::::::::::prueba:::::::::::::::::::::::::





$pdf->SetAlpha(0.7);

$pdf->SetFont('dejavusanscondensed', '', 8);

$pdf->SetAlpha(1.0);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(0, 107);

$html2 = '
<style>
.td2 {
	text-align: center;
	
  }

  .fondo {
    background-color:#EBEBEB;
}

.fondo3 {
    background-color:#F8F8F8;
}

  .puntos {
    border-bottom:1px solid grey;
}

.second2 {
	padding-left: 105px;
}

</style>

<div class="second2">
<table class="second" cellpadding="2"  border="0">';

$query4 = "SELECT Aseguradora, Prima FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery4 =  $conexion->query($query4);
$html2 .= '<tr>';

$cont = 1;

while ($rowRespuesta4 = mysqli_fetch_assoc($respuestaquery4)) {

	if ($cont % 2 == 0) {

		if ($rowRespuesta4['Aseguradora'] == 'Axa Colpatria') {
			$html2 .= '<td class="puntos td2 fondo2"><center>
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/axa.png" alt=""></center>
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros del Estado') {
			$html2 .= '<td class="puntos td2 fondo2" >
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'HDI Seguros') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'SBS Seguros') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sbs.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros Bolivar') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/bolivar.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros Sura') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sura.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Zurich Seguros') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/zurich.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Allianz Seguros') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Allianz') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Liberty Seguros') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Liberty') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros Mapfre') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mapfre.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Equidad Seguros') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/equidad.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Previsora Seguros') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Previsora') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Aseguradora Solidaria') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Solidaria') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		}
	} else {
		if ($rowRespuesta4['Aseguradora'] == 'Axa Colpatria') {
			$html2 .= '<td class="puntos td2 fondo"><center>
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/axa.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</center></td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros del Estado') {
			$html2 .= '<td class="puntos td2 fondo" >
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'HDI Seguros') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'SBS Seguros') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sbs.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros Bolivar') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/bolivar.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros Sura') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sura.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Zurich Seguros') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/zurich.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Allianz Seguros') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Allianz') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Liberty Seguros') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Liberty') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros Mapfre') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mapfre.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Equidad Seguros') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/equidad.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Previsora Seguros') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Previsora') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Aseguradora Solidaria') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Solidaria') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		}
	}



	$cont += 1;
}
$html2 .= '</tr>';
$query5 = "SELECT Aseguradora, Prima FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";

$pdf->SetFont('dejavusanscondensed', '', 12);
$respuestaquery5 =  $conexion->query($query5);
$valor = mysqli_num_rows($respuestaquery5);
if ($valor == 10) {
	$html2 .= '<tr>';
	$cont2 = 1;
	while ($rowRespuesta5 = mysqli_fetch_assoc($respuestaquery5)) {
		if ($cont2 % 2 == 0) {
			$html2 .= '<td style="height: 35px; font-size:8px; color:#666666; font-family:dejavusanscondensedb;" class="td2 fondo2">
			<div style="font-size:7pt">&nbsp;</div>
			$' . number_format($rowRespuesta5['Prima'], 0, ',', '.') . '
			<div style="font-size:7pt">&nbsp;</div>
			</td>';
		} else {
			$html2 .= '<td style="height: 35px; font-size:8px; color:#666666; font-family:dejavusanscondensedb;" class="td2 fondo">
			<div style="font-size:7pt">&nbsp;</div>
			$' . number_format($rowRespuesta5['Prima'], 0, ',', '.') . '
			<div style="font-size:7pt">&nbsp;</div>
			</td>';
		}

		//$selectCategorias .= "<tr><td>" . $rowbrilla['tip_rec_cod'] . "</td><td>" . $rowbrilla['rec_id'] . "</td><td>" . $rowbrilla['rec_fech'] . "</td><td>" .  $rowbrilla['cli_nom1'] . " " .  $rowbrilla['cli_nom2'] . " " .  $rowbrilla['cli_ape1'] . " " .  $rowbrilla['cli_ape2'] . " " . "</td><td>" . $rowbrilla['rec_concepto_detalle'] . "</td><td>" ." ". "</td><td>" . " " . "</td><td>" ." ". "</td><td>" ." ". "</td><td>" . $rowbrilla['rec_valor_rec'] . "</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
		//$selectCategorias .= "<option value=" . $row['id_ban'] . ">" . $row['banc_des'] . "</option>";

		$cont2 += 1;
	}
} else if ($valor > 10) {
	$html2 .= '<tr>';
	$cont2 = 1;
	while ($rowRespuesta5 = mysqli_fetch_assoc($respuestaquery5)) {
		if ($cont2 % 2 == 0) {
			$html2 .= '<td style="height: 35px; font-size:7px; color:#666666; font-family:dejavusanscondensedb;" class="td2 fondo2">
			<div style="font-size:7pt">&nbsp;</div>
			$' . number_format($rowRespuesta5['Prima'], 0, ',', '.') . '
			<div style="font-size:7pt">&nbsp;</div>
			</td>';
		} else {
			$html2 .= '<td style="height: 35px; font-size:7px; color:#666666; font-family:dejavusanscondensedb;" class="td2 fondo">
			<div style="font-size:7pt">&nbsp;</div>
			$' . number_format($rowRespuesta5['Prima'], 0, ',', '.') . '
			<div style="font-size:7pt">&nbsp;</div>
			</td>';
		}

		//$selectCategorias .= "<tr><td>" . $rowbrilla['tip_rec_cod'] . "</td><td>" . $rowbrilla['rec_id'] . "</td><td>" . $rowbrilla['rec_fech'] . "</td><td>" .  $rowbrilla['cli_nom1'] . " " .  $rowbrilla['cli_nom2'] . " " .  $rowbrilla['cli_ape1'] . " " .  $rowbrilla['cli_ape2'] . " " . "</td><td>" . $rowbrilla['rec_concepto_detalle'] . "</td><td>" ." ". "</td><td>" . " " . "</td><td>" ." ". "</td><td>" ." ". "</td><td>" . $rowbrilla['rec_valor_rec'] . "</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
		//$selectCategorias .= "<option value=" . $row['id_ban'] . ">" . $row['banc_des'] . "</option>";

		$cont2 += 1;
	}
} else {

	$html2 .= '<tr>';
	$cont2 = 1;
	while ($rowRespuesta5 = mysqli_fetch_assoc($respuestaquery5)) {
		if ($cont2 % 2 == 0) {
			$html2 .= '<td style="height: 35px; font-size:9px; color:#666666; font-family:dejavusanscondensedb;" class="td2 fondo2">
			<div style="font-size:7pt">&nbsp;</div>
			$' . number_format($rowRespuesta5['Prima'], 0, ',', '.') . '
			<div style="font-size:7pt">&nbsp;</div>
			</td>';
		} else {
			$html2 .= '<td style="height: 35px; font-size:9px; color:#666666; font-family:dejavusanscondensedb;" class="td2 fondo">
			<div style="font-size:7pt">&nbsp;</div>
			$' . number_format($rowRespuesta5['Prima'], 0, ',', '.') . '
			<div style="font-size:7pt">&nbsp;</div>
			</td>';
		}

		//$selectCategorias .= "<tr><td>" . $rowbrilla['tip_rec_cod'] . "</td><td>" . $rowbrilla['rec_id'] . "</td><td>" . $rowbrilla['rec_fech'] . "</td><td>" .  $rowbrilla['cli_nom1'] . " " .  $rowbrilla['cli_nom2'] . " " .  $rowbrilla['cli_ape1'] . " " .  $rowbrilla['cli_ape2'] . " " . "</td><td>" . $rowbrilla['rec_concepto_detalle'] . "</td><td>" ." ". "</td><td>" . " " . "</td><td>" ." ". "</td><td>" ." ". "</td><td>" . $rowbrilla['rec_valor_rec'] . "</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
		//$selectCategorias .= "<option value=" . $row['id_ban'] . ">" . $row['banc_des'] . "</option>";

		$cont2 += 1;
	}
}
$html2 .= '</tr>';

$html2 .= '</table></div>';

$html3 = '
<style>
  .puntos {
    border-bottom:1px solid grey;
}

.second2 {
	width:100%;
}

.izquierda{
	text-align: left;
}

.fondo {
    background-color:#EBEBEB;
}

.fondo2 {
	background-color:#FFFFFF;
}

.fondo3 {
    background-color:#FFFFFF;
}





</style>
  
<table style="width: 100%;" class="second2" cellpadding="2"  border="0">';

$pdf->SetFont('dejavusanscondensed', '', 8);

$query6 = "SELECT Aseguradora FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$valor6 = $conexion->query($query6);
$fila6 = mysqli_num_rows($valor6);
$html3 .= '<tr style="width: 100%;" class="izquierda">';
$html3 .= '<td style ="width: 100%;  background-color: #D1D1D1; font-family:dejavusanscondensedb;" colspan="' . ($fila6 + 1) . '">
<div style="font-size:3pt">&nbsp;</div>
   RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
   <div style="font-size:3pt">&nbsp;</div>
</td>';
$html3 .= '</tr>';

$query7 = "SELECT Aseguradora, Prima FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery7 =  $conexion->query($query7);

$html3 .= '<tr class="trborder">';
$valorTabla = (90 / $fila6);
$html3 .= '<td class="puntos fondo" style="width:10%;"></td>';

$cont3 = 1;

while ($rowRespuesta7 = mysqli_fetch_assoc($respuestaquery7)) {

	if ($cont3 % 2 == 0) {
		if ($rowRespuesta7['Aseguradora'] == 'Axa Colpatria') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><center>
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/axa.png" alt=""></center>
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros del Estado') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'HDI Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'SBS Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sbs.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Bolivar') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/bolivar.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Sura') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sura.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Zurich Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/zurich.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Allianz Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Allianz') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Liberty Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Liberty') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Mapfre') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mapfre.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Equidad Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/equidad.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Previsora Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Previsora') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Aseguradora Solidaria') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Solidaria') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		}
	} else {
		if ($rowRespuesta7['Aseguradora'] == 'Axa Colpatria') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><center>
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/axa.png" alt=""></center></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros del Estado') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'HDI Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'SBS Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sbs.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Bolivar') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/bolivar.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Sura') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sura.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Zurich Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/zurich.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Allianz Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Allianz') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Liberty Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Liberty') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Mapfre') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mapfre.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Equidad Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/equidad.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Previsora Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Previsora') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Aseguradora Solidaria') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Solidaria') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt=""></td>';
		}
	}

	$cont3 += 1;
}
$html3 .= '</tr>';
$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Límite máximo </font><font size="7"> (En millones)</font></td>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA LIMITE MAXIMO
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$cont4 = 1;
$query9 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery9 =  $conexion->query($query9);

$valorlimiterow = mysqli_num_rows($respuestaquery9);

if ($valorlimiterow == 10) {
	while ($rowRespuesta9 = mysqli_fetch_assoc($respuestaquery9)) {

		if ($cont4 % 2 == 0) {

			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="6" style="text-align: center;"><div style="font-size:4pt">&nbsp;</div>' . $rowRespuesta9['ValorRC'] . '</font></center></td>';
		} else {

			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="6" style="text-align: center;"><div style="font-size:4pt">&nbsp;</div>' . $rowRespuesta9['ValorRC'] . '</font></center></td>';
		}

		$cont4 += 1;
	}
} else if ($valorlimiterow > 10) {
	while ($rowRespuesta9 = mysqli_fetch_assoc($respuestaquery9)) {

		if ($cont4 % 2 == 0) {

			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="5" style="text-align: center;"><div style="font-size:4pt">&nbsp;</div>' . $rowRespuesta9['ValorRC'] . '</font></center></td>';
		} else {

			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="5" style="text-align: center;"><div style="font-size:4pt">&nbsp;</div>' . $rowRespuesta9['ValorRC'] . '</font></center></td>';
		}

		$cont4 += 1;
	}
} else {
	while ($rowRespuesta9 = mysqli_fetch_assoc($respuestaquery9)) {

		if ($cont4 % 2 == 0) {

			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="7" style="text-align: center;"><div style="font-size:4pt">&nbsp;</div>' . $rowRespuesta9['ValorRC'] . '</font></center></td>';
		} else {

			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="7" style="text-align: center;"><div style="font-size:4pt">&nbsp;</div>' . $rowRespuesta9['ValorRC'] . '</font></center></td>';
		}

		$cont4 += 1;
	}
}



$html3 .= '</tr>';


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA DE DEDUCIBLES
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Deducible</font></td>';


$query8 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";

$respuestaquery8 =  $conexion->query($query8);

$cont5 = 1;

while ($rowRespuesta8 = mysqli_fetch_assoc($respuestaquery8)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta8['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta8['Aseguradora'], $rowRespuesta8['Producto']);
	$valorRC = $rowRespuesta8['ValorRC'];
	$perdidaParcial = $rowRespuesta8['PerdidaParcial'];

	$queryConsultaAsistencia1 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto' 
									AND `rce` LIKE '$valorRC'";
	$respuestaqueryAsistencia1 =  $conexion->query($queryConsultaAsistencia1);
	$rowRespuestaAsistencia1 = mysqli_fetch_assoc($respuestaqueryAsistencia1);

	if ($cont5 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia1['deducible'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia1['deducible'] . '</font></center></td>';
	}

	$cont5 += 1;
}

$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURAS TOTAL DAÑOS
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr style="width: 100%;" class="izquierda">';
$html3 .= '<td style ="width: 100%; background-color: #D1D1D1; font-family:dejavusanscondensedb;" colspan="' . ($fila6 + 1) . '"><div style="font-size:3pt">&nbsp;</div>COBERTURAS AL VEHÍCULO <div style="font-size:3pt">&nbsp;</div></td>';

$html3 .= '</tr>';

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Pérdida total daños o hurto</font></td>';


$query10 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery10 =  $conexion->query($query10);

$cont6 = 1;
while ($rowRespuesta10 = mysqli_fetch_assoc($respuestaquery10)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta10['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta10['Aseguradora'], $rowRespuesta10['Producto']);

	if ($cont6 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;"><div style="font-size:4pt">&nbsp;</div>' . $rowRespuesta10['PerdidaTotal'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;"><div style="font-size:4pt">&nbsp;</div>' . $rowRespuesta10['PerdidaTotal'] . '</font></center></td>';
	}

	$cont6 += 1;
}
$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURAS PARCIAL DAÑOS
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Pérdida parcial por daño</font></td>';

$query11 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery11 =  $conexion->query($query11);

$cont7 = 1;

while ($rowRespuesta11 = mysqli_fetch_assoc($respuestaquery11)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta11['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta11['Aseguradora'], $rowRespuesta11['Producto']);

	if ($cont7 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta11['PerdidaParcial'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta11['PerdidaParcial'] . '</font></center></td>';
	}

	$cont7 += 1;
}

$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURAS PARCIAL HURTO
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Pérdida parcial por hurto</font></td>';

$query12 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery12 =  $conexion->query($query12);

$cont8 = 1;

while ($rowRespuesta12 = mysqli_fetch_assoc($respuestaquery12)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta12['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta12['Aseguradora'], $rowRespuesta12['Producto']);

	if ($cont8 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta12['PerdidaParcial'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta12['PerdidaParcial'] . '</font></center></td>';
	}

	$cont8 += 1;
}

$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURAS EVENTO NATURAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font style="font-family:dejavusanscondensedb;" size="8">Cobertura por Eventos de la naturaleza</font></td>';

$query13 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery13 =  $conexion->query($query13);
$cont9 = 1;
while ($rowRespuesta13 = mysqli_fetch_assoc($respuestaquery13)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta13['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta13['Aseguradora'], $rowRespuesta13['Producto']);

	$queryConsultaAsistencia5 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia5 =  $conexion->query($queryConsultaAsistencia5);
	$rowRespuestaAsistencia5 = mysqli_fetch_assoc($respuestaqueryAsistencia5);


	if ($cont9 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia5['eventos'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia5['eventos'] . '</font></center></td>';
	}

	$cont9 += 1;
}

$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA AMPARO PATRIMONIAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><div style="font-size:2pt">&nbsp;</div><font size="8">Amparo patrimonial</font></td>';

$query14 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery14 =  $conexion->query($query14);

$cont10 = 1;
while ($rowRespuesta14 = mysqli_fetch_assoc($respuestaquery14)) {
	$nombreAseguradora = nombreAseguradora($rowRespuesta14['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta14['Aseguradora'], $rowRespuesta14['Producto']);

	$queryConsultaAsistencia6 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia6 =  $conexion->query($queryConsultaAsistencia6);
	$rowRespuestaAsistencia6 = mysqli_fetch_assoc($respuestaqueryAsistencia6);


	if ($cont10 % 2 == 0) {
		if ($rowRespuestaAsistencia6['amparopatrimonial'] == "Si ampara") {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia6['amparopatrimonial'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia6['amparopatrimonial'] == "Si ampara") {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia6['amparopatrimonial'] . '</font></center></td>';
		}
	}


	$cont10 += 1;
}

$html3 .= '</tr>';

$html3 .= '</table>';
$html4 = '
<style>
  .puntos {
    border-bottom:1px solid grey;
}

.second2 {
	width:100%;
}

.izquierda{
	text-align: left;
}

.fondo {
    background-color:#EBEBEB;
}

.fondo2 {
	background-color:#FFFFFF;
}

.fondo3 {
    background-color:#FFFFFF;
}

</style>
  
<table style="width: 100%;" class="second2" cellpadding="2"  border="0">';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA GRUA
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


$html4 .= '<tr style="width: 100%;" class="izquierda">';
$html4 .= '<td style ="width: 100%;  background-color: #D1D1D1; font-family:dejavusanscondensedb; " colspan="' . ($fila6 + 1) . '"><div style="font-size:3pt">&nbsp;</div>ASISTENCIAS<div style="font-size:3pt">&nbsp;</div></td>';
$html4 .= '</tr>';

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><div style="font-size:2pt">&nbsp;</div><font size="8">Grua varada o accidente.</font></td>';

$query15 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery15 =  $conexion->query($query15);

$cont11 = 1;
while ($rowRespuesta15 = mysqli_fetch_assoc($respuestaquery15)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta15['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta15['Aseguradora'], $rowRespuesta15['Producto']);

	$queryConsultaAsistencia7 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia7 =  $conexion->query($queryConsultaAsistencia7);
	$rowRespuestaAsistencia7 = mysqli_fetch_assoc($respuestaqueryAsistencia7);

	if ($cont11 % 2 == 0) {
		if ($rowRespuestaAsistencia7['Grua'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:6pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:6pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia7['Grua'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia7['Grua'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:6pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:6pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia7['Grua'] . '</font></center></td>';
		}
	}
	$cont11 += 1;
}
$html4 .= '</tr>';


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA CARRO TALLER
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><div style="font-size:2pt">&nbsp;</div><font size="8">Carrotaller </font> <font size="5"> (desvare por: llanta, batería, gasolina o cerrajería).</font></td>';

$cont12 = 1;
$query16 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery16 =  $conexion->query($query16);

while ($rowRespuesta16 = mysqli_fetch_assoc($respuestaquery16)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta16['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta16['Aseguradora'], $rowRespuesta16['Producto']);

	$queryConsultaAsistencia8 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia8 =  $conexion->query($queryConsultaAsistencia8);
	$rowRespuestaAsistencia8 = mysqli_fetch_assoc($respuestaqueryAsistencia8);

	if ($cont12 % 2 == 0) {
		if ($rowRespuestaAsistencia8['Carrotaller'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:14pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:14pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia8['Carrotaller'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia8['Carrotaller'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:14pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:14pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia8['Carrotaller'] . '</font></center></td>';
		}
	}

	$cont12 += 1;
}

$html4 .= '</tr>';


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA ASISTENCIA JURIDICA
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Asistencia juridica en proceso pena </font></td>';

$query17 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery17 =  $conexion->query($query17);

$cont13 = 1;

while ($rowRespuesta17 = mysqli_fetch_assoc($respuestaquery17)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta17['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta17['Aseguradora'], $rowRespuesta17['Producto']);

	$queryConsultaAsistencia9 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia9 =  $conexion->query($queryConsultaAsistencia9);
	$rowRespuestaAsistencia9 = mysqli_fetch_assoc($respuestaqueryAsistencia9);

	if ($cont13 % 2 == 0) {
		if ($rowRespuestaAsistencia9['amparopatrimonial'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['amparopatrimonial'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia9['amparopatrimonial'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['amparopatrimonial'] . '</font></center></td>';
		}
	}

	$cont13 += 1;
}

$html4 .= '</tr>';


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA TRANSPORTE PT
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Gastos de Transporte en pérdida total</font></td>';

$query27 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery27 =  $conexion->query($query27);

$cont14 = 1;


while ($rowRespuesta27 = mysqli_fetch_assoc($respuestaquery27)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta27['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta27['Aseguradora'], $rowRespuesta27['Producto']);

	$queryConsultaAsistencia10 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia10 =  $conexion->query($queryConsultaAsistencia10);
	$rowRespuestaAsistencia10 = mysqli_fetch_assoc($respuestaqueryAsistencia10);

	if ($cont14 % 2 == 0) {
		if ($rowRespuestaAsistencia10['Gastosdetransportept'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:9pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:9pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia10['Gastosdetransportept'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia10['Gastosdetransportept'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:9pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:9pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia10['Gastosdetransportept'] . '</font></center></td>';
		}
	}


	$cont14 += 1;
}

$html4 .= '</tr>';

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Gastos de transporte en perdida parcial</font></td>';
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA TRANSPORTE PP
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$query18 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery18 =  $conexion->query($query18);
$cont15 = 1;
while ($rowRespuesta18 = mysqli_fetch_assoc($respuestaquery18)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta18['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta18['Aseguradora'], $rowRespuesta18['Producto']);

	$queryConsultaAsistencia11 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia11 =  $conexion->query($queryConsultaAsistencia11);
	$rowRespuestaAsistencia11 = mysqli_fetch_assoc($respuestaqueryAsistencia11);


	if ($cont15 % 2 == 0) {
		if ($rowRespuestaAsistencia11['Gastosdetransportepp'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia11['Gastosdetransportepp'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia11['Gastosdetransportepp'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia11['Gastosdetransportepp'] . '</font></center></td>';
		}
	}



	$cont15 += 1;
}

$html4 .= '</tr>';
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA VEHICULO REEMPLAZO PERDIDA TOTAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="puntos fondo" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Vehículo de reemplazo en pérdida total</font></td>';

$query28 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery28 =  $conexion->query($query28);
$cont16 = 1;
while ($rowRespuesta28 = mysqli_fetch_assoc($respuestaquery28)) {
	$nombreAseguradora = nombreAseguradora($rowRespuesta28['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta28['Aseguradora'], $rowRespuesta28['Producto']);

	$queryConsultaAsistencia12 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia12 =  $conexion->query($queryConsultaAsistencia12);
	$rowRespuestaAsistencia12 = mysqli_fetch_assoc($respuestaqueryAsistencia12);


	if ($cont16 % 2 == 0) {
		if ($rowRespuestaAsistencia12['Vehiculoreemplazopt'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia12['Vehiculoreemplazopt'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia12['Vehiculoreemplazopt'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia12['Vehiculoreemplazopt'] . '</font></center></td>';
		}
	}

	$cont16 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA VEHICULO REEMPLAZO PERDIDA PARCIAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class ="fondo puntos" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Vehículo de reemplazo en pérdida parcial</font></td>';

$query19 = "SELECT * FROM ofertas WHERE `id_cotizacion` =$identificador AND `seleccionar` = 'Si'";
$respuestaquery19 =  $conexion->query($query19);

$cont17 = 1;

while ($rowRespuesta19 = mysqli_fetch_assoc($respuestaquery19)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta19['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta19['Aseguradora'], $rowRespuesta19['Producto']);

	$queryConsultaAsistencia13 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia13 =  $conexion->query($queryConsultaAsistencia13);
	$rowRespuestaAsistencia13 = mysqli_fetch_assoc($respuestaqueryAsistencia13);


	if ($cont17 % 2 == 0) {
		if ($rowRespuestaAsistencia13['Vehiculoreemplazopp'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center;font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia13['Vehiculoreemplazopp'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia13['Vehiculoreemplazopp'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center;font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia13['Vehiculoreemplazopp'] . '</font></center></td>';
		}
	}

	$cont17 += 1;
}

$html4 .= '</tr>';


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA CONDUCTOR ELEGIDO
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Conductor elegido</font></td>';

$query20 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery20 =  $conexion->query($query20);
$cont18 = 1;

while ($rowRespuesta20 = mysqli_fetch_assoc($respuestaquery20)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta20['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta20['Aseguradora'], $rowRespuesta20['Producto']);

	$queryConsultaAsistencia14 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia14 =  $conexion->query($queryConsultaAsistencia14);
	$rowRespuestaAsistencia14 = mysqli_fetch_assoc($respuestaqueryAsistencia14);


	if ($cont18 % 2 == 0) {
		if ($rowRespuestaAsistencia14['Conductorelegido'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:4pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:6pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia14['Conductorelegido'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia14['Conductorelegido'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:4pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:6pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia14['Conductorelegido'] . '</font></center></td>';
		}
	}





	$cont18 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA Transporte del vehículo recuperado
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Transporte del vehículo recuperado</font></td>';

$query21 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery21 =  $conexion->query($query21);
$cont19 = 1;
while ($rowRespuesta21 = mysqli_fetch_assoc($respuestaquery21)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta21['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta21['Aseguradora'], $rowRespuesta21['Producto']);

	$queryConsultaAsistencia15 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia15 =  $conexion->query($queryConsultaAsistencia15);
	$rowRespuestaAsistencia15 = mysqli_fetch_assoc($respuestaqueryAsistencia15);

	if ($cont19 % 2 == 0) {
		if ($rowRespuestaAsistencia15['Transportevehiculorecuperdo'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia15['Transportevehiculorecuperdo'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia15['Transportevehiculorecuperdo'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia15['Transportevehiculorecuperdo'] . '</font></center></td>';
		}
	}


	$cont19 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA Transporte DE PASAJEROS POR ACCIDENTE
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class ="fondo puntos" style="width:10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Transporte de pasajeros por accidente</font></td>';

$query22 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery22 =  $conexion->query($query22);

$cont20 = 1;
while ($rowRespuesta22 = mysqli_fetch_assoc($respuestaquery22)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta22['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta22['Aseguradora'], $rowRespuesta22['Producto']);

	$queryConsultaAsistencia16 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia16 =  $conexion->query($queryConsultaAsistencia16);
	$rowRespuestaAsistencia16 = mysqli_fetch_assoc($respuestaqueryAsistencia16);

	if ($cont20 % 2 == 0) {
		if ($rowRespuestaAsistencia16['Transportepasajerosaccidente'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:12pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:14pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia16['Transportepasajerosaccidente'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia16['Transportepasajerosaccidente'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:12pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:14pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia16['Transportepasajerosaccidente'] . '</font></center></td>';
		}
	}


	$cont20 += 1;
}

$html4 .= '</tr>';

$html4 .= '</table>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//SEGUNDA TABLA DE ASISTENCIAS
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html5 = '
<style>
  .puntos {
    border-bottom:1px solid grey;
}

.second2 {
	width:100%;
}

.izquierda{
	text-align: left;
}

.fondo {
    background-color:#EBEBEB;
}

.fondo2 {
	background-color:#FFFFFF;
}

.fondo3 {
    background-color:#FFFFFF;
}

</style>
  
<table style="width: 100%;" class="second2" cellpadding="2"  border="0">';

$html5 .= '<tr style="width: 100%;" class="izquierda">';
$html5 .= '<td style ="width: 100%;  background-color: #D1D1D1; font-family:dejavusanscondensedb;" colspan="' . ($fila6 + 1) . '"><div style="font-size:3pt">&nbsp;</div>ASISTENCIAS<div style="font-size:3pt">&nbsp;</div></td>';
$html5 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//LOGOS
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


$html5 .= '<tr>';


$html5 .= '<td class="fondo puntos" style="width:10%;"></td>';

$query23 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery23 =  $conexion->query($query23);

$cont21 = 1;
while ($rowRespuesta7 = mysqli_fetch_assoc($respuestaquery7)) {

	if ($cont3 % 2 == 0) {
		if ($rowRespuesta7['Aseguradora'] == 'Axa Colpatria') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><center>
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/axa.png" alt=""></center>
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros del Estado') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'HDI Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'SBS Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sbs.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Bolivar') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/bolivar.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Sura') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sura.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Zurich Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/zurich.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Allianz Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Allianz') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Liberty Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Liberty') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Mapfre') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mapfre.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Equidad Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/equidad.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Previsora Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Previsora') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Aseguradora Solidaria') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Solidaria') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		}
	} else {
		if ($rowRespuesta7['Aseguradora'] == 'Axa Colpatria') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><center>
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/axa.png" alt=""></center></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros del Estado') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'HDI Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'SBS Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sbs.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Bolivar') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/bolivar.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Sura') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sura.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Zurich Seguros') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/zurich.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Allianz Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Allianz') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/allianz.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Liberty Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Liberty') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/liberty.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Mapfre') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mapfre.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Equidad Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/equidad.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Previsora Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Previsora') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/previsora.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Aseguradora Solidaria') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Solidaria') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt=""></td>';
		}
	}

	$cont3 += 1;
}
$html5 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//TRANSPORTE DE PASAJEROS POR VARADA
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


$html5 .= '<tr>';
$html5 .= '<td class="fondo puntos" style="width:10%;"><font size="8" style="font-family:dejavusanscondensedb; text-align: center;">Transporte de pasajeros por varada</font></td>';

$query24 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery24 =  $conexion->query($query24);

$cont22 = 1;
while ($rowRespuesta24 = mysqli_fetch_assoc($respuestaquery24)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta24['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta24['Aseguradora'], $rowRespuesta24['Producto']);

	$queryConsultaAsistencia17 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia17 =  $conexion->query($queryConsultaAsistencia17);
	$rowRespuestaAsistencia17 = mysqli_fetch_assoc($respuestaqueryAsistencia17);


	if ($cont22 % 2 == 0) {
		if ($rowRespuestaAsistencia17['Transportepasajerosvarada'] == "Si ampara") {
			$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia17['Transportepasajerosvarada'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia17['Transportepasajerosvarada'] == "Si ampara") {
			$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:10pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:12pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia17['Transportepasajerosvarada'] . '</font></center></td>';
		}
	}

	$cont22 += 1;
}

$html5 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//ACCIDENTES PERSONALES
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html5 .= '<tr>';
$html5 .= '<td class="fondo puntos" style="width:10%;"><font size="8" style="font-family:dejavusanscondensedb; text-align: center;">Accidentes personales</font></td>';

$query25 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery25 =  $conexion->query($query25);

$cont23 = 1;
while ($rowRespuesta25 = mysqli_fetch_assoc($respuestaquery25)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta25['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta25['Aseguradora'], $rowRespuesta25['Producto']);

	$queryConsultaAsistencia18 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia18 =  $conexion->query($queryConsultaAsistencia18);
	$rowRespuestaAsistencia18 = mysqli_fetch_assoc($respuestaqueryAsistencia18);

	if ($cont23 % 2 == 0) {
		if ($rowRespuestaAsistencia18['Accidentespersonales'] == "Si ampara") {
			$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:4pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:6pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia18['Accidentespersonales'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia18['Accidentespersonales'] == "Si ampara") {
			$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:4pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:6pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia18['Accidentespersonales'] . '</font></center></td>';
		}
	}


	$cont23 += 1;
}

$html5 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//LLANTAS ESTALLADAS
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html5 .= '<tr>';
$html5 .= '<td class="fondo puntos" style="width:10%;"><font size="8" style="font-family:dejavusanscondensedb; text-align: center;">Llantas estalladas</font></td>';

$query26 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery26 =  $conexion->query($query26);

$cont24 = 1;
while ($rowRespuesta26 = mysqli_fetch_assoc($respuestaquery26)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta26['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta26['Aseguradora'], $rowRespuesta26['Producto']);

	$queryConsultaAsistencia19 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia19 =  $conexion->query($queryConsultaAsistencia19);
	$rowRespuestaAsistencia19 = mysqli_fetch_assoc($respuestaqueryAsistencia19);

	if ($cont24 % 2 == 0) {
		if ($rowRespuestaAsistencia19['Llantasestalladas'] == "Si ampara") {
			$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:4pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia19['Llantasestalladas'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia19['Llantasestalladas'] == "Si ampara") {
			$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:4pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia19['Llantasestalladas'] . '</font></center></td>';
		}
	}


	$cont24 += 1;
}


$html5 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//PERDIDA DE LLAVES
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html5 .= '<tr>';
$html5 .= '<td class="fondo puntos" style="width:10%;"><font size="8" style="font-family:dejavusanscondensedb; text-align: center;">Pérdida de llaves</font></td>';

$query28 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery28 =  $conexion->query($query28);

$cont25 = 1;
while ($rowRespuesta28 = mysqli_fetch_assoc($respuestaquery28)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta28['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta28['Aseguradora'], $rowRespuesta28['Producto']);

	$queryConsultaAsistencia20 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia2O =  $conexion->query($queryConsultaAsistencia20);
	$rowRespuestaAsistencia20 = mysqli_fetch_assoc($respuestaqueryAsistencia2O);

	if ($cont25 % 2 == 0) {
		if ($rowRespuestaAsistencia20['Perdidallaves'] == "Si ampara") {
			$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:4pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia20['Perdidallaves'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia20['Perdidallaves'] == "Si ampara") {
			$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><div style="font-size:4pt">&nbsp;</div><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><div style="font-size:4pt">&nbsp;</div><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia20['Perdidallaves'] . '</font></center></td>';
		}
	}


	$cont25 += 1;
}

$html5 .= '</tr>';

// $html5 .= '<tr>';


// $html5 .= '<td class="fondo puntos" style="width:10%;"><font size="8" style="font-family:dejavusanscondensedb; text-align: center;">Dias de Vigencia</font></td>';

// $query26 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
// $respuestaquery75 =  $conexion->query($query26);

// $cont21 = 1;
// $cont99 = 0;
// while ($rowRespuesta76= mysqli_fetch_assoc($respuestaquery75)) {

// 	if ($cont99 % 2 == 0) {
// 		if ($rowRespuesta76['Aseguradora'] == 'Seguros del Estado' || $rowRespuesta76['Aseguradora'] == 'Seguros Mapfre' 
// 			|| $rowRespuesta76['Aseguradora'] == 'Previsora Seguros' || $rowRespuesta76['Aseguradora'] == 'Previsora' 
// 			|| $rowRespuesta76['Aseguradora'] == 'SBS Seguros'
// 			|| $rowRespuesta76['Aseguradora'] == 'Aseguradora Solidaria' || $rowRespuesta76['Aseguradora'] == 'Solidaria'
// 			|| $rowRespuesta76['Aseguradora'] == 'Seguros Sura') {
// 				$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center; font-size: 7px;">15 días</td>';
// 			} else {
// 				$html5 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center; font-size: 7px;">30 días</td>';
// 			}
// 	} else {
// 		if ($rowRespuesta76['Aseguradora'] == 'Seguros del Estado' || $rowRespuesta76['Aseguradora'] == 'Seguros Mapfre' 
// 			|| $rowRespuesta76['Aseguradora'] == 'Previsora Seguros' || $rowRespuesta76['Aseguradora'] == 'Previsora' 
// 			|| $rowRespuesta76['Aseguradora'] == 'SBS Seguros'
// 			|| $rowRespuesta76['Aseguradora'] == 'Aseguradora Solidaria' || $rowRespuesta76['Aseguradora'] == 'Solidaria'
// 			|| $rowRespuesta76['Aseguradora'] == 'Seguros Sura') {
// 				$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center; font-size: 7px;">15 días</td>';
// 			} else {
// 				$html5 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center; font-size: 7px;">30 días</td>';
// 			}
// 	}

// 	$cont99 += 1;
// }
// $html5 .= '</tr>';


$html5 .= '</table>';


$html6 = '
<style>
  .puntos {
    border-bottom:1px solid grey;
}

.puntos2 {
    border-right:1px solid grey;
}





.second2 {
	width:100%;
}

.izquierda{
	text-align: left;
}

.redondeotabla{
	border-radius: 5px 30px 45px 60px;
-moz-border-radius: 5px 30px 45px 60px;
-webkit-border-radius: 15px;
}

.fondo {
    background-color:#EBEBEB;
}

</style>';





$query29 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si' AND `recomendar` ='Si'";
$respuestaquery29 =  $conexion->query($query29);
$asegRecomendada = mysqli_num_rows($respuestaquery29);

$query40 = "SELECT * FROM cotizaciones WHERE `id_cotizacion` = $identificador";
$respuestaquery40 =  $conexion->query($query40);
$rowRespuestaAsistencia40 = mysqli_fetch_assoc($respuestaquery40);

$rest = substr($rowRespuestaAsistencia40['cot_fch_cotizacion'], 0, -9);

$contador = 0;

while ($rowRespuesta29 = mysqli_fetch_assoc($respuestaquery29)) {

	$contador++;

	$nombreAseguradora = nombreAseguradora($rowRespuesta29['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta29['Aseguradora'], $rowRespuesta29['Producto']);
	$valorRC = $rowRespuesta29['ValorRC'];
	$perdidaParcial = $rowRespuesta29['PerdidaParcial'];


	$queryConsultaAsistencia29 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto' 
									AND `rce` LIKE '$valorRC' AND `ppd` LIKE '$perdidaParcial'";
	$respuestaqueryAsistencia29 =  $conexion->query($queryConsultaAsistencia29);
	$rowRespuestaAsistencia29 = mysqli_fetch_assoc($respuestaqueryAsistencia29);

	$color = $rowRespuestaAsistencia29['color'];

	$html6 .= '<table style="width: 100%;" class="second2" cellpadding="2"  border="0">';

	$html6 .= '<tr>';
	$html6 .= '<td class="redondeotabla" style ="border-radius:50px; width: 100%;  background-color: #88D600;' . $color . '; color:white; font-family:dejavusanscondensedb; " colspan="' . ($fila6 + 1) . '"><div style="font-size:3pt">&nbsp;</div>OPCIÓN ' . $contador . '<div style="font-size:3pt;">&nbsp;</div></td>';
	$html6 .= '</tr>';
	$html6 .= '<tr>';

	if ($rowRespuesta29['Aseguradora'] == 'Axa Colpatria') {
		$html6 .= '<td style="width:40%;text-align: center;"><center>
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:65px;" src="../../../vistas/img/logos/axa.png" alt=""></center></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Seguros del Estado') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/estado.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'HDI Seguros') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/hdi.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'SBS Seguros') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/sbs.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Seguros Bolivar') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/bolivar.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Seguros Sura') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/sura.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Zurich Seguros') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/zurich.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Allianz Seguros') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/allianz.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Allianz') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/allianz.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Liberty Seguros') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/liberty.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Liberty') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/liberty.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Seguros Mapfre') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/mapfre.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Equidad Seguros') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/equidad.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Previsora Seguros') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/previsora.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Previsora') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/previsora.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Aseguradora Solidaria') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/solidaria.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Solidaria') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/solidaria.png" alt=""></td>';
	}

	$html6 .= '<td style ="width: 60%; text-align: center;"><div style="font-size:4pt">&nbsp;</div><font style="color:#' . $color . '">Producto: </font>' . $rowRespuesta29['Producto'] . '<font style="color:#' . $color . '"> Fecha Vigencia: </font>' . date("d/m/Y", strtotime($rest)) . ' <br> <font style="color:#' . $color . '; font-size:22px; ">$' . number_format($rowRespuesta29['Prima'], 0, ',', '.') . '</font><div style="font-size:4pt">&nbsp;</div></td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td style ="width: 100%;  background-color: #D1D1D1; font-family:dejavusanscondensedb;" colspan="' . ($fila6 + 1) . '">COBERTURA DEL VEHÍCULO</td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Daños a terceros</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Muertes a una persona</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 30%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Muerte a dos personas o más</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 10%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Deducible</font></td>';
	$html6 .= '<td class="fondo" style ="width: 20%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Asistencia Jurídica</font></td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center;" ><font size="7">' . number_format($rowRespuestaAsistencia29['rce'], 0, ',', '.') . '</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center;" ><font size="7">' . number_format($rowRespuestaAsistencia29['rce'], 0, ',', '.') . '</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 30%; text-align: center;" ><font size="7">' . number_format($rowRespuestaAsistencia29['rce'], 0, ',', '.') . '</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 10%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['deducible'] . '</font></td>';
	if ($rowRespuestaAsistencia29['Asistenciajuridica'] == "Si ampara") {
		$html6 .= '<td class="fondo" style="width:20%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
	} else {
		$html6 .= '<td class="fondo" style="width:20%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia29['Asistenciajuridica'] . '</font></center></td>';
	}
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td>';
	$html6 .= '</td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td style ="width: 100%;  background-color: #D1D1D1; font-family:dejavusanscondensedb;" colspan="' . ($fila6 + 1) . '">COBERTURA DEL VEHÍCULO</td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Pérdida total daños</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Pérdida parcial daños</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 30%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Pérdida total hurto</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 10%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Deducible</font></td>';
	$html6 .= '<td class="fondo" style ="width: 20%; text-align: center; font-family:dejavusanscondensedb;" ><font size="8">Desastre natural</font></td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center;" ><font size="7">' . $rowRespuesta29['PerdidaTotal'] . '</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center;" ><font size="7">' . $rowRespuesta29['PerdidaParcial'] . '</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 30%; text-align: center;" ><font size="7">' . $rowRespuesta29['PerdidaTotal'] . '</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 10%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['deducible'] . '</font></td>';
	if ($rowRespuestaAsistencia29['eventos'] == "Si ampara") {
		$html6 .= '<td class="fondo" style="width:20%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
	} else {
		$html6 .= '<td class="fondo" style="width:20%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia29['eventos'] . '</font></center></td>';
	}
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td>';
	$html6 .= '</td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td style ="width: 100%;  background-color: #D1D1D1; font-family:dejavusanscondensedb;" colspan="' . ($fila6 + 1) . '">ASISTENCIA</td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td class="fondo puntos2" style ="width: 25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Gastos de movilización ante pérdidas parciales</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Gastos de movilización ante pérdidas totales</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Vehículo de reemplazo ante pérdidas parciales</font></td>';
	$html6 .= '<td class="fondo" style ="width: 25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Vehículo de reemplazo ante pérdidas totales</font></td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td class="fondo puntos puntos2" style ="width: 25%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['Gastosdetransportepp'] . '</font></td>';
	$html6 .= '<td class="fondo puntos puntos2" style ="width: 25%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['Gastosdetransportept'] . '</font></td>';
	$html6 .= '<td class="fondo puntos puntos2" style ="width: 25%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['Vehiculoreemplazopp'] . '</font></td>';
	$html6 .= '<td class="fondo puntos" style ="width: 25%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['Vehiculoreemplazopt'] . '</font></td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Asesoría con abogado en caso de accidente</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Revisión antes de viaje</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 30%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Carro-Taller</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 10%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Conductor elegido</font></td>';
	$html6 .= '<td class="fondo" style ="width: 20%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Servicio de grúa ante accidente o varada</font></td>';
	$html6 .= '</tr>';

	$html6 .= '<tr>';
	$html6 .= '<td class="fondo puntos2" style ="width: 20%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['Asistenciajuridica'] . '</font></td>';
	$html6 .= '<td class="fondo puntos2" style="width:20%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 30%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['Carrotaller'] . '</font></td>';
	$html6 .= '<td class="fondo puntos2" style ="width: 10%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['Conductorelegido'] . '</font></td>';
	$html6 .= '<td class="fondo" style ="width: 20%; text-align: center;" ><font size="7">' . $rowRespuestaAsistencia29['Grua'] . '</font></td>';
	$html6 .= '</tr>';


	$html6 .= '</table>';
	$html6 .= '<p></p>';
}

$html7 = '
<style>
  .puntos {
    border-bottom:1px solid grey;
}

.second2 {
	width:100%;
}

.izquierda{
	text-align: left;
}

</style>';


$html7 .= '<table style="width: 100%;" class="second2" cellpadding="2"  border="0">';

$html7 .= '<tr>';
$html7 .= '<td style ="width: 100%;" colspan="' . ($fila6 + 1) . '"><font  size="18" style="text-align: center;">Queremos sugerirte <font style="color: #EC8923;"> ' . $asegRecomendada . ' de las mejores</font> aseguradoras</font></td>';
$html7 .= '</tr>';

$html7 .= '</table>';



$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(33.5, 139);
$pdf->Cell(10, 0, 'Si quieres', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'BI', 15);
$pdf->SetTextColor(15, 178, 241);
$pdf->SetXY(98.4, 139);
$pdf->Cell(10, 0, ' comparar las coberturas y asistencias', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(163, 139);
$pdf->Cell(10, 0, 'de todas', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(70, 146);
$pdf->Cell(10, 0, 'las aseguradoras, revisa', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'BI', 15);
$pdf->SetTextColor(235, 135, 39);
$pdf->SetXY(127, 146);
$pdf->Cell(10, 0, ' el siguiente cuadro', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 11);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(101, 153);
$pdf->Cell(10, 0, '(Recuerda que este icono       significa Si Aplica o Si Cubre)', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');


//$pdf->Cell(210, 0, 'las aseguradoras, revisa el siguiente cuadro', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Ln();

$pdf->writeHTML($html3, true, false, true, false, '');

$pdf->Ln();
$pdf->writeHTML($html4, true, false, true, false, '');
$pdf->Ln();
$pdf->writeHTML($html5, true, false, true, false, '');
//$pdf->Ln();


//$pdf->lastPage();


if ($asegRecomendada > 0) {

	$pdf->AddPage();

	$pdf->writeHTML($html7, true, false, true, false, '');
	$pdf->writeHTML($html6, true, false, true, false, '');

}

$htmlimg = '<img src="../../../vistas/img/logos/pasosaseguradora.jpg">';
$pdf -> writeHTML($htmlimg, true, false, true, false, '');

// $pdf->Image('../../../vistas/img/logos/imagencotizador.jpg', -5, 0, 0, 92, 'JPG', '', '', true, 200, '', false, false, 0, false, false, false);




$pdf->SetFont('dejavusanscondensed', 'B', 9);
$pdf -> StartTransform();
$pdf->SetXY(203, 250);
$pdf -> Rotate(90);
$pdf -> setAlpha(0.5);
$pdf->SetTextColor(104, 104, 104);
$pdf->Cell(25, 6, "Elaborado por Software Integradoor propiedad del proveedor tecnológico Strategico Technologies SAS BIC Nit: 901.542.216-8", 0, 1, '');
$pdf->StopTransform();



$pdf->SetXY(0, 274);
// $pdf->SetY(-45);
$htmlFooter = '<p style="font-size: 6.2px;">Nota: Esta cotización no constituye una oferta comercial. La misma se expide única y exclusivamente con un propósito informativo sobre los posibles costos del seguro y sus condiciones, los cuales serán susceptibles de modificación hasta tanto no se concreten y determinen las características de los respectivos riesgos.</p>';
$pdf->writeHTML($htmlFooter, true, false, true, false, '');
$pdf->Ln();

//$pdf->Image('../../../vistas/img/logos/imagencotizador.jpg', -5, 0, 0, 92, 'JPG', '', '', true, 200, '', false, false, 0, false, false, false);






// Consulta el servicio del vehiculo segun su codigo
function servise($dato)
{
	$service = "";

	if ($dato == 14) {
		$service = "PARTICULAR";
	} else if ($dato == 11) {
		$service = "PUBLICO URBANO";
	} else if ($dato == 12) {
		$service = "PUBLICO MUNICIPAL";
	}
	return $service;
}


// Consulta la Clase correspondiente al Vehiculo
function claseV($dato)
{
	$service = "";

	if ($dato == "UTILITARIOS DEPORTIVOS") {
		$service = "UTILITARIOS DE.";
	} else {
		$service = $dato;
	}
	return $service;
}


// Calcula la Edad a partir de la Fecha de Nacimiento
function calculaedad($fechaNacimiento)
{

	list($ano, $mes, $dia) = explode("-", $fechaNacimiento);
	$ano_diferencia = date("Y") - $ano;
	$mes_diferencia = date("m") - $mes;
	$dia_diferencia = date("d") - $dia;
	if ($dia_diferencia < 0 || $mes_diferencia < 0)
		$ano_diferencia--;
	return $ano_diferencia;
}


// Consulta el nombre del Departamento segun el Codigo
function DptoVehiculo($codigoDpto)
{

	if ($codigoDpto == 1) {
		$nomDpto = "Amazonas";
	} else if ($codigoDpto == 2) {
		$nomDpto = "Antioquia";
	} else if ($codigoDpto == 3) {
		$nomDpto = "Arauca";
	} else if ($codigoDpto == 4) {
		$nomDpto = "Atlántico";
	} else if ($codigoDpto == 5) {
		$nomDpto = "Barranquilla";
	} else if ($codigoDpto == 6) {
		$nomDpto = "Bogotá";
	} else if ($codigoDpto == 7) {
		$nomDpto = "Bolívar";
	} else if ($codigoDpto == 8) {
		$nomDpto = "Boyacá";
	} else if ($codigoDpto == 9) {
		$nomDpto = "Caldas";
	} else if ($codigoDpto == 10) {
		$nomDpto = "Caquetá";
	} else if ($codigoDpto == 11) {
		$nomDpto = "Casanare";
	} else if ($codigoDpto == 12) {
		$nomDpto = "Cauca";
	} else if ($codigoDpto == 13) {
		$nomDpto = "Cesar";
	} else if ($codigoDpto == 14) {
		$nomDpto = "Chocó";
	} else if ($codigoDpto == 15) {
		$nomDpto = "Córdoba";
	} else if ($codigoDpto == 16) {
		$nomDpto = "Cundinamarca";
	} else if ($codigoDpto == 17) {
		$nomDpto = "Guainía";
	} else if ($codigoDpto == 18) {
		$nomDpto = "La Guajira";
	} else if ($codigoDpto == 19) {
		$nomDpto = "Guaviare";
	} else if ($codigoDpto == 20) {
		$nomDpto = "Huila";
	} else if ($codigoDpto == 21) {
		$nomDpto = "Magdalena";
	} else if ($codigoDpto == 22) {
		$nomDpto = "Meta";
	} else if ($codigoDpto == 23) {
		$nomDpto = "Nariño";
	} else if ($codigoDpto == 24) {
		$nomDpto = "Norte de Santander";
	} else if ($codigoDpto == 25) {
		$nomDpto = "Putumayo";
	} else if ($codigoDpto == 26) {
		$nomDpto = "Quindío";
	} else if ($codigoDpto == 27) {
		$nomDpto = "Risaralda";
	} else if ($codigoDpto == 28) {
		$nomDpto = "San Andrés";
	} else if ($codigoDpto == 29) {
		$nomDpto = "Santander";
	} else if ($codigoDpto == 30) {
		$nomDpto = "Sucre";
	} else if ($codigoDpto == 31) {
		$nomDpto = "Tolima";
	} else if ($codigoDpto == 32) {
		$nomDpto = "Valle del Cauca";
	} else if ($codigoDpto == 33) {
		$nomDpto = "Vaupés";
	} else if ($codigoDpto == 34) {
		$nomDpto = "Vichada";
	} else {
		$nomDpto = "No Disponible";
	}
	return $nomDpto;
}


function nombreAseguradora($data)
{
	$resultado = "";
	if ($data == 'Seguros del Estado') {
		$resultado = "Estado";
	} else if ($data == 'Seguros Bolivar') {
		$resultado = "Bolivar";
	} else if ($data == 'Axa Colpatria') {
		$resultado = "Axa Colpatria";
	} else if ($data == 'HDI Seguros') {
		$resultado = "HDI";
	} else if ($data == 'SBS Seguros') {
		$resultado = "SBS";
	} else if ($data == 'Allianz Seguros') {
		$resultado = "Allianz";
	} else if ($data == 'Equidad Seguros') {
		$resultado = "Equidad";
	}
	else if ($data == 'Equidad') {
		$resultado = "Equidad";
	} else if ($data == 'Seguros Mapfre') {
		$resultado = "Mapfre";
	} else if ($data == 'Liberty Seguros') {
		$resultado = "Liberty";
	} else if ($data == 'Aseguradora Solidaria') {
		$resultado = "Solidaria";
	} else if ($data == 'Seguros Sura') {
		$resultado = "SURA";
	} else if ($data == 'Zurich Seguros') {
		$resultado = "Zurich";
	} else if ($data == 'Zurich') {
		$resultado = "Zurich";
	} else if ($data == 'Previsora Seguros') {
		$resultado = "Previsora";
	} else if ($data == 'Solidaria') {
		$resultado = "Solidaria";
	} else {
		$resultado = $data;
	}
	return $resultado;
}


function productoAseguradora($aseguradora, $producto)
{

	$resultado = "";
	if ($aseguradora == 'Seguros del Estado' && $producto == 'Familiar 1000') {
		$resultado = "Familiar 1000";
	} else if ($aseguradora == 'Seguros del Estado' && $producto == 'Familiar 500') {
		$resultado = "Familiar 500";
	} else if ($aseguradora == 'Seguros del Estado' && $producto == 'Estado -Automovil Familiar') {
		$resultado = "Familiar 500";
	} else if ($aseguradora == 'Seguros del Estado' && $producto == 'Estado -Automovil Familiar Full') {
		$resultado = "Familiar 1000";
	} else if ($aseguradora == 'Seguros Bolivar' && $producto == 'Premium') {
		$resultado = "Premium";
	} else if ($aseguradora == 'Seguros Bolivar' && $producto == 'Estandar') {
		$resultado = "Estandar";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'Tradicional') {
		$resultado = "Tradicional";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'Tradicional8') {
		$resultado = "Tradicional";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'Tradicional9') {
		$resultado = "Tradicional";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'Plus') {
		$resultado = "Plus";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'PLUS1') {
		$resultado = "Plus";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'Esencial') {
		$resultado = "Esencial";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'VIP') {
		$resultado = "VIP";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'Motos Plus') {
		$resultado = "Motos Plus";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'Motos Esencial') {
		$resultado = "Motos Esencial";
	} else if ($aseguradora == 'HDI Seguros' && $producto == 'Automovil Familiar') {
		$resultado = "Fomula Sicura";
	} else if ($aseguradora == 'SBS Seguros' && $producto == 'Full') {
		$resultado = "Full";
	} else if ($aseguradora == 'SBS Seguros' && $producto == 'Motocicletas') {
		$resultado = "Motocicletas";
	} else if ($aseguradora == 'Solidaria' && $producto == 'PARTICULAR FAMILIAR PLUS') {
		$resultado = "Plus";
	} else if ($aseguradora == 'Solidaria' && $producto == 'PARTICULAR FAMILIAR PREMIUM') {
		$resultado = "Premium";
	} else if ($aseguradora == 'Solidaria' && $producto == 'PARTICULAR FAMILIAR ELITE') {
		$resultado = "Elite";
	} else if ($aseguradora == 'Zurich' && $producto == 'FULL') {
		$resultado = "FULL";
	} else if ($aseguradora == 'Zurich' && $producto == 'MEDIUM') {
		$resultado = "MEDIUM";
	} else if ($aseguradora == 'Zurich' && $producto == 'BASIC') {
		$resultado = "BASIC";
	} else {
		$resultado = $producto;
	}
	return $resultado;
}





// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($placa . '_' . $fechaCotiz . '.pdf', 'I');
