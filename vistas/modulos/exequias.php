

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
  
}

.rounded-container-logo {
  border-radius: 20px;
  background-color: white;
  box-shadow: 0 0 0px rgba(0, 0, 0, 0.3);
  padding: 10px;
  max-width: 400px; /* Ajusta el valor según tus necesidades */
  margin: 0 auto;
}

.circle {
        width: 100px;
        height: 100px;
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
  padding: 10px;
  max-width: 100%;  
  margin: 0 auto;  
  height: 100%;
  /* margin: 1% 0% 1% 0%; */
}

.row-card {
  padding-top: 3%;
  padding-left: 7%;
  padding-right: 7%;
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

</style>

<div class="content-wrapper">
    <section class="content-header">

        <h1 style="margin-bottom: 0%;">

        Cotización Plan exequial Los Olivos

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Exequias</li>

        </ol>

    </section>
    <section class="content">
        <div class="box">
            <div class="row">
                <!-- TITULO PLANES -->
                <div class="content">
                    <div class="content-header">
                        <h4 style="font-family: 'Arial Arabic', Arial; text-align: left; font-weight: bold; margin-bottom: -13px; margin-top: -15px;">Planes</h4>
                        <hr>
                    </div>
                    <!-- //LOGO Y DESCRIPCIÓN// -->
                    <div class="col-md-4 col-sm-12" style="text-align: center; margin-bottom: 10px;">
                        <div class="rounded-container-logo">
                            <div class="login-logo">
                                <img src="vistas/img/plantilla/logo_olivos.png" class="img-responsive" style="width: 60%;">
                            </div>
                                <!-- <img src="vistas/img/plantilla/logo_olivos.png" class="img-responsive" style="width: 250px; padding: 30px; margin: auto;"> -->
                                <div class="text" style="text-align: justify;">
                                    <p style="margin-bottom: 10px; margin-top: 10px; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif; margin-left: 35px;"><i class="fas fa-check" style="color: #82d600;"></i> La mejor y más grande red de servicios exequiales.</p>
                                    <p style="margin-bottom: 10px; margin-top: 10px; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif; margin-left: 35px;"><i class="fas fa-check" style="color: #82d600;"></i> 47 años creando experiencias memorables.</p>
                                    <p style="margin-bottom: 10px; margin-top: 10px; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif; margin-left: 35px;"><i class="fas fa-check" style="color: #82d600;"></i> Cumplimiento de promesa del producto garantizada.</p>
                                    <p style="margin-bottom: 10px; margin-top: 10px; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif; margin-left: 35px;"><i class="fas fa-check" style="color: #82d600;"></i> Cubrimiento del 100% del territorio Colombiano.</p>
                                </div>
                        </div>               
                    </div>
                    <!-- //PLAN MUY PERSONAL// -->
                    <div class="col-md-4 col-sm-12" style="margin-bottom: 10px;">
                        <div class="rounded-container">
                            <div class="row-card" style="display: flex; align-items: start;">
                                <div class="col-md-4 col-sm-4" style="display: flex; align-items: center; justify-content: center;">
                                    <div class="circle">
                                        <img src="vistas/img/plantilla/plan_personal.jpg">
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8" style="text-align: center;">
                                    <h3 style="font-family: 'Arial Narrow OS Bold', Arial, sans-serif; font-size: 16px; text-align: right;  margin-top: 0%;"><strong>PLAN MUY PERSONAL</strong></h3>
                                    <div style="margin-left: 18%;">
                                        <h3 style="text-align: center;"><strong style="color: #82d600;">$ 72.000</strong></h3>
                                        <p style="margin-top: 0px; text-align: center;">Pago anual</p>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <!-- <div class="row-card" style="display: flex; align-items: start;">
                                <div class="col-md-6 col-sm-6" style="display: flex; align-items: center; justify-content: left;">
                                    <div class="circle">
                                        <img src="vistas/img/plantilla/plan_personal.jpg">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6" style="text-align: center;">
                                    <h3 style="font-family: 'Arial Narrow OS Bold', Arial, sans-serif; font-size: 14px; text-align: right;  margin-top: 0%;"><strong>PLAN MUY PERSONAL</strong></h3>
                                    <h3 style="text-align: center;"><strong style="color: #82d600;">$ 72.000</strong></h3>
                                    <p style="margin-top: 0px; text-align: center;">Pago anual</p>
                                    <br>
                                </div>
                            </div> -->
                            <div class="row-card-end">
                                <div style="text-align: center;">
                                    <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif; color: transparent;">4 Beneficiarios hasta 55 años (Hijos, Hermanos,</p>
                                    <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">AFILIADO TITULAR:</p>
                                    <P style="margin-bottom: 5%; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">Titular hasta los 60 años</P>
                                    <p style="font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">Máx. 8 afiliados adicionales por titular</p>
                                    <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif; color: transparent;">2 Beneficiarios hasta 72 años (Padres o suegros)</p>
                                    <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif; color: transparent;">Nietos, Cónyuge)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //PLAN NUESTRA FAMILIA -->
                    <div class="col-md-4 col-sm-12" style="margin-bottom: 10px;">
                        <div class="rounded-container">
                            <div class="row-card" style="display: flex; align-items: start;">
                                <div class="col-md-4 col-sm-4" style="display: flex; align-items: center; justify-content: center;">
                                    <div class="circle">
                                        <img src="vistas/img/plantilla/plan_familiar.jpg">
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8" style="text-align: center;">
                                    <h3 style="font-family: 'Arial Narrow OS Bold', Arial, sans-serif; font-size: 16px; text-align: right;  margin-top: 0%;"><strong>PLAN NUESTRA FAMILIA</strong></h3>
                                    <div style="margin-left: 18%;">
                                        <h3 style="text-align: center;"><strong style="color: #82d600;">$ 264.000</strong></h3>
                                        <p style="margin-top: 0px; text-align: center;">Pago anual</p>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row-card-end">
                                <div style="text-align: center;">
                                    <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">AFILIADO TITULAR:</p>
                                    <P style="margin-bottom: 5%; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">Titular hasta los 60 años</P>
                                    <p style="font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">Máx. 8 afiliados adicionales por titular</p>
                                    <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">2 Beneficiarios hasta 72 años (Padres o suegros)</p>
                                    <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">4 Beneficiarios hasta 55 años (Hijos, Hermanos,</p>
                                    <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">Nietos, Cónyuge)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4 col-sm-12" style="text-align: center;">
                        <div class="rounded-container">
                            <br>
                            <div class="row card-body">
                                <div class="col-md-6 col-sm-6" style="margin-left: 15px;">
                                    <div class="circle" style="position: relative; top: 15px;">
                                        <img src="vistas/img/plantilla/plan_familiar.jpg">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6" style="margin-left: 160px; margin-top: -140px;">
                                    <h4 style="margin-bottom: 5px;  font-family: 'Arial Narrow OS Bold', Arial, sans-serif; font-size: 15px;"><strong>PLAN NUESTRA FAMILIA</strong></h4>
                                    <h3><strong style="color: #82d600;">$ 264.000</strong></h3>
                                    <p style="margin-bottom: 5px; margin-top: 0;">Pago anual</p>
                                    <br>
                                    <p style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">AFILIADO TITULAR:</p>
                                    <P style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">Titular hasta los 60 años</P>
                                </div>         
                            </div>
                            <br>
                            <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">2 Beneficiarios hasta 72 años (Padres o suegros)</p>
                            <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">4 Beneficiarios hasta 55 años (Hijos, Hermanos,</p>
                            <p style="margin-bottom: 11px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif;">Nietos, Cónyuge)</p>
                        </div>
                    </div> -->
                </div>
            </div>


            <!-- //PLANES ADICIONALES -->
            <div class="row">
                <div class="content">
                    <div class="content-header">
                        <h4 style="font-family: 'Arial Arabic', Arial; text-align: left; font-weight: bold; margin-bottom: -12px; margin-top: -8px;">Planes adicionales</h4>
                        <HR>
                    </div>
                    <!-- //AFILIADO ADICIONAL -->
                    <div class="col-md-4 col-sm-12" style="text-align: center;  margin-bottom: 7px;">
                        <div class="rounded-container">
                            <div class="row-card">
                                <div class="col-md-4 col-sm-4" style="display: flex; align-items: center; justify-content: center;">
                                    <div class="circle">
                                        <img src="vistas/img/plantilla/afiliado_adicional.jpg">
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8" style="text-align: center;">
                                    <h4 style="font-family: 'Arial Narrow OS Bold', Arial, sans-serif; font-size: 15px;"><strong>AFILIADO ADICIONAL</strong></h4>
                                    <h3><strong style="color: #82d600;">$ 72.000</strong></h3>
                                    <p style="margin-bottom: 5px; margin-top: 0;">Pago anual</p>
                                    <br>
                                </div>         
                            </div>
                            <br>
                            <div class="row-card-end">
                                <p style="margin-bottom: 0px; margin-top: 0; font-size: 13px; font-family: 'Arial Arabic', Arial, sans-serif; color: transparent;">Nietos, Cónyuge</p>
                                <p style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">Para alguno de los planes hasta los 60 años y sin</p>
                                <p style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">restricción de parentesco</p>
                            </div>
                        </div>
                    </div>
                    <!-- //MASCOTAS -->
                    <div class="col-md-4 col-sm-12" style="text-align: center;  margin-bottom: 7px;">
                        <div class="rounded-container">
                            <div class="row-card">
                                <div class="col-md-4 col-sm-4" style="display: flex; align-items: center; justify-content: center;">
                                    <div class="circle">
                                        <img src="vistas/img/plantilla/mascotas.jpg">
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8" style="text-align: center;">
                                    <h4 style="margin-bottom: 5px;  font-family: 'Arial Narrow OS Bold', Arial, sans-serif; font-size: 15px;"><strong>MASCOTAS</strong></h4>
                                    <h3><strong style="color: #82d600;">$ 114.000</strong></h3>
                                    <p style="margin-bottom: 5px; margin-top: 0;">Pago anual</p>
                                    <br>
                                </div>         
                            </div>
                            <br>
                            <div class="row-card-end">
                                <p style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">Sólo para perros y gatos</p>
                                <p style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">Se debe contar con un plan exequial para incluir a la</p>
                                <p style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">mascota como un adicional</p>
                            </div>
                        </div>
                    </div>
                    <!-- //REPATRIACION -->
                    <div class="col-md-4 col-sm-12" style="text-align: center;">
                        <div class="rounded-container">
                            <div class="row-card">
                                <div class="col-md-4 col-sm-4" style="display: flex; align-items: center; justify-content: center;">
                                    <div class="circle">
                                        <img src="vistas/img/plantilla/avion.jpg">
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8" style="text-align: center;">
                                    <h4 style="margin-bottom: 5px;  font-family: 'Arial Narrow OS Bold', Arial, sans-serif; font-size: 15px;"><strong>REPATRIACIÓN</strong></h4>
                                    <h3><strong style="color: #82d600;">$ 144.000</strong></h3>
                                    <p style="margin-bottom: 5px; margin-top: 0;">Pago anual</p>
                                    <br>
                                </div>         
                            </div>
                            <br>
                            <div class="row-card-end">
                                <p style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">Cobertura Internacional</p>
                                <p style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">Se debe contar con un plan exequial para incluirlo</p>
                                <p style="margin-bottom: 0px; margin-top: 0; font-size: 15px; font-family: 'Arial Arabic', Arial, sans-serif;">como un adicional</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- //GENERADOR DE PDF -->
            <br>
            <div class="content">
                <!-- TITULO GENERADOR DE PDF -->
                <h4 style="font-family: 'Arial Arabic', Arial; text-align: left; font-weight: bold; margin-bottom: -12px; margin-top: -3px;">Generar cotización en PDF</h4>
                <hr>
                <form method="post" id="formResumTitu">
                    <div class="row">
                        <input type="hidden" class="form-control" id="idUsuario" value="<?php echo $_SESSION["idUsuario"];?>">
                        <div class="col-xs-12 col-sm-6 col-md-3 form-group" style="margin-bottom: 0;">
                            <label for="nombreTitular">Nombre Titular</label>
                            <input type="text" class="form-control" id="nombreTitular" name="nombreTitular" placeholder="Nombre completo" required>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 form-group" style="margin-bottom: 0;">
                            <label for="edadTitularID">Edad Titular</label>
                            <input type="text" class="form-control" id="edadTitularID" placeholder="Edad Titular" required>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 form-group" style="margin-bottom: 0;">
                            <label for="tipoPlanExequialID">Tipo plan exequial</label>
                            <select class="form-control" id="tipoPlanExequialID" required>
                                <option value="" selected>Tipo de plan</option>
                                <option value="1">Plan muy personal</option>
                                <option value="2">Plan familiar</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 form-group" style="margin-bottom: 0;" id="contenBtnConsultarExequial">
                            <button class="btn btn-primary btn-block" id="btnExequial">Cotizar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>           
    </section>
</div>


<script src="vistas/js/invitar.js?v=<?php echo (rand()); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="vistas/js/exequias.js?v=<?php echo (rand()); ?>"></script> -->
<script src="vistas/js/cotizar.js?v=<?php echo (rand()); ?>"></script>

