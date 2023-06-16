<?php

if($_SESSION["permisos"]["PerfilAgencia"] != "x"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>

<style>

input[type="checkbox"]{
    content: "";
    width: 26px;
    height: 26px;
    border: 2px solid #ccc;
    background: #ddd;
  }
  .contentnav {
    display: table;
    justify-content: space-around;
    margin: auto;
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

  .separador{
    margin-left: 15px;
  }
</style>

<div class="content-wrapper" style="margin-left: 50px;">
  <section class="content-header">

    <h1>
        
        Mi Perfil
        
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Perfil</li>

    </ol>

  </section>
  <section class="container-fluid">
    <div class="box">
      <div class="box-header with-border ">
        <div class="row">
          <div class="col-md-2" >
            <div class="info">
              <div class="avatar-wrapper" style="text-align: center;">
                <img class="profile-pic previsualizarEditar" src="vistas/img/usuarios/default/anonymous.png" width="80%" height="80%">

                <?php
                if($_SESSION["permisos"]["Modificarlogodepdfdecotizaciondelaagencia"] == "x"){	
                  echo '<label class="btn btn-primary">
                  <input type="file" name="ImgInter" id="ImgInter" style="display:none;" />
                  Subir archivo
                </label>';
                }
                ?>

                <input type="text" style="display: none;" id="fotoActual">
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div clas="row" style="margin-bottom: 30px;">
              <b style="font-size: 40px">Información General</b>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">Tipo de documento:</label>
              </div>
              <div class="col-md-3">
                <select name="tip_doc" id="tip_doc">
                  <option value="1">NIT</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="">Correo Electrónico:</label>
              </div>
              <div class="col-md-3">
                <input type="email" name="email" id="email">
              </div>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">No. Identificación:</label>
              </div>
              <div class="col-md-3">
                <input type="number" id="numero_identificacionInter">
              </div>
              <div class="col-md-3">
                <label for="">Dirección:</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="direccion" id="direccion">
              </div>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">Razón social:</label>
              </div>
              <div class="col-md-3">
                <input type="text" id="razon">
              </div>
              <div class="col-md-3">
                <label for="">Ciudad:</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="ciudad" id="ciudad">
              </div>
            </div>
            <div class="row" style="margin-bottom:22px;">
              <div class="col-md-3">
                <label for="">Nombre Representante Legal:</label>
              </div>
              <div class="col-md-3">
                <input type="text" id="repre">
              </div>
              <div class="col-md-3">
                <label for="">Nombre Persona de Contacto:</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="contac" id="contac">
              </div>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">No. Identificación:</label>
              </div>
              <div class="col-md-3">
                <input type="number" id="numero_identificacion_repre">
              </div>
              <div class="col-md-3">
                <label for="">Celular:</label>
              </div>
              <div class="col-md-3">
                <input type="number" name="cel" id="cel">
              </div>
            </div>
            <div clas="row" style="margin-bottom: 30px;">
              <b style="font-size: 35px">Información Aseguradoras Aliadas</b>
            </div>
            <div clas="row" style="margin-bottom: 30px;">
              <b style="font-size: 20px">Con que aseguradoras tienes clave como Intermediario:</b>
            </div>
            <div class="row" style="margin-bottom: 30px;">
              <div class="col-md-6">
                <div class="row text-center">
                  <div class="col-xs-3 col-md-2">
                    <span>Aseguradora</span>
                  </div>
                  <div class="col-xs-3 col-md-2 separador" >
                    <span>Tienes clave?</span>
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <span>Claves intermediación</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Allianz</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneAlli" id="tieneAlli">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaIAlli" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Bolivar</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneBoli" id="tieneBoli">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaBoli" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Equidad</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneEqui" id="tieneEqui">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaEqui" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Mapfre</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneMap" id="tieneMap">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaMap" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Previsora</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienePrevi" id="tienePrevi">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaPrevi" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Solidaria</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneSoli" id="tieneSoli">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaSoli" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Mundial</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneMund" id="tieneMund">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaMund" disabled="disabled">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
              <div class="row text-center">
                  <div class="col-xs-3 col-md-2">
                    <span>Aseguradora</span>
                  </div>
                  <div class="col-xs-3 col-md-2 separador">
                    <span>Tienes clave?</span>
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <span>Claves intermediación</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Liberty</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneLibe" id="tieneLibe">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaLibe" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Estado</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneEst" id="tieneEst">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaEst" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">AXA</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneAxa" id="tieneAxa">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaAxa" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">HDI</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienehdi" id="tienehdi" >
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparahdi" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">SBS</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienesbs" id="tienesbs">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparasbs" disabled="disabled">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Zurich</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienezuri" id="tienezuri">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparazuri" disabled="disabled" >
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Sura</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneSura" id="tieneSura">
                  </div>
                  <div class="col-xs-3 col-md-4">
                    <input type="text" id="claveparaSura" disabled="disabled">
                  </div>
                </div>
              </div>
            </div>
            <div class="row" >
            <div class="col-xs-6 col-sm-6 col-md-6">
            
                  <div class="panel"><b style="font-size: 20px">Vigencia de cotizaciones</b></div>
                  <label>Días</label>
                  <select name="vig_register" id="vig_register">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12 divBoton">
                <button class="btn btn-primary" onclick="activarCamposEditables()" style="color: black; margin-bottom:30px"><strong>Editar</strong></button>
                <div class="col-md-2 divBoton">
                <button class="btn btn-primary" onclick="guardarInfoInter()" style="color: black ; margin-bottom:30px"><strong>Actualizar</strong></button>
              </div>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
</div>





<!-- scrip -->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vistas/js/intermediario.js?v=<?php echo (rand()); ?>"></script>