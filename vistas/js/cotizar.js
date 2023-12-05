$(document).ready(function () {

  //   validarNumCotizaciones();

  //inicio
  // Mostrar alertas

  // Valida que el dato ingresado sea numerico
  $("#numDocumentoID").numeric();
  $("#txtFasecolda").numeric();
  $("#txtValorFasecolda").numeric();
  $("#numCotizacion").numeric();
  $("#valorTotal").numeric();

  tokenPrevisora();

  //FUNCION PARA LEVANTAR EL TOKEN DE PREVISORA APENAS INICIE LA PAGINA
  function tokenPrevisora() {
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var raw = JSON.stringify({});

    var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw,
      redirect: 'follow'
    };

    fetch("https://grupoasistencia.com/motor_webservice/codigoTokenPrevisora", requestOptions)
      .then(function (response) {
        return response.json();
      }).then(function (myJson) {

        $("#previsoraToken").val(myJson.TokenPrevisora);
      });

  }
  
    // Elimina los espacios de la placa
  $("#placaVeh").keyup(function () {
    var numeroInput = document.getElementById("placaVeh").value;
    var placaSinEspacios = numeroInput.replace(/\s/g, '');
    document.getElementById("placaVeh").value = placaSinEspacios;
  });

  // Convierte la Placa ingresada en Mayusculas
  $("#placaVeh").keyup(function () {
    var numPlaca = document.getElementById("placaVeh").value;
    mayuscPlaca = numPlaca.toUpperCase();
    $("#placaVeh").val(mayuscPlaca);
  });

  // Evita Espacios en blanco en el numero de Placa
  $("#placaVeh").on("keypress", function (e) {
    if (e.which == 32) return false;
  });
  
   // Obtener el campo de entrada por su ID
  var placaInput = document.getElementById("placaVeh");

  // Agregar un evento de escucha para el evento "input"
  placaInput.addEventListener("input", function () {
      // Obtener el valor actual del campo de entrada
      var valor = placaInput.value;

      // Filtrar caracteres especiales y dejar solo letras y números
      var valorFiltrado = valor.replace(/[^a-zA-Z0-9]/g, "");

      // Actualizar el valor del campo de entrada con el valor filtrado
      placaInput.value = valorFiltrado;
  });
  
  
  // Obtener los campos de entrada por su ID
  var nombreInput = document.getElementById("txtNombres");
  var apellidoInput = document.getElementById("txtApellidos");
  var ceroKilometros = document.getElementById("txtEsCeroKmSi");

  // Función para filtrar caracteres especiales
  function filtrarCaracteresEspeciales(input) {
      var valor = input.value;
      var valorFiltrado = valor.replace(/[^a-zA-ZñÑ ]/g, ""); // Permitir letras, espacios y la letra "ñ" en mayúsculas o minúsculas
      input.value = valorFiltrado;
  }

 // MANEJO DE NOMBRES Y APELLIDOS 

  // Agregar eventos de escucha para el evento "input" en ambos campos
  nombreInput.addEventListener("input", function () {
      filtrarCaracteresEspeciales(nombreInput);
  });

  apellidoInput.addEventListener("input", function () {
      filtrarCaracteresEspeciales(apellidoInput);
  });

  // Agregar un evento 'blur' para eliminar espacios en blanco al final y al principio
  nombreInput.addEventListener("blur", function () {
    this.value = this.value.trim(); // Elimina espacios en blanco al principio y al final

    // Divide la cadena en palabras
    var words = this.value.split(" ");

    // Capitaliza la primera letra de cada palabra y convierte el resto en minúsculas
    for (var i = 0; i < words.length; i++) {
      words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
    }

    // Vuelve a unir las palabras en una sola cadena
    var formattedValue = words.join(" ");

    // Asigna el valor formateado al campo de entrada
    this.value = formattedValue;
  });

  apellidoInput.addEventListener("blur", function () {
    this.value = this.value.trim(); // Elimina espacios en blanco al principio y al final

    // Divide la cadena en palabras
    var words = this.value.split(" ");

    // Capitaliza la primera letra de cada palabra y convierte el resto en minúsculas
    for (var i = 0; i < words.length; i++) {
      words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
    }

    // Vuelve a unir las palabras en una sola cadena
    var formattedValue = words.join(" ");

    // Asigna el valor formateado al campo de entrada
    this.value = formattedValue;
  });
    
  // Conviete la letras iniciales del Nombre y el Apellido deL Cliente en Mayusculas
  $("#txtNombres").keyup(function () {
    var cliNombres = document.getElementById("txtNombres").value.toLowerCase();
    $("#txtNombres").val(
      cliNombres.replace(/^(.)|\s(.)/g, function ($1) {
        return $1.toUpperCase();
      })
    );
  });

  $("#txtApellidos").keyup(function () {
    var cliApellido = document
      .getElementById("txtApellidos")
      .value.toLowerCase();
    $("#txtApellidos").val(
      cliApellido.replace(/^(.)|\s(.)/g, function ($1) {
        return $1.toUpperCase();
      })
    );
  });

  // Si conoce la Placa muestra el campo Placa y oculta el campo CeroKM.
  $("#txtConocesLaPlacaSi").click(function () {
    document.getElementById("contenPlaca").style.display = "block";
    document.getElementById("contenCeroKM").style.display = "none";
    document.getElementById("placaVeh").value = "";
    $("#txtEsCeroKmSi").prop("checked", false);
    $("#txtEsCeroKmNo").prop("checked", true);
  });

  // Si no conoce la Placa oculta el campo Placa y muestra el campo CeroKM.
  $("#txtConocesLaPlacaNo").click(function () {
    document.getElementById("contenPlaca").style.display = "none";
    document.getElementById("contenCeroKM").style.display = "block";
    document.getElementById("placaVeh").value = "WWW404";
    $("#txtEsCeroKmNo").prop("checked", false);
  });

  // Validamos que si el vehiculo No es Cero KM, debe tener Placa
  $("#txtEsCeroKmNo").click(function () {
    var conoceslaPlaca = document.getElementById("txtConocesLaPlacaNo").checked;
    var esCeroKmNo = document.getElementById("txtEsCeroKmNo").checked;

    if (conoceslaPlaca == true && esCeroKmNo == true) {
      Swal.fire({
        icon: 'error',
        title: '!Si el vehiculo no es 0 km, debe tener placa!',
        text: 'Si el vehiculo tiene placa, no es 0 km',
        showConfirmButton: true
      })
      $("#txtEsCeroKmNo").prop("checked", false);
    }
  });
  
  // DOCUMENTO

  
  //Elimina espacios y caracteres especiales en el campo DOCUMENTO al copiar y pegar informacion
  $("#numDocumentoID").change(function () {
    convertirNumero();
  });

  $(document).ready(function () {
    // Detectar el evento de entrada (input) en el campo de número de documento
    $("#numDocumentoID").on('input', function () {
        convertirNumero();
    });   
  });

function convertirNumero() {
  var numeroInput = document.getElementById("numDocumentoID").value;
  var numeroSinCaracteresEspeciales = numeroInput.replace(/[^0-9]/g, '');
  document.getElementById("numDocumentoID").value = numeroSinCaracteresEspeciales;
}

  // Convierte la Placa ingresada en Mayusculas
  $("#numDocumentoID").change(function () {
    consultarAsegurado();
  });

  // Carga la fecha de Nacimiento
  $("#dianacimiento, #mesnacimiento, #anionacimiento").select2({
    theme: "bootstrap fecnacimiento",
    language: "es",
    width: "100%",
  });

  // Carga la edad
  $("#edad").select2({
    theme: "bootstrap edad",
    language: "es",
    width: "100%",
  });

  // Conviete la letras iniciales del Nombre y el Apellido deL Cliente en Mayusculas
  $("#txtNombres").keyup(function () {
    var cliNombres = document.getElementById("txtNombres").value.toLowerCase();
    $("#txtNombres").val(
      cliNombres.replace(/^(.)|\s(.)/g, function ($1) {
        return $1.toUpperCase();
      })
    );
  });
  $("#txtApellidos").keyup(function () {
    var cliApellido = document
      .getElementById("txtApellidos")
      .value.toLowerCase();
    $("#txtApellidos").val(
      cliApellido.replace(/^(.)|\s(.)/g, function ($1) {
        return $1.toUpperCase();
      })
    );
  });

  // Carga los Departamentos disponibles
  $("#DptoCirculacion").select2({
    theme: "bootstrap dpto",
    language: "es",
    width: "100%",
  });
  $("#DptoCirculacion").change(function () {
    consultarCiudad();
  });

  // Carga las Ciudades disponibles
  $("#ciudadCirculacion").select2({
    theme: "bootstrap ciudad",
    language: "es",
    width: "100%",
  });

  // Si es Oneroso muestra el campo N° Beneficiario.
  $("#esOnerosoSi").click(function () {
    document.getElementById("contenBenefOneroso").style.display = "block";
  });

  // Si no es Oneroso oculta el campo N° Beneficiario y lo limpia.
  $("#esOnerosoNo").click(function () {
    document.getElementById("contenBenefOneroso").style.display = "none";
    document.getElementById("benefOneroso").value = "";
  });

  // Obtiene los datos de cada campo del formulario y Valida que no esten Vacios
  $("#formResumAseg, #formVehManual, #formResumVeh, #agregarOferta").on(
    "submit",
    function (e) {
      e.preventDefault(); // Evita que la pagina se recargue
    }
  );

  // Ejectura la funcion Consultar Placa Vehiculo
  $("#btnConsultarPlaca").click(function () {
    consulPlaca();
  });

  // Ejecuta la funcion que trae el Codigo Fasecolda de la Guia
  $("#btnConsultarVeh").click(function () {
    consulCodFasecolda();
  });

  // Ejectura la funcion Cotizar Ofertas
  $("#btnCotizar").click(function () {
    cotizarOfertas();
  });

  $("#btnCotizarPesados").click(function () {
    cotizarOfertasPesados();
  });
});

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

// Permite consultar los datos del Asegurado si existe en el sistema
function consultarAsegurado() {
  var tipoDocumentoID = document.getElementById("tipoDocumentoID").value;
  var numDocumentoID = document.getElementById("numDocumentoID").value;

  $.ajax({
    type: "POST",
    url: "src/consultarAsegurado.php",
    dataType: "json",
    data: { tipoDocumento: tipoDocumentoID, numDocumento: numDocumentoID },
    success: function (data) {
      var estado = data.estado;
      var fechaNac = data.cli_fch_nacimiento;

      if (estado) {
        $("#idCliente").val(data.id_cliente);
        $("#tipoDocumentoID").val(data.id_tipo_documento);
        $("#txtNombres").val(data.cli_nombre);
        $("#txtApellidos").val(data.cli_apellidos);
        $("#genero").val(data.cli_genero);
        $("#estadoCivil").val(data.id_estado_civil);
        $("#txtCorreo").val(data.cli_email);
        $("#txtCelular").val(data.cli_telefono);
        // Adjuntar correo y número

        var fecha = fechaNac.split("-");
        var nombreMes = obtenerNombreMes(fecha[1]);
        $("#dianacimiento").append(
          "<option value='" + fecha[2] + "' selected>" + fecha[2] + "</option>"
        );
        $("#mesnacimiento").append(
          "<option value='" +
          fecha[1] +
          "' selected>" +
          nombreMes[0].toUpperCase() +
          nombreMes.slice(1) +
          "</option>"
        );
        $("#anionacimiento").append(
          "<option value='" + fecha[0] + "' selected>" + fecha[0] + "</option>"
        );
      } else {
        $("#idCliente").val("");
        $("#tipoDocumentoID").val("");
        $("#txtNombres").val("");
        $("#txtApellidos").val("");
        $("#genero").val("");
        $("#estadoCivil").val("");
        $("#txtCorreo").val("");
        $("#txtCelular").val("");


        $("#dianacimiento").append(
          "<option value='' selected></option>"
        );
        $("#mesnacimiento").append(
          "<option value=''selected ></option>"
        );
        $("#anionacimiento").append(
          "<option value='' selected></option>"
        );
        console.log(data.mensaje);
      }
    },
  });
}

// FUNCION PARA OBTENER EL NOMBRE DEL MES
function obtenerNombreMes(numero) {
  var fecha = new Date();
  if (0 < numero && numero <= 12) {
    fecha.setMonth(numero - 1);
    return new Intl.DateTimeFormat("es-ES", { month: "long" }).format(fecha);
  }
}

var contErrMetEstado = 0;
var contErrProtocolo = 0;

