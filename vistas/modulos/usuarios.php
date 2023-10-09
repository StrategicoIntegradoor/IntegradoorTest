<?php

// if ($_SESSION["rol"] != 1) {

//   echo '<script>

//     window.location = "inicio";

//   </script>';

//   return;
// }

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar usuarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar usuarios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <style>
          .btnAgregarUsuario {
            border-radius: 4px;
            background-color: #88D600;
            border: none;
            color: #fff;
            text-align: center;
            font-size: 18px;
            padding: 5px;
            width: 200px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
            /* box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7); */
          }

          .btnAgregarUsuario {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
          }

          .btnAgregarUsuario:after {
            content: '»';
            position: absolute;
            opacity: 0;
            top: 4px;
            right: -30px;
            transition: 0.5s;
          }

        </style>

        <?php
        if($_SESSION["permisos"]["Agregarunusuarionuevo"] == "x"){	
          echo '<button class="btnAgregarUsuario" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar usuario

        </button>';
        }
      ?>
      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th>#</th>
              <th>Usuario</th>
              <th>N°_Identidad</th>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Correo Electronico</th>
              <th>Rol</th>
              <th>Últ_login</th>
              <th>Foto</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $idRol = $_SESSION["permisos"]["idRol"];
            $item1 = null;
            $valor1 = null;
            $item2 = null;
            $valor2 = null;

            if($_SESSION["permisos"]["Verlistadodeusuarioscreados"] == "x"){	

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item1, $valor1, $item2, $valor2);

            foreach ($usuarios as $key => $value) {

              echo ' <tr>

                  <td>' . ($key + 1) . '</td>

                  <td>' . $value["usu_usuario"] . '</td>

                  <td>' . $value["usu_documento"] . '</td>

                  <td>' . $value["usu_nombre"] . ' ' . $value["usu_apellido"] . '</td>

                  <td>' . $value["usu_telefono"] . '</td>

                  <td>' . $value["usu_email"] . '</td>

                  <td>' . $value["rol_descripcion"] . '</td>';

              $ultimoLogin = $value["usu_ultimo_login"] == NULL ? " " : date("d/m/Y", strtotime($value["usu_ultimo_login"]));
              echo '<td>' . $ultimoLogin . '</td>';

              if ($value["usu_foto"] != "") {
                echo '<td><img src="' . $value["usu_foto"] . '" class="img-thumbnail" width="40px"></td>';
              } else {
                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
              }

              if ($value["usu_estado"] != 0) {
                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id_usuario"] . '" estadoUsuario="0">Activo</button></td>';
              } else {
                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id_usuario"] . '" estadoUsuario="1">Bloqueado</button></td>';
              }

              echo '<td>

                    <div class="btn-group">
                        
                      <button id="btnCargarRoll" class="btn btn-primary btnEditarUsuario" idUsuario="' . $value["id_usuario"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $value["id_usuario"] . '" fotoUsuario="' . $value["usu_foto"] . '" usuario="' . $value["usu_usuario"] . '"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>
                  
                </tr>';
            }
          }

            ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" id="userForm">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="padding : 3rem">


          <div class="row">

            <!-- ENTRADA PARA EL ADMIN -->

            <input type="hidden" id="idRolAdmin" value="<?php echo $idRol; ?>">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder="Nombres*" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL APELLIDO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nuevoApellido" name="nuevoApellido" placeholder="Apellidos*" required>
              </div>
            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA TIPO DE DOCUMENTO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>


                <select class="form-control input-lg" name="agregarTipoDocumento" id="agregarTipoDocumento" required>

                  <option></option>
                  <option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
                  <option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
                  <option value="Permiso de Proteccion Temporal">Permiso de Proteccion Temporal</option>
                  <option value="Pasaporte">Pasaporte</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocIdUser" id="nuevoDocIdUser" placeholder="Documento*" required>

              </div>

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" class="form-control input-lg" name="AgregfechNacimiento" id="AgregfechNacimiento" placeholder="Fecha de Nacimiento">
              </div>
            </div>



            <!-- ENTRADA PARA EL GÉNERO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                <select class="form-control input-lg" name="nuevoGenero" id="nuevoGenero" placeholder="Género" required>
                  <option></option>
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
                </select>
              </div>

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA LA DIRECCION -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-home"></i></span>

                <input type="text" class="form-control input-lg" name="AgregDireccion" id="AgregDireccion" placeholder="Dirección*" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DEPARTAMENTO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                <select class="form-control input-lg" name="DptoCirculacion" id="ingDptoCirculacion">

                    <option value="">Departamento</option>
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

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA LA CIUDAD -->
            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                <select class="form-control input-lg" name="ingciudadCirculacion" id="ingciudadCirculacion" required></select>
                <!-- <div id="listaCiudades"></div> -->

              </div>
            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
              <div id="mensajeErrorCelular" style="color: red; display: none;"></div>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoTelefono" id="AgregMovil" placeholder="Celular*" data-inputmask="'mask':'(999) 999-9999'" data-mask minlength="10" required>
              </div>
            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Email*" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CARGO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCargo" placeholder="Cargo">

              </div>

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA SELECCIONAR SU INTERMEDIARIO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                <select class="form-control input-lg" name="idIntermediario" id="idIntermediario" required>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU ROL -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoRol" id="idRoll" required>

                </select>

              </div>

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA EL NUMERO MAXIMO DE COTIZACIONES DIARIAS-->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                <input type="text" class="form-control input-lg" name="maxCot" placeholder="Cotizaciones diarias" id="maxCot">

              </div>

            </div>

            <!-- ENTRADA INGRESAR LA FECHA LIMITE DE USO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" min="0" class="form-control input-lg" name="fecLim" id="fecLim" placeholder="Limite de uso">

              </div>

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA EL USUARIO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" readonly>

              </div>

            </div>

          </div>

          <div class="row">

            

            

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <!-- <div class="col-xs-12 col-sm-6 col-md-6 form-group">
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>  -->

            <input type="hidden" class="form-control input-lg" name="nuevoPassword" placeholder="Contraseña Usuario" id="nuevoPassword" readonly required>

            <!-- </div>

              </div> -->

            <!-- ALERT CLIENTE EXISTENTE -->
            <div id="alertUsuarioExist"></div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="col-xs-12 col-sm-6 col-md-6">

              <div class="panel">SUBIR FOTO</div>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="90px">

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

            </div>

          </div>


        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

        <?php

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario->ctrCrearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data" id="userEditForm">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar usuario</h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <div class="row">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" placeholder="Actualizar nombre" required>
                <input type="hidden" id="idCliente" name="idCliente">
                <input type="hidden" id="codCliente" name="codCliente">
                <input type="hidden" id="idUsuEdit" name="idUsuEdit">

              </div>

            </div>

            <!-- ENTRADA PARA EL APELLIDO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarApellido" id="editarApellido" placeholder="Actualizar apellido" required>
              
              </div>
              
            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA EL TIPO DE DOCUMENTO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>


                <select class="form-control input-lg" name="editarTipoDocumento" id="editarTipoDocumento">

                  <option value="">Tipo de documento:</option>
                  <option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
                  <option value="Cedula de Extranjeria">Cedula de Extranjeria</option>
                  <option value="Permiso de Proteccion Temporal">Permiso de Proteccion Temporal</option>
                  <option value="Pasaporte">Pasaporte</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="editarDocIdUser" id="editarDocIdUser" placeholder="Actualizar documento">

              </div>

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="date" min="0" class="form-control input-lg" name="fechNacimiento" id="fechNacimiento" placeholder="Ingresar fecha">

              </div>

            </div>

            <!-- ENTRADA PARA EL GÉNERO -->
            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>

                <select class="form-control input-lg" name="editarGenero" id="editarGenero" required>

                  <option value="">Género:</option>
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>

                </select>

              </div>

            </div>

          </div>


          <div class="row">


            <!-- ENTRADA PARA EL CELULAR -->
            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
            <div id="mensajeErrorCelularEdit" style="color: red; display: none;"></div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>
            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-home"></i></span>

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" placeholder="Sin Direccion">

              </div>

            </div>

            <!-- ENTRADA PARA EL DEPARTAMENTO -->

            <!-- <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                <select class="form-control input-lg" name="DptoCirculacion" id="DptoCirculacion" required>

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

            </div> -->

          </div>

          <div class="row">

            <!-- ENTRADA PARA LA CIUDAD -->

            <!-- <div class="col-xs-12 col-sm-6 col-md-6 form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                <select class="form-control" id="ciudadCirculacion"></select>
                <div id="listaCiudades"></div>

              </div>
            </div> -->




          </div>

          <div class="row">

            <!-- ENTRADA PARA LA CIUDAD ACTUAL OPCION 2-->
            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                <input type="text" class="form-control input-lg" name="ciudadActual" id="ciudadActual" placeholder="Sin ciudad" readonly>
                <input type="hidden" id="codigoCiudadActual" name="codigoCiudadActual">

              </div>

            </div>

            <!-- ENTRADA PARA LA CIUDAD OPCION 2-->
            <div class="col-xs-12 col-sm-6 col-md-6 form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                <select class="form-control" name="ciudad2" id="ciudad2"></select>
                  <!-- <option></option> Opción vacía para que el buscador funcione correctamente -->
                  <!-- <div id="listaCiudades"></div> -->

              </div>
            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA EL EMAIL-->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" placeholder="Actualizar email" required>
                <input type="hidden" id="idEstado" name="idEstado">

              </div>

            </div>

            <!-- ENTRADA INGRESAR CARGO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarCargo" id="editarCargo" placeholder="Editar cargo">

              </div>

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA EL INTERMEDIARIO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                <select class="form-control input-lg" name="idIntermediario2" id="idIntermediario2" placeholder="Editar Intermediario" required>
  
                <option value="">Selecionar Intermediario</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU ROL -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarRol" id="editarRol" placeholder="Editar Rol" required>

                  <option value="">Selecionar rol</option>

                  <option value="1">AsesorSgaFreelance</option>
                  <option value="2">Asesor</option>
                  <option value="2">Asesor</option>

                </select>

              </div>

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA EL NUMERO MAXIMO DE COTIZACIONES DIARIAS-->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                <input type="text" min="0" class="form-control input-lg" name="maxiCot" placeholder="Cotizaciones diarias" id="maxiCot">

              </div>

            </div>

            <!-- ENTRADA INGRESAR LA FECHA LIMITE DE USO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" min="0" class="form-control input-lg" name="fechaLimEdi" id="fechaLimEdi" placeholder="Ingresar documento">

              </div>

            </div>

          </div>

          <div class="row">

            <!-- DISPLAY USU_USUARIO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

              <!-- DISPLAY USU_FCH_CREACION -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" min="0" class="form-control input-lg" name="fechaUserExist" id="fechaUserExist" readonly>

              </div>

            </div>

          </div>

          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="panel">SUBIR FOTO</div>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="90px">

              <input type="file" class="nuevaFoto" name="editarFoto">

              <input type="hidden" name="fotoActual" id="fotoActual">

              <p class="help-block">Peso máximo de la foto 2MB</p>

            </div>

          </div>

        </div>

      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Modificar usuario</button>

      </div>

      <?php

      $editarUsuario = new ControladorUsuarios();
      $editarUsuario->ctrEditarUsuario();

      ?>

    </form>

    </div>

  </div>

