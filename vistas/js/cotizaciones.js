

let permisos = "";

$(document).ready(function () {



  permisos = JSON.parse(permisosPlantilla);

  const aseguradorasExitosas = []


  // Mostrar alertas
  //PRIMERA VERSION ALERTAS
  const alertas = new Promise((resolve, reject) => {

    const requestOptions = {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ obtenerAlertas: true, cotizacion: idCotizacion }),
    };
    var documentosTable = document.getElementById("tablaResumenCot");
    fetch('ajax/alerta_aseguradora.ajax.php', requestOptions)
    .then((response) => response.json())
    .then(data => {
      // console.log(data)
      const cotizacionesSeparadas = {};
      data.forEach(cotizacion => {
        const aseguradora = cotizacion.aseguradora;
    
        if (!cotizacionesSeparadas[aseguradora]) {
            cotizacionesSeparadas[aseguradora] = [];
        }
    
        cotizacionesSeparadas[aseguradora].push(cotizacion);
      });
    
      // Ordenar aseguradoras alfabéticamente
      const aseguradorasOrdenadas = Object.keys(cotizacionesSeparadas).sort();
      const cotizacionesConVariasOfertas = [];
      const cotizacionesConUnaOferta = [];

      // console.log(aseguradorasOrdenadas)
      aseguradorasOrdenadas.forEach(aseguradora => {
        const cotizacionesAseguradora = cotizacionesSeparadas[aseguradora];
  
        if (cotizacionesAseguradora.length > 1) {
          cotizacionesConVariasOfertas.push(...cotizacionesAseguradora);
        } else {
          cotizacionesConUnaOferta.push(...cotizacionesAseguradora);
        }
      });
      
      console.log(cotizacionesConVariasOfertas)
    //   console.log(cotizacionesConUnaOferta)

      const cotizacionesPorAseguradora = {};

      cotizacionesConVariasOfertas.forEach(cotizacion => {
        const aseguradora = cotizacion.aseguradora;

        if (!cotizacionesPorAseguradora[aseguradora]) {
          cotizacionesPorAseguradora[aseguradora] = {
            exitosa1: [],
            exitosa0: [],
            sumExitosa1: 0,
            sumExitosa0: 0,
          };
        }

        if (cotizacion.exitosa === "1") {
          cotizacionesPorAseguradora[aseguradora].exitosa1.push(cotizacion);
          cotizacionesPorAseguradora[aseguradora].sumExitosa1 += cotizacion.ofertas_cotizadas;
        } else if (cotizacion.exitosa === "0") {
          cotizacionesPorAseguradora[aseguradora].exitosa0.push(cotizacion);
          cotizacionesPorAseguradora[aseguradora].sumExitosa0 += cotizacion.ofertas_cotizadas;
        }
      });


      console.log(cotizacionesPorAseguradora)



        let cotizacionesExitosa1 = [];
        let cotizacionesExitosa0 = [];
        
        for (const aseguradora in cotizacionesPorAseguradora) {
          const exitosa1Array = cotizacionesPorAseguradora[aseguradora].exitosa1;
        
          if (exitosa1Array.length > 0) {
            const sumaOfertasExitosa1 = exitosa1Array.reduce((sum, usuario) => sum + usuario.ofertas_cotizadas, 0);
        
            cotizacionesExitosa1.push(...exitosa1Array.map(usuario => ({
              aseguradora: usuario.aseguradora,
              exitosa: usuario.exitosa,
              ofertas_cotizadas: sumaOfertasExitosa1,
              mensaje: '',
            })));
          } else {
            // Cambié la asignación a push para agregar un nuevo elemento al array
            cotizacionesExitosa0.push({
              aseguradora,
              exitosa: 0,
              ofertas_cotizadas: 0,
              mensaje: cotizacionesPorAseguradora[aseguradora].exitosa0[0].mensaje,
            });
          }
        }
        
        // Ahora cotizacionesExitosa1 y cotizacionesExitosa0 contienen la estructura que deseas
        // console.log(cotizacionesExitosa1);
        // console.log(cotizacionesExitosa0);
        




      let aseguradorasData = {};
      for (const aseguradora in cotizacionesPorAseguradora) {
        const exitosa1Array = cotizacionesPorAseguradora[aseguradora].exitosa1;
        console.log('exitosa1Array:', exitosa1Array);

        if (exitosa1Array.length > 0) {
            
            const sumaOfertasExitosa1 = exitosa1Array.reduce((sum, usuario) => {
            // Convertir las cadenas a números usando parseInt
            const ofertasCotizadas = parseInt(usuario.ofertas_cotizadas, 10);
    
            return sum + ofertasCotizadas;
            }, 0);

    console.log('sumaOfertasExitosa1:', sumaOfertasExitosa1);

          if (aseguradorasData[aseguradora]) {
            // Si ya existe una entrada para la aseguradora, actualiza la información
            aseguradorasData[aseguradora].ofertas_cotizadas += sumaOfertasExitosa1;
          } else {
            // Si no existe una entrada, crea una nueva
            aseguradorasData[aseguradora] = {
              aseguradora,
              exitosa: "1",
              ofertas_cotizadas: sumaOfertasExitosa1,
              mensaje: '',
            };
          }
        } else {
          // Crear array con características específicas si exitosa1 está vacío
          aseguradorasData[aseguradora] = {
            aseguradora,
            exitosa: 0,
            ofertas_cotizadas: 0,
            mensaje: cotizacionesPorAseguradora[aseguradora].exitosa0[0].mensaje,
          };
        }
      }

      // Convertir el objeto en un array
      const resultadoFinal = Object.values(aseguradorasData);
    //   console.log(resultadoFinal);
    //   console.log(cotizacionesConUnaOferta)

      // Combina los dos arrays
      const combinedArray = [...resultadoFinal, ...cotizacionesConUnaOferta];

      // Ordena el array resultante por la propiedad "aseguradora"
      combinedArray.sort((a, b) => a.aseguradora.localeCompare(b.aseguradora));

      console.log(combinedArray);

     //COTIZACIONES EXITOSAS VARIAS PETICIONES//

      var tableBody = documentosTable.getElementsByTagName("tbody")[0];
      tableBody.innerHTML = "";

      // if (resultadoFinal) {
      //   resultadoFinal.forEach(usuario => {
      //     var newRow = tableBody.insertRow();

      //     var aseguradoraCell = newRow.insertCell();
      //     aseguradoraCell.textContent = usuario.aseguradora;

      //     var cotizoCell = newRow.insertCell();
      //     // Cambiar el contenido de la celda en función de si cotizó o no
      //     cotizoCell.innerHTML = usuario.exitosa === 1
      //       ? '<i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;"></i>'
      //       : '<i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i>';
      //     cotizoCell.classList.add('text-center'); // Agrega la clase text-center a cotizoCell

      //     var productosCell = newRow.insertCell();
      //     productosCell.textContent = usuario.ofertas_cotizadas;
      //     productosCell.classList.add('text-center'); // Agregar la clase text-center a productosCell

      //     var observacionesCell = newRow.insertCell();
      //     observacionesCell.textContent = usuario.mensaje;
      //   });
      // }


      //COTIZACIONES EXITOSAS VARIAS PETICIONES FINAL//

      // UNA OFERTA Iterar sobre los datos y agregar filas a la tabla
      combinedArray.forEach(usuario => {
          var newRow = tableBody.insertRow();

          var aseguradoraCell = newRow.insertCell();
          aseguradoraCell.textContent = usuario.aseguradora;            

          var cotizoCell = newRow.insertCell();
          // Cambiar el contenido de la celda en función de si cotizó o no
          cotizoCell.innerHTML = usuario.exitosa === "1"
          ? '<i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;"></i>'
          : '<i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i>';
          cotizoCell.classList.add('text-center'); // Agrega la clase text-center a cotizoCell

          var productosCell = newRow.insertCell();
          productosCell.textContent = usuario.ofertas_cotizadas;
          productosCell.classList.add('text-center'); // Agregar la clase text-center a productosCell

          var observacionesCell = newRow.insertCell();
          observacionesCell.textContent = usuario.mensaje;

      });

    })
    .catch(error => {
      console.error('Error al obtener la información de la tabla:', error);
    });

  });
  



  // alertas.then(result => {

  //   console.log(alertas)

  //   result.forEach(alerta => {

  //     if (alerta.exitosa == '1') {


  //       // if (!aseguradorasExitosas.includes(alerta.aseguradora)) {

  //       //   document.querySelector('.exitosas').innerHTML += `<span style="margin-right: 15px;"><i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;

  //       //             "></i>${alerta.aseguradora}</span>

  //       //             `

  //       //   aseguradorasExitosas.push(alerta.aseguradora)

  //       // }

  //     } else {

  //       // document.querySelector('.fallidas').innerHTML += `<p><i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i>${alerta.aseguradora}: ${alerta.mensaje}</p>`

  //     }

  //   })

  // })


  // Limpia los contenedores de las Cards y del Boton PDF y Recotiza

  $("#btnRecotizar").click(function () {

    document.getElementById("formularioCotizacionManual").style.display =

      "none";

    let cardCotizacion = document.querySelector("#cardCotizacion");

    cardCotizacion.innerHTML = "";

    cotizarOfertas();

  });



  // Limpia los contenedores de las Cards y del Boton PDF y Recotiza

  $("#btnRecotizar").click(function () {

    document.getElementById("formularioCotizacionManual").style.display =

      "none";

    let cardCotizacion = document.querySelector("#cardCotizacion");

    cardCotizacion.innerHTML = "";

    cotizarOfertas();

  });



  // Visualiza el formulario para agregar cotizaciones manualmente

  $("#btnMostrarFormCotManual").click(function () {









    if (permisos.Agregarcotizacionmanual != "x") {



      Swal.fire({

        icon: 'error',

        title: '¡Esta versión no tiene ésta funcionalidad disponible!',

        showCancelButton: true,

        confirmButtonText: 'Cerrar',

        cancelButtonText: 'Conoce más'

      }).then((result) => {



        if (result.isConfirmed) {

        } else if (result.isDismissed

        ) {



          window.open('https://www.integradoor.com', "_blank")



        }

      })

    } else {





      document.getElementById("formularioCotizacionManual").style.display = "block";


      //document.querySelector(".btnAgregar").innerHTML = '<button class="btn btn-primary btn-block" id="btnAgregarCotizacion">Agregar Cotización</button>';

      $("#btnAgregarCotizacion").click(function () {

        agregarCotizacion();

      });

      vaciarCamposOfertaManual();

      menosVeh();

      masAgr();

    }

  });



  // Funcion para seleccionar el Producto Manualmente

  $("#aseguradora").change(function () {

    selecProductoManual();

  });



  // Función para seleccionar RC Manualmente

  $("#producto").change(function () {

    selecRCManual();

  });



  // Función para cargar las Coberturas Manualmente

  $("#valorRC").change(function () {

    selecCoberturasManual();

  });



  // Ejectura la funcion Agregar Cotizacion Manualmente

  $("#btnAgregarCotizacion").click(function () {

    agregarCotizacion();

  });



  // Ejectura la funcion Agregar Cotizacion Manualmente

  $("#btnAgregarCotizacionManual").click(function () {

    agregarCotizacionManual2();

  });



  // Imprimir Parrilla de Cotizaciones

  $("#btnParrillaPDF").click(function () {

    var todosOn = $(".classSelecOferta:checked").length;

    var idCotizacionPDF = idCotizacion;
    
    var checkboxAsesorEditar = $("#checkboxAsesorEditar");

    var valorTxtFasecolda = $("#txtFasecolda").val(); // Obtener el valor del input con el id "txtFasecolda"

    function codigoClase(numero) {
      // Convierte el número a una cadena para acceder a los dígitos individualmente
      var numeroComoCadena = numero.toString();
    
      // Asegúrate de que la cadena tenga al menos 5 dígitos
      if (numeroComoCadena.length >= 5) {
        var cuartoDigito = numeroComoCadena.charAt(3);
        var quintoDigito = numeroComoCadena.charAt(4);
    
        // Verifica si el cuarto dígito no es cero
        if (cuartoDigito !== '0') {
          // Concatena el cuarto y quinto dígitos
          return cuartoDigito + quintoDigito;
        } else {
          // Devuelve solo el cuarto dígito
          return quintoDigito;
        }
      } else {
        // No hay suficientes dígitos, devuelve el número original
        return numero;
      }
    }

    var claseFasecolda = codigoClase(valorTxtFasecolda);

    if (permisos.Generarpdfdecotizacion != "x") {



      Swal.fire({

        icon: 'error',

        title: '¡Esta versión no tiene ésta funcionalidad disponible!',

        showCancelButton: true,

        confirmButtonText: 'Cerrar',

        cancelButtonText: 'Conoce más'

      }).then((result) => {



        if (result.isConfirmed) {

        } else if (result.isDismissed

        ) {



          window.open('https://www.integradoor.com', "_blank")



        }

      })

    } else {



      if (!todosOn) {

        swal.fire({

          icon: "error",

          title: "¡Debes seleccionar minimo una oferta!",

        });

      } else {

        if( claseFasecolda == 4 ||
          claseFasecolda == 12 ||
          claseFasecolda == 10 ||
          claseFasecolda == 14 ||
          claseFasecolda == 22 ||
          claseFasecolda == 25 ||
          claseFasecolda == 26){

          let url = `extensiones/tcpdf/pdf/comparadorPesados.php?cotizacion=${idCotizacionPDF}`;

          if (checkboxAsesorEditar.is(":checked")) {
            url += "&generar_pdf=1";
          }

          window.open(url, "_blank");

        }else{

          let url = `extensiones/tcpdf/pdf/comparador.php?cotizacion=${idCotizacionPDF}`;

          if (checkboxAsesorEditar.is(":checked")) {
            url += "&generar_pdf=1";
          }

          window.open(url, "_blank");

        // window.open("comparador.php?cotizacion="+idCotizacionPDF, "_blank");
        // window.open(
        //   "extensiones/tcpdf/pdf/comparador.php?cotizacion=" + idCotizacionPDF,
        //   "_blank"
        // );
        }
      }

    }

  });



  // Imprimir Parrilla de Cotizaciones

  $("#btnParrillaPDF2").click(function () {

    var todosOn = $(".classSelecOferta:checked").length;

    var idCotizacionPDF = idCotizacion;

    if (permisos.Generarpdfdecotizacion != "x") {



      Swal.fire({

        icon: 'error',

        title: '¡Esta versión no tiene ésta funcionalidad disponible!',

        showCancelButton: true,

        confirmButtonText: 'Cerrar',

        cancelButtonText: 'Conoce más'

      }).then((result) => {



        if (result.isConfirmed) {

        } else if (result.isDismissed

        ) {



          window.open('https://www.integradoor.com', "_blank")



        }

      })

    } else {



      if (!todosOn) {

        swal.fire({

          icon: "error",

          title: "¡Debes seleccionar minimo una oferta!",

        });

      } else {

        // window.open("comparador.php?cotizacion="+idCotizacionPDF, "_blank");

        window.open(

          "extensiones/tcpdf/pdf/comparadorPesados.php?cotizacion=" +

          idCotizacionPDF,

          "_blank"

        );

      }

    }

  });



  /*=============================================

  BOTON EDITAR COTIZACIÓN

  =============================================*/

  $(".tablas-cotizaciones").on("click", ".btnEditarCotizacion", function () {

    var idCotizacion = $(this).attr("idCotizacion");

    window.location =

      "index.php?ruta=editar-cotizacion&idCotizacion=" + idCotizacion;

    // $.redirect("editar-cotizacion", { idCotizacion: idCotizacion }, "POST");

  });



  /*=============================================

  ELIMINAR COTIZACIÓN

  =============================================*/

  $(".tablas-cotizaciones").on("click", ".btnEliminarCotizacion", function () {

    var idCotizacion = $(this).attr("idCotizacion");



    swal({

      title: "¿Está seguro de borrar la cotización?",

      text: "¡Si no lo está puede cancelar la acción!",

      type: "warning",

      showCancelButton: true,

      confirmButtonColor: "#3085d6",

      cancelButtonColor: "#d33",

      cancelButtonText: "Cancelar",

      confirmButtonText: "Si, borrar cotización!",

    }).then(function (result) {

      if (result.value) {

        window.location = "index.php?ruta=inicio&idCotizacion=" + idCotizacion;

      }

    });

  });



  /*===================================================

  CONFIGURACION DE LA TABLA DATATABLE PARA COTIZACIONES

  ===================================================*/

  $(".tablas-cotizaciones").DataTable({

    order: [
      [0, "desc"],
      [1, "desc"],
    ],

    // "ordering": false,

    language: {

      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },

      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },

    },

  });

  $(".tablas-cotizaciones1").DataTable({

    order: [
      [0, "desc"],
      [1, "desc"],
    ],

    // "ordering": false,

    language: {

      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },

      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },

    },

  });

  $(".tablas-cotizaciones2").DataTable({

    order: [
      [0, "desc"],
      [1, "desc"],
    ],

    // "ordering": false,

    language: {

      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },

      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },

    },

  });

  /*=============================================

  ADICIONAR CLASES PERSONALIZADAS AL DATERANGE

  =============================================*/

  $("#daterange-btnCotizaciones").on("click", function () {

    $(".daterangepicker.opensleft .ranges li.active").addClass(

      "liCotizaciones"

    );

  });



  /*=============================================

  RANGO DE FECHAS

  =============================================*/

  $("#daterange-btnCotizaciones").daterangepicker(

    {

      ranges: {

        Hoy: [moment(), moment()],

        Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],

        "Últimos 7 días": [moment().subtract(6, "days"), moment()],

        "Últimos 30 días": [moment().subtract(29, "days"), moment()],

        "Este mes": [moment().startOf("month"), moment().endOf("month")],

        "Último mes": [

          moment().subtract(1, "month").startOf("month"),

          moment().subtract(1, "month").endOf("month"),

        ],

      },

      startDate: moment(),

      endDate: moment(),

    },

    function (start, end) {

      $("#daterange-btnCotizaciones span").html(

        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")

      );



      var fechaInicialCotizaciones = start.format("YYYY-MM-DD");



      var fechaFinalCotizaciones = end.format("YYYY-MM-DD");



      var capturarRango = $("#daterange-btnCotizaciones span").html();



      localStorage.setItem("capturarRango", capturarRango);



      window.location =

        "index.php?ruta=adminCoti&" +
        
        "fechaInicialCotizaciones=" +

        fechaInicialCotizaciones +

        "&fechaFinalCotizaciones=" +

        fechaFinalCotizaciones;

    }

  );



  /*=============================================

  CANCELAR RANGO DE FECHAS

  =============================================*/

  $("#daterange-btnCotizaciones").on(

    "cancel.daterangepicker",

    function (ev, picker) {

      localStorage.removeItem("capturarRango");

      localStorage.clear();

      window.location = "inicio";

    }

  );



  /*=============================================

  CAPTURAR HOY

  =============================================*/

  $(".daterangepicker.opensleft").on("click", ".liCotizaciones", function () {

    var textoHoy = $(this).attr("data-range-key");



    if (textoHoy == "Hoy") {

      var d = new Date();

      var dia = d.getDate();

      var mes = d.getMonth() + 1;

      var año = d.getFullYear();



      dia = ("0" + dia).slice(-2);

      mes = ("0" + mes).slice(-2);



      var fechaInicialCotizaciones = año + "-" + mes + "-" + dia;

      var fechaFinalCotizaciones = año + "-" + mes + "-" + dia;



      localStorage.setItem("capturarRango", "Hoy");

      window.location =

      "index.php?ruta=adminCoti&" +
        
      "fechaInicialCotizaciones=" +

      fechaInicialCotizaciones +

      "&fechaFinalCotizaciones=" +

      fechaFinalCotizaciones;

    }

  });

});


