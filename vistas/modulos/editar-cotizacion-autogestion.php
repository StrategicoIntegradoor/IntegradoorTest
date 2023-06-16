<?php

if ($_SESSION["rol"] != 1 && $_SESSION["rol"] != 2) {
    echo '<script>
            window.location = "inicio";
        </script>';

    return;
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <?php $idCotizacion = $_GET['idcotizacion']; ?>
        <h1>
            Cotización # <?php echo $idCotizacion ?> - Autogestión
        </h1>

        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Cotización - Autogestión</li>
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
                                                    <label>¿Conoces la Placa?</label>
                                                    <div class="conten-conocesPlaca">
                                                        <label for="Si">Si</label>
                                                        <input type="radio" name="conocesPlaca" id="txtConocesLaPlacaSi" value="Si" checked>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label for="No">No</label>
                                                        <input type="radio" name="conocesPlaca" id="txtConocesLaPlacaNo" value="No" required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6 form-group" id="contenPlaca">
                                                    <label for="placaVeh">Placa</label>
                                                    <input type="text" minlength="6" maxlength="6" class="form-control" id="placaVeh" required>
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
                                            <label for="tipoDocumentoID">Tipo de Documento</label>
                                            <select class="form-control" id="tipoDocumentoID" required>
                                                <option value=""></option>
                                                <option value="1">Cedula de ciudadania</option>
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
                                            <input type="text" maxlength="10" class="form-control" id="numDocumentoID" required>
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

                                        <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                            <label for="">Fecha de Nacimmiento</label>
                                            <div class="row">
                                                <div class="col-xs-4 col-sm-4 col-md-4 conten-dia">
                                                    <select class="form-control fecha-nacimiento" name="dianacimiento" id="dianacimiento" required>
                                                        <option value="">Dia</option>
                                                        <?php
                                                        for ($i = 1; $i <= 31; $i++) {
                                                            if (strlen($i) == 1) {
                                                        ?><option value="<?php echo "0" . $i ?>"><?php echo "0" . $i ?></option><?php
                                                                                                } else {
                                                                                                    ?><option value="<?php echo $i ?>"><?php echo $i ?></option><?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4 conten-mes">
                                                    <select class="form-control fecha-nacimiento" name="mesnacimiento" id="mesnacimiento" required>
                                                        <option value="">Mes</option>
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
                                                <option value=""></option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                            <label for="estadoCivil">Estado Civil</label>
                                            <select class="form-control" id="estadoCivil" required>
                                                <option value=""></option>
                                                <option value="1">Soltero (a)</option>
                                                <option value="2">Casado (a)</option>
                                                <option value="3">Viudo (a)</option>
                                                <option value="4">Divorciado (a)</option>
                                                <option value="5">Unión Libre</option>
                                                <option value="6">Separado (a)</option>
                                            </select>
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
                                            <label for="txtClaseVeh">Clase</label>
                                            <input type="text" class="form-control" id="txtClaseVeh" placeholder="" disabled>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                            <label for="txtMarcaVeh">Marca</label>
                                            <input type="text" class="form-control classMarcaVeh" id="txtMarcaVeh" placeholder="" disabled>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                            <label for="txtModeloVeh">Modelo</label>
                                            <input type="text" class="form-control" id="txtModeloVeh" placeholder="" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                            <label for="txtReferenciaVeh">Línea</label>
                                            <input type="text" class="form-control classReferenciaVeh" id="txtReferenciaVeh" placeholder="" disabled>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                            <label for="txtFasecolda">Fasecolda</label>
                                            <input type="text" class="form-control" id="txtFasecolda" placeholder="" required>
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
                                                <div class="col-xs-5 col-sm-12 col-md-5 form-group">
                                                    <label>Es Oneroso?</label>
                                                    <div class="conten-oneroso">
                                                        <label for="Si">Si</label>
                                                        <input type="radio" name="oneroso" id="esOnerosoSi" value="Si">&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label for="No">No</label>
                                                        <input type="radio" name="oneroso" id="esOnerosoNo" value="No" required>
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

                </div>

                <!-- CAMPOS OCULTOS PARA OPTENER LA INFORMACION-->
                <div style="display: none;">
                    <label>Id Asegurado</label>
                    <input type="hidden" name="idCliente" id="idCliente">
                    <label>Celular Asegurado</label>
                    <input type="text" name="celularAseg" id="celularAseg" value="3122464876">
                    <label>Email Asegurado</label>
                    <input type="text" name="emailAseg" id="emailAseg" value="tecnologia@grupoasistencia.com">
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
                </div>

                <!-- SECCION BOTON DE RECOTIZAR Y AGREGAR OFERTA -->
                <div id="contenRecotizarYAgregar">
                    <div class="col-lg-12 recotizarYAgregar">
                        <div class="row">

                            <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                <div id="loaderRecotOferta"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                <button class="btn btn-primary btn-block" id="btnRecotizarAutogestion">Recotizar Parrilla</button>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                <button class="btn btn-success btn-block" id="btnMostrarFormCotManual">Agregar Cotización Manual</button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- FORMULARIO AGREGAR OFERTA MANUAL -->
                <form method="Post" id="agregarOferta">
                    <div id="formularioCotizacionManual">
                        <div class="col-lg-12 agregar-oferta">
                            <div class="row row-agregar">
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label for="">AGREGAR COTIZACIÓN</label>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <div id="masAgrOferta">
                                        <p id="masAgr" onclick="masAgr();">Ver mas <i class="fa fa-plus-square-o"></i></p>
                                    </div>
                                    <div id="menosAgrOferta">
                                        <p id="menosAgr" onclick="menosAgr();">Ver menos <i class="fa fa-minus-square-o"></i></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="DatosAgregarOferta">
                            <div class="col-lg-12 form-agregarOferta">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                        <label for="aseguradora">Aseguradora</label>
                                        <select class="form-control" id="aseguradora-autogestion" required>
                                            <option value=""></option>
                                            <option value="Seguros del Estado">Seguros del Estado</option>
                                            <option value="Seguros Bolivar">Seguros Bolivar</option>
                                            <option value="Axa Colpatria">Axa Colpatria</option>
                                            <option value="HDI Seguros">HDI Seguros</option>
                                            <option value="SBS Seguros">SBS Seguros</option>
                                            <option value="Seguros Sura">Seguros Sura</option>
                                            <option value="Zurich Seguros">Zurich Seguros</option>
                                            <option value="Allianz Seguros">Allianz Seguros</option>
                                            <option value="Liberty Seguros">Liberty Seguros</option>
                                            <option value="Seguros Mapfre">Seguros Mapfre</option>
                                            <option value="Equidad Seguros">Equidad Seguros</option>
                                            <option value="Previsora">Previsora Seguros</option>
                                            <option value="Aseguradora Solidaria">Aseguradora Solidaria</option>
                                        </select>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                        <label for="producto">Producto</label>
                                        <select class="form-control" id="producto-autogestion" required></select>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                        <label for="valorRC">Valor RC</label>
                                        <select class="form-control" id="valorRC-autogestion" required></select>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
                                                <label for="numCotizacion">Numero Cotización</label>
                                                <input type="text" class="form-control" id="numCotizacion" required>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
                                                <label for="valorTotal">Valor Total</label>
                                                <input type="text" class="form-control" id="valorTotal" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                        <label for="valorPerdidaTotal">Cubrimiento Perdidas Total </label>
                                        <input type="text" class="form-control" id="valorPerdidaTotal" maxlength="10" required disabled>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                        <label for="valorPerdidaParcial">Cubrimiento Perdidas Parcial</label>
                                        <input type="text" class="form-control" id="valorPerdidaParcial" required disabled>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
                                                <label for="conductorElegido">Conductor Elegido</label>
                                                <input type="text" class="form-control" id="conductorElegido" required disabled>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
                                                <label for="servicioGrua">Servicio de Grua</label>
                                                <input type="text" class="form-control" id="servicioGrua" required disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 btnAgregar">
                                        <button class="btn btn-info btn-block" id="btnAgregarCotizacionAutogestion">Agregar Cotización</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- PARRILLA DE COTIZACIONES -->
                <div id="contenParrilla">
                    <div class="col-lg-12 form-parrilla">
                        <div class="row row-parrilla">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <label for="">PARRILLA DE COTIZACIÓNES</label>
                            </div>
                        </div>
                    </div>
                    <div id="cardCotizacion" class="cardCotizacionAutogestion">
                    </div>
                    <div id="cardAgregarCotizacion">
                    </div>
                    <div id="contenCotizacionPDF">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <button type="button" class="btn btn-danger btn-block" id="btnParrillaPDFAutogestion">
                                <span class="fa fa-file-text"></span> Generar PDF de Cotización
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="vistas/js/seleccionar_cotizacion_autogestion.js?v=<?php echo (rand()); ?>"></script>
