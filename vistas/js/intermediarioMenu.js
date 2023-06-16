//Al cargar la pagina
 (()=>{
    cargar_intermediarios();
    cargartipDoc()
 })()
 
 //funcion previsualizar img nueva
 
 $("#img_register").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$("#img_register").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$("#img_register").val("");

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

  			$(".previsualizar").attr("src", rutaImagen);

  		});

  	}

});
$("#img_update").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$("#img_update").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$("#img_update").val("");

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

  			$(".previsualizar_update").attr("src", rutaImagen);

  		});

  	}

});


 function cargartipDoc(){

	const $tip_doc_update = document.getElementById("tip_doc_update")
    const $tip_doc_register = document.getElementById("tip_doc_register")
    

    

    $.ajax({

        url: "ajax/tipdoc.php",
        method : "POST",
        success : function (respuesta){

            $tip_doc_update.innerHTML=respuesta;

            $tip_doc_register.innerHTML=respuesta;

        }
})

	
}

 //Funcion para traer los intermediarios Para la tabla

 function cargar_intermediarios(){

    var menu = "menu";
    var contenido = "";
    $.ajax({
        url: "controladores/intermediario.controlador.php?function=traerCrede",
        method: "POST",
        data: {menu},
        success: function (data) {

            data = JSON.parse(data);
            
            contenido +=  ` <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

            <thead>
  
              <tr>
  
                <th>#</th>
                <th>Identificación</th>
                <th>Razón social</th>
                <th>Representante legal</th>
                <th>Celular</th>
                <th>Correo Electronico</th>
                <th>Ciudad</th>
                <th>Contacto</th>
                <th>Estado</th>
                <th>Acciones</th>
  
              </tr>
  
            </thead>
  
            <tbody id="contenidoInter">`

            for (i = 0; i < data.length; i++) {

                contenido += "<tr><td>" + data[i]['id_Intermediario'] + "</td><td>" + data[i]["num_documento"]  + "</td><td>" + data[i]["nombre"] + "</td><td>" + data[i]["nombre_representante"] + "</td> <td>" + data[i]["celular"] + "</td> <td>" + data[i]["correo"] + "</td><td>" + data[i]["ciudad"] + "</td><td>" + data[i]["contacto"] + "</td>" 
                if (data[i]["intermediario_Estado"] == 0) {
                    
                    contenido += "<td><button class='btn btn-success btn-xs btnActivar' onclick='cambiarEst(" + data[i]['id_Intermediario'] + ", " + data[i]['intermediario_Estado'] + ", 1)'>Activo</button></td>";
                } else {
                    contenido += "<td><button class='btn btn-danger btn-xs btnActivar'onclick='cambiarEst(" + data[i]['id_Intermediario'] + ", " + data[i]['intermediario_Estado'] + ", 0)'>Bloqueado</button></td>";
                }

                    contenido += "<td><div><button class='btn btn-primary btnEditarUsuario' onclick='Editiinter("+data[i]['id_Intermediario']+")' idUinter='" + data[i]['id_Intermediario'] + "' data-toggle='modal' data-target='#modalEditarIntermediario'><i class='fa fa-pencil'></i></button> <button class='btn btn-danger btnEliminarUsuario' onclick='elimiNarInter("+data[i]['id_Intermediario']+")' idUsuario='" + data[i]['id_Intermediario'] + "'><i class='fa fa-times'></i></button></div></td></tr>"

               

            }
            `
            </tbody>

            </table>`

            $("#tablaIntermediario").html(contenido);

            
        }
    });
}



  //CAMBIAR EL ESTADO DEL INTERMEDIARIO

function  cambiarEst(id, estado, variable){

    Swal.fire({
      title: '¡Por favor confirma si quieres cambiar estado de este Intermediario!',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        
        $.ajax({
        url: "controladores/intermediario.controlador.php?function=CambiarEstado",
        method: "POST",
        data: {id,
        variable
        },
        success: function (data) {

            if(data == "exitoso"){
                swal.fire({
                    type: "success",
                    title: "¡Estado cambiado con Exito!"
                  });


                  setTimeout(function(){
                    location.reload();
                }, 2000);
            }else{

                swal.fire({
                    type: "error",
                    title: "¡No fue posible cambiar el estado!"
                  });


                    setTimeout(function(){
                    location.reload();
                }, 2000);

            }

        }
    });
    
      }
    })

        
    
}




// Funcion traer la info de un intermediario para editar


