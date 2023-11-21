<?php

$DB_host = "localhost";
$DB_user = "grupoasi_cotizautos";
$DB_pass = "M1graci0n123";
$DB_name = "grupoasi_cotizautos";

$enlace = mysqli_connect("$DB_host", "$DB_user", "$DB_pass", "$DB_name");
if (!$enlace) {

  die("Conexion Fallida " . mysqli_connect_error());
}

// mysqli_set_charset($enlace, "utf8");


function obtenerCredenciales($enlace, $tabla, $columnas, $idIntermediario) {
  $query = "SELECT $columnas FROM `$tabla` WHERE `id_intermediario` = '$idIntermediario'";
  $ejecucion = mysqli_query($enlace, $query);
  $numerofilas = mysqli_num_rows($ejecucion);
  $fila = mysqli_fetch_assoc($ejecucion);

  if ($numerofilas > 0) {
      return $fila;
  } else {
      $query2 = "SELECT * FROM `$tabla` WHERE `id_intermediario` = 3";
      $ejecucion2 = mysqli_query($enlace, $query2);
      $fila2 = mysqli_fetch_assoc($ejecucion2);
      return $fila2;
  }
}

// FUNCION PARA OBTENER CREDENCIALES SBS
$creSBS = obtenerCredenciales($enlace, 'Credenciales_SBS2', 'cre_sbs_usuario, cre_sbs_contrasena', $_SESSION['intermediario']);

$cre_sbs_usuario = $creSBS['cre_sbs_usuario'];
$cre_sbs_contrasena = $creSBS['cre_sbs_contrasena']; // Aquí está el cambio

// FUNCION PARA OBTENER CREDENCIALES ALLIANZ
$creAllianz = obtenerCredenciales($enlace, 'Credenciales_Allianz', '*', $_SESSION['intermediario']);

$cre_alli_sslcertfile = $creAllianz['cre_alli_sslcertfile'];
$cre_alli_sslkeyfile = $creAllianz['cre_alli_sslkeyfile'];

$cre_alli_passphrase = $creAllianz['cre_alli_passphrase'];
$cre_alli_partnerid = $creAllianz['cre_alli_partnerid'];

$cre_alli_agentid = $creAllianz['cre_alli_agentid'];
$cre_alli_partnercode = $creAllianz['cre_alli_partnercode'];

$cre_alli_agentcode = $creAllianz['cre_alli_agentcode'];


// FUNCION PARA OBTENER CREDENCIALES ESTADO
$creEstado = obtenerCredenciales($enlace, 'Credenciales_Estado', '*', $_SESSION['intermediario']);

$cre_est_usuario = $creEstado['cre_est_usuario'];
$cre_equ_contrasena = $creEstado['cre_equ_contrasena'];
$Cre_Est_Entity_Id = $creEstado['Cre_Est_Entity_Id'];
$cre_est_zona = $creEstado['cre_est_zona'];


// FUNCION PARA OBTENER CREDENCIALES AXA
$creAXA = obtenerCredenciales($enlace, 'Credenciales_AXA', '*', $_SESSION['intermediario']);

$cre_axa_sslcertfile = $creAXA['cre_axa_sslcertfile'];
$cre_axa_sslkeyfile = $creAXA['cre_axa_sslkeyfile'];
$cre_axa_passphrase = $creAXA['cre_axa_passphrase'];
$cre_axa_codigoDistribuidor = $creAXA['cre_axa_codigoDistribuidor'];
$cre_axa_idTipoDistribuidor = $creAXA['cre_axa_idTipoDistribuidor'];
$cre_axa_codigoDivipola = $creAXA['cre_axa_codigoDivipola'];
$cre_axa_canal = $creAXA['cre_axa_canal'];
$cre_axa_validacionEventos = $creAXA['cre_axa_validacionEventos'];
$url_axa = $creAXA['url_axa'];

$creSolidaria = obtenerCredenciales($enlace, 'Credenciales_Solidaria', '*', $_SESSION['intermediario']);

$cre_sol_id = $creSolidaria['cre_sol_id'] ?? null;
$id_Intermediario = $creSolidaria['id_Intermediario'] ?? null;
$cre_sol_cod_sucursal = $creSolidaria['cre_sol_cod_sucursal'] ?? null;
$cre_sol_cod_per = $creSolidaria['cre_sol_cod_per'] ?? null;
$cre_sol_cod_tipo_agente = $creSolidaria['cre_sol_cod_tipo_agente'] ?? null;
$cre_sol_cod_agente = $creSolidaria['cre_sol_cod_agente'] ?? null;
$cre_sol_cod_pto_vta = $creSolidaria['cre_sol_cod_pto_vta'] ?? null;
$cre_sol_grant_type = $creSolidaria['cre_sol_grant_type'] ?? null;
$cre_sol_Cookie_token = $creSolidaria['cre_sol_Cookie_token'] ?? null;
$cre_sol_token = $creSolidaria['cre_sol_token'] ?? null;
$cre_sol_fecha_token = $creSolidaria['cre_sol_fecha_token'] ?? null;