/*================================================

// CAPTURA LA URL DE LA PAGINA EDITAR COTIZACIONES

================================================*/



var urlPage = new URL(window.location.href); // Instancia la URL Actual

var options = urlPage.searchParams.getAll("idCotizacion"); //Buscar todos los parametros

if (options.length > 0) {

  editarCotizacion(options[0]);

}



/*=============================================

EDITAR COTIZACION

=============================================*/



var numId = 1;



function editarCotizacion(id) {

  idCotizacion = id; // Almacena el Id en la variable global de idCotización



  var datos = new FormData();

  datos.append("idCotizacion", idCotizacion);



  /*=============================================			

  INFORMACION DEL ASEGURADO Y DEL VEHICULO

  =============================================*/

  $.ajax({

    url: "ajax/cotizaciones.ajax.php",

    method: "POST",

    data: datos,

    cache: false,

    contentType: false,

    processData: false,

    dataType: "json",

    success: function (respuesta) {

      /* FORMULARIO INFORMACIÓN DEL ASEGURADO */

      $("#placaVeh").val(respuesta["cot_placa"]);

      $("#idCliente").val(respuesta["id_cliente"]);

      $("#tipoDocumentoID").val(respuesta["id_tipo_documento"]);

      $("#numDocumentoID").val(respuesta["cli_num_documento"]);

      $("#txtNombres").val(respuesta["cli_nombre"]);

      $("#txtApellidos").val(respuesta["cli_apellidos"]);

      $("#genero").val(respuesta["cli_genero"]);

      $("#estadoCivil").val(respuesta["id_estado_civil"]);

      $("#emailID").val(respuesta["cli_email"]);

      $("#telefonoID").val(respuesta["cli_telefono"]);

      $("#mundial").val(respuesta["cot_mundial"]);

      console.log("Valor de #mundial:", respuesta["cot_mundial"]);

      if (respuesta && respuesta["cli_fch_nacimiento"]) {
        var fecha = respuesta["cli_fch_nacimiento"].split("-");
        // Resto del código que utiliza 'fecha'
      } else {
          console.error("La propiedad 'cli_fch_nacimiento' no está definida o es null/undefined.");
      }
    

      if (fecha && Array.isArray(fecha) && fecha.length > 1) {
          var nombreMes = obtenerNombreMes(fecha[1]);
          // Resto del código que utiliza 'nombreMes'
      } else {
          console.error("La variable 'fecha' no está definida, no es un array o no tiene al menos dos elementos.");
      }
    

      if (fecha && Array.isArray(fecha) && fecha.length >= 3) {
        $("#dianacimiento").append(
            "<option value='" + fecha[2] + "' selected>" + fecha[2] + "</option>"
        );
      } else {
          console.error("La variable 'fecha' no está definida, no es un array o no tiene al menos tres elementos.");
      }
      
      if (fecha && Array.isArray(fecha) && fecha.length >= 1 && nombreMes) {
          $("#mesnacimiento").append(
              "<option value='" +
              fecha[1] +
              "' selected>" +
              nombreMes[0].toUpperCase() +
              nombreMes.slice(1) +
              "</option>"
          );
      } else {
          console.error("La variable 'fecha' no está definida, no es un array o no tiene al menos un elemento, o 'nombreMes' no está definida.");
      }
      
      if (fecha && Array.isArray(fecha) && fecha.length >= 1) {
          $("#anionacimiento").append(
              "<option value='" + fecha[0] + "' selected>" + fecha[0] + "</option>"
          );
      } else {
          console.error("La variable 'fecha' no está definida, no es un array o no tiene al menos un elemento.");
      }
    



      /* FORMULARIO INFORMACIÓN DEL VEHICULO */

      if (respuesta["cot_cerokm"] == 1) {

        document.getElementById("contenPlaca").style.display = "none";

        document.getElementById("contenCeroKM").style.display = "block";

        $("#txtConocesLaPlacaNo").prop("checked", true);

        $("#txtEsCeroKmSi").prop("checked", true);

      }



      if (respuesta["cot_placa"] == "KZY000") {

        $("#txtPlacaVeh").val("SIN PLACA - VEHÍCULO 0 KM").val();

      } else {

        $("#txtPlacaVeh").val(respuesta["cot_placa"]).val();

      }



      $("#CodigoClase").val(respuesta["cot_cod_clase"]);

      $("#txtClaseVeh").val(respuesta["cot_clase"]);

      $("#txtMarcaVeh").val(respuesta["cot_marca"]);

      $("#txtModeloVeh").val(respuesta["cot_modelo"]);

      $("#txtReferenciaVeh").val(respuesta["cot_linea"]);

      $("#txtFasecolda").val(respuesta["cot_fasecolda"]);

      $("#txtValorFasecolda").val(respuesta["cot_valor_asegurado"]);

      $("#txtTipoUsoVehiculo").val(respuesta["cot_tip_uso"]);

      $("#txtTipoServicio").val(respuesta["cot_tip_servicio"]);

      $("#DptoCirculacion").append(

        "<option value='" +

        respuesta["cot_departamento"] +

        "' selected>" +

        departamentoVeh(respuesta["cot_departamento"]) +

        "</option>"

      );



      var posicion = respuesta["Nombre"].split("-");

      var ciudad = posicion[0].toLowerCase();

      var nomCiudad = ciudad.replace(/^(.)|\s(.)/g, function ($1) {

        return $1.toUpperCase();

      });

      $("#ciudadCirculacion").append(

        "<option value='" +

        respuesta["cot_ciudad"] +

        "' selected>" +

        nomCiudad +

        "</option>"

      );



      if (respuesta["cot_bnf_oneroso"] != "") {

        $("#esOnerosoSi").prop("checked", true);

        $("#benefOneroso").val(respuesta["cot_bnf_oneroso"]);

        document.getElementById("contenBenefOneroso").style.display = "block";

      } else {

        $("#esOnerosoNo").prop("checked", true);

      }

      //FORMULARIO DE PESADOS//

      if (respuesta["cot_placa"] == "CAT770") {

        $("#txtPlacaVehPesado").val(respuesta["cot_placa"]).val();

      } else {

        $("#txtPlacaVehPesado").val(respuesta["cot_placa"]).val();

      }

      $("#txtModeloVehPesado").val(respuesta["cot_modelo"]);

      $("#clasepesados").val(respuesta["cot_clase"]);


      $("#txtMarcaVehPesado").val(respuesta["cot_marca"]);


      $("#txtReferenciaVehPesado").val(respuesta["cot_linea"]);

      $("#txtFasecoldaPesado").val(respuesta["cot_fasecolda"]);

      $("#txtValorFasecoldaPesado").val(respuesta["cot_valor_asegurado"]);

      $("#txtTipoUsoVehiculoPesado").val(respuesta["cot_tip_uso"]);

      $("#txtTipoServicioPesado").val(respuesta["cot_tip_servicio"]);

      $("#txtTipoServicioPesado").val(respuesta["cot_tip_servicio"]);

      $("#DptoCirculacionPesado").append(

        "<option value='" +

        respuesta["cot_departamento"] +

        "' selected>" +

        departamentoVeh(respuesta["cot_departamento"]) +

        "</option>"

      );

      $("#ciudadCirculacionPesado").append(

        "<option value='" +

        respuesta["cot_ciudad"] +

        "' selected>" +

        nomCiudad +

        "</option>"

      );      

      $("#mundialseguros").val(respuesta["cot_mundial"]);

      
      
      var valorMundial = document.getElementById('mundial').value;
      console.log(valorMundial);
    
      if (valorMundial === null || valorMundial === "") {
          document.getElementById('DatosVehiculoPesados').style.display = 'none';
          document.getElementById('DatosVehiculo').style.display = 'block';
          
      } else {
          document.getElementById('DatosVehiculoPesados').style.display = 'block';
          document.getElementById('DatosVehiculo').style.display = 'none';
         
      }

      /*=============================================			
 
       // CONSULTA LAS OFERTAS DE LA COTIZACION
 
       =============================================*/

      var datos2 = new FormData();

      datos2.append("idCotizaOferta", idCotizacion);



      $.ajax({

        url: "ajax/cotizaciones.ajax.php",

        method: "POST",

        data: datos2,

        cache: false,

        contentType: false,

        processData: false,

        dataType: "json",

        success: function (respuesta) {

          // console.log(respuesta);

          if (respuesta.length > 0) {

            var cardCotizacion = "";





            respuesta.forEach(function (oferta, i) {

              var primaFormat = formatNumber(oferta.Prima);
              var id_intermediario = document.getElementById("idIntermediario").value;

              function isNumeric(value) {
                // Comprueba si es un número válido o una cadena numérica válida
                return !isNaN(parseFloat(value)) && isFinite(value);
              }

              var valorRC = isNumeric(oferta.ValorRC)

              if (valorRC) {
                var valorRCFormat = formatNumber(oferta.ValorRC);
              } else {
                var valorRCFormat = (oferta.ValorRC);
              } 

              //FUNCION QUE ACOMODA RCE EN PARRILLA CUANDO LLEGA MUNDIAL
              if (oferta.Aseguradora == 'Mundial' && oferta.Producto == 'Pesados con RCE en exceso') {
                // Eliminar los puntos y convertir a número
                RC = parseFloat(RC.replace(/\./g, ''));
            
                // Sumar 1.500.000.000
                RC += 1500000000;
            
                // Volver a formatear con puntos
                var valorRCFormat = RC.toLocaleString();
            
              }


              if (

                oferta.Aseguradora == "SBS Seguros" &&

                oferta.Producto == "RCE Daños"

              ) {

                oferta.PerdidaTotal = "Cubrimiento al 100% (Daños)";

                oferta.PerdidaParcial = "Deducible 10% - 1 SMMLV (Daños)";

              } else if (

                oferta.Aseguradora == "SBS Seguros" &&

                oferta.Producto == "RCE Hurto"

              ) {

                oferta.PerdidaTotal = "Cubrimiento al 100% (Hurto)";

                oferta.PerdidaParcial = "Deducible 10% - 1 SMMLV (Hurto)";

              }



              if (oferta.seleccionar == "Si") {

                var selecChecked = "checked";

              }

              if (oferta.recomendar == "Si") {

                var recomChecked = "checked";

              }



              cardCotizacion += `

								<div class='col-lg-12'>

									<div class='card-ofertas'>

										<div class='row card-body'>

											<div class="col-xs-12 col-sm-6 col-md-2 oferta-logo">

                      <center> 

												<img src='${oferta.logo}'>

                        </center>

												

                      <div class='col-12' style='margin-top:2%;'>
                          ${((oferta.Aseguradora === "Axa Colpatria" || oferta.Aseguradora === "Liberty" || oferta.Aseguradora === "Equidad" || oferta.Aseguradora === "Mapfre") && id_intermediario == "78") ?
                            `<center>
                              <!-- Código para el caso específico de Axa Colpatria, Liberty, Equidad o Mapfre -->
                              <!-- Agrega aquí el contenido específico para estas aseguradoras -->
                            </center>`
                            : oferta.Aseguradora !== "Mundial" && permisos.Vernumerodecotizacionencadaaseguradora == "x" ?
                            `<center>
                              <label class='entidad'>N° Cot: <span style='color:black'> ${oferta.NumCotizOferta}</span></label>
                            </center>`
                            : ''}
                        </div>



											</div>

											<div class="col-xs-12 col-sm-6 col-md-2 oferta-header">

												<h5 class='entidad'>${oferta.Aseguradora} - ${oferta.Producto}</h5>

												<h5 class='precio'>Precio $ ${primaFormat}</h5>

												<p class='title-precio'>(IVA incluido)</p>

											</div>

											<div class="col-xs-12 col-sm-6 col-md-4">

												<ul class="list-group">

													<li class="list-group-item">

														<span class="badge">* $${valorRCFormat}</span>

														Responsabilidad Civil (RCE)

													</li>

													<li class="list-group-item">

														<span class="badge">* ${oferta.PerdidaTotal}</span>

														Pérdida Total Daños y Hurto

													</li>

													<li class="list-group-item">

														<span class="badge">* ${oferta.PerdidaParcial}</span>

														Pérdida Parcial Daños y Hurto

													</li>

													<li class="list-group-item">

														<span class="badge">* ${oferta.ConductorElegido}</span>

														Conductor elegido

													</li>

													<li class="list-group-item">

														<span class="badge">* ${oferta.Grua}</span>

														Servicio de Grúa

													</li>

												</ul>

											</div>

											<div class="col-xs-12 col-sm-6 col-md-2">

											<div class="selec-oferta">

												<label for="seleccionar">SELECCIONAR</label>&nbsp;&nbsp;

												<input type="checkbox" class="classSelecOferta" name="selecOferta" id="selec${oferta.NumCotizOferta}${numId}\" onclick='seleccionarOferta(\"${oferta.Aseguradora}\", \"${oferta.Prima}\", \"${oferta.Producto}\", \"${oferta.NumCotizOferta}\", this);' ${selecChecked}/>

											</div>

											<div class="recom-oferta">

												<label for="recomendar">RECOMENDAR</label>&nbsp;&nbsp;

												<input type="checkbox" class="classRecomOferta" name="recomOferta" id="recom${oferta.NumCotizOferta}${numId}\" onclick='recomendarOferta(\"${oferta.Aseguradora}\", \"${oferta.Prima}\", \"${oferta.Producto}\", \"${oferta.NumCotizOferta}\", this);' ${recomChecked}/>

											</div>

											</div>`;

              if (oferta.Manual == "1") {

                /*
                cardCotizacion += `

							<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">

								<button type="button" class="btn btn-success editar-manual" id="${oferta.id_oferta}">

									<div>EDITAR &nbsp;&nbsp;<span class="fa fa-edit"></span></div>

								</button>

								<button type="button" class="btn btn-danger eliminar-manual" id="eliminar-${oferta.id_oferta}">

									<div>ELIMINAR &nbsp;&nbsp;<span class="fa fa-trash"></span></div>

								</button>

							</div>`;*/

              cardCotizacion += `

							<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">

								<button type="button" class="btn btn-danger eliminar-manual" id="eliminar-${oferta.id_oferta}">

									<div>ELIMINAR &nbsp;&nbsp;<span class="fa fa-trash"></span></div>

								</button>

							</div>`;

              }

              if (oferta.Manual == "1" && oferta.UrlPdf != "") {

                cardCotizacion += `

							<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">

								<a type="button" class="btn btn-info" href="${oferta.UrlPdf}">

									<div>VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>

								</a>

							</div>`;

              }

              if (

                oferta.Manual == "0" &&

                (oferta.Aseguradora == "Seguros Bolivar" ||

                  oferta.Aseguradora == "Axa Colpatria") && id_intermediario != 78

              ) {

                cardCotizacion += `

											<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">

											<button type="button" class="btn btn-info" id="btnAsegPDF${oferta.NumCotizOferta}${numId}\" onclick='verPdfOferta(\"${oferta.Aseguradora}\", \"${oferta.NumCotizOferta}\", \"${numId}\");'>

												<div id="verPdf${oferta.NumCotizOferta}${numId}\">VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>

											</button>

											</div>`;

              } else if (

                oferta.Manual == "0" &&

                oferta.Aseguradora == "Previsora Seguros" &&

                oferta.UrlPdf !== null

              ) {

                cardCotizacion += `

											<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">

											<button type="button" class="btn btn-info" id="previsora-pdf${oferta.NumCotizOferta}" onclick='verPdfPrevisora(\"${oferta.NumCotizOferta}\");'>

												<div id="verPdf${oferta.NumCotizOferta}${numId}\">VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>

											</button>

											</div>`;

              } else if (

                oferta.Manual == "0" &&

                oferta.Aseguradora == "Seguros del Estado" &&

                oferta.UrlPdf !== null

              ) {

                cardCotizacion += `

											<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">

											<button type="button" class="btn btn-info" id="btnAsegPDF${oferta.NumCotizOferta}${numId}\" onclick='verPdfEstado(\"${oferta.Aseguradora}\", \"${oferta.NumCotizOferta}\", \"${numId}\", \"${oferta.UrlPdf}\");'>

												<div id="verPdf${oferta.NumCotizOferta}${numId}\">VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>

											</button>

											</div>`;

              } else if (

                oferta.Manual == "0" &&

                oferta.Aseguradora == "Solidaria"

              ) {

                cardCotizacion += `

											<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">

    											<button id="solidaria-pdf" type="button" class="btn btn-info" onclick='verPdfSolidaria(${oferta.NumCotizOferta})'>

    												<div>VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>

    											</button>

											</div>`;

              } else if (

                oferta.Manual == "0" &&

                oferta.Aseguradora == "Zurich"

              ) {

                cardCotizacion += `

											<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">

    											<button id="Zurich-pdf${oferta.NumCotizOferta}" type="button" class="btn btn-info" onclick='verPdfZurich(${oferta.NumCotizOferta})'>

    												<div>VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>

    											</button>

											</div>`;

              }else if (

                oferta.Manual == "0" &&

                oferta.Aseguradora == "HDI Seguros"

              ) {

                cardCotizacion += `

											<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">

    											<button id="Hdi-pdf${oferta.NumCotizOferta}" type="button" class="btn btn-info" onclick='verPdfHdi("${oferta.NumCotizOferta}")'>

    												<div>VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>

    											</button>

											</div>`;

              }

              cardCotizacion += `

										</div>

									</div>

								</div>

							`;



              numId++;

            });

            $("#cardCotizacion").html(cardCotizacion);

            let updatevideos = document.querySelectorAll(".editar-manual");
            for (updatevideo of updatevideos) {

              updatevideo.addEventListener('click', function (e) {

                let idupdate = updatevideo.id;

                getManualOffer(idupdate);

              });
            }


            let videos = document.querySelectorAll(".eliminar-manual");
            for (video of videos) {

              video.addEventListener('click', function (e) {

                let id = video.id;
                id2 = id.split("-");
                console.log(id2[1]);

                deleteManualOffer(id2[1]);

              });
            }

          } else {

            $("#loaderOferta").html("");

            swal.fire({

              type: "warning",

              title: "¡ UPS, Lo Sentimos !",

              text: "¡ No hay ofertas disponibles para tu vehículo !",

              showConfirmButton: true,

              confirmButtonText: "Cerrar",

            });

          }

          document.getElementById("headerAsegurado").style.display = "block";

          document.getElementById("contenSuperiorPlaca").style.display = "none";

          document.getElementById("contenBtnConsultarPlaca").style.display =

            "none";

          document.getElementById("resumenVehiculo").style.display = "block";

          // Oculta el Boton Cotizar Ofertas al cargar la Parrilla

          document.getElementById("contenBtnCotizar").style.display = "none";

          // Muestra los Botones Recotizar y Agregar Cotizacion

          document.getElementById("contenRecotizarYAgregar").style.display =

            "block";

          // Muestra el Contenido de la Parrilla de Ofertas, Cotizaciones Manuales y PDF

          document.getElementById("contenParrilla").style.display = "block";

          menosAseg();
          menosRE();

        },

      });

    },

  });

}

