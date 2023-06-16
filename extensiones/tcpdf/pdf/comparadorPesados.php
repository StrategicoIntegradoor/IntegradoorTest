<?php

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Bogota');

// Incluye la biblioteca TCPDF principal (busca la ruta de instalación).
require_once('tcpdf_include.php');

//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,array(150,  255), true, 'UTF-8', false);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

$identificador = $_GET['cotizacion'];

$server = "localhost";
$user = "grupoasi_cotizautos";
$password = "M1graci0n123"; //poner tu propia contraseña, si tienes una.
$bd = "grupoasi_cotizautos";

$conexion = mysqli_connect($server, $user, $password, $bd);
if (!$conexion) {
	die('Error de Conexión: ' . mysqli_connect_errno());
}
$conexion->set_charset("utf8");


$query2 = "SELECT *	FROM cotizaciones, clientes WHERE cotizaciones.id_cliente = clientes.id_cliente AND `id_cotizacion` = $identificador";
$valor2 = $conexion->query($query2);
$fila = mysqli_fetch_array($valor2);

$query3 = "SELECT DISTINCT Aseguradora FROM ofertas WHERE `id_cotizacion` = $identificador";
$valor3 = $conexion->query($query3);
$fila2 = mysqli_num_rows($valor3);

// Consulta las aseguradoras que fueron selecionadas para visualizar en el PDF
$queryAsegSelec = "SELECT DISTINCT Aseguradora FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$valorAsegSelec = $conexion->query($queryAsegSelec);
$asegSelecionada = mysqli_num_rows($valorAsegSelec);

// Consultar cuantas Ofertas fueron selecionadas para visualizarlas en el PDF
$queryPDF = "SELECT pdf FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$valorPDF = $conexion->query($queryPDF);
$ofertasPDF = mysqli_num_rows($valorPDF);


$fechaCotiz = substr($fila['cot_fch_cotizacion'], 0, -9);
$fechaVigencia = date("d-m-Y", strtotime($fechaCotiz));

$placa = $fila["cot_placa"] . " ";
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
$rest2 = substr($placa, 3, -1);

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


$fecha = $fila["f_registro"];
$newDate = date("d/m/Y", strtotime($fecha));
$real = "";

if ($consecutivo >= 0 && $consecutivo <= 9) {
	$real = "MJN715" . $consecutivo;
} else if ($consecutivo >= 10 && $consecutivo <= 99) {
	$real = "0000" . $consecutivo;
} else if ($consecutivo >= 100 && $consecutivo <= 999) {
	$real = "000" . $consecutivo;
} else if ($consecutivo >= 1000 && $consecutivo <= 9999) {
	$real = "00" . $consecutivo;
}



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
$pdf->SetAutoPageBreak(TRUE, 12);


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

$pdf->Image('../../../vistas/img/logos/imagencotizador.jpg', -5, 0, 0, 92, 'JPG', '', '', true, 200, '', false, false, 0, false, false, false);

$pdf->Image('../../../vistas/img/logos/cheque.png', 100.5, 180.5, 0, -12, 'PNG', '', '', true, 160, '', false, false, 0, false, false, false);

$pdf->Image('../../../vistas/img/logos/camion.png', 24.5, 126.5, 0, 35, 'PNG', '', '', true, 160, '', false, false, 0, false, false, false);

//$pdf->Image('images/img/QUIMERA_BONO_FINAL3.jpg', 0, 130, 0, 117, 'JPG', '', '', false, 140, '', false, false, 0, false, false, false);

$pdf->SetFont('dejavusanscondensed', '', 2);

$pdf->SetFont('dejavusanscondensed', 'B', 12);
$pdf->SetXY(98, 19.2);
$pdf->SetTextColor(235, 135, 39);
$pdf->Cell(25, 6, strtoupper($rest) . " " . strtoupper($rest2), 0, 1, '');


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
$pdf->Cell(25, 6, "15 DIAS A PARTIR DEL " . $fechaVigencia, 0, 1, '');

$pdf->SetXY(155, 56);
$pdf->Cell(25, 6, strtoupper($nomAsesor), 0, 1, '');

$pdf->SetXY(153, 64.1);
$pdf->Cell(25, 6, strtoupper($emailAsesor), 0, 1, '');

