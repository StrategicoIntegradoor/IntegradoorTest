$(document).ready(function () {
    let permisos = JSON.parse(permisosPlantilla);
})

                               /*==========================================
                                                PERMISOS
                                ==========================================*/

/*==============================================================================================================
Validamos el permiso para el boton que redirige a cotizar livianos en Admin Cotizaciones - ADM Cotizaciones
===============================================================================================================*/
    $("#btnRedLivianos").click (()=> 
    {
         permisoValidado = validarPermiso(permisos.Cotizarlivianoboton);
         if(permisoValidado){
            window.location.href = "cotizar"
         }else{
            mostrarAlerta();
         }
    })

/*==============================================================================================================
Validamos el permiso para ingresar al modulo de cotizar desde el menu - Menu
===============================================================================================================*/    
    $("#btnCotizarMenu").click (()=> 
    {
         permisoValidado = validarPermiso(permisos.Cotizarlivianos);
         if(permisoValidado){
            window.location.href = "cotizar"
         }else{
            mostrarAlerta();
         }
    })

/*==============================================================================================================
Validamos el permiso para ingresar al modulo ayudaventas desde el menu - Menu
===============================================================================================================*/
    $("#ayuda-ventas").click (()=> 
    {
         permisoValidado = validarPermiso(permisos.Ayudaventas);
         if(permisoValidado){
            window.location.href = "ayuda-ventas"
         }else{
            mostrarAlerta();
         }
    })

/*==============================================================================================================
Validamos el permiso para el boton en ayudaventas que genera pdfgenerico a persona natural - Ayudaventas
===============================================================================================================*/
    $("#safGenNat").click (()=> 
    {
        permisoValidado = validarPermiso(permisos.Descargarsarlaftpdfgenericos);
        if(permisoValidado){
            window.open('./vistas/modulos/AyudaVentas/pdf/sarlaft/14_Sarlaft_Generico.pdf');
        }else{
           mostrarAlerta();
        }
    })

/*==============================================================================================================
Validamos el permiso para el boton que genera pdfgenerico a persona juridica - Ayudaventas
===============================================================================================================*/    
    $("#safGenJur").click (()=> 
    {
        permisoValidado = validarPermiso(permisos.Descargarsarlaftpdfgenericos);
        if(permisoValidado){
            window.open('./vistas/modulos/AyudaVentas/pdf/sarlaft2/14_Sarlaft_Generico2.pdf');
        }else{
           mostrarAlerta();
        }
    })
  

/*==============================================================================================================
Validamos el permiso ir ingresar a los links de los clausulados - Ayudaventas
===============================================================================================================*/
    function validarPermisoClausulado(link)
    {
        permisoValidado = validarPermiso(permisos.Ingresaraloslinksdeclausulados);
        if(permisoValidado){
            window.open(link);
        }else{
            mostrarAlerta();
        }
    }; 

/*==============================================================================================================
Validamos el permiso para el boton que genera pdf persona natural de cada aseguradora - Ayudaventas
===============================================================================================================*/
    function validarPermisoPdfPersonaNatural(link, aseguradora)
    {
        console.log(aseguradora)

        if(link == './vistas/modulos/AyudaVentas/pdf/sarlaft/1' && aseguradora !== 'Estado'){

            Swal.fire({
                title: 'Mensaje',
                text: 'Este sarlaft se emite durante el proceso de emisión de póliza',
                icon: 'info'
            });

        }else if(link == './vistas/modulos/AyudaVentas/pdf/sarlaft/1' && aseguradora == 'Estado'){

            Swal.fire({
                title: 'Mensaje',
                text: 'Sarlaft Virtual - Comunicate con el área comercial o técnica',
                icon: 'info'
            });

        }else{
            permisoValidado = validarPermiso(permisos.DescargarpdfdecadaaseguradoraPN);
            if(permisoValidado){  
                window.open(link);
            }else{
            mostrarAlerta();
            }
        }
    }; 

/*==============================================================================================================
Validamos el permiso para el boton que genera pdf persona juridica de cada aseguradora - Ayudaventas
===============================================================================================================*/
    function validarPermisoPdfPersonaJuridica(link, aseguradora)
    {
        console.log(aseguradora)
        if(link == './vistas/modulos/AyudaVentas/pdf/sarlaft2/2' && aseguradora !== 'Estado'){

            Swal.fire({
                title: 'Mensaje',
                text: 'Este sarlaft se emite durante el proceso de emisión de póliza',
                icon: 'info'
            }); 

        }else if(link == './vistas/modulos/AyudaVentas/pdf/sarlaft2/2' && aseguradora == 'Estado'){

            Swal.fire({
                title: 'Mensaje',
                text: 'Sarlaft Virtual - Comunicate con el área comercial o técnica',
                icon: 'info'
            });

        }else{
            permisoValidado = validarPermiso(permisos.DescargarpdfdecadaaseguradoraPJ);
            if(permisoValidado){
                window.open(link);
            }else{
            mostrarAlerta();
            }
        }
    }; 

/*==============================================================================================================
Validamos el permiso para ingresar al modulo de configurar los pdf - Configuracion-Pdf
===============================================================================================================*/    
$("#configuracion-pdf").click (()=> 
{
    
    permisoValidado = validarPermiso(permisos.Configuraciondeplantillasdepdf);
    if(permisoValidado){
    window.location.href = "configuracion-pdf"
    }else{
        mostrarAlerta();
    }
})  

/*==============================================================================================================
Validamos el permiso para seleccionar plantillas verticales - Configuracion-Pdf
===============================================================================================================*/
    $(".BtnEditarPDFVertical").click (()=> 
        {
        permisoValidado = validarPermiso(permisos.Seleccionarplantillasverticales);
        if(permisoValidado){
            alert("Funcionalidad en Desarrollo");
            $(".BtnEditarPDFVertical").prop('checked',false);
        }else{
            mostrarAlerta();
            $(".BtnEditarPDFVertical").prop('checked',false);
        }
    })

/*==============================================================================================================
Validamos el permiso para seleccionar plantillas Horizontales  - Configuracion-Pdf 
===============================================================================================================*/    
    $(".BtnEditarPDFHorizontal").click (()=> 
        {
        permisoValidado = validarPermiso(permisos.Seleccionarplantillashorizontales
            );
        if(permisoValidado){
            alert("Funcionalidad en Desarrollo");
            $(".BtnEditarPDFHorizontal").prop('checked',false);
        }else{
            mostrarAlerta();
            $(".BtnEditarPDFHorizontal").prop('checked',false);
        }
    })


                                /*========================================
                                     METODOS PARA VALIDAR PERMISOS
                                ==========================================*/

/*=============================================
Funcion para validar si tiene o no el permiso
=============================================*/
function validarPermiso (permiso){
    if(permiso == "x"){
        return true;
    }else{
        return false;
    }
}


/*=================================================================
Funcion para hacer llamado a la alerta cuando no tiene el permiso 
=================================================================*/
function mostrarAlerta (){
    Swal.fire({
        icon: 'error',
        title: '¡Esta versión no tiene ésta funcionalidad disponible!',
        showCancelButton: true,
        confirmButtonText: 'Cerrar',
        cancelButtonText:'Conoce más'
      }).then((result) => {
        
        if (result.isConfirmed) {
        } else if (result.isDismissed
          ) {
            window.open('https://www.integradoor.com',"_blank")    
        }
      })
}