/*===============================================

FUNCION PARA SELECCIONAR OFERTA DE LA ASEGURADORA

===============================================*/

function seleccionarOferta(

  aseguradora,

  prima,

  producto,

  numCotizOferta,

  valCheck

) {

  var idSelecOferta = idCotizacion;

  var placa = document.getElementById("placaVeh").value;



  // Capturamos el Id del Checkbox seleccionado

  var idCheckbox = $(valCheck).attr("id");

  var seleccionar = "";



  if (document.getElementById(idCheckbox).checked) {

    seleccionar = "Si";

  }



  $.ajax({

    type: "POST",

    url: "src/seleccionarOferta.php",

    dataType: "json",

    data: {

      placa: placa,

      idCotizacion: idSelecOferta,

      aseguradora: aseguradora,

      numCotizOferta: numCotizOferta,

      producto: producto,

      valorPrima: prima,

      seleccionar: seleccionar,

    },

    success: function (data) {

      console.log(data);

    },

  });

}



/*===============================================

FUNCION PARA RECOMENDAR OFERTA DE LA ASEGURADORA

===============================================*/

function recomendarOferta(

  aseguradora,

  prima,

  producto,

  numCotizOferta,

  valCheck

) {

  var idRecomOferta = idCotizacion;

  var placa = document.getElementById("placaVeh").value;



  // Capturamos el Id del Checkbox seleccionado

  var idCheckbox = $(valCheck).attr("id");

  var recomendar = "";



  if (document.getElementById(idCheckbox).checked) {

    recomendar = "Si";

  }



  // Valida que no se Recomiende mas de 3 Ofertas.

  if ($(".classRecomOferta:checked").length > 3) {

    $("#" + idCheckbox).prop("checked", false); // Permite deselecionar el Checkbox

    swal({

      text: "! No se permite recomendar mas de 3 Ofertas por Parrilla. ¡",

    });

  } else {

    $.ajax({

      type: "POST",

      url: "src/recomendarOferta.php",

      dataType: "json",

      data: {

        placa: placa,

        idCotizacion: idRecomOferta,

        aseguradora: aseguradora,

        numCotizOferta: numCotizOferta,

        producto: producto,

        valorPrima: prima,

        recomendar: recomendar,

      },

      success: function (data) {

        console.log(data);

      },

    });

  }

}