$pdf->SetXY(155, 72);
$pdf->Cell(25, 6, strtoupper($telAsesor), 0, 1, '');

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('dejavusanscondensed', 'BI', 15);
//$pdf->Cell(180, 0, 'Hemos cotizado ' . $asegSelecionada . ' aseguradoras, a continuación', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');
//$pdf->Cell(180, 0, 'te presentamos un comparativo de precios', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');



$htmlpesado1 ='
<style>
.second{

}
.fondo {
    background-color:#0FB2F1;
	font-family:dejavusanscondensedb;
	width: 100%;
	text-align:center;
}
</style>
';

$htmlpesado1 .='
<table style="width:600px;" class="second" cellpadding="2"  border="0">
<tr>
<td class="fondo">
<div style="font-size:14pt">&nbsp;
</div>
<b style="color:white; font-family:dejavusanscondensedbi; font-size:20px;">SEGURO VEHICULOS PESADOS</b>
<div style="font-size:5pt">&nbsp;
</div>
</td>
</tr>
</table>
';

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetXY(0,88);
$pdf->writeHTML($htmlpesado1, true, false, true, false, '');

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(46.5, 115);
$pdf->Cell(10, 0, 'Hemos ', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'BI', 15);
$pdf->SetTextColor(103,181,252);
$pdf->SetXY(90.5, 115);
$pdf->Cell(10, 0, 'cotizado ' . $asegSelecionada .' aseguradoras,', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(145.5, 115);
$pdf->Cell(10, 0, 'a continuación ', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(98, 122);
$pdf->Cell(10, 0, 'te presentamos un comparativo de precios', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');


$pdf->SetAlpha(0.7);

$pdf->SetFont('dejavusanscondensed', '', 8);

$pdf->SetAlpha(1.0);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(20, 128);





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

<div style="margin-left:40px;" class="second2">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<table style="width:350px !important;" class="second" cellpadding="2"  border="0">';

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
		
		}else if($rowRespuesta4['Aseguradora'] == 'Seguros Estado'){
			$html2 .= '<td class="puntos td2 fondo2" >
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		}else if ($rowRespuesta4['Aseguradora'] == 'Seguros HDI') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		
		}else if ($rowRespuesta4['Aseguradora'] == 'HDI Seguros') {
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
		
		}else if ($rowRespuesta4['Aseguradora'] == 'Liberty') {
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
			
		} else if ($rowRespuesta4['Aseguradora'] == 'Aseguradora Solidaria') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';

		}
		else if ($rowRespuesta4['Aseguradora'] == 'Seguros Mundial') {
			$html2 .= '<td class="puntos td2 fondo2">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mundial.png" alt="">
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
		}else if($rowRespuesta4['Aseguradora'] == 'Seguros Estado'){
			$html2 .= '<td class="puntos td2 fondo" >
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros del Estado') {
			$html2 .= '<td class="puntos td2 fondo" >
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';

			
		} else if ($rowRespuesta4['Aseguradora'] == 'Seguros HDI') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt="">
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
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/sura.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta4['Aseguradora'] == 'Zurich Seguros') {
			$html2 .= '<td class="puntos td2 fondo">
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
		}else if ($rowRespuesta4['Aseguradora'] == 'Seguros Mapfre') {
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
		} else if ($rowRespuesta4['Aseguradora'] == 'Aseguradora Solidaria') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		}else if ($rowRespuesta4['Aseguradora'] == 'Seguros Mundial') {
			$html2 .= '<td class="puntos td2 fondo">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mundial.png" alt="">
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
if($valor == 10){
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

}else if($valor > 10){
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

}else{

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
    background-color:#FFFFFF;
}

.fondo2 {
	
	background-color:#EBEBEB;
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
$valorTabla = (75 / $fila6);
$html3 .= '<td class="puntos fondo" style="width:25%;"></td>';

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
		}else if($rowRespuesta4['Aseguradora'] == 'Seguros Estado'){
			$html2 .= '<td class="puntos td2 fondo2" >
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros HDI') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt="">
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
		}else if ($rowRespuesta7['Aseguradora'] == 'Liberty') {
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
		} else if ($rowRespuesta7['Aseguradora'] == 'Aseguradora Solidaria') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt="">
			<div style="font-size:5pt">&nbsp;</div>
			</td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Mundial') {
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mundial.png" alt="">
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
		}  else if ($rowRespuesta7['Aseguradora'] == 'Seguros Estado') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/estado.png" alt=""></td>';
		}else if ($rowRespuesta7['Aseguradora'] == 'HDI Seguros') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/hdi.png" alt=""></td>';
		}else if ($rowRespuesta7['Aseguradora'] == 'Seguros HDI') {
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
		} else if ($rowRespuesta7['Aseguradora'] == 'Aseguradora Solidaria') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/solidaria.png" alt=""></td>';
		} else if ($rowRespuesta7['Aseguradora'] == 'Seguros Mundial') {
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;">
			<div style="font-size:5pt">&nbsp;</div>
			<img style="width:35px;" src="../../../vistas/img/logos/mundial.png" alt=""></td>';
		}
	}

	$cont3 += 1;
}
$html3 .= '</tr>';
$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Límite máximo </font><font size="7"> (En millones)</font></td>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA LIMITE MAXIMO
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$cont4 = 1;
$query9 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery9 =  $conexion->query($query9);

