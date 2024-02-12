<?php

session_start();

?>

<!DOCTYPE html>
<html>

<head>


  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

  <title>Multicotizador de Seguros</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/icono-blanco.png">

  <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css?v=<?php echo (rand()); ?>">
  <link rel="stylesheet" href="vistas/dist/css/styles_cotizador.css?v=<?php echo (rand()); ?>">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Integrador Skins -->
  <link rel="stylesheet" href="vistas/dist/css/styles_integrador.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">
  <!-- Select2 Bootstrap v0.1.0-beta.10 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/select2-bootstrap.min.css">

  <!-- Bootstrap Datepicker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });
  </script>
 

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <!-- <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script> -->
             <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <!-- <script src="vistas/plugins/sweetalert2/core-2.4.1.js"></script> -->

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- jQuery Numeric -->
  <script src="vistas/bower_components/jquery-numeric/jquery.numeric.js"></script>

  <!-- jQuery Redirect "POST" -->
  <script src="vistas/bower_components/jquery-redirect/jquery.redirect.js"></script>

  <!-- Ventana Centrada -->
  <script src="vistas/bower_components/ventana-centrada/VentanaCentrada.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Typeahead v4.0.2 "bootstrap" https://cdnjs.com/libraries/bootstrap-3-typeahead  -->
  <script src="vistas/bower_components/bootstrap-typeahead/bootstrap-typeahead.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <!-- <script src="vistas/bower_components/Chart.js/Chart.js"></script> -->

  <!-- Select2 -->
  <script src="vistas/bower_components/select2/dist/js/select2.min.js"></script>
  <script src="vistas/bower_components/select2/dist/js/i18n/es.js"></script>

  <!-- Bootstrap Datepicker -->
  <!-- <script src="vistas/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
  <!-- <script src="vistas/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script> -->

</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">



  <?php
  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    echo '<input type="hidden" id="fechaLimi" value="'.$_SESSION["fechaLimi"].'">';
    $permisos = $_SESSION["permisos"];

    ?>
    <script>
    var permisosPlantilla = '<?php echo json_encode($permisos);?>';
    </script>
    <?php
    

    echo '<div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabezote.php";

    /*=============================================
    MENU
    =============================================*/

    include "modulos/menu.php";


   

if ($_SESSION["permisos"]["Whatsapp"] == "x") { 

echo'<a href="https://web.whatsapp.com/send?phone=+573153539141" target="_blank" class="btn-wasap" style="float: unset; position: fixed; z-index: 999; bottom: 4%; left: 2%;">
<img src="vistas/img/logos/wasap.png" width="50" height="50" alt="" >
</a>';
}
?>

<?php
    /*=============================================
    CONTENIDO
    =============================================*/


    if (isset($_GET["ruta"])) {
      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "adminCoti" ||
        $_GET["ruta"] == "politicas" ||
        $_GET["ruta"] == "planes" ||
        $_GET["ruta"] == "clientes" ||
        $_GET["ruta"] == "cotizaciones" ||
        $_GET["ruta"] == "editar-cotizacion" ||
        $_GET["ruta"] == "editar-cotizacion-autogestion" ||
        $_GET["ruta"] == "editar-cotizacionpesados" ||
        $_GET["ruta"] =="livianoMasivas" ||
        /*:::::::::::::::::::::::::::::::::::::::::::::::::::
        Nuevas rutas
        :::::::::::::::::::::::::::::::::::::::::::::::::::*/ 
        $_GET["ruta"] == "cotizar"||
        $_GET["ruta"] == "pesados"||
        $_GET["ruta"] == "motos"||
        $_GET["ruta"] == "autogestion" ||
        $_GET["ruta"] == "salir" || 
        $_GET["ruta"] == "modificacion-productos" ||
        $_GET["ruta"] == "ayuda-ventas" ||
        $_GET["ruta"] == "perfilintermediario" ||
        $_GET["ruta"] == "intermediario" ||
        $_GET["ruta"] == "Productos" ||
        $_GET["ruta"] == "invitar" ||
        $_GET["ruta"] == "exequias" ||
        $_GET["ruta"] == "assistcard" ||
        $_GET["ruta"] == "soat" ||
        $_GET["ruta"] == "configuracion-pdf"
      ) {
        if ($_GET['ruta'] == 'modificacion-productos') {
          $_GET['ruta'] = 'ModificacionProductos/ModificacionProductosView';
        }
        if ($_GET['ruta'] == 'ayuda-ventas') {
          $_GET['ruta'] = 'AyudaVentas/AyudaVentasView';
        }
        include "modulos/" . $_GET["ruta"] . ".php";
      } else {

        include "modulos/404.php";
      }
    } else {

      include "modulos/inicio.php";

    }

    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";
    
    echo '</div>';
  } else {
    if (isset($_GET['codigo']) && $_GET['codigo'] != '') {
      $_SESSION["codigo"] = $_GET['codigo'];
      include "modulos/cambio-password.php";
    }
      // else if(isset($_GET["ruta"])){
      else if($_GET['ruta'] == 'change'){
          include "modulos/change.php";
        }
      else if($_GET['ruta'] == 'invitacion'){
        include "modulos/invitacion.php";
      }
    // }
    else {
      include "modulos/login.php";
    }
  }

  ?>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="vistas/js/authChange.js"></script>
  <script src="vistas/js/invitacion.js?v=<?php echo (rand()); ?>"></script>
  <!--<script src="vistas/js/pesados.js?v=<?php echo (rand()); ?>"></script>-->
  <script src="vistas/js/plantilla.js?v=<?php echo (rand()); ?>"></script>
  <!-- <script src="vistas/js/count.js?v=<?php echo (rand()); ?>"></script> -->
  <script src="vistas/js/clientes.js?v=<?php echo (rand()); ?>"></script>
  <script src="vistas/js/fasecolda.js?v=<?php echo (rand()); ?>"></script>
  <script src="vistas/js/cotizaciones.js?v=<?php echo (rand()); ?>"></script>
  <script src="vistas/js/validacionPermisos.js?v=<?php echo (rand()); ?>"></script>
  
</body>

</html>