// Permite consultar la informacion del vehiculo por medio de la Placa (Seguros del Estado)
function consulPlaca() {
  var numplaca = document.getElementById("placaVeh").value;
  if (numplaca == "WWW404") {
    document.getElementById("formularioVehiculo").style.display = "block";
    $("#loaderPlaca").html("");
  }else{
  var rolAsesor = document.getElementById("rolAsesor").value;
  var valnumplaca = numplaca.toUpperCase(); // Convierte la Placa en Mayusculas
  var tipoDocumentoID = document.getElementById("tipoDocumentoID").value;
  var numDocumentoID = document.getElementById("numDocumentoID").value;
  var dianacimiento = document.getElementById("dianacimiento").value;
  var mesnacimiento = document.getElementById("mesnacimiento").value;
  var anionacimiento = document.getElementById("anionacimiento").value;
  var nombresAseg = document.getElementById("txtNombres").value;
  var apellidosAseg = document.getElementById("txtApellidos").value;
  var generoAseg = document.getElementById("genero").value;
  var estadoCivil = document.getElementById("estadoCivil").value;
  var intermediario = document.getElementById("intermediario").value;
  if(tipoDocumentoID == "2"){
    var restriccion = '';
    if(rolAsesor == 19){
      restriccion = 'Lo sentimos, no puedes realizar cotizaciones para personas jurídicas por este cotizador. Para hacerlo debes comunicarte con el Equipo de Asesores Freelance de Grupo Asistencia, quienes podrán ayudarte a cotizar de manera manual con diferentes aseguradoras.';
    }else{
      restriccion = 'Lo sentimos, no puedes realizar cotizaciones para personas jurídicas por este cotizador.'
    }
    Swal.fire({
      icon: 'error',
      title: 'Lo sentimos',
      text: restriccion
    }).then(() => {
      // Recargar la página después de cerrar el SweetAlert
      location.reload();
    });
  }
  if (
    numplaca != "" &&
    tipoDocumentoID != "" &&
    numDocumentoID != "" &&
    dianacimiento != "" &&
    mesnacimiento != "" &&
    anionacimiento != "" &&
    nombresAseg != "" &&
    apellidosAseg != "" &&
    generoAseg != "" &&
    estadoCivil != ""
  ) {
    // Oculta los campos de consultar Vehiculo paso a paso desde la Guia Fasecolda
    document.getElementById("formularioVehiculo").style.display = "none";
    $("#loaderPlaca").html(
      '<img src="vistas/img/plantilla/loader-loading.gif" width="34" height="34"><strong> Consultando Placa...</strong>'
    );

    //INICIO DE CABECERA PARA INGRESAR INFORMACION DEL METODO
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var raw = JSON.stringify({ Placa: valnumplaca, intermediario: intermediario });

    var requestOptions = {
      mode: "cors",
      method: "POST",
      headers: myHeaders,
      body: raw,
      redirect: "follow",
    };

    // Llama la informacion del Vehiculo por medio de la Placa
    fetch("https://grupoasistencia.com/motor_webservice/Vehiculo", requestOptions)
      .then(function (response) {
        if (!response.ok) {
          throw Error(response.statusText);
        }
        return response.json();
      })
      .then(function (myJson) {
        var estadoConsulta = myJson.Success;
        var mensajeConsulta = myJson.Message;

        //VALIDA SI LA CONSULTA FUE EXITOSA
        if (estadoConsulta == true) {
          var codigoClase = myJson.Data.ClassId;
          var codigoMarca = myJson.Data.Brand;
          var modeloVehiculo = myJson.Data.Modelo;
          var codigoLinea = myJson.Data.BrandLine;
          var codigoFasecolda = myJson.Data.CodigoFasecolda;
          var valorAsegurado = myJson.Data.ValorAsegurado;

          if (codigoFasecolda != null) {
            if (valorAsegurado == "null" || valorAsegurado == null) {
              consulPlacaMapfre(valnumplaca);
              // document.getElementById("formularioVehiculo").style.display =
              //   "block";
              // $("#loaderPlaca").html("");
            } else {
              var claseVehiculo = "";
              var limiteRCESTADO = "";

              if (codigoClase == 1) {
                claseVehiculo = "AUTOMOVILES";
                limiteRCESTADO = 6;
              } else if (codigoClase == 2) {
                claseVehiculo = "CAMPEROS";
                limiteRCESTADO = 18;
              } else if (codigoClase == 3) {
                claseVehiculo = "PICK UPS";
                limiteRCESTADO = 18;
              } else if (codigoClase == 4) {
                claseVehiculo = "UTILITARIOS DEPORTIVOS";
                limiteRCESTADO = 6;
              } else if (codigoClase == 12) {
                claseVehiculo = "MOTOCICLETA";
                limiteRCESTADO = 6;
                 var restriccion = '';
                if(rolAsesor == 19){
                  restriccion = 'No puedes cotizar motos por este módulo. Para hacerlo, debes comunicarte con el Equipo de Asesores Freelance de Grupo Asistencia, quienes podrán ayudarte a cotizar de manera manual con diferentes aseguradoras.';
                }else{
                  restriccion = 'Lo sentimos, no puedes cotizar motos por este módulo.'
                }
                Swal.fire({
                  icon: 'error',
                  title: 'Lo sentimos',
                  text: restriccion
                }).then(() => {
                  // Recargar la página después de cerrar el SweetAlert
                  location.reload();
                });
              } else if (codigoClase == 14 || codigoClase == 21) {
                claseVehiculo = "PESADO";
                limiteRCESTADO = 18;
                var restriccion = '';
                if(rolAsesor == 19){
                  restriccion = 'Lo sentimos, no puedes cotizar vehículos pesados por este módulo. Para hacerlo debes ingresar al modulo Cotizar Pesados.';
                }else{
                  restriccion = 'Lo sentimos, no puedes cotizar pesados por este módulo.'
                }
                Swal.fire({
                  icon: 'error',
                  title: 'Lo sentimos',
                  text: restriccion
                }).then(() => {
                  // Recargar la página después de cerrar el SweetAlert
                  location.reload();
                });
              } else if (codigoClase == 19) {
                claseVehiculo = "VAN";
                limiteRCESTADO = 18;
              } else if (codigoClase == 16) {
                claseVehiculo = "MOTOCICLETA";
                limiteRCESTADO = 6;
                var restriccion = '';
                if(rolAsesor == 19){
                  restriccion = 'No puedes cotizar motos por este módulo. Para hacerlo, debes comunicarte con el Equipo de Asesores Freelance de Grupo Asistencia, quienes podrán ayudarte a cotizar de manera manual con diferentes aseguradoras.';
                }else{
                  restriccion = 'Lo sentimos, no puedes cotizar motos por este módulo.'
                }
                Swal.fire({
                  icon: 'error',
                  title: 'Lo sentimos',
                  text: restriccion
                }).then(() => {
                  // Recargar la página después de cerrar el SweetAlert
                  location.reload();
                });
              }

              $("#CodigoClase").val(codigoClase);
              $("#txtClaseVeh").val(claseVehiculo);
              $("#LimiteRC").val(limiteRCESTADO);
              $("#CodigoMarca").val(codigoMarca);
              $("#txtModeloVeh").val(modeloVehiculo);
              $("#CodigoLinea").val(codigoLinea);
              $("#txtFasecolda").val(codigoFasecolda);
              $("#txtValorFasecolda").val(valorAsegurado);

              consulDatosFasecolda(codigoFasecolda, modeloVehiculo).then(
                function (resp) {
                  $("#txtMarcaVeh").val(resp.marcaVeh);
                  $("#txtReferenciaVeh").val(resp.lineaVeh);
                }
              );
            }
          }
        } else {
          if (
            mensajeConsulta == "Parámetros Inválidos. Placa es requerido." ||
            mensajeConsulta == "Favor diligenciar correctamente la placa"
          ) {
            swal.fire({ text: "! Favor diligenciar correctamente la placa. ¡" });
          } else {
            
            consulPlacaMapfre(valnumplaca);

          }
          consulPlacaMapfre(valnumplaca);
          // $("#loaderPlaca").html("");
        }
      })
      .catch(function (error) {
        console.log("Parece que hubo un problema: \n", error);
        consulPlacaMapfre(valnumplaca);

        contErrProtocolo++;
        if (contErrProtocolo > 1) {
          consulPlacaMapfre(valnumplaca);
          // $("#loaderPlaca").html("");
          contErrProtocolo = 0;
        } else {
          // setTimeout(consulPlacaMapfre, 4000);
        }
      });


  }
}
}

function consulPlacaMapfre(valnumplaca){
  console.log("MAPFRE FUNCIONANDO")

  let bodyContent = JSON.stringify({
    "Placa": valnumplaca
  });

  let headersList = {
    "Accept": "*/*",
    "User-Agent": "Thunder Client (https://www.thunderclient.com)",
    "Content-Type": "application/json"
  }

    fetch("https://grupoasistencia.com/webserviceAutos/ultimaPolizaMapfre", {
      method: "POST",
      body: bodyContent,
      headers: headersList
      }).then(function(response) {
        return response.json();
      }).then(async function(data) {
        var resultadoConsulta = data.respuesta.errorEjecucion;
        var codigoClase = data.polizaReciente.COD_MODELO;
        var marcaCod = data.polizaReciente.COD_MARCA;
        var clase = data.polizaReciente.NOM_CLASE;
        var linea = data.polizaReciente.NOM_LINEA;
        var modelo = data.polizaReciente.ANIO_VEHICULO;
        var cilindraje = data.polizaReciente.VAL_CILINDRAJE;
        var codFasecolda = data.polizaReciente.COD_FASECOLDA;
        var aseguradora = data.polizaReciente.nomCompania;
        // console.log("Mapfre consulta");
        // console.log("Marca Cod:", marcaCod);
        // console.log("Clase:", clase);
        // console.log("Línea:", linea);
        // console.log("Modelo:", modelo);
        // console.log("Cilindraje:", cilindraje);
        // console.log("Código Fasecolda:", codFasecolda);
        // console.log("Aseguradora:", aseguradora);

        propietario = data.polizaReciente.asegNombre;
        cedulaP = data.polizaReciente.asegCodDocum;

        
        if (marcaCod == "" && clase == "" && linea == "" && modelo == "" && cilindraje == "" && codFasecolda == "" && aseguradora == "" && aseguradora == "" && fechFinTR == "" && propietario == "" && cedulaP == "") {
            alert("No se encuentra poliza en esta placa")
        }

        if (resultadoConsulta == false || resultadoConsulta == "false") {

          var claseVehiculo = "";
          var limiteRCESTADO = "";

          if (codigoClase == 1) {
            claseVehiculo = "AUTOMOVILES";
            limiteRCESTADO = 6;
          } else if (codigoClase == 2) {
            claseVehiculo = "CAMPEROS";
            limiteRCESTADO = 18;
          } else if (codigoClase == 3) {
            claseVehiculo = "PICK UPS";
            limiteRCESTADO = 18;
          } else if (codigoClase == 4) {
            claseVehiculo = "UTILITARIOS DEPORTIVOS";
            limiteRCESTADO = 6;
          } else if (codigoClase == 12) {
            claseVehiculo = "MOTOCICLETA";
            limiteRCESTADO = 6;
          } else if (codigoClase == 14 || codigoClase == 21) {
            claseVehiculo = "PESADO";
            limiteRCESTADO = 18;
          } else if (codigoClase == 19) {
            claseVehiculo = "VAN";
            limiteRCESTADO = 18;
          } else if (codigoClase == 16) {
            claseVehiculo = "MOTOCICLETA";
            limiteRCESTADO = 6;
          }

          $("#CodigoClase").val(codigoClase);
          $("#txtClaseVeh").val(claseVehiculo);
          $("#LimiteRC").val(limiteRCESTADO);
          $("#CodigoMarca").val(marcaCod);
          $("#txtModeloVeh").val(modelo);
          $("#CodigoLinea").val(linea);
          $("#txtFasecolda").val(codFasecolda);

          consulDatosFasecolda(codFasecolda, modelo).then(
            function (resp) {
              console.log(resp)
              $("#txtMarcaVeh").val(resp.marcaVeh);
              $("#txtReferenciaVeh").val(resp.lineaVeh);
              $("#txtValorFasecolda").val(resp.valorVeh);
            }
          );
          // const valor = resp[llave];
          // $("#txtValorFasecolda").val(valorAsegurado);

        }else{
          document.getElementById("formularioVehiculo").style.display =
              "block";
            document.getElementById("headerAsegurado").style.display = "block";
            document.getElementById("masA").style.display = "block";
            document.getElementById("DatosAsegurado").style.display = "none";
        }

      }).catch(function (error) {
        console.log("Parece que hubo un problema: \n", error);
        document.getElementById("formularioVehiculo").style.display =
              "block";
            document.getElementById("headerAsegurado").style.display = "block";
            document.getElementById("masA").style.display = "block";
            document.getElementById("DatosAsegurado").style.display = "none";
      });

}

// Permite consultar la informacion del vehiculo por medio de la Placa (Seguros del Estado)
// function consulPlacaPesados() {
//   var numplaca = document.getElementById("placaVeh").value;
//   var valnumplaca = numplaca.toUpperCase(); // Convierte la Placa en Mayusculas
//   var tipoDocumentoID = document.getElementById("tipoDocumentoID").value;
//   var numDocumentoID = document.getElementById("numDocumentoID").value;
//   var dianacimiento = document.getElementById("dianacimiento").value;
//   var mesnacimiento = document.getElementById("mesnacimiento").value;
//   var anionacimiento = document.getElementById("anionacimiento").value;
//   var nombresAseg = document.getElementById("txtNombres").value;
//   var apellidosAseg = document.getElementById("txtApellidos").value;
//   var generoAseg = document.getElementById("genero").value;
//   var estadoCivil = document.getElementById("estadoCivil").value;

//   if (
//     numplaca != "" &&
//     tipoDocumentoID != "" &&
//     numDocumentoID != "" &&
//     dianacimiento != "" &&
//     mesnacimiento != "" &&
//     anionacimiento != "" &&
//     nombresAseg != "" &&
//     apellidosAseg != "" &&
//     generoAseg != "" &&
//     estadoCivil != ""
//   ) {
//     // Oculta los campos de consultar Vehiculo paso a paso desde la Guia Fasecolda
//     document.getElementById("formularioVehiculo").style.display = "none";
//     $("#loaderPlaca").html(
//       '<img src="vistas/img/plantilla/loader-loading.gif" width="34" height="34"><strong> Consultando Placa...</strong>'
//     );

//     //INICIO DE CABECERA PARA INGRESAR INFORMACION DEL METODO
//     var myHeaders = new Headers();
//     myHeaders.append("Content-Type", "application/json");

//     var raw = JSON.stringify({ Placa: valnumplaca });

//     var requestOptions = {
//       mode: "cors",
//       method: "POST",
//       headers: myHeaders,
//       body: raw,
//       redirect: "follow",
//     };

//     // Llama la informacion del Vehiculo por medio de la Placa
//     fetch("https://grupoasistencia.com/motor_webservice/Vehiculo", requestOptions)
//       .then(function (response) {
//         if (!response.ok) {
//           throw Error(response.statusText);
//         }
//         return response.json();
//       })
//       .then(function (myJson) {
//         // console.log(myJson);
//         var estadoConsulta = myJson.Success;
//         var mensajeConsulta = myJson.Message;

//         //VALIDA SI LA CONSULTA FUE EXITOSA
//         if (estadoConsulta == true) {
//           var codigoClase = myJson.Data.ClassId;
//           var codigoMarca = myJson.Data.Brand;
//           var modeloVehiculo = myJson.Data.Modelo;
//           var codigoLinea = myJson.Data.BrandLine;
//           var codigoFasecolda = myJson.Data.CodigoFasecolda;
//           var valorAsegurado = myJson.Data.ValorAsegurado;

//           var claseVehiculo = "";
//           var limiteRCESTADO = "";

//           if (codigoClase == 1) {
//             claseVehiculo = "AUTOMOVILES";
//             limiteRCESTADO = 6;
//           } else if (codigoClase == 2) {
//             claseVehiculo = "CAMPEROS";
//             limiteRCESTADO = 18;
//           } else if (codigoClase == 3) {
//             claseVehiculo = "PICK UPS";
//             limiteRCESTADO = 18;
//           } else if (codigoClase == 4) {
//             claseVehiculo = "UTILITARIOS DEPORTIVOS";
//             limiteRCESTADO = 6;
//           } else if (codigoClase == 12) {
//             claseVehiculo = "MOTOCICLETA";
//             limiteRCESTADO = 6;
//           } else if (codigoClase == 14) {
//             claseVehiculo = "PESADO";
//             limiteRCESTADO = 18;
//           } else if (codigoClase == 19) {
//             claseVehiculo = "VAN";
//             limiteRCESTADO = 18;
//           } else if (codigoClase == 16) {
//             claseVehiculo = "MOTOCICLETA";
//             limiteRCESTADO = 6;
//           }

//           $("#CodigoClase").val(codigoClase);
//           $("#txtClaseVeh").val(claseVehiculo);
//           $("#LimiteRC").val(limiteRCESTADO);
//           $("#CodigoMarca").val(codigoMarca);
//           $("#txtModeloVeh").val(modeloVehiculo);
//           $("#CodigoLinea").val(codigoLinea);
//           $("#txtFasecolda").val(codigoFasecolda);
//           $("#txtValorFasecolda").val(valorAsegurado);