// FUNCION PARA OBTENER CREDENCIALES SOLIDARIA
// Repite el proceso para las demás credenciales
// ...



//CREDENCIALES SBS//
// $query = "SELECT cre_sbs_usuario AS cre_sbs_usuario, cre_sbs_contrasena AS cre_sbs_contrasena,  FROM `Credenciales_SBS2` WHERE `id_intermediario` = '" . $_SESSION["intermediario"] . "'";

// $ejecucion = mysqli_query($enlace, $query);
// // echo mysqli_num_rows($ejecucion);
// $numerofilas = mysqli_num_rows($ejecucion);
// $fila = mysqli_fetch_assoc($ejecucion);

// if ($numerofilas > 0) {
//   $cre_sbs_usuario = $fila['cre_sbs_usuario'];
//   $cre_sbs_contrasena = $fila['cre_sbs_contrasena'];
// } else {
//   $query2 = "SELECT * FROM `Credenciales_SBS` WHERE `id_intermediario` = 3";

//   $ejecucion2 = mysqli_query($enlace, $query2);
//   // echo mysqli_num_rows($ejecucion);
//   $numerofilas = mysqli_num_rows($ejecucion2);
//   $fila2 = mysqli_fetch_assoc($ejecucion2);

//   $cre_sbs_usuario = $fila2['cre_sbs_usuario'];
//   $cre_sbs_contrasena = $fila2['cre_sbs_contrasena'];
// }

//CREDENCIALES ALLIANZ//
// $query3 = "SELECT *  FROM `Credenciales_Allianz` WHERE `id_intermediario` = '" . $_SESSION["intermediario"] . "'";

// $ejecucion3 = mysqli_query($enlace, $query3);
// $numerofilas3 = mysqli_num_rows($ejecucion3);
// $fila3 = mysqli_fetch_assoc($ejecucion3);

// if ($numerofilas3 > 0) {
//   $cre_alli_sslcertfile = $fila3['cre_alli_sslcertfile'];
//   $cre_alli_sslkeyfile = $fila3['cre_alli_sslkeyfile'];

//   $cre_alli_passphrase = $fila3['cre_alli_passphrase'];
//   $cre_alli_partnerid = $fila3['cre_alli_partnerid'];

//   $cre_alli_agentid = $fila3['cre_alli_agentid'];
//   $cre_alli_partnercode = $fila3['cre_alli_partnercode'];

//   $cre_alli_agentcode = $fila3['cre_alli_agentcode'];
// } else {
//   $query2 = "SELECT * FROM `Credenciales_Allianz` WHERE `id_intermediario` = 3";

//   $ejecucion2 = mysqli_query($enlace, $query2);
//   $numerofilas = mysqli_num_rows($ejecucion2);
//   $fila2 = mysqli_fetch_assoc($ejecucion2);

//   $cre_alli_sslcertfile = $fila2['cre_alli_sslcertfile'];
//   $cre_alli_sslkeyfile = $fila2['cre_alli_sslkeyfile'];

//   $cre_alli_passphrase = $fila2['cre_alli_passphrase'];
//   $cre_alli_partnerid = $fila2['cre_alli_partnerid'];

//   $cre_alli_agentid = $fila2['cre_alli_agentid'];
//   $cre_alli_partnercode = $fila2['cre_alli_partnercode'];

//   $cre_alli_agentcode = $fila2['cre_alli_agentcode'];
// }

//CREDENCIALES ESTADO//
// $query4 = "SELECT *  FROM `Credenciales_Estado` WHERE `id_intermediario` = '" . $_SESSION["intermediario"] . "'";

// $ejecucion4 = mysqli_query($enlace, $query4);
// $numerofilas4 = mysqli_num_rows($ejecucion4);
// $fila4 = mysqli_fetch_assoc($ejecucion4);

// if ($numerofilas4 > 0) {
//   $cre_est_usuario = $fila4['cre_est_usuario'];
//   $cre_equ_contrasena = $fila4['cre_equ_contrasena'];
//   $Cre_Est_Entity_Id = $fila4['Cre_Est_Entity_Id'];
//   $cre_est_zona = $fila4['cre_est_zona'];
// } else {
//   $query5 = "SELECT * FROM `Credenciales_Estado` WHERE `id_intermediario` = 3";

//   $ejecucion5 = mysqli_query($enlace, $query5);
//   $numerofilas5 = mysqli_num_rows($ejecucion5);
//   $fila5 = mysqli_fetch_assoc($ejecucion5);

