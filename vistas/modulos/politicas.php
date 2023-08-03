<head>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta2/css/all.css" integrity="sha384-OA4SkQ1hW5kfQF3/OBdzK99bg7sQKT6+yXxq5Iu7QvGrrkrBsX3p5SRy9CrJ0+Gx" crossorigin="anonymous">

</head>
<style>
  input[type="checkbox"] {
    content: "";
    width: 26px;
    height: 26px;
    border: 2px solid #ccc;
    background: #ddd;
  }

  .contentnav {
    display: table;
    justify-content: space-around;
    margin: auto;
  }

  .divBoton {
    display: flex;
    justify-content: end;
  }

  .nav-tabs>.classli>.classa {
    border: 1px solid lightgray;
    color: black;
  }


  .nav-tabs>.classli.active>.classa,
  .nav-tabs>.classli.active>.classa:focus,
  .nav-tabs>.classli.active>.classa:hover {
    color: #fff;
    cursor: default;
    background-color: #88d600;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
  }

  /* Sweep To Bottom */
  .botonSel {
    display: inline-block;
    vertical-align: middle;
    -webkit-transform: perspective(1px) translateZ(0);
    transform: perspective(1px) translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
    position: relative;
    -webkit-transition-property: color;
    transition-property: color;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
  }

  .botonSel:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #88d600;
    -webkit-transform: scaleY(0);
    transform: scaleY(0);
    -webkit-transform-origin: 50% 0;
    transform-origin: 50% 0;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out;
  }

  .botonSel:hover,
  .botonSel:focus,
  .botonSel:active {
    color: white;
  }

  .botonSel:hover:before,
  .botonSel:focus:before,
  .botonSel:active:before {
    -webkit-transform: scaleY(1);
    transform: scaleY(1);
  }

  .separador {
    margin-left: 15px;
  }
</style>