//           consulDatosFasecoldaPesados(codigoFasecolda, modeloVehiculo).then(
//             function (resp) {
//               $("#txtMarcaVeh").val(resp.marcaVeh);
//               $("#txtReferenciaVeh").val(resp.lineaVeh);
//             }
//           );
//         } else {
//           if (
//             mensajeConsulta == "Parámetros Inválidos. Placa es requerido." ||
//             mensajeConsulta == "Favor diligenciar correctamente la placa"
//           ) {
//             swal.fire({ text: "! Favor diligenciar correctamente la placa. ¡" });
//           } else if (
//             mensajeConsulta == "Vehículo no encontrado." ||
//             mensajeConsulta == "Unable to connect to the remote server"
//           ) {
//             document.getElementById("formularioVehiculo").style.display =
//               "block";
//           } else {
//             contErrMetEstado++;
//             if (contErrMetEstado > 1) {
//               document.getElementById("formularioVehiculo").style.display =
//                 "block";
//               contErrMetEstado = 0;
//             } else {
//               setTimeout(consulPlaca, 2000);
//             }
//           }
//           $("#loaderPlaca").html("");
//         }
//       })
//       .catch(function (error) {
//         console.log("Parece que hubo un problema: \n", error);

//         contErrProtocolo++;
//         if (contErrProtocolo > 1) {
//           $("#loaderPlaca").html("");
//           document.getElementById("formularioVehiculo").style.display = "block";
//           contErrProtocolo = 0;
//         } else {
//           setTimeout(consulPlaca, 4000);
//         }
//       });
//   }
// }

// CONSULTA LA GUIA PARA OBTENER EL CODIGO FASECOLDA MANUALMENTE
function consulCodFasecolda() {
  var claseVeh = document.getElementById("clase").value;
  var marcaVeh = document.getElementById("Marca").value;
  var edadVeh = document.getElementById("edad").value;
  var refe = document.getElementById("linea").value;
  var refe2 = $(".refe1").val();
  var refe3 = $(".refe22").val();

  if (
    claseVeh != "" &&
    marcaVeh != "" &&
    edadVeh != "" &&
    refe != "" &&
    refe2 != "" &&
    refe3 != ""
  ) {
    $.ajax({
      type: "POST",
      url: "src/fasecolda/consulCodFasecolda.php",
      dataType: "json",
      data: {
        clasveh: claseVeh,
        MarcaVeh: marcaVeh,
        edadVeh: edadVeh,
        lineaVeh: refe,
        refe: refe2,
        refe2: refe3,
      },
      success: function (data) {
        // console.log(data);
        var codFasecolda = data.result.codigo;
        consulValorfasecolda(codFasecolda, edadVeh);
      },
    });
  }
}

var contErrMetEstadoFasec = 0;
var contErrProtConsulFasec = 0;

// Permite consultar la informacion del vehiculo segun la Guia Fasecolda
function consulValorfasecolda(codFasecolda, edadVeh) {
  $("#loaderVehiculo").html(
    '<img src="vistas/img/plantilla/loader-loading.gif" width="34" height="34"><strong> Consultando Vehículo...</strong>'
  );

  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");

  var raw = JSON.stringify({
    CodigoFasecolda: codFasecolda,
    brand: "",
    brandline: "",
    ClassId: "",
    Modelo: edadVeh,
  });

  var requestOptions = {
    method: "POST",
    headers: myHeaders,
    body: raw,
    redirect: "follow",
  };

  fetch("https://grupoasistencia.com/motor_webservice/VehiculoFasecolda", requestOptions)
    .then(function (response) {
      if (!response.ok) {
        throw Error(response.statusText);
      }
      return response.json();
    })
    .then(function (myJson) {
      // console.log(myJson);
      if (myJson.Data != null) {
        var codigoClase = myJson.Data.ClassId;
        var codigoMarca = myJson.Data.Brand;
        var modeloVehiculo = myJson.Data.Modelo;
        var codigoLinea = myJson.Data.BrandLine;
        var codigoFasecolda = myJson.Data.CodigoFasecolda;
        var valorAsegurado = myJson.Data.ValorAsegurado;

        var claseVehiculo = "";
        var limiteRCESTADO = "";

        if (codigoClase == 1) {
          claseVehiculo = "AUTOMOVILES";
          limiteRCESTADO = 6;
        } else if (codigoClase == 2) {
          claseVehiculo = "CAMPEROS";
          limiteRCESTADO = 18;
        } else if (codigoClase == 3) {
          claseVehiculo = "PICK UPS";
          limiteRCESTADO = 18;
        } else if (codigoClase == 4) {
          claseVehiculo = "UTILITARIOS DEPORTIVOS";
          limiteRCESTADO = 6;
        } else if (codigoClase == 12) {
          claseVehiculo = "MOTOCICLETA";
          limiteRCESTADO = 6;
        } else if (codigoClase == 14) {
          claseVehiculo = "PESADO";
          limiteRCESTADO = 18;
        } else if (codigoClase == 19) {
          claseVehiculo = "VAN";
          limiteRCESTADO = 18;
        } else if (codigoClase == 16) {
          claseVehiculo = "MOTOCICLETA";
          limiteRCESTADO = 6;
        }

        $("#CodigoClase").val(codigoClase);
        $("#txtClaseVeh").val(claseVehiculo);
        $("#LimiteRC").val(limiteRCESTADO);
        $("#CodigoMarca").val(codigoMarca);
        $("#txtModeloVeh").val(modeloVehiculo);
        $("#CodigoLinea").val(codigoLinea);
        $("#txtFasecolda").val(codigoFasecolda);
        $("#txtValorFasecolda").val(valorAsegurado);

        consulDatosFasecolda(codigoFasecolda, modeloVehiculo).then(function (
          resp
        ) {
          $("#txtMarcaVeh").val(resp.marcaVeh);
          $("#txtReferenciaVeh").val(resp.lineaVeh);
        });
      } else {
        contErrMetEstadoFasec++;
        if (contErrMetEstadoFasec > 2) {
          $("#txtModeloVeh").val(edadVeh);
          $("#txtFasecolda").val(codFasecolda);

          consulDatosFasecolda(codFasecolda, edadVeh).then(function (resp) {
            var codigoClaseEstado = "";
            if (resp.claseVeh == "MOTOS") {
              codigoClaseEstado = 12;
            }
            $("#CodigoClase").val(codigoClaseEstado);
            $("#txtClaseVeh").val(resp.claseVeh);
            $("#txtMarcaVeh").val(resp.marcaVeh);
            $("#txtReferenciaVeh").val(resp.lineaVeh);
            $("#txtValorFasecolda").val(resp.valorVeh);
          });
          contErrMetEstadoFasec = 0;
        } else {
          setTimeout(consulCodFasecolda, 2000);
        }
      }
    })
    .catch(function (error) {
      console.log("Parece que hubo un problema: \n", error);

      contErrProtConsulFasec++;
      if (contErrProtConsulFasec > 1) {
        $("#txtModeloVeh").val(edadVeh);
        $("#txtFasecolda").val(codFasecolda);

        consulDatosFasecolda(codFasecolda, edadVeh).then(function (resp) {
          var codigoClaseEstado = "";
          if (resp.claseVeh == "MOTOS") {
            codigoClaseEstado = 12;
          }
          $("#CodigoClase").val(codigoClaseEstado);
          $("#txtClaseVeh").val(resp.claseVeh);
          $("#txtMarcaVeh").val(resp.marcaVeh);
          $("#txtReferenciaVeh").val(resp.lineaVeh);
          $("#txtValorFasecolda").val(resp.valorVeh);
        });
        contErrProtConsulFasec = 0;
      } else {
        setTimeout(consulCodFasecolda, 4000);
      }
    });
}

//FUNCION PARA CONSULTAR VALORES EN FASECOLDA
function consulDatosFasecolda(codFasecolda, edadVeh) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      type: "POST",
      url: "src/fasecolda/consulDatosFasecolda.php",
      dataType: "json",
      data: {
        fasecolda: codFasecolda,
        modelo: edadVeh,
      },
      success: function (data) {
        if (data.mensaje == "No hay Registros") {
          document.getElementById("formularioVehiculo").style.display = "block";
        } else {
          // console.log(data);
          var claseVeh = data.clase;
          var marcaVeh = data.marca;
          var ref1Veh = data.referencia1;
          var ref2Veh = data.referencia2;
          var ref3Veh = data.referencia3;
          var lineaVeh = ref1Veh + " " + ref2Veh + " " + ref3Veh;
          var valorFasecVeh = data[edadVeh];
          var valorVeh = Number(valorFasecVeh) * 1000;

          var placaVeh = $("#placaVeh").val();
          if (placaVeh == "WWW404") {
            $("#txtPlacaVeh").val("SIN PLACA - VEHÍCULO 0 KM").val();
          } else {
            $("#txtPlacaVeh").val(placaVeh).val();
          }
          document.getElementById("formularioVehiculo").style.display = "none";
          document.getElementById("headerAsegurado").style.display = "block";
          document.getElementById("contenSuperiorPlaca").style.display = "none";
          document.getElementById("contenBtnConsultarPlaca").style.display =
            "none";
          document.getElementById("resumenVehiculo").style.display = "block";
          document.getElementById("contenBtnCotizar").style.display = "block";
          $("#loaderPlaca").html("");
          menosAseg();

          resolve({
            claseVeh: claseVeh,
            marcaVeh: marcaVeh,
            lineaVeh: lineaVeh,
            valorVeh: valorVeh,
          });
          reject(new Error("Fallo la Consulta"));
        }
      },
    });
  });
}

//FUNCION PARA CONSULTAR VALORES EN FASECOLDA
function consulDatosFasecoldaPesados(codFasecolda, edadVeh) {
  return new Promise(function (resolve, reject) {
    $.ajax({
      type: "POST",
      url: "src/fasecolda/consulDatosFasecolda.php",
      dataType: "json",
      data: {
        fasecolda: codFasecolda,
        modelo: edadVeh,
      },
      success: function (data) {
        // console.log(data);
        var claseVeh = data.clase;
        var marcaVeh = data.marca;
        var ref1Veh = data.referencia1;
        var ref2Veh = data.referencia2;
        var ref3Veh = data.referencia3;
        var lineaVeh = ref1Veh + " " + ref2Veh + " " + ref3Veh;
        var valorFasecVeh = data[edadVeh];
        var valorVeh = Number(valorFasecVeh) * 1000;
        var clase = data.clase;

        $("#clasepesados").val(clase);

        var placaVeh = $("#placaVeh").val();
        if (placaVeh == "WWW404") {
          $("#txtPlacaVeh").val("SIN PLACA - VEHÍCULO 0 KM").val();
        } else {
          $("#txtPlacaVeh").val(placaVeh).val();
        }
        document.getElementById("formularioVehiculo").style.display = "none";
        document.getElementById("headerAsegurado").style.display = "block";
        document.getElementById("contenSuperiorPlaca").style.display = "none";
        document.getElementById("contenBtnConsultarPlaca").style.display =
          "none";
        document.getElementById("resumenVehiculo").style.display = "block";
        document.getElementById("contenBtnCotizar").style.display = "block";
        $("#loaderPlaca").html("");
        menosAseg();

        resolve({
          claseVeh: claseVeh,
          marcaVeh: marcaVeh,
          lineaVeh: lineaVeh,
          valorVeh: valorVeh,
        });
        reject(new Error("Fallo la Consulta"));
      },
    });
  });
}

// FUNCION PARA CARGAR LA CIUDAD DE CIRCULACIÓN
function consultarCiudad() {
  var codigoDpto = document.getElementById("DptoCirculacion").value;

  //if (codigoDpto == 1 || codigoDpto == 3 || codigoDpto == 10 || codigoDpto == 11 || codigoDpto == 12 || codigoDpto == 14 || codigoDpto == 17
  //|| codigoDpto == 19 || codigoDpto == 25 || codigoDpto == 28 || codigoDpto == 33 || codigoDpto == 34) {

  //	swal({ text: '! El Departamento de circulación no posee cobertura. ¡' });

  //} else {

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
    },
  });

  //}
}

// REGISTRA CADA UNA DE LAS OFERTAS COTIZADAS EN LA BD
function registrarOferta(
  aseguradora,
  prima,
  producto,
  numCotizOferta,
  valorRC,
  PT,
  PP,
  CE,
  GR,
  logo,
  UrlPdf,
  manual,
  pdf
) {
  return new Promise((resolve, reject) => {
    var idCotizOferta = idCotizacion
    var numDocumentoID = document.getElementById("numDocumentoID").value
    var placa = document.getElementById("placaVeh").value

    $.ajax({
      type: "POST",
      url: "src/insertarOferta.php",
      dataType: "json",
      data: {
        placa: placa,
        idCotizOferta: idCotizOferta,
        numIdentificacion: numDocumentoID,
        aseguradora: aseguradora,
        numCotizOferta: numCotizOferta,
        producto: producto,
        valorPrima: prima,
        valorRC: valorRC,
        PT: PT,
        PP: PP,
        CE: CE,
        GR: GR,
        logo: logo,
        UrlPdf: UrlPdf,
        manual: manual,
        pdf: pdf
      },
      success: function (data) {
        // var datos = data.Data;
        var message = data.Message
        var success = data.Success
        resolve()
      },
      error: function (error) {
        console.log(error)
        reject(error)
      }
    });
  })
}

