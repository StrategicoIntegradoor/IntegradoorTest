(()=>{
    traerCredenciales();
    bloquearCampos ()
   
})()

let permisos = JSON.parse(permisosPlantilla);

//FUNCION CARGAR NUEVA FOTO

$("#ImgInter").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$("#ImgInter").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$("#ImgInter").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarEditar").attr("src", rutaImagen);

  		});

  	}

});



/*=============================================
Funcion para bloquear todos los campos al inico
=============================================*/
function bloquearCampos (){

    
        $("#tip_doc").prop('disabled', true);
        $("#email").prop('disabled', true);
        $("#numero_identificacionInter").prop('disabled', true);
        $("#repre").prop('disabled', true);
        $("#numero_identificacion_repre").prop('disabled', true);
        $("#email").prop('disabled', true);
        $("#direccion").prop('disabled', true);
        $("#ciudad").prop('disabled', true);
        $("#contac").prop('disabled', true);
        $("#cel").prop('disabled', true);
        $("#razon").prop('disabled', true);
        $("#tieneSoli").prop('disabled', true);
        $("#tieneBoli").prop('disabled', true);
        $("#tieneEqui").prop('disabled', true);
        $("#tieneMap").prop('disabled', true);
        $("#tienePrevi").prop('disabled', true);
        $("#tieneAlli").prop('disabled', true);
        $("#tieneAxa").prop('disabled', true);
        $("#tieneEst").prop('disabled', true);
        $("#tienehdi").prop('disabled', true);
        $("#tienesbs").prop('disabled', true);
        $("#tienezuri").prop('disabled', true);
        $("#tieneLibe").prop('disabled', true);
        $("#tieneMund").prop('disabled', true);
        $("#tieneSura").prop('disabled', true);
        $("#claveparaIAlli").prop('disabled', true);
        $("#claveparaBoli").prop('disabled', true);
        $("#claveparaEqui").prop('disabled', true);
        $("#claveparaMap").prop('disabled', true);
        $("#claveparaPrevi").prop('disabled', true);
        $("#claveparaAxa").prop('disabled', true);
        $("#claveparaEst").prop('disabled', true);
        $("#claveparahdi").prop('disabled', true);
        $("#claveparasbs").prop('disabled', true);
        $("#claveparaSoli").prop('disabled', true);
        $("#claveparazuri").prop('disabled', true);
        $("#claveparaLibe").prop('disabled', true);
        $("#claveparaMund").prop('disabled', true);
        $("#claveparaSura").prop('disabled', true);
        $("#vig_register").prop('disabled', true);
    
         

}

function activarCamposEditables(){

    if(permisos.Modificartipodedocumento == "x"){
        $("#tip_doc").prop('disabled', false);
    }
       if(permisos.ModificarCorreoElectronico == "x"){
        $("#email").prop('disabled', false);
       }
       if(permisos.MdificarNoidentificacion == "x"){
        $("#numero_identificacionInter").prop('disabled', false);
       }
       if(permisos.ModificarNombreRepresentanteLegal == "x"){
        $("#repre").prop('disabled', false);
       }
       if(permisos.Modificarnoidentificacionrepresentantelegal == "x"){
        $("#numero_identificacion_repre").prop('disabled', false);
       }
       if(permisos.ModificarCorreoElectronico == "x"){
        $("#email").prop('disabled', false);
       }
       if(permisos.ModificarDireccion == "x"){
        $("#direccion").prop('disabled', false);
       }
       if(permisos.Modificarciudad == "x"){
        $("#ciudad").prop('disabled', false);
       }
       if(permisos.ModificarNombrePersonadeContacto == "x"){
        $("#contac").prop('disabled', false);
       }
       if(permisos.Modificarcelular == "x"){
        $("#cel").prop('disabled', false);
       }
       if(permisos.Modificarrazonsocial == "x"){
        $("#razon").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneSoli").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneBoli").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneEqui").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneMap").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tienePrevi").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneAlli").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneAxa").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneEst").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tienehdi").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tienesbs").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tienezuri").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneLibe").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneMund").prop('disabled', false);
       }
       if(permisos.Marcarcasilladeclavedeintermediacion == "x"){
        $("#tieneSura").prop('disabled', false);
       }
       if(permisos.Modificartipodedocumento == "x"){
        $("#claveparaIAlli").prop('disabled', false);
       }
      if(permisos.Modificartipodedocumento == "x"){
         $("#claveparaBoli").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparaEqui").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparaMap").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparaPrevi").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparaAxa").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparaEst").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparahdi").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparasbs").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparaSoli").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparazuri").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparaLibe").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparaMund").prop('disabled', false);
      }
      if(permisos.Modificartipodedocumento == "x"){
          $("#claveparaSura").prop('disabled', false);
      }
      if(permisos.Seleccionardiasdevigenciadecotizacionenelpdf == "x"){
        $("#vig_register").prop('disabled', false);
    }
}



