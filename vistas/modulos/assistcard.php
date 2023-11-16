

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
  border-radius: 20px;
  background-color: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  padding: 9%;
  max-width: 85%;  
  /* margin: 0 auto;   */
  min-height: 370px;
  max-height: 370px; 
  text-align: center; 
  margin-bottom: 10px; 
  display: flex; 
  flex-direction: column; 
  /* justify-content: center; */
  align-items: center;
}

.card-exequias-logo {
  border-radius: 20px;
  background-color: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  padding: 9%;
  max-width: 85%;  
  margin: 0 auto;  
  min-height: 370px;
  max-height: 370px;  
  border-radius: 20px;
  text-align: center; 
  margin-bottom: 10px; 
  display: flex; 
  flex-direction: column; 
  justify-content: center;
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
    flex-direction: column;
    align-items: center;
    height: 100%
}

.card-exequias .card-title{

    font-size: 24px;
    margin-bottom: 5%;
}

.card-exequias .card-text {
    font-size: 14px;
    margin-bottom: 2%;
}

/* .card-exequias .card-text {
    margin: 0 auto;  
  min-height: 100px;
  border-radius: 20px;
  text-align: center; 
  margin-bottom: 10px; 
  display: flex; 
  flex-direction: column; 
  justify-content: center;
} */

/* .card-exequias .card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    height: 100%;
} */

</style>

<div class="content-wrapper">
    <section class="content-header">

        <h1 style="margin-bottom: 0%;">

        Cotización seguro de viajes

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Viajes</li>

        </ol>

    </section>
    <section class="content">
        <div class="box">
            <div class="row">
                <!-- TITULO PLANES -->
                <div class="content">
                    
                    <!-- //LOGO Y DESCRIPCIÓN// -->
                        <!-- Primera tarjeta con el logo -->
                        <div class="col-md-4 col-sm-12 mb-3 justify-content-center">
                                <div class="card-exequias-logo">
                                    <div class="card-body text-center">
                                        <img src="vistas/img/plantilla/logo_assistcard.jpg" class="img-fluid" style="max-width: 100%;">
                                    </div>
                                </div>
                        </div>

                        <!-- Segunda tarjeta con título y párrafo -->
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias">
                                <div class="card-body">
                                    <h4 class="card-title" style="font-weight: bold;">¿Qué es una Asistencia en Viajes?</h4>
                                    <br>
                                    <p class="card-text">Conjunto de servicios ofrecidos que cubren los eventos penosos que se pueda incurrir durante un viaje en el extranjero, como gastos médicos, asistencia legal, cancelaciones de vuelos, perdidas de equipaje, muerte, entre otros.</p>
                                    <br>
                                    <p class="card-text">Con una asistencia de viaje, el pasajero cuenta con coberturas y montos de dinero específicos en caso de que le ocurra una emergencia estando en el exterior.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tercera tarjeta con título y párrafo -->
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias">
                                <div class="card-body">
                                    <h4 class="card-title" style="font-weight: bold;">Sobre Assist Card</h4>
                                    <br>
                                    <br>
                                    <p class="card-text">Pertenece al grupo STARR Companies, es la compañía N° 1 en el mundo dedicada a brindar asistencia al viajero de manera integral desde hace más de 43 años.</p>
                                    <br>
                                    <p class="card-text">Para conocer más sobre Assist Card, ingresa <a href="https://Grupoasistencia.com/pdfViajes/assistCard.pdf" target="_blank">AQUI</a></p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>


            <!-- //PLANES ADICIONALES -->
            <div class="row">
                <div class="content">
                    <!-- <div class="content-header">
                        <h4 style="font-family: 'Arial Arabic', Arial; text-align: left; font-weight: bold; margin-bottom: -12px; margin-top: -8px;">Adicionales Opcionales</h4>
                        <HR>
                    </div> -->
                    <!-- //AFILIADO ADICIONAL -->
                     <!-- cuarta tarjeta con título y párrafo -->
                     <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias">
                                <div class="card-body">
                                    <h4 class="card-title" style="font-weight: bold;">¿Cuales son sus principales coberturas?</h4>
                                    <ul class="card-text" style="list-style-type: disc; padding-left: 20px;">
                                        <li>Asistencia médica en caso de enfermedad (preexistente o no preexistente)</li>
                                        <li>Atención con especialistas </li>
                                        <li>Medicamentos ambulatorios</li>
                                        <li>Urgencias Odontológicas</li>
                                        <li>Repatriación o traslados sanitarios o funerarios</li>
                                        <li>Gastos de hotel por reposo forzoso (hospitalización)</li>
                                        <li>Traslado y estancia de un familiar (hospitalización)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- quinta tarjeta con título y párrafo -->
                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="card-exequias">
                                <div class="card-body">
                                    <h4 class="card-title" style="font-weight: bold;">¿Qué datos se requieren para cotizar?</h4>
                                    <p class="card-text">Este producto esta diseñado para todas las edades y necesidades. Para cotizarlo se requiere la siguiente información:</p>
                                    <ul class="card-text" style="list-style-type: disc; padding-left: 20px;">
                                        <li>Nombre Completo</li>
                                        <li>Fecha de Nacimiento</li>
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
                                <div class="card-body  text-center">
                                    <h4 class="card-title" style="font-weight: bold;">Comisión</h4>
                                    <br>
                                    <br>
                                    <p class="card-text">Todas las ventas que se generen de este producto tienen una comisión del 15% (75% de participación).</p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            

            <!-- //GENERADOR DE PDF -->
            <br>
            <div class="content">
                <!-- TITULO GENERADOR DE PDF -->
                <h4 style="font-family: 'Arial Arabic', Arial; text-align: left; font-weight: bold; margin-bottom: 12px; margin-top: -3px;">Solicita una cotización en el siguiente formulario</h4>
                <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdNXEYeuq8L5G15BQpGNKKt12cs7jzGvxYuqw2gdQaIH3qwGw/viewform?embedded=true" width="100%" height="2219" frameborder="0" marginheight="0" marginwidth="0">Cargando…</iframe>
            </div>
        </div>           
    </section>
</div>