/*==================================================

FUNCION PARA CARGAR EL PDF OFICIAL DE LA ASEGURADORA

==================================================*/

function verPdfOferta(aseguradora, numCotizOferta, numId) {

  console.log(aseguradora)
  console.log(numCotizOferta)
  console.log(numId)




  if (permisos.Verpdfindividuales != "x") {



    Swal.fire({

      icon: 'error',

      title: '¡Esta versión no tiene ésta funcionalidad disponible!',

      showCancelButton: true,

      confirmButtonText: 'Cerrar',

      cancelButtonText: 'Conoce más'

    }).then((result) => {



      if (result.isConfirmed) {

      } else if (result.isDismissed

      ) {



        window.open('https://www.integradoor.com', "_blank")



      }

    })

  } else {



    $("#verPdf" + numCotizOferta + numId).html(

      "VER PDF &nbsp;&nbsp;<img src='vistas/img/plantilla/loading.gif' width='18' height='18'>"

    );



    var ventanaPDF = window.open(

      "",

      aseguradora,

      "width=" + 1024 + ", height=" + 768

    );

    // var ventanaPDF = window.open('http://example.com/waiting.html', '_blank'); // Carga otra pagina

    // ventanaPDF.document.write("Cargando vista previa Pdf " + aseguradora + "..."); // Carga un mensaje de espera



    var myHeaders = new Headers(); // Cabecera del Metodo

    myHeaders.append("Content-Type", "application/json");



    var raw = JSON.stringify({

      aseguradora: aseguradora,

      numero_cotizacion: numCotizOferta,

    });

    var requestOptions = {

      mode: "cors",

      method: "POST",

      headers: myHeaders,

      body: raw,

      redirect: "follow",

    };



    // Llama la URL del PDF oficial de la oferta generada por la aseguradora

    fetch(

      "https://www.grupoasistencia.com/motor_webservice_tst/ImpresionPdf",

      requestOptions

    )

      .then(function (response) {

        console.log(response)

        if (!response.ok) {

          throw Error(response.statusText);

        }

        return response.json();

      })

      .then(function (data) {

        ventanaPDF.location.href = data;

        $("#verPdf" + numCotizOferta + numId).html(

          'VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span>'

        );

      })

      .catch(function (error) {

        console.log("Parece que hubo un problema: \n", error);

      });

  }

}



