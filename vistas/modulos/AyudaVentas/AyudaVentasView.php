<?php

if ($_SESSION["permisos"]["Ayudaventas"] != "x") {

    echo '<script>
  
      window.location = "inicio";
  
    </script>';

    return;
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

                <!-- <div class="table-responsive"> -->
                    <table class="table table-bordered table-striped dt-responsive tablas-asistencias">
                        <colgroup>
                            <!-- Las primeras 5 columnas ocupan el 70% del ancho de la tabla -->
                            <col style="width: 14%;">
                            <col style="width: 14%;">
                            <col style="width: 14%;">
                            <col style="width: 14%;">
                            <col style="width: 14%;">
                            <!-- Las últimas 3 columnas ocupan el 30% del ancho de la tabla -->
                            <col style="width: 10%;">
                            <col style="width: 10%;">
                            <col style="width: 10%;">
                        </colgroup>
                        <thead style="background: #88d600; color: #FFF; ">
                            <tr>
                                <th style="text-align: center">Aseguradora</th>
                                <th style="text-align: center">Linea de atención</th>
                                <th style="text-align: center">Clausulado</th>
                                <th style="text-align: center">Sarlaft PN</th>
                                <th style="text-align: center">Sarlaft PJ</th>
                                <th style="text-align: center">Centro de inspección</th>
                                <th style="text-align: center">Continuidad</th>
                                <th style="text-align: center">Formas de pago</th>
                                <?php
                                if ($_SESSION["permisos"]["Editarinformaciondelayudaventas"] == "x") {
                                    echo '<th style="text-align: center">Editar</th>';
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody class="ayuda-ventas-body">
                        </tbody>
                    </table>
                <!-- </div> -->
            
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