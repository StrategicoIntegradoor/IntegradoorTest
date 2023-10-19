
<head>
<link rel="stylesheet" href="vistas/dist/css/styles_cotizador.css?v=<?php echo (rand()); ?>">

<style>

    .asterisk {
    color: red;
    }

    hr {
        background-color: #82d600; 
        height: 1px;
        /* border: none; */
        /* margin: 10px 0; */
    }

    .form-control {
        height: 35px; 
        font-size: 13px;
        }

    .conten-dia,
    .conten-mes,
    .conten-anio {
        margin-bottom: 5px;
        /* flex: 0 0 30%;  */

    }

    /* Aplicar margen derecho entre los select */
    .conten-anio {
    margin-right: 0;
    }

    ::placeholder {
            opacity: 7 !important;
        }

    .form-control:focus {
        outline: 0.5px solid #82d600;

    }

    /* Oculta los elementos select con la clase "ocultar-select" */
    .ocultar-select {
        display: none;
    }

</style>


</head>

<body> 


        <section class="content">

            <!-- <div class="box"> -->
                <div class="guest-box">

                    <div class="guest-box-body">
                        <div class="register-box">
                            <div class="login-logo">
                                <img src="vistas/img/plantilla/Logo_Integradoor_Cotizador_1.png" class="img-responsive" style="padding:30px 30px 0px 30px">
                                <br>
                                <h2 class="login-box-msg" style="font-weight: bold;">CREA TU CUENTA</h2>
                                <br>
                            </div>
                        </div>
                    </div>


                    <div id="box-body">

                        <!-- FORMULARIO RESUMEN ASEGURADO -->
                        <div id="formularioResumen">
                            <!-- <div id="resumenAsegurado"> -->
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

                                <!-- <div id="DatosAsegurado"> -->
                                    <!-- <div class="col-lg-12 form-resumAseg"> -->
                                        <div class="row">
                                            <hr>
                                            <label for="" class="login-box-msg">Los campos con <strong class="text-danger">*</strong> son obligatorios</label><br><br>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label for="">Clave de registro <strong class="text-danger">*</strong> </label>
                                                <input class="form-control" type="text" name="clave_registro" id="clave_registro" placeholder="Clave de registro" autofocus>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                <label for="">Nombres <strong class="text-danger">*</strong> </label>
                                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                <label for="">Apellidos <strong class="text-danger">*</strong></label>
                                                <input class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellido">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                <label for="">Tipo de documento <strong class="text-danger">*</strong></label>
                                                <select class="form-control" name="tipo_documento" id="tipo_documento">
                                                    <?php
                                                    $opciones = array(
                                                        'CC' => 'Cédula de ciudadanía',
                                                        'CE' => 'Cédula de extranjería',
                                                        'RC' => 'Registro civil',
                                                        'TI' => 'Tarjeta de identidad'
                                                    );

                                                    foreach ($opciones as $valor => $texto) {
                                                        echo '<option value="' . $valor . '">' . $texto . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                <label for="">Numero de documento <strong class="text-danger">*</strong></label>
                                                <input class="form-control" onkeypress="return validar_numeros(event)" type="tel" name="identificacion" id="identificacion" placeholder="#Documento">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                                <label for="">Fecha de Nacimiento <strong class="text-danger">*</strong></label>
                                                <div class="row ">

                                                    <div class="col-xs-4 col-sm-4 col-md-4 conten-dia">
                                                    <select class="form-control fecha-nacimiento" name="dianacimiento" id="diaCirculacion" required>
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
                                                    <select class="form-control fecha-nacimiento" name="mesnacimiento" id="mesCirculacion" required>
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
                                                    <select class="form-control fecha-nacimiento" name="anionacimiento" id="anioCirculacion" required>
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
                                        </div> 
                                                    
                                        
                                        <div class="row">
                                            <!-- <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                                    <label for="">Fecha de Nacimiento <strong class="text-danger">*</strong></label>
                                                    <div class="row">
                                                        <div class="col-xs-4 col-sm-4 col-md-4 text-left mb-3" >
                                                            <select class="form-control fecha-nacimiento" name="dia_nacimiento" id="diaCirculacion" required>
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
                                                        <div class="col-xs-4 col-sm-4 col-md-4 text-center mb-3" >
                                                            <select class="form-control fecha-nacimiento" name="mes_nacimiento" id="mesCirculacion" required>
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
                                                        <div class="col-xs-4 col-sm-4 col-md-4 text-right" >
                                                            <select class="form-control fecha-nacimiento" name="anio_nacimiento" id="anioCirculacion" required>
                                                                <option value="">Año</option>
                                                                <?php
                                                                for ($j = 1920; $j <= 2021; $j++) {
                                                                ?><option value="<?php echo $j ?>"><?php echo $j ?></option><?php
                                                                                                                                                            }
                                                                                                                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>                                                                                                                                                                                                             
                                            </div> -->

                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="">Genero <strong class="text-danger">*</strong></label>
                                                    <select class="form-control" name="genero" id="genero">
                                                        <option value="" disabled selected>Genero</option>
                                                        <option value="F">Femenino</option>
                                                        <option value="M">Masculino</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="">Celular <strong class="text-danger">*</strong></label>
                                                    <input class="form-control" type="tel" onkeypress="return validar_numeros(event)" name="celular" id="celular" placeholder="Celular">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 form-group">
                                                <label for="DptoCirculacion">Departamento de residencia <strong class="text-danger">*</strong></label>
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

                                            <div class="col-xs-12 col-md-3 form-group">
                                                <label for="ciudadCirculacion">Ciudad de residencia <strong class="text-danger">*</strong></label>
                                                <select class="form-control" id="ciudadCirculacion" required></select>
                                                <div id="listaCiudades"></div>
                                            </div>
                                            <div class="col-xs-12 col-md-6 form-group">
                                                <label for="">Dirección <strong class="text-danger">*</strong></label>
                                                <input class="form-control" type="text" name="direccion" id="direccion" >
                                            </div>
                                        </div>

                                        <!-- correcion select2 movil -->
                                        <div class="row">

                                            <div class="col-xs-12 col-sm-6 col-md-3 form-group ocultar-select">
                                            <label for="DptoCirculacion">Departamento de Circulación</label>
                                            <select class="form-control" id="DptoCirculacion4" required>
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

                                            <div class="col-xs-12 col-sm-6 col-md-3 form-group ocultar-select">
                                                <label for="ciudadCirculacion">Ciudad de Circulación</label>
                                                <select class="form-control" id="ciudadCirculacion4" required></select>
                                                <div id="listaCiudades"></div>
                                            </div>

                                        </div>

                                        <div class="row">
                        
                                            <!-- <div class="form-group col-xs-12 col-sm-6 col-md-3">
                                                <label for="DptoCirculacion">Departamento de residencia <strong class="text-danger">*</strong></label>
                                                <select class="form-control" id="DptoCirculacion" placeholder="Departamento" required>
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
                                            </div> -->

                                            <!-- <div class="form group col-xs-12 col-sm-6 col-md-3">
                                                <label for="ciudadCirculacion">Ciudad de residencia <strong class="text-danger">*</strong></label>
                                                <select class="form-control" id="ciudadCirculacion"></select>
                                                <div id="listaCiudades"></div>
                                            </div> -->

                                        </div>


                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="">Correo Electronico <strong class="text-danger">*</strong></label>
                                                <input class="form-control" type="email" name="correo_electronico" id="correo_electronico" placeholder="Correo electronico">
                                            </div>
                                        </div>
                    
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="">Contraseña <strong class="text-danger">*</strong></label>
                                                <input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
                                            </div>
                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="">Confirmar contraseña <strong class="text-danger">*</strong></label>
                                                <input class="form-control" type="password" name="confirmar_contrasena" id="confirmar_contrasena" placeholder="Confirmar contraseña">
                                            </div>
                                        </div>
                                        

                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-12">
                                                <div class="col-xs-offset-3 col-md-offset-3 col-xs-9">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="acepto_termino" id="acepto_termino" value="acepto_termino"> Acepto términos, condiciones y politica de datos
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary btn-sm btn-rounded" style="width: 250px; height: 35px; font-size: 15px;" onclick="registerGuest()">Enviar</button>
                                        </div>

                                    <!-- </div> -->
                                <!-- </div> -->
                            <!-- </div> -->
                        </div>

                        <!-- FORMULARIO VEHICULO MANUAL -->


                        <!-- FORMULARIO RESUMEN VEHICULO -->
                        

                        

                    </div>

                    <!-- CAMPOS OCULTOS PARA OPTENER LA INFORMACION-->
                    

                </div>

            <!-- </div> -->

            <!-- MODAL FASECOLDA -->
            <!-- END MODAL FASECOLDA -->

        </section>


</body>




<script src="vistas/js/invitacion.js"></script>

<script>
  document.addEventListener("keydown", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
            authInfo();
    }
  });
</script>