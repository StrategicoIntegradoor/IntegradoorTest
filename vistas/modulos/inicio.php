<?php

if ($_SESSION['permisos']['id_rol'] == '19') {
  echo '<script>
      Swal.fire({
          title: "Módulo Habilitado",
          text: "Ya está habilitado el módulo para cotizar pesados.",
          icon: "success",
      }).then(function() {
          // Redirige si es necesario
          window.location = "https://integradoor.com/app/cotizar";
      });
  </script>';

  return;
  // Detén la ejecución del script actual
}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Inicio

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

    

    </ol>

  </section>