//funciones para cuando marquen aseguradora se habilite el campo del codigo

$("#tieneAlli").click(function () {
    if( $('#tieneAlli').is(':checked') ) {
        $("#claveparaIAlli").prop('disabled', false);
    }else{   
        $("#claveparaIAlli").prop('disabled', true);
        $("#claveparaIAlli").val("");
    }
})

$("#tieneBoli").click(function () {
    if( $('#tieneBoli').is(':checked') ) {
        $("#claveparaBoli").prop('disabled', false);
    }else{   
        $("#claveparaBoli").prop('disabled', true);
        $("#claveparaBoli").val("");
    }
})

$("#tieneEqui").click(function () {
    if( $('#tieneEqui').is(':checked') ) {
        $("#claveparaEqui").prop('disabled', false);
    }else{   
        $("#claveparaEqui").prop('disabled', true);
        $("#claveparaEqui").val("");
    }
})

$("#tieneMap").click(function () {
    if( $('#tieneMap').is(':checked') ) {
        $("#claveparaMap").prop('disabled', false);
    }else{   
        $("#claveparaMap").prop('disabled', true);
        $("#claveparaMap").val("");
    }
})

$("#tienePrevi").click(function () {
    if( $('#tienePrevi').is(':checked') ) {
        $("#claveparaPrevi").prop('disabled', false);
    }else{   
        $("#claveparaPrevi").prop('disabled', true);
        $("#claveparaPrevi").val("");
    }
})

$("#tieneSoli").click(function () {
    if( $('#tieneSoli').is(':checked') ) {
        $("#claveparaSoli").prop('disabled', false);
    }else{   
        $("#claveparaSoli").prop('disabled', true);
        $("#claveparaSoli").val("");
    }
})

$("#tieneLibe").click(function () {
    if( $('#tieneLibe').is(':checked') ) {
        $("#claveparaLibe").prop('disabled', false);
    }else{   
        $("#claveparaLibe").prop('disabled', true);
        $("#claveparaLibe").val("");
    }
})

$("#tieneEst").click(function () {
    if( $('#tieneEst').is(':checked') ) {
        $("#claveparaEst").prop('disabled', false);
    }else{   
        $("#claveparaEst").prop('disabled', true);
        $("#claveparaEst").val("");
    }
})

$("#tieneAxa").click(function () {
    if( $('#tieneAxa').is(':checked') ) {
        $("#claveparaAxa").prop('disabled', false);
    }else{   
        $("#claveparaAxa").prop('disabled', true);
        $("#claveparaAxa").val("");
    }
})

$("#tienehdi").click(function () {
    if( $('#tienehdi').is(':checked') ) {
        $("#claveparahdi").prop('disabled', false);
    }else{   
        $("#claveparahdi").prop('disabled', true);
        $("#claveparahdi").val("");
    }
})

$("#tienesbs").click(function () {
    if( $('#tienesbs').is(':checked') ) {
        $("#claveparasbs").prop('disabled', false);
    }else{   
        $("#claveparasbs").prop('disabled', true);
        $("#claveparasbs").val("");
    }
})

$("#tienezuri").click(function () {
    if( $('#tienezuri').is(':checked') ) {
        $("#claveparazuri").prop('disabled', false);
    }else{   
        $("#claveparazuri").prop('disabled', true);
        $("#claveparazuri").val("");
    }
})


///Funcion para traer credenciales

