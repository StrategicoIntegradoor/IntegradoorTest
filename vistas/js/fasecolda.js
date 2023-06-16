$(document).ready(function () {
	
	/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	FUNCIONES PARA CONSULTA FASECOLDA MANUAL
	::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

	//FUNCION PARA CARGAR CATEGORIA DE VEHICULO
	// function cargarCategoriasSelect() {

	// 	$.ajax({
	// 		type: "POST",
	// 		url: "src/fasecolda/selectCategorias.php",
	// 		data: {},
	// 		success: function (html) {
	// 			$("#clase").html(html);
	// 		}
	// 	});

	// }cargarCategoriasSelect();


	//FUNCION PARA CARGAR MARCA DE VEHICULOS DE ACUERDO A LA SELECCION DE CATEGORIA
	$("#clase").change(function () {

		var id = $(this).val();
		var dataString = "id=" + id;

		$.ajax({
			type: "POST",
			url: "src/fasecolda/marca.php",
			data: dataString,
			cache: false,
			success: function (html) {
				$("#Marca").html(html);
			}
		});

	});


	//FUNCION PARA LLAMAR DATOS MAS
	$("#Marca").change(function () {

		var id = $(this).val();
		var dataString = id;
		var clasveh = $("#clase").val();

		if (dataString == "Mas") {

			$.ajax({
				type: "POST",
				url: "src/fasecolda/marca2.php",
				data: { clasveh: clasveh },
				cache: false,
				success: function (html) {
					$("#referenciados").html("");
					$("#referenciatres").html("");
					$(".costoSoat").html("");
					$("#Marca").html(html);
				}
			});

		} else {

			$.ajax({
				type: "POST",
				url: "src/fasecolda/edadveh.php",
				data: { dataString: dataString, clasveh: clasveh },
				cache: false,
				beforeSend: function () {
					document.getElementById("loadingModelo").innerHTML = "<span><img src='vistas/img/plantilla/loader-loading.gif' width='18' heigth='18'></span>";
				},
				success: function (html) {
					$("#referenciados").html("");
					$("#referenciatres").html("");
					$("#costoSoat").html("");
					$("#edad").html(html);
					document.getElementById("loadingModelo").innerHTML = "<span class='fa fa-check-square'></span>";
				}
			});
		}

	});

	//FUNCION PARA CARGAR LINEA DE VEHICULOS
	$("#edad").change(function () {

		var id = $(this).val();
		var dataString = id;
		var clasveh = $("#clase").val();
		var MarcaVeh = $("#Marca").val();

		$.ajax({
			type: "POST",
			url: "src/fasecolda/referencia1.php",
			data: { dataString: dataString, clasveh: clasveh, MarcaVeh: MarcaVeh },
			cache: false,
			success: function (html) {
				$("#referenciados").html("");
				$("#referenciatres").html("");
				$("#costoSoat").html("");
				$("#linea").html(html);
			}
		});

	});

	$("#linea").change(function () {

		var id = $(this).val();
		var dataString = id;
		var clasveh = $("#clase").val();
		var MarcaVeh = $("#Marca").val();
		var edadVeh = $("#edad").val();

		$.ajax({
			type: "POST",
			url: "src/fasecolda/referencia2.php",
			data: {
				dataString: dataString,
				clasveh: clasveh,
				MarcaVeh: MarcaVeh,
				edadVeh: edadVeh
			},
			cache: false,
			success: function (html) {
				$("#referenciados").html("");
				$("#referenciatres").html("");
				$("#costoSoat").html("");
				$("#referenciados").html(html);
				referenciados();
			}
		});

	});

	//-------------------------------------------------------------------------

	$("#referenciados").change(function () {

		var dataString = $(".refe1").val();
		var clasveh = $("#clase").val();
		var MarcaVeh = $("#Marca").val();
		var edadVeh = $("#edad").val();
		var lineaVeh = $("#linea").val();

		$.ajax({
			type: "POST",
			url: "src/fasecolda/referencia3.php",
			data: {
				dataString: dataString,
				clasveh: clasveh,
				MarcaVeh: MarcaVeh,
				edadVeh: edadVeh,
				lineaVeh: lineaVeh
			},
			cache: false,
			success: function (html) {
				$("#costoSoat").html("");
				$("#referenciatres").html("");
				$("#referenciatres").html(html);
			}
		});

	});

	function referenciados() {

		var refe2 = $(".refe").val();

		if (refe2 != "0" || refe != "") {
			var dataString = $(".refe1").val();
			var clasveh = $("#clase").val();
			var MarcaVeh = $("#Marca").val();
			var edadVeh = $("#edad").val();
			var lineaVeh = $("#linea").val();

			$.ajax({
				type: "POST",
				url: "src/fasecolda/referencia3.php",
				data: {
					dataString: dataString,
					clasveh: clasveh,
					MarcaVeh: MarcaVeh,
					edadVeh: edadVeh,
					lineaVeh: lineaVeh
				},
				cache: false,
				success: function (html) {
					$("#costoSoat").html("");
					$("#referenciatres").html(html);
				}
			});
		}
	}


});
