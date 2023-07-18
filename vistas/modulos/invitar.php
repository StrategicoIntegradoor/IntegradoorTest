<head>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
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

  /* .contentnav {
    display: table;
    justify-content: space-around;
    margin: auto;
  } */

  .gray-header {
        color: #82d600;
    }

  .divBoton {
    display: flex;
    justify-content: end;
  }

  .nav-tabs>.classli>.classa {
    border: 1px solid lightgray;
    color: black;
  }


  .nav-tabs>.classli.active>.classa,
  .nav-tabs>.classli.active>.classa:focus,
  .nav-tabs>.classli.active>.classa:hover {
    color: #fff;
    cursor: default;
    background-color: #88d600;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
  }

  /* Sweep To Bottom */
  .botonSel {
    display: inline-block;
    vertical-align: middle;
    -webkit-transform: perspective(1px) translateZ(0);
    transform: perspective(1px) translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
    position: relative;
    -webkit-transition-property: color;
    transition-property: color;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
  }

  .botonSel:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #88d600;
    -webkit-transform: scaleY(0);
    transform: scaleY(0);
    -webkit-transform-origin: 50% 0;
    transform-origin: 50% 0;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out;
  }

  .botonSel:hover,
  .botonSel:focus,
  .botonSel:active {
    color: white;
  }

  .botonSel:hover:before,
  .botonSel:focus:before,
  .botonSel:active:before {
    -webkit-transform: scaleY(1);
    transform: scaleY(1);
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
  /* .input-group {
      display: flex;
      align-items: center;
  } */

  /*.placeholder {*/
  /*    position: absolute;*/
  /*    top: 0;*/
  /*    left: 0;*/
  /*    padding: 6px;*/
  /*    color: #aaa;*/
  /*    pointer-events: none;*/
  /*    transition: all 0.2s;*/
  /*}*/

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
</style>

<div class="content-wrapper">
    <section class="content-header">

        <h1>

        Invitación de registro Freelance 

        </h1>

        <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Invitacion</li>

        </ol>

    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <form id="formularioInvitacion" class="col-lg-12 form-resumAseg">
                  <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                      <label for="correo" style="display: block; text-align: left;">No. Identificación</label>   
                        <input type="text" class="form-control" placeholder="Número de identificación" id="cc" required>
                    </div>  
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                    <label for="correo" style="display: block; text-align: left;">Nombre Completo</label>   
                        <input type="text" class="form-control" placeholder="Nombre Completo" id="name" required>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                        <label for="correo" style="display: block; text-align: left;">Correo electrónico</label>   
                        <input type="text" class="form-control" placeholder="Correo electrónico" id="mail" required>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-3 form-group" style="margin-bottom: 0px;">
                          <button type="submit" class="btn btn-primary btn-block" id="btnInvitacion" style="font-size: 13px;">Enviar</button>
                          <br>
                          <div id="loaderOferta"></div>
                      </div>
                  </div>
                </form>
            </div>
            <br>
        </div>
    </section>
</div>

<!--<div class="content-wrapper">-->
<!--    <section class="content-header">-->

<!--        <h1>-->

<!--        Invitación de registro Freelance -->

<!--        </h1>-->

<!--        <ol class="breadcrumb">-->

<!--        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>-->

<!--        <li class="active">Cotizar Vehiculo liviano</li>-->

<!--        </ol>-->

<!--    </section>-->
<!--    <section class="content">-->
<!--        <div class="box">-->
<!--            <br>-->
<!--            <div class="form-container text-center">-->
<!--                <form style="width: 50%; margin: 0 auto;">-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 offset-md-3">-->
<!--                            <label for="correo" style="display: block; text-align: left;">No Identificación</label>   -->
<!--                            <div class="input-group" style="margin-bottom: 10px;">-->
<!--                                <span class="input-group-addon">-->
<!--                                    <i class="fa fa-id-card-o" aria-hidden="true"></i>-->
<!--                                </span>-->
<!--                                <input type="text" class="form-control text-left" placeholder="Número de identificación" id="cc" style="font-size: 15px; font-weight: bold; font-style: italic;">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <br>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 offset-md-3">-->
<!--                            <label for="correo" style="display: block; text-align: left;">Nombre Completo</label>   -->
<!--                            <div class="input-group" style="margin-bottom: 10px;">-->
<!--                                <span class="input-group-addon">-->
<!--                                    <i class="fa fa-pencil" aria-hidden="true"></i>-->
<!--                                </span>-->
<!--                                <input type="text" class="form-control text-left" placeholder="Nombre Completo" id="name" style="font-size: 15px; font-weight: bold; font-style: italic;">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <br>-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 offset-md-3">-->
<!--                            <label for="correo" style="display: block; text-align: left;">Correo electrónico</label>-->
<!--                            <div class="input-group" style="margin-bottom: 10px;">-->
<!--                                <span class="input-group-addon">-->
<!--                                    <i class="fa fa-envelope" aria-hidden="true"></i>-->
<!--                                </span>-->
<!--                                <input type="text" class="form-control text-left" placeholder="Correo electrónico" id="mail" style="font-size: 15px; font-weight: bold; font-style: italic;">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <br>-->
<!--                    <div class="row">-->
<!--                        <div class="text-center" style="margin-bottom: 6px;">-->
<!--                            <div style="width: 30%; margin: 0 auto;">-->
<!--                                <button type="button" class="btn btn-primary btn-block" onclick="authCedula()" style="font-size: 18px;">Enviar</button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
<!--            <br>-->
<!--        </div>-->
<!--    </section>-->
<!--</div>-->





<script src="vistas/js/invitar.js?v=<?php echo (rand()); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vistas/js/usuarios.js?v=<?php echo (rand()); ?>"></script>
<!-- <script src="vistas/js/invalidarPesadoDemo.js?v=<?php echo (rand()); ?>"></script> -->