/*======================================================

FUNCION PARA CARGAR EL PDF OFICIAL DE SEGUROS DEL ESTADO

======================================================*/

function verPdfEstado(aseguradora, numCotizOferta, numId, UrlPdf) {



  if (permisos.Verpdfindividuales != "x") {



    Swal.fire({

      icon: 'error',

      title: '¡Esta versión no tiene ésta funcionalidad disponible!',

      showCancelButton: true,

      confirmButtonText: 'Cerrar',

      cancelButtonText: 'Conoce más'

    }).then((result) => {



      if (result.isConfirmed) {

      } else if (result.isDismissed

      ) {



        window.open('https://www.integradoor.com', "_blank")



      }

    })

  } else {



    $("#verPdf" + numCotizOferta + numId).html(

      "VER PDF &nbsp;&nbsp;<img src='vistas/img/plantilla/loading.gif' width='18' height='18'>"

    );



    var ventanaPDF = window.open(

      "",

      aseguradora,

      "width=" + 1024 + ", height=" + 768

    );

    ventanaPDF.document.write("Cargando vista previa Pdf " + aseguradora + "..."); // Carga un mensaje de espera

    ventanaPDF.location.href = UrlPdf;



    setTimeout(function () {

      $("#verPdf" + numCotizOferta + numId).html(

        'VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span>'

      );

    }, 6000);

  }

}



/*======================================================

FUNCION PARA CARGAR EL PDF OFICIAL PREVISORA

======================================================*/

const verPdfPrevisora = async (cotizacion) => {


  if (permisos.Verpdfindividuales != "x") {



    Swal.fire({

      icon: 'error',

      title: '¡Esta versión no tiene ésta funcionalidad disponible!',

      showCancelButton: true,

      confirmButtonText: 'Cerrar',

      cancelButtonText: 'Conoce más'

    }).then((result) => {



      if (result.isConfirmed) {

      } else if (result.isDismissed

      ) {



        window.open('https://www.integradoor.com', "_blank")



      }

    })

  } else {



    $("#previsora-pdf" + cotizacion).html(

      "VER PDF &nbsp;&nbsp;<img id='loading-gif' src='vistas/img/plantilla/loading.gif' width='18' height='18'>"

    );



    let base64 = await obtenerPdfprevisora(cotizacion);

    const linkSource = `data:application/pdf;base64,${base64}`;

    const downloadLink = document.createElement("a");

    const fileName = cotizacion + ".pdf";

    downloadLink.href = linkSource;

    downloadLink.download = fileName;

    downloadLink.addEventListener("click", () => {
      // Eliminar la animación del GIF al hacer clic en el enlace de descarga
      $("#loading-gif").remove();
    });

    downloadLink.click();

    $("#previsora-pdf" + cotizacion).html(

      'VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span>'

    );

  }

};