function traerCredenciales(){
    $.ajax({
        url: "controladores/intermediario.controlador.php?function=traerCrede",
        method: "POST",
        success: function (data) {
            
            data = JSON.parse(data);

            //enviar datos del intermediario al formulario de arriba
            $("#razon").val(data["nombre"]);
            $("#numero_identificacionInter").val(data["num_documento"]);
            $("#repre").val(data["nombre_representante"]);
            $("#numero_identificacion_repre").val(data["Identificacion"]);
            $("#email").val(data["correo"]);
            $("#direccion").val(data["direccion"]);
            $("#ciudad").val(data["ciudad"]);
            $("#contac").val(data["contacto"]);
            $("#cel").val(data["celular"]);
            $("#vig_register").val(data["intermediario_Fech_Vigen"]);
            if(data["codigo_alli"]){
                // $("#tieneAlli").prop("checked", true);
                // $("#claveparaIAlli").prop('disabled', false);
                $("#claveparaIAlli").val(data["codigo_alli"]);
            } 
            if(data["codigo_boli"]){
                // $("#claveparaBoli").prop('disabled', false);
                // $("#tieneBoli").prop("checked", true);
                $("#claveparaBoli").val(data["codigo_boli"]);
            }
            if(data["codigo_equi"]){
                // $("#tieneEqui").prop("checked", true);
                // $("#claveparaEqui").prop('disabled', false);
                $("#claveparaEqui").val(data["codigo_equi"]);
            }
            if(data["codigo_map"]){
                // $("#tieneMap").prop("checked", true);
                // $("#claveparaMap").prop('disabled', false);
                $("#claveparaMap").val(data["codigo_map"]);
            }
            if(data["codigo_previ"]){
                $("#claveparaPrevi").val(data["codigo_previ"]);
                // $("#tienePrevi").prop("checked", true);
                // $("#claveparaPrevi").prop('disabled', false);
            }
            if(data["codigo_soli"]){
                $("#claveparaSoli").val(data["codigo_soli"]);
                // $("#tieneSoli").prop("checked", true);
                // $("#claveparaSoli").prop('disabled', false);
            }
            if(data["codigo_libe"]){
                $("#claveparaLibe").val(data["codigo_libe"]);
                // $("#tieneLibe").prop("checked", true);
                // $("#claveparaLibe").prop('disabled', false);
            }
            if(data["codigo_est"]){
                $("#claveparaEst").val(data["codigo_est"]);
                // $("#tieneEst").prop("checked", true);
                // $("#claveparaEst").prop('disabled', false);
            }
            if(data["codigo_axa"]){
                $("#claveparaAxa").val(data["codigo_axa"]);
                // $("#tieneAxa").prop("checked", true);
                // $("#claveparaAxa").prop('disabled', false);
            }
            if(data["codigo_hdi"]){
                $("#claveparahdi").val(data["codigo_hdi"]);
                // $("#tienehdi").prop("checked", true);
                // $("#claveparahdi").prop('disabled', false);
            }
            if(data["codigo_sbs"]){
                if (data["codigo_sbs"] != " "){

                $("#claveparasbs").val(data["codigo_sbs"]);
                // $("#tienesbs").prop("checked", true);
                // $("#claveparasbs").prop('disabled', false);
            }
            }

            if(data["codigo_zuri"]){
                $("#claveparazuri").val(data["codigo_zuri"]);
                // $("#tienezuri").prop("checked", true);
                // $("#claveparazuri").prop('disabled', false);
            }

            $(".previsualizarEditar").attr("src", 'vistas/img/logosIntermediario/'+data["urlLogo"]);


            
            //Credenciales de Bolivar para enviar a la visual.
            $("#apikeyBo").val(data["cre_bol_api_key"]);
            $("#ClaveABo").val(data["cre_bol_claveAsesor"]);

            //Credenciales de allianz para enviar a la visual.
            // $("#certfileAlli").val(data["cre_alli_sslcertfile"]);
            // $("#keyfileAlli").val(data["cre_alli_sslkeyfile"]);
            $("#contraseñaAlli").val(data["cre_alli_passphrase"]);
            $("#idPartAlli").val(data["cre_alli_partnerid"]);
            $("#idagentAlli").val(data["cre_alli_agentid"]);
            $("#codigoPartAlli").val(data["cre_alli_partnercode"]);
            $("#codigoagenAlli").val(data["cre_alli_agentcode"]);

            //Credenciales de equidad para enviar a la visual.
            $("#usuEqui").val(data["cre_equ_usuario"]);
            $("#contraseñaEqui").val(data["cre_equ_contraseña"]);
            $("#codSucuEqui").val(data["cre_equ_codigo_sucursal"]);

            //Credenciales de mpafre para enviar a la visual.

            //Credenciales de previsora para enviar a la visual.

            //Credenciales de solidaria para enviar a la visual.
            $("#codSucuSoli").val(data["cre_sol_cod_sucursal"]);
            $("#codPerSoli").val(data["cre_sol_cod_per"]);
            $("#tipAgeSoli").val(data["cre_sol_cod_tipo_agente"]);
            $("#codigoAgeSoli").val(data["cre_sol_cod_agente"]);
            $("#codPunVenSoli").val(data["cre_sol_cod_pto_vta"]);
            $("#grantTypeSoli").val(data["cre_sol_grant_type"]);
            $("#cookieSoli").val(data["cre_sol_Cookie_token"]);

            //Credenciales de liberty para enviar a la visual.
            $("#cookieToLibe").val(data["cre_lib_cookieToken"]);
            $("#cookieReLibe").val(data["cre_lib_cookieRequest"]);
            $("#autoLibe").val(data["cre_lib_authorization"]);
            $("#codigoAgenLibe").val(data["cre_lib_codigoAgenteGestion"]);
            $("#ApliCliLibe").val(data["cre_lib_aplicacionCliente"]);
            $("#ipLibe").val(data["cre_lib_ip"]);
            $("#idRequeLibe").val(data["cre_lib_requestID"]);
            $("#termilibe").val(data["cre_lib_terminal"]);

            //Credenciales de estado para enviar a la visual.
            $("#usuEst").val(data["cre_est_usuario"]);
            $("#ContraLibe").val(data["cre_equ_contrasena"]);

            //Credenciales de axa para enviar a la visual.
            // $("#certFileaxa").val(data["cre_axa_sslcertfile"]);
            // $("#keyfileaxa").val(data["cre_axa_sslkeyfile"]);
            $("#contraseñaaxa").val(data["cre_axa_passphrase"]);
            $("#codigodistriaxa").val(data["cre_axa_codigoDistribuidor"]);
            $("#tipdistriaxa").val(data["cre_axa_idTipoDistribuidor"]);
            $("#codCiuaxa").val(data["cre_axa_codigoDivipola"]);
            $("#canalaxa").val(data["cre_axa_canal"]);
            $("#valEveaxa").val(data["cre_axa_validacionEventos"]);

            //Credenciales de hdi para enviar a la visual.
            $("#codSucurhdi").val(data["cre_hdi_codSucursal"]);
            $("#codigoagenhdi").val(data["cre_hdi_CodigoAgente"]);
            $("#usuhdi").val(data["cre_hdi_usuario"]);
            $("#contraseñahdi").val(data["cre_hdi_contraseña"]);

            //Credenciales de sbs para enviar a la visual.
            $("#ususbs").val(data["cre_sbs_usuario"]);
            $("#contraseñasbs").val(data["cre_sbs_contraseña"]);

            //Credenciales de zurich para enviar a la visual.
            $("#usuzur").val(data["cre_zur_nomUsu"]);
            $("#contraseñazur").val(data["cre_zur_passwd"]);
            $("#correozur").val(data["cre_zur_intermediaryEmail"]);
            $("#cookiezur").val(data["cre_zur_Cookie"]);



            
        }
    });
}

