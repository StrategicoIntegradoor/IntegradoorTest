<?php

if ($_SESSION["permisos"]["Modificaciondeproductos"] != "x") {

    echo '<script>
  
      window.location = "inicio";
  
    </script>';
  
    return;
  }

?>
<style>

body{
    font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
}
    .radios_Ampara{
        margin-left: 20px;
    }

    @media screen and (max-width: 500px) {
        .radios_Ampara{
            margin: 0px !important;
        }
    }

    @media screen and (max-width: 1000px) {
        .radios_Ampara{
            margin-left: 10px;
        }
    }

    .btnAgregarProducto {
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

    .btnAgregarProducto {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }

    .btnAgregarProducto:after {
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
        
            Productos
        
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Productos</li>

        </ol>

    </section>
    <section class="container-fluid">
        <div class="box">
            <div class="box-header with-border ">

            <?php

            if ($_SESSION["permisos"]["Agregarproducto"] == "x") {

                echo '<button class="btnAgregarProducto" data-toggle="modal">

                    Agregar producto

                </button>';
            }
            ?>
        
                <div class="row" style="margin-top: 2%; margin-left: 1%;">
                    <div class="col-md-3">
                        <label for="">Aseguradora</label>
                        <select class="form-control" name="Aseguradora" id="Aseguradora">
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="">Producto</label>

                        <select class="form-control" name="Producto_id" id="Producto_id">
                            <option value="1">Elige un producto</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top: 25px;">
            <?php
                    if ($_SESSION["permisos"]["Editarproductos"] == "x") {
                        echo '<button class="btn btn-primary" id="editarProducto"><i class="fa fa-pencil"></i></button>';
                    }
            ?>        
            <?php
                    if ($_SESSION["permisos"]["Eliminarproductos"] == "x") {
                        echo '<button class="btn btn-danger"><i class="fa fa-times"></i></button>';
                    }
            ?>        
                    </div>
                </div>
                <div class="row" style="margin-top:7%; margin-left: 4%;">
                    <div class="col-md-2" style="margin-top: 8px;">
                        <p>Responsabilidad Civil (RCE)</p>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="RCE">
                    </div>
                </div>
                <div class="row" style="margin-top:1%; margin-left: 4%;">
                    <div class="col-md-2" style="margin-top: 8px;">
                        <p>Deducible</p>
                    </div>
                    <div class="col-md-3">
                        <input type="text"class="form-control" id="Deducible" >
                    </div>
                </div>
                <div class="row" style="margin-top:2%; margin-left: 4%;">
                    <div class="col-md-6">
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <strong>COBERTURAS AL VEHÍCULO</strong>      
                            </div>
                            <div class="col-xs-3 col-md-3 text-center" >
                                <strong>¿Ampara?</strong>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <strong>Descripción</strong>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">Si</div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">No</div>
                                </div> 
                            </div>
                            <div class="col-xs-3 col-md-3">
                            </div>
                        </div>
                        <div class="row"style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Perdida total daños o hurto</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="ptdhSi" name="ptdh" >
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="ptdhNo" name="ptdh">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                            <input type="text" class="form-control" id="ptdhDesc" >
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Perdida parcial por daño</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="ppdSi" name="ppd">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="ppdNo" name="ppd">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                            <input type="text" class="form-control" id="ppdDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Perdida parcial por hurto</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="pphSi" name="pph">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="pphNo" name="pph">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="pphDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Cobertura por eventos de la naturaleza</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="eventosSi" name="eventos">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="eventosNo" name="eventos">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="eventosDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Amparo patrimonial</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="amparopatrimonialSi" name="amparopatrimonial">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="amparopatrimonialNo" name="amparopatrimonial">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="amparopatrimonialDesc">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:2%; margin-left: 4%;">
                    <div class="col-md-6">
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <strong>ASISTENCIAS</strong>      
                            </div>
                            <div class="col-xs-3 col-md-3 text-center" >
                                <strong>¿Ampara?</strong>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <strong>Descripción</strong>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">Si</div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">No</div>
                                </div> 
                            </div>
                            <div class="col-xs-3 col-md-3">
                            </div>
                        </div>
                        <div class="row"style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Grua varada o accidente</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="GruaSi" name="Grua">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="GruaNo" name="Grua">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="GruaDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">carrotaller <p>(desvare por: llanta, batería, gasolina o cerrajeria)</p></label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="CarrotallerSi" name="Carrotaller">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="CarrotallerNo" name="Carrotaller">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="CarrotallerDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">asistencia juridica en proceso penal</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="AsistenciajuridicaSi" name="Asistenciajuridica">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="AsistenciajuridicaNo" name="Asistenciajuridica">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="AsistenciajuridicaDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Gastos de transporte en perdida total</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="GastosdetransporteptSi" name="Gastosdetransportept">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="GastosdetransporteptNo" name="Gastosdetransportept">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="GastosdetransporteptDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Gastos de transporte en perdida parcial</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="GastosdetransporteppSi" name="Gastosdetransportepp">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="GastosdetransporteppNo" name="Gastosdetransportepp">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="GastosdetransporteppDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Vehiculo de reemplazo en perdida total</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="VehiculoreemplazoptSi" name="Vehiculoreemplazopt">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="VehiculoreemplazoptNo" name="Vehiculoreemplazopt">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="VehiculoreemplazoptDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Vehiculo de reemplazo en perdida parcial</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="VehiculoreemplazoppSi" name="Vehiculoreemplazopp">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="VehiculoreemplazoppNo" name="Vehiculoreemplazopp">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="VehiculoreemplazoppDesc">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <strong></strong>      
                            </div>
                            <div class="col-xs-3 col-md-3 text-center" >
                                <strong>¿Ampara?</strong>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <strong>Descripción</strong>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">Si</div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">No</div>
                                </div> 
                            </div>
                            <div class="col-xs-3 col-md-3">
                            </div>
                        </div>
                        <div class="row"style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Conductor elegido</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="ConductorelegidoSi" name="Conductorelegido">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="ConductorelegidoNo" name="Conductorelegido">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="ConductorelegidoDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Transporte del vehiculo recuperado</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="TransportevehiculorecuperdoSi" name="Transportevehiculorecuperdo">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="TransportevehiculorecuperdoNo" name="Transportevehiculorecuperdo">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="TransportevehiculorecuperdoDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">transporte de pasajeros por accidente</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="TransportepasajerosaccidenteSi" name="Transportepasajerosaccidente">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="TransportepasajerosaccidenteNo" name="Transportepasajerosaccidente">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="TransportepasajerosaccidenteDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Transporte de pasajeros por varada</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="TransportepasajerosvaradaSi" name="Transportepasajerosvarada">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="TransportepasajerosvaradaNo" name="Transportepasajerosvarada">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="TransportepasajerosvaradaDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Accidentes personales</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="AccidentespersonalesSi" name="Accidentespersonales">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="AccidentespersonalesNo" name="Accidentespersonales">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="AccidentespersonalesDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Pequeños accesorios</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="PequeniosaccesoriosSi" name="Pequeniosaccesorios">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="PequeniosaccesoriosNo" name="Pequeniosaccesorios">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="PequeniosaccesoriosDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Llantas estalladas</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="LlantasestalladasSi" name="Llantasestalladas">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="LlantasestalladasNo" name="Llantasestalladas">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="LlantasestalladasDesc">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-xs-4 col-md-4">
                                <label for="">Perdida de llaves</label>
                            </div>
                            <div class="col-xs-3 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="PerdidallavesSi" name="Perdidallaves">
                                    </div>
                                    <div class="col-md-2 col-xs-1 radios_Ampara">
                                        <input type="radio" id="PerdidallavesNo" name="Perdidallaves">
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xs-5 col-md-4">
                                <input type="text" class="form-control" id="PerdidallavesDesc">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align: right !important; margin-right: 4%; margin-bottom: 1%; margin-top: 2%;">
                    <button type="submit" class="btn btn-primary" style="padding-inline: 4%; color:black;" id="BtnEditarProducto" disabled="disabled">Guardar</button>
                </div>    
            </div>    
        </div>
    </section>
</div>





<!-- scrip -->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vistas/js/Productos.js?v=<?php echo (rand()); ?>"></script>