const obtenerPdfprevisora = async (cotizacion) => {




  const formData = new FormData();

  formData.append("cotizacion", cotizacion);



  const pdfText = await fetch(

    "https://www.grupoasistencia.com/motor_webservice_tst2/WSPrevisora/get_pdf_previsora_tst.php",

    {

      method: "POST",

      body: formData,

    }

  )
    // .then((response) => response.text()) // Obtén la respuesta como texto
    // .then((responseText) => {
    //   console.log(responseText); // Imprime la respuesta para depuración

    //   // Ahora intenta analizarla como JSON
    //   try {
    //     const jsonResponse = JSON.parse(responseText);
    //     return jsonResponse.SerializedPDF;
    //   } catch (error) {
    //     console.error("Error al analizar JSON:", error);
    //     return null; // Otra acción si el análisis falla
    //   }
    // });

    // .then((response) => response.json())

    // .then((responseText) => {
    //   return responseText.SerializedPDF;

    // });

    .then((response) => {
      // Imprime la respuesta en la consola para depuración
      console.log("Respuesta del servidor:", response);

      if (response.ok) {
        return response.json();
      } else {
        throw new Error("Error en la respuesta del servidor");
      }
    })
    .then((responseText) => {
      // Imprime el contenido de la respuesta (JSON) en la consola
      console.log("Contenido de la respuesta (JSON):", responseText);
      return responseText.SerializedPDF;
    })
    .catch((error) => {
      console.error("Error al obtener PDF:", error);
      return null; // Manejar el error de alguna manera
    });

  return pdfText;
};







/*======================================================

FUNCION PARA CARGAR EL PDF OFICIAL DE SOLIDARIA

======================================================*/

const verPdfSolidaria = async (cotizacion) => {



  if (permisos.Verpdfindividuales != "x") {



    Swal.fire({

      icon: 'error',

      title: '¡Esta versión no tiene ésta funcionalidad disponible!',

      showCancelButton: true,

      confirmButtonText: 'Cerrar',

      cancelButtonText: 'Conoce más'

    }).then((result) => {



      if (result.isConfirmed) {

      } else if (result.isDismissed

      ) {



        window.open('https://www.integradoor.com', "_blank")



      }

    })

  } else {



    let base64 = await obtenerPdfSolidaria(cotizacion);

    base64 = base64.slice(1, -1);



    const linkSource = `data:application/pdf;base64,${base64}`;

    const downloadLink = document.createElement("a");

    const fileName = cotizacion + ".pdf";



    downloadLink.href = linkSource;

    downloadLink.download = fileName;

    downloadLink.click();

  }

};



const obtenerPdfSolidaria = async (cotizacion) => {





  const formData = new FormData();

  formData.append("cotizacion", cotizacion);



  const pdfText = await fetch(

    "https://www.grupoasistencia.com/webservice_autosv1/WSSolidaria/get_pdf.php",

    {

      method: "POST",

      body: formData,

    }

  )

    .then((response) => response.text())

    .then((responseText) => {

      return responseText;

    });



  return pdfText;

};



/*======================================================

FUNCION PARA CARGAR EL PDF OFICIAL DE ZURICH

======================================================*/

const verPdfZurich = async (cotizacion) => {



  if (permisos.Verpdfindividuales != "x") {



    Swal.fire({

      icon: 'error',

      title: '¡Esta versión no tiene ésta funcionalidad disponible!',

      showCancelButton: true,

      confirmButtonText: 'Cerrar',

      cancelButtonText: 'Conoce más'

    }).then((result) => {

      if (result.isConfirmed) {

      } else if (result.isDismissed

      ) {



        window.open('https://www.integradoor.com', "_blank")



      }

    })

  } else {



    $("#Zurich-pdf" + cotizacion).html(

      "VER PDF &nbsp;&nbsp;<img src='vistas/img/plantilla/loading.gif' width='18' height='18'>"

    );

    const formData = new FormData();

    formData.append("cotizacion", cotizacion);

    const blobPdfZurich = await fetch("https://www.grupoasistencia.com/motor_webservice/WSZurich/get_pdf.php",

      {

        method: "POST",

        body: formData,

      })

      .then(response => response.blob())

      .then(resBlob => {

        const res = new Blob([resBlob], {

          type: "application/pdf",

        })



        return res

      })



    const downloadUrl = URL.createObjectURL(blobPdfZurich)

    const a = document.createElement('a')

    a.href = downloadUrl

    a.download = 'Zurich_' + cotizacion + '.pdf'

    document.body.appendChild(a)

    a.click()



    $("#Zurich-pdf" + cotizacion).html(

      'VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span>'

    );

  }

};

/*======================================================

FUNCION PARA CARGAR EL PDF OFICIAL DE HDI

======================================================*/

const verPdfHdi = async (cotizacion) => {
  $("#Hdi-pdf" + cotizacion).html(
    "VER PDF &nbsp;&nbsp;<img src='vistas/img/plantilla/loading.gif' width='18' height='18'>"
  );

  const formData = new FormData();
  formData.append("cotizacion", cotizacion);

  try {
    const blobPdfHdi = await fetch("https://www.grupoasistencia.com/motor_webservice/WSHDIPLUS/get_pdf_hdi.php", {
      method: "POST",
      body: formData,
    })
      .then(response => response.blob());

    const downloadUrl = URL.createObjectURL(blobPdfHdi);
    const a = document.createElement('a');
    a.href = downloadUrl;
    a.download = 'HDI' + cotizacion + '.pdf';
    document.body.appendChild(a);
    a.click();

    $("#Hdi-pdf" + cotizacion).html(
      'VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span>'
    );
  } catch (error) {
    console.error('Error durante la descarga del PDF:', error);
  }
};


// const obtenerPdfZurich = async (cotizacion) => {



//   const formData = new FormData();

//   formData.append("cotizacion", cotizacion);



//   const pdfText = await fetch(

//     "https://www.grupoasistencia.com/motor_webservice/WSZurich/get_pdf.php",

//     {

//       method: "POST",

//       body: formData,

//     }

//   )

//     .then((response) => response.text())

//     .then((responseText) => {

//       return responseText;

//     });





//   return pdfText;

// };



/*==================================================

FUNCION PARA CARGAR EL PRODUCTO DE LA ASEGURADORA

==================================================*/

function selecProductoManual() {

  vaciarCamposOfertaManual();

  var aseguradora = $("#aseguradora").val();



  $.ajax({

    type: "POST",

    url: "src/seleccionarProducto.php",

    dataType: "json",

    data: {

      aseguradora: aseguradora,

    },

    cache: false,

    success: function (data) {

      // console.log(data);

      var producto = "<option value=''>Seleccione Producto</option>";



      $.each(data, function (key, item) {

        producto +=

          "<option value='" +

          item.producto +

          "'>" +

          item.producto +

          "</option>";

      });



      $("#producto").html(producto);

    },

  });

}



/*==================================================

FUNCION PARA CARGAR LAS COBERTURAS

==================================================*/

function selecRCManual() {

  var aseguradora = $("#aseguradora").val();

  var producto = $("#producto").val();



  $.ajax({

    type: "POST",

    url: "src/seleccionarRC.php",

    dataType: "json",

    data: {

      aseguradora: aseguradora,

      producto: producto,

    },

    cache: false,

    success: function (data) {

      // console.log(data);

      if (data.length > 1) {

        var valorRC = "<option value=''>Seleccione RC</option>";



        $.each(data, function (key, item) {

          valorRC +=

            "<option value='" + item.rce + "'>" + item.rce + "</option>";

        });

        $("#valorRC").html(valorRC);

      } else {

        $("#valorRC").html(

          "<option value='" +

          data[0].rce +

          "' selected>" +

          data[0].rce +

          "</option>"

        );

        selecCoberturasManual();

      }

    },

  });

}



/*==================================================

FUNCION PARA CARGAR LAS COBERTURAS

==================================================*/

