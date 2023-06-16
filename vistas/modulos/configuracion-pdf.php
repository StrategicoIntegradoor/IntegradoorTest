<?php

if ($_SESSION["permisos"]["Configuraciondeplantillasdepdf"] != "x") {

    echo '<script>
  
      window.location = "inicio";
  
    </script>';
  
    return;
  }

?>

<style>

.BtnEditarPDFVertical{
    width: 25px;
    height: 30px;
    margin-left: 10% !important;
    margin-top: 1px !important;
}

.BtnEditarPDFHorizontal{
    width: 25px;
    height: 30px;
    margin-left: 10% !important;
    margin-top: 1px !important;
}

.BtnEditarPDFClasic{
    width: 25px;
    height: 30px;
    margin-left: 10% !important;
    margin-top: 1px !important;
}

.row_opciones{
    margin-top: 15px;
    margin-left: -30px;
}

.class_i{
    font-size: 25px;
    color:black;
}
.btnguardar {
        border-radius: 4px;
        background-color: #88D600;
        border: none;
        color: #FFFFFF !important;
        text-align: center;
        font-size: 18px;
        padding: 5px;
        width: 200px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
        /* box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7); */
    }

    .btneditar {
        border-radius: 4px;
        background-color: #9F9D9B;
        border: none;
        color: #FFFFFF !important;
        text-align: center;
        font-size: 18px;
        padding: 5px;
        width: 200px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
        /* box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7); */
    }

    .btnguardar {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }

    .btnguardar:after {
        content: '»';
        position: absolute;
        opacity: 0;
        top: 4px;
        right: -30px;
        transition: 0.5s;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">

        <h1 style="margin-bottom: 1%;">
        
            Configuracion del PDF
        
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Configuracion del PDF</li>

        </ol>

    </section>

    <section class="container-fluid">
        <div class="box">
            <div class="box-header with-border" style="padding-left: 9%; padding-top: 3%">  
                <div>
                    <strong style="font-size: 25px; color: #71706F">Seleccione el diseño de comparativo para tus clientes y marca la diferencia <img src="vistas/img/plantilla/checj.jpg" alt="" style="width: 4%;"></strong> 
                </div>
                <div style="margin-top: 3%;">
                    <strong style="font-size: 25px;">
                        Plantillas verticales
                    </strong>
                </div>
                <div class="row" style="margin-top: 3%;">
                    <div class="col-md-2" style="margin-right: 6%; margin-left: 1%">
                        <div class="row" style="border-style:solid; border-color: #88D600;">
                        <a data-toggle="modal" data-target=".bd-example-modal-xl-1"><img src="vistas/img/pdfconfig/pdf6/1.jpg" alt="" style="width: 99%; height: 65%;"></a>
                        </div>
                        <div class="row row_opciones">
                            <div class="col-md-4">
                                <label style="font-size: 20px; color:black;">Clasica</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="" id="" class="BtnEditarPDFClasic" checked>
                            </div>
                            <div class="col-md-2">
                                <a data-toggle="modal" data-target=".bd-example-modal-xl-1"><i class="fa fa-eye class_i" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2" style="margin-right: 6%; width: 240px;">
                    <div class="row" style="border-style:solid; border-color:red;">
                    <a data-toggle="modal" data-target=".bd-example-modal-xl-2"><img src="vistas/img/pdfconfig/pdf4/1.jpg" alt="" style="width: 100%; height: 65%;"></a>
                        </div>
                        <div class="row row_opciones">
                            <div class="col-md-4">
                                <label style="font-size: 20px; color:black;">xxxxxxx</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="" id="" class="BtnEditarPDFVertical">
                            </div>
                            <div class="col-md-2">
                                <a data-toggle="modal" data-target=".bd-example-modal-xl-2"><i class="fa fa-eye class_i" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="margin-right: 6%; width: 240px;">
                    <div class="row" style="border-style:solid; border-color: #0F15CA;">
                    <a data-toggle="modal" data-target=".bd-example-modal-xl-3"><img src="vistas/img/pdfconfig/pdf2/1.jpg" alt="" style="width: 100%; height: 60%;"></a>
                        </div>
                        <div class="row row_opciones">
                            <div class="col-md-4">
                                <label style="font-size: 20px; color:black;">Moderna</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="" id="" class="BtnEditarPDFVertical">
                            </div>
                            <div class="col-md-2">
                                <a data-toggle="modal" data-target=".bd-example-modal-xl-3"><i class="fa fa-eye class_i" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="margin-right: 6%; width: 240px;">
                    <div class="row" style="border-style:solid; border-color: #29B9BF">
                    <a data-toggle="modal" data-target=".bd-example-modal-xl-4"><img src="vistas/img/pdfconfig/pdf5/1.jpg" alt="" style="width: 100%; height: 40%;"></a>
                        </div>
                        <div class="row row_opciones">
                            <div class="col-md-4">
                                <label style="font-size: 20px; color:black;">xxxxxxx</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="" id="" class="BtnEditarPDFVertical">
                            </div>
                            <div class="col-md-2">
                                <a data-toggle="modal" data-target=".bd-example-modal-xl-4"><i class="fa fa-eye class_i" aria-hidden="true" ></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 3%;">
                    <strong style="font-size: 25px;">
                        Plantillas horizontales
                    </strong>
                </div>
                <div class="row" style="margin-top: 3%;">
                    <div class="col-md-3" style="margin-right: 4%; margin-left: 1%;">
                        <div class="row" style="border-style:solid; border-color: #0F15CA;width: 311px;height: 222px;" >
                            <a data-toggle="modal" data-target=".bd-example-modal-xl-5"><img src="vistas/img/pdfconfig/pdf1/1.jpg" alt="" style="width: 100%; height: 217px"></a>
                        </div>
                        <div class="row row_opciones">
                            <div class="col-md-3">
                                <label style="font-size: 20px; color:black;">xxxxxxx</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="" id="" class="BtnEditarPDFHorizontal">
                            </div>
                            <div class="col-md-2">
                                <a data-toggle="modal" data-target=".bd-example-modal-xl-5"><i class="fa fa-eye class_i" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-3" style="margin-right: 6%;">
                        <div class="row" style="border-style:solid; border-color: #29B9BF;width: 311px;height: 222px;">
                            <a data-toggle="modal" data-target=".bd-example-modal-xl-6"><img src="vistas/img/pdfconfig/pdf3/1.jpg" alt="" style="width: 100%; height: 217px;"></a>
                        </div>
                        <div class="row row_opciones">
                            <div class="col-md-3">
                                <label style="font-size: 20px; color:black;">xxxxxxx</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" name="" id="" class="BtnEditarPDFHorizontal">
                            </div>
                            <div class="col-md-2">
                                <a data-toggle="modal" data-target=".bd-example-modal-xl-6"><i class="fa fa-eye class_i" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>   
                </div> 
                <div class="row" style="margin-top: 3%;">
                    <div class="col-md-2">
                        <button type="submit" class="btn btnguardar" style="padding-inline: 24%; color:black;" id="btnguardar">Guardar</button>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btneditar" style="padding-inline: 24%; color:black;" id="BtnEditarPDF">Editar plantilla</button>
                    </div>
                </div>
            </div>    
        </div>
    </section>
</div>


<!-- Modales de los pdf grandes -->

<div class="modal fade bd-example-modal-xl-1" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="margin-left: 185px;">
    <div class="col-md-12" >
        <img src="vistas/img/pdfconfig/pdf6/1.jpg" alt="" style="width: 1100px;">
    </div>
    <div class="col-md-12">
        <img src="vistas/img/pdfconfig/pdf6/2.jpg" alt="" style="width: 1100px;">
    </div>
    <div class="col-md-12">
        <img src="vistas/img/pdfconfig/pdf6/3.jpg" alt="" style="width: 1100px;">
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-xl-2" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="margin-left: 185px;">
    <div class="col-md-12" >
        <img src="vistas/img/pdfconfig/pdf4/1.jpg" alt="" style="width: 1100px;">
    </div>
    <div class="col-md-12">
        <img src="vistas/img/pdfconfig/pdf4/2.jpg" alt="" style="width: 1100px;">
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-xl-3" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="margin-left: 185px;">
    <div class="col-md-12" >
        <img src="vistas/img/pdfconfig/pdf2/1.jpg" alt="" style="width: 1100px;">
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-xl-4" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="margin-left: 185px;">
    <div class="col-md-12" >
        <img src="vistas/img/pdfconfig/pdf5/1.jpg" alt="" style="width: 1100px;">
    </div>
    <div class="col-md-12">
        <img src="vistas/img/pdfconfig/pdf5/2.jpg" alt="" style="width: 1100px;">
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-xl-5" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="margin-left: 185px;">
    <div class="col-md-12" >
        <img src="vistas/img/pdfconfig/pdf1/1.jpg" alt="" style="width: 1100px;">
    </div>
    <div class="col-md-12">
        <img src="vistas/img/pdfconfig/pdf1/2.jpg" alt="" style="width: 1100px;">
    </div>
    <div class="col-md-12">
        <img src="vistas/img/pdfconfig/pdf1/3.jpg" alt="" style="width: 1100px;">
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-xl-6" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="margin-left: 185px;">
    <div class="col-md-12" >
        <img src="vistas/img/pdfconfig/pdf3/1.jpg" alt="" style="width: 1100px;">
    </div>
    <div class="col-md-12">
        <img src="vistas/img/pdfconfig/pdf3/2.jpg" alt="" style="width: 1100px;">
    </div>
  </div>
</div>

<script src="vistas/js/config-pdf.js?v=<?php echo (rand()); ?>"></script>