//Funcion para traer credenciales

function guardarInfoInter(){
    
    var tipodocumento = $("#tip_doc").val()
    var correo = $("#email").val()
    var identiInt = $("#numero_identificacionInter").val()
    var direccion = $("#direccion").val()
    var razonSO = $("#razon").val()
    var ciudad  = $("#ciudad").val()
    var nomRepre = $("#repre").val()
    var indentiRepre = $("#numero_identificacion_repre").val()
    var comConta = $("#contac").val()
    var cel = $("#cel").val()
    var alli = $("#claveparaIAlli").val()
    var boli = $("#claveparaBoli").val()
    var equi = $("#claveparaEqui").val()
    var mapfre = $("#claveparaMap").val()
    var previ = $("#claveparaPrevi").val()
    var soli = $("#claveparaSoli").val()
    var libe = $("#claveparaLibe").val()
    var est = $("#claveparaEst").val()
    var axa = $("#claveparaAxa").val()
    var hdi = $("#claveparahdi").val()
    var sbs = $("#claveparasbs").val()
    var zuri = $("#claveparazuri").val()
    var vig_register = $("#vig_register").val()

    var img = "";
    
    if(document.querySelector('#ImgInter').files.length <= 0){

        

        var img1 = $(".previsualizarEditar").attr("src");

        var img2 = img1.split('/')

        img = img2[3]

    }else{
        img = document.getElementById("ImgInter").files[0];
    }
    
  

    var formData = new FormData();
        formData.append("tipodocumento", tipodocumento);
        formData.append("correo", correo);
        formData.append("identiInt", identiInt);
        formData.append("direccion", direccion);
        formData.append("razonSO", razonSO);
        formData.append("ciudad", ciudad);
        formData.append("nomRepre", nomRepre);
        formData.append("indentiRepre", indentiRepre);
        formData.append("comConta", comConta);
        formData.append("cel", cel);
        formData.append("alli", alli);
        formData.append("boli", boli);
        formData.append("equi", equi);
        formData.append("mapfre", mapfre);
        formData.append("previ", previ);
        formData.append("soli", soli);
        formData.append("libe", libe);
        formData.append("est", est);
        formData.append("axa", axa);
        formData.append("hdi", hdi);
        formData.append("sbs", sbs);
        formData.append("zuri", zuri);
        formData.append("img", img);
        formData.append("vig_register", vig_register);

    $.ajax({
        url: "controladores/intermediario.controlador.php?function=actualizarInter",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {

            if(data == "exitoso"){

                // location.reload();
                Swal.fire({
                    title: '¡Intermediario guardado con Exito!',
                    confirmButtonText: 'Ok',
                  }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    } else if (result.isDenied) {
                    }
                  })
                  
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '¡No pudimos actualizar informacion!'
                  })
            }
        }
    });
    bloquearCampos();

}


