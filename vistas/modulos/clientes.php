<?php

if ($_SESSION["permisos"]["Clientes"] != "x") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>


<style>
          .btnAgregarCliente {
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

          .btnAgregarCliente {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
          }

          .btnAgregarCliente:after {
            content: '»';
            position: absolute;
            opacity: 0;
            top: 4px;
            right: -30px;
            transition: 0.5s;
          }

        </style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Clientes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Clientes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      <?php
        
      if ($_SESSION["permisos"]["Agregarunclientenuevo"] == "x") {

        echo '<button class="btnAgregarCliente" data-toggle="modal" data-target="#modalAgregarCliente">

          Agregar cliente

        </button>';
      }
      ?>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">N°</th>
              <th>Tipo</th>
              <th>Documento</th>
              <th>Nombre</th>
              <th>F.Nacimiento</th>
              <th>Gén.</th>
              <th>Estado_Civil</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Accion</th>

            </tr>

          </thead>

          <tbody>

            <?php


          if ($_SESSION["permisos"]["Verlistadodetodoslosclientesdelaagencia"] == "x") {
            $item = null;
            $valor = null;
            $inter = null;

            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor, $inter);

            foreach ($clientes as $key => $value) {

              echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td class="text-center">' . $value["tip_doc_abreviatura"] . '</td>

                    <td class="text-right">' . $value["cli_num_documento"] . '</td>

                    <td>' . $value["cli_nombre"] . ' ' . $value["cli_apellidos"] . '</td>

                    <td class="text-center">' . date('d/m/Y', strtotime($value['cli_fch_nacimiento'])) . '</td>';

                    $genero = $value['cli_genero'] == 1 ? "M" : "F";
                    echo '<td class="text-center">' . $genero . '</td>

                    <td class="text-center">' . $value["est_cvl_descripcion"] . '</td>

                    <td class="text-right">' . $value["cli_telefono"] . '</td>

                    <td>' . $value["cli_email"] . '</td>';

              // if($value["cli_estado"] != 0){
              //   echo '<td class="text-center"><button class="btn btn-success btn-xs btnActivarCliente" idCliente="'.$value["id_cliente"].'" estadoCliente="0">Activo</button></td>';
              // }else{  
              //   echo '<td class="text-center"><button class="btn btn-danger btn-xs btnActivarCliente" idCliente="'.$value["id_cliente"].'" estadoCliente="1">Inactivo</button></td>';
              // }

              echo '<td class="text-center">

                      <div class="btn-group">';
                      
              if ($_SESSION["permisos"]["Editaruncliente"] == "x") {            
                echo ' <button class="btn btn-primary btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id_cliente"] . '" style="float: none;"><i class="fa fa-pencil"></i></button>';
              }
              if ($_SESSION["permisos"]["Eliminarcliente"] == "x") {

                echo '<button class="btn btn-danger btnEliminarCliente" idCliente="' . $value["id_cliente"] . '" style="float: none;"><i class="fa fa-times"></i></button>';
              }

              echo '</div>

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
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">
          
          

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <!-- ENTRADA PARA EL TIPO DE DOCUMENTO ID -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>

                  <select class="form-control input-lg" name="nuevoTipoDocIdCliente" id="nuevoTipoDocIdCliente">

                    <option value="">Tipo de documento</option>

                    <?php

                    $item = null;
                    $valor = null;

                    $tipoDocumento = ControladorClientes::ctrMostrarTipoDocumento($item, $valor);

                    foreach ($tipoDocumento as $key => $value) {

                      echo '<option value="' . $value["id_tipo_documento"] . '">' . $value["tip_doc_descripcion"] . '</option>';

                    }

                    ?>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA EL NUMERO DE DOCUMENTO ID -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <input type="number" min="0" class="form-control input-lg" name="nuevoNumDocIdCliente" id="nuevoNumDocIdCliente" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="row">

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control input-lg" name="nuevoNombreCliente" id="nuevoNombreCliente" placeholder="Ingresar nombre" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL APELLIDO -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <input type="text" class="form-control input-lg" name="nuevoApellidoCliente" id="nuevoApellidoCliente" placeholder="Ingresar apellido" required>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

              <div class="col-lg-12 form-group">

                <div class="row">

                  <div class="col-xs-5 col-sm-4 col-md-4">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <select class="form-control input-lg" name="nuevoDiaNacCliente" id="nuevoDiaNacCliente" required>

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

                  </div>

                  <div class="col-xs-7 col-sm-4 col-md-4">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <select class="form-control input-lg" name="nuevoMesNacCliente" id="nuevoMesNacCliente" required>

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

                  </div>

                  <div class="col-xs-12 col-sm-4 col-md-4">

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <select class="form-control input-lg" name="nuevoAnioNacCliente" id="nuevoAnioNacCliente" required>

                        <option value="">Año</option>
                        <?php
                        for ($j = 1920; $j <= 2021; $j++) { ?>
                          <option value="<?php echo $j ?>"><?php echo $j ?></option><?php
                        }
                        ?>

                      </select>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA EL GÉNERO -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>

                  <select class="form-control input-lg" name="nuevoGeneroCliente" id="nuevoGeneroCliente" required>

                    <option value="">Género:</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA EL ESTADO CIVIL -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>

                  <select class="form-control input-lg" name="nuevoEstCivilCliente" id="nuevoEstCivilCliente">

                    <option value="">Estado civil</option>

                    <?php

                    $item = null;
                    $valor = null;

                    $estadoCivil = ControladorClientes::ctrMostrarEstadoCivil($item, $valor);

                    foreach ($estadoCivil as $key => $value) {

                      echo '<option value="' . $value["id_estado_civil"] . '">' . $value["est_cvl_descripcion"] . '</option>';
                    }

                    ?>

                  </select>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA EL TELÉFONO -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                  <input type="text" class="form-control input-lg" name="nuevoTelefonoCliente" id="nuevoTelefonoCliente" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                </div>

              </div>

              <!-- ENTRADA PARA EL EMAIL -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                  <input type="email" class="form-control input-lg" name="nuevoEmailCliente" id="nuevoEmailCliente" placeholder="Ingresar email">

                </div>

              </div>

            </div>

            <!-- ALERT DOCUMENTO ID EXISTENTE -->
            <div id="alertNumDocIdCliente"></div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cliente</button>

        </div>

      </form>

      <?php

      $crearCliente = new ControladorClientes();
      $crearCliente->ctrCrearCliente();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <!-- ENTRADA PARA EL TIPO DE DOCUMENTO ID -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>

                  <select class="form-control input-lg" name="editarTipoDocIdCliente" id="editarTipoDocIdCliente">

                    <option value="">Tipo de documento</option>

                    <?php

                    $item = null;
                    $valor = null;

                    $tipoDocumento = ControladorClientes::ctrMostrarTipoDocumento($item, $valor);

                    foreach ($tipoDocumento as $key => $value) {

                      echo '<option value="' . $value["id_tipo_documento"] . '">' . $value["tip_doc_descripcion"] . '</option>';

                    }

                    ?>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA EL NUMERO DE DOCUMENTO ID -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <input type="number" min="0" class="form-control input-lg" name="editarNumDocIdCliente" id="editarNumDocIdCliente" placeholder="Editar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="row">

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user"></i></span>

                  <input type="text" class="form-control input-lg" name="editarNombreCliente" id="editarNombreCliente" placeholder="Editar nombre" required>
                  <input type="hidden" id="idCliente" name="idCliente">
                  <input type="hidden" id="codCliente" name="codCliente">
                  <input type="hidden" id="id_inter" name="id_inter" value="<?php echo $_SESSION["intermediario"];?>">

                </div>

              </div>

              <!-- ENTRADA PARA EL APELLIDO -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <input type="text" class="form-control input-lg" name="editarApellidoCliente" id="editarApellidoCliente" placeholder="Editar apellido" required>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

              <div class="col-lg-12 form-group">

                <div class="row">

                  <div class="col-xs-5 col-sm-4 col-md-4">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <select class="form-control input-lg" name="editarDiaNacCliente" id="editarDiaNacCliente" required>

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

                  </div>

                  <div class="col-xs-7 col-sm-4 col-md-4">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <select class="form-control input-lg" name="editarMesNacCliente" id="editarMesNacCliente" required>

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

                  </div>

                  <div class="col-xs-12 col-sm-4 col-md-4">

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <select class="form-control input-lg" name="editarAnioNacCliente" id="editarAnioNacCliente" required>

                        <option value="">Año</option>
                        <?php
                        for ($j = 1920; $j <= 2021; $j++) { ?>
                          <option value="<?php echo $j ?>"><?php echo $j ?></option><?php
                        }
                        ?>

                      </select>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA EL GÉNERO -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>

                  <select class="form-control input-lg" name="editarGeneroCliente" id="editarGeneroCliente" required>

                    <option value="">Género:</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>

                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA EL ESTADO CIVIL -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>

                  <select class="form-control input-lg" name="editarEstCivilCliente" id="editarEstCivilCliente">

                    <option value="">Estado civil</option>

                    <?php

                    $item = null;
                    $valor = null;

                    $estadoCivil = ControladorClientes::ctrMostrarEstadoCivil($item, $valor);

                    foreach ($estadoCivil as $key => $value) {

                      echo '<option value="' . $value["id_estado_civil"] . '">' . $value["est_cvl_descripcion"] . '</option>';
                    }

                    ?>

                  </select>

                </div>

              </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA EL TELÉFONO -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                  <input type="text" class="form-control input-lg" name="editarTelefonoCliente" id="editarTelefonoCliente" placeholder="Editar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                </div>

              </div>

              <!-- ENTRADA PARA EL EMAIL -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                  <input type="email" class="form-control input-lg" name="editarEmailCliente" id="editarEmailCliente" placeholder="Editar email">

                </div>

              </div>

              <input type="hidden" id="idEstado" name="idEstado">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

      <?php

      $editarCliente = new ControladorClientes();
      $editarCliente->ctrEditarCliente();

      ?>

    </div>

  </div>

</div>

<?php

$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();

?>