const mostrarOferta = (
  aseguradora,
  prima,
  producto,
  numCotizOferta,
  valorRC,
  PT,
  PP,
  CE,
  GR,
  logo,
  UrlPdf
) => {
  let cardCotizacion = `
						<div class='col-lg-12'>
							<div class='card-ofertas'>
								<div class='row card-body'>
									<div class="col-xs-12 col-sm-6 col-md-2 oferta-logo">
									<center>

										<img src='vistas/img/logos/${logo}'>

                  </center>  

                 <div class='col-12' style='margin-top:2%;'>
                        ${permisos.Vernumerodecotizacionencadaaseguradora == "x" ?
      `<center>
                    <label class='entidad'>N° Cot: <span style ='color :black'>${numCotizOferta}</span></label>

                   </center>`
      : ''}
                      </div>

									</div>
									<div class="col-xs-12 col-sm-6 col-md-2 oferta-header">
										<h5 class='entidad'>${aseguradora} - ${producto}</h5>
										<h5 class='precio'>Desde $ ${prima}</h5>
										<p class='title-precio'>Precio (IVA incluido)</p>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<ul class="list-group">
											<li class="list-group-item">
												<span class="badge">* $${valorRC}</span>
												Responsabilidad Civil (RCE)
											</li>
											<li class="list-group-item">
												<span class="badge">* ${PT}</span>
												Pérdida Total Daños y Hurto
											</li>
											<li class="list-group-item">
												<span class="badge">* ${PP}</span>
												Pérdida Parcial Daños y Hurto
											</li>
											<li class="list-group-item">
												<span class="badge">* ${CE}</span>
												Conductor elegido
											</li>
											<li class="list-group-item">
												<span class="badge">* ${GR}</span>
												Servicio de Grúa
											</li>
										</ul>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-2">
									  <div class="selec-oferta">
										<label for="seleccionar">SELECCIONAR</label>&nbsp;&nbsp;
										<input type="checkbox" class="classSelecOferta" name="selecOferta" id="selec${numCotizOferta}${numId}${producto}\" onclick='seleccionarOferta(\"${aseguradora}\", \"${prima}\", \"${producto}\", \"${numCotizOferta}\", this);' />
									  </div>
									  <div class="recom-oferta">
										<label for="recomendar">RECOMENDAR</label>&nbsp;&nbsp;
										<input type="checkbox" class="classRecomOferta" name="recomOferta" id="recom${numCotizOferta}${numId}${producto}\" onclick='recomendarOferta(\"${aseguradora}\", \"${prima}\", \"${producto}\", \"${numCotizOferta}\", this);' />
									  </div>
									</div>`;
  if (aseguradora == "Seguros Bolivar" || aseguradora == "Axa Colpatria") {
    cardCotizacion += `
										<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">
											<button type="button" class="btn btn-info" id="btnAsegPDF${numCotizOferta}${numId}\" onclick='verPdfOferta(\"${aseguradora}\", \"${numCotizOferta}\", \"${numId}\");'>
												<div id="verPdf${numCotizOferta}${numId}\">VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>
											</button>
										</div>`;
  } else if (aseguradora == "Seguros del Estado" && UrlPdf !== null) {
    cardCotizacion += `
						<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">
						<button type="button" class="btn btn-info" id="btnAsegPDF${numCotizOferta}${numId}\" onclick='verPdfEstado(\"${aseguradora}\", \"${numCotizOferta}\", \"${numId}\", \"${UrlPdf}\");'>
							<div id="verPdf${numCotizOferta}${numId}\">VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>
						</button>
						</div>`;
  } else if (aseguradora == "Solidaria") {
    cardCotizacion += `
						<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">
							<button id="solidaria-pdf" type="button" class="btn btn-info" onclick='verPdfSolidaria(${numCotizOferta})'>
								<div>VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>
							</button>
						</div>`;
  } else if (aseguradora == "Zurich") {
    cardCotizacion += `
						<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">
							<button id="solidaria-pdf${numCotizOferta}" type="button" class="btn btn-info" onclick='verPdfZurich(${numCotizOferta})'>
								<div>VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>
							</button>
						</div>`;
  }
  else if (aseguradora == "Previsora Seguros") {
    cardCotizacion += `
						<div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">
							<button id="previsora-pdf${numCotizOferta}" type="button" class="btn btn-info" onclick='verPdfPrevisora(${numCotizOferta})'>
								<div>VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>
							</button>
						</div>`;
  }
  cardCotizacion += `
										</div>
									</div>
								</div>
							</div>
					`;
  $("#cardCotizacion").append(cardCotizacion);
};

// VALIDA QUE LAS OFERTAS COTIZADAS HAYAN SIDO GUARDADAS EN SU TOTALIDAD
function validarOfertas(ofertas) {
  ofertas.forEach((oferta, i) => {
    var numCotizacion = oferta.numero_cotizacion;
    var precioOferta = oferta.precio;
    if (oferta == null) return;
    if (numCotizacion == null && precioOferta == "0") return;
    if (precioOferta.length <= 3) return;

    mostrarOferta(
      oferta.entidad,
      oferta.precio,
      oferta.producto,
      oferta.numero_cotizacion,
      oferta.responsabilidad_civil,
      oferta.cubrimiento,
      oferta.deducible,
      oferta.conductores_elegidos,
      oferta.servicio_grua,
      oferta.imagen,
      oferta.pdf
    );

    registrarOferta(
      oferta.entidad,
      oferta.precio,
      oferta.producto,
      oferta.numero_cotizacion,
      oferta.responsabilidad_civil,
      oferta.cubrimiento,
      oferta.deducible,
      oferta.conductores_elegidos,
      oferta.servicio_grua,
      oferta.imagen,
      oferta.pdf,
      0
    );
  });
}

var idCotizacion = "";
var contErrProtocoloCotizar = 0;

var aseguradorasFallidas = []
var aseguradorasIntentadas = []
var primerIntentoRealizado = false

const agregarAseguradoraFallida = _aseguradora => {
  const result = aseguradorasFallidas.find(aseguradoras =>
    aseguradoras == _aseguradora)
  if (result !== undefined) return
  aseguradorasFallidas.push(_aseguradora)
}

const eliminarAseguradoraFallida = _aseguradora => {
  aseguradorasFallidas = aseguradorasFallidas.filter(aseguradora => aseguradora !== _aseguradora)
}

const comprobarFallida = _aseguradora => {
  const result = aseguradorasFallidas.find(aseguradoras =>
    aseguradoras == _aseguradora)
  if (result !== undefined) return true

  return false
}

document.querySelector('#btnReCotizarFallidas').addEventListener('click', () => {
  cotizarOfertas()
})

