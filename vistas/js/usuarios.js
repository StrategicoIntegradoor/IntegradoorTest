/*=============================================
CARGANDO DATOS DE INICIO
=============================================*/
(()=>{
cargarIntermediario();
cargarRoll();
})();



  


  

	function cargarIntermediario(){

		const $idInter = document.getElementById("idIntermediario")
		const $idInter2 = document.getElementById("idIntermediario2")

	$.ajax({

		url: "ajax/cargarIntermediario.php",
		method : "POST",
		success : function (respuesta){

		respuesta = '<option disabled selected></option>' + respuesta;

		$idInter.innerHTML=respuesta;
		$idInter2.innerHTML=respuesta;

		//Carga los Intermediarios disponibles para agregar
		$("#idIntermediario").select2({
			theme: "bootstrap int",
			language: "es",
			width: "100%",
			placeholder: "Intermediario*", // Esto configura el placeholder
		});

		//Carga los Intermediarios disponibles para editar
		$("#idIntermediario2").select2({
			theme: "bootstrap int",
			language: "es",
			width: "100%",
			placeholder: "Intermediario", // Esto configura el placeholder
		});
	
		}

	})

	}



/*=============================================
CARGAR ROLL
=============================================*/
  
function cargarRoll (){

	const $idRoll = document.getElementById("idRoll")
	const $idRoll1 = document.getElementById("editarRol")
	const idRol = $("#idRolAdmin").val();

	$.ajax({

		url: "ajax/cargarRoll.php",
		method : "POST",
		data: { idRol: idRol }, // Enviar idRol en el cuerpo de la solicitud AJAX
		success : function (respuesta){

		respuesta = '<option disabled selected></option>' + respuesta;

		$idRoll.innerHTML=respuesta;
		$idRoll1.innerHTML=respuesta;

			// Carga los Intermediarios disponibles para agregar
			$("#idRoll").select2({
				theme: "bootstrap rol",
				language: "es",
				width: "100%",
				placeholder: "Rol*", // Esto configura el placeholder
			});

			// Carga los Intermediarios disponibles para editar
			$("#editarRol").select2({
				theme: "bootstrap rol",
				language: "es",
				width: "100%",
				placeholder: "Rol", // Esto configura el placeholder
			});

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
AGREGAR USUARIO SELECT2 Y CONFIGURACIONES
=============================================*/

  // Modal editar Conviete la letras iniciales del Nombre y el Apellido deL Cliente en Mayusculas
  $("#editarNombre").keyup(function () {
    var cliNombres = document.getElementById("editarNombre").value.toLowerCase();
    $("#editarNombre").val(
      cliNombres.replace(/^(.)|\s(.)/g, function ($1) {
        return $1.toUpperCase();
      })
    );
  });
  $("#editarApellido").keyup(function () {
    var cliApellido = document
      .getElementById("editarApellido")
      .value.toLowerCase();
    $("#editarApellido").val(
      cliApellido.replace(/^(.)|\s(.)/g, function ($1) {
        return $1.toUpperCase();
      })
    );
  });

    // Modal agregar Conviete la letras iniciales del Nombre y el Apellido deL Cliente en Mayusculas
	$("#nuevoNombre").keyup(function () {
		var cliNombres = document.getElementById("nuevoNombre").value.toLowerCase();
		$("#nuevoNombre").val(
		  cliNombres.replace(/^(.)|\s(.)/g, function ($1) {
			return $1.toUpperCase();
		  })
		);
	  });

	$("#nuevoApellido").keyup(function () {
	var cliApellido = document
		.getElementById("nuevoApellido")
		.value.toLowerCase();
	$("#nuevoApellido").val(
		cliApellido.replace(/^(.)|\s(.)/g, function ($1) {
		return $1.toUpperCase();
		})
	);
	});


	// Carga los Documentos disponibles para agregar
	$("#agregarTipoDocumento").select2({
		theme: "bootstrap doc",
		language: "es",
		width: "100%",
		placeholder: "Tipo Documento*", // Esto configura el placeholder
	});

	// Carga los Generos disponibles para agregar
	$("#nuevoGenero").select2({
		theme: "bootstrap gen",
		language: "es",
		width: "100%",
		placeholder: "Genero*", // Esto configura el placeholder
	});

	// Carga los Departamentos disponibles para editar
	$("#DptoCirculacion").select2({
	theme: "bootstrap dpto1",
	language: "es",
	width: "100%",
	});

	$("#DptoCirculacion").change(function () {
		consultarCiudad();
	});

	// Carga las Ciudades disponibles para editar
	$("#ciudadCirculacion").select2({
		theme: "bootstrap ciudad1",
		language: "es",
		width: "100%",
		});

	// Carga los Departamentos disponibles para agregar
	$("#ingDptoCirculacion").select2({
		theme: "bootstrap dpto1",
		language: "es",
		width: "100%",
		placeholder: "Departamento*",
		});
		
	$("#ingDptoCirculacion").change(function () {
		consultarCiudadAgregar();
		});

	// Carga las Ciudades disponibles para agregar
	$("#ingciudadCirculacion").select2({
		theme: "bootstrap ciudad1",
		language: "es",
		width: "100%",
		placeholder: "Ciudad*", // Texto del placeholder del buscador

		});

// FUNCION PARA CARGAR LA CIUDAD DE CIRCULACIÓN
function consultarCiudad() {
	var codigoDpto = document.getElementById("DptoCirculacion").value;
  
	$.ajax({
	  type: "POST",
	  url: "src/consultarCiudad.php",
	  dataType: "json",
	  data: { data: codigoDpto },
	  cache: false,
	  success: function (data) {
		// console.log(data);
		var ciudadesVeh = `<option value="">Seleccionar Ciudad</option>`;
  
		data.forEach(function (valor, i) {
		  var valorNombre = valor.Nombre.split("-");
		  var nombreMinusc = valorNombre[0].toLowerCase();
		  var ciudad = nombreMinusc.replace(/^(.)|\s(.)/g, function ($1) {
			return $1.toUpperCase();
		  });
  
		  ciudadesVeh += `<option value="${valor.Codigo}">${ciudad}</option>`;
		});
		document.getElementById("ciudadCirculacion").innerHTML = ciudadesVeh;
		// document.getElementById("ingciudadCirculacion").innerHTML = ciudadesVeh;

	  },
	});
  
	//}
  }

// FUNCION PARA CARGAR LA CIUDAD DE CIRCULACIÓN
function consultarCiudadAgregar() {
	var codigoDpto = document.getElementById("ingDptoCirculacion").value;
  
	$.ajax({
	  type: "POST",
	  url: "src/consultarCiudad.php",
	  dataType: "json",
	  data: { data: codigoDpto },
	  cache: false,
	  success: function (data) {
		// console.log(data);
		var ciudadesVeh = `<option value="">Seleccionar Ciudad</option>`;
  
		data.forEach(function (valor, i) {
		  var valorNombre = valor.Nombre.split("-");
		  var nombreMinusc = valorNombre[0].toLowerCase();
		  var ciudad = nombreMinusc.replace(/^(.)|\s(.)/g, function ($1) {
			return $1.toUpperCase();
		  });
  
		  ciudadesVeh += `<option value="${valor.Codigo}">${ciudad}</option>`;
		});
		// document.getElementById("ciudadCirculacion").innerHTML = ciudadesVeh;
		document.getElementById("ingciudadCirculacion").innerHTML = ciudadesVeh;

	  },
	});
  
	//}
  }

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

			$("#idUsuEdit").val(respuesta["id_usuario"]);			
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
			$("#maxiCot").val(respuesta["numCotizaciones"]);
			$("#fechaLimEdi").val(respuesta["fechaFin"]);
			$("#fechNacimiento").val(respuesta["usu_fch_nac"]);
			$("#editarDireccion").val(respuesta["direccion"]);
			$("#editarTipoDocumento").val(respuesta["tipos_documentos_id"]);
			$("#editarTipoDocumento").trigger("change");
			$("#editarGenero").trigger("change");
			$("#idIntermediario2").trigger("change");
			$("#editarRol").trigger("change");


  			// Convertir la fecha ISO 8601 a un objeto Date

			function formatearFechaISO8601(fechaISO8601) {
			// Convertir la fecha ISO 8601 a un objeto Date
			var fecha = new Date(fechaISO8601);
			
			// Obtener los componentes de la fecha
			var dia = fecha.getDate();
			var mes = fecha.getMonth() + 1; // Los meses van de 0 a 11, sumamos 1 para obtener el mes correcto
			var anio = fecha.getFullYear();
			
			// Formatear la fecha en formato "yyyy-mm-dd"
			var fechaFormateada = anio + "-" + (mes < 10 ? "0" + mes : mes) + "-" + (dia < 10 ? "0" + dia : dia);
			
			return fechaFormateada;
			}
			
			// Supongamos que tienes la fecha en formato ISO 8601 en la variable 'fechaISO8601'
			var fechaISO8601 = respuesta["usu_fch_creacion"];
			
			// Formatear la fecha
			var fechaFormateada = formatearFechaISO8601(fechaISO8601);
			
			// Asignar la fecha formateada al campo de entrada
			$("#fechaUserExist").val(fechaFormateada);
			  

  			// Logica foto de usuario
			if(respuesta["usu_foto"] != ""){
				$(".previsualizarEditar").attr("src", respuesta["usu_foto"]);
			}else{
				$(".previsualizarEditar").attr("src", "vistas/img/usuarios/default/anonymous.png");
			}

			// Crear una instancia de FormData
			var formData = new FormData();

			// Obtener el código de ciudad
			var codigoCiudad = respuesta["ciudades_id"];
			formData.append("ciudad", codigoCiudad);


			// var codigoCiudad = respuesta["ciudades_id"].toString();

			// console.log(codigoCiudad.length)
			// if (codigoCiudad.length < 5) {
				
			// 	var nuevoCodigoCiudad = "0" + codigoCiudad;
			// 	formData.append("ciudad", nuevoCodigoCiudad);

			//   }else{
			// 	formData.append("ciudad", codigoCiudad);
			//   }

			
			// FUNCION BUSCAR CIUDAD #1

			$.ajax({

				url:"ajax/ciudades.ajax.php",
				method: "POST",
				data: formData, // Agrega el nombre del campo "ciudad"
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){
				console.log("success");

				// function obtenerValorDepartamento(nombreDepartamento) {
				// var options = $("#DptoCirculacion option"); // Obtener todas las opciones del select
				// for (var i = 0; i < options.length; i++) {
				// 	if (options[i].text.toUpperCase() === nombreDepartamento.toUpperCase()) {
				// 	return options[i].value; // Retornar el valor de la opción que coincide con el nombre
				// 	}
				// }
				// return ""; // Valor por defecto si el nombre del departamento no coincide con ninguno
				// }

				// Supongamos que tienes el nombre del departamento en una variable llamada 'departamento'
				var municipio = respuesta.Nombre; // Nombre del departamento obtenido desde la respuesta
				var codigo = respuesta.Codigo;
				
				// Obtener el valor del select a partir del nombre del municipio
				// var valorDepartamento = obtenerValorDepartamento(departamento);

				$('#ciudadActual').val(municipio);
				$('#codigoCiudadActual').val(codigo);

				}
		
			});

			// FUNCION BUSCAR CIUDAD #2

			// $.ajax({
			// 	url: "ajax/ciudades.ajax.php",
			// 	method: "POST",
			// 	dataType: "json",
			// 	success: function (respuesta) {

			// 	  console.log(respuesta);
			// 	  const selectCiudadCirculacion2 = $("#ciudad2");
			  
			// 	  respuesta.forEach(function (ciudad) {
			// 		const option = $("<option>", {
			// 		  value: ciudad.Codigo, // Suponiendo que el código es el valor que deseas enviar al servidor
			// 		  text: ciudad.Nombre // Utiliza la propiedad "nombre" para mostrar el nombre de la ciudad en la opción
			// 		});
			  
			// 		selectCiudadCirculacion2.append(option);
			// 	  });
			// 	},
			// 	error: function (xhr, status, error) {
			// 	  console.error(error);
			// 	}
			//   });


			$("#ciudad2").select2({
				theme: "bootstrap dpto1",
				language: "es",
				width: "100%",
				// data: '<?php echo json_encode($ciudadesSelect2); ?>',
				ajax: {
				  url: "ajax/ciudades.ajax.php", // URL del script PHP que devolverá las ciudades
				  dataType: "json",
				  delay: 250, // Retardo antes de realizar la búsqueda (milisegundos)
				  data: function (params) {
					return {
					  q: params.term, // Término de búsqueda ingresado por el usuario
					};
				  },
				  processResults: function (data) {
					return {
					  results: data, // Resultados obtenidos del servidor
					};
				  },
				  cache: true, // Habilitar el almacenamiento en caché para reducir las solicitudes al servidor
				},
				minimumInputLength: 3, // Número mínimo de caracteres para comenzar la búsqueda
				allowClear: true, // Mostrar botón para borrar la selección
				dropdownAutoWidth: true, // Ancho automático del desplegable
				placeholder: "Editar ciudad", // Texto del placeholder del buscador
			  });
			  

		}

	});

});


