
<head>

<style>

    .asterisk {
    color: red;
    }

    hr {
        background-color: #82d600; 
        height: 1px;
        /* border: none;
        margin: 10px 0; */
    }

    .form-control {
        height: 35px; 
        font-size: 13px;
        }

    .conten-dia,
    .conten-mes,
    .conten-anio {
        margin-bottom: 5px;
    }

    /* ::placeholder {
            color: #82d600 !important;
            opacity: 7 !important;
        } */

        .form-control:focus {
            outline: 0.5px solid #82d600;
        }
</style>


</head>

<body> 


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
                        
                <form method="post">
                    
                    <div class="row">
                    <hr>
                    <label for="" class="login-box-msg">Los campos con <span class="asterisk">*</span> son obligatorios</label><br><br>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="">Clave de registro <strong class="text-danger">*</strong> </label>
                            <input class="form-control" type="text" name="clave_registro" id="clave_registro" placeholder="Clave de registro" autofocus>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Nombres <strong class="text-danger">*</strong> </label>
                            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="nombre">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Apellidos <strong class="text-danger">*</strong></label>
                            <input class="form-control" type="text" name="apellido" id="apellido" placeholder="apellido">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
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

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Numero de documento <strong class="text-danger">*</strong></label>
                            <input class="form-control" onkeypress="return validar_numeros(event)" type="tel" name="identificacion" id="identificacion" placeholder="#Documento">
                        </div>
                    </div>

                    <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 form-group">
                                <label for="">Fecha de Nacimiento <strong class="text-danger">*</strong></label>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 text-left mb-3" >
                                        <select class="form-control fecha-nacimiento" name="dia_nacimiento" id="dia_nacimiento" required>
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
                                        <select class="form-control fecha-nacimiento" name="mes_nacimiento" id="mes_nacimiento" required>
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
                                        <select class="form-control fecha-nacimiento" name="anio_nacimiento" id="anio_nacimiento" required>
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

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="">Genero <strong class="text-danger">*</strong></label>
                                <select class="form-control" name="genero" id="genero">
                                    <option value="" disabled selected>Genero</option>
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Dirección <strong class="text-danger">*</strong></label>
                            <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Direccion">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Ciudad <strong class="text-danger"></strong></label>
                            <select class="form-control select2_id" name="ciudad" id="ciudad">
                                <option value="">-</option>
                                            <option value="Arauca">Arauca</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Barranquilla">Barranquilla</option>
                                            <option value="Bogotá">Bogotá</option>
                                            <option value="Bucaramanga">Bucaramanga</option>
                                            <option value="Cali">Cali</option>
                                            <option value="Cartagena">Cartagena</option>
                                            <option value="Cúcuta">Cúcuta</option>
                                            <option value="Florencia">Florencia</option>
                                            <option value="Ibagué">Ibagué</option>
                                            <option value="Leticia">Leticia</option>
                                            <option value="Manizales">Manizales</option>
                                            <option value="Medellín">Medellín</option>
                                            <option value="Mitú">Mitú</option>
                                            <option value="Mocoa">Mocoa</option>
                                            <option value="Montería">Montería</option>
                                            <option value="Neiva">Neiva</option>
                                            <option value="Pasto">Pasto</option>
                                            <option value="Pereira">Pereira</option>
                                            <option value="Popayán">Popayán</option>
                                            <option value="Puerto Carreño">Puerto Carreño</option>
                                            <option value="Puerto Inírida">Puerto Inírida</option>
                                            <option value="Quibdó">Quibdó</option>
                                            <option value="Riohacha">Riohacha</option>
                                            <option value="San Andrés">San Andrés</option>
                                            <option value="San José del Guaviare">San José del Guaviare</option>
                                            <option value="Santa Marta">Santa Marta</option>
                                            <option value="Sincelejo">Sincelejo</option>
                                            <option value="Tunja">Tunja</option>
                                            <option value="Valledupar">Valledupar</option>
                                            <option value="Villavicencio">Villavicencio</option>
                                            <option value="Yopal">Yopal</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Telefono Fijo</label>
                            <input class="form-control" type="tel" onkeypress="return validar_numeros(event)" name="telefono" id="telefono" placeholder="Telefono">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="">Celular <strong class="text-danger">*</strong></label>
                            <input class="form-control" type="tel" onkeypress="return validar_numeros(event)" name="celular" id="celular" placeholder="Celular">
                        </div>
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
        </div>

                </form>                                                                                                                               

                            <!-- <div class="form-group">
                                <label for="cedula">Clave de registro</label>
                                <input type="text" class="form-control" id="cedula" placeholder="Número de cédula" name="cedula" required>
                            </div>
                            <div class="form-group">
                                <label for="token">Token enviado al correo</label>
                                <input type="text" class="form-control" id="token" placeholder="Token de seguridad" name="token" required>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">Nueva contraseña</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Nueva contraseña" name="newPassword" required>
                            </div>
                            <div class="form-group">
                                <label for="autPassword">Repita su nueva contraseña</label>
                                <input type="password" class="form-control" id="autPassword" placeholder="Verificación contraseña nueva" name="autPassword" required>
                            </div>
                                <br>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary btn-block btn-flat" onclick="authInfo()">Enviar</button>
                            </div> -->
                
                    
                <!-- </div> -->
        </div>
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