// Captura los datos suministrados por el cliente y los envia al API para recibir la cotizacion.
function cotizarOfertas() {

  var codigoFasecolda1 = document.getElementById('txtFasecolda')
  var contenido = codigoFasecolda1.value;

  // Obtener el cuarto y quinto dígito de la variable contenido
  var cuartoDigito = contenido.charAt(3);
  var quintoDigito = contenido.charAt(4);

  // Verificar si el cuarto dígito es igual a 0 y eliminarlo si es así
  if (cuartoDigito === '0') {
    condicional = quintoDigito;
  } else {
    // Concatenar los dígitos en un solo número
    condicional = cuartoDigito + quintoDigito;
  }
  var tipoUsoVehiculo = document.getElementById("txtTipoUsoVehiculo").value;
  if(tipoUsoVehiculo == "Trabajo"){
    var restriccion = '';
    if(rolAsesor == 19){
      restriccion = 'Lo sentimos, no puedes realizar cotizaciones para vehículo de trabajo por este cotizador. Para hacerlo debes comunicarte con el Equipo de Asesores Freelance de Grupo Asistencia, quienes podrán ayudarte a cotizar de manera manual con diferentes aseguradoras.';
    }else{
      restriccion = 'Lo sentimos, no puedes realizar cotizaciones para vehículo de trabajo por este cotizador.'
    }
    Swal.fire({
      icon: 'error',
      title: 'Lo sentimos',
      text: restriccion
    }).then(() => {
      // Recargar la página después de cerrar el SweetAlert
      location.reload();
    });
  }
  var tipoServicio = document.getElementById("txtTipoServicio").value;
  if(tipoUsoVehiculo == "11" || tipoUsoVehiculo == "12"){
    var restriccion = '';
    if(rolAsesor == 19){
      restriccion = 'Lo sentimos, no puedes realizar cotizaciones para vehículo de trabajo por este cotizador. Para hacerlo debes comunicarte con el Equipo de Asesores Freelance de Grupo Asistencia, quienes podrán ayudarte a cotizar de manera manual con diferentes aseguradoras.';
    }else{
      restriccion = 'Lo sentimos, no puedes realizar cotizaciones para vehículo de trabajo por este cotizador.'
    }
    Swal.fire({
      icon: 'error',
      title: 'Lo sentimos',
      text: restriccion
    }).then(() => {
      // Recargar la página después de cerrar el SweetAlert
      location.reload();
    });
  }
  var placa = document.getElementById("placaVeh").value;
  var esCeroKmSi = document.getElementById("txtEsCeroKmSi").checked;
  var esCeroKm = esCeroKmSi.toString();
  var esCeroKmInt = esCeroKmSi == true ? 1 : 0;

  var idCliente = document.getElementById("idCliente").value;
  var tipoDocumentoID = document.getElementById("tipoDocumentoID").value;
  var numDocumentoID = document.getElementById("numDocumentoID").value;
  var Nombre = document.getElementById("txtNombres").value;
  var Apellido1 = document.getElementById("txtApellidos").value;
  var Apellido2 = "";
  var dia = document.getElementById("dianacimiento").value;
  var mes = document.getElementById("mesnacimiento").value;
  var anio = document.getElementById("anionacimiento").value;
  var FechaNacimiento = anio + "-" + mes + "-" + dia;
  var Genero = document.getElementById("genero").value;
  var estadoCivil = document.getElementById("estadoCivil").value;
  var celularAseg = document.getElementById("txtCelular").value;
  var emailAseg = document.getElementById("txtCorreo").value;
  var direccionAseg = document.getElementById("direccionAseg").value;

  var CodigoClase = document.getElementById("CodigoClase").value;
  var CodigoMarca = document.getElementById("CodigoMarca").value;
  var CodigoLinea = document.getElementById("CodigoLinea").value;
  var claseVeh = document.getElementById("txtClaseVeh").value;
  var marcaVeh = document.getElementById("txtMarcaVeh").value;
  var modeloVeh = document.getElementById("txtModeloVeh").value;
  var lineaVeh = document.getElementById("txtReferenciaVeh").value;

  var LimiteRC = document.getElementById("LimiteRC").value;
  var CoberturaEstado = document.getElementById("CoberturaEstado").value;
  var ValorAccesorios = document.getElementById("ValorAccesorios").value;
  var CodigoVerificacion = document.getElementById("CodigoVerificacion").value;
  var AniosSiniestro = document.getElementById("AniosSiniestro").value;
  var AniosAsegurados = document.getElementById("AniosAsegurados").value;
  var NivelEducativo = document.getElementById("NivelEducativo").value;
  var Estrato = document.getElementById("Estrato").value;

  var fasecoldaVeh = document.getElementById("txtFasecolda").value;
  var valorFasecolda = document.getElementById("txtValorFasecolda").value;
  var DptoCirculacion = document.getElementById("DptoCirculacion").value;
  var ciudadCirculacion = document.getElementById("ciudadCirculacion").value;
  var isBenefOneroso = $("input:radio[name=oneroso]:checked").val(); // Valida que alguno de los 2 este selecionado
  var benefOneroso = document.getElementById("benefOneroso").value;
  var TokenPrevisora = document.getElementById("previsoraToken").value;
  var intermediario = document.getElementById("intermediario").value;

  /**
   * Variables para SBS
   */
  var cre_sbs_usuario = document.getElementById("cre_sbs_usuario").value;
  var cre_sbs_contrasena = document.getElementById("cre_sbs_contrasena").value;


  /**
   * Variables para ESTADO
   */
  var cre_est_usuario = document.getElementById("cre_est_usuario").value;
  var cre_equ_contrasena = document.getElementById("cre_equ_contrasena").value;
  var Cre_Est_Entity_Id = document.getElementById("Cre_Est_Entity_Id").value;
  var cre_est_zona = document.getElementById("cre_est_zona").value;


  /**
   * Variables para Allianz
   */

  var cre_alli_sslcertfile = document.getElementById("cre_alli_sslcertfile").value;
  var cre_alli_sslkeyfile = document.getElementById("cre_alli_sslkeyfile").value;
  var cre_alli_passphrase = document.getElementById("cre_alli_passphrase").value;
  var cre_alli_partnerid = document.getElementById("cre_alli_partnerid").value;
  var cre_alli_agentid = document.getElementById("cre_alli_agentid").value;
  var cre_alli_partnercode = document.getElementById("cre_alli_partnercode").value;
  var cre_alli_agentcode = document.getElementById("cre_alli_agentcode").value;

  /**
   * Variables de AXA
   */
  var cre_axa_sslcertfile = document.getElementById("cre_axa_sslcertfile").value;
  var cre_axa_sslkeyfile = document.getElementById("cre_axa_sslkeyfile").value;

  var cre_axa_passphrase = document.getElementById("cre_axa_passphrase").value;
  var cre_axa_codigoDistribuidor = document.getElementById("cre_axa_codigoDistribuidor").value;

  var cre_axa_idTipoDistribuidor = document.getElementById("cre_axa_idTipoDistribuidor").value;
  var cre_axa_codigoDivipola = document.getElementById("cre_axa_codigoDivipola").value;

  var cre_axa_canal = document.getElementById("cre_axa_canal").value;
  var cre_axa_validacionEventos = document.getElementById("cre_axa_validacionEventos").value;
  var url_axa =document.getElementById("url_axa").value;

  /**
   * Variables para Bolivar
   */
  var cre_bol_api_key = document.getElementById("cre_bol_api_key").value;
  var cre_bol_claveAsesor = document.getElementById("cre_bol_claveAsesor").value;

  /**
   * Variables de Solidaria
   */
  var cre_sol_cod_sucursal = document.getElementById("cre_sol_cod_sucursal").value;
  var cre_sol_cod_per = document.getElementById("cre_sol_cod_per").value;
  var cre_sol_cod_tipo_agente = document.getElementById("cre_sol_cod_tipo_agente").value;
  var cre_sol_cod_agente = document.getElementById("cre_sol_cod_agente").value;
  var cre_sol_cod_pto_vta = document.getElementById("cre_sol_cod_pto_vta").value;
  var cre_sol_grant_type = document.getElementById("cre_sol_grant_type").value;
  var cre_sol_Cookie_token = document.getElementById("cre_sol_Cookie_token").value;
  var cre_sol_token = document.getElementById("cre_sol_token").value;
  var cre_sol_fecha_token = document.getElementById("cre_sol_fecha_token").value;


  
  if (ciudadCirculacion.length == 4) {
    ciudadCirculacion = "0" + ciudadCirculacion;
  } else if (ciudadCirculacion.length == 3) {
    ciudadCirculacion = "00" + ciudadCirculacion;
  }

  if (
    fasecoldaVeh != "" &&
    valorFasecolda != "" &&
    tipoUsoVehiculo != "" &&
    tipoServicio != "" &&
    DptoCirculacion != "" &&
    ciudadCirculacion != "" &&
    isBenefOneroso != undefined
  ) {
    if (
      placa != "" &&
      tipoDocumentoID != "" &&
      numDocumentoID != "" &&
      Nombre != "" &&
      Apellido1 != "" &&
      dia != "" &&
      mes != "" &&
      anio != "" &&
      Genero != "" &&
      estadoCivil != ""
    ) {
      $("#loaderOferta").html(
        '<img src="vistas/img/plantilla/loader-update.gif" width="34" height="34"><strong> Consultando Ofertas...</strong>'
      );
      $("#loaderRecotOferta").html(
        '<img src="vistas/img/plantilla/loader-update.gif" width="34" height="34"><strong> Recotizando Ofertas...</strong>'
      );

      var myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/json");

      var raw = {
        Placa: placa,
        ceroKm: esCeroKm,
        TipoIdentificacion: tipoDocumentoID,
        NumeroIdentificacion: numDocumentoID,
        Nombre: Nombre,
        Apellido: Apellido1,
        Genero: Genero,
        FechaNacimiento: FechaNacimiento,
        EstadoCivil: estadoCivil,
        NumeroTelefono: celularAseg,
        Direccion: direccionAseg,
        Email: emailAseg,
        ZonaCirculacion: DptoCirculacion,
        CodigoMarca: CodigoMarca,
        CodigoLinea: CodigoLinea,
        CodigoClase: CodigoClase,
        CodigoFasecolda: fasecoldaVeh,
        Modelo: modeloVeh,
        ValorAsegurado: valorFasecolda,
        LimiteRC: LimiteRC,
        Cobertura: CoberturaEstado,
        ValorAccesorios: ValorAccesorios,
        CiudadBolivar: ciudadCirculacion,
        tipoServicio: tipoServicio,
        CodigoVerificacion: CodigoVerificacion,
        Apellido2: Apellido2,
        AniosSiniestro: AniosSiniestro,
        AniosAsegurados: AniosAsegurados,
        NivelEducativo: NivelEducativo,
        Estrato: Estrato,
        TokenPrevisora: TokenPrevisora,
        intermediario: intermediario,
        SBS: {
          cre_sbs_usuario: cre_sbs_usuario,
          cre_sbs_contrasena: cre_sbs_contrasena
        },
        ALLIANZ: {
          cre_alli_sslcertfile: cre_alli_sslcertfile,
          cre_alli_sslkeyfile: cre_alli_sslkeyfile,
          cre_alli_passphrase: cre_alli_passphrase,
          cre_alli_partnerid: cre_alli_partnerid,
          cre_alli_agentid: cre_alli_agentid,
          cre_alli_partnercode: cre_alli_partnercode,
          cre_alli_agentcode: cre_alli_agentcode
        },
        ESTADO: {
          cre_est_usuario: cre_est_usuario,
          cre_equ_contrasena: cre_equ_contrasena,
          Cre_Est_Entity_Id: Cre_Est_Entity_Id,
          cre_est_zona: cre_est_zona
        },
        Bolivar: {
          cre_bol_api_key: cre_bol_api_key,
          cre_bol_claveAsesor: cre_bol_claveAsesor
        },
        AXA: {
          cre_axa_sslcertfile: cre_axa_sslcertfile,
          cre_axa_sslkeyfile: cre_axa_sslkeyfile,
          cre_axa_passphrase: cre_axa_passphrase,
          cre_axa_codigoDistribuidor: cre_axa_codigoDistribuidor,
          cre_axa_idTipoDistribuidor: cre_axa_idTipoDistribuidor,
          cre_axa_codigoDivipola: cre_axa_codigoDivipola,
          cre_axa_canal: cre_axa_canal,
          cre_axa_validacionEventos: cre_axa_validacionEventos,
          url_axa:url_axa
        },
        SOLIDARIA: {
          cre_sol_cod_sucursal: cre_sol_cod_sucursal,
          cre_sol_cod_per: cre_sol_cod_per,
          cre_sol_cod_tipo_agente: cre_sol_cod_tipo_agente,
          cre_sol_cod_agente: cre_sol_cod_agente,
          cre_sol_cod_pto_vta: cre_sol_cod_pto_vta,
          cre_sol_grant_type: cre_sol_grant_type,
          cre_sol_Cookie_token: cre_sol_Cookie_token,
          cre_sol_token: cre_sol_token,
          cre_sol_fecha_token: cre_sol_fecha_token
      },

      };

      var requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: JSON.stringify(raw),
        redirect: "follow",
      };

      if (!primerIntentoRealizado) {
        primerIntentoRealizado = true
        $.ajax({
          type: "POST",
          url: "src/insertarCotizacion.php",
          dataType: "json",
          data: {
            placa: placa,
            esCeroKm: esCeroKmInt,
            idCliente: idCliente,
            tipoDocumento: tipoDocumentoID,
            numIdentificacion: numDocumentoID,
            Nombre: Nombre,
            Apellido: Apellido1,
            FechaNacimiento: FechaNacimiento,
            Genero: Genero,
            EstadoCivil: estadoCivil,
            Celular: celularAseg,
            Correo: emailAseg,
            direccionAseg: direccionAseg,
            CodigoClase: "1",
            Clase: claseVeh,
            Marca: marcaVeh,
            Modelo: modeloVeh,
            Linea: lineaVeh,
            Fasecolda: fasecoldaVeh,
            ValorAsegurado: valorFasecolda,
            tipoUsoVehiculo: tipoUsoVehiculo,
            tipoServicio: tipoServicio,
            Departamento: DptoCirculacion,
            Ciudad: ciudadCirculacion,
            benefOneroso: benefOneroso,
            idCotizacion: idCotizacion,
            mundial: null
          },
          cache: false,
          success: function (data) {
            const contenParrilla = document.querySelector('#contenParrilla')
            contenParrilla.style.display = 'block'
            idCotizacion = data.id_cotizacion;
            raw.cotizacion = idCotizacion
            console.log(idCotizacion)

            var requestOptions = {
              method: "POST",
              headers: myHeaders,
              body: JSON.stringify(raw),
              redirect: "follow",
            };

            let cont = [];
            const mostrarAlertaCotizacionExitosa = aseguradora => {
              document.querySelector('.exitosas').innerHTML += `<span style="margin-right: 15px;"><i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;
                    "></i>${aseguradora}</span>
                    `
            }

            const mostrarAlertarCotizacionFallida = (aseguradora, mensaje) => {
              document.querySelector('.fallidas').innerHTML += `<p><i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i><b>${aseguradora}:</b> ${mensaje}</p>`
            }

  
            /* Solidaria */
            // cont.push(
            //   fetch(
            //     "https://grupoasistencia.com/motor_webservice_tst/Solidaria",
            //     requestOptions
            //   )
            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       console.log('Ofertas de Solidaria:', ofertas[0].Resultado); // Imprime las ofertas en la consola
            //       if (typeof ofertas[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Solidaria')
            //         ofertas[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Solidaria', mensaje)
            //         })
            //       } else {
            //         validarOfertas(ofertas);
            //         mostrarAlertaCotizacionExitosa('Solidaria')
            //       }
            //     })
            //     .catch((err) => {
            //       console.error(err);
            //     })
            // );

            /* Mapfre */
            // cont.push(

            //   fetch("https://grupoasistencia.com/motor_webservice_tst/mapfrecotizacion4", requestOptions)

            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       console.log(ofertas)
            //       let result = []
            //       result.push(ofertas)

            //       if (typeof ofertas[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Mapfre')
            //         ofertas[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Mapfre', mensaje)
            //         })

            //       } else {

            //         validarOfertas(ofertas);
            //         // let successMap = true;
            //         // if (successMap) {
            //           mostrarAlertaCotizacionExitosa('Mapfre')
            //           // successMap = false
            //         // }
            //       }
            //     })
            //     .catch((err) => {
            //       agregarAseguradoraFallida('SBS')
            //       console.error(err);
            //     })
            // );

            /* Previsora */
            // cont.push(
            //   fetch("https://grupoasistencia.com/motor_webservice_tst/Previsora", requestOptions)
            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       console.log(ofertas)
            //       if (typeof ofertas[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Previsora')
            //         ofertas[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Previsora', mensaje)
            //         })
            //       } else {
            //         validarOfertas(ofertas);
            //         mostrarAlertaCotizacionExitosa('Previsora')
            //       }
            //     })
            //     .catch((err) => {
            //       console.error(err);
            //     })
            // );

            /* Equidad */
            // cont.push(
            //   fetch("https://grupoasistencia.com/motor_webservice_tst/Equidad", requestOptions)
            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       if (typeof ofertas[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Equidad')
            //         ofertas[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Equidad', mensaje)
            //         })
            //       } else {
            //         validarOfertas(ofertas);
            //         mostrarAlertaCotizacionExitosa('Equidad')
            //       }
            //     })
            //     .catch((err) => {
            //       console.error(err);
            //     })
            // );

            /* Bolivar */
            cont.push(
              fetch("https://grupoasistencia.com/motor_webservice_tst/Bolivar", requestOptions)
                .then((res) => {
                  if (!res.ok) throw Error(res.statusText);
                  return res.json();
                })
                .then((ofertas) => {
                  console.log(ofertas)
                  if (typeof ofertas[0].Resultado !== 'undefined') {
                    agregarAseguradoraFallida('Bolivar')
                    ofertas[0].Mensajes.forEach(mensaje => {
                      mostrarAlertarCotizacionFallida('Bolivar', mensaje)
                    })
                  } else {
                    validarOfertas(ofertas);
                    mostrarAlertaCotizacionExitosa('Bolivar')
                  }
                })
                .catch((err) => {
                  console.error(err);
                })
            );

            /* HDI */
            // cont.push(
            //   fetch("https://grupoasistencia.com/motor_webservice_tst/HDI", requestOptions)
            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       console.log(ofertas[0].estado)
            //       if (typeof ofertas[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('HDI')
            //         ofertas[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('HDI', mensaje)
            //         })
            //       } else {
            //         console.log('Here2')
            //         let result = []
            //         result.push(ofertas[0])
            //         validarOfertas(result)
            //         mostrarAlertaCotizacionExitosa('HDI')
            //       }
            //     })
            //     .catch((err) => {
            //       console.error(err);
            //     })
            // );

            let zurichErrors = true
            let zurichSuccess = true

            /* Zurich */
            // const planes = ["BASIC", "MEDIUM", "FULL"]
            // let body = JSON.parse(requestOptions.body)
            // planes.forEach(plan => {
            //   body.plan = plan
            //   body.Email = "@gmail.com"
            //   body.Email2 = Math.round(Math.random() * 999999) + body.Email
            //   console.log(body.Email2)
            //   requestOptions.body = JSON.stringify(body)
            //   cont.push(
            //     fetch('https://grupoasistencia.com/motor_webservice_tst/Zurich', requestOptions)
            //       .then((res) => {
            //         if (res.status === 500) {
            //             throw Error("Error interno del servidor (HTTP 500)");
            //         }
            //         if (!res.ok) {
            //             throw Error(res.statusText);
            //         }
            //         return res.json();
            //       })
            //       .then(ofertas => {
            //         if (typeof ofertas.Resultado !== 'undefined') {
            //           agregarAseguradoraFallida('Zurich')
            //           if (zurichErrors) {
            //             ofertas.Mensajes.forEach(mensaje => {
            //               mostrarAlertarCotizacionFallida(`Zurich ${plan}`, mensaje)
            //             })
            //           }
            //           zurichErrors = false
            //         } else {
            //           validarOfertas(ofertas)
            //           if (zurichSuccess) {
            //             mostrarAlertaCotizacionExitosa('Zurich')
            //             zurichSuccess = false
            //           }
            //         }
            //       })
            //       .catch(err => console.error(err))
            //   )
            // })

            let successEstado = true

            /* Estado */
            // cont.push(
            //   fetch("https://grupoasistencia.com/motor_webservice_tst/Estado", requestOptions)
            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       let result = []
            //       result.push(ofertas)
            //       if (typeof result[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Estado')
            //         result[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Estado', mensaje)
            //         })
            //       } else {
            //         validarOfertas(result);
            //         if (successEstado) {
            //           mostrarAlertaCotizacionExitosa('Estado')
            //           successEstado = false
            //         }
            //       }
            //     })
            //     .catch((err) => {
            //       console.error(err);
            //     })
            // );

            /* Estado2 */
            // cont.push(
            //   fetch("https://grupoasistencia.com/motor_webservice_tst/Estado2", requestOptions)
            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       let result = []
            //       result.push(ofertas)
            //       if (typeof result[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Zurich2')
            //         result[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Estado', mensaje)
            //         })
            //       } else {
            //         validarOfertas(result);
            //         if (successEstado) {
            //           mostrarAlertaCotizacionExitosa('Estado')
            //           successEstado = false
            //         }
            //       }
            //     })
            //     .catch((err) => {
            //       console.error(err);
            //     })
            // );

            /* Liberty */
          //   if (condicional== 4 || condicional== 10 || condicional== 11 || condicional== 12 || condicional== 13 || condicional== 14 || condicional== 22) {
          //     let planesLiberty = ["Full","Integral"];
          //     let body = JSON.parse(requestOptions.body)
          //     planesLiberty.forEach(plan => {
          //       body.plan = plan
          //       requestOptions.body = JSON.stringify(body)
              
          //       fetch("https://grupoasistencia.com/motor_webservice_tst/Liberty", requestOptions)
          //         .then((res) => {
          //           if (!res.ok) throw Error(res.statusText);
          //           return res.json();
          //         })
          //         .then((ofertas) => {
          //           if (typeof ofertas[0].Resultado !== 'undefined') {
          //             agregarAseguradoraFallida(`Liberty ${plan}`);
          //             ofertas[0].Mensajes.forEach(mensaje => {
          //               mostrarAlertarCotizacionFallida(`Liberty ${plan}`, mensaje);
          //             });
          //           } else {
          //             validarOfertas(ofertas);
          //             mostrarAlertaCotizacionExitosa(`Liberty ${plan}`);
          //           }
          //         })
          //         .catch((err) => {
          //           console.error(err);
          //         });
          //     });
              
          // } 
          // else {

          //   fetch("https://grupoasistencia.com/motor_webservice_tst/Liberty", requestOptions)
          //   .then((res) => {
          //     if (!res.ok) throw Error(res.statusText);
          //     return res.json();
          //   })
          //   .then((ofertas) => {
          //     if (typeof ofertas[0].Resultado !== 'undefined') {
          //       agregarAseguradoraFallida('Liberty')
          //       ofertas[0].Mensajes.forEach(mensaje => {
          //         mostrarAlertarCotizacionFallida('Liberty', mensaje)
          //       })
          //     } else {
          //       console.log(ofertas)
          //       validarOfertas(ofertas);
          //       mostrarAlertaCotizacionExitosa('Liberty')
          //     }
          //   })
          //   .catch((err) => {
          //     console.error(err);
          //   });

          // }
          //Liberty
          // cont.push(
          //   fetch("https://grupoasistencia.com/motor_webservice_tst/Liberty", requestOptions)
          //     .then((res) => {
          //       if (res.status === 500) {
          //           throw Error("Error interno del servidor (HTTP 500)");
          //       }
          //       if (!res.ok) {
          //           throw Error(res.statusText);
          //       }
          //       return res.json();
          //     })
          //     .then((ofertas) => {
          //       if (typeof ofertas[0].Resultado !== 'undefined') {
          //         agregarAseguradoraFallida('Liberty')
          //         ofertas[0].Mensajes.forEach(mensaje => {
          //           mostrarAlertarCotizacionFallida('Liberty', mensaje)
          //         })
          //       } else {
          //         validarOfertas(ofertas);
          //         mostrarAlertaCotizacionExitosa('Liberty')
          //       }
          //     })
          //     .catch((err) => {
          //       console.error(err);
          //     })
          // );

            /* Allianz */
            // cont.push(
            //   fetch("https://grupoasistencia.com/motor_webservice_tst/Allianz", requestOptions)
            //     .then((res) => {
            //       if (res.status === 500) {
            //           throw Error("Error interno del servidor (HTTP 500)");
            //       }
            //       if (!res.ok) {
            //           throw Error(res.statusText);
            //       }
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       if (typeof ofertas[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Allianz')
            //         ofertas[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Allianz', mensaje)
            //         })
            //       } else {
            //         validarOfertas(ofertas)
            //         mostrarAlertaCotizacionExitosa('Allianz')
            //       }
            //     })
            //     .catch((err) => {
            //       console.error(err);
            //     })
            // );

            /* AXA */
            // cont.push(
            //   fetch("https://grupoasistencia.com/motor_webservice_tst/AXA_tst", requestOptions)
            //     .then((res) => {
            //       if (res.status === 500) {
            //           throw Error("Error interno del servidor (HTTP 500)");
            //       }
            //       if (!res.ok) {
            //           throw Error(res.statusText);
            //       }
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       if (typeof ofertas[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('AXA')
            //         ofertas[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('AXA', mensaje)
            //         })
            //       } else {
            //         validarOfertas(ofertas)
            //         mostrarAlertaCotizacionExitosa('AXA')
            //       }
            //     })
            //     .catch((err) => {
            //       console.error(err);
            //     })
            // );
            

            /* SBS */
            // cont.push(
            //   fetch("https://grupoasistencia.com/motor_webservice_tst/SBS", requestOptions)
            //     .then((res) => {
            //       if (res.status === 500) {
            //           throw Error("Error interno del servidor (HTTP 500)");
            //       }
            //       if (!res.ok) {
            //           throw Error(res.statusText);
            //       }
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       let result = ofertas
            //       if (typeof result[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('SBS')
            //         result[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('SBS', mensaje)
            //         })
            //       } else {
            //         validarOfertas(result);
            //         mostrarAlertaCotizacionExitosa('SBS')
            //       }
            //     })
            //     .catch((err) => {
            //       console.error(err);
            //     })
            // );


            Promise.all(cont).then(() => {
              $("#btnCotizar").hide();
              $("#loaderOferta").html("");
              $("#loaderRecotOferta").html("");
              swal.fire({
                type: "success",
                title: "! Cotización Exitosa ¡",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
              });
              setTimeout(function () {
                //  window.location = "index.php?ruta=editar-cotizacion&idCotizacion=" + idCotizacion;
              }, 3000);

              console.log("Se completo todo");
              document.querySelector('.button-recotizar').style.display = 'block'
              /* Se monta el botón para generar el pdf con 
              el valor de la variable idCotizacion */
              const contentCotizacionPDF = document.querySelector('#contenCotizacionPDF')
              contentCotizacionPDF.innerHTML = `  
                                                <div class="col-xs-12" style="width: 100%;">
                                                  <div class="row align-items-center">
                                                      <div class="col-xs-4">
                                                          <label for="checkboxAsesor">¿Deseas agregar tus datos como asesor en la cotización?</label>
                                                          <input class="form-check-input" type="checkbox" id="checkboxAsesor" style="margin-left: 10px;" checked>
                                                      </div>
                                                      <div class="col-xs-4">
                                                          <button type="button" class="btn btn-danger" id="btnParrillaPDF">
                                                              <span class="fa fa-file-text"></span> Generar PDF de Cotización
                                                          </button>
                                                      </div>
                                                  </div>
                                                </div>
                                                    `
              $("#btnParrillaPDF").click(function () {
                const todosOn = $(".classSelecOferta:checked").length;
                const idCotizacionPDF = idCotizacion;
                const checkboxAsesor = $("#checkboxAsesor");

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
                      title: "¡Debes seleccionar mínimo una oferta!",
                    });
                  } else {

                    let url = `extensiones/tcpdf/pdf/comparador.php?cotizacion=${idCotizacionPDF}`;
                    if (checkboxAsesor.is(":checked")) {
                      url += "&generar_pdf=1";
                    }
                    window.open(url, "_blank");

                    //   window.open("extensiones/tcpdf/pdf/comparador.php?cotizacion=" + idCotizacionPDF,"_blank");

                  }
                }
              });
            });

            /*fetch("http://localhost/webservice_autosv1/Cotizar", requestOptions)
              .then(function (response) {
                if (!response.ok) {
                  throw Error(response.statusText);
                }
                return response.json();
              })
              .then(function (ofertas) {
                validarOfertas(ofertas);
              })
              .catch(function (error) {
                console.log('Parece que hubo un problema: \n', error);
  
                contErrProtocoloCotizar++;
                if (contErrProtocoloCotizar > 1) {
  
                  $('#loaderOferta').html('');
                  $('#loaderRecotOferta').html('');
                }
                else {
                  setTimeout(cotizarOfertas, 4000);
                }
  
              })
              .finally(() => {
                  fetch('http://localhost/webservice_autosv1/Solidaria', requestOptions)
                  .then(res => {
                      console.log(res)
                      return res.json()
                  }).then(resJson => {
                      console.log(resJson)
                      validarOfertas(resJson)
                  }).catch(err => {
                      console.log(err)
                  })
              });*/

            // cotizarOfertaSBS(requestOptions);
          }

        });

      } else {
        const contenParrilla = document.querySelector('#contenParrilla')
        raw.cotizacion = idCotizacion

        var requestOptions = {
          method: "POST",
          headers: myHeaders,
          body: JSON.stringify(raw),
          redirect: "follow",
        };
        let cont = [];

        const mostrarAlertaCotizacionExitosa = aseguradora => {
          document.querySelector('.exitosas').innerHTML += `<span style="margin-right: 15px;"><i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;
                    "></i>${aseguradora}</span>
                    `
        }

        const mostrarAlertarCotizacionFallida = (aseguradora, mensaje) => {
          document.querySelector('.fallidas').innerHTML += `<p><i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i><b>${aseguradora}:</b> ${mensaje}</p>`
        }

        /* Solidaria */
        if (comprobarFallida('Solidaria')) {
          cont.push(
            fetch(
              "https://grupoasistencia.com/motor_webservice/Solidaria",
              requestOptions
            )
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                console.log(ofertas)
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Solidaria')
                } else {
                  validarOfertas(ofertas);
                  mostrarAlertaCotizacionExitosa('Solidaria')
                  eliminarAseguradoraFallida('Solidaria')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }


        /* Previsora */
        if (comprobarFallida('Previsora')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/Previsora", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Previsora')
                } else {
                  validarOfertas(ofertas);
                  mostrarAlertaCotizacionExitosa('Previsora')
                  eliminarAseguradoraFallida('Previsora')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        /* Equidad */
        if (comprobarFallida('Equidad')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/Equidad", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Equidad')
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('Equidad', mensaje)
                  })
                } else {
                  validarOfertas(ofertas);
                  mostrarAlertaCotizacionExitosa('Equidad')
                  eliminarAseguradoraFallida('Equidad')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        if (comprobarFallida('Mapfre')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/mapfrecotizacion4", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Mapfre')
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('Mapfre', mensaje)
                  })
                } else {
                  validarOfertas(ofertas);
                  mostrarAlertaCotizacionExitosa('Mapfre')
                  eliminarAseguradoraFallida('Mapfre')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }


        /* Bolivar */
        if (comprobarFallida('Bolivar')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/Bolivar", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                console.log(ofertas)
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Bolivar')
                } else {
                  validarOfertas(ofertas);
                  mostrarAlertaCotizacionExitosa('Bolivar')
                  eliminarAseguradoraFallida('Bolivar')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        /* HDI */
        if (comprobarFallida('HDI')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/HDI", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('HDI')
                } else {
                  console.log('Here2')
                  let result = []
                  result.push(ofertas[0])
                  validarOfertas(result)
                  mostrarAlertaCotizacionExitosa('HDI')
                  eliminarAseguradoraFallida('HDI')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        let zurichErrors = true
        let zurichSuccess = true

        /* Zurich */
        if (comprobarFallida('Zurich')) {
          const planes = ["BASIC", "MEDIUM", "FULL"]
          let body = JSON.parse(requestOptions.body)
          planes.forEach(plan => {
            body.plan = plan
            body.Email = Math.round(Math.random() * 999999) + body.Email
            requestOptions.body = JSON.stringify(body)
            cont.push(
              fetch('https://grupoasistencia.com/motor_webservice/Zurich', requestOptions)
                .then(res => {
                  if (!res.ok) throw Error(res.statusText)
                  return res.json()
                })
                .then(ofertas => {
                  if (typeof ofertas.Resultado !== 'undefined') {
                    agregarAseguradoraFallida('Zurich')
                    zurichErrors = false
                  } else {
                    validarOfertas(ofertas)
                    if (zurichSuccess) {
                      mostrarAlertaCotizacionExitosa('Zurich')
                      eliminarAseguradoraFallida('Zurich')
                      zurichSuccess = false
                    }
                  }
                })
                .catch(err => console.error(err))
            )
          })
        }

        let successEstado = true

        /* Estado */
        if (comprobarFallida('Estado')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/Estado", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                let result = []
                result.push(ofertas)
                if (typeof result[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Estado')
                } else {
                  validarOfertas(result);
                  if (successEstado) {
                    mostrarAlertaCotizacionExitosa('Estado')
                    eliminarAseguradoraFallida('Estado')
                    successEstado = false
                  }
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        /* Estado2 */
        if (comprobarFallida('Estado2')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/Estado2", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                let result = []
                result.push(ofertas)
                if (typeof result[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Zurich2')
                } else {
                  validarOfertas(result);
                  if (successEstado) {
                    mostrarAlertaCotizacionExitosa('Estado')
                    eliminarAseguradoraFallida('Estado')
                    successEstado = false
                  }
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        /* Liberty */
        if (comprobarFallida('Liberty')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/Liberty", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Liberty')
                } else {
                  validarOfertas(ofertas);
                  mostrarAlertaCotizacionExitosa('Liberty')
                  eliminarAseguradoraFallida('Liberty')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        /* Allianz */
        if (comprobarFallida('Allianz')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/Allianz", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                console.log(res);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Allianz')
                } else {
                  validarOfertas(ofertas)
                  mostrarAlertaCotizacionExitosa('Allianz')
                  eliminarAseguradoraFallida('Allianz')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        /* AXA */
        if (comprobarFallida('AXA')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/AXA", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('AXA')
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('AXA', mensaje)
                  })
                } else {
                  validarOfertas(ofertas)
                  mostrarAlertaCotizacionExitosa('AXA')
                  eliminarAseguradoraFallida('AXA')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        /* SBS */
        if (comprobarFallida('SBS')) {
          cont.push(
            fetch("https://grupoasistencia.com/motor_webservice/SBS", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                let result = ofertas
                if (typeof result[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('SBS')
                } else {
                  validarOfertas(result);
                  mostrarAlertaCotizacionExitosa('SBS')
                  eliminarAseguradoraFallida('SBS')
                }
              })
              .catch((err) => {
                console.error(err);
              })
          );
        }

        Promise.all(cont).then(() => {
          $("#loaderOferta").html("");
          $("#loaderRecotOferta").html("");
          swal({
            type: "success",
            title: "! Re cotización completada ¡",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
          });
          console.log("Se completo la re-cotización");
        });

        /*fetch("http://localhost/webservice_autosv1/Cotizar", requestOptions)
          .then(function (response) {
            if (!response.ok) {
              throw Error(response.statusText);
            }
            return response.json();
          })
          .then(function (ofertas) {
            validarOfertas(ofertas);
          })
          .catch(function (error) {
            console.log('Parece que hubo un problema: \n', error);
 
            contErrProtocoloCotizar++;
            if (contErrProtocoloCotizar > 1) {
 
              $('#loaderOferta').html('');
              $('#loaderRecotOferta').html('');
            }
            else {
              setTimeout(cotizarOfertas, 4000);
            }
 
          })
          .finally(() => {
              fetch('http://localhost/webservice_autosv1/Solidaria', requestOptions)
              .then(res => {
                  console.log(res)
                  return res.json()
              }).then(resJson => {
                  console.log(resJson)
                  validarOfertas(resJson)
              }).catch(err => {
                  console.log(err)
              })
          });*/

        // cotizarOfertaSBS(requestOptions);
      }

      const mostrarAlertarCotizacionFallida = (aseguradora, mensaje) => {
        document.querySelector('.fallidas').innerHTML += `<p><i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i><b>${aseguradora}:</b> ${mensaje}</p>`
      }

      /* Solidaria */
      if (comprobarFallida('Solidaria')) {
        cont.push(
          fetch("https://grupoasistencia.com/motor_webservice/Solidaria", requestOptions)
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            }).then((ofertas) => {
              console.log(ofertas)
              if (typeof ofertas[0].Resultado !== 'undefined') {
                agregarAseguradoraFallida('Solidaria')
              } else {
                validarOfertas(ofertas);
                mostrarAlertaCotizacionExitosa('Solidaria')
                eliminarAseguradoraFallida('Solidaria')
              }
            }).catch((err) => {
              console.error(err);
            })
        );
      }


      /* Previsora */
      if (comprobarFallida('Previsora')) {
        cont.push(fetch("https://grupoasistencia.com/motor_webservice/Previsora", requestOptions)
          .then((res) => {
            if (!res.ok) throw Error(res.statusText);
            return res.json();
          }).then((ofertas) => {
            if (typeof ofertas[0].Resultado !== 'undefined') {
              agregarAseguradoraFallida('Previsora')
            } else {
              validarOfertas(ofertas);
              mostrarAlertaCotizacionExitosa('Previsora')
              eliminarAseguradoraFallida('Previsora')
            }
          })
          .catch((err) => {
            console.error(err);
          })
        );
      }

      /* Equidad */
      // if (comprobarFallida('Equidad')) {
      //     cont.push(
      //       fetch("https://grupoasistencia.com/webservicepruebasIntegrador2/Equidad", requestOptions)
      //         .then((res) => {
      //           if (!res.ok) throw Error(res.statusText);
      //           return res.json();
      //         })
      //         .then((ofertas) => {
      //           if (typeof ofertas[0].Resultado !== 'undefined') {
      //               agregarAseguradoraFallida('Equidad')
      //               ofertas[0].Mensajes.forEach(mensaje => {
      //                   mostrarAlertarCotizacionFallida('Equidad', mensaje)
      //               })
      //           } else {
      //             validarOfertas(ofertas);
      //             mostrarAlertaCotizacionExitosa('Equidad')
      //             eliminarAseguradoraFallida('Equidad')
      //           }
      //         })
      //         .catch((err) => {
      //           console.error(err);
      //         })
      //     );
      // }

      /* Bolivar */
      if (comprobarFallida('Bolivar')) {
        cont.push(
          fetch("https://grupoasistencia.com/motor_webservice/Bolivar", requestOptions)
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            })
            .then((ofertas) => {
              console.log(ofertas)
              if (typeof ofertas[0].Resultado !== 'undefined') {
                agregarAseguradoraFallida('Bolivar')
              } else {
                validarOfertas(ofertas);
                mostrarAlertaCotizacionExitosa('Bolivar')
                eliminarAseguradoraFallida('Bolivar')
              }
            })
            .catch((err) => {
              console.error(err);
            })
        );
      }

      /* HDI */
      if (comprobarFallida('HDI')) {
        cont.push(
          fetch("https://grupoasistencia.com/motor_webservice/HDI", requestOptions)
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            })
            .then((ofertas) => {
              if (typeof ofertas[0].Resultado !== 'undefined') {
                agregarAseguradoraFallida('HDI')
              } else {
                console.log('Here2')
                let result = []
                result.push(ofertas[0])
                validarOfertas(result)
                mostrarAlertaCotizacionExitosa('HDI')
                eliminarAseguradoraFallida('HDI')
              }
            })
            .catch((err) => {
              console.error(err);
            })
        );
      }

      let zurichErrors = true
      let zurichSuccess = true

      /* Zurich */
      if (comprobarFallida('Zurich')) {
        const planes = ["BASIC", "MEDIUM", "FULL"]
        let body = JSON.parse(requestOptions.body)
        planes.forEach(plan => {
          body.plan = plan
          body.Email = Math.round(Math.random() * 999999) + body.Email
          requestOptions.body = JSON.stringify(body)
          cont.push(
            fetch('https://grupoasistencia.com/motor_webservice/Zurich', requestOptions)
              .then(res => {
                if (!res.ok) throw Error(res.statusText)
                return res.json()
              })
              .then(ofertas => {
                if (typeof ofertas.Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Zurich')
                  zurichErrors = false
                } else {
                  validarOfertas(ofertas)
                  if (zurichSuccess) {
                    mostrarAlertaCotizacionExitosa('Zurich')
                    eliminarAseguradoraFallida('Zurich')
                    zurichSuccess = false
                  }
                }
              })
              .catch(err => console.error(err))
          )
        })
      }

      let successEstado = true

      /* Estado */
      if (comprobarFallida('Estado')) {
        cont.push(
          fetch("https://grupoasistencia.com/motor_webservice/Estado", requestOptions)
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            })
            .then((ofertas) => {
              let result = []
              result.push(ofertas)
              if (typeof result[0].Resultado !== 'undefined') {
                agregarAseguradoraFallida('Estado')
              } else {
                validarOfertas(result);
                if (successEstado) {
                  mostrarAlertaCotizacionExitosa('Estado')
                  eliminarAseguradoraFallida('Estado')
                  successEstado = false
                }
              }
            })
            .catch((err) => {
              console.error(err);
            })
        );
      }

      /* Estado2 */
      if (comprobarFallida('Estado2')) {
        cont.push(
          fetch("https://grupoasistencia.com/motor_webservice/Estado2", requestOptions)
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            })
            .then((ofertas) => {
              let result = []
              result.push(ofertas)
              if (typeof result[0].Resultado !== 'undefined') {
                agregarAseguradoraFallida('Zurich2')
              } else {
                validarOfertas(result);
                if (successEstado) {
                  mostrarAlertaCotizacionExitosa('Estado')
                  eliminarAseguradoraFallida('Estado')
                  successEstado = false
                }
              }
            })
            .catch((err) => {
              console.error(err);
            })
        );
      }

      /* Liberty */
      if (comprobarFallida('Liberty')) {
        cont.push(
          fetch("https://grupoasistencia.com/motor_webservice/Liberty", requestOptions)
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            })
            .then((ofertas) => {
              if (typeof ofertas[0].Resultado !== 'undefined') {
                agregarAseguradoraFallida('Liberty')
              } else {
                validarOfertas(ofertas);
                mostrarAlertaCotizacionExitosa('Liberty')
                eliminarAseguradoraFallida('Liberty')
              }
            })
            .catch((err) => {
              console.error(err);
            })
        );
      }

      /* Allianz */
      if (comprobarFallida('Allianz')) {
        cont.push(
          fetch("https://grupoasistencia.com/motor_webservice/Allianz", requestOptions)
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              console.log(res);
              return res.json();
            })
            .then((ofertas) => {
              if (typeof ofertas[0].Resultado !== 'undefined') {
                agregarAseguradoraFallida('Allianz')
              } else {
                validarOfertas(ofertas)
                mostrarAlertaCotizacionExitosa('Allianz')
                eliminarAseguradoraFallida('Allianz')
              }
            })
            .catch((err) => {
              console.error(err);
            })
        );
      }

      /* AXA */
      if (comprobarFallida('AXA')) {
        cont.push(
          fetch("https://grupoasistencia.com/motor_webservice/AXA", requestOptions)
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            })
            .then((ofertas) => {
              if (typeof ofertas[0].Resultado !== 'undefined') {
                agregarAseguradoraFallida('AXA')
                ofertas[0].Mensajes.forEach(mensaje => {
                  mostrarAlertarCotizacionFallida('AXA', mensaje)
                })
              } else {
                validarOfertas(ofertas)
                mostrarAlertaCotizacionExitosa('AXA')
                eliminarAseguradoraFallida('AXA')
              }
            })
            .catch((err) => {
              console.error(err);
            })
        );
      }

      /* SBS */
      if (comprobarFallida('SBS')) {
        cont.push(
          fetch("https://grupoasistencia.com/motor_webservice/SBS", requestOptions)
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            })
            .then((ofertas) => {
              let result = ofertas
              if (typeof result[0].Resultado !== 'undefined') {
                agregarAseguradoraFallida('SBS')
              } else {
                validarOfertas(result);
                mostrarAlertaCotizacionExitosa('SBS')
                eliminarAseguradoraFallida('SBS')
              }
            })
            .catch((err) => {
              console.error(err);
            })
        );
      }

      Promise.all(cont).then(() => {
        $("#loaderOferta").html("");
        $("#loaderRecotOferta").html("");
        swal.fire({
          type: "success",
          title: "! Re cotización completada ¡",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        });
        console.log("Se completo la re-cotización");
      });
    }

    const mostrarAlertarCotizacionFallida = (aseguradora, mensaje) => {
      document.querySelector('.fallidas').innerHTML += `<p><i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i><b>${aseguradora}:</b> ${mensaje}</p>`
    }

    // /* Solidaria */
    // if (comprobarFallida('Solidaria')) {
    //   cont.push(
    //     fetch(
    //       "https://grupoasistencia.com/webservicepruebasIntegrador/Solidaria",
    //       requestOptions
    //     )
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         console.log(ofertas)
    //         if (typeof ofertas[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('Solidaria')
    //         } else {
    //           validarOfertas(ofertas);
    //           mostrarAlertaCotizacionExitosa('Solidaria')
    //           eliminarAseguradoraFallida('Solidaria')
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }


    // /* Previsora */
    // if (comprobarFallida('Previsora')) {
    //   cont.push(
    //     fetch("https://grupoasistencia.com/webservicepruebasIntegrador/Previsora", requestOptions)
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         if (typeof ofertas[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('Previsora')
    //         } else {
    //           validarOfertas(ofertas);
    //           mostrarAlertaCotizacionExitosa('Previsora')
    //           eliminarAseguradoraFallida('Previsora')
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }

    // /* Equidad */
    // // if (comprobarFallida('Equidad')) {
    // //   cont.push(
    // //     fetch("https://grupoasistencia.com/webservicepruebasIntegrador/Equidad", requestOptions)
    // //       .then((res) => {
    // //         if (!res.ok) throw Error(res.statusText);
    // //         return res.json();
    // //       })
    // //       .then((ofertas) => {
    // //         if (typeof ofertas[0].Resultado !== 'undefined') {
    // //           agregarAseguradoraFallida('Equidad')
    // //           ofertas[0].Mensajes.forEach(mensaje => {
    // //             mostrarAlertarCotizacionFallida('Equidad', mensaje)
    // //           })
    // //         } else {
    // //           validarOfertas(ofertas);
    // //           mostrarAlertaCotizacionExitosa('Equidad')
    // //           eliminarAseguradoraFallida('Equidad')
    // //         }
    // //       })
    // //       .catch((err) => {
    // //         console.error(err);
    // //       })
    // //   );
    // // }

    // /* Bolivar */
    // if (comprobarFallida('Bolivar')) {
    //   cont.push(
    //     fetch("https://grupoasistencia.com/webservicepruebasIntegrador/Bolivar", requestOptions)
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         console.log(ofertas)
    //         if (typeof ofertas[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('Bolivar')
    //         } else {
    //           validarOfertas(ofertas);
    //           mostrarAlertaCotizacionExitosa('Bolivar')
    //           eliminarAseguradoraFallida('Bolivar')
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }

    // /* HDI */
    // if (comprobarFallida('HDI')) {
    //   cont.push(
    //     fetch("https://grupoasistencia.com/webservice_autosv1/HDI", requestOptions)
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         if (typeof ofertas[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('HDI')
    //         } else {
    //           console.log('Here2')
    //           let result = []
    //           result.push(ofertas[0])
    //           validarOfertas(result)
    //           mostrarAlertaCotizacionExitosa('HDI')
    //           eliminarAseguradoraFallida('HDI')
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }

    // let zurichErrors = true
    // let zurichSuccess = true

    // /* Zurich */
    // if (comprobarFallida('Zurich')) {
    //   const planes = ["BASIC", "MEDIUM", "FULL"]
    //   let body = JSON.parse(requestOptions.body)
    //   planes.forEach(plan => {
    //     body.plan = plan
    //     body.Email = Math.round(Math.random() * 999999) + body.Email
    //     requestOptions.body = JSON.stringify(body)
    //     cont.push(
    //       fetch('https://grupoasistencia.com/webservicepruebasIntegrador/Zurich', requestOptions)
    //         .then(res => {
    //           if (!res.ok) throw Error(res.statusText)
    //           return res.json()
    //         })
    //         .then(ofertas => {
    //           if (typeof ofertas.Resultado !== 'undefined') {
    //             agregarAseguradoraFallida('Zurich')
    //             zurichErrors = false
    //           } else {
    //             validarOfertas(ofertas)
    //             if (zurichSuccess) {
    //               mostrarAlertaCotizacionExitosa('Zurich')
    //               eliminarAseguradoraFallida('Zurich')
    //               zurichSuccess = false
    //             }
    //           }
    //         })
    //         .catch(err => console.error(err))
    //     )
    //   })
    // }

    // let successEstado = true

    // /* Estado */
    // if (comprobarFallida('Estado')) {
    //   cont.push(
    //     fetch("https://grupoasistencia.com/webservicepruebasIntegrador/Estado", requestOptions)
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         let result = []
    //         result.push(ofertas)
    //         if (typeof result[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('Estado')
    //         } else {
    //           validarOfertas(result);
    //           if (successEstado) {
    //             mostrarAlertaCotizacionExitosa('Estado')
    //             eliminarAseguradoraFallida('Estado')
    //             successEstado = false
    //           }
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }

    // /* Estado2 */
    // if (comprobarFallida('Estado2')) {
    //   cont.push(
    //     fetch("https://grupoasistencia.com/webservicepruebasIntegrador/Estado2", requestOptions)
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         let result = []
    //         result.push(ofertas)
    //         if (typeof result[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('Zurich2')
    //         } else {
    //           validarOfertas(result);
    //           if (successEstado) {
    //             mostrarAlertaCotizacionExitosa('Estado')
    //             eliminarAseguradoraFallida('Estado')
    //             successEstado = false
    //           }
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }

    // /* Liberty */
    // if (comprobarFallida('Liberty')) {
    //   cont.push(
    //     fetch("https://grupoasistencia.com/webservicepruebasIntegrador/Liberty", requestOptions)
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         if (typeof ofertas[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('Liberty')
    //         } else {
    //           validarOfertas(ofertas);
    //           mostrarAlertaCotizacionExitosa('Liberty')
    //           eliminarAseguradoraFallida('Liberty')
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }

    // /* Allianz */
    // if (comprobarFallida('Allianz')) {
    //   cont.push(
    //     fetch("https://grupoasistencia.com/webservicepruebasIntegrador/Allianz", requestOptions)
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         console.log(res);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         if (typeof ofertas[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('Allianz')
    //         } else {
    //           validarOfertas(ofertas)
    //           mostrarAlertaCotizacionExitosa('Allianz')
    //           eliminarAseguradoraFallida('Allianz')
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }

    // /* AXA */
    // if (comprobarFallida('AXA')) {
    //   cont.push(
    //     fetch("https://grupoasistencia.com/webservice_autosv1/AXA", requestOptions)
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         if (typeof ofertas[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('AXA')
    //           ofertas[0].Mensajes.forEach(mensaje => {
    //             mostrarAlertarCotizacionFallida('AXA', mensaje)
    //           })
    //         } else {
    //           validarOfertas(ofertas)
    //           mostrarAlertaCotizacionExitosa('AXA')
    //           eliminarAseguradoraFallida('AXA')
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }

    // /* SBS */
    // if (comprobarFallida('SBS')) {
    //   cont.push(
    //     fetch("https://grupoasistencia.com/webservicepruebasIntegrador/SBS", requestOptions)
    //       .then((res) => {
    //         if (!res.ok) throw Error(res.statusText);
    //         return res.json();
    //       })
    //       .then((ofertas) => {
    //         let result = ofertas
    //         if (typeof result[0].Resultado !== 'undefined') {
    //           agregarAseguradoraFallida('SBS')
    //         } else {
    //           validarOfertas(result);
    //           mostrarAlertaCotizacionExitosa('SBS')
    //           eliminarAseguradoraFallida('SBS')
    //         }
    //       })
    //       .catch((err) => {
    //         console.error(err);
    //       })
    //   );
    // }

    // Promise.all(cont).then(() => {
    //   $("#loaderOferta").html("");
    //   $("#loaderRecotOferta").html("");
    //   swal.fire({
    //     type: "success",
    //     title: "! Re cotización completada ¡",
    //     showConfirmButton: true,
    //     confirmButtonText: "Cerrar",
    //   });
    //   console.log("Se completo la re-cotización");
    // });

    /*fetch("http://localhost/webservice_autosv1/Cotizar", requestOptions)
      .then(function (response) {
        if (!response.ok) {
          throw Error(response.statusText);
        }
        return response.json();
      })
      .then(function (ofertas) {
        validarOfertas(ofertas);
      })
      .catch(function (error) {
        console.log('Parece que hubo un problema: \n', error);
 
        contErrProtocoloCotizar++;
        if (contErrProtocoloCotizar > 1) {
 
          $('#loaderOferta').html('');
          $('#loaderRecotOferta').html('');
        }
        else {
          setTimeout(cotizarOfertas, 4000);
        }
 
      })
      .finally(() => {
          fetch('http://localhost/webservice_autosv1/Solidaria', requestOptions)
          .then(res => {
              console.log(res)
              return res.json()
          }).then(resJson => {
              console.log(resJson)
              validarOfertas(resJson)
          }).catch(err => {
              console.log(err)
          })
      });*/

    // cotizarOfertaSBS(requestOptions);
  }

  // } else {
  //   swal.fire({
  //     text: "! Debe diligenciar en su totalidad los campos del Asegurado. ¡",
  //   });
  //   masAseg();
  //   menosVeh();
  // }
}



var cont2 = [];
var contErrProtocoloCotizarSBS = 0;
// PERMITE COTIZAR LA OFERTA DE LA ASEGURADORA SBS
/*
function cotizarOfertaSBS(requestOptions){
	
  fetch("http://localhost/webservice_autosv1/CotizarSBS", requestOptions)
  .then(function (response) {
    if (!response.ok) {
      throw Error(response.statusText);
    }
    return response.json();
  })
  .then(function (oferta) {
    if(oferta.numero_cotizacion != null && oferta.precio != "0"){
      cont2.push(registrarOferta(oferta.entidad, oferta.precio, oferta.producto, oferta.numero_cotizacion, oferta.responsabilidad_civil, oferta.cubrimiento, oferta.deducible, oferta.conductores_elegidos, oferta.servicio_grua, oferta.imagen, oferta.pdf));
    }
  })
  .catch(function (error) {
    console.log('Parece que hubo un problema: \n', error);
  	
    contErrProtocoloCotizarSBS++;
    if(contErrProtocoloCotizarSBS > 1){

      $('#loaderOferta').html('');
      $('#loaderRecotOferta').html('');
    }
    else{
      setTimeout(cotizarOfertaSBS,3000);
    }

  });

}
*/


// DA FORMATO A LOS VALORES ENTEROS
function formatNumber(n) {
  n = String(n).replace(/\D/g, "");
  return n === "" ? n : Number(n).toLocaleString();
}

// function cotizarOfertasPesados() {
//   var fasecoldaVeh = document.getElementById("txtFasecolda").value;
//   var valorfasecoldaVeh = document.getElementById("txtValorFasecolda").value;
//   var modelovehiculo = document.getElementById("txtModeloVeh").value;
//   var marca = document.getElementById("txtMarcaVeh").value;
//   var linea = document.getElementById("txtReferenciaVeh").value;

//   var mundial = document.getElementById("mundialseguros").value;
//   var hdi = document.getElementById("hdiseguros").value;
//   var estado = document.getElementById("estadoseguros").value;

//   var ofinanciera = document.getElementById("obligacionfinanciera").value;

//   //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//   var placa = document.getElementById("placaVeh").value;
//   var esCeroKmSi = document.getElementById("txtEsCeroKmSi").checked;
//   var esCeroKm = esCeroKmSi.toString();
//   var esCeroKmInt = esCeroKmSi == true ? 1 : 0;

//   var idCliente = document.getElementById("idCliente").value;
//   var tipoDocumentoID = document.getElementById("tipoDocumentoID").value;
//   var numDocumentoID = document.getElementById("numDocumentoID").value;
//   var Nombre = document.getElementById("txtNombres").value;
//   var Apellido1 = document.getElementById("txtApellidos").value;
//   var Apellido2 = "";
//   var dia = document.getElementById("dianacimiento").value;
//   var mes = document.getElementById("mesnacimiento").value;
//   var anio = document.getElementById("anionacimiento").value;
//   var FechaNacimiento = anio + "-" + mes + "-" + dia;
//   var Genero = document.getElementById("genero").value;
//   var estadoCivil = document.getElementById("estadoCivil").value;
//   var celularAseg = document.getElementById("celularAseg").value;
//   var emailAseg = document.getElementById("emailAseg").value;
//   var direccionAseg = document.getElementById("direccionAseg").value;

//   var CodigoClase = document.getElementById("CodigoClase").value;
//   var CodigoMarca = document.getElementById("CodigoMarca").value;
//   var CodigoLinea = document.getElementById("CodigoLinea").value;
//   var claseVeh = document.getElementById("txtClaseVeh").value;

//   var LimiteRC = document.getElementById("LimiteRC").value;
//   var CoberturaEstado = document.getElementById("CoberturaEstado").value;
//   var ValorAccesorios = document.getElementById("ValorAccesorios").value;
//   var CodigoVerificacion = document.getElementById("CodigoVerificacion").value;
//   var AniosSiniestro = document.getElementById("AniosSiniestro").value;
//   var AniosAsegurados = document.getElementById("AniosAsegurados").value;
//   var NivelEducativo = document.getElementById("NivelEducativo").value;
//   var Estrato = document.getElementById("Estrato").value;

//   var tipoUsoVehiculo = document.getElementById("txtTipoUsoVehiculo").value;
//   var tipoServicio = document.getElementById("txtTipoServicio").value;
//   var DptoCirculacion = document.getElementById("DptoCirculacion").value;
//   var ciudadCirculacion = document.getElementById("ciudadCirculacion").value;
//   var isBenefOneroso = $("input:radio[name=oneroso]:checked").val(); // Valida que alguno de los 2 este selecionado
//   var benefOneroso = document.getElementById("benefOneroso").value;

//   if (ciudadCirculacion.length == 4) {
//     ciudadCirculacion = "0" + ciudadCirculacion;
//   } else if (ciudadCirculacion.length == 3) {
//     ciudadCirculacion = "00" + ciudadCirculacion;
//   }

//   //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

//   if (
//     fasecoldaVeh != "" &&
//     valorfasecoldaVeh != "" &&
//     modelovehiculo != "" &&
//     marca != "" &&
//     linea != ""
//   ) {
//     $("#loaderOferta").html(
//       '<img src="vistas/img/plantilla/loader-update.gif" width="34" height="34"><strong> Consultando Ofertas...</strong>'
//     );
//     $("#loaderRecotOferta").html(
//       '<img src="vistas/img/plantilla/loader-update.gif" width="34" height="34"><strong> Recotizando Ofertas...</strong>'
//     );

//     var myHeaders = new Headers();
//     myHeaders.append("Content-Type", "application/json");

//     var raw = {
//       Placa: placa,
//       ceroKm: esCeroKm,
//       TipoIdentificacion: tipoDocumentoID,
//       NumeroIdentificacion: numDocumentoID,
//       Nombre: Nombre,
//       Apellido: Apellido1,
//       Genero: Genero,
//       FechaNacimiento: FechaNacimiento,
//       EstadoCivil: estadoCivil,
//       NumeroTelefono: celularAseg,
//       Direccion: direccionAseg,
//       Email: emailAseg,
//       ZonaCirculacion: DptoCirculacion,
//       CodigoMarca: CodigoMarca,
//       CodigoLinea: CodigoLinea,
//       CodigoClase: CodigoClase,
//       CodigoFasecolda: fasecoldaVeh,
//       Modelo: modelovehiculo,
//       ValorAsegurado: valorfasecoldaVeh,
//       LimiteRC: LimiteRC,
//       Cobertura: CoberturaEstado,
//       ValorAccesorios: ValorAccesorios,
//       CiudadBolivar: ciudadCirculacion,
//       tipoServicio: tipoServicio,
//       CodigoVerificacion: CodigoVerificacion,
//       Apellido2: Apellido2,
//       AniosSiniestro: AniosSiniestro,
//       AniosAsegurados: AniosAsegurados,
//       NivelEducativo: NivelEducativo,
//       Estrato: Estrato,
//       mundial: mundial,
//       ofinanciera: ofinanciera,
//       hdi: hdi,
//       estado: estado,
//     };

//     var requestOptions = {
//       method: "POST",
//       headers: myHeaders,
//       body: JSON.stringify(raw),
//       redirect: "follow",
//     };

//     $.ajax({
//       type: "POST",
//       url: "src/insertarCotizacion.php",
//       dataType: "json",
//       data: {
//         placa: placa,
//         esCeroKm: esCeroKmInt,
//         idCliente: idCliente,
//         tipoDocumento: tipoDocumentoID,
//         numIdentificacion: numDocumentoID,
//         Nombre: Nombre,
//         Apellido: Apellido1,
//         FechaNacimiento: FechaNacimiento,
//         Genero: Genero,
//         EstadoCivil: estadoCivil,
//         Celular: "",
//         Correo: "",
//         direccionAseg: direccionAseg,
//         CodigoClase: CodigoClase,
//         Clase: claseVeh,
//         Marca: marca,
//         Modelo: modelovehiculo,
//         Linea: linea,
//         Fasecolda: fasecoldaVeh,
//         ValorAsegurado: valorfasecoldaVeh,
//         tipoUsoVehiculo: tipoUsoVehiculo,
//         tipoServicio: tipoServicio,
//         Departamento: DptoCirculacion,
//         Ciudad: ciudadCirculacion,
//         benefOneroso: benefOneroso,
//         mundial: mundial,
//         idCotizacion: idCotizacion,
//       },
//       cache: false,
//       success: function (data) {
//         idCotizacion = data.id_cotizacion;

//         alert(idCotizacion);

//         fetch(
//           "http://localhost/webservice_autosv1/CotizarPesados",
//           requestOptions
//         )
//           .then(function (response) {
//             if (!response.ok) {
//               throw Error(response.statusText);
//             }
//             return response.json();
//           })
//           .then(function (ofertas) {
//             validarOfertasPesados(ofertas);
//           })
//           .catch(function (error) {
//             console.log("Parece que hubo un problema: \n", error);

//             contErrProtocoloCotizar++;
//             if (contErrProtocoloCotizar > 1) {
//               $("#loaderOferta").html("");
//               $("#loaderRecotOferta").html("");
//             } else {
//               setTimeout(cotizarOfertas, 4000);
//             }
//           });
//       },
//     });
//   }
// }

// function validarOfertasPesados(ofertas) {
//   var cont = [];

//   ofertas.forEach(function (oferta, i) {
//     var numCotizacion = oferta.numero_cotizacion;
//     var precioOferta = oferta.precio;

//     if (numCotizacion != null && precioOferta != "0") {
//       if (precioOferta.length > 3) {
//         cont.push(
//           registrarOferta(
//             oferta.entidad,
//             oferta.precio,
//             oferta.producto,
//             oferta.numero_cotizacion,
//             oferta.responsabilidad_civil,
//             oferta.cubrimiento,
//             oferta.deducible,
//             oferta.conductores_elegidos,
//             oferta.servicio_grua,
//             oferta.imagen,
//             oferta.pdf,
//             0
//           )
//         );

//         Promise.all(cont).then(function (resultados) {
//           $("#loaderOferta").html("");
//           $("#loaderRecotOferta").html("");
//           swal.fire({
//             type: "success",
//             title: "! Cotización Exitosa ¡",
//             showConfirmButton: true,
//             confirmButtonText: "Cerrar",
//           }).then(function (result) {
//             if (result.value) {
//               window.location =
//                 "index.php?ruta=editar-cotizacionpesados&idCotizacion=" +
//                 idCotizacion;
//             }
//           });
//         });
//       }
//     }
//   });

//   if (cont.length == 0) {
//     if (cont2.length >= 1) {
//       $("#loaderOferta").html("");
//       $("#loaderRecotOferta").html("");
//       swal.fire({
//         type: "success",
//         title: "! Cotización Exitosa ¡",
//         showConfirmButton: true,
//         confirmButtonText: "Cerrar",
//       }).then(function (result) {
//         if (result.value) {
//           window.location =
//             "index.php?ruta=editar-cotizacionpesados&idCotizacion=" +
//             idCotizacion;
//         }
//       });
//     } else {
//       window.location =
//         "index.php?ruta=editar-cotizacionpesados&idCotizacion=" + idCotizacion;
//     }
//   }
// }


//CAMBIOS JHON CONSULTA FASECOLDA

// Abrir modal
document.querySelector('#txtFasecolda').addEventListener('keypress', e => {
  if (e.keyCode === 13) {
    e.preventDefault()
    $('#staticBackdrop').modal('show')
  }
})

// Consultar datos del vehiculo
document.querySelector('#btn-consultar-fasecolda').addEventListener('click', e => {
  const fasecolda = document.querySelector('#buscar-fasecolda').value
  const modelo = document.querySelector('#modelo-fasecolda').value
  if (fasecolda === '' || modelo === '') { return }
  consulDatosFasecolda(fasecolda, modelo)
    .then(data => {
      if (typeof data.marcaVeh === 'undefined') {
        alert("Vehículo no Encontrado");
      } else {
        alert("Vehículo Encontrado");
        $("#txtClaseVeh").val(data.claseVeh);
        $("#txtMarcaVeh").val(data.marcaVeh);
        $("#txtReferenciaVeh").val(data.lineaVeh);
        $("#txtValorFasecolda").val(data.valorVeh);
        document.querySelector('#txtFasecolda').value = fasecolda;
        document.querySelector('#txtModeloVeh').value = modelo;
        $('#staticBackdrop').modal('hide');
      }

    }).catch(err => {
      console.log(err)
    })
})

// Cuando se cierra el modal
$('#staticBackdrop').on('hidden.bs.modal', () => {
  document.querySelector('#buscar-fasecolda').value = ''
  document.querySelector('#modelo-fasecolda').value = ''
})


// Abrir modal
document.querySelector('.buscarFasecolda').addEventListener('click', e => {
  $('#staticBackdrop').modal('show')
})

document.querySelector('#txtFasecolda').addEventListener('keypress', e => {
  if (e.keyCode === 13) {
    e.preventDefault()
    $('#staticBackdrop').modal('show')
  }
})

function validarNumCotizaciones() {

  fecha1 = new Date;
  fecha2 = fecha1.toLocaleDateString();
  fecha3 = fecha2.split("/");
  fecha = fecha3[2] + "-" + fecha3[1] + "-" + fecha3[0];
  cotRestan = $("#cotRestanv").val();

  $.ajax({

    url: "ajax/compararFecha.php",
    method: "POST",
    data: { fecha },
    success: function (respuesta) {

      respuesta = parseInt(respuesta)

      cotRestan = parseInt(cotRestan);

      if (respuesta < cotRestan) {

      } else {

        Swal.fire({
          icon: 'error',
          title: '¡Has llegado al límite de cotizaciones diarias... Inténtalo de nuevo mañana!.',
          confirmButtonText: 'Cerrar',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = "inicio";
          } else if (result.isDenied) {
          }
        })

        setTimeout(function () {
          window.location = "inicio";
        }, 5000);


      }
    }
  })


}