//   $cre_est_usuario = $fila5['cre_est_usuario'];
//   $cre_equ_contrasena = $fila5['cre_equ_contrasena'];
//   $Cre_Est_Entity_Id = $fila5['Cre_Est_Entity_Id'];
//   $cre_est_zona = $fila5['cre_est_zona'];
// }

//CREDENCIALES AXA//
// $query6 = "SELECT *  FROM `Credenciales_AXA` WHERE `id_Intermediario` = '" . $_SESSION["intermediario"] . "'";

// $ejecucion6 = mysqli_query($enlace, $query6);
// $numerofilas6 = mysqli_num_rows($ejecucion6);
// $fila6 = mysqli_fetch_assoc($ejecucion6);

// if ($numerofilas4 > 0) {
//   $cre_axa_sslcertfile = $fila6['cre_axa_sslcertfile'];
//   $cre_axa_sslkeyfile = $fila6['cre_axa_sslkeyfile'];
//   $cre_axa_passphrase = $fila6['cre_axa_passphrase'];
//   $cre_axa_codigoDistribuidor = $fila6['cre_axa_codigoDistribuidor'];
//   $cre_axa_idTipoDistribuidor = $fila6['cre_axa_idTipoDistribuidor'];
//   $cre_axa_codigoDivipola = $fila6['cre_axa_codigoDivipola'];
//   $cre_axa_canal = $fila6['cre_axa_canal'];
//   $cre_axa_validacionEventos = $fila6['cre_axa_validacionEventos'];
//   $url_axa =$fila6['url_axa'];
// } else {
//   $query7 = "SELECT * FROM `Credenciales_AXA` WHERE `id_Intermediario` = 3";

//   $ejecucion7 = mysqli_query($enlace, $query7);
//   $numerofilas7 = mysqli_num_rows($ejecucion5);
//   $fila7 = mysqli_fetch_assoc($ejecucion7);

//   $cre_axa_sslcertfile = $fila7['cre_axa_sslcertfile'];
//   $cre_axa_sslkeyfile = $fila7['cre_axa_sslkeyfile'];
//   $cre_axa_passphrase = $fila7['cre_axa_passphrase'];
//   $cre_axa_codigoDistribuidor = $fila7['cre_axa_codigoDistribuidor'];
//   $cre_axa_idTipoDistribuidor = $fila7['cre_axa_idTipoDistribuidor'];
//   $cre_axa_codigoDivipola = $fila7['cre_axa_codigoDivipola'];
//   $cre_axa_canal = $fila7['cre_axa_canal'];
//   $cre_axa_validacionEventos = $fila7['cre_axa_validacionEventos'];
//   $url_axa = $fila7['url_axa'];
// }

//CREDENCIALES SOLIDARIA//



//echo ($fila["Num_recargas"]);



if ($_SESSION["permisos"]["Cotizarlivianos"] != "x") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}


if ($_SESSION['permisos']['id_rol'] == '19') {
  echo '<script>

    window.location = "https://integradoor.com/app/cotizar";

  </script>';

  return;
  
  // Detén la ejecución del script actual
}