function Editiinter(id){
    traerCredenciales(id);

    document.getElementById("formEditarInter").reset()
}
function traerCredenciales(id){
    $.ajax({
        url: "controladores/intermediario.controlador.php?function=traerCrede",
        method: "POST",
        data: {id},
        success: function (data) {

            data = JSON.parse(data);

            //enviar datos del intermediario al formulario de arriba

            $("#tip_doc_update").val(data[0].tipo_documento);
            $("#razon_update").val(data[0].nombre);
            $("#numero_identificacionInter_update").val(data[0].num_documento);
            $("#repre_update").val(data[0].nombre_representante);
            $("#numero_identificacion_repre_update").val(data[0].Identificacion);
            $("#email_update").val(data[0].correo);
            $("#direccion_update").val(data[0].direccion);
            $("#ciudad_update").val(data[0].ciudad);
            $("#contac_update").val(data[0].contacto);
            $("#cel_update").val(data[0].celular);
            if(data[0].codigo_alli){
                $("#tieneAlli_update").prop("checked", true);
                $("#claveparaIAlli_update").prop('disabled', false);
                $("#claveparaIAlli_update").val(data[0].codigo_alli);
            }else{
                $("#claveparaIAlli_update").prop('disabled', true);
            }
            if(data[0].codigo_boli){
                $("#claveparaBoli_update").prop('disabled', false);
                $("#tieneBoli_update").prop("checked", true);
                $("#claveparaBoli_update").val(data[0].codigo_boli);
            }else{
                $("#claveparaBoli_update").prop('disabled', true);
            }
            if(data[0].codigo_equi){
                $("#tieneEqui_update").prop("checked", true);
                $("#claveparaEqui_update").prop('disabled', false);
                $("#claveparaEqui_update").val(data[0].codigo_equi);
            }else{
                $("#claveparaEqui_update").prop('disabled', true);
            }
            if(data[0].codigo_map){
                $("#tieneMap_update").prop("checked", true);
                $("#claveparaMap_update").prop('disabled', false);
                $("#claveparaMap_update").val(data[0].codigo_map);
            }else{
                $("#claveparaMap_update").prop('disabled', true);
            }
            if(data[0].codigo_previ){
                $("#claveparaPrevi_update").val(data[0].codigo_previ);
                $("#tienePrevi_update").prop("checked", true);
                $("#claveparaPrevi_update").prop('disabled', false);
            }else{
                $("#claveparaPrevi_update").prop('disabled', true);
            }
            if(data[0].codigo_soli){
                $("#claveparaSoli_update").val(data[0].codigo_soli);
                $("#tieneSoli_update").prop("checked", true);
                $("#claveparaSoli_update").prop('disabled', false);
            }else{
                $("#claveparaSoli_update").prop('disabled', true);
            }
            if(data[0].codigo_libe){
                $("#claveparaLibe_update").val(data[0].codigo_libe);
                $("#tieneLibe_update").prop("checked", true);
                $("#claveparaLibe_update").prop('disabled', false);
            }else{
                $("#claveparaLibe_update").prop('disabled', true);
            }
            if(data[0].codigo_est){
                $("#claveparaEst_update").val(data[0].codigo_est);
                $("#tieneEst_update").prop("checked", true);
                $("#claveparaEst_update").prop('disabled', false);
            }else{
                $("#claveparaEst_update").prop('disabled', true);
            }
            if(data[0].codigo_axa){
                $("#claveparaAxa_update").val(data[0].codigo_axa);
                $("#tieneAxa_update").prop("checked", true);
                $("#claveparaAxa_update").prop('disabled', false);
            }else{
                $("#claveparaAxa_update").prop('disabled', true);
            }
            if(data[0].codigo_hdi){
                $("#claveparahdi_update").val(data[0].codigo_hdi);
                $("#tienehdi_update").prop("checked", true);
                $("#claveparahdi_update").prop('disabled', false);
            }else{
                $("#claveparahdi_update").prop('disabled', true);
            }
            if(data[0].codigo_sbs){
                if (data[0].codigo_sbs != " "){

                $("#claveparasbs_update").val(data[0].codigo_sbs);
                $("#tienesbs_update").prop("checked", true);
                $("#claveparasbs_update").prop('disabled', false);
                }else{
                    $("#claveparasbs_update").prop('disabled', true);
                }
            }else{
                $("#claveparasbs_update").prop('disabled', true);
            }

            if(data[0].codigo_zuri){
                $("#claveparazuri_update").val(data[0].codigo_zuri);
                $("#tienezuri_update").prop("checked", true);
                $("#claveparazuri_update").prop('disabled', false);
            }else{
                $("#claveparazuri_update").prop('disabled', true);
            }
            
            if(data[0].codigo_Mundial){
                $("#claveparaMund_update").val(data[0].codigo_Mundial);
                $("#tieneMund_update").prop("checked", true);
                $("#claveparaMund_update").prop('disabled', false);
            }else{
                $("#claveparaMund_update").prop('disabled', true);
            }
            
            if(data[0].codigo_Sura){
                $("#claveparaSura_update").val(data[0].codigo_Sura);
                $("#tieneSura_update").prop("checked", true);
                $("#claveparaSura_update").prop('disabled', false);
            }else{
                $("#claveparaSura_update").prop('disabled', true);
            }

            


            $(".previsualizar_update").attr("src", 'vistas/img/logosIntermediario/'+data[0].urlLogo);


            //DIAS DE VIGENCIA FALTA POR AGREGAR
            $("#cars_update").val(data[0].intermediario_Fech_Vigen)


            
            //Credenciales de Bolivar para enviar a la visual.
            $("#apikeyBo_update").val(data[0].cre_bol_api_key);
            $("#ClaveABo_update").val(data[0].cre_bol_claveAsesor);

            //Credenciales de allianz para enviar a la visual.
            // $("#certfileAlli").val(data["cre_alli_sslcertfile"]);
            // $("#keyfileAlli").val(data["cre_alli_sslkeyfile"]);
            $("#contraseñaAlli_update").val(data[0].cre_alli_passphrase);
            $("#idPartAlli_update").val(data[0].cre_alli_partnerid);
            $("#idagentAlli_update").val(data[0].cre_alli_agentid);
            $("#codigoPartAlli_update").val(data[0].cre_alli_partnercode);
            $("#codigoagenAlli_update").val(data[0].cre_alli_agentcode);

            //Credenciales de equidad para enviar a la visual.
            $("#usuEqui_update").val(data[0].cre_equ_usuario);
            $("#contraseñaEqui_update").val(data[0].cre_equ_contraseña);
            $("#codSucuEqui_update").val(data[0].cre_equ_codigo_sucursal);

            //Credenciales de mpafre para enviar a la visual.

            //Credenciales de previsora para enviar a la visual.

            //Credenciales de solidaria para enviar a la visual.
            $("#codSucuSoli_update").val(data[0].cre_sol_cod_sucursal);
            $("#codPerSoli_update").val(data[0].cre_sol_cod_per);
            $("#tipAgeSoli_update").val(data[0].cre_sol_cod_tipo_agente);
            $("#codigoAgeSoli_update").val(data[0].cre_sol_cod_agente);
            $("#codPunVenSoli_update").val(data[0].cre_sol_cod_pto_vta);
            $("#grantTypeSoli_update").val(data[0].cre_sol_grant_type);
            $("#cookieSoli_update").val(data[0].cre_sol_Cookie_token);

            //Credenciales de liberty para enviar a la visual.
            $("#cookieToLibe_update").val(data[0].cre_lib_cookieToken);
            $("#cookieReLibe_update").val(data[0].cre_lib_cookieRequest);
            $("#autoLibe_update").val(data[0].cre_lib_authorization);
            $("#codigoAgenLibe_update").val(data[0].cre_lib_codigoAgenteGestion);
            $("#ApliCliLibe_update").val(data[0].cre_lib_aplicacionCliente);
            $("#ipLibe_update").val(data[0].cre_lib_ip);
            $("#idRequeLibe_update").val(data[0].cre_lib_requestID);
            $("#termilibe_update").val(data[0].cre_lib_terminal);

            //Credenciales de estado para enviar a la visual.
            $("#usuEst_update").val(data[0].cre_est_usuario);
            $("#ContraLibe_update").val(data[0].cre_equ_contrasena);

            //Credenciales de axa para enviar a la visual.
            // $("#certFileaxa").val(data["cre_axa_sslcertfile"]);
            // $("#keyfileaxa").val(data["cre_axa_sslkeyfile"]);
            $("#contraseñaaxa_update").val(data[0].cre_axa_passphrase);
            $("#codigodistriaxa_update").val(data[0].cre_axa_codigoDistribuidor);
            $("#tipdistriaxa_update").val(data[0].cre_axa_idTipoDistribuidor);
            $("#codCiuaxa_update").val(data[0].cre_axa_codigoDivipola);
            $("#canalaxa_update").val(data[0].cre_axa_canal);
            $("#valEveaxa_update").val(data[0].cre_axa_validacionEventos);

            //Credenciales de hdi para enviar a la visual.
            $("#codSucurhdi_update").val(data[0].cre_hdi_codSucursal);
            $("#codigoagenhdi_update").val(data[0].cre_hdi_CodigoAgente);
            $("#usuhdi_update").val(data[0].cre_hdi_usuario);
            $("#contraseñahdi_update").val(data[0].cre_hdi_contraseña);

            //Credenciales de sbs para enviar a la visual.
            $("#ususbs_update").val(data[0].cre_sbs_usuario);
            $("#contraseñasbs_update").val(data[0].cre_sbs_contraseña);

            //Credenciales de zurich para enviar a la visual.
            $("#usuzur_update").val(data[0].cre_zur_nomUsu);
            $("#contraseñazur_update").val(data[0].cre_zur_passwd);
            $("#correozur_update").val(data[0].cre_zur_intermediaryEmail);
            $("#cookiezur_update").val(data[0].cre_zur_Cookie);




            $('#id_inter').val(data[0].id_Intermediario)



            
        }
    });
}