$valorlimiterow = mysqli_num_rows($respuestaquery9);

if($valorlimiterow==10){
	while ($rowRespuesta9 = mysqli_fetch_assoc($respuestaquery9)) {

		if ($cont4 % 2 == 0) {
	
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="6" style="text-align: center;"><div style="font-size:4pt">&nbsp;</div>' . number_format($rowRespuesta9['ValorRC'], 0, ',', '.') . '</font></center></td>';
		} else {
	
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="6" style="text-align: center;"><div style="font-size:4pt">&nbsp;</div>' . number_format($rowRespuesta9['ValorRC'], 0, ',', '.') . '</font></center></td>';
		}
	
		$cont4 += 1;
	}

}else if($valorlimiterow>10){
	while ($rowRespuesta9 = mysqli_fetch_assoc($respuestaquery9)) {

		if ($cont4 % 2 == 0) {
	
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="5" style="text-align: center;">' . number_format($rowRespuesta9['ValorRC'], 0, ',', '.') . '</font></center></td>';
		} else {
	
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="5" style="text-align: center;">' . number_format($rowRespuesta9['ValorRC'], 0, ',', '.') . '</font></center></td>';
		}
	
		$cont4 += 1;
	}

}else{
	while ($rowRespuesta9 = mysqli_fetch_assoc($respuestaquery9)) {

		if ($cont4 % 2 == 0) {
	
			$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="7" style="text-align: center;">' . number_format($rowRespuesta9['ValorRC'], 0, ',', '.') . '</font></center></td>';
		} else {
	
			$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%; font-family:dejavusanscondensed;"><center><font size="7" style="text-align: center;">' . number_format($rowRespuesta9['ValorRC'], 0, ',', '.') . '</font></center></td>';
		}
	
		$cont4 += 1;
	}

}



$html3 .= '</tr>';







//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA DE DEDUCIBLES
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Deducible</font></td>';


$query8 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery8 =  $conexion->query($query8);

$cont5 = 1;

