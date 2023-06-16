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
                        
                      <button class="btn btn-primary btnEditarUsuario" idUsuario="' . $value["id_usuario"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

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

      <form role="form" method="post" enctype="multipart/form-data">

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

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL APELLIDO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellidos" required>

            </div>



          </div>

          <div class="row">

            <!-- ENTRADA PARA EL USUARIO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocIdUser" id="nuevoDocIdUser" placeholder="Ingresar documento" required>

              </div>

            </div>

          </div>

          <div class="row">

            <!-- ENTRADA PARA EL GÉNERO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>

                <select class="form-control input-lg" name="nuevoGenero" id="nuevoGenero" required>

                  <option value="">Género:</option>

                  <option value="M">Masculino</option>

                  <option value="F">Femenino</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU ROL -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoRol" id="idRoll">

                  <option value="">Selecionar rol</option>

                  <option value="1">Administrador</option>

                  <option value="2">Asesor</option>

                </select>

              </div>

            </div>

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

            <!-- ENTRADA PARA EL NUMERO MAXIMO DE COTIZACIONES DIARIAS-->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                <input type="text" class="form-control input-lg" name="maxCot" placeholder="Cotizaciones diarias" id="maxCot" required>

              </div>

            </div>

            <!-- ENTRADA INGRESAR LA FECHA LIMITE DE USO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>

                <input type="date" min="0" class="form-control input-lg" name="fecLim" id="fecLim" placeholder="Ingresar documento" required>

              </div>

            </div>

          </div>



          <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-6">

              <div class="row">

                <!-- ENTRADA PARA EL TELÉFONO -->

                <div class="col-lg-12 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                  </div>

                </div>

                <!-- ENTRADA PARA EL EMAIL -->

                <div class="col-lg-12 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                    <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

                  </div>

                </div>

                <!-- ENTRADA PARA EL CARGO -->

                <div class="col-lg-12 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                    <input type="text" class="form-control input-lg" name="nuevoCargo" placeholder="Ingresar cargo" required>

                  </div>

                </div>

                <!-- ENTRADA PARA SELECCIONAR SU INTERMEDIARIO -->

                <div class="col-lg-12 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control input-lg" name="Intermediario" id="idIntermediario">

                    </select>

                  </div>

                </div>


              </div>

            </div>

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

      <form role="form" method="post" enctype="multipart/form-data">

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

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="row">

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" placeholder="Actualizar nombre" required>
                  <input type="hidden" id="idCliente" name="idCliente">
                  <input type="hidden" id="codCliente" name="codCliente">

                </div>

              </div>

              <!-- ENTRADA PARA EL APELLIDO -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <input type="text" class="form-control input-lg" name="editarApellido" id="editarApellido" placeholder="Actualizar apellido" required>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA EL USUARIO -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-key"></i></span>

                  <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

                </div>

              </div>

              <!-- ENTRADA PARA EL DOCUMENTO ID -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>

                  <input type="number" min="0" class="form-control input-lg" name="editarDocIdUser" id="editarDocIdUser" placeholder="Actualizar documento" required>

                </div>

              </div>

            </div>

            <div class="row">

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

              <!-- ENTRADA PARA SELECCIONAR SU ROL -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-users"></i></span>

                  <select class="form-control input-lg" name="editarRol" id="editarRol">

                    <option value="">Selecionar rol</option>

                    <option value="1">Administrador</option>

                    <option value="2">Asesor</option>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA LA CONTRASEÑA -->

              <!-- <div class="col-xs-12 col-sm-6 col-md-6 form-group">
              
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span> -->

              <input type="hidden" class="form-control input-lg" name="editarPassword" placeholder="Ingrese nueva contraseña" id="editarPassword">

              <input type="hidden" id="passwordActual" name="passwordActual">

              <!-- </div>

              </div> -->

            </div>
            <div class="row">

            <!-- ENTRADA PARA EL NUMERO MAXIMO DE COTIZACIONES DIARIAS-->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                <input type="text" class="form-control input-lg" name="maxCotEdi" placeholder="Cotizaciones diarias" id="maxCotEdi" required>

              </div>

            </div>

            <!-- ENTRADA INGRESAR LA FECHA LIMITE DE USO -->

            <div class="col-xs-12 col-sm-6 col-md-6 form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>

                <input type="date" min="0" class="form-control input-lg" name="fechaLimEdi" id="fechaLimEdi" placeholder="Ingresar documento" required>

              </div>

            </div>

          </div>

            <div class="row">

              <div class="col-xs-12 col-sm-6 col-md-6">

                <div class="row">

                  <!-- ENTRADA PARA EL TELÉFONO -->

                  <div class="col-lg-12 form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                      <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                    </div>

                  </div>

                  <!-- ENTRADA PARA EL EMAIL -->

                  <div class="col-lg-12 form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                      <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" placeholder="Actualizar email" required>
                      <input type="hidden" id="idEstado" name="idEstado">

                    </div>

                  </div>

                  <!-- ENTRADA PARA EL CARGO -->

                  <div class="col-lg-12 form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                      <input type="text" class="form-control input-lg" name="editarCargo" id="editarCargo" placeholder="Ingresar cargo" required>

                    </div>

                  </div>

                  <!-- ENTRADA PARA EL INTERMEDIARIO -->

                  <div class="col-lg-12 form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-users"></i></span>

                      <select class="form-control input-lg" name="Intermediario2" id="idIntermediario2">

                      </select>

                    </div>

                  </div>


                </div>

              </div>

              <!-- ENTRADA PARA SUBIR FOTO -->

              <div class="col-xs-12 col-sm-6 col-md-6">

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

<script src="vistas/js/usuarios.js?v=<?php echo (rand()); ?>"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <script src="vistas/js/invalidarPesadoDemo.js?v=<?php echo (rand()); ?>"></script> -->