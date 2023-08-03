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
        <h1>Administrar Planes de contratos</h1>
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
      
          <!-- Tabla de Planes -->
          <div class="card mt-4"  style="padding: 15px;">
            <button id="btnAgregarPlan" class="btnAgregarInter" data-toggle="modal" data-target="#modalAgregarPlan" onclick="abrirModalAgregarPlan('0', '0', '0','0','0','0','0','agregar')">
              Agregar Plan
            </button>
            <div class="box-body">
              <table  id="plansTable" class="table table-bordered table-striped dt-responsive" width="100%">
                <thead>
                  <tr>
                    <th>Id plan</th>
                    <th>Nombre plan</th>
                    <th>Número de cotizaciones por plan</th>
                    <th>Cantidad de usuarios</th>
                    <th>Cantidad de usuarios web</th>
                    <th>iframe</th>
                    <th>Cantidad recargas gratis anuales</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                  </tr>
                </thead>    
                <tbody>
                </tbody>
              </table>
            </div>
          </div>


        </div>

    </section>
  </div>
</div>

<!--=====================================
MODAL AGREGAR PLAN
======================================-->

<div id="modalAgregarPlan" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title" id='crearPlan'>Crear Plan</h4>
            <h4 class="modal-title" id='actualizarPlan'>Actualizar Plan</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="padding : 3rem">



            <div class="row">



                <!-- ENTRADA PARA EL NOMBRE DEL PLAN-->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
                        <input type="hidden" id="idPlanInput" value="" />
                        <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Nombre Plan" id="namePlan" required>

                    </div>

                </div>

                <!-- ENTRADA NUMERO DE COTIZACIONES -->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                    <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Cant. Cotizaciones" id="numCot" required>

                  </div>

                </div>

            </div>

            <div class="row">

              <!-- ENTRADA PARA CANTIDAD DE USUARIOS-->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
                  <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Cant. usuarios" id="cantUsu" required>

                </div>

              </div>

              <!-- ENTRADA PARA CANTIDAD DE USUARIOS WEB-->

              <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-user-plus" aria-hidden="true"></i></span>
                  <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Cant. usuarios web" id="cantUsuWeb" required>

                </div>

              </div>

            </div>

            <div class="row">



                <!-- ENTRADA PARA iframe-->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i></span>
                        <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Tiene iframe?" id="iframe" required>

                    </div>

                </div>

                <!-- ENTRADA PARA RECARGAS GRATIS ANUALES -->

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Recargas gratis anuales" id="freeCharges" required>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-xs-12 col-sm-6 col-md-6 form-group">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>

                        <input type="text" class="form-control input-lg" name="maxCot1" placeholder="Valor" id="valor" required>

                    </div>

                </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary pull-right" id="guardarPlanBtn">Guardar Plan</button>
          <button type="submit" class="btn btn-primary pull-right" id="actualizarPlanBtn">Actualizar Plan</button>
         
        </div>


      </form>

    </div>

  </div>

</div>


<script src="vistas/js/planes.js?v=<?php echo (rand()); ?>"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="vistas/js/cotizar.js?v=<?php echo (rand()); ?>"></script> -->
<!-- <script src="vistas/js/cotizaciones.js?v=<?php echo (rand()); ?>"></script> -->


<!-- <script src="vistas/js/invalidarPesadoDemo.js?v=<?php echo (rand()); ?>"></script> -->