while ($rowRespuesta8 = mysqli_fetch_assoc($respuestaquery8)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta8['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta8['Aseguradora'], $rowRespuesta8['Producto']);
	$valorRC = $rowRespuesta8['ValorRC'];
	$perdidaParcial = $rowRespuesta8['PerdidaParcial'];

	$queryConsultaAsistencia1 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto' 
									AND `rce` LIKE '$valorRC' AND `ppd` LIKE '$perdidaParcial'";
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
//CONSULTA DE RC EXCESO
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">RC Exceso (RCE)</font></td>';


$queryp1 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaqueryp1 =  $conexion->query($queryp1);

$cont5 = 1;

while ($rowRespuestap1 = mysqli_fetch_assoc($respuestaqueryp1)) {

	$nombreAseguradora = nombreAseguradora($rowRespuestap1['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuestap1['Aseguradora'], $rowRespuestap1['Producto']);
	$valorRC = $rowRespuestap1['ValorRC'];
	$perdidaParcial = $rowRespuestap1['PerdidaParcial'];

	$queryConsultaAsistencia1 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto' 
									AND `rce` LIKE '$valorRC' AND `ppd` LIKE '$perdidaParcial'";
	$respuestaqueryAsistencia1 =  $conexion->query($queryConsultaAsistencia1);
	$rowRespuestaAsistencia1 = mysqli_fetch_assoc($respuestaqueryAsistencia1);

	if ($cont5 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia1['rceexceso'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia1['rceexceso'] . '</font></center></td>';
	}

	$cont5 += 1;
}

$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA DE RC EXCESO
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Deducible</font></td>';


$queryp2 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaqueryp2 =  $conexion->query($queryp2);

$cont5 = 1;

while ($rowRespuestap2 = mysqli_fetch_assoc($respuestaqueryp2)) {

	$nombreAseguradora = nombreAseguradora($rowRespuestap2['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuestap2['Aseguradora'], $rowRespuestap2['Producto']);
	$valorRC = $rowRespuestap2['ValorRC'];
	$perdidaParcial = $rowRespuestap2['PerdidaParcial'];

	$queryConsultaAsistencia1 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto' 
									AND `rce` LIKE '$valorRC' AND `ppd` LIKE '$perdidaParcial'";
	$respuestaqueryAsistencia1 =  $conexion->query($queryConsultaAsistencia1);
	$rowRespuestaAsistencia1 = mysqli_fetch_assoc($respuestaqueryAsistencia1);

	if ($cont5 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia1['Deducible2'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia1['Deducible2'] . '</font></center></td>';
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
$html3 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Pérdida total daños o hurto</font></td>';


$query10 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery10 =  $conexion->query($query10);

$cont6 = 1;
while ($rowRespuesta10 = mysqli_fetch_assoc($respuestaquery10)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta10['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta10['Aseguradora'], $rowRespuesta10['Producto']);

	if ($cont6 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta10['PerdidaTotal'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta10['PerdidaTotal'] . '</font></center></td>';
	}

	$cont6 += 1;
}
$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURAS PARCIAL DAÑOS
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Pérdida parcial por daño</font></td>';

$query11 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery11 =  $conexion->query($query11);

$cont7 = 1;

while ($rowRespuesta11 = mysqli_fetch_assoc($respuestaquery11)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta11['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta11['Aseguradora'], $rowRespuesta11['Producto']);

	if ($cont7 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta11['PerdidaParcial'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta11['PerdidaParcial'] . '</font></center></td>';
	}

	$cont7 += 1;
}

$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURAS PARCIAL HURTO
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Pérdida parcial por hurto</font></td>';

$query12 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquery12 =  $conexion->query($query12);

$cont8 = 1;

while ($rowRespuesta12 = mysqli_fetch_assoc($respuestaquery12)) {

	$nombreAseguradora = nombreAseguradora($rowRespuesta12['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuesta12['Aseguradora'], $rowRespuesta12['Producto']);

	if ($cont8 % 2 == 0) {
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta12['PerdidaParcial'] .'</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuesta12['PerdidaParcial'] .'</font></center></td>';
	}

	$cont8 += 1;
}

$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURAS EVENTO NATURAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font style="font-family:dejavusanscondensedb;" size="8">Cobertura por Eventos de la naturaleza</font></td>';

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
		$html3 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia5['eventos'] . '</font></center></td>';
	} else {
		$html3 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;  font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia5['eventos'] . '</font></center></td>';
	}

	$cont9 += 1;
}

$html3 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA AMPARO PATRIMONIAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html3 .= '<tr>';
$html3 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><div style="font-size:2pt">&nbsp;</div><font size="8">Amparo patrimonial</font></td>';

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
	background-color:#FFFFFF;
    
}

.fondo2 {
	background-color:#EBEBEB;
}

.fondo3 {
    background-color:#FFFFFF;
}

</style>
  
<table style="width: 100%;" class="second2" cellpadding="2"  border="0">';

$html4 .= '<tr style="width: 100%;" class="izquierda">';
$html4 .= '<td style ="width: 100%; background-color: #D1D1D1; font-family:dejavusanscondensedb;" colspan="' . ($fila6 + 1) . '"><div style="font-size:3pt">&nbsp;</div>COBERTURAS ADICIONALES (NO APLICA PARA TRAILER) <div style="font-size:3pt">&nbsp;</div></td>';

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA ASISTENCIA JURIDICA
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Asistencia Jurídica en proceso civil, penal ilimitada</font></td>';

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
		if ($rowRespuestaAsistencia9['Asistenciajuridica'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['Asistenciajuridica'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia9['Asistenciajuridica'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['Asistenciajuridica'] . '</font></center></td>';
		}
	}

	$cont13 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURA A NIVEL NACIONAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Asistencia en viajes con cobertura a nivel nacional</font></td>';

$queryp3 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaqueryp3 =  $conexion->query($queryp3);

$contp3 = 1;

while ($rowRespuestap3 = mysqli_fetch_assoc($respuestaqueryp3)) {

	$nombreAseguradora = nombreAseguradora($rowRespuestap3['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuestap3['Aseguradora'], $rowRespuestap3['Producto']);

	$queryConsultaAsistencia9 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia9 =  $conexion->query($queryConsultaAsistencia9);
	$rowRespuestaAsistencia9 = mysqli_fetch_assoc($respuestaqueryAsistencia9);

	if ($contp3 % 2 == 0) {
		if ($rowRespuestaAsistencia9['asistenciaNacional'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['asistenciaNacional'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia9['asistenciaNacional'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['asistenciaNacional'] . '</font></center></td>';
		}
	}

	$contp3 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURA ACCIDENTES PERSONALES
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Accidentes personales</font></td>';

$queryp4 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaqueryp4 =  $conexion->query($queryp4);

$contp4 = 1;

while ($rowRespuestap4 = mysqli_fetch_assoc($respuestaqueryp4)) {

	$nombreAseguradora = nombreAseguradora($rowRespuestap4['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuestap4['Aseguradora'], $rowRespuestap4['Producto']);

	$queryConsultaAsistencia9 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia9 =  $conexion->query($queryConsultaAsistencia9);
	$rowRespuestaAsistencia9 = mysqli_fetch_assoc($respuestaqueryAsistencia9);

	if ($contp4 % 2 == 0) {
		if ($rowRespuestaAsistencia9['Accidentespersonales'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['Accidentespersonales'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia9['Accidentespersonales'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['Accidentespersonales'] . '</font></center></td>';
		}
	}

	$contp4 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURA AUXILIO PERDIDA PATRIMONIAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Auxilio perdida
patrimonial</font></td>';

$queryp5 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaqueryp5 =  $conexion->query($queryp5);

$contp5 = 1;

while ($rowRespuestap5 = mysqli_fetch_assoc($respuestaqueryp5)) {

	$nombreAseguradora = nombreAseguradora($rowRespuestap5['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuestap5['Aseguradora'], $rowRespuestap5['Producto']);

	$queryConsultaAsistencia9 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia9 =  $conexion->query($queryConsultaAsistencia9);
	$rowRespuestaAsistencia9 = mysqli_fetch_assoc($respuestaqueryAsistencia9);

	if ($contp5 % 2 == 0) {
		if ($rowRespuestaAsistencia9['auxilioPerdidaPatrimonial'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['auxilioPerdidaPatrimonial'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia9['auxilioPerdidaPatrimonial'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['auxilioPerdidaPatrimonial'] . '</font></center></td>';
		}
	}

	$contp5 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA COBERTURA AUXILIO PERDIDA PATRIMONIAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Auxilio perdida
patrimonial terrorismo</font></td>';

$queryp6 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaqueryp6 =  $conexion->query($queryp6);

$contp6 = 1;

while ($rowRespuestap6 = mysqli_fetch_assoc($respuestaqueryp6)) {

	$nombreAseguradora = nombreAseguradora($rowRespuestap6['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuestap6['Aseguradora'], $rowRespuestap6['Producto']);

	$queryConsultaAsistencia9 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia9 =  $conexion->query($queryConsultaAsistencia9);
	$rowRespuestaAsistencia9 = mysqli_fetch_assoc($respuestaqueryAsistencia9);

	if ($contp6 % 2 == 0) {
		if ($rowRespuestaAsistencia9['auxilioperdidapatrimonialterrorismo'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['auxilioperdidapatrimonialterrorismo'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia9['auxilioperdidapatrimonialterrorismo'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;">' . $rowRespuestaAsistencia9['auxilioperdidapatrimonialterrorismo'] . '</font></center></td>';
		}
	}

	$contp6 += 1;
}

$html4 .= '</tr>';




//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA TRANSPORTE PT
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Gastos de Transporte</font></td>';

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
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia10['Gastosdetransportept'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia10['Gastosdetransportept'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia10['Gastosdetransportept'] . '</font></center></td>';
		}
	}


	$cont14 += 1;
}

$html4 .= '</tr>';


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA Perjuicios Extrapatrimoniales
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Perjuicios Extra patrimoniales</font></td>';

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
		if ($rowRespuestaAsistencia11['PerjuiciosExtrapatrimoniales'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia11['PerjuiciosExtrapatrimoniales'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia11['PerjuiciosExtrapatrimoniales'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia11['PerjuiciosExtrapatrimoniales'] . '</font></center></td>';
		}
	}



	$cont15 += 1;
}

$html4 .= '</tr>';
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA AUXILIO DE PARALIZACION DEL VEHÍCULO
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="puntos fondo" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Auxilio de paralización del vehículo</font></td>';

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
		if ($rowRespuestaAsistencia12['paralizacionvehiculo'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia12['paralizacionvehiculo'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia12['paralizacionvehiculo'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia12['paralizacionvehiculo'] . '</font></center></td>';
		}
	}

	$cont16 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA VEHICULO REEMPLAZO PERDIDA PARCIAL
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class ="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Obligaciones financieras</font></td>';

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
		if ($rowRespuestaAsistencia13['obligacionfinanciera'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia13['obligacionfinanciera'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia13['obligacionfinanciera'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center;font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia13['obligacionfinanciera'] . '</font></center></td>';
		}
	}

	$cont17 += 1;
}

$html4 .= '</tr>';


//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA Transporte del vehículo recuperado
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Gastos funerarios</font></td>';

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
		if ($rowRespuestaAsistencia15['gastosfunerarios'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia15['gastosfunerarios'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia15['gastosfunerarios'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia15['gastosfunerarios'] . '</font></center></td>';
		}
	}


	$cont19 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA Transporte del vehículo recuperado
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Gastos recuperación vehículo hurtado</font></td>';

$queryp21 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaqueryp21 =  $conexion->query($queryp21);
$contp19 = 1;
while ($rowRespuestap21 = mysqli_fetch_assoc($respuestaqueryp21)) {

	$nombreAseguradora = nombreAseguradora($rowRespuestap21['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuestap21['Aseguradora'], $rowRespuestap21['Producto']);

	$queryConsultaAsistencia15 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia15 =  $conexion->query($queryConsultaAsistencia15);
	$rowRespuestaAsistencia15 = mysqli_fetch_assoc($respuestaqueryAsistencia15);

	if ($contp19 % 2 == 0) {
		if ($rowRespuestaAsistencia15['gastosrecuperacion'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia15['gastosrecuperacion'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia15['gastosrecuperacion'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia15['gastosrecuperacion'] . '</font></center></td>';
		}
	}


	$contp19 += 1;
}

$html4 .= '</tr>';

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//CONSULTA Transporte del vehículo recuperado
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

$html4 .= '<tr>';
$html4 .= '<td class="fondo puntos" style="width:25%; text-align: center; font-family:dejavusanscondensedb;"><font size="8">Gastos de grúa, transp. y protección veh. Accidentado</font></td>';

$querypp21 = "SELECT * FROM ofertas WHERE `id_cotizacion` = $identificador AND `seleccionar` = 'Si'";
$respuestaquerypp21 =  $conexion->query($querypp21);
$cont19 = 1;
while ($rowRespuestapp21 = mysqli_fetch_assoc($respuestaquerypp21)) {

	$nombreAseguradora = nombreAseguradora($rowRespuestapp21['Aseguradora']);
	$nombreProducto = productoAseguradora($rowRespuestapp21['Aseguradora'], $rowRespuestapp21['Producto']);

	$queryConsultaAsistencia15 = "SELECT * FROM asistencias WHERE `aseguradora` LIKE '$nombreAseguradora' AND `producto` LIKE '$nombreProducto'";
	$respuestaqueryAsistencia15 =  $conexion->query($queryConsultaAsistencia15);
	$rowRespuestaAsistencia15 = mysqli_fetch_assoc($respuestaqueryAsistencia15);

	if ($cont19 % 2 == 0) {
		if ($rowRespuestaAsistencia15['gastosgrua'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia15['gastosgrua'] . '</font></center></td>';
		}
	} else {
		if ($rowRespuestaAsistencia15['gastosgrua'] == "Si ampara") {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;text-align: center;"><img style="width:16px;" src="../../../vistas/img/logos/cheque.png" alt=""></td>';
		} else {
			$html4 .= '<td class="puntos fondo2" style="width:' . $valorTabla . '%;"><center><font size="7"style="text-align: center; font-family:dejavusanscondensed;">' . $rowRespuestaAsistencia15['gastosgrua'] . '</font></center></td>';
		}
	}


	$cont19 += 1;
}

$html4 .= '</tr>';



$html4 .= '</table>';


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
	$html6 .= '<td class="redondeotabla" style ="border-radius:50px; width: 100%;  background-color: #' . $color . '; color:white; font-family:dejavusanscondensedb; " colspan="' . ($fila6 + 1) . '"><div style="font-size:3pt">&nbsp;</div>OPCIÓN ' . $contador . '<div style="font-size:3pt">&nbsp;</div></td>';
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
	} else if ($rowRespuesta29['Aseguradora'] == 'Seguros Estado') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/estado.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'HDI Seguros') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/hdi.png" alt=""></td>';
	} else if ($rowRespuesta29['Aseguradora'] == 'Seguros HDI') {
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
	} else if ($rowRespuesta29['Aseguradora'] == 'Aseguradora Solidaria') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/solidaria.png" alt=""></td>';
	}else if ($rowRespuesta29['Aseguradora'] == 'Seguros Mundial') {
		$html6 .= '<td style="width:40%;text-align: center;">
		<div style="font-size:6pt">&nbsp;</div>
		<img style="width:75px;" src="../../../vistas/img/logos/mundial.png" alt=""></td>';
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
$html7 .= '<td style ="width: 100%;" colspan="' . ($fila6 + 1) . '"><font  size="18" style="text-align: center;">Queremos sugerirte <font style="color: #EC8923;">las '.$asegRecomendada.' mejores</font> aseguradoras</font></td>';
$html7 .= '</tr>';

$html7 .= '</table>';



$pdf->SetXY(80, 130);
$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(33.5, 169);
$pdf->Cell(10, 0, 'Si quieres', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'BI', 15);
$pdf->SetTextColor(15, 178, 241);
$pdf->SetXY(98.4, 169);
$pdf->Cell(10, 0, ' comparar las coberturas y asistencias', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(163, 169);
$pdf->Cell(10, 0, 'de todas', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 15);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(70, 176);
$pdf->Cell(10, 0, 'las aseguradoras, revisa', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'BI', 15);
$pdf->SetTextColor(235, 135, 39);
$pdf->SetXY(127, 176);
$pdf->Cell(10, 0, ' el siguiente cuadro', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');

$pdf->SetFont('dejavusanscondensed', 'I', 11);
$pdf->SetTextColor(104, 104, 104);
$pdf->SetXY(101, 183);
$pdf->Cell(10, 0, '(Recuerda que este icono       significa Si Aplica o Si Cubre)', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');


//$pdf->Cell(210, 0, 'las aseguradoras, revisa el siguiente cuadro', 0, $ln = 0, 'C', 0, '', 0, false, 'C', 'C');
$pdf->Ln();

$pdf->writeHTML($html3, true, false, true, false, '');

$pdf->Ln();
$pdf->writeHTML($html4, true, false, true, false, '');
$pdf->Ln();
//$pdf->writeHTML($html5, true, false, true, false, '');
//$pdf->Ln();


//$pdf->lastPage();


if($asegRecomendada > 0){

$pdf->AddPage();
$pdf->writeHTML($html7, true, false, true, false, '');
$pdf->writeHTML($html6, true, false, true, false, '');

}




// Consulta el servicio del vehiculo segun su codigo
function servise($dato) {
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
function claseV($dato) {
	$service = "";

	if ($dato == "UTILITARIOS DEPORTIVOS") {
		$service = "UTILITARIOS DE.";
	} else {
		$service = $dato;
	}
	return $service;
}


// Calcula la Edad a partir de la Fecha de Nacimiento
function calculaedad($fechaNacimiento) {

	list($ano, $mes, $dia) = explode("-", $fechaNacimiento);
	$ano_diferencia = date("Y") - $ano;
	$mes_diferencia = date("m") - $mes;
	$dia_diferencia = date("d") - $dia;
	if ($dia_diferencia < 0 || $mes_diferencia < 0)
		$ano_diferencia--;
	return $ano_diferencia;
}


// Consulta el nombre del Departamento segun el Codigo
function DptoVehiculo($codigoDpto){

	if ($codigoDpto == 1){
		$nomDpto = "Amazonas"; }
	else if ($codigoDpto == 2){
		$nomDpto = "Antioquia"; }
	else if ($codigoDpto == 3){
		$nomDpto = "Arauca"; }
	else if ($codigoDpto == 4){
		$nomDpto = "Atlántico"; }
	else if ($codigoDpto == 5){
		$nomDpto = "Barranquilla"; }

	else if ($codigoDpto == 6){
		$nomDpto = "Bogotá"; }
	else if ($codigoDpto == 7){
		$nomDpto = "Bolívar"; }
	else if ($codigoDpto == 8){
		$nomDpto = "Boyacá"; }
	else if ($codigoDpto == 9){
		$nomDpto = "Caldas"; }
	else if ($codigoDpto == 10){
		$nomDpto = "Caquetá"; }

	else if ($codigoDpto == 11){
		$nomDpto = "Casanare"; }
	else if ($codigoDpto == 12){
		$nomDpto = "Cauca"; }
	else if ($codigoDpto == 13){
		$nomDpto = "Cesar"; }
	else if ($codigoDpto == 14){
		$nomDpto = "Chocó"; }
	else if ($codigoDpto == 15){
		$nomDpto = "Córdoba"; }

	else if ($codigoDpto == 16){
		$nomDpto = "Cundinamarca"; }
	else if ($codigoDpto == 17){
		$nomDpto = "Guainía"; }
	else if ($codigoDpto == 18){
		$nomDpto = "La Guajira"; }
	else if ($codigoDpto == 19){
		$nomDpto = "Guaviare"; }
	else if ($codigoDpto == 20){
		$nomDpto = "Huila"; }

	else if ($codigoDpto == 21){
		$nomDpto = "Magdalena"; }
	else if ($codigoDpto == 22){
		$nomDpto = "Meta"; }
	else if ($codigoDpto == 23){
		$nomDpto = "Nariño"; }
	else if ($codigoDpto == 24){
		$nomDpto = "Norte de Santander"; }
	else if ($codigoDpto == 25){
		$nomDpto = "Putumayo"; }

	else if ($codigoDpto == 26){
		$nomDpto = "Quindío"; }
	else if ($codigoDpto == 27){
		$nomDpto = "Risaralda"; }
	else if ($codigoDpto == 28){
		$nomDpto = "San Andrés"; }
	else if ($codigoDpto == 29){
		$nomDpto = "Santander"; }
	else if ($codigoDpto == 30){
		$nomDpto = "Sucre"; }

	else if ($codigoDpto == 31){
		$nomDpto = "Tolima"; }
	else if ($codigoDpto == 32){
		$nomDpto = "Valle del Cauca"; }
	else if ($codigoDpto == 33){
		$nomDpto = "Vaupés"; }
	else if ($codigoDpto == 34){
		$nomDpto = "Vichada"; } 
	else {
		$nomDpto = "No Disponible";
	}
	return $nomDpto;

}


function nombreAseguradora($data) {
	$resultado = "";
	if ($data == 'Seguros del Estado') {
		$resultado = "Estado";
	} else if($data == 'Seguros Estado'){
		$resultado = "Estado";
	}else if ($data == 'Seguros Bolivar') {
		$resultado = "Bolivar";
	} else if ($data == 'Axa Colpatria') {
		$resultado = "Axa Colpatria";
	} else if ($data == 'HDI Seguros') {
		$resultado = "HDI";
	} else if ($data == 'Seguros HDI') {
		$resultado = "HDI";
	} else if ($data == 'SBS Seguros') {
		$resultado = "SBS";
	} else if ($data == 'Allianz Seguros') {
		$resultado = "Allianz";
	} else if ($data == 'Equidad Seguros') {
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
	} else if ($data == 'Previsora Seguros') {
		$resultado = "Previsora";
	} else {
		$resultado = $data;
	}
	return $resultado;
}


function productoAseguradora($aseguradora, $producto) {

	$resultado = "";
	if ($aseguradora == 'Seguros del Estado' && $producto == 'Familiar 1000') {
		$resultado = "Familiar 1000";
	} else if ($aseguradora == 'Seguros del Estado' && $producto == 'Familiar 500') {
		$resultado = "Familiar 500";
	} else if ($aseguradora == 'Seguros Bolivar' && $producto == 'Premium') {
		$resultado = "Premium";
	} else if ($aseguradora == 'Seguros Bolivar' && $producto == 'Estandar') {
		$resultado = "Estandar";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'Tradicional') {
		$resultado = "Tradicional";
	} else if ($aseguradora == 'Axa Colpatria' && $producto == 'Plus') {
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
	} else {
		$resultado = $producto;
	}
	return $resultado;
}


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('cotizacionAutos.pdf', 'I');