</div>

<?php

$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();

?>

<script>
  $(document).ready(function() {
    const inputFecha = $("#AgregfechNacimiento");

    // Cambiar el tipo de entrada a "text" al cargar la página
    inputFecha.prop("type", "text");

    // Cuando el campo de entrada obtiene el foco
    inputFecha.focus(function() {
      // Cambiar el tipo de entrada a "date"
      inputFecha.prop("type", "date");
    });

    // Cuando el campo de entrada pierde el foco
    inputFecha.blur(function() {
      // Si el campo de entrada está vacío, restaurar el tipo de entrada a "text"
      if (inputFecha.val() === "") {
        inputFecha.prop("type", "text");
      }
    });
  });
</script>

<script>
  $(document).ready(function() {
    const inputFecha = $("#fecLim");

    // Cambiar el tipo de entrada a "text" al cargar la página
    inputFecha.prop("type", "text");

    // Cuando el campo de entrada obtiene el foco
    inputFecha.focus(function() {
      // Cambiar el tipo de entrada a "date"
      inputFecha.prop("type", "date");
    });

    // Cuando el campo de entrada pierde el foco
    inputFecha.blur(function() {
      // Si el campo de entrada está vacío, restaurar el tipo de entrada a "text"
      if (inputFecha.val() === "") {
        inputFecha.prop("type", "text");
      }
    });
  });
</script>
<script>
  // Obtén referencias a los campos de entrada
  const nuevoUsuarioInput = document.getElementById('nuevoDocIdUser');
  const copiaUsuarioInput = document.getElementById('nuevoUsuario');

  // Agrega un controlador de eventos para el evento 'input' en el campo nuevoUsuario
  nuevoUsuarioInput.addEventListener('input', function() {
    // Copia el contenido del campo nuevoUsuario al campo copiaUsuario
    copiaUsuarioInput.value = this.value;
  });
</script>
<script src="vistas/js/usuarios.js?v=<?php echo (rand()); ?>"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <script src="vistas/js/invalidarPesadoDemo.js?v=<?php echo (rand()); ?>"></script> -->