?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Cotizar Todo Riesgo Livianos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Cotizar Vehiculo liviano</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">


      <div class="box-body">

        <div id="formularioResumen">

          <!-- FORMULARIO RESUMEN ASEGURADO -->
          <form method="Post" id="formResumAseg">
            <div id="resumenAsegurado">
              <div class="col-lg-12" id="headerAsegurado">
                <div class="row row-aseg">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <label for="">DATOS DEL ASEGURADO</label>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <div id="masAsegurado">
                      <p id="masA" onclick="masAseg();">Ver mas <i class="fa fa-plus-square-o"></i></p>
                    </div>
                    <div id="menosAsegurado">
                      <p id="menosA" onclick="menosAseg();">Ver menos <i class="fa fa-minus-square-o"></i></p>
                    </div>
                  </div>
                </div>
              </div>

              <div id="DatosAsegurado">
                <div class="col-lg-12 form-resumAseg">
                  <div class="row">

                    <div class="col-xs-12 col-sm-6 col-md-3" id="contenSuperiorPlaca">
                      <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group" id="conocesPlaca">
                          <label>Conoces la Placa?</label>
                          <div class="conten-conocesPlaca">
                            <label for="Si">Si</label>
                            <input type="radio" name="conocesPlaca" id="txtConocesLaPlacaSi" value="Si" checked>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="No">No</label>
                            <input type="radio" name="conocesPlaca" id="txtConocesLaPlacaNo" value="No" required>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group" id="contenPlaca">
                          <label for="placaVeh">Placa</label>
                          <input type="text" minlength="6" maxlength="6" class="form-control" id="placaVeh" required placeholder="Placa">
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 form-group" id="contenCeroKM">
                          <label>Vehiculo 0 KM?</label>
                          <div class="conten-ceroKM">
                            <label for="Si">Si</label>
                            <input type="radio" name="ceroKM" id="txtEsCeroKmSi" value="Si" required>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="No">No</label>
                            <input type="radio" name="ceroKM" id="txtEsCeroKmNo" value="No" checked>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <input type="hidden" class="form-control" id="intermediario" value="<?php echo $_SESSION["intermediario"]; ?>">
                      <input type="hidden" class="form-control" id="cotRestanv" value="<?php echo $_SESSION["cotRestantes"]; ?>">
                      <input type="hidden" class="form-control" id="cotRestanInter" value="<?php echo $_SESSION["cotRestantesInter"]; ?>">
                      <label for="tipoDocumentoID">Tipo de Documento</label>
                      <select class="form-control" id="tipoDocumentoID" required>
                        <option value=""></option>
                        <option value="1" selected>Cedula de ciudadania</option>
                        <option value="2">NIT</option>
                        <option value="3">Cédula de extranjería</option>
                        <option value="4">Tarjeta de identidad</option>
                        <option value="5">Pasaporte</option>
                        <option value="6">Carné diplomático</option>
                        <option value="7">Sociedad extranjera sin NIT en Colombia</option>
                        <option value="8">Fideicomiso</option>
                        <option value="9">Registro civil de nacimiento</option>
                      </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="numDocumentoID">No. Documento</label>
                      <input type="text" maxlength="10" class="form-control" id="numDocumentoID" required placeholder="Número de Documento">
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtNombres">Nombre Completo</label>
                      <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 nomAseg">
                          <input type="text" class="form-control" name="nombres" id="txtNombres" placeholder="Nombres" required>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 apeAseg">
                          <input type="text" class="form-control" name="apellidos" id="txtApellidos" placeholder="Apellidos" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="">Fecha de Nacimiento</label>
                      <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 conten-dia">
                          <select class="form-control fecha-nacimiento" name="dianacimiento" id="dianacimiento" required>
                            <option value="">Dia</option>
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                              if (strlen($i) == 1) { ?>
                                <option value="<?php echo "0" . $i ?>"><?php echo "0" . $i ?></option><?php
                                                                                                    } else { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option><?php
                                                                                                    }
                                                                                                  }
                                                                                          ?>
                          </select>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 conten-mes">
                          <select class="form-control fecha-nacimiento" name="mesnacimiento" id="mesnacimiento" required>
                            <option value="" selected>Mes</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                          </select>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 conten-anio">
                          <select class="form-control fecha-nacimiento" name="anionacimiento" id="anionacimiento" required>
                            <option value="">Año</option>
                            <?php
                            for ($j = 1920; $j <= 2021; $j++) {
                            ?><option value="<?php echo $j ?>"><?php echo $j ?></option><?php
                                                                                      }
                                                                                        ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="genero">Genero</label>
                      <select class="form-control" id="genero" required>
                        <option value="" selected>Género</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                      </select>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="estadoCivil">Estado Civil</label>
                      <select class="form-control" id="estadoCivil" required>
                        <option value="" selected>Estado Civil</option>
                        <option value="1">Soltero (a)</option>
                        <option value="2">Casado (a)</option>
                        <option value="3">Viudo (a)</option>
                        <option value="4">Divorciado (a)</option>
                        <option value="5">Unión Libre</option>
                        <option value="6">Separado (a)</option>
                      </select>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="correo">Correo</label>
                      <input type="text" class="form-control" id="txtCorreo" placeholder="Correo">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="celular">Celular</label>
                      <input type="text" class="form-control" id="txtCelular" placeholder="Celular">
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 form-group" id="contenBtnConsultarPlaca">
                      <button class="btn btn-primary btn-block" id="btnConsultarPlaca">Siguiente</button>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <div id="loaderPlaca"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <!-- FORMULARIO VEHICULO MANUAL -->
          
            <div id="formularioVehiculo">
              <div class="col-lg-12" id="headerFormVeh">
                <div class="row row-formVehManual">
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <label for="">CONSULTA MANUAL DEL VEHICULO POR FASECOLDA</label>
                  </div>
                </div>
              </div>
              
              <div class ="col-lg-12 form-consulVeh">
                <div class= "row">
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                        <label for="clase">Código Fasecolda</label>
                        <input type="text" maxlength="10" class="form-control" id="fasecoldabuscadormanual" placeholder="Número de fasecolda">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                        <label for="clase">Modelo Vehículo</label>
                        <input type="text" maxlength="10" class="form-control" id="modelobuscadormanual"  placeholder="Modelo Vehículo">
                    </div>
                    
                    <div style="padding-top: 25px !important;" class="col-xs-12 col-sm-6 col-md-2 form-group">
                        <button class="btn btn-primary btn-block" id="btnConsultarVehmanualbuscador">Consultar Vehículo</button>
                    </div>
                </div>
              </div>
              
                <form method="Post" id="formVehManual">
              <div class="col-lg-12" id="headerFormVeh">
                <div class="row row-formVehManual">
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <label for="">CONSULTA MANUAL DEL VEHICULO POR CARACTERISTICAS</label>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-12 form-consulVeh">
                <div class="row">
                    
                    
                <div class="col-md-12">
                    <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                        <label for="clase">Clase Vehículo</label>
                        <select class="form-control" name="clase" id="clase" required="">
                          <option value="" selected>Seleccione la Clase</option>
                          <option value="AUTOMOVIL">AUTOMOVIL</option>
                          <option value="BUS">BUS</option>
                          <option value="CAMIONETA">CAMIONETA</option>
                          <option value="FURGONETA">FURGONETA</option>
                          <option value="MOTOCARRO">MOTOCARRO</option>
                          <option value="MOTOS">MOTOS</option>
                          <option value="PESADO">PESADO</option>
                          <option value="PICKUP">PICKUP</option>
                        </select>
                    </div>
                
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                        <label for="Marca">Marca Vehículo</label>
                        <select class="form-control" name="Marca" id="Marca" required></select>
                    </div>
                    
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                        <label for="linea">Modelo Vehículo</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <div id="loadingModelo"></div>
                            </div>
                            <select class="form-control" name="edad" id="edad" required></select>
                        </div>
                    </div>


                  <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                    <label for="linea">Linea Vehículo</label>
                    <select class="form-control" name="linea" id="linea" required></select>
                  </div>
                </div>
                </div>

                
                
                <div class="col-xs-12 col-sm-6 col-md-12">
                    <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <div id="referenciados"></div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <div id="referenciatres"></div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div id="loaderVehiculo"></div>
                    </div>
                    
                  </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-2 form-group btnConsultarVeh">
                            <button class="btn btn-primary btn-block" id="btnConsultarVeh">Consultar Vehículo</button>
                        </div>
                    </div>
                </div>
                
                
                

                  

                
                </div>
              </div>
              </form>
            </div>
          

          <!-- FORMULARIO RESUMEN VEHICULO -->
          <form method="Post" id="formResumVeh">
            <div id="resumenVehiculo">
              <div class="col-lg-12" id="headerVehiculo">
                <div class="row row-veh">
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <label for="">DATOS DEL VEHICULO</label>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3">
                    <div id="masVehiculo">
                      <p id="masVeh" onclick="masVeh();">Ver mas <i class="fa fa-plus-square-o"></i></p>
                    </div>
                    <div id="menosVehiculo">
                      <p id="menosVeh" onclick="menosVeh();">Ver menos <i class="fa fa-minus-square-o"></i></p>
                    </div>
                  </div>
                </div>
              </div>

              <div id="DatosVehiculo">
                <div class="col-lg-12 form-resumVeh">
                  <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtPlacaVeh">Placa</label>
                      <input type="text" class="form-control" id="txtPlacaVeh" placeholder="" disabled>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtFasecolda">Fasecolda</label>
                      <input type="text" class="form-control" id="txtFasecolda" placeholder="" required>

                      <div class="buscarFasecolda">
                        <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 20 20" fill="currentColor" style="
                                position: absolute;
                                width: 18px;
                                right: 22px;
                                top: 34px;
                                cursor:pointer;
                            ">
                          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtModeloVeh">Modelo</label>
                      <input type="text" class="form-control" id="txtModeloVeh" placeholder="" disabled>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtClaseVeh">Clase</label>
                      <input type="text" class="form-control" id="txtClaseVeh" placeholder="" disabled>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtMarcaVeh">Marca</label>
                      <input type="text" class="form-control classMarcaVeh" id="txtMarcaVeh" placeholder="" disabled>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtReferenciaVeh">Línea</label>
                      <input type="text" class="form-control classReferenciaVeh" id="txtReferenciaVeh" placeholder="" disabled>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtValorFasecolda">Valor Asegurado</label>
                      <input type="text" class="form-control" id="txtValorFasecolda" placeholder="" required>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtTipoUsoVehiculo">Tipo de Uso</label>
                      <select class="form-control" id="txtTipoUsoVehiculo" required>
                        <option value=""></option>
                        <option value="Particular" selected>Particular</option>
                        <option value="Trabajo">Trabajo</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="txtTipoServicio">Tipo de Servicio</label>
                      <select class="form-control" id="txtTipoServicio" required>
                        <option value=""></option>
                        <option value="14" selected>Particular</option>
                        <option value="11">Publico Municipal</option>
                        <option value="12">Publico Intermunicipal</option>
                      </select>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="DptoCirculacion">Departamento de Circulación</label>
                      <select class="form-control" id="DptoCirculacion" required>
                        <option value=""></option>
                        <option value="1">Amazonas</option>
                        <option value="2">Antioquia</option>
                        <option value="3">Arauca</option>
                        <option value="4">Atlántico</option>
                        <option value="5">Barranquilla</option>

                        <option value="6">Bogotá</option>
                        <option value="7">Bolívar</option>
                        <option value="8">Boyacá</option>
                        <option value="9">Caldas</option>
                        <option value="10">Caquetá</option>

                        <option value="11">Casanare</option>
                        <option value="12">Cauca</option>
                        <option value="13">Cesar</option>
                        <option value="14">Chocó</option>
                        <option value="15">Córdoba</option>

                        <option value="16">Cundinamarca</option>
                        <option value="17">Guainía</option>
                        <option value="18">La Guajira</option>
                        <option value="19">Guaviare</option>
                        <option value="20">Huila</option>

                        <option value="21">Magdalena</option>
                        <option value="22">Meta</option>
                        <option value="23">Nariño</option>
                        <option value="24">Norte de Santander</option>
                        <option value="25">Putumayo</option>

                        <option value="26">Quindío</option>
                        <option value="27">Risaralda</option>
                        <option value="28">San Andrés</option>
                        <option value="29">Santander</option>
                        <option value="30">Sucre</option>

                        <option value="31">Tolima</option>
                        <option value="32">Valle del Cauca</option>
                        <option value="33">Vaupés</option>
                        <option value="34">Vichada</option>
                      </select>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="ciudadCirculacion">Ciudad de Circulación</label>
                      <select class="form-control" id="ciudadCirculacion" required></select>
                      <div id="listaCiudades"></div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-3">
                      <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5 form-group">
                          <label style="display: none;">Es Oneroso?</label>
                          <div class="conten-oneroso" style="display: none;">
                            <label for="Si">Si</label>
                            <input type="radio" name="oneroso" id="esOnerosoSi" value="Si">&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="No">No</label>
                            <input type="radio" name="oneroso" id="esOnerosoNo" value="No" required checked>
                          </div>
                        </div>
                        <div class="col-xs-7 col-sm-7 col-md-7 form-group" id="contenBenefOneroso">
                          <label for="benefOneroso">Beneficiario</label>
                          <input type="text" class="form-control" id="benefOneroso">
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div id="contenBtnCotizar">
              <div class="col-lg-12 conten-cotizar">
                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                    <button class="btn btn-primary btn-block" id="btnCotizar">Cotizar Ofertas</button>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                    <div id="loaderOferta"></div>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <div id="contenParrilla" style="display: none;">
            <div class="col-lg-12 form-parrilla">
              <div class="row row-parrilla">
                <div class="col-xs-12 col-sm-6 col-md-3">
                  <label for="">PARRILLA DE COTIZACIÓNES</label>
                </div>
              </div>
            </div>
            <div id="cardCotizacion">
              <div class="col-lg-12">
                <div class="card-ofertas">
                  <div class="row card-body">
                    <div class="card-body col-sm-6 col-md-6">
                      <div style="margin: 20px 25px;" class="exitosas">
                        <p style="color: #88d600;"><b>Aseguradoras cotizadas</b></p>
                      </div>
                    </div>
                    <div class="card-body col-sm-6 col-md-6">
                      <div style="margin: 20px 25px;" class="fallidas">
                        <p style="color: #88d600;"><b>Aseguradoras no cotizadas</b></p>
                      </div>
                    </div>
                  </div>
                  <div class="row button-recotizar" style="display: none; margin:5px">
                    <div class="col-md-6"></div>
                    <div class="col-xs-12 col-sm-12 col-md-3 form-group">
                      <button class="btn btn-primary btn-block" id="btnReCotizarFallidas">Recotizar Ofertas Fallidas</button>
                    </div>
                    <div class="col-md-3"></div>
                  </div>
                </div>
              </div>
            </div>

            <div id="contenCotizacionPDF" style="margin-top: 15px;">
            </div>
          </div>
        </div>

        <!-- CAMPOS OCULTOS PARA OPTENER LA INFORMACION-->
        <div style="display: none;">
          <label>Id Asegurado</label>
          <input type="hidden" name="idCliente" id="idCliente">
          <label>Celular Asegurado</label>
          <input type="text" name="celularAseg" id="celularAseg" value="">
          <label>Email Asegurado</label>
          <input type="text" name="emailAseg" id="emailAseg" value="">
          <label>Direccion Asegurado</label>
          <input type="text" name="direccionAseg" id="direccionAseg" value="CALLE 70 7T2-16">
          <label>ClaseVehiculo</label>
          <input type="text" name="CodigoClase" id="CodigoClase">
          <label>MarcaVehiculo</label>
          <input type="text" name="CodigoMarca" id="CodigoMarca">
          <label>LineaVehiculo</label>
          <input type="text" name="CodigoLinea" id="CodigoLinea">
          <label>LimiteRCESTADO</label>
          <input type="text" name="LimiteRC" id="LimiteRC" value="6">
          <label>CoberturaEstado</label>
          <input type="text" name="CoberturaEstado" id="CoberturaEstado" value="1">
          <label>ValorAccesorios</label>
          <input type="text" name="ValorAccesorios" id="ValorAccesorios" value="0">
          <label>CodigoVerificacion</label>
          <input type="text" name="CodigoVerificacion" id="CodigoVerificacion" value="0">
          <label>AniosSiniestro</label>
          <input type="text" name="AniosSiniestro" id="AniosSiniestro" value="0">
          <label>AniosAsegurados</label>
          <input type="text" name="AniosAsegurados" id="AniosAsegurados" value="0">
          <label>NivelEducativo</label>
          <input type="text" name="NivelEducativo" id="NivelEducativo" value="4">
          <label>Estrato</label>
          <input type="text" name="Estrato" id="Estrato" value="3">
          <label>TokenPrevisora</label>
          <input type="text" name="previsoraToken" id="previsoraToken">

          <!--ESTADO-->
          <input type="text" class="form-control" id="cre_est_usuario" value="<?php echo $cre_est_usuario; ?>">
          <input type="text" class="form-control" id="cre_equ_contrasena" value="<?php echo $cre_equ_contrasena; ?>">
          <input type="text" class="form-control" id="Cre_Est_Entity_Id" value="<?php echo $Cre_Est_Entity_Id; ?>">
          <input type="text" class="form-control" id="cre_est_zona" value="<?php echo $cre_est_zona; ?>">


          <!--ZURICH-->
          <input type="text" class="form-control" id="cre_zur_nomUsu" value="<?php echo $_SESSION["cre_zur_nomUsu"]; ?>">
          <input type="text" class="form-control" id="cre_zur_passwd" value="<?php echo $_SESSION["cre_zur_passwd"]; ?>">
          <input type="text" class="form-control" id="cre_zur_intermediaryEmail" value="<?php echo $_SESSION["cre_zur_intermediaryEmail"]; ?>">
          <input type="text" class="form-control" id="cre_zur_Cookie" value="<?php echo $_SESSION["cre_zur_Cookie"]; ?>">
          <input type="text" class="form-control" id="cre_zur_token" value="<?php echo $_SESSION["cre_zur_token"]; ?>">
          <input type="text" class="form-control" id="cre_zur_fecha_token" value="<?php echo $_SESSION["cre_zur_fecha_token"]; ?>">

          <!--SOLIDARIA-->
          <input type="text" class="form-control" id="cre_sol_cod_sucursal" value="<?php echo $cre_sol_cod_sucursal; ?>">
          <input type="text" class="form-control" id="cre_sol_cod_per" value="<?php echo $cre_sol_cod_per; ?>">
          <input type="text" class="form-control" id="cre_sol_cod_tipo_agente" value="<?php echo $cre_sol_cod_tipo_agente; ?>">
          <input type="text" class="form-control" id="cre_sol_cod_agente" value="<?php echo $cre_sol_cod_agente; ?>">
          <input type="text" class="form-control" id="cre_sol_cod_pto_vta" value="<?php echo $cre_sol_cod_pto_vta; ?>">
          <input type="text" class="form-control" id="cre_sol_grant_type" value="<?php echo $cre_sol_grant_type; ?>">
          <input type="text" class="form-control" id="cre_sol_Cookie_token" value="<?php echo $cre_sol_Cookie_token; ?>">
          <input type="text" class="form-control" id="cre_sol_token" value="<?php echo $cre_sol_token; ?>">
          <input type="text" class="form-control" id="cre_sol_fecha_token" value="<?php echo $cre_sol_fecha_token; ?>">

          <!--PREVISORA-->
          <input type="text" class="form-control" id="cre_pre_AgentCodeListCoin" value="<?php echo $_SESSION["cre_pre_AgentCodeListCoin"]; ?>">
          <input type="text" class="form-control" id="cre_pre_AgentAgencyTypeCode" value="<?php echo $_SESSION["cre_pre_AgentAgencyTypeCode"]; ?>">
          <input type="text" class="form-control" id="cre_pre_ParticipationCia" value="<?php echo $_SESSION["cre_pre_ParticipationCia"]; ?>">
          <input type="text" class="form-control" id="cre_pre_AgentCode" value="<?php echo $_SESSION["cre_pre_AgentCode"]; ?>">
          <input type="text" class="form-control" id="cre_pre_Username" value="<?php echo $_SESSION["cre_pre_Username"]; ?>">
          <input type="text" class="form-control" id="cre_pre_Password" value="<?php echo $_SESSION["cre_pre_Password"]; ?>">

          <!--MAPFRE-->
          <input type="text" class="form-control" id="cre_map_codCliente" value="<?php echo $_SESSION["cre_map_codCliente"]; ?>">
          <input type="text" class="form-control" id="cre_map_codigoOficinaAsociado" value="<?php echo $_SESSION["cre_map_codigoOficinaAsociado"]; ?>">
          <input type="text" class="form-control" id="cre_map_codigoIntermediario" value="<?php echo $_SESSION["cre_map_codigoIntermediario"]; ?>">
          <input type="text" class="form-control" id="cre_map_username" value="<?php echo $_SESSION["cre_map_username"]; ?>">
          <input type="text" class="form-control" id="cre_map_password" value="<?php echo $_SESSION["cre_map_password"]; ?>">
          <input type="text" class="form-control" id="cre_map_codigonivel3GA" value="<?php echo $_SESSION["cre_map_codigonivel3GA"]; ?>">


          <!--SBS-->
          <input type="text" class="form-control" id="cre_sbs_usuario" value="<?php echo $cre_sbs_usuario; ?>">
          <input type="text" class="form-control" id="cre_sbs_contrasena" value="<?php echo $cre_sbs_contrasena; ?>">

          <!--ALLIANZ-->
          <input type="text" class="form-control" id="cre_alli_sslcertfile" value="<?php echo $cre_alli_sslcertfile; ?>">
          <input type="text" class="form-control" id="cre_alli_sslkeyfile" value="<?php echo $cre_alli_sslkeyfile; ?>">
          <input type="text" class="form-control" id="cre_alli_passphrase" value="<?php echo $cre_alli_passphrase; ?>">
          <input type="text" class="form-control" id="cre_alli_partnerid" value="<?php echo $cre_alli_partnerid; ?>">
          <input type="text" class="form-control" id="cre_alli_agentid" value="<?php echo $cre_alli_agentid; ?>">
          <input type="text" class="form-control" id="cre_alli_partnercode" value="<?php echo $cre_alli_partnercode; ?>">
          <input type="text" class="form-control" id="cre_alli_agentcode" value="<?php echo $cre_alli_agentcode; ?>">

          <!--AXA-->
          <input type="text" class="form-control" id="cre_axa_sslcertfile" value="<?php echo $cre_axa_sslcertfile; ?>">
          <input type="text" class="form-control" id="cre_axa_sslkeyfile" value="<?php echo $cre_axa_sslkeyfile; ?>">
          <input type="text" class="form-control" id="cre_axa_passphrase" value="<?php echo $cre_axa_passphrase; ?>">
          <input type="text" class="form-control" id="cre_axa_codigoDistribuidor" value="<?php echo $cre_axa_codigoDistribuidor; ?>">
          <input type="text" class="form-control" id="cre_axa_idTipoDistribuidor" value="<?php echo $cre_axa_idTipoDistribuidor; ?>">
          <input type="text" class="form-control" id="cre_axa_codigoDivipola" value="<?php echo $cre_axa_codigoDivipola; ?>">
          <input type="text" class="form-control" id="cre_axa_canal" value="<?php echo $cre_axa_canal; ?>">
          <input type="text" class="form-control" id="cre_axa_validacionEventos" value="<?php echo $cre_axa_validacionEventos; ?>">
          <input type="text" class="form-control" id="url_axa" value="<?php echo $url_axa; ?>">

          <!--Bolivar-->
          <input type="text" class="form-control" id="cre_bol_api_key" value="<?php echo $cre_bol_api_key; ?>">
          <input type="text" class="form-control" id="cre_bol_claveAsesor" value="<?php echo $cre_bol_claveAsesor; ?>">

        </div>

      </div>

    </div>

    <!-- MODAL FASECOLDA -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Buscar vehículo por fasecolda</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label class="col-form-label">Fasecolda:</label>
                <input type="text" class="form-control" id="buscar-fasecolda">
              </div>
              <div class="form-group">
                <label class="col-form-label">Modelo:</label>
                <input type="text" class="form-control" id="modelo-fasecolda">
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-block btn-primary" id="btn-consultar-fasecolda">Consultar</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- END MODAL FASECOLDA -->

  </section>

</div>

<script src="vistas/js/cotizar.js?v=<?php echo (rand()); ?>"></script>


<?php

$eliminarCotizacion = new ControladorCotizaciones();
$eliminarCotizacion->ctrEliminarCotizacion();

?>