<div class="content">

  <!-- <section class="content-header">

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Politica</li>

    </ol>

  </section> -->


    <!--=====================================
    HTML TABLAS Y MODAL ENCABEZADOS
    ======================================-->
  <div class="content-wrapper">
    <section class="content">
      <section class="content-header">
        <h1>Administrar Políticas de contratos</h1>
      </section>
      <div class="box">

          <div class="box-header with-border">
            <style>
              .btnAgregarInter {
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

              .btnAgregarInter {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
              }

              .btnAgregarInter:after {
                content: '»';
                position: absolute;
                opacity: 0;
                top: 4px;
                right: -30px;
                transition: 0.5s;
              }

            </style>
          </div>
      
          <!-- Tabla de Políticas -->
          <div class="card mt-4"  style="padding: 15px;">
              <button id="btnAgregarPolitica" class="btnAgregarInter" data-toggle="modal" data-target="#modalAgregarPolitica" onclick="abrirModalAgregarPolitica('0', '0', '0','0','agregar')">
                Agregar Politica
              </button>
                  <div class="card-body">
                      <table  id="politicsTable" class="table table-bordered table-striped dt-responsive" width="100%">
                            <thead>
                              <tr>
                                <th>Id política</th>
                                <th>Descripción política</th>
                                <th>Dias para renovar</th>
                                <th>Dias máx. mora</th>
                                <th>Dias cancelación</th>
                                <th>Acciones</th>
                              </tr>
                            </thead>    
                          <tbody>
                          </tbody>
                      </table>
                  </div>
          </div>

          <!-- Tabla de Estados -->

            <div class="card mt-4" style="padding: 15px;">
              <button class="btnAgregarInter" onclick="abrirModalAgregarEstado('0', '0', 'agregar')" data-toggle="modal" data-target="#modalAgregarEstado">
                Crear Estado Contrato
              </button>
              <div class="card-body">
                  <table  id="stateTable" class="table table-bordered table-striped dt-responsive" width="100%">
                      <thead>
                          <tr>
                            <th>Id Estado contrato</th>
                            <th>Nombre estado contrato</th>
                            <th>Descripción estado contrato</th>
                            <th>Acciones</th>
                          </tr>
                      </thead>    
                      <tbody>
                      </tbody>
                  </table>
              </div>
            </div>

            <!-- Tabla tipo contrato -->

            <div class="card mt-4" style="padding: 15px;">
              <button class="btnAgregarInter" onclick="abrirModalAgregarTipo('0', '0', '0','0','agregar')" data-toggle="modal" data-target="#modalAgregarTipo">
                Crear Tipo Contrato
              </button>
                <div class="card-body">
                    <table  id="typeTable" class="table table-bordered table-striped dt-responsive" width="100%">
                        <thead>
                            <tr>
                              <th>Id Tipo Contrato</th>
                              <th>Modalidad Contrato</th>
                              <th>Tiempo duración contrato</th>
                              <th>Estado tipo contrato</th>
                              <th>Descripción tipo contrato</th>
                              <th>Acciones</th>
                            </tr>
                        </thead>    
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
                
              <!-- <div class="box-body" id="tablaPoliticas"></div> -->

      </div>

    </section>
  </div>
</div>

<!--=====================================
MODAL AGREGAR POLÍTICA
======================================-->

<div id="modalAgregarPolitica" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

          <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title" id='crearPolitica'>Crear Política</h4>
            <h4 class="modal-title" id='actualizarPolitica'>Actualizar Política</h4>

          </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="padding : 3rem">



          <div class="row">



                <!-- ENTRADA PARA EL NUMERO MAXIMO DE COTIZACIONES DIARIAS-->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
                    <input type="hidden" id="idPoliticaInput" value="" />
                    <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Descripción política" id="descriPol" required>

                  </div>

                </div>

                <!-- ENTRADA INGRESAR LA FECHA LIMITE DE USO -->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                    <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Dias para renovar" id="diasRenovar" required>

                  </div>

                </div>

          </div>

          <div class="row">

              <!-- ENTRADA PARA EL NUMERO MAXIMO DE Máx. Dias Mora-->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                  <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Máx. Dias Mora" id="diasMora" required>

                </div>

              </div>

              <!-- ENTRADA INGRESAR Dias cancelación -->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                  <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Dias cancelación" id="diasCancel" required>

                </div>

              </div>

          </div>



        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-right" id="guardarPoliticaBtn">Guardar Política</button>
          <button type="submit" class="btn btn-primary pull-right" id="actualizarPoliticaBtn">Actualizar Política</button>
         
        </div>


      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR ESTADO
======================================-->

<div id="modalAgregarEstado" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

          <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title" id='crearEstado'>Crear Estado</h4>
            <h4 class="modal-title" id='actualizarEstado'>Actualizar Estado</h4>

          </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="padding : 3rem">
          <div class="row">
                <!-- ENTRADA PARA EL NUMERO MAXIMO DE COTIZACIONES DIARIAS-->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
                    <input type="hidden" id="idEstadoInput" value="" />
                    <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Nombre estado contrato" id="nameEstado" required>

                  </div>

                </div>

                <!-- ENTRADA INGRESAR LA FECHA LIMITE DE USO -->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>

                    <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Descripcion estado contrato" id="descEstado" required>

                  </div>

                </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          
          <button type="submit" class="btn btn-primary pull-right" id="guardarEstadoBtn">Guardar Estado</button>
          <button type="submit" class="btn btn-primary pull-right" id="actualizarEstadoBtn">Actualizar Estado</button>
          
        </div>


      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR TIPO
======================================-->

<div id="modalAgregarTipo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

          <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title" id='crearTipo'>Crear Tipo</h4>
            <h4 class="modal-title" id='actualizarTipo'>Actualizar Tipo</h4>

          </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="padding : 3rem">
          <div class="row">
                <!-- ENTRADA PARA EL NUMERO MAXIMO DE COTIZACIONES DIARIAS-->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
                    <input type="hidden" id="idTipo" value="" />
                    <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Modalidad contrato" id="modalidad" required>

                  </div>

                </div>

                <!-- ENTRADA INGRESAR LA FECHA LIMITE DE USO -->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                    <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Tiempo duración contrato" id="duracion" required>

                  </div>

                </div>

          </div>
        </div>

        <div class="modal-body" style="padding : 3rem">
          <div class="row">
                <!-- ENTRADA PARA EL NUMERO MAXIMO DE COTIZACIONES DIARIAS-->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
                    <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Estado tipo contrato" id="estadoTipo" required>

                  </div>

                </div>

                <!-- ENTRADA INGRESAR LA FECHA LIMITE DE USO -->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>

                    <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Descripcion tipo contrato" id="descTipo" required>

                  </div>

                </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary pull-right" id="guardarTipoBtn">Guardar Tipo</button>
          <button type="submit" class="btn btn-primary pull-right" id="actualizarTipoBtn">Actualizar Tipo</button>

        </div>

      </form>

    </div>

  </div>

</div>


<script src="vistas/js/politicasMenu.js?v=<?php echo (rand()); ?>"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vistas/js/usuarios.js?v=<?php echo (rand()); ?>"></script>


<!-- <script src="vistas/js/invalidarPesadoDemo.js?v=<?php echo (rand()); ?>"></script> -->