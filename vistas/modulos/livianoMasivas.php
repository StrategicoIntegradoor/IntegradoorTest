
<?php
if ($_SESSION["permisos"]["Cotizacionesmasivas"] != "x") {

    echo '<script>
  
      window.location = "inicio";
  
    </script>';
  
    return;
  }
?>


<style>    
    .btncotiLivi {
        border-radius: 4px;
        background-color: #88D600;
        border: none;
        color: #fff;
        text-align: center;
        font-size: 18px;
        padding: 5px;
        width: 230px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
        /* box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7); */
    }

    .btnadjuntar {
        border-radius: 4px;
        background-color: #88D600;
        border: none;
        color: #fff;
        text-align: center;
        font-size: 18px;
        padding: 5px;
        width: 230px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
        /* box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7); */
    }
    .btndescargar {
        border-radius: 4px;
        background-color: #000;
        border: none;
        color: #fff;
        text-align: center;
        font-size: 18px;
        padding: 5px;
        width: 230px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
        /* box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7); */
    }

    .btncotiLivi {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }

    .btncotiLivi:after {
        content: '»';
        position: absolute;
        opacity: 0;
        top: 4px;
        right: -30px;
        transition: 0.5s;
    }

</style>


<div class="content-wrapper" style="margin-left: 50px;">
    <section class="content-header">

        <h1 style="margin-bottom: 1%; font-family: 'Source Sans Pro', sans-serif;">
        
            Cotización masiva livianos
        
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Cotización masiva livianos</li>

        </ol>

    </section>
    <section class="container-fluid">
        <div class="box">
            <div class="box-header">


                <a href="cotizar" class="btncotiLivi">

                    cotizar vehiculo individual

                </a>
        
                    
            </div>  
            
            <div class="box-body">
                <div style="margin-left: 13%; margin-right: 13%; border: solid; border-radius: 10px; border-color: #C0C6C6;">
                    <div class="row" style="margin-top: 2%;">
                        <div class="col-md-12 text-center">
                            <i class="fa fa-cloud-upload" aria-hidden="true" style="font-size: 100px; color: #88D600" ></i>
                        </div>
                    </div>
                    <div class="row text-center" style="margin-top: 1%;">
                        <div style="font-size: 20px; color: #A8ABAB">
                            <span>Adjunte su archivo csv aquí</span>
                        </div>
                    </div>
                    <div class="row text-center" style="margin-top: 15px;">
                        <label class="btn btn-primary btnadjuntar" style="margin-right: 5%;">
                            <input type="file" name="ArchivoCotMAs" id="ArchivoCotMAs" style="display:none;" accept=".csv"/>
                            Adjuntar archivo</label>
                            <a href="vistas/recursos/Plantilla cotizaciones Masivas.csv">
                                <button class="btn btn-danger btndescargar">Descargarplantilla</button>
                            </a>
                    </div>
                    <div class="row text-center" style="margin-top: 10%;">
                        <div class="col-md-6">
                            <div class="row" style="margin-bottom: 3%;">
                                <div class="col-md-6" style="margin-left: 25%;">
                                    <p>Solo se admite el formato CSV con</p> <p>maximo <strong>50</strong> placas y con un limite</p> <p>tamaño de 1 MB</p>
                                </div>
                                <div class="col-md-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="57" fill="currentColor" class="bi bi-filetype-csv" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.517 14.841a1.13 1.13 0 0 0 .401.823c.13.108.289.192.478.252.19.061.411.091.665.091.338 0 .624-.053.859-.158.236-.105.416-.252.539-.44.125-.189.187-.408.187-.656 0-.224-.045-.41-.134-.56a1.001 1.001 0 0 0-.375-.357 2.027 2.027 0 0 0-.566-.21l-.621-.144a.97.97 0 0 1-.404-.176.37.37 0 0 1-.144-.299c0-.156.062-.284.185-.384.125-.101.296-.152.512-.152.143 0 .266.023.37.068a.624.624 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.092 1.092 0 0 0-.2-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.551.05-.776.15-.225.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.122.524.082.149.2.27.352.367.152.095.332.167.539.213l.618.144c.207.049.361.113.463.193a.387.387 0 0 1 .152.326.505.505 0 0 1-.085.29.559.559 0 0 1-.255.193c-.111.047-.249.07-.413.07-.117 0-.223-.013-.32-.04a.838.838 0 0 1-.248-.115.578.578 0 0 1-.255-.384h-.765ZM.806 13.693c0-.248.034-.46.102-.633a.868.868 0 0 1 .302-.399.814.814 0 0 1 .475-.137c.15 0 .283.032.398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.441 1.441 0 0 0-.489-.272 1.838 1.838 0 0 0-.606-.097c-.356 0-.66.074-.911.223-.25.148-.44.359-.572.632-.13.274-.196.6-.196.979v.498c0 .379.064.704.193.976.131.271.322.48.572.626.25.145.554.217.914.217.293 0 .554-.055.785-.164.23-.11.414-.26.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.799.799 0 0 1-.118.363.7.7 0 0 1-.272.25.874.874 0 0 1-.401.087.845.845 0 0 1-.478-.132.833.833 0 0 1-.299-.392 1.699 1.699 0 0 1-.102-.627v-.495Zm8.239 2.238h-.953l-1.338-3.999h.917l.896 3.138h.038l.888-3.138h.879l-1.327 4Z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6" style="margin-left: 5%;">
                                    <p>Puede usar nuestra plantilla para</p> <p></p>ayudarlo a crear CSV</p><p> correctamente</p>
                                </div>
                                <div class="col-md-1" style="font-size: 55px;">
                                    <i class="fa fa-table" aria-hidden="true"></i>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <div style="text-align: right !important; margin-right: 13%; margin-bottom: 1%; margin-top: 2%;">
                    <button type="submit" class="btn btn-primary" style="padding-inline: 4%; color:black;" id="BtnCotizMasiva">Cotizar</button>
                </div> 
                <div class="row" id="msgCotizando"style="display: none;  margin-right: 1%; margin-left: 1%">
                    <i class="fa fa-clock-o" aria-hidden="true" style="color: #88d600;font-size: 50px;"></i>
                    <div" style="margin-top: 1px;">
                        <em style="font-size: 26px; margin-top:2%; margin-left: 1%">Estamos procesando tu consulta, danos un momento...</em>
                    </div>

                </div > 
                <div style="margin-top: 3%; border-bottom: 3px solid #A8ABAB; margin-left: 1%; margin-right: 1%; margin-bottom: 1%">
                    <strong style="font-size: 25px; margin-bottom: 1px">
                        Resultado de la consulta
                    </strong>
                </div>

                <div class="with-border" style="padding: 1%;">
                    <table class="table table-bordered table-striped dt-responsive tablas-cotizaciones" width="100%">
                        
                        <thead>
                        
                        <tr>
                        
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>Documento</th>
                        <th>Cliente</th>
                        <th>Placa</th>
                        <th>Referencia del Vehículo</th>
                        <th>Asesor</th>
                        <th style="width:110px">Acciones</th>

                        </tr> 

                        </thead>

                        <tbody>
                        <tr role="row" class="odd">

                            <td class="text-center sorting_1" tabindex="0">3</td>

                            <td class="text-center sorting_2">2022/09/13</td>

                            <td class="text-right">12345789</td>

                            <td class="text-right">Ricky Martin</td>
                            
                            <td class="text-center">ABC987</td>

                            <td class="">MAZDA 2 [2] TOURING SEDAN TP 1500CC 6AB</td>

                            <td class="">Juan</td>

                            <td class="text-center">

                            <div class="btn-group">
                            
                                <button class="btn btn-primary btnEditarCotizacion" idcotizacion="" disabled="disabled">Seleccionar</button></div>

                            </td>

                        </tr>
                        <tr role="row" class="odd">

                            <td class="text-center sorting_1" tabindex="0">2</td>

                            <td class="text-center sorting_2">2022/09/09</td>

                            <td class="text-right">90876543</td>

                            <td class="text-right">Marco Antonio Muñiz</td>
                            
                            <td class="text-center">ZYX234</td>

                            <td class="">HYUNDAI STAREX [1] H1 PANEL MT 2600CC DSL SA</td>

                            <td class="">Pablo</td>

                            <td class="text-center">

                            <div class="btn-group">
                            
                                <button class="btn btn-primary btnEditarCotizacion" idcotizacion="" disabled="disabled">Seleccionar</button></div>

                            </td>

                        </tr>
                        <tr role="row" class="odd">

                            <td class="text-center sorting_1" tabindex="0">1</td>

                            <td class="text-center sorting_2">2022/09/02</td>

                            <td class="text-right">34567891</td>

                            <td class="text-right">Alberto Aguilera Valadez</td>

                            <td class="text-center">YYY678</td>

                            <td class="">RENAULT STEPWAY [2] DYNAMIQUE / INTENS MT 1600CC AA 16V 2AB</td>

                            <td class="">Maria</td>

                            <td class="text-center">

                            <div class="btn-group">
                            
                                <button class="btn btn-primary btnEditarCotizacion" idcotizacion="" disabled="disabled">Seleccionar</button></div>

                            </td>

                        </tr>

                        <?php

                        if(isset($_GET["fechaInicialCotizaciones"])){

                            $fechaInicialCotizaciones = $_GET["fechaInicialCotizaciones"];
                            $fechaFinalCotizaciones = $_GET["fechaFinalCotizaciones"];

                        }else{

                            $fechaInicialCotizaciones = null;
                            $fechaFinalCotizaciones = null;

                        }

                        $respuesta = ControladorCotizaciones::ctrRangoFechasCotizaciones($fechaInicialCotizaciones, $fechaFinalCotizaciones);

                        foreach ($respuesta as $key => $value) {
                        
                        echo '<tr>

                                <td class="text-center">'. $value['id_cotizacion'] .'</td>

                                <td class="text-center">' . date('Y/m/d', strtotime($value['cot_fch_cotizacion'])) . '</td>

                                <td class="text-right">' . $value['cli_num_documento'] . '</td>

                                <td class="text-right">' . $value['cli_nombre'] . ' ' . $value['cli_apellidos'] . '</td>';

                                $placa = $value['cot_placa'] == "KZY000" ? "SIN PLACA" : $value['cot_placa'];
                                echo '<td class="text-center">' . $placa . '</td>

                                <td class="">' . $value['cot_marca'] . ' ' . $value['cot_linea'] . '</td>

                                <td class="">' . $value['usu_nombre'] . ' ' . $value['usu_apellido'] . '</td>

                                <td class="text-center">

                                    <div class="btn-group">
                                    
                                    <button class="btn btn-primary btnEditarCotizacion" idCotizacion="'.$value["id_cotizacion"].'">Seleccionar</button>';

                                    if($_SESSION["rol"] == 1){

                                    echo '<button class="btn btn-danger btnEliminarCotizacion" idCotizacion="'.$value["id_cotizacion"].'"><i class="fa fa-times"></i></button>';

                                    }

                                    echo '</div>

                                </td>

                                </tr>';
                            }

                        ?>
                            
                        </tbody>

                    </table>

                    <?php

                    $eliminarCotizacion = new ControladorCotizaciones();
                    $eliminarCotizacion -> ctrEliminarCotizacion();

                    ?>

                </div>
            </div>
        </div>
    </section>
</div>


<script src="vistas/js/mascivasLivi.js?v=<?php echo (rand()); ?>"></script>