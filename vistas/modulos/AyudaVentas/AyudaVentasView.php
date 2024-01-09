<?php

if ($_SESSION["permisos"]["Ayudaventas"] != "x") {

    echo '<script>
  
      window.location = "inicio";
  
    </script>';

    return;
}

if ($_SESSION["permisos"]["AyudaVentasFreelance"] == "x") {
    $formasDePago = "x";
}

?>

<style>
    th {
        border: 0 !important;
    }

    ul {
        padding-left: 0;
    }

    li {
        text-align: start;
        list-style: none;
    }

    table {
    /* table-layout: fixed; */
    width: 100%;
    /* Puedes establecer el ancho total de la tabla aquí */
    }

    /* @media (max-width: 790px) {
    .table-media {
      overflow-x: auto;
    }
    } */

    .table-media {
        max-width: 1800px;
        overflow-x: auto;
    }

    .table th,
    .table td {
        vertical-align: middle; /* Puedes usar "top" o "bottom" en lugar de "middle" según tus necesidades */
    }

    .btn.btn-alert {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    }

    .text-config{
        font-size: 13px;
    }

    .columna-enlace {
        word-wrap: break-word;
    }

    .tablas-asistencias td {
        max-width: 200px;
        min-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tablas-asistencias td.fixed-width.continuidad,
    .tablas-asistencias td.fixed-width.cambio-intermediario {
        max-width: 200px;
        min-width: 180px !important;
        overflow: hidden;
    }



</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Ayuda Ventas</h1>

        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Ayuda Ventas</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
               

                <div style="text-align: right !important; margin-right: 2%">
                    <p id="fech_ult"></p>
                </div>

                 <!-- Form -->
                <form action="javascript:void(0);" class="form-editar-ayuda-venta" style="display: none; ">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                            <h4>Centros de inspección</h4>
                            <div id="centros_de_inspeccion"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h4>Continuidades</h4>
                            <div id="continuidades"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h4>Formas De Pago</h4>
                            <div id="formas_de_pago"></div>
                        </div>
                    </div>

                    <input type="hidden" id="aseguradora">
                    <input type="hidden" id="id_ayuda_venta">
                    <!-- <input type="hidden" id="rol" value="<?php echo $_SESSION["rol"]; ?>"> -->
                    <input type="hidden" id="rol" value="<?php echo $formasDePago; ?>">
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Linea de atención</label>
                            <input type="text" class="form-control" id="linea_atencion">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                            <label>Link Clausulado</label>
                            <input type="text" class="form-control" id="clausulado">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Sarlaft PN</label>
                            <input type="file" class="form-control" id="sarlaft">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Sarlaft PJ</label>
                            <input type="file" class="form-control" id="sarlaft2">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Continuidad</label>
                            <input type="text" class="form-control" id="continuidad">
                            <button id="agregarContinuidad">Agregar Continuidad</button>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Centro de inspección</label>
                            <input type="text" class="form-control" id="centro_inspeccion">
                            <button id="agregarCentroDeInspeccion">Agregar Centro</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Formas de pago</label>
                            <input type="text" class="form-control" id="forma_de_pago">
                            <button id="agregarFormaDePago">Agregar Forma De Pago</button>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Tips de expedición</label>
                            <input type="text" class="form-control" id="tips_expedicion">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <button id="editarAyudaVenta" class="btn btn-primary">
                                Editar
                            </button>
                        </div>
                    </div>
                </form>
                    <!-- END Form -->


                <div class="table table-media">
                    <table class="table table-bordered table-padding table-striped dt-responsive tablas-asistencias">

                        <thead style="background: #88d600; color: #FFF; ">
                            <tr>
                                <th style="width: 8%; text-align: center">Aseguradora</th>
                                <th style="width: 5%; text-align: center">Linea de atención</th>
                                <th style="width: 12%; text-align: center">Clausulado</th>
                                <th style="width: 6%; text-align: center">Sarlaft</th>
                                <!-- <th style="width: 7%; text-align: center">Sarlaft PJ</th> -->
                                <th style="width: 12%; text-align: center">Centro de inspección</th>
                                <th style="width: 14%; text-align: center">Continuidad</th>
                                <th style="width: 17%; text-align: center">Politicas cambio de Intermediario</th>
                                <th style="width: 15%; text-align: center">Formas de pago</th>
                                <?php
                                // if($_SESSION["permisos"]["ayudaventas_freelance"] == "x"){
                                //     echo '<th style="width: 15%; text-align: center">Formas de pago</th>';
                                // }
                                if ($_SESSION["permisos"]["Editarinformaciondelayudaventas"] == "x") {
                                    echo '<th style="text-align: center">Editar</th>';
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody class="ayuda-ventas-body">
                        </tbody>
                    </table>
                </div>
            
                <div style="margin-left: 1em; padding-bottom: 1em;">
                    <p>* PN: Persona Natural. PJ: Persona Jurídica</p>
                
                    <b>Sarlaft general PN:</b>
                    <button 
                    class="btn btn-primary" 
                    id="safGenNat"
                    style="background: red; color: #fff; font-weight: 500;">PDF</button>

                    <?php if ($_SESSION["permisos"]["Editarinformaciondelayudaventas"] == "x") {
                        echo '<button class="btn btn-primary" style="font-weight: 500;" id="btn_edit_generic1">Editar</button>';

                    } else {
                        echo '<div style="display: none;"><button class="btn btn-primary" style="font-weight: 500;" id="btn_edit_generic1">Editar</button></div>';

                    } ?>

                
                <p>
                <form action="javascript:void(0);" class="form-editar-generic1" style="display: none; ">
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <input type="file" class="form-control" id="sarlaftGeneric1">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <button id="editargeneric1" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </form>
                </p>
                <p>
                    <b>Sarlaft general PJ:</b>
                    <button 
                    class="btn btn-primary" 
                    id="safGenJur"
                    style="background: red; color: #fff; font-weight: 500; margin-left: 5px" >PDF</button>

                    <?php if ($_SESSION["permisos"]["Editarinformaciondelayudaventas"] == "x") {

                        echo '<button class="btn btn-primary" style="font-weight: 500;" id="btn_edit_generic2">Editar</button>';

                    } else {
                        echo '<div style="display: none;"><button class="btn btn-primary" style="font-weight: 500;" id="btn_edit_generic2">Editar</button></div>';
                    } ?>
                </p>
                <p>
                <form action="javascript:void(0);" class="form-editar-generic2" style="display: none; ">
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <input type="file" class="form-control" id="sarlaftGeneric2">
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <button id="editargeneric2" class="btn btn-primary">Editar</button>
                        </div>
                    </div>

                </form>
                </p>
            </div>
            </div>            
        </div>
    </section>
</div>

<script src="./vistas/modulos/AyudaVentas/ayuda-ventas.js"></script>