//FUNCION PARA ACTUALIZAR LA INFO DE UN INTERMEDIARIO DESDE EL MODAL

function actualizarInter(){


    

    let id = $('#id_inter').val()

    actualizarInfoInter(id)
}


function actualizarInfoInter(id){

    let tip_doc_update = $("#tip_doc_update").val();
    let email_update = $("#email_update").val();
    let numero_identificacionInter_update = $("#numero_identificacionInter_update").val();
    let direccion_update = $("#direccion_update").val()
    let razon_update = $("#razon_update").val()
    let ciudad_update = $("#ciudad_update").val()
    let repre_update = $("#repre_update").val()
    let contac_update = $("#contac_update").val()
    let numero_identificacion_repre_update =  $("#numero_identificacion_repre_update").val()
    let cel_update=  $("#cel_update").val()

    if(tip_doc_update != "" && email_update != "" &&  numero_identificacionInter_update != "" &&  direccion_update != "" &&  razon_update != "" &&  ciudad_update != "" &&  repre_update != "" &&  contac_update != "" && numero_identificacion_repre_update != "" && cel_update != ""){

    
        
        if(document.querySelector('#img_update').files.length <= 0){

            var img1 = $(".previsualizar_update").attr("src");

            var img2 = img1.split('/')

            var img = img2[3]

        }else{
            var img = document.getElementById("img_update").files[0];
        }
        
        var formData = new FormData();
        formData.append("id", id);
        formData.append("img", img);
        formData.append("tip_doc_update", $("#tip_doc_update").val());
        formData.append("email_update", $("#email_update").val());
        formData.append("numero_identificacionInter_update", $("#numero_identificacionInter_update").val());
        formData.append("direccion_update", $("#direccion_update").val());
        formData.append("razon_update", $("#razon_update").val());
        formData.append("ciudad_update", $("#ciudad_update").val());
        formData.append("repre_update", $("#repre_update").val());
        formData.append("contac_update", $("#contac_update").val());
        formData.append("numero_identificacion_repre_update", $("#numero_identificacion_repre_update").val());
        formData.append("cel_update", $("#cel_update").val());
        formData.append("alli", $("#claveparaIAlli_update").val());
        formData.append("boli", $("#claveparaBoli_update").val());
        formData.append("equi", $("#claveparaEqui_update").val());
        formData.append("mapfre", $("#claveparaMap_update").val());
        formData.append("previ", $("#claveparaPrevi_update").val());
        formData.append("soli", $("#claveparaSoli_update").val());
        formData.append("claveparaMund_update", $("#claveparaMund_update").val());
        formData.append("libe", $("#claveparaLibe_update").val());
        formData.append("est", $("#claveparaEst_update").val());
        formData.append("axa", $("#claveparaAxa_update").val());
        formData.append("hdi", $("#claveparahdi_update").val());
        formData.append("sbs", $("#claveparasbs_update").val());
        formData.append("zuri", $("#claveparazuri_update").val());
        formData.append("sura", $("#claveparaSura_update").val());
        formData.append("mundial", $("#claveparaMund_update").val());
        formData.append("claveparaSura_update", $("#claveparaSura_update").val());
        formData.append("contraseñaAlli_update", $("#contraseñaAlli_update").val());
        formData.append("idPartAlli_update", $("#idPartAlli_update").val());
        formData.append("idagentAlli_update", $("#idagentAlli_update").val());
        formData.append("codigoPartAlli_update", $("#codigoPartAlli_update").val());
        formData.append("codigoagenAlli_update", $("#codigoagenAlli_update").val());
        formData.append("apikeyBo_update", $("#apikeyBo_update").val());
        formData.append("ClaveABo_update", $("#ClaveABo_update").val());
        formData.append("usuEqui_update", $("#usuEqui_update").val());
        formData.append("contraseñaEqui_update", $("#contraseñaEqui_update").val());
        formData.append("codSucuEqui_update", $("#codSucuEqui_update").val());
        formData.append("codSucuSoli_update", $("#codSucuSoli_update").val());
        formData.append("codPerSoli_update", $("#codPerSoli_update").val());
        formData.append("tipAgeSoli_update", $("#tipAgeSoli_update").val());
        formData.append("codigoAgeSoli_update", $("#codigoAgeSoli_update").val());
        formData.append("codPunVenSoli_update", $("#codPunVenSoli_update").val());
        formData.append("grantTypeSoli_update", $("#grantTypeSoli_update").val());
        formData.append("cookieSoli_update", $("#cookieSoli_update").val());
        formData.append("cookieToLibe_update", $("#cookieToLibe_update").val());
        formData.append("cookieReLibe_update", $("#cookieReLibe_update").val());
        formData.append("autoLibe_update", $("#autoLibe_update").val());
        formData.append("codigoAgenLibe_update", $("#codigoAgenLibe_update").val());
        formData.append("ApliCliLibe_update", $("#ApliCliLibe_update").val());
        formData.append("ipLibe_update", $("#ipLibe_update").val());
        formData.append("idRequeLibe_update", $("#idRequeLibe_update").val());
        formData.append("termilibe_update", $("#termilibe_update").val());
        formData.append("usuEst_update", $("#usuEst_update").val());
        formData.append("ContraLibe_update", $("#ContraLibe_update").val());
        formData.append("contraseñaaxa_update", $("#contraseñaaxa_update").val());
        formData.append("codigodistriaxa_update", $("#codigodistriaxa_update").val());
        formData.append("tipdistriaxa_update", $("#tipdistriaxa_update").val());
        formData.append("codCiuaxa_update", $("#codCiuaxa_update").val());
        formData.append("canalaxa_update", $("#canalaxa_update").val());
        formData.append("valEveaxa_update", $("#valEveaxa_update").val());
        formData.append("codSucurhdi_update", $("#codSucurhdi_update").val());
        formData.append("codigoagenhdi_update", $("#codigoagenhdi_update").val());
        formData.append("usuhdi_update", $("#usuhdi_update").val());
        formData.append("contraseñahdi_update", $("#contraseñahdi_update").val());
        formData.append("ususbs_update", $("#ususbs_update").val());
        formData.append("contraseñasbs_update", $("#contraseñasbs_update").val());
        formData.append("usuzur_update", $("#usuzur_update").val());
        formData.append("contraseñazur_update", $("#contraseñazur_update").val());
        formData.append("correozur_update", $("#correozur_update").val());
        formData.append("cookiezur_update", $("#cookiezur_update").val());
        formData.append("cars_update", $("#cars_update").val());

        $.ajax({
            url: "controladores/intermediario.controlador.php?function=guardarInter",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

            if(data == "exitoso"){
                swal.fire({
                    type: "success",
                    title: "¡Intermediario Actualizado con exito!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                  });


                  setTimeout(function(){
                    location.reload();
                }, 3000);
            }else{

                swal.fire({
                    type: "error",
                    title: "¡No se pudo actualizar el intermediario!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                  });


                    setTimeout(function(){
                    location.reload();
                }, 3000);

            }

            }
        });
    }else{
        alert("Complete los campos principales")
    }

}


function abrirmodalRegister(){

document.getElementById("formGuardarInter").reset()

}


//FUNCION PARA RESGISTRAR UN INTERMEDIARIO

function guardarinter(){
    
    let tip_doc_register = $("#tip_doc_register").val();
    let email_register = $("#email_register").val();
    let numero_identificacionInter_register = $("#numero_identificacionInter_register").val();
    let direccion_register = $("#direccion_register").val()
    let razon_register = $("#razon_register").val()
    let ciudad_register = $("#ciudad_register").val()
    let repre_register = $("#repre_register").val()
    let contac_register = $("#contac_register").val()
    let numero_identificacion_repre_register =  $("#numero_identificacion_repre_register").val()
    let cel_register=  $("#cel_register").val()

    if(tip_doc_register == 2 && numero_identificacionInter_register.length != 9){
        swal.fire({
            type: "info",
            title: "¡El nit debe contener nueve caracteres en total!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
        });
    }else{

        if(tip_doc_register != "" && email_register != "" &&  numero_identificacionInter_register != "" &&  direccion_register != "" &&  razon_register != "" &&  ciudad_register != "" &&  repre_register != "" &&  contac_register != "" && numero_identificacion_repre_register != "" && cel_register != ""){

            //Accedemos al formulario

            let img = document.getElementById("img_register").files[0];

            var formData = new FormData();
            formData.append("img", img);
            formData.append("tip_doc_register", tip_doc_register);
            formData.append("email_register", email_register);
            formData.append("numero_identificacionInter_register", numero_identificacionInter_register);
            formData.append("direccion_register", $("#direccion_register").val());
            formData.append("razon_register", $("#razon_register").val());
            formData.append("ciudad_register", $("#ciudad_register").val());
            formData.append("repre_register", $("#repre_register").val());
            formData.append("contac_register", $("#contac_register").val());
            formData.append("numero_identificacion_repre_register", $("#numero_identificacion_repre_register").val());
            formData.append("cel_register", $("#cel_register").val());
            formData.append("alli", $("#claveparaIAlli_register").val());
            formData.append("boli", $("#claveparaBoli_register").val());
            formData.append("equi", $("#claveparaEqui_register").val());
            formData.append("mapfre", $("#claveparaMap_register").val());
            formData.append("previ", $("#claveparaPrevi_register").val());
            formData.append("soli", $("#claveparaSoli_register").val());
            formData.append("claveparaMund_register", $("#claveparaMund_register").val());
            formData.append("libe", $("#claveparaLibe_register").val());
            formData.append("est", $("#claveparaEst_register").val());
            formData.append("axa", $("#claveparaAxa_register").val());
            formData.append("hdi", $("#claveparahdi_register").val());
            formData.append("sbs", $("#claveparasbs_register").val());
            formData.append("zuri", $("#claveparazuri_register").val());
            formData.append("sura", $("#claveparaSura_register").val());
            formData.append("mundial", $("#claveparaMund_register").val());
            formData.append("claveparaSura_register", $("#claveparaSura_register").val());
            formData.append("contraseñaAlli_register", $("#contraseñaAlli_register").val());
            formData.append("idPartAlli_register", $("#idPartAlli_register").val());
            formData.append("idagentAlli_register", $("#idagentAlli_register").val());
            formData.append("codigoPartAlli_register", $("#codigoPartAlli_register").val());
            formData.append("codigoagenAlli_register", $("#codigoagenAlli_register").val());
            formData.append("apikeyBo_register", $("#apikeyBo_register").val());
            formData.append("ClaveABo_register", $("#ClaveABo_register").val());
            formData.append("usuEqui_register", $("#usuEqui_register").val());
            formData.append("contraseñaEqui_register", $("#contraseñaEqui_register").val());
            formData.append("codSucuEqui_register", $("#codSucuEqui_register").val());
            formData.append("codSucuSoli_register", $("#codSucuSoli_register").val());
            formData.append("codPerSoli_register", $("#codPerSoli_register").val());
            formData.append("tipAgeSoli_register", $("#tipAgeSoli_register").val());
            formData.append("codigoAgeSoli_register", $("#codigoAgeSoli_register").val());
            formData.append("codPunVenSoli_register", $("#codPunVenSoli_register").val());
            formData.append("grantTypeSoli_register", $("#grantTypeSoli_register").val());
            formData.append("cookieSoli_register", $("#cookieSoli_register").val());
            formData.append("cookieToLibe_register", $("#cookieToLibe_register").val());
            formData.append("cookieReLibe_register", $("#cookieReLibe_register").val());
            formData.append("autoLibe_register", $("#autoLibe_register").val());
            formData.append("codigoAgenLibe_register", $("#codigoAgenLibe_register").val());
            formData.append("ApliCliLibe_register", $("#ApliCliLibe_register").val());
            formData.append("ipLibe_register", $("#ipLibe_register").val());
            formData.append("idRequeLibe_register", $("#idRequeLibe_register").val());
            formData.append("termilibe_register", $("#termilibe_register").val());
            formData.append("usuEst_register", $("#usuEst_register").val());
            formData.append("ContraLibe_register", $("#ContraLibe_register").val());
            formData.append("contraseñaaxa_register", $("#contraseñaaxa_register").val());
            formData.append("codigodistriaxa_register", $("#codigodistriaxa_register").val());
            formData.append("tipdistriaxa_register", $("#tipdistriaxa_register").val());
            formData.append("codCiuaxa_register", $("#codCiuaxa_register").val());
            formData.append("canalaxa_register", $("#canalaxa_register").val());
            formData.append("valEveaxa_register", $("#valEveaxa_register").val());
            formData.append("codSucurhdi_register", $("#codSucurhdi_register").val());
            formData.append("codigoagenhdi_register", $("#codigoagenhdi_register").val());
            formData.append("usuhdi_register", $("#usuhdi_register").val());
            formData.append("contraseñahdi_register", $("#contraseñahdi_register").val());
            formData.append("ususbs_register", $("#ususbs_register").val());
            formData.append("contraseñasbs_register", $("#contraseñasbs_register").val());
            formData.append("usuzur_register", $("#usuzur_register").val());
            formData.append("contraseñazur_register", $("#contraseñazur_register").val());
            formData.append("correozur_register", $("#correozur_register").val());
            formData.append("cookiezur_register", $("#cookiezur_register").val());
            formData.append("vig_register", $("#vig_register").val());

            $.ajax({
                url: "controladores/intermediario.controlador.php?function=guardarInter",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    if(data == "exitoso"){

                        swal.fire({
                            type: "success",
                            title: "¡Intermediario creado con exito!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                        });


                            setTimeout(function(){
                                location.reload();
                            }, 4000);
                    }
                }
            });

        }else{
            swal.fire({
                type: "info",
                title: "!Debes completar la información principal¡",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
            });
        }
    }
}



//funciones para cuando marquen aseguradora se habilite el campo del codigo

$("#tieneAlli_register").click(function () {
    if( $('#tieneAlli_register').is(':checked') ) {
        $("#claveparaIAlli_register").prop('disabled', false);
    }else{   
        $("#claveparaIAlli_register").prop('disabled', true);
        $("#claveparaIAlli_register").val("");
    }
})

$("#tieneBoli_register").click(function () {
    if( $('#tieneBoli_register').is(':checked') ) {
        $("#claveparaBoli_register").prop('disabled', false);
    }else{   
        $("#claveparaBoli_register").prop('disabled', true);
        $("#claveparaBoli_register").val("");
    }
})

$("#tieneEqui_register").click(function () {
    if( $('#tieneEqui_register').is(':checked') ) {
        $("#claveparaEqui_register").prop('disabled', false);
    }else{   
        $("#claveparaEqui_register").prop('disabled', true);
        $("#claveparaEqui_register").val("");
    }
})

$("#tieneMap_register").click(function () {
    if( $('#tieneMap_register').is(':checked') ) {
        $("#claveparaMap_register").prop('disabled', false);
    }else{   
        $("#claveparaMap_register").prop('disabled', true);
        $("#claveparaMap_register").val("");
    }
})

$("#tienePrevi_register").click(function () {
    if( $('#tienePrevi_register').is(':checked') ) {
        $("#claveparaPrevi_register").prop('disabled', false);
    }else{   
        $("#claveparaPrevi_register").prop('disabled', true);
        $("#claveparaPrevi_register").val("");
    }
})

$("#tieneSoli_register").click(function () {
    if( $('#tieneSoli_register').is(':checked') ) {
        $("#claveparaSoli_register").prop('disabled', false);
    }else{   
        $("#claveparaSoli_register").prop('disabled', true);
        $("#claveparaSoli_register").val("");
    }
})

$("#tieneLibe_register").click(function () {
    if( $('#tieneLibe_register').is(':checked') ) {
        $("#claveparaLibe_register").prop('disabled', false);
    }else{   
        $("#claveparaLibe_register").prop('disabled', true);
        $("#claveparaLibe_register").val("");
    }
})

$("#tieneEst_register").click(function () {
    if( $('#tieneEst_register').is(':checked') ) {
        $("#claveparaEst_register").prop('disabled', false);
    }else{   
        $("#claveparaEst_register").prop('disabled', true);
        $("#claveparaEst_register").val("");
    }
})

$("#tieneAxa_register").click(function () {
    if( $('#tieneAxa_register').is(':checked') ) {
        $("#claveparaAxa_register").prop('disabled', false);
    }else{   
        $("#claveparaAxa_register").prop('disabled', true);
        $("#claveparaAxa_register").val("");
    }
})

$("#tienehdi_register").click(function () {
    if( $('#tienehdi_register').is(':checked') ) {
        $("#claveparahdi_register").prop('disabled', false);
    }else{   
        $("#claveparahdi_register").prop('disabled', true);
        $("#claveparahdi_register").val("");
    }
})

$("#tienesbs_register").click(function () {
    if( $('#tienesbs_register').is(':checked') ) {
        $("#claveparasbs_register").prop('disabled', false);
    }else{   
        $("#claveparasbs_register").prop('disabled', true);
        $("#claveparasbs_register").val("");
    }
})

$("#tienezuri_register").click(function () {
    if( $('#tienezuri_register').is(':checked') ) {
        $("#claveparazuri_register").prop('disabled', false);
    }else{   
        $("#claveparazuri_register").prop('disabled', true);
        $("#claveparazuri_register").val("");
    }
})

$("#tieneSura_register").click(function () {
    if( $('#tieneSura_register').is(':checked') ) {
        $("#claveparaSura_register").prop('disabled', false);
    }else{   
        $("#claveparaSura_register").prop('disabled', true);
        $("#claveparaSura_register").val("");
    }
})

$("#tieneMund_register").click(function () {
    if( $('#tieneMund_register').is(':checked') ) {
        $("#claveparaMund_register").prop('disabled', false);
    }else{   
        $("#claveparaMund_register").prop('disabled', true);
        $("#claveparaMund_register").val("");
    }
})


$("#balli_register").click(function(){
    $("#ballili_register").addClass("active");
    $("#allianzdiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#bboli_register").click(function(){
    $("#bbolili_register").addClass("active");
    $("#bolivardiv_register").show();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();

})
$("#bequi_register").click(function(){
    $("#bequili_register").addClass("active");
    $("#equidaddiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#bmap_register").click(function(){
    $("#bmapli_register").addClass("active");
    $("#mapfrediv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#bprevi_register").click(function(){
    $("#bprevili_register").addClass("active");
    $("#previsoradiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#bsoli_register").click(function(){
    $("#bsolili_register").addClass("active");
    $("#solidariadiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#blibe_register").click(function(){
    $("#blibeli_register").addClass("active");
    $("#libertydiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#besta_register").click(function(){
    $("#bestali_register").addClass("active");
    $("#estadodiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#baxa_register").click(function(){
    $("#baxali_register").addClass("active");
    $("#axadiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#bhdili_register_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#bhdi_register").click(function(){
    $("#bhdili_register").addClass("active");
    $("#hdidiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#bsbs_register").click(function(){
    $("#bsbsli_register").addClass("active");
    $("#sbsdiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
    $("#bzurili_register").removeClass("active");
    $("#zuridiv_register").hide();
})
$("#bzuri_register").click(function(){
    $("#bzurili_register").addClass("active");
    $("#zuridiv_register").show();
    $("#bbolili_register").removeClass("active");
    $("#bolivardiv_register").hide();
    $("#bequili_register").removeClass("active");
    $("#equidaddiv_register").hide();
    $("#bmapli_register").removeClass("active");
    $("#mapfrediv_register").hide();
    $("#bprevili_register").removeClass("active");
    $("#previsoradiv_register").hide();
    $("#bsolili_register").removeClass("active");
    $("#solidariadiv_register").hide();
    $("#blibeli_register").removeClass("active");
    $("#libertydiv_register").hide();
    $("#bestali_register").removeClass("active");
    $("#estadodiv_register").hide();
    $("#baxali_register").removeClass("active");
    $("#axadiv_register").hide();
    $("#bhdili_register").removeClass("active");
    $("#hdidiv_register").hide();
    $("#bsbsli_register").removeClass("active");
    $("#sbsdiv_register").hide();
    $("#ballili_register").removeClass("active");
    $("#allianzdiv_register").hide();
})




//Para editar


//funciones para cuando marquen aseguradora se habilite el campo del codigo

$("#tieneAlli_update").click(function () {
    if( $('#tieneAlli_update').is(':checked') ) {
        $("#claveparaIAlli_update").prop('disabled', false);
    }else{   
        $("#claveparaIAlli_update").prop('disabled', true);
        $("#claveparaIAlli_update").val("");
    }
})

$("#tieneBoli_update").click(function () {
    if( $('#tieneBoli_update').is(':checked') ) {
        $("#claveparaBoli_update").prop('disabled', false);
    }else{   
        $("#claveparaBoli_update").prop('disabled', true);
        $("#claveparaBoli_update").val("");
    }
})

$("#tieneEqui_update").click(function () {
    if( $('#tieneEqui_update').is(':checked') ) {
        $("#claveparaEqui_update").prop('disabled', false);
    }else{   
        $("#claveparaEqui_update").prop('disabled', true);
        $("#claveparaEqui_update").val("");
    }
})

$("#tieneMap_update").click(function () {
    if( $('#tieneMap_update').is(':checked') ) {
        $("#claveparaMap_update").prop('disabled', false);
    }else{   
        $("#claveparaMap_update").prop('disabled', true);
        $("#claveparaMap_update").val("");
    }
})

$("#tienePrevi_update").click(function () {
    if( $('#tienePrevi_update').is(':checked') ) {
        $("#claveparaPrevi_update").prop('disabled', false);
    }else{   
        $("#claveparaPrevi_update").prop('disabled', true);
        $("#claveparaPrevi_update").val("");
    }
})

$("#tieneSoli_update").click(function () {
    if( $('#tieneSoli_update').is(':checked') ) {
        $("#claveparaSoli_update").prop('disabled', false);
    }else{   
        $("#claveparaSoli_update").prop('disabled', true);
        $("#claveparaSoli_update").val("");
    }
})

$("#tieneLibe_update").click(function () {
    if( $('#tieneLibe_update').is(':checked') ) {
        $("#claveparaLibe_update").prop('disabled', false);
    }else{   
        $("#claveparaLibe_update").prop('disabled', true);
        $("#claveparaLibe_update").val("");
    }
})

$("#tieneEst_update").click(function () {
    if( $('#tieneEst_update').is(':checked') ) {
        $("#claveparaEst_update").prop('disabled', false);
    }else{   
        $("#claveparaEst_update").prop('disabled', true);
        $("#claveparaEst_update").val("");
    }
})

$("#tieneAxa_update").click(function () {
    if( $('#tieneAxa_update').is(':checked') ) {
        $("#claveparaAxa_update").prop('disabled', false);
    }else{   
        $("#claveparaAxa_update").prop('disabled', true);
        $("#claveparaAxa_update").val("");
    }
})

$("#tienehdi_update").click(function () {
    if( $('#tienehdi_update').is(':checked') ) {
        $("#claveparahdi_update").prop('disabled', false);
    }else{   
        $("#claveparahdi_update").prop('disabled', true);
        $("#claveparahdi_update").val("");
    }
})

$("#tienesbs_update").click(function () {
    if( $('#tienesbs_update').is(':checked') ) {
        $("#claveparasbs_update").prop('disabled', false);
    }else{   
        $("#claveparasbs_update").prop('disabled', true);
        $("#claveparasbs_update").val("");
    }
})

$("#tienezuri_update").click(function () {
    if( $('#tienezuri_update').is(':checked') ) {
        $("#claveparazuri_update").prop('disabled', false);
    }else{   
        $("#claveparazuri_update").prop('disabled', true);
        $("#claveparazuri_update").val("");
    }
})

$("#tieneSura_update").click(function () {
    if( $('#tieneSura_update').is(':checked') ) {
        $("#claveparaSura_update").prop('disabled', false);
    }else{   
        $("#claveparaSura_update").prop('disabled', true);
        $("#claveparaSura_update").val("");
    }
})

$("#tieneMund_update").click(function () {
    if( $('#tieneMund_update').is(':checked') ) {
        $("#claveparaMund_update").prop('disabled', false);
    }else{   
        $("#claveparaMund_update").prop('disabled', true);
        $("#claveparaMund_update").val("");
    }
})


$("#balli_update").click(function(){
    $("#ballili_update").addClass("active");
    $("#allianzdiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#bboli_update").click(function(){
    $("#bbolili_update").addClass("active");
    $("#bolivardiv_update").show();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();

})
$("#bequi_update").click(function(){
    $("#bequili_update").addClass("active");
    $("#equidaddiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#bmap_update").click(function(){
    $("#bmapli_update").addClass("active");
    $("#mapfrediv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#bprevi_update").click(function(){
    $("#bprevili_update").addClass("active");
    $("#previsoradiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#bsoli_update").click(function(){
    $("#bsolili_update").addClass("active");
    $("#solidariadiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#blibe_update").click(function(){
    $("#blibeli_update").addClass("active");
    $("#libertydiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#besta_update").click(function(){
    $("#bestali_update").addClass("active");
    $("#estadodiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#baxa_update").click(function(){
    $("#baxali_update").addClass("active");
    $("#axadiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#bhdili_update_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#bhdi_update").click(function(){
    $("#bhdili_update").addClass("active");
    $("#hdidiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#bsbs_update").click(function(){
    $("#bsbsli_update").addClass("active");
    $("#sbsdiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
    $("#bzurili_update").removeClass("active");
    $("#zuridiv_update").hide();
})
$("#bzuri_update").click(function(){
    $("#bzurili_update").addClass("active");
    $("#zuridiv_update").show();
    $("#bbolili_update").removeClass("active");
    $("#bolivardiv_update").hide();
    $("#bequili_update").removeClass("active");
    $("#equidaddiv_update").hide();
    $("#bmapli_update").removeClass("active");
    $("#mapfrediv_update").hide();
    $("#bprevili_update").removeClass("active");
    $("#previsoradiv_update").hide();
    $("#bsolili_update").removeClass("active");
    $("#solidariadiv_update").hide();
    $("#blibeli_update").removeClass("active");
    $("#libertydiv_update").hide();
    $("#bestali_update").removeClass("active");
    $("#estadodiv_update").hide();
    $("#baxali_update").removeClass("active");
    $("#axadiv_update").hide();
    $("#bhdili_update").removeClass("active");
    $("#hdidiv_update").hide();
    $("#bsbsli_update").removeClass("active");
    $("#sbsdiv_update").hide();
    $("#ballili_update").removeClass("active");
    $("#allianzdiv_update").hide();
})