function selecCoberturasManual() {

  var aseguradora = $("#aseguradora").val();

  var producto = $("#producto").val();

  var valorRC = $("#valorRC").val();

  var modeloVeh = $("#txtModeloVeh").val();

  var valorFasecolda = $("#txtValorFasecolda").val();



  var diaNac = $("#dianacimiento").val();

  var mesNac = $("#mesnacimiento").val();

  var anioNac = $("#anionacimiento").val();

  var fechaNacimiento = diaNac + "/" + mesNac + "/" + anioNac;



  $.ajax({

    type: "POST",

    url: "src/seleccionarCoberturas.php",

    dataType: "json",

    data: {

      aseguradora: aseguradora,

      producto: producto,

      valorRC: valorRC,

    },

    cache: false,

    success: function (data) {

      // console.log(data);

      var edadVeh = new Date().getFullYear() - modeloVeh;

      var edadAseg = calcularEdad(fechaNacimiento);



      var perdTotales = data.pth;

      var perdParcialDanio = data.ppd;



      if (

        (aseguradora == "Seguros Bolivar" && producto == "Estandar") ||

        producto == "Clasico"

      ) {

        if (edadVeh <= 5) {

          perdTotales = "Cubrimiento al 100%";

        } else {

          perdTotales = "Cubrimiento al 90%";

        }

      }



      if (

        (aseguradora == "Axa Colpatria" && producto == "Plus") ||

        producto == "VIP" ||

        producto == "Tradicional"

      ) {

        if (edadVeh <= 11 && edadAseg > 33) {

          perdParcialDanio = "Deducible unico: $700.000";

        } else {

          perdParcialDanio = "Deducible 10% - 1 SMMLV";

        }

      }



      if (aseguradora == "Allianz Seguros" && producto == "Motocicletas") {

        if (valorFasecolda <= 6000000) {

          perdTotales =

            "Cubrimiento al " +

            calcularPerdTotalAllianz(valorFasecolda, 800000) +

            "%";

          perdParcialDanio = "Deducible unico: $800.000";

        } else if (valorFasecolda > 6000000 && valorFasecolda <= 10000000) {

          perdTotales =

            "Cubrimiento al " +

            calcularPerdTotalAllianz(valorFasecolda, 1350000) +

            "%";

          perdParcialDanio = "Deducible unico: $1.350.000";

        } else if (valorFasecolda > 10000000 && valorFasecolda <= 20000000) {

          perdTotales =

            "Cubrimiento al " +

            calcularPerdTotalAllianz(valorFasecolda, 2000000) +

            "%";

          perdParcialDanio = "Deducible unico: $2.000.000";

        } else if (valorFasecolda > 20000000 && valorFasecolda <= 30000000) {

          perdTotales =

            "Cubrimiento al " +

            calcularPerdTotalAllianz(valorFasecolda, 3000000) +

            "%";

          perdParcialDanio = "Deducible unico: $3.000.000";

        } else if (valorFasecolda > 30000000) {

          perdTotales =

            "Cubrimiento al " +

            calcularPerdTotalAllianz(valorFasecolda, 4000000) +

            "%";

          perdParcialDanio = "Deducible unico: $4.000.000";

        }

      }



      $("#valorPerdidaTotal").val(perdTotales);

      $("#valorPerdidaParcial").val(perdParcialDanio);

      $("#conductorElegido").val(data.CE);

      $("#servicioGrua").val(data.Grua);

    },

  });

}



/*==================================================

FUNCION PARA CALCULAR LA EDAD DESDE LA FECHA DE NAC.

==================================================*/

function calcularEdad(fecha) {

  var fechaNac = new Date(fecha);

  var fechaActual = new Date();



  var mes = fechaActual.getMonth();

  var dia = fechaActual.getDate();

  var año = fechaActual.getFullYear();



  fechaActual.setDate(dia);

  fechaActual.setMonth(mes);

  fechaActual.setFullYear(año);



  edad = Math.floor((fechaActual - fechaNac) / (1000 * 60 * 60 * 24) / 365);



  return edad;

}



/*==================================================

FUNCION PARA CALCULAR LAS PERDIDAS TOTALES "ALLIANZ"

==================================================*/

function calcularPerdTotalAllianz(valorFasecolda, deducible) {

  var cubrimiento = valorFasecolda - deducible;

  var porcentCubrimiento = Math.round((cubrimiento / valorFasecolda) * 100);

  return porcentCubrimiento;

}



/*=============================================

FUNCION PARA AGREGAR COTIZACIONES MANUALES

=============================================*/

function agregarCotizacionManual2() {

  var aseguradora = document.getElementById("aseguradora").value;

  var producto = document.getElementById("producto").value;

  var numCotizOferta = document.getElementById("numCotizacion").value;

  var prima = document.getElementById("valorTotal").value;

  var valorRC = document.getElementById("valorRC").value;

  var PT = document.getElementById("valorPerdidaTotal").value;

  var PT2 = document.getElementById("valorPerdidaTotal").value;

  var PP = document.getElementById("valorPerdidaParcial").value;

  var PP2 = document.getElementById("valorPerdidaParcial").value;

  var CE = document.getElementById("conductorElegido").value;

  var GR = document.getElementById("servicioGrua").value;

  var placa = document.getElementById("txtPlacaVeh").value;

  var id_oferta = document.getElementById("idofertaguardarmanual").value;

  var numDocumentoID = document.getElementById("numDocumentoID").value;



  if (aseguradora == "SBS Seguros" && producto == "RCE Daños") {

    PT = "Cubrimiento al 100% (Daños)";

    PP = "Deducible 10% - 1 SMMLV (Daños)";

  } else if (aseguradora == "SBS Seguros" && producto == "RCE Hurto") {

    PT = "Cubrimiento al 100% (Hurto)";

    PP = "Deducible 10% - 1 SMMLV (Hurto)";

  }




  rutaPdf = "";

  if (aseguradora != "" && producto != "" && numCotizOferta != "" && prima != "" && valorRC != "" && PT != "" && PP != "" && CE != "" && GR != "") {

    $.ajax({
      type: "POST",
      url: "src/agregarcotizacionmanual.php",
      dataType: "json",
      data: {
        aseguradora: aseguradora,
        producto: producto,
        numCotizOferta: numCotizOferta,
        prima: prima,
        placa: placa,
        id_oferta: id_oferta,
        valorRC: valorRC,
        PT: PT,
        PP: PP,
        CE: CE,
        GR: GR,
        manual: 1,
        numIdentificacion: numDocumentoID
      },
      cache: false,
      success: function (data) {
        console.log(data);
        if (data.Success == true) {
          swal.fire({
            type: "success",
            title: "! Cotización registrada Exitosamente ¡",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
          });
          location.reload();
        } else {
          swal.fire({
            type: "error",
            title: "! Cotización no registrada¡",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
          });
        }

      },
    });





  }

}



const guardarPdfCotizacioManual = (rutaPdf, archivo) => {

  return new Promise((resolve, reject) => {

    const formData = new FormData();

    formData.append("archivo", archivo);

    formData.append("urlPdf", rutaPdf);

    $.ajax({

      type: "POST",

      url: "src/guardarPdfCotizacion.php",

      data: formData,

      contentType: false,

      processData: false,

      success: (data) => {

        resolve(data);

      },

      error: (err) => {

        reject(err);

      },

    });

  });

};





/*==================================================

FUNCION PARA IDENTIFICAR EL NOMBRE DEL LOGO MANUALMETE

==================================================*/

function logoOfertaManual(aseguradora) {

  var logo = "";



  if (aseguradora == "Seguros del Estado") {

    logo = "estado.png";

  } else if (aseguradora == "Seguros Bolivar") {

    logo = "bolivar.png";

  } else if (aseguradora == "Axa Colpatria") {

    logo = "axa.png";

  } else if (aseguradora == "HDI Seguros") {

    logo = "hdi.png";

  } else if (aseguradora == "SBS Seguros") {

    logo = "sbs.png";

  } else if (aseguradora == "Allianz Seguros") {

    logo = "allianz.png";

  } else if (aseguradora == "Equidad Seguros") {

    logo = "equidad.png";

  } else if (aseguradora == "Seguros Mapfre") {

    logo = "mapfre.png";

  } else if (aseguradora == "Liberty Seguros") {

    logo = "liberty.png";

  } else if (aseguradora == "Aseguradora Solidaria") {

    logo = "solidaria.png";

  } else if (aseguradora == "Seguros Sura") {

    logo = "sura.png";

  } else if (aseguradora == "Zurich Seguros") {

    logo = "zurich.png";

  } else if (aseguradora == "Previsora Seguros") {

    logo = "previsora.png";

  } else if (aseguradora == "Previsora") {

    logo = "previsora.png";

  }



  return logo;

}



/*==========================================================

FUNCION PARA CONSULTAR EL NOMBRE DEL DEPARTAMENTO POR CODIGO

==========================================================*/