/*=============================================
EDITAR USUARIO SELECT2 Y CONFIGURACIONES
=============================================*/

// Carga los Documentos disponibles para agregar
$("#editarTipoDocumento").select2({
	theme: "bootstrap doc",
	language: "es",
	width: "100%",
	// placeholder: "Tipo Documento*", // Esto configura el placeholder
});

// Carga los Generos disponibles para agregar
$("#editarGenero").select2({
	theme: "bootstrap gen",
	language: "es",
	width: "100%",
	// placeholder: "Genero*", // Esto configura el placeholder
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

// VALIDACION PARA NUMERO DE CELULAR MODAL AGREGAR
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("userForm").addEventListener("submit", function (event) {
    // Aquí realizas la validación del número de celular
    var placaInput = document.getElementById("AgregMovil");
    var telefono = placaInput.value.trim(); // Eliminar espacios en blanco al principio y al final

    // Expresión regular para validar un número de celular con al menos 10 dígitos
    var formatoValido = /^(?:\(\d{3}\)\s*|\d{3}-?)\d{3}-?\d{4}$/.test(telefono);

    if (!formatoValido) {
      var mensajeError = document.getElementById("mensajeErrorCelular");
      mensajeError.style.display = "block";
      mensajeError.textContent = "Número de celular incompleto, verificar información";
      event.preventDefault(); // Evita que se envíe el formulario si la validación falla
    }
  });
});

// VALIDACION PARA NUMERO DE CELULAR MODAL EDITAR

document.addEventListener("DOMContentLoaded", function() {
	document.getElementById("userEditForm").addEventListener("submit", function (event) {
	  // Aquí realizas la validación del número de celular
	  var placaInput = document.getElementById("editarTelefono");
	  var telefono = placaInput.value.trim(); // Eliminar espacios en blanco al principio y al final
  
	  // Expresión regular para validar un número de celular con al menos 10 dígitos
	  var formatoValido = /^(?:\(\d{3}\)\s*|\d{3}-?)\d{3}-?\d{4}$/.test(telefono);
  
	  if (!formatoValido) {
		var mensajeError = document.getElementById("mensajeErrorCelularEdit");
		mensajeError.style.display = "block";
		mensajeError.textContent = "Número de celular incompleto, verificar información";
		event.preventDefault(); // Evita que se envíe el formulario si la validación falla
	  }
	});
  });