$("#btnConsultarVehmanualbuscador").click(function () {
     var fasecolda=  document.getElementById("fasecoldabuscadormanual").value;
     var modelo=  document.getElementById("modelobuscadormanual").value;
     
     if(fasecolda==""){
        alert("Error en el código fasecolda"); 
     }
     
     if(modelo==""){
        alert("Error en el modelo del vehículo"); 
     }
     
     
     if(fasecolda!="" && modelo!=""){
          $.ajax({
      type: "POST",
      url: "src/fasecolda/consulDatosFasecolda.php",
      dataType: "json",
      data: {
        fasecolda: fasecolda,
        modelo: modelo,
      },
      success: function (data) {
          
        if (data.estado == undefined) {
            alert("Vehículo no encontrado");
        }else{
             // console.log(data);
            var claseVeh = data.clase;
            var marcaVeh = data.marca;
            var ref1Veh = data.referencia1;
            var ref2Veh = data.referencia2;
            var ref3Veh = data.referencia3;
            var lineaVeh = ref1Veh + " " + ref2Veh + " " + ref3Veh;
    
            var valorFasecVeh = data[modelo];
            var valorVeh = Number(valorFasecVeh) * 1000;
            var clase = data.clase;
            
            $("#clasepesados").val(clase);

            var placaVeh = $("#placaVeh").val();
            if (placaVeh == "WWW404") {
              $("#txtPlacaVeh").val("SIN PLACA - VEHÍCULO 0 KM").val();
            } else {
              $("#txtPlacaVeh").val(placaVeh).val();
            }
            
            document.getElementById("resumenVehiculo").style.display = "block";
            document.getElementById("contenBtnCotizar").style.display = "block";
            document.getElementById("headerAsegurado").style.display = "block";
            document.getElementById("masA").style.display = "block";
            
            document.getElementById("formularioVehiculo").style.display = "none";
            document.getElementById("DatosAsegurado").style.display = "none";
            
            document.getElementById("txtFasecolda").value = fasecolda;
            document.getElementById("txtModeloVeh").value = modelo;
            document.getElementById("txtMarcaVeh").value = data.marca;
            document.getElementById("txtValorFasecolda").value = valorVeh;
            document.getElementById("txtReferenciaVeh").value = lineaVeh;
            document.getElementById("txtClaseVeh").value = claseVeh;
            
            
            
        }
          
          
          
       

        

       
        
        
        
        
        
        
        //01601146

       // menosAseg();
      },
    });
     }

  });