function departamentoVeh(codigoDpto) {

  var nomDpto = "";



  if (codigoDpto == 1) {

    nomDpto = "Amazonas";

  } else if (codigoDpto == 2) {

    nomDpto = "Antioquia";

  } else if (codigoDpto == 3) {

    nomDpto = "Arauca";

  } else if (codigoDpto == 4) {

    nomDpto = "Atlántico";

  } else if (codigoDpto == 5) {

    nomDpto = "Barranquilla";

  } else if (codigoDpto == 6) {

    nomDpto = "Bogotá";

  } else if (codigoDpto == 7) {

    nomDpto = "Bolívar";

  } else if (codigoDpto == 8) {

    nomDpto = "Boyacá";

  } else if (codigoDpto == 9) {

    nomDpto = "Caldas";

  } else if (codigoDpto == 10) {

    nomDpto = "Caquetá";

  } else if (codigoDpto == 11) {

    nomDpto = "Casanare";

  } else if (codigoDpto == 12) {

    nomDpto = "Cauca";

  } else if (codigoDpto == 13) {

    nomDpto = "Cesar";

  } else if (codigoDpto == 14) {

    nomDpto = "Chocó";

  } else if (codigoDpto == 15) {

    nomDpto = "Córdoba";

  } else if (codigoDpto == 16) {

    nomDpto = "Cundinamarca";

  } else if (codigoDpto == 17) {

    nomDpto = "Guainía";

  } else if (codigoDpto == 18) {

    nomDpto = "La Guajira";

  } else if (codigoDpto == 19) {

    nomDpto = "Guaviare";

  } else if (codigoDpto == 20) {

    nomDpto = "Huila";

  } else if (codigoDpto == 21) {

    nomDpto = "Magdalena";

  } else if (codigoDpto == 22) {

    nomDpto = "Meta";

  } else if (codigoDpto == 23) {

    nomDpto = "Nariño";

  } else if (codigoDpto == 24) {

    nomDpto = "Norte de Santander";

  } else if (codigoDpto == 25) {

    nomDpto = "Putumayo";

  } else if (codigoDpto == 26) {

    nomDpto = "Quindío";

  } else if (codigoDpto == 27) {

    nomDpto = "Risaralda";

  } else if (codigoDpto == 28) {

    nomDpto = "San Andrés";

  } else if (codigoDpto == 29) {

    nomDpto = "Santander";

  } else if (codigoDpto == 30) {

    nomDpto = "Sucre";

  } else if (codigoDpto == 31) {

    nomDpto = "Tolima";

  } else if (codigoDpto == 32) {

    nomDpto = "Valle del Cauca";

  } else if (codigoDpto == 33) {

    nomDpto = "Vaupés";

  } else if (codigoDpto == 34) {

    nomDpto = "Vichada";

  } else {

    nomDpto = "No Disponible";

  }

  return nomDpto;

}



/*==================================================

FUNCION PARA LIMPIAR LOS CAMPOS AGREGADOS MANUALMENTE

==================================================*/

function vaciarCamposOfertaManual() {

  $("#producto").html("");

  $("#numCotizacion").val("");

  $("#valorTotal").val("");

  $("#valorRC").html("");

  $("#valorPerdidaTotal").val("");

  $("#valorPerdidaParcial").val("");

  $("#conductorElegido").val("");

  $("#servicioGrua").val("");

}



/* EDITAR COTIZACION */

const getManualOffer = (id) => {

  $.ajax({

    type: "POST",

    url: "src/obtenerOferta.php",

    dataType: "json",

    data: { id: id },

    success: function (data) {

      const D = document;



      const aseguradoras = D.querySelectorAll(".clsAseguradora");

      aseguradoras.forEach((e) => {

        if (e.value == data.Aseguradora) {

          e.selected = true;

        }

      });



      const producto = `<option value='${data.Producto}' selected>${data.Producto}</option>`;

      D.querySelector("#producto").innerHTML = producto;



      const rce = `<option value='${data.ValorRC}' selected>${data.ValorRC}</option>`;

      D.querySelector("#valorRC").innerHTML = rce;



      D.querySelector("#numCotizacion").value = data.NumCotizOferta;



      D.querySelector("#valorTotal").value = data.Prima;



      D.querySelector("#valorPerdidaTotal").value = data.PerdidaTotal;



      D.querySelector("#valorPerdidaParcial").value = data.PerdidaParcial;



      D.querySelector("#conductorElegido").value = data.ConductorElegido;



      D.querySelector("#servicioGrua").value = data.Grua;



      D.querySelector(".btnAgregar").innerHTML = '<button class="btn btn-success btn-block" id="btnEditarCotizacion">Editar Cotización</button>';



      $("#btnAgregarCotizacion").click(function () {

        agregarCotizacion();

      });



      D.querySelector("#btnEditarCotizacion").addEventListener("click", (e) => {

        editarCotizacionManual(data.id_oferta);

      });



      document.getElementById("formularioCotizacionManual").style.display =

        "block";

      menosVeh();

      masAgr();

      window.scrollTo(0, 0);

    },

  });

};



const editarCotizacionManual = (id) => {

  var placa = document.getElementById("txtPlacaVeh").value;

  var numIdentificacion = document.getElementById("numDocumentoID").value;



  var aseguradora = document.getElementById("aseguradora").value;

  var producto = document.getElementById("producto").value;

  var numCotizOferta = document.getElementById("numCotizacion").value;

  var prima = document.getElementById("valorTotal").value;



  var valorRC = document.getElementById("valorRC").value;

  var PT = document.getElementById("valorPerdidaTotal").value;

  var PT2 = document.getElementById("valorPerdidaTotal").value;

  var PP = document.getElementById("valorPerdidaParcial").value;

  var PP2 = document.getElementById("valorPerdidaParcial").value;

  var CE = document.getElementById("conductorElegido").value;

  var GR = document.getElementById("servicioGrua").value;



  if (

    aseguradora != "" &&

    producto != "" &&

    numCotizOferta != "" &&

    prima != "" &&

    valorRC != "" &&

    PT != "" &&

    PP != "" &&

    CE != "" &&

    GR != ""

  ) {

    var logo = logoOfertaManual(aseguradora);

    var primaFormat = formatNumber(prima);

    var valorRCFormat = valorRC;



    $.ajax({

      type: "POST",

      url: "src/editarOferta.php",

      dataType: "json",

      data: {

        placa: placa,

        numIdentificacion: numIdentificacion,

        aseguradora: aseguradora,

        valorPrima: primaFormat,

        producto: producto,

        valorRC: valorRCFormat,

        PT: PT,

        PP: PP,

        CE: CE,

        GR: GR,

        logo: logo,

        UrlPdf: "",

        id: id,

      },

      success: function (data) {

        document.location.reload(true);

      },

    });

  }

};



const deleteManualOffer = (id) => {

  console.log(id);

  swal.fire({

    title: "¿Está seguro de borrar la cotización?",

    text: "¡Si no lo está puede cancelar la acción!",

    type: "warning",

    showCancelButton: true,

    confirmButtonColor: "#3085d6",

    cancelButtonColor: "#d33",

    cancelButtonText: "Cancelar",

    confirmButtonText: "Si, borrar cotización!",

  }).then(function (result) {

    if (result.value) {

      $.ajax({

        type: "POST",

        url: "src/eliminarOferta.php",

        dataType: "json",

        data: { id: id },

        success: function (data) {

          document.location.reload(true);

        },

      });

    }

  });

};



$("#btnCancelar").click((e) => {

  document.getElementById("formularioCotizacionManual").style.display = "none";

  document.querySelector(".btnAgregar").innerHTML = '<button class="btn btn-info btn-block" id="btnAgregarCotizacion">Agregar Cotización</button>';

  $("#btnAgregarCotizacion").click(function () {

    agregarCotizacion();

  });

  menosAgr();

  vaciarCamposOfertaManual();

  const aseguradoras = document.querySelectorAll(".clsAseguradora");

  aseguradoras.forEach((e) => {

    if (e.value == "") {

      e.selected = true;

    }

  });

});





// FUNCION PARA OBTENER EL NOMBRE DEL MES

function obtenerNombreMes(numero) {

  var fecha = new Date();

  if (0 < numero && numero <= 12) {

    fecha.setMonth(numero - 1);

    return new Intl.DateTimeFormat("es-ES", { month: "long" }).format(fecha);

  }

}





function formatNumber(n) {

  n = String(n).replace(/\D/g, "");

  return n === "" ? n : Number(n).toLocaleString();

}





// Maximiza el formulario Datos Asegurado

function masAseg() {

  document.getElementById("DatosAsegurado").style.display = "block";

  document.getElementById("menosAsegurado").style.display = "block";

  document.getElementById("masAsegurado").style.display = "none";

}

// Minimiza el formulario Datos Asegurado

function menosAseg() {

  document.getElementById("DatosAsegurado").style.display = "none";

  document.getElementById("menosAsegurado").style.display = "none";

  document.getElementById("masAsegurado").style.display = "block";

}



// Maximizar el formulario Datos Vehiculo

function masVeh() {

  document.getElementById("DatosVehiculo").style.display = "block";

  document.getElementById("menosVehiculo").style.display = "block";

  document.getElementById("masVehiculo").style.display = "none";

}

// Minimiza el formulario Datos Vehiculo

function menosVeh() {

  document.getElementById("DatosVehiculo").style.display = "none";

  document.getElementById("menosVehiculo").style.display = "none";

  document.getElementById("masVehiculo").style.display = "block";

}



// Maximiza el Formulario Agregar Oferta

function masAgr() {

  document.getElementById("DatosAgregarOferta").style.display = "block";

  document.getElementById("menosAgrOferta").style.display = "block";

  document.getElementById("masAgrOferta").style.display = "none";

}

// Minimiza el Formulario Agregar Oferta

function menosAgr() {

  document.getElementById("DatosAgregarOferta").style.display = "none";

  document.getElementById("menosAgrOferta").style.display = "none";

  document.getElementById("masAgrOferta").style.display = "block";

}

// Maximiza el Formulario Agregar Oferta

function masRE() {

  document.getElementById("resumenCotizaciones").style.display = "block";

  document.getElementById("menosResOferta").style.display = "block";

  document.getElementById("masResOferta").style.display = "none";

}

// Minimiza el Formulario Agregar Oferta

function menosRE() {

  document.getElementById("resumenCotizaciones").style.display = "none";

  document.getElementById("menosResOferta").style.display = "none";

  document.getElementById("masResOferta").style.display = "block";

}



