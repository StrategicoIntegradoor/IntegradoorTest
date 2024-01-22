

<head>
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

    .gray-header {
        color: #808080;
    }

    .divBoton {
        display: flex;
        justify-content: end;
    }

    .separador {
        margin-left: 15px;
    }

    .smaller-input {
    max-width: 200px;
    margin: 0 auto;
    }

    .input-addon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 325px;
        z-index: 1;
    }

    .placeholder {
        position: absolute;
        top: 0;
        left: 0;
        padding: 6px;
        color: #aaa;
        pointer-events: none;
        transition: all 0.2s;
    }

    .input-container {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .input-container .form-control {
        margin-left: 10px;
    }

    .form {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    }

    .form input {
    width: 90%;
    height: 80px;
    margin: 0.5rem;
    }

    .form button {
    padding: 0.5em 1em;
    border: none;
    background: rgb(100, 200, 255);
    cursor: pointer;
    }


    .container {
    display: flex;
    justify-content: center;
    }

    .login-logo {
    display: flex;
    justify-content: center;
    align-items: center;
    /* margin-right: 20px; */
    }

    .rounded-container {
    border-radius: 20px;
    background-color: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    padding: 10px;
    /* max-width: 400px; Ajusta el valor según tus necesidades */
    /* width: 390px; */
    /* height: 300px; */
    margin: 0 auto;
    /* margin: 10% 0% 10% 0%; */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    }

    .rounded-container-logo {
    border-radius: 20px;
    background-color: white;
    box-shadow: 0 0 0px rgba(0, 0, 0, 0.3);
    padding: 10px;
    max-width: 400px; /* Ajusta el valor según tus necesidades */
    margin: 0 auto;
    text-align: center; 
    margin-bottom: 10px; 
    display: flex; 
    flex-direction: column; 
    justify-content: center;
    }

    .circle-container {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%; /* Ajusta el ancho según tus necesidades */
    height: 100%; /* Ajusta la altura según tus necesidades */
    overflow: hidden; /* Oculta el contenido que se desborde del contenedor */
    }


    .circle {
            width: 90%;
            height: 90%;
            border-radius: 100%;
            overflow: hidden;
            /* margin-right: 5px; */
        }


    .circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #contenBtnConsultarExequial {
        padding-top: 25px;
    }

    .card-exequias {
    flex: 0 1 calc(15% - 0px); /* 48% es solo un ejemplo, ajusta según tus necesidades */
    border-radius: 20px;
    background-color: white;
    box-shadow: 0 0 7px rgba(0, 0, 0, 0.3);
    /* padding: 3.5% 7%; */
    padding: 10px 30px;
    max-width: 100%;  
    margin: 0 auto;
    margin-top: 12px; 
    /* min-height: 370px; */
    /* max-height: 370px;  */
    text-align: center; 
    margin-bottom: 12px; 
    display: flex; 
    flex-direction: column; 
    /* justify-content: center; */
    align-items: center;
    }

    .card-exequias-logo {
    flex: 0 1 calc(15% - 0px); /* 48% es solo un ejemplo, ajusta según tus necesidades */
    border-radius: 20px;
    background-color: white;
    box-shadow: 0 0 0px rgba(0, 0, 0, 0.3);
    /* padding: 3.5% 7%; */
    /* padding: 10px 30px; */
    max-width: 100%;  
    margin: 0 auto;
    margin-top: 12px; 
    /* min-height: 370px; */
    /* max-height: 370px;  */
    text-align: center; 
    margin-bottom: 12px; 
    display: flex; 
    flex-direction: column; 
    /* justify-content: center; */
    align-items: center;
    }


    .row-card {

    padding-top: 3%;
    padding-left: 3%;
    padding-right: 3%;
    display: flex;

    }

    .row-card-end {
    padding-bottom: 3%;
    padding-left: 7%;
    padding-right: 7%;
    }

    .error-message {
        display: none;
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    input:invalid + .error-message,
    select:invalid + .error-message {
        display: block;
    }

    .row1 {
        display: flex;

    }

    .card-text{

        text-align: justify;

    }

    .card-container {
    display: flex;
    flex-wrap: wrap;
    /* justify-content: space-between; */
    }

    .card-exequias .card-title{

        font-size: 19px;
        margin-bottom: 5.5%;
    }

    .card-exequias .card-text {
        font-size: 13px;
        margin-bottom: 14px;
    }

    /* Estilo para la card especial sin sombra en el borde */
    .special-card {
    box-shadow: none; /* Esto elimina la sombra */
    }

    .miIframe {
                width: 100%;
                max-width: none;
                height: 1200px;
                transition: width 0.5s;
    }

    .content-link {
        /* min-height: 250px; */
        padding: 15px;
        margin-right: auto;
        margin-left: auto;
        padding-left: 15px;
        padding-right: 15px;
    }

</style>

<div class="content-wrapper">
    <section class="content-header">

        <h1 style="margin-bottom: 0%;">

        Solicitud de Cotización SOAT

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">SOAT</li>

        </ol>

    </section>
    <section class="content">
        <div class="box">
            <div class="row card-container">
                <!-- TITULO PLANES -->
                <div class="content">
                    
                    <!-- //LOGO Y DESCRIPCIÓN// -->
                        <!-- Primera tarjeta con el logo -->
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias special-card">
                                <div class="card-body">
                                    <img src="vistas/img/plantilla/logo_assistcard.jpg" class="img-fluid mx-auto" style="max-width: 108%;">
                                </div>
                            </div>
                        </div>

                        <!-- Segunda tarjeta con título y párrafo -->
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias">
                                <div class="card-body">
                                    <h4 class="card-title" style="font-weight: bold;">PROCESO TRÁMITE SOAT</h4>
                                    <ul class="card-text" style="padding-left: 0px; list-style-type: decimal; list-style-position: inside;">
                                        <li>Diligenciar el formulario completamente adjuntando imagen de tarjeta de propiedad (por favor nombrar el documento con la placa del vehículo).</li>
                                        <li>Esperar cotización y confirmación (se verifica que vehículo no tenga errores en el RUNT).</li>
                                        <li>Realizar pago según cotización y envíar soporte al Whatsapp SOAT 3013232210.</li>
                                        <li>Esperar confirmación de recepción del pago en cuentas bancarias. </li>
                                        <li>Emitir SOAT (siempre a nombre del propietario según TP)</li>
                                        <li>Recibir SOAT en correo electrónico del tomador.</li>
                                        <li>Traslado y estancia de un familiar (hospitalización)</li>
                                        <li>Coberturas por extravío de equipajes</li>
                                    </ul>
                                    <p class="card-text">Notas: 1. Actualmente no tenemos habilitada la expedición de Motos (usadas ni 0 km). 2. Vehículos con errores en el RUNT se podrán emitir bajo autorización y con un cobro de servicio de trámite mayor.</p>
                                    <p class="card-text">Para conocer los valores del SOAT por tarifa, descarga el tarifario AQUI</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tercera tarjeta con título y párrafo -->
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias">
                                <div class="card-body">
                                    <h4 class="card-title" style="font-weight: bold;">VALOR COBRO SERVICIO DE TRÁMITE</h4>
                                    <p class="card-text">Opción 1 sin comisión: El aliado cobra al cliente el valor adicional que desee. En ese caso el valor de cobro por servicio de trámite en todas las tarifas (menos motos) es $35.000.</p>
                                    <p class="card-text">Opción 2 con comisión: Aliado recibe comisión de $20.000 por cada SOAT que se emita para sus clientes. El valor de cobro por servicio de trámite en todas las tarifas (menos motos) es:</p>
                                    <ul class="card-text" style="padding-left: 0px; list-style-position: inside;">
                                        <li>Asistencia médica en caso de enfermedad (preexistente o no preexistente)</li>
                                        <li>Atención con especialistas </li>
                                    </ul>
                                    <p class="card-text">Notas: 1. Los $20.000 de comisión se liquidan y cobran a través del área SOAT de Grupo Asistencia, y se pagan una vez se logren 5 SOAT, es decir,
                                    cada $100.000. 2. Actualmente no tenemos habilitada la expedición de Motos (usadas ni 0 km). 3. 
                                    Vehículos con errores en el RUNT se podrán emitir bajo autorización y con un cobro de servicio de trámite mayor.
                                    </p>
                                </div>
                            </div>
                        </div>
                            <!-- </div> -->
                        <!-- </div> -->


                        <!-- //INFORMACION SEGUNDA FILA -->
                        <!-- <div class="row card-container"> -->
                        <!-- <div class="content"> -->
                            <!-- <div class="content-header">
                                <h4 style="font-family: 'Arial Arabic', Arial; text-align: left; font-weight: bold; margin-bottom: -12px; margin-top: -8px;">Adicionales Opcionales</h4>
                                <HR>
                            </div> -->
                            <!-- //AFILIADO ADICIONAL -->
                            <!-- cuarta tarjeta con título y párrafo -->
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias">
                                <div class="card-body">
                                    <h4 class="card-title" style="font-weight: bold;">TIEMPO DE RESPUESTA</h4>
                                    <ul class="card-text" style="padding-left: 0px; list-style-position: inside;">
                                        <li>Asistencia médica en caso de enfermedad (preexistente o no preexistente)</li>
                                        <li>Atención con especialistas </li>
                                        <li>Medicamentos ambulatorios</li>
                                        <li>Urgencias Odontológicas</li>
                                        <li>Repatriación o traslados sanitarios o funerarios</li>
                                        <li>Gastos de hotel por reposo forzoso (hospitalización)</li>
                                        <li>Traslado y estancia de un familiar (hospitalización)</li>
                                        <li>Coberturas por extravío de equipajes</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- quinta tarjeta con título y párrafo -->
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias">
                                <div class="card-body">
                                    <h4 class="card-title" style="font-weight: bold;">DONDE PAGAR SERVICIO DE TRÁMITE</h4>
                                    <p class="card-text">Este producto esta diseñado para todas las edades y necesidades. Para cotizarlo se requiere la siguiente información:</p>
                                    <ul class="card-text" style="padding-left: 0px; list-style-position: inside;">
                                        <li>Nombre completo</li>
                                        <li>Fecha de nacimiento</li>
                                        <li>Motivo del viaje</li>
                                        <li>País de origen y destino</li>
                                        <li>Fecha de salida</li>
                                        <li>Fecha de regreso</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- sexta tarjeta con título y párrafo -->
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias">
                                <div class="card-body text-center">
                                    <h4 class="card-title" style="font-weight: bold;">INFORMACIÓN DE CONTACTO</h4>
                                    <p class="card-text">La <b>comisión que Assist Card ofrece para nuestra alianza de asesores es del 23%</b>. De este porcentaje, tu participación será de acuerdo al nivel de ventas de todos los negocios (sin IVA), sumando todos los ramos, que realices en el mes.</p>
                                    <ul class="card-text" style="padding-left: 0px; list-style-position: inside;">
                                        <li><b>Nivel 1: 67,5%</b></li>
                                        <li><b>Nivel 2: 70%</b></li>
                                        <li><b>Nivel 3: 75%</b></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                </div>


            </div>
            

                <!-- //FORMULARIO VIAJES -->
            <div class="content-link" style="margin-top: -5px;" data-evaluar="si">
                <p style="font-size: 16px;">Solicita una cotización en el siguiente formulario ingresado <b style="font-size: 17px;"><a href="https://Grupoasistencia.com/pdfExequias/PresentaciónComercialExequialLosOlivos.pdf" target="_blank">AQUI</a></b></p>
            </div>

        </div>           
    </section>
</div>

<script>

  document.addEventListener("DOMContentLoaded", function() {
    function ajustarAlturaTarjetas() {
      var filas = document.querySelectorAll('.row.card-container'); // Modificado el selector
      
      filas.forEach(function(fila) {
        var tarjetas = fila.querySelectorAll('.card-exequias');

        var alturaMaxima = 0;

        tarjetas.forEach(function(tarjeta) {
          tarjeta.style.height = 'auto'; // Restablecer la altura a 'auto' antes de medir
          var altura = tarjeta.offsetHeight;

          if (altura > alturaMaxima) {
            alturaMaxima = altura;
          }
        });

        tarjetas.forEach(function(tarjeta) {
          tarjeta.style.height = alturaMaxima + 'px';

          if (tarjeta.classList.contains('special-card')) {
          tarjeta.style.display = 'flex'; 
          tarjeta.style.flexDirection = 'column';
          tarjeta.style.alignItems = 'center'; 
          tarjeta.style.justifyContent = 'center'; 
          }

        });
      });
      
    }

    // Llamada inicial y en redimensionamiento de la ventana
    ajustarAlturaTarjetas();
    window.addEventListener('resize', ajustarAlturaTarjetas);
  });
</script>

