/*=============================================
CARGANDO DATOS DE INICIO
=============================================*/
(()=>{
    cargarPolitica();
    cargarRoll();
    })();
    
    
    
    /*=============================================
    CARGAR INTERMEDIARIO
    =============================================*/
    
    function cargarIntermediario (){
    
        const $idInter = document.getElementById("idIntermediario")
        const $idInter2 = document.getElementById("idIntermediario2")
    
    $.ajax({
    
        url: "ajax/cargarIntermediario.php",
        method : "POST",
        success : function (respuesta){
    
        
           $idInter.innerHTML=respuesta;
           $idInter2.innerHTML=respuesta;
    
        }
    
    })
    
    }
    
    
    
    /*=============================================
    CARGAR ROLL
    =============================================*/
    function cargarRoll (){
    
        const $idRoll = document.getElementById("idRoll")
        const $idRoll1 = document.getElementById("editarRol")
    
    $.ajax({
    
        url: "ajax/cargarRoll.php",
        method : "POST",
        success : function (respuesta){
    
           $idRoll.innerHTML=respuesta;
           $idRoll1.innerHTML=respuesta;
    
        }
    
    })
    
        
    }
    
    /*=============================================
    CARGAR Foto
    =============================================*/
    $(".nuevaFoto").change(function(){
    
        var imagen = this.files[0];
        
        /*=============================================
          VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
          =============================================*/
    
          if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
    
              $(".nuevaFoto").val("");
    
               swal({
                  title: "Error al subir la imagen",
                  text: "¡La imagen debe estar en formato JPG o PNG!",
                  type: "error",
                  confirmButtonText: "¡Cerrar!"
                });
    
          }else if(imagen["size"] > 2000000){
    
              $(".nuevaFoto").val("");
    
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
    
    
    /*=============================================
    EDITAR USUARIO
    =============================================*/
    $(".tablas").on("click", ".btnEditarUsuario", function(){
    
        var idUsuario = $(this).attr("idUsuario");
        
        var datos = new FormData();
        datos.append("idUsuario", idUsuario);
    
        $.ajax({
    
            url:"ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                
                
                $("#editarNombre").val(respuesta["usu_nombre"]);
                $("#editarApellido").val(respuesta["usu_apellido"]);
                $("#editarDocIdUser").val(respuesta["usu_documento"]);
                $("#editarUsuario").val(respuesta["usu_usuario"]);
                $("#passwordActual").val(respuesta["usu_password"]);
                $("#editarGenero").val(respuesta["usu_genero"]);
                $("#editarTelefono").val(respuesta["usu_telefono"]);
                $("#editarEmail").val(respuesta["usu_email"]);
                $("#editarCargo").val(respuesta["usu_cargo"]);
                $("#fotoActual").val(respuesta["usu_foto"]);
                $("#editarRol").val(respuesta["id_rol"]);
                $("#idIntermediario2").val(respuesta["id_Intermediario"]);
                $("#maxCotEdi").val(respuesta["numCotizaciones"]);
                $("#fechaLimEdi").val(respuesta["fechaFin"]);
    
                if(respuesta["usu_foto"] != ""){
                    $(".previsualizarEditar").attr("src", respuesta["usu_foto"]);
                }else{
                    $(".previsualizarEditar").attr("src", "vistas/img/usuarios/default/anonymous.png");
                }
    
            }
    
        });
    
    });
    
    
    /*=============================================
    ACTIVAR USUARIO
    =============================================*/
    $(".tablas").on("click", ".btnActivar", function(){
    
        var idUsuario = $(this).attr("idUsuario");
        var estadoUsuario = $(this).attr("estadoUsuario");
    
        var datos = new FormData();
         datos.append("activarId", idUsuario);
          datos.append("activarUsuario", estadoUsuario);
    
          $.ajax({
    
          url:"ajax/usuarios.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function(respuesta){
    
                  if(window.matchMedia("(max-width:767px)").matches){
    
                       swal({
                      title: "El usuario ha sido actualizado",
                      type: "success",
                      confirmButtonText: "¡Cerrar!"
                    }).then(function(result) {
                        if (result.value) {
    
                            window.location = "usuarios";
    
                        }
    
    
                    });
    
                  }
    
          }
    
          });
    
          if(estadoUsuario == 0){
    
              $(this).removeClass('btn-success');
              $(this).addClass('btn-danger');
              $(this).html('Bloqueado');
              $(this).attr('estadoUsuario',1);
    
          }else{
    
              $(this).addClass('btn-success');
              $(this).removeClass('btn-danger');
              $(this).html('Activo');
              $(this).attr('estadoUsuario',0);
    
          }
    
    });
    
    
    /*=============================================
    ELIMINAR USUARIO
    =============================================*/
    $(".tablas").on("click", ".btnEliminarUsuario", function(){
    
      var idUsuario = $(this).attr("idUsuario");
      var fotoUsuario = $(this).attr("fotoUsuario");
      var usuario = $(this).attr("usuario");
    
      swal({
        title: '¿Está seguro de borrar el usuario?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar usuario!'
      }).then(function(result){
    
        if(result.value){
    
          window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
    
        }
    
      });
    
    });
    
    
    /*=======================================================
    REVISA SI EL N° IDENTIDAD DEL USUARIO YA ESTÁ REGISTRADO
    =======================================================*/
    
    $("#nuevoDocIdUser").change(function(){
    
        $(".alert").remove();
    
        var docIdUser = $(this).val();
    
        var datos = new FormData();
        datos.append("validarDocIdUser", docIdUser);
    
         $.ajax({
            url:"ajax/usuarios.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                
                if(respuesta){
    
                    $("#alertUsuarioExist").parent().after('<div class="alert alert-warning">El Numero de Identidad ya se encuentra registrado</div>');
                    $(".alert").delay(6000).fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); });
                    $("#nuevoDocIdUser").val("");
    
                }
    
            }
    
        });
    
    });
    
    
    /*=======================================
    REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
    =======================================*/
    
    $("#nuevoUsuario").change(function(){
    
        $(".alert").remove();
    
        var usuario = $(this).val();
    
        var datos = new FormData();
        datos.append("validarUsuario", usuario);
    
         $.ajax({
            url:"ajax/usuarios.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){
                
                if(respuesta){
    
                    $("#alertUsuarioExist").parent().after('<div class="alert alert-warning">El Usuario ya se encuentra registrado</div>');
                    $(".alert").delay(6000).fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); });
                    $("#nuevoUsuario").val("");
    
                }
    
            }
    
        });
    
    });
    
    
    
    /*=======================================
    AGREGA EL N° IDENTIDAD COMO CONTRASEÑA
    =======================================*/
    
    $("#nuevoDocIdUser").keyup(function(){
    
        var docIdentidad = $("#nuevoDocIdUser").val();
        $('#nuevoPassword').val(docIdentidad);
    
    });
    
    /*==============================================
    AGREGA EL N° IDENTIDAD COMO CONTRASEÑA EN EDITAR
    ==============================================*/
    
    $("#editarDocIdUser").keyup(function(){
    
        var docIdentidad = $("#editarDocIdUser").val();
        $('#editarPassword').val(docIdentidad);
    
    });
    
    