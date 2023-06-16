<?php
// if ($_SESSION["rol"] != 1 && $_SESSION["rol"] != 2) {
//   echo '<script>
//     window.location = "inicio";
//   </script>';

//   return;
// }
?>
 
<div class="content-wrapper">
  <section class="content-header">
    <h1>Admin. Cotizaciones Autogestión</h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Admin. cotizaciones - Autogestión</li>
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-body">
        <table
        id="tabla-test"
        class="table table-bordered 
        table-striped dt-responsive 
        tabla-cotizaciones-autogestion" width="100%">
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
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
<script src="vistas/js/cotizaciones_autogestion.js?v=<?php echo (rand()); ?>"></script>