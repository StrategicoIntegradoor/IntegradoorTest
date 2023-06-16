<?php

if ($_SESSION["permisos"]["Agregarintermediario"] != "x") {

    echo '<script>
  
      window.location = "inicio";
  
    </script>';
  
    return;
  }
?>

<style>
  input[type="checkbox"] {
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

  .separador {
    margin-left: 15px;
  }
</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>Administrar Intermediarios</h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Intermediario</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <style>
          .btnAgregarInter {
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

          .btnAgregarInter {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
          }

          .btnAgregarInter:after {
            content: '»';
            position: absolute;
            opacity: 0;
            top: 4px;
            right: -30px;
            transition: 0.5s;
          }

        </style>
        <button class="btnAgregarInter" onclick="abrirmodalRegister()"data-toggle="modal" data-target="#modalAgregarIntermediario">

          Agregar intermediario

        </button>

      </div>

      <div class="box-body" id="tablaIntermediario">

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR INTERMEDIARIO
======================================-->

<div id="modalAgregarIntermediario" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form action="javascript:void(0);" id="formGuardarInter" > 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Intermediario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="padding : 3rem;margin-left: 22px;">



          <div class="row">

            <div class="row" style="margin-bottom: 22px; ">
              <div class="col-md-3">
                <label for="">Tipo de documento:</label>
              </div>
              <div class="col-md-3">
                <select name="tip_doc_register" id="tip_doc_register">

                  <option value="1">NIT</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="">Correo Electrónico:</label>
              </div>
              <div class="col-md-3">
                <input type="email" name="email_register" id="email_register" require>
              </div>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">No. Identificación:</label>
              </div>
              <div class="col-md-3">
                <input type="number" id="numero_identificacionInter_register" require>
              </div>
              <div class="col-md-3">
                <label for="">Dirección:</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="direccion_register" id="direccion_register" require>
              </div>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">Razón social:</label>
              </div>
              <div class="col-md-3">
                <input type="text" id="razon_register" require>
              </div>
              <div class="col-md-3">
                <label for="">Ciudad:</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="ciudad_register" id="ciudad_register" require>
              </div>
            </div>
            <div class="row" style="margin-bottom:22px;">
              <div class="col-md-3">
                <label for="">Nombre Representante Legal:</label>
              </div>
              <div class="col-md-3">
                <input type="text" id="repre_register" require>
              </div>
              <div class="col-md-3">
                <label for="">Nombre Persona de Contacto:</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="contac_register" id="contac_register" require>
              </div>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">No. Identificación:</label>
              </div>
              <div class="col-md-3">
                <input type="number" id="numero_identificacion_repre_register" require>
              </div>
              <div class="col-md-3">
                <label for="">Celular:</label>
              </div>
              <div class="col-md-3">
                <input type="number" name="cel" id="cel_register" require>
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
                <div class="row text-center" style="margin-bottom: 15px;">
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
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Allianz</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneAlli_register" id="tieneAlli_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaIAlli_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Bolivar</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneBoli_register" id="tieneBoli_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaBoli_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Equidad</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneEqui_register" id="tieneEqui_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaEqui_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Mapfre</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneMap_register" id="tieneMap_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaMap_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Previsora</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienePrevi_register" id="tienePrevi_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaPrevi_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Solidaria</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneSoli_register" id="tieneSoli_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaSoli_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Mundial</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneMund_register" id="tieneMund_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaMund_register" disabled="disabled">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row text-center" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <span>Aseguradora</span>
                  </div>
                  <div class="col-xs-3 col-md-2 separador">
                    <span>Tienes clave?</span>
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <span>Claves intermediación</span>
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Liberty</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneLibe_register" id="tieneLibe_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaLibe_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Estado</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneEst_register" id="tieneEst_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaEst_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">AXA</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneAxa_register" id="tieneAxa_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaAxa_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">HDI</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienehdi_register" id="tienehdi_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparahdi_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">SBS</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienesbs_register" id="tienesbs_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparasbs_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Zurich</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienezuri_register" id="tienezuri_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparazuri_register" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Sura</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneSura_register" id="tieneSura_register">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaSura_register" disabled="disabled">
                  </div>
                </div>
              </div>
              <div clas="row" style="margin-bottom: 30px;">
                <b style="font-size: 20px">Credenciales Webservice</b>
              </div>

              <!-- ::::::::::::::::CABEZOTE CON NAVEGACION::::::::::::::::::::::::::::::::::::::::::::::: -->
              <div class="row" style="margin-left: 20px;">
                <div class="col-12 ">
                  <ul class="nav nav-tabs contentnav">
                    <li role="presentation" class="classli active" id="ballili_register"><a class="classa" id="balli_register">Allianz</a></li>
                    <li role="presentation" class="classli" id="bbolili_register"><a class="classa" id="bboli_register">Bolivar</a></li>
                    <li role="presentation" class="classli" id="bequili_register"><a class="classa" id="bequi_register">La Equidad</a></li>
                    <li role="presentation" class="classli" id="bmapli_register"><a class="classa" id="bmap_register">Mapfre</a></li>
                    <li role="presentation" class="classli" id="bprevili_register"><a class="classa" id="bprevi_register">Previsora</a></li>
                    <li role="presentation" class="classli" id="bsolili_register"><a class="classa" id="bsoli_register">Solidaria</a></li>
                    <li role="presentation" class="classli" id="blibeli_register"><a class="classa" id="blibe_register">Liberty</a></li>
                    <li role="presentation" class="classli" id="bestali_register"><a class="classa" id="besta_register">Estado</a></li>
                    <li role="presentation" class="classli" id="baxali_register"><a class="classa" id="baxa_register">AXA</a></li>
                    <li role="presentation" class="classli" id="bhdili_register"><a class="classa" id="bhdi_register">HDI</a></li>
                    <li role="presentation" class="classli" id="bsbsli_register"><a class="classa" id="bsbs_register">SBS</a></li>
                    <li role="presentation" class="classli" id="bzurili_register"><a class="classa" id="bzuri_register">Zurich</a></li>
                  </ul>
                </div>
                <div class="row" id="allianzdiv_register">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Allianz</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="contraseñaAlli_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Id Partner:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="idPartAlli_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                          <div class="col-md-3">
                            <label for="">Id Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="idagentAlli_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Código Partner:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codigoPartAlli_register">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3" style="margin-bottom: 10px;">
                            <label for="">Código Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codigoagenAlli_register">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenAlli()">Guardar</button>
                    </div>
                  </div> -->
                  </div>
                </div>
                <div class="row" id="bolivardiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Bolivar</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Api Key</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="apikeyBo_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Clave Asesor:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text " name="contac" id="ClaveABo_register">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenBoli()">Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="equidaddiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Equidad</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="usuEqui_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contraseñaEqui_register" id="contraseñaEqui_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Codigo Sucursal</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codSucuEqui_register">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenEqui()">Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="mapfrediv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Mapfre</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-6">
                            <label for="">Ups, no hay nada que mostrar</label>
                          </div>

                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenMap()">Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="previsoradiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Previsora</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-6">
                            <label for="">Ups, no hay nada que mostrar</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenPrevi()" disabled>Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="solidariadiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Solidaria</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Codigo Sucursal:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codSucuSoli_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Persona:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codPerSoli_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Tipo Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="tipAgeSoli_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="codigoAgeSoli" id="codigoAgeSoli_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Codigo Punto de venta:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codPunVenSoli_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Grant Type:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="grantTypeSoli_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Cookie:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="cookieSoli_register">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenSoli()">Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="libertydiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Liberty</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Cookie Token:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="cookieToLibe_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Cookie Peticion:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="cookieReLibe_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Autorización:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="autoLibe_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codigoAgenLibe_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Aplicacion Cliente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="ApliCliLibe_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Ip:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="ipLibe_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Id Request:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="idRequeLibe_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Terminal:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="termilibe_register">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenLiberty()">Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="estadodiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Estado</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="usuEst_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="ContraLibe_register">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenEst()">Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="axadiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Axa</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="contraseñaaxa_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Distribuidor:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codigodistriaxa_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Tipo Distribuidor:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="tipdistriaxa_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Ciudad:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codCiuaxa_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Canal:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="canalaxa_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Validacion de Eventos:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="valEveaxa_register">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenAxa()">Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="hdidiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales HDI</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Codigo Sucursal:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codSucurhdi_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codigoagenhdi_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="usuhdi_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="contraseñahdi_register">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenHdi()">Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="sbsdiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales SBS</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="ususbs_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="contraseñasbs_register">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row" style="margin: 10px;">
                    <div class="col-md-12 divBoton">
                      <button class="btn btn-primary" onclick="guardarcredenSbs()">Guardar</button>
                    </div>

                  </div> -->

                  </div>
                </div>
                <div class="row" id="zuridiv_register" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Zurich</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="usuzur_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="contraseñazur_register">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Correo:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="correozur_register">
                          </div>
                          <div class="col-md-3">
                            <label for="">Cookie:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="cookiezur_register">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="row" style="margin: 10px;">
                  <div class="col-md-12 divBoton">
                    <button class="btn btn-primary" onclick="guardarcredenZuri()">Guardar</button>
                  </div>
                </div> -->
                </div>
              </div>
              <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12 col-sm-6 col-md-6">

                  <div class="panel">Subir foto</div>

                  <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="90px">

                  <input type="file" class="nuevaFoto" name="nuevaFoto_register" id="img_register">

                  <p class="help-block">Peso máximo de la foto 2MB</p>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <div class="panel">Vigencia de cotizaciones</div>
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

            </div>
            <!--=====================================
        PIE DEL MODAL
        ======================================-->

            <div class="modal-footer">

              <button class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button class="btn btn-primary" id="agregar_Intermediario_btn" onclick="guardarinter()">Guardar Intermediario</button>

            </div>
          </div>
        </div>
      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR INTERMEDIARIO
======================================-->

<div id="modalEditarIntermediario" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form action="javascript:void(0);" id="formEditarInter" >

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Intermediario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="padding : 3rem;margin-left: 22px;">

          <div class="row">

            <div class="row" style="margin-bottom: 22px; ">
              <div class="col-md-3">
                <label for="">Tipo de documento:</label>
              </div>
              <div class="col-md-3">
                <select name="tip_doc_update" id="tip_doc_update">
                </select>
              </div>
              <div class="col-md-3">
                <label for="">Correo Electrónico:</label>
              </div>
              <div class="col-md-3">
                <input type="email" name="email_update" id="email_update">
              </div>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">No. Identificación:</label>
              </div>
              <div class="col-md-3">
                <input type="number" id="numero_identificacionInter_update">
              </div>
              <div class="col-md-3">
                <label for="">Dirección:</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="direccion_update" id="direccion_update">
              </div>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">Razón social:</label>
              </div>
              <div class="col-md-3">
                <input type="text" id="razon_update">
              </div>
              <div class="col-md-3">
                <label for="">Ciudad:</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="ciudad_update" id="ciudad_update">
              </div>
            </div>
            <div class="row" style="margin-bottom:22px;">
              <div class="col-md-3">
                <label for="">Nombre Representante Legal:</label>
              </div>
              <div class="col-md-3">
                <input type="text" id="repre_update">
              </div>
              <div class="col-md-3">
                <label for="">Nombre Persona de Contacto:</label>
              </div>
              <div class="col-md-3">
                <input type="text" name="contac_update" id="contac_update">
              </div>
            </div>
            <div class="row" style="margin-bottom: 22px;">
              <div class="col-md-3">
                <label for="">No. Identificación:</label>
              </div>
              <div class="col-md-3">
                <input type="number" id="numero_identificacion_repre_update">
              </div>
              <div class="col-md-3">
                <label for="">Celular:</label>
              </div>
              <div class="col-md-3">
                <input type="number" name="cel" id="cel_update">
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
                <div class="row text-center" style="margin-bottom: 15px;">
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
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Allianz</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneAlli_update" id="tieneAlli_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaIAlli_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Bolivar</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneBoli_update" id="tieneBoli_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaBoli_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Equidad</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneEqui_update" id="tieneEqui_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaEqui_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Mapfre</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneMap_update" id="tieneMap_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaMap_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Previsora</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienePrevi_update" id="tienePrevi_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaPrevi_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Solidaria</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneSoli_update" id="tieneSoli_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaSoli_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Mundial</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneMund_update" id="tieneMund_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaMund_update" disabled="disabled">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row text-center" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <span>Aseguradora</span>
                  </div>
                  <div class="col-xs-3 col-md-2 separador">
                    <span>Tienes clave?</span>
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <span>Claves intermediación</span>
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Liberty</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneLibe_update" id="tieneLibe_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaLibe_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Estado</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneEst_update" id="tieneEst_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaEst_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">AXA</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneAxa_update" id="tieneAxa_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaAxa_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">HDI</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienehdi_update" id="tienehdi_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparahdi_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">SBS</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienesbs_update" id="tienesbs_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparasbs_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Zurich</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tienezuri_update" id="tienezuri_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparazuri_update" disabled="disabled">
                  </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                  <div class="col-xs-3 col-md-2">
                    <label for="">Sura</label>
                  </div>
                  <div class="col-xs-3 col-md-2 text-center separador">
                    <input type="checkbox" name="tieneSura_update" id="tieneSura_update">
                  </div>
                  <div class="col-xs-3 col-md-4" style="margin-top: 3px">
                    <input type="text" id="claveparaSura_update" disabled="disabled">
                  </div>
                </div>
              </div>
              <div clas="row" style="margin-bottom: 30px;">
                <b style="font-size: 20px">Credenciales Webservice</b>
              </div>

              <!-- ::::::::::::::::CABEZOTE CON NAVEGACION::::::::::::::::::::::::::::::::::::::::::::::: -->
              <div class="row" style="margin-left: 20px;">
                <div class="col-12 ">
                  <ul class="nav nav-tabs contentnav">
                    <li role="presentation" class="classli active" id="ballili_update"><a class="classa" id="balli_update">Allianz</a></li>
                    <li role="presentation" class="classli" id="bbolili_update"><a class="classa" id="bboli_update">Bolivar</a></li>
                    <li role="presentation" class="classli" id="bequili_update"><a class="classa" id="bequi_update">La Equidad</a></li>
                    <li role="presentation" class="classli" id="bmapli_update"><a class="classa" id="bmap_update">Mapfre</a></li>
                    <li role="presentation" class="classli" id="bprevili_update"><a class="classa" id="bprevi_update">Previsora</a></li>
                    <li role="presentation" class="classli" id="bsolili_update"><a class="classa" id="bsoli_update">Solidaria</a></li>
                    <li role="presentation" class="classli" id="blibeli_update"><a class="classa" id="blibe_update">Liberty</a></li>
                    <li role="presentation" class="classli" id="bestali_update"><a class="classa" id="besta_update">Estado</a></li>
                    <li role="presentation" class="classli" id="baxali_update"><a class="classa" id="baxa_update">AXA</a></li>
                    <li role="presentation" class="classli" id="bhdili_update"><a class="classa" id="bhdi_update">HDI</a></li>
                    <li role="presentation" class="classli" id="bsbsli_update"><a class="classa" id="bsbs_update">SBS</a></li>
                    <li role="presentation" class="classli" id="bzurili_update"><a class="classa" id="bzuri_update">Zurich</a></li>
                  </ul>
                </div>
                <div class="row" id="allianzdiv_update">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Allianz</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="contraseñaAlli_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Id Partner:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="idPartAlli_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;">
                          <div class="col-md-3">
                            <label for="">Id Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="idagentAlli_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Código Partner:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codigoPartAlli_update">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3" style="margin-bottom: 10px;">
                            <label for="">Código Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codigoagenAlli_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="bolivardiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Bolivar</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Api Key</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="apikeyBo_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Clave Asesor:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text " name="contac" id="ClaveABo_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="equidaddiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Equidad</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="usuEqui_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contraseñaEqui" id="contraseñaEqui_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Codigo Sucursal</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codSucuEqui_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="mapfrediv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Mapfre</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-6">
                            <label for="">Ups, no hay nada que mostrar</label>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="previsoradiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Previsora</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-6">
                            <label for="">Ups, no hay nada que mostrar</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="solidariadiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Solidaria</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Codigo Sucursal:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codSucuSoli_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Persona:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codPerSoli_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Tipo Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="tipAgeSoli_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="codigoAgeSoli" id="codigoAgeSoli_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Codigo Punto de venta:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codPunVenSoli_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Grant Type:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="grantTypeSoli_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Cookie:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="cookieSoli_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="libertydiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Liberty</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Cookie Token:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="cookieToLibe_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Cookie Peticion:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="cookieReLibe_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Autorización:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="autoLibe_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codigoAgenLibe_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Aplicacion Cliente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="ApliCliLibe_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Ip:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="ipLibe_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Id Request:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="idRequeLibe_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Terminal:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="termilibe_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="estadodiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Estado</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px;">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="usuEst_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="ContraLibe_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="axadiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Axa</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="contraseñaaxa_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Distribuidor:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codigodistriaxa_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Tipo Distribuidor:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="tipdistriaxa_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Ciudad:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codCiuaxa_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Canal:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="canalaxa_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Validacion de Eventos:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="valEveaxa_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="hdidiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales HDI</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Codigo Sucursal:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="codSucurhdi_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Codigo Agente:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="codigoagenhdi_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="usuhdi_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="contraseñahdi_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="sbsdiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales SBS</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="ususbs_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="contraseñasbs_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="zuridiv_update" style="display: none;">
                  <div class="col-md-11">
                    <div class="row" style="display: flex;">
                      <div class="col-md-12" style="background-color: #88d600; color: white; width: 100%;">
                        <h4>Credenciales Zurich</h4>
                      </div>
                    </div>
                    <div class="row" style="padding:10px; border: 1px solid #ddd;">
                      <div class="col-md-12">
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Usuario:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="usuzur_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Contraseña:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="contraseñazur_update">
                          </div>
                        </div>
                        <div class="row" style="margin-bottom: 10px;margin-top: 5px">
                          <div class="col-md-3">
                            <label for="">Correo:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="correozur_update">
                          </div>
                          <div class="col-md-3">
                            <label for="">Cookie:</label>
                          </div>
                          <div class="col-md-3">
                            <input type="text" name="contac" id="cookiezur_update">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12 col-sm-6 col-md-6">

                  <div class="panel">Subir foto</div>

                  <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar_update" width="90px">

                  <input type="file" class="nuevaFoto" name="nuevaFoto_update" id="img_update">

                  <p class="help-block">Peso máximo de la foto 2MB</p>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <div class="panel">Vigencia de cotizaciones</div>
                  <label>Días</label>
                  <select name="cars_update" id="cars_update">
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
                  <input type="hidden" name="idInter" id="id_inter">
                </div>
              </div>

            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button class="btn btn-primary" id="editar_Intermediario_btn" onclick="actualizarInter()">Actualizar Intermediario</button>

        </div>


      </form>

    </div>

  </div>

</div>



<script src="vistas/js/intermediarioMenu.js?v=<?php echo (rand()); ?>"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <script src="vistas/js/invalidarPesadoDemo.js?v=<?php echo (rand()); ?>"></script> -->