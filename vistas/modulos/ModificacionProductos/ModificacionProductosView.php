<?php

if ($_SESSION["rol"] != 1 && $_SESSION["rol"] != 2) {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>

<style>
  .box-toast {
    z-index: 9999;
    width: 300px;
    height: 90px;
    position: fixed;
    top: 20px;
    right: 20px;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #88d600;
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    transition: right linear 0.5s;
  }

  .box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
  }

  .box-header {
    color: #88d600;
    display: block;
    padding: 10px;
    position: relative;
  }

  .box-body-toast {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;
  }

  .box-header .box-title-toast {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
  }

  .hidden {
    right: -320px;
  }

  .show {
    right: 20px;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Administrar productos</h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar productos</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <a id="btn-agregar-asistencia-formulario">
          <button class="btn btn-primary">
            Agregar nuevo producto
          </button>
        </a>
      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas-asistencias" width="100%">
          <thead>
            <tr>
              <th>N°</th>
              <th>Aseguradora</th>
              <th>Producto</th>
              <th>RCE</th>
              <th>Deducible</th>
              <th>Eventos</th>
              <th>Grúa</th>
              <th>Carro taller</th>
              <th>Asistencia jurídica</th>
              <th style="width:110px">Acciones</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

        <div id="formularioResumen">

          <!-- FORMULARIO RESUMEN ASEGURADO -->
          <form method="Post" id="formulario-asistencias" style="display: none;">

            <h2 id="formulario-titulo">Editar producto</h2>

            <div class="row">
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Aseguradora</label>
                <select class="form-control" id="aseguradora">
                  <option>Allianz</option>
                  <option>Axa Colpatria</option>
                  <option>Bolivar</option>
                  <option>Equidad</option>
                  <option>Estado</option>
                  <option>HDI</option>
                  <option>Liberty</option>
                  <option>Liberty Seguros</option>
                  <option>Mapfre</option>
                  <option>Previsora</option>
                  <option>SBS</option>
                  <option>Seguros Mundial</option>
                  <option>Solidaria</option>
                  <option>SURA</option>
                  <option>Zurich</option>
                </select>
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Producto</label>
                <input type="text" class="form-control" id="producto">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>RCE</label>
                <input type="text" class="form-control" id="rce">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Deducible</label>
                <input type="text" class="form-control" id="deducible">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Perdida total Hurto</label>
                <input type="text" class="form-control" id="pth">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Perdida parcial Daño</label>
                <input type="text" class="form-control" id="ppd">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Perdida parcial Hurto</label>
                <input type="text" class="form-control" id="pph">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Eventos</label>
                <input type="text" class="form-control" id="eventos">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Amparo patrimonial</label>
                <input type="text" class="form-control" id="amparoPatrimonial">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Grúa</label>
                <input type="text" class="form-control" id="grua">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Carro taller</label>
                <input type="text" class="form-control" id="carroTaller">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Asistencía jurídica</label>
                <input type="text" class="form-control" id="asistenciaJuridica">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Gastos de transporte perdida total</label>
                <input type="text" class="form-control" id="gastosDeTransportePt">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Gastos de transporte perdida parcial</label>
                <input type="text" class="form-control" id="gastosDeTransportePp">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Conductores elegidos</label>
                <input type="text" class="form-control" id="conductorElegido">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Transporte vehículo recuperado</label>
                <input type="text" class="form-control" id="transporteVehiculoRecuperado">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Transporte pasajeros varada</label>
                <input type="text" class="form-control" id="transportePasajerosVarada">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Accidentes personales</label>
                <input type="text" class="form-control" id="accidentesPersonales">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Pequeños accesorios</label>
                <input type="text" class="form-control" id="pequeniosAccesorios">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Llantas estalladas</label>
                <input type="text" class="form-control" id="llantasEstalladas">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Perdida de llaves</label>
                <input type="text" class="form-control" id="perdidaLlaves">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Color</label>
                <input type="text" class="form-control" id="color">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>RCE exceso</label>
                <input type="text" class="form-control" id="rceExceso">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Otro deducible</label>
                <input type="text" class="form-control" id="otroDeducible">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Asistencia nacional</label>
                <input type="text" class="form-control" id="asistenciaNacional">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Auxilio perdida patrimonial</label>
                <input type="text" class="form-control" id="auxilioPerdidaPatrimonial">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Auxilio perdida patrimonial terrorismo</label>
                <input type="text" class="form-control" id="auxilioPerdidaPatrimonialTerrorismo">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Perjuicios Extrapatrimoniales</label>
                <input type="text" class="form-control" id="perjuiciosExtraPatrimoniales">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Paralización de vehiculo</label>
                <input type="text" class="form-control" id="paralizacionVehiculo">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Obligación financiera</label>
                <input type="text" class="form-control" id="obligacionFinanciera">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Gastos funerarios</label>
                <input type="text" class="form-control" id="gastosFunerarios">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Gastos de recuperación</label>
                <input type="text" class="form-control" id="gastosRecuperacion">
              </div>
            </div>  

            <div class="row">
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Gastos de de grúa</label>
                <input type="text" class="form-control" id="gastosGrua">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Vehiculo de reemplazo Perdida total</label>
                <input type="text" class="form-control" id="vehiculoReemplazoPt">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Vehiculo de reemplazo Perdida parcial</label>
                <input type="text" class="form-control" id="vehiculoReemplazoPp">
              </div>
              <div class="form-group col-md-3 col-sm-6 col-xs-12">
                <label>Transporte pasajeros accidente</label>
                <input type="text" class="form-control" id="transportePasajerosAccidente">
              </div>
              <input type="hidden" id="id_asistencia">
            </div>

            <div class="row">
              <div class="col-md-offset-6 col-md-3 col-sm-6 col-xs-12">
                <button type="button" class="btn btn-block btn-danger" id="btn-cancelar-asistencia">Cancelar</button>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div id="buttons-container">
                  <button type="button" class="btn btn-block btn-primary" id="btn-agregar-asistencia">Consultar</button>
                </div>
              </div>
            </div>

            <!-- END  WORKZONE -->
          </form>

          <div class="box-toast hidden">
            <div class="box-header with-border">
              <h3 class="box-title-toast"></h3>
            </div>
            <div class="box-body-toast">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="vistas/js/modificacion_productos.js"></script>