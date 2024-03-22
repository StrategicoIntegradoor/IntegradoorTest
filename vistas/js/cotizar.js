$(document).ready(function () {
  
  

    const parrillaCotizaciones = document.getElementById('parrillaCotizaciones');
    parrillaCotizaciones.style.display = 'none';

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
      masRE();
      cotizarOfertas();
    });
  
    // $("#btnCotizarPesados").click(function () {
    //   cotizarOfertasPesados();
    // });
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
          text: restriccion,
          confirmButtonText: 'Cerrar'
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
          console.log(myJson)
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
                      restriccion = 'Lo sentimos, no puedes cotizar motos por este módulo. Para hacerlo debes ingresar al modulo Cotizar Motocicletas.';
                    }else{
                      restriccion = 'Lo sentimos, no puedes cotizar motos por este módulo.'
                    }
                    Swal.fire({
                      icon: 'error',
                      text: restriccion,
                      confirmButtonText: 'Cerrar'
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
                      text: restriccion,
                      confirmButtonText: 'Cerrar'
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
                      text: restriccion,
                      confirmButtonText: 'Cerrar'
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
          console.log("Mapfre consulta");
          console.log("Marca Cod:", marcaCod);
          console.log("Clase:", clase);
          console.log("Línea:", linea);
          console.log("Modelo:", modelo);
          console.log("Cilindraje:", cilindraje);
          console.log("Código Fasecolda:", codFasecolda);
          console.log("Aseguradora:", aseguradora);
  
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
          console.log(data)
          // var datos = data.Data;
          var message = data.Message
          var success = data.Success
          resolve()
        },
        error: function (error) {
          console.log(error)
          // reject(error)
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
    var id_intermediario = document.getElementById("idIntermediario").value;
    let cardCotizacion = `
                          <div class='col-lg-12'>
                              <div class='card-ofertas'>
                                  <div class='row card-body'>
                                      <div class="col-xs-12 col-sm-6 col-md-2 oferta-logo">
                                      <center>
  
                                          <img src='vistas/img/logos/${logo}'>
  
                    </center>  
  
                    <div class='col-12' style='margin-top:2%;'>
                      ${((aseguradora == "Axa Colpatria" || aseguradora == "Liberty" || aseguradora == "Equidad" || aseguradora == "Mapfre" || aseguradora == "Seguros Bolivar") && id_intermediario == "78") ?
                        `<center>
                          <!-- Código para el caso específico de Axa Colpatria, Liberty, Equidad o Mapfre y id_intermediario no es 78 -->
                          <!-- Agrega aquí el contenido específico para estas aseguradoras y el id_intermediario no es 78 -->
                        </center>`
                        : (permisos.Vernumerodecotizacionencadaaseguradora == "x") ?
                        `<center>
                          <label class='entidad'>N° Cot: <span style='color:black'>${numCotizOferta}</span></label>
                        </center>`
                        : ''}
                    </div>


  
                                      </div>
                                      <div class="col-xs-12 col-sm-6 col-md-2 oferta-header">
                                          <h5 class='entidad'>${aseguradora} - ${producto}</h5>
                                          <h5 class='precio'>Desde $ ${prima}</h5>
                                          <p class='title-precio'>(IVA incluido)</p>
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
    if ((aseguradora == "Seguros Bolivar" || aseguradora == "Axa Colpatria")) {
      cardCotizacion += `
                                          <div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">
                                              <button type="button" class="btn btn-info" id="btnAsegPDF${numCotizOferta}${numId}\" onclick='verPdfOferta(\"${aseguradora}\", \"${numCotizOferta}\", \"${numId}\", \"${id_intermediario}\");'>
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
    }else if (aseguradora == "HDI Seguros") {
      cardCotizacion += `
                          <div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">
                              <button id="Hdi-pdf${numCotizOferta}" type="button" class="btn btn-info" onclick='verPdfHdi("${numCotizOferta}")'>
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
  function validarOfertas(ofertas, aseguradora, exito) {
    let contadorPorEntidad = {};

    ofertas.forEach((oferta, i) => {
      var numCotizacion = oferta.numero_cotizacion;
      var precioOferta = oferta.precio;
      if (oferta == null) return;
      if (numCotizacion == null && precioOferta == "0") return;
      if (precioOferta.length <= 3) return;
      // contadorOfertas++;   // Variable para contar el número de ofertas
      contadorPorEntidad[oferta.entidad] = (contadorPorEntidad[oferta.entidad] || 0) + 1;
      // console.log(`Entidad: ${oferta.entidad}, Contador: ${contadorPorEntidad[oferta.entidad]}`);
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


    // });
    });

    // Llamada a la función registrarNumeroOfertas para cada entidad
    Object.entries(contadorPorEntidad).forEach(([entidad, contador]) => {
      // const numCotizacion = ofertas.find(oferta => oferta.entidad === entidad)?.numero_cotizacion;
      var idCotizOferta = idCotizacion
      registrarNumeroOfertas(entidad, contador, idCotizOferta, exito);
    });

    return contadorPorEntidad;

  }

  //VERSION DEFINITIVA "validarProblema()""
  function validarProblema(aseguradora, ofertas) {
    var idCotizOferta = idCotizacion;
    console.log(ofertas);

    // Verificar si ofertas es un array
    if (Array.isArray(ofertas)) {
        ofertas.forEach((oferta) => {
            // Obtener mensajes de la oferta
            var mensajes = oferta.Mensajes || [];

            // Verificar si mensajes es un array y tiene al menos un mensaje
            if (Array.isArray(mensajes) && mensajes.length > 0) {
                // Concatenar mensajes en un solo párrafo
                var mensajeConcatenado = mensajes.join(', ');

                // Realizar la petición AJAX con los datos
                $.ajax({
                    type: "POST",
                    url: "src/insertarAlerta.php",
                    dataType: "json",
                    data: {
                        aseguradora: aseguradora,
                        cantidadOfertas: 0,
                        cotizacion: idCotizOferta,
                        exito: 0,
                        mensaje: mensajeConcatenado
                    },
                    success: function (data) {
                        var datos = data.Data;
                        console.log(datos);
                        // var message = data.Message
                        // var success = data.Success
                        // resolve();
                    },
                    error: function (error) {
                        console.log(error);
                        // reject(error)
                    }
                });
            }
        });
    } else if (ofertas && ofertas.jsonZurich && typeof ofertas.jsonZurich === 'object') {
        // Caso específico para la estructura de Zurich
        var mensajesZurich = ofertas.jsonZurich.result.messages || [];
        if (Array.isArray(mensajesZurich) && mensajesZurich.length > 0) {
            // Concatenar mensajes en un solo párrafo
            var mensajeConcatenadoZurich = mensajesZurich.map(m => m.messageText).join(', ');

            // Realizar la petición AJAX con los datos
            $.ajax({
                type: "POST",
                url: "src/insertarAlerta.php",
                dataType: "json",
                data: {
                    aseguradora: aseguradora,
                    cantidadOfertas: 0,
                    cotizacion: idCotizOferta,
                    exito: 0,
                    mensaje: mensajeConcatenadoZurich
                },
                success: function (data) {
                    var datos = data.Data;
                    console.log(datos);
                    // var message = data.Message
                    // var success = data.Success
                    // resolve();
                },
                error: function (error) {
                    console.log(error);
                    // reject(error)
                }
            });
        }
    }
  }

  
  function registrarNumeroOfertas(entidad, contador, numCotizacion, exito) {

    $.ajax({
      type: "POST",
      url: "src/insertarAlerta.php",
      dataType: "json",
      data: {
        aseguradora: entidad,
        cantidadOfertas: contador,
        cotizacion: numCotizacion,
        exito: exito,
        mensaje: ''
      },
      success: function (data) {
        console.log(data)
        // var datos = data.Data;
        var message = data.Message
        var success = data.Success
        // resolve()
      },
      error: function (error) {
        console.log(error)
        // reject(error)
      }
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
        confirmButtonText: 'Cerrar',
        text: restriccion
      }).then(() => {
        // Agregar un retraso antes de recargar la página (por ejemplo, 2 segundos)
        setTimeout(() => {
            // Recargar la página después del retraso
            location.reload();
        }, 2000); // 2000 milisegundos = 2 segundos
      });
      // Salir del código aquí para evitar la ejecución del resto del código
      return;
    }
    var tipoServicio = document.getElementById("txtTipoServicio").value;
    if(tipoServicio == "11" || tipoServicio == "12"){
      var restriccion = '';
      if(rolAsesor == 19){
        restriccion = 'Lo sentimos, no puedes realizar cotizaciones para el tipo de servicio público o intermunicipal por este cotizador. Para hacerlo debes comunicarte con el Equipo de Asesores Freelance de Grupo Asistencia, quienes podrán ayudarte a cotizar de manera manual con diferentes aseguradoras.';
      }else{
        restriccion = 'Lo sentimos, no puedes realizar cotizaciones para el tipo de servicio público o intermunicipal por este cotizador.'
      }
      Swal.fire({
        icon: 'error',
        confirmButtonText: 'Cerrar',
        text: restriccion
      }).then(() => {
        // Agregar un retraso antes de recargar la página (por ejemplo, 2 segundos)
        setTimeout(() => {
            // Recargar la página después del retraso
            location.reload();
        }, 2000); // 2000 milisegundos = 2 segundos
      });
      // Salir del código aquí para evitar la ejecución del resto del código
      return;
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

    var aseguradoras = JSON.parse(document.getElementById('aseguradoras').value); 
    console.log(aseguradoras)

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
          menosVeh();

          

          const aseguradoras = ['Allianz', 'AXA', 'Bolivar', 'Equidad', 'Estado', 'HDI', 'Liberty', 'Mapfre', 'Previsora', 'SBS', 'Solidaria', 'Zurich'];

          aseguradoras.forEach(aseguradora => {
              const celdaResponse = document.getElementById(`${aseguradora}Response`);
      
              // Agregar un elemento de carga (por ejemplo, un gif) en la celda de respuesta
              const loadingElement = document.createElement('img');
              loadingElement.src = 'vistas/img/plantilla/loader-update.gif'; // Reemplaza con la ruta correcta del gif
              loadingElement.alt = 'Cargando...';
      
               // Establecer el tamaño deseado del gif (por ejemplo, 50px x 50px)
              loadingElement.style.width = '22px';
              loadingElement.style.height = '22px';
      
              // Limpiar cualquier contenido existente en la celda de respuesta
              celdaResponse.innerHTML = '';
      
              // Agregar el elemento de carga a la celda de respuesta
              celdaResponse.appendChild(loadingElement);
          });

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
              parrillaCotizaciones.style.display = 'block';
              contenParrilla.style.display = 'block'
              idCotizacion = data.id_cotizacion;
              raw.cotizacion = idCotizacion
              // console.log(idCotizacion)
  
              var requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: JSON.stringify(raw),
                redirect: "follow",
              };
  
              let cont = [];
              
            
              const mostrarAlertaCotizacionExitosa = (aseguradora, contador) => {
                if (aseguradora == "Estado2") {
                  aseguradora = "Estado";
                }

                // Obtener la primera clave del objeto
                const primeraClave = Object.keys(contador)[0];

                // Obtener el valor asociado a la primera clave
                const contadorOfertas = contador[primeraClave];

                // Obtener la referencia de la tabla
                const tablaResumenCotBody = document.querySelector('#tablaResumenCot tbody');
              
                // Verificar si ya existe la fila
                const filaExistente = document.getElementById(aseguradora);
                if (filaExistente) {
                    // Acceder directamente a las celdas de la fila existente
                    const celdaContador = filaExistente.cells[2]; // Tercera celda de la fila
                    const celdaCotizo = filaExistente.cells[1]; // Segunda celda de la fila
                    const celdaResponse = filaExistente.cells[3]; // Cuarta celda de la fila
                    // Actualizar los valores según sea necesario
                    const contadorActualTexto = celdaContador.textContent.trim();
                    // Verificar si el texto está vacío o no es un número
                    const contadorActual = contadorActualTexto === '' ? 0 : parseInt(contadorActualTexto, 10);
                    const nuevoContador = contadorActual + contadorOfertas;

                    if(contadorActualTexto !== ''){
                      
                      celdaContador.textContent = nuevoContador;
                      celdaCotizo.innerHTML = '<i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;"></i>';
                      celdaResponse.textContent = 'Cotización exitosa';

                    }else{

                      celdaContador.textContent = nuevoContador;
                      celdaCotizo.innerHTML = '<i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;"></i>';
                      celdaResponse.textContent = 'Cotización exitosa';

                    }

                } else {
                  // Si la fila no existe, puedes agregarla
                  const nuevaFila = document.createElement('tr');
                  nuevaFila.id = aseguradora;
                  nuevaFila.innerHTML = `
                    <td>${aseguradora}</td>
                    <td style="text-align: center;"><i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;"></i></td>
                    <td style="text-align: center;">${contadorOfertas}</td>
                    <td>Nuevo Valor para Response</td>
                    <td>Nuevo Valor para Products</td>
                    <td>Nuevo Valor para Observation</td>
                  `;
                  tablaResumenCotBody.appendChild(nuevaFila);
                }
              };                                       
              
              const mostrarAlertarCotizacionFallida = (aseguradora, mensaje) => {
                if(aseguradora == "Estado2"){
                  aseguradora = "Estado"
                }
                console.log(aseguradora)
                console.log(mensaje)
                // Referecnia de la tabla
                const tablaResumenCotBody = document.querySelector('#tablaResumenCot tbody');
            
                // Verificar si ya existe una fila para la aseguradora
                const filaExistente = document.getElementById(aseguradora);
                
                if (filaExistente) {
                    // Si la fila existe, actualiza el mensaje de observaciones
                    
                    // Acceder directamente a las celdas de la fila existente
                    const celdaContador = filaExistente.cells[2]; // Tercera celda de la fila
                    const celdaCotizo = filaExistente.cells[1]; // Segunda celda de la fila
                    const celdaResponse = filaExistente.cells[3]; // Cuarta celda de la fila

                    if (celdaResponse.textContent.trim() !== 'Cotización exitosa') {

                      celdaContador.textContent = 0;
                      celdaCotizo.innerHTML = '<i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i>';
                      celdaResponse.textContent = mensaje;
                    
                    }      
                    // Verifica si el mensaje es diferente antes de actualizar
                    // if (observacionesActuales !== mensaje) {
                    //   celdaObservaciones.textContent = mensaje;
                    // } else {
                    //   console.log(`${aseguradora} tiene alertas iguales: "${observacionesActuales}" === "${mensaje}"`);
                    // }
      
                } else {
                    // Si no existe, crea una nueva fila
                    const nuevaFila = document.createElement('tr');
                    nuevaFila.setAttribute('data-aseguradora', aseguradora);
                    nuevaFila.innerHTML = `
                        <td>${aseguradora}</td>
                        <td style="text-align: center;"><i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i></td>
                        <td style="text-align: center;">0</td> <!-- Valor predeterminado para 'Productos cotizados' -->
                        <td>${mensaje}</td> <!-- Valor predeterminado para 'Observaciones' -->
                    `;
              
                    // Agregar la fila a la tabla
                    tablaResumenCotBody.appendChild(nuevaFila);
                }
              };

              

              if(intermediario != 78){
                       
                                
                const aseguradorasCoti = ['Allianz', 'AXA', 'Bolivar', 'Equidad', 'Estado', 'HDI', 'Liberty', 'Mapfre', 'Previsora', 'SBS', 'Solidaria', 'Zurich'];

                // for (const aseguradora in aseguradoras) {
                //   if (aseguradoras.hasOwnProperty(aseguradora)) {
                //     if (aseguradoras[aseguradora]['A'] == '1') {
                //       aseguradorasCoti.push(aseguradora);
                //     }
                //   }
                // }

                console.log(aseguradorasCoti);
                // const cont = []; // Array para almacenar las promesas

                aseguradorasCoti.forEach(aseguradora => {
                  if(aseguradora == "Mapfre"){

                    const url = `https://grupoasistencia.com/motor_webservice_tst2/mapfrecotizacion4?callback=myCallback`;

                  }else if(aseguradora == "HDI"){

                    const url = `https://grupoasistencia.com/motor_webservice/HdiPlus?callback=myCallback`;


                  }else if(aseguradora == "AXA"){

                    const url = `https://grupoasistencia.com/motor_webservice_tst2/AXA_tst?callback=myCallback`;


                  }else{
                  // Construir la URL de la solicitud para cada aseguradora
                  const url = `https://grupoasistencia.com/motor_webservice_tst2/${aseguradora}?callback=myCallback`;
                  }
                  
                  // Realizar la solicitud fetch y agregar la promesa al array
                  cont.push(
                    fetch(url, requestOptions)
                      .then(res => {
                        if (!res.ok) throw Error(res.statusText);
                        return res.json();
                      })
                      .then(ofertas => {
                        if (typeof ofertas[0].Resultado !== 'undefined') {
                          agregarAseguradoraFallida(aseguradora);
                          validarProblema(aseguradora, ofertas);
                          ofertas[0].Mensajes.forEach(mensaje => {
                            mostrarAlertarCotizacionFallida(aseguradora, mensaje)
                          })
                        } else {
                          const contadorPorEntidad = validarOfertas(ofertas, aseguradora, 1);
                          mostrarAlertaCotizacionExitosa(aseguradora, contadorPorEntidad)
                        }
                      })
                      .catch(err => {
                        agregarAseguradoraFallida(aseguradora);
                        mostrarAlertarCotizacionFallida(aseguradora, "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                        console.error(err);
                      })
                  );
                });
                  /* HDI */
                  // cont.push(
                  //   fetch("https://grupoasistencia.com/motor_webservice/HdiPlus?callback=myCallback", requestOptions)
                  //     .then((res) => {
                  //       if (!res.ok) throw Error(res.statusText);
                  //       return res.json();
                  //     })
                  //     .then((ofertas) => {
                  //       // console.log(ofertas)
                  //       if (typeof ofertas[0].Resultado !== 'undefined') {
                  //         agregarAseguradoraFallida('HDI');
                  //         validarProblema('HDI', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('HDI', mensaje)
                  //         })
                  //       } else {
                  //         const contadorPorEntidad = validarOfertas(ofertas,'HDI', 1);
                  //         mostrarAlertaCotizacionExitosa('HDI', contadorPorEntidad)
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('HDI');
                  //       mostrarAlertarCotizacionFallida('HDI', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
                    
                  /* Solidaria */
                  // cont.push(
                  //   fetch(
                  //     "https://grupoasistencia.com/motor_webservice_tst2/Solidaria?callback=myCallback",
                  //     requestOptions
                  //   )
                  //     .then((res) => {
                  //       if (!res.ok) throw Error(res.statusText);
                  //       return res.json();
                  //     })
                  //     .then((ofertas) => {
                  //       // console.log('Ofertas de Solidaria:', ofertas[0].Resultado); // Imprime las ofertas en la consola
                  //       if (typeof ofertas[0].Resultado !== 'undefined') {
                  //         agregarAseguradoraFallida('Solidaria');
                  //         validarProblema('Solidaria', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('Solidaria', mensaje)
                  //         })
                  //       } else {
                  //         const contadorPorEntidad = validarOfertas(ofertas,'Solidaria', 1);
                  //         mostrarAlertaCotizacionExitosa('Solidaria', contadorPorEntidad)
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('Solidaria')
                  //       mostrarAlertarCotizacionFallida('Solidaria', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
      
                  /* Mapfre */
                  // cont.push(
                  //   fetch("https://grupoasistencia.com/motor_webservice_tst2/mapfrecotizacion4?callback=myCallback", requestOptions)
      
                  //     .then((res) => {
                  //       if (!res.ok) throw Error(res.statusText);
                  //       return res.json();
                  //     })
                  //     .then((ofertas) => {
                  //       // console.log(ofertas)
                  //       let result = []
                  //       result.push(ofertas)
                  //       if (typeof ofertas[0].Resultado !== 'undefined') {
                  //         agregarAseguradoraFallida('Mapfre')
                  //         validarProblema('Mapfre', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('Mapfre', mensaje)
                  //         })
                  //       } else {
                  //         const contadorPorEntidad = validarOfertas(ofertas,'Mapfre', 1);
                  //         // let successMap = true;
                  //         // if (successMap) {
                  //         mostrarAlertaCotizacionExitosa('Mapfre', contadorPorEntidad)
                  //           // successMap = false
                  //         // }
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('Mapfre')
                  //       mostrarAlertarCotizacionFallida('Mapfre', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
      
                  /* Previsora */
                  // cont.push(
                  //   fetch("https://grupoasistencia.com/motor_webservice_tst2/Previsora?callback=myCallback", requestOptions)
                  //     .then((res) => {
                  //       if (!res.ok) throw Error(res.statusText);
                  //       return res.json();
                  //     })
                  //     .then((ofertas) => {
                  //       // console.log(ofertas)
                  //       if (typeof ofertas[0].Resultado !== 'undefined') {
                  //         agregarAseguradoraFallida('Previsora');
                  //         validarProblema('Previsora', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('Previsora', mensaje)
                  //         })
                  //       } else {
                  //         // guardarAlertas('Previsora', 1);
                  //         const contadorPorEntidad = validarOfertas(ofertas,'Previsora', 1);
                  //         mostrarAlertaCotizacionExitosa('Previsora', contadorPorEntidad)
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('Previsora')
                  //       mostrarAlertarCotizacionFallida('Previsora', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
      
                  // /* Equidad */
                  // cont.push(
                  //   fetch("https://grupoasistencia.com/motor_webservice_tst2/Equidad?callback=myCallback", requestOptions)
                  //     .then((res) => {
                  //       if (!res.ok) throw Error(res.statusText);
                  //       return res.json();
                  //     })
                  //     .then((ofertas) => {
                  //       if (typeof ofertas[0].Resultado !== 'undefined') {
                  //         agregarAseguradoraFallida('Equidad');
                  //         validarProblema('Equidad', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('Equidad', mensaje)
                  //         })
                  //       } else {
                  //         const contadorPorEntidad = validarOfertas(ofertas,'Equidad', 1);
                  //         mostrarAlertaCotizacionExitosa('Equidad', contadorPorEntidad)
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('Equidad')
                  //       mostrarAlertarCotizacionFallida('Equidad', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
      
                  /* Bolivar */
                  // cont.push(
                  //   fetch("https://grupoasistencia.com/motor_webservice_tst2/Bolivar?callback=myCallback", requestOptions)
                  //     .then((res) => {
                  //       if (!res.ok) throw Error(res.statusText);
                  //       return res.json();
                  //     })
                  //     .then((ofertas) => {
                  //       // console.log(ofertas)
                  //       if (typeof ofertas[0].Resultado !== 'undefined') {
                  //         agregarAseguradoraFallida('Bolivar');
                  //         validarProblema('Bolivar', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('Bolivar', mensaje)
                  //         })
                  //       } else {
                  //         const contadorPorEntidad = validarOfertas(ofertas,'Bolivar', 1);
                  //         mostrarAlertaCotizacionExitosa('Bolivar', contadorPorEntidad)
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('Bolivar');
                  //       mostrarAlertarCotizacionFallida('Bolivar', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
    
                  /* Zurich */
                  // let zurichStates = {};
                  // const planes = ["BASIC", "MEDIUM", "FULL"];
                  // let body = JSON.parse(requestOptions.body);
    
                  // planes.forEach(plan => {
                  //   body.plan = plan;
                  //   body.Email = "@gmail.com";
                  //   body.Email2 = Math.round(Math.random() * 999999) + body.Email;
                  //   requestOptions.body = JSON.stringify(body);
    
                  //   // Inicializa los estados de Zurich para cada plan
                  //   zurichStates[plan] = {
                  //     success: true,
                  //     errors: true
                  //   };
    
                  //   cont.push(
                  //     fetch('https://grupoasistencia.com/motor_webservice_tst2/Zurich?callback=myCallback', requestOptions)
                  //       .then((res) => {
                  //         if (res.status === 500) {
                  //           throw Error("Error interno del servidor (HTTP 500)");
                  //         }
                  //         if (!res.ok) {
                  //           throw Error(res.statusText);
                  //         }
                  //         return res.json();
                  //       })
                  //       .then(ofertas => {
                  //         if (typeof ofertas.Resultado !== 'undefined') {
                  //           validarProblema('Zurich', ofertas);
                  //           agregarAseguradoraFallida(plan);
                  //           if (zurichStates[plan].errors) {
                  //             ofertas.Mensajes.forEach(mensaje => {
                  //               mostrarAlertarCotizacionFallida(`Zurich`, mensaje);
                  //             });
                  //           }
                  //           zurichStates[plan].errors = false;
                  //         } else {
                  //           const contadorPorEntidad = validarOfertas(ofertas, 'Zurich', 1);
                  //           if (zurichStates[plan].success) {
                  //             mostrarAlertaCotizacionExitosa(`Zurich`, contadorPorEntidad);
                  //             zurichStates[plan].success = false;
                  //           }
                  //         }
                  //       })
                  //       .catch((err) => {
                  //         agregarAseguradoraFallida(plan);
                  //         mostrarAlertarCotizacionFallida('Zurich', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //         console.error(err);
                  //       })
                  //   );
                  // });
    
                  /* Estado */
                  // const aseguradorasEstado = ["Estado", "Estado2"]; // Agrega más aseguradoras según sea necesario
                  // aseguradorasEstado.forEach((aseguradora) => {
                  //   let successAseguradora = true;
                  //   cont.push(
                  //     fetch(`https://grupoasistencia.com/motor_webservice_tst2/${aseguradora}?callback=myCallback`, requestOptions)
                  //       .then((res) => {
                  //         if (!res.ok) throw Error(res.statusText);
                  //         return res.json();
                  //       })
                  //       .then((ofertas) => {
                  //         let result = [];
                  //         result.push(ofertas);
                  //         if (typeof result[0].Resultado !== 'undefined') {
                  //           agregarAseguradoraFallida("Estado");
                  //           validarProblema(aseguradora, result);
                  //           result[0].Mensajes.forEach(mensaje => {
                  //             mostrarAlertarCotizacionFallida(aseguradora, mensaje);
                  //           });
                  //         } else {
                  //           const contadorPorEntidad = validarOfertas(result, aseguradora, 1);
                  //           if (successAseguradora) {
                  //             mostrarAlertaCotizacionExitosa(aseguradora, contadorPorEntidad);
                  //             successAseguradora = false;
                  //           }
                  //         }
                  //       })
                  //       .catch((err) => {
                  //         agregarAseguradoraFallida("Estado");
                  //         mostrarAlertarCotizacionFallida(aseguradora, "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //         console.error(err);
                  //       })
                  //   );
                  // });
    
                  /* Liberty */
                  // cont.push(
                  //   fetch("https://grupoasistencia.com/motor_webservice_tst2/Liberty?callback=myCallback", requestOptions)
                  //     .then((res) => {
                  //       if (!res.ok) throw Error(res.statusText);
                  //       return res.json();
                  //     })
                  //     .then((ofertas) => {
                  //       if (typeof ofertas[0].Resultado !== 'undefined') {
                  //         agregarAseguradoraFallida('Liberty');
                  //         validarProblema('Liberty', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('Liberty', mensaje)
                  //         })
                  //       } else {
                  //         const contadorPorEntidad = validarOfertas(ofertas,'Liberty', 1);
                  //         mostrarAlertaCotizacionExitosa('Liberty', contadorPorEntidad)
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('Liberty')
                  //       mostrarAlertarCotizacionFallida('Liberty', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
      
                  /* Allianz */
                  // cont.push(
                  //   fetch("https://grupoasistencia.com/motor_webservice_tst2/Allianz?callback=myCallback", requestOptions)
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
                  //         agregarAseguradoraFallida('Allianz');
                  //         validarProblema('Allianz', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('Allianz', mensaje)
                  //         })
                  //       } else {
                  //         const contadorPorEntidad = validarOfertas(ofertas,'Allianz', 1);
                  //         mostrarAlertaCotizacionExitosa('Allianz', contadorPorEntidad)
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('Allianz')
                  //       mostrarAlertarCotizacionFallida('Allianz', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
      
                  /* AXA */
                  // cont.push(
                  //   fetch("https://grupoasistencia.com/motor_webservice_tst2/AXA_tst?callback=myCallback", requestOptions)
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
                  //         validarProblema('AXA', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('AXA', mensaje)
                  //         })
                  //       } else {
                  //         const contadorPorEntidad = validarOfertas(ofertas,'AXA', 1);
                  //         mostrarAlertaCotizacionExitosa('AXA', contadorPorEntidad)
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('AXA');
                  //       mostrarAlertarCotizacionFallida('AXA', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
                  
                  /* SBS */
                  // cont.push(
                  //   fetch("https://grupoasistencia.com/motor_webservice_tst2/SBS?callback=myCallback", requestOptions)
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
                  //       // let result = ofertas
                  //       if (typeof ofertas[0].Resultado !== 'undefined') {
                  //         agregarAseguradoraFallida('SBS');
                  //         validarProblema('SBS', ofertas);
                  //         ofertas[0].Mensajes.forEach(mensaje => {
                  //           mostrarAlertarCotizacionFallida('SBS', mensaje)
                  //         })
                  //       } else {
                  //         const contadorPorEntidad = validarOfertas(ofertas,'SBS', 1);
                  //         mostrarAlertaCotizacionExitosa('SBS', contadorPorEntidad)
                  //       }
                  //     })
                  //     .catch((err) => {
                  //       agregarAseguradoraFallida('SBS');
                  //       mostrarAlertarCotizacionFallida('SBS', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  //       console.error(err);
                  //     })
                  // );
                  
                  
                  Promise.all(cont).then(() => {
                    console.log(aseguradorasFallidas)
                    $("#btnCotizar").hide();
                    $("#loaderOferta").html("");
                    $("#loaderRecotOferta").html("");
                    swal.fire({
                      type: "success",
                      title: "¡Cotización finalizada!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                    });
                    setTimeout(function () {
                      //  window.location = "index.php?ruta=editar-cotizacion&idCotizacion=" + idCotizacion;
                    }, 3000);
      
                    // console.log("Se completo todo");
                    document.querySelector('.button-recotizar').style.display = 'block'
                    /* Se monta el botón para generar el pdf con 
                    el valor de la variable idCotizacion */
                    const contentCotizacionPDF = document.querySelector('#contenCotizacionPDFLivianos')
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

                  
                }

            }
  
          });
  
        } else {

          //ZONA RECOTIZACIÓN//
          const btnRecotizar = document.getElementById('btnReCotizarFallidas')
          btnRecotizar.disabled = true; 
          const contenParrilla = document.querySelector('#contenParrilla')
          raw.cotizacion = idCotizacion
  
          var requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: JSON.stringify(raw),
            redirect: "follow",
          };
  
          const mostrarAlertaCotizacionExitosa = (aseguradora, contador) => {
            if (aseguradora == "Estado2") {
              aseguradora = "Estado";
            }

            // Obtener la primera clave del objeto
            const primeraClave = Object.keys(contador)[0];

            // Obtener el valor asociado a la primera clave
            const contadorOfertas = contador[primeraClave];

            // Obtener la referencia de la tabla
            const tablaResumenCotBody = document.querySelector('#tablaResumenCot tbody');
          
            // Verificar si ya existe la fila
            const filaExistente = document.getElementById(aseguradora);
            if (filaExistente) {
                // Acceder directamente a las celdas de la fila existente
                const celdaContador = filaExistente.cells[2]; // Tercera celda de la fila
                const celdaCotizo = filaExistente.cells[1]; // Segunda celda de la fila
                const celdaResponse = filaExistente.cells[3]; // Cuarta celda de la fila
                // Actualizar los valores según sea necesario
                const contadorActualTexto = celdaContador.textContent.trim();
                // Verificar si el texto está vacío o no es un número
                const contadorActual = contadorActualTexto === '' ? 0 : parseInt(contadorActualTexto, 10);
                const nuevoContador = contadorActual + contadorOfertas;

                if(celdaContador.textContent.trim() !== '<i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i>'){
                  
                  celdaContador.textContent = nuevoContador;
                  celdaCotizo.innerHTML = '<i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;"></i>';
                  celdaResponse.textContent = 'Cotización exitosa';

                }else{

                  celdaContador.textContent = nuevoContador;
                  celdaCotizo.innerHTML = '<i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;"></i>';
                  celdaResponse.textContent = 'Cotización exitosa';

                }

            } else {
              // Si la fila no existe, puedes agregarla
              const nuevaFila = document.createElement('tr');
              nuevaFila.id = aseguradora;
              nuevaFila.innerHTML = `
                <td>${aseguradora}</td>
                <td style="text-align: center;"><i class="fa fa-check" aria-hidden="true" style="color: green; margin-right: 5px;"></i></td>
                <td style="text-align: center;">${contadorOfertas}</td>
                <td>Nuevo Valor para Response</td>
                <td>Nuevo Valor para Products</td>
                <td>Nuevo Valor para Observation</td>
              `;
              tablaResumenCotBody.appendChild(nuevaFila);
            }
          };     

          const mostrarAlertarCotizacionFallida = (aseguradora, mensaje) => {
            if(aseguradora == "Estado2"){
              aseguradora = "Estado"
            }
            console.log(aseguradora)
            console.log(mensaje)
            // Referecnia de la tabla
            const tablaResumenCotBody = document.querySelector('#tablaResumenCot tbody');
        
            // Verificar si ya existe una fila para la aseguradora
            const filaExistente = document.getElementById(aseguradora);
            
            if (filaExistente) {
                // Si la fila existe, actualiza el mensaje de observaciones
                
                // Acceder directamente a las celdas de la fila existente
                const celdaContador = filaExistente.cells[2]; // Tercera celda de la fila
                const celdaCotizo = filaExistente.cells[1]; // Segunda celda de la fila
                const celdaResponse = filaExistente.cells[3]; // Cuarta celda de la fila

                celdaContador.textContent = 0;
                celdaCotizo.innerHTML = '<i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i>';
                celdaResponse.textContent = mensaje;
  
                // Verifica si el mensaje es diferente antes de actualizar
                // if (observacionesActuales !== mensaje) {
                //   celdaObservaciones.textContent = mensaje;
                // } else {
                //   console.log(`${aseguradora} tiene alertas iguales: "${observacionesActuales}" === "${mensaje}"`);
                // }
  
            } else {
                // Si no existe, crea una nueva fila
                const nuevaFila = document.createElement('tr');
                nuevaFila.setAttribute('data-aseguradora', aseguradora);
                nuevaFila.innerHTML = `
                    <td>${aseguradora}</td>
                    <td style="text-align: center;"><i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i></td>
                    <td style="text-align: center;">0</td> <!-- Valor predeterminado para 'Productos cotizados' -->
                    <td>${mensaje}</td> <!-- Valor predeterminado para 'Observaciones' -->
                `;
          
                // Agregar la fila a la tabla
                tablaResumenCotBody.appendChild(nuevaFila);
            }
          };

          console.log(aseguradorasFallidas)
          aseguradorasFallidas.forEach(aseguradora => {
            if(aseguradora == 'BASIC' || aseguradora == 'MEDIUM'|| aseguradora == 'FULL'){
              aseguradora  = 'Zurich'
            }
            const celdaResponse = document.getElementById(`${aseguradora}Response`);
    
            // Agregar un elemento de carga (por ejemplo, un gif) en la celda de respuesta
            const loadingElement = document.createElement('img');
            loadingElement.src = 'vistas/img/plantilla/loader-update.gif'; // Reemplaza con la ruta correcta del gif
            loadingElement.alt = 'Cargando...';
    
             // Establecer el tamaño deseado del gif (por ejemplo, 50px x 50px)
            loadingElement.style.width = '22px';
            loadingElement.style.height = '22px';
    
            // Limpiar cualquier contenido existente en la celda de respuesta
            celdaResponse.innerHTML = '';
    
            // Agregar el elemento de carga a la celda de respuesta
            celdaResponse.appendChild(loadingElement);
          });
        
          let cont = [];
  
          /* Solidaria */
          // if (comprobarFallida('Solidaria')) {
            // cont.push(
            //   fetch(
            //     "https://grupoasistencia.com/motor_webservice_tst/Solidaria?callback=myCallback",
            //     requestOptions
            //   )
            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       // console.log(ofertas)
            //       if (typeof ofertas[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Solidaria');
            //         validarProblema('Solidaria', ofertas);
            //         ofertas[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Solidaria', mensaje)
            //         })
            //       } else {
            //         eliminarAseguradoraFallida('Solidaria')
            //         const contadorPorEntidad = validarOfertas(ofertas,'Solidaria', 1);
            //         mostrarAlertaCotizacionExitosa('Solidaria', contadorPorEntidad);
            //       }
            //     })
            //     .catch((err) => {
            //       agregarAseguradoraFallida('Solidaria')
            //       mostrarAlertarCotizacionFallida('Solidaria', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
            //       console.error(err);
            //     })
            // );
          // }

          /* Solidaria */
          const solidariaPromise = comprobarFallida('Solidaria')
          ? fetch("https://grupoasistencia.com/motor_webservice_tst2/Solidaria?callback=myCallback", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Solidaria');
                  validarProblema('Solidaria', ofertas);
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('Solidaria', mensaje);
                  });
                } else {
                  // eliminarAseguradoraFallida('Solidaria');
                  const contadorPorEntidad = validarOfertas(ofertas, 'Solidaria', 1);
                  mostrarAlertaCotizacionExitosa('Solidaria', contadorPorEntidad);
                }
              })
              .catch((err) => {
                agregarAseguradoraFallida('Solidaria');
                mostrarAlertarCotizacionFallida('Solidaria', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                console.error(err);
              })
          : Promise.resolve();

          cont.push(solidariaPromise);
          
  
  
          /* Previsora */
          // if (comprobarFallida('Previsora')) {
          //   cont.push(
          //     fetch("https://grupoasistencia.com/motor_webservice_tst/Previsora?callback=myCallback", requestOptions)
          //       .then((res) => {
          //         if (!res.ok) throw Error(res.statusText);
          //         return res.json();
          //       })
          //       .then((ofertas) => {
          //         if (typeof ofertas[0].Resultado !== 'undefined') {
          //           agregarAseguradoraFallida('Previsora');
          //           validarProblema('Previsora', ofertas);
          //           ofertas[0].Mensajes.forEach(mensaje => {
          //             mostrarAlertarCotizacionFallida('Previsora', mensaje)
          //           })
          //         } else {
          //           eliminarAseguradoraFallida('Previsora')
          //           // guardarAlertas('Previsora', 1);
          //           const contadorPorEntidad = validarOfertas(ofertas,'Previsora', 1);
          //           mostrarAlertaCotizacionExitosa('Previsora', contadorPorEntidad);

          //         }
          //       })
          //       .catch((err) => {
          //         agregarAseguradoraFallida('Previsora')
          //         mostrarAlertarCotizacionFallida('Previsora', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
          //         console.error(err);
          //       })
          //   );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }
          
              /* Previsora */
            const previsoraPromise = comprobarFallida('Previsora')
            ? fetch("https://grupoasistencia.com/motor_webservice_tst2/Previsora?callback=myCallback", requestOptions)
                .then((res) => {
                  if (!res.ok) throw Error(res.statusText);
                  return res.json();
                })
                .then((ofertas) => {
                  if (typeof ofertas[0].Resultado !== 'undefined') {
                    agregarAseguradoraFallida('Previsora');
                    validarProblema('Previsora', ofertas);
                    ofertas[0].Mensajes.forEach(mensaje => {
                      mostrarAlertarCotizacionFallida('Previsora', mensaje);
                    });
                  } else {
                    // eliminarAseguradoraFallida('Previsora');
                    const contadorPorEntidad = validarOfertas(ofertas, 'Previsora', 1);
                    mostrarAlertaCotizacionExitosa('Previsora', contadorPorEntidad);
                  }
                })
                .catch((err) => {
                  agregarAseguradoraFallida('Previsora');
                  mostrarAlertarCotizacionFallida('Previsora', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  console.error(err);
                })
            : Promise.resolve();

            cont.push(previsoraPromise);

  
          /* Equidad */
          // if (comprobarFallida('Equidad')) {
          //   cont.push(
          //     fetch("https://grupoasistencia.com/motor_webservice_tst/Equidad?callback=myCallback", requestOptions)
          //       .then((res) => {
          //         if (!res.ok) throw Error(res.statusText);
          //         return res.json();
          //       })
          //       .then((ofertas) => {
          //         if (typeof ofertas[0].Resultado !== 'undefined') {
          //           agregarAseguradoraFallida('Equidad');
          //           validarProblema('Equidad', ofertas);
          //           ofertas[0].Mensajes.forEach(mensaje => {
          //             mostrarAlertarCotizacionFallida('Equidad', mensaje)
          //           })
          //         } else {
          //           eliminarAseguradoraFallida('Equidad')
          //           const contadorPorEntidad = validarOfertas(ofertas,'Equidad', 1);
          //           mostrarAlertaCotizacionExitosa('Equidad', contadorPorEntidad);
          //         }
          //       })
          //       .catch((err) => {
          //         agregarAseguradoraFallida('Equidad')
          //         mostrarAlertarCotizacionFallida('Equidad', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
          //         console.error(err);
          //       })
          //   );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }
            /* Equidad */
          const equidadPromise = comprobarFallida('Equidad')
          ? fetch("https://grupoasistencia.com/motor_webservice_tst2/Equidad?callback=myCallback", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Equidad');
                  validarProblema('Equidad', ofertas);
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('Equidad', mensaje);
                  });
                } else {
                  // eliminarAseguradoraFallida('Equidad');
                  const contadorPorEntidad = validarOfertas(ofertas, 'Equidad', 1);
                  mostrarAlertaCotizacionExitosa('Equidad', contadorPorEntidad);
                }
              })
              .catch((err) => {
                agregarAseguradoraFallida('Equidad');
                mostrarAlertarCotizacionFallida('Equidad', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                console.error(err);
              })
          : Promise.resolve();

          cont.push(equidadPromise);
          
  
          /* Mapfre */
          // if (comprobarFallida('Mapfre')) {
          //   cont.push(
          //     fetch("https://grupoasistencia.com/motor_webservice_tst/mapfrecotizacion4?callback=myCallback", requestOptions)
          //       .then((res) => {
          //         if (!res.ok) throw Error(res.statusText);
          //         return res.json();
          //       })
          //       .then((ofertas) => {
          //         if (typeof ofertas[0].Resultado !== 'undefined') {
          //           agregarAseguradoraFallida('Mapfre')
          //           validarProblema('Mapfre', ofertas);
          //           ofertas[0].Mensajes.forEach(mensaje => {
          //             mostrarAlertarCotizacionFallida('Mapfre', mensaje)
          //           })
          //         } else {
          //           eliminarAseguradoraFallida('Mapfre')
          //           const contadorPorEntidad = validarOfertas(ofertas,'Mapfre', 1);
          //           // let successMap = true;
          //           // if (successMap) {
          //           mostrarAlertaCotizacionExitosa('Mapfre', contadorPorEntidad);
          //             // successMap = false
          //           // }
          //         }
          //       })
          //       .catch((err) => {
          //         agregarAseguradoraFallida('Mapfre')
          //         mostrarAlertarCotizacionFallida('Mapfre', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
          //         console.error(err);
          //       })
          //   );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }

            /* Mapfre */
          const mapfrePromise = comprobarFallida('Mapfre')
          ? fetch("https://grupoasistencia.com/motor_webservice_tst2/mapfrecotizacion4?callback=myCallback", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Mapfre');
                  validarProblema('Mapfre', ofertas);
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('Mapfre', mensaje);
                  });
                } else {
                  // eliminarAseguradoraFallida('Mapfre');
                  const contadorPorEntidad = validarOfertas(ofertas, 'Mapfre', 1);
                  mostrarAlertaCotizacionExitosa('Mapfre', contadorPorEntidad);
                }
              })
              .catch((err) => {
                agregarAseguradoraFallida('Mapfre');
                mostrarAlertarCotizacionFallida('Mapfre', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                console.error(err);
              })
          : Promise.resolve();

          cont.push(mapfrePromise);
  
  
          /* Bolivar */
          // if (comprobarFallida('Bolivar')) {
          //   cont.push(
          //     fetch("https://grupoasistencia.com/motor_webservice_tst/Bolivar?callback=myCallback", requestOptions)
          //       .then((res) => {
          //         if (!res.ok) throw Error(res.statusText);
          //         return res.json();
          //       })
          //       .then((ofertas) => {
          //         // console.log(ofertas)
          //         if (typeof ofertas[0].Resultado !== 'undefined') {
          //           agregarAseguradoraFallida('Bolivar');
          //           validarProblema('Bolivar', ofertas);
          //           ofertas[0].Mensajes.forEach(mensaje => {
          //             mostrarAlertarCotizacionFallida('Bolivar', mensaje)
          //           })
          //         } else {
          //           eliminarAseguradoraFallida('Bolivar')
          //           const contadorPorEntidad = validarOfertas(ofertas,'Bolivar', 1);
          //           mostrarAlertaCotizacionExitosa('Bolivar', contadorPorEntidad);
          //         }
          //       })
          //       .catch((err) => {
          //         agregarAseguradoraFallida('Bolivar')
          //         mostrarAlertarCotizacionFallida('Bolivar', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
          //         console.error(err);
          //       })
          //   );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }


            /* Bolivar */
          const bolivarPromise = comprobarFallida('Bolivar')
          ? fetch("https://grupoasistencia.com/motor_webservice_tst2/Bolivar?callback=myCallback", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Bolivar');
                  validarProblema('Bolivar', ofertas);
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('Bolivar', mensaje);
                  });
                } else {
                  // eliminarAseguradoraFallida('Bolivar');
                  const contadorPorEntidad = validarOfertas(ofertas, 'Bolivar', 1);
                  mostrarAlertaCotizacionExitosa('Bolivar', contadorPorEntidad);
                }
              })
              .catch((err) => {
                agregarAseguradoraFallida('Bolivar');
                mostrarAlertarCotizacionFallida('Bolivar', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                console.error(err);
              })
          : Promise.resolve();

          cont.push(bolivarPromise);
          
  
          /* HDI */
          // if (comprobarFallida('HDI')) {
          //   cont.push(
          //     fetch("https://grupoasistencia.com/motor_webservice_tst/HDI?callback=myCallback", requestOptions)
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
          // // if (comprobarFallida('Zurich')) {
          //   const planes = ["BASIC", "MEDIUM", "FULL"]
          //   let body = JSON.parse(requestOptions.body)
          //   planes.forEach(plan => {
          //     let body = JSON.parse(requestOptions.body);
          //     body.plan = plan;
          //     body.Email = Math.round(Math.random() * 999999) + body.Email;
          //     requestOptions.body = JSON.stringify(body);
            
          //     const zurichPromise = comprobarFallida('Zurich')
          //       ? fetch('https://grupoasistencia.com/motor_webservice_tst/Zurich?callback=myCallback', requestOptions)
          //           .then((res) => {
          //             if (res.status === 500) {
          //               throw Error("Error interno del servidor (HTTP 500)");
          //             }
          //             if (!res.ok) {
          //               throw Error(res.statusText);
          //             }
          //             return res.json();
          //           })
          //           .then(ofertas => {
          //             if (typeof ofertas.Resultado !== 'undefined') {
          //               validarProblema('Zurich', ofertas);
          //               agregarAseguradoraFallida('Zurich');
          //               if (zurichErrors) {
          //                 ofertas.Mensajes.forEach(mensaje => {
          //                   mostrarAlertarCotizacionFallida(`Zurich`, mensaje);
          //                 });
          //               }
          //               zurichErrors = false;
          //             } else {
          //               eliminarAseguradoraFallida('Zurich');
          //               const contadorPorEntidad = validarOfertas(ofertas, 'Zurich', 1);
          //               if (zurichSuccess) {
          //                 mostrarAlertaCotizacionExitosa('Zurich', contadorPorEntidad);
          //                 zurichSuccess = false;
          //               }
          //             }
          //           })
          //           .catch((err) => {
          //             agregarAseguradoraFallida('Zurich');
          //             mostrarAlertarCotizacionFallida('Zurich', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
          //             console.error(err);
          //           })
          //       : Promise.resolve();
            
          //     cont.push(zurichPromise);
          //   });
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }

            /* HDI */
            const HDIPromise = comprobarFallida('HDI')
            ? fetch("https://grupoasistencia.com/motor_webservice/HdiPlus?callback=myCallback", requestOptions)
                .then((res) => {
                  if (!res.ok) throw Error(res.statusText);
                  return res.json();
                })
                .then((ofertas) => {
                  if (typeof ofertas[0].Resultado !== 'undefined') {
                    agregarAseguradoraFallida('HDI');
                    validarProblema('HDI', ofertas);
                    ofertas[0].Mensajes.forEach(mensaje => {
                      mostrarAlertarCotizacionFallida('HDI', mensaje);
                    });
                  } else {
                    // eliminarAseguradoraFallida('HDI');
                    const contadorPorEntidad = validarOfertas(ofertas, 'HDI', 1);
                    mostrarAlertaCotizacionExitosa('HDI', contadorPorEntidad);
                  }
                })
                .catch((err) => {
                  agregarAseguradoraFallida('HDI');
                  mostrarAlertarCotizacionFallida('HDI', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  console.error(err);
                })
            : Promise.resolve();
  
            cont.push(HDIPromise);


          /* Zurich */
        //   let zurichStates = {};
        //   const planes = ["BASIC", "MEDIUM", "FULL"];
        //   let body = JSON.parse(requestOptions.body);

        //   planes.forEach(plan => {
        //     let body = JSON.parse(requestOptions.body);
        //     body.plan = plan;
        //     body.Email = Math.round(Math.random() * 999999) + body.Email;
        //     requestOptions.body = JSON.stringify(body);

        //     // Inicializa los estados de Zurich para cada plan
        //     zurichStates[plan] = {
        //       success: true,
        //       errors: true
        //     };

        //     const zurichPromise = comprobarFallida('Zurich')
        //       ? fetch('https://grupoasistencia.com/motor_webservice_tst2/Zurich?callback=myCallback', requestOptions)
        //           .then((res) => {
        //             if (res.status === 500) {
        //               throw Error("Error interno del servidor (HTTP 500)");
        //             }
        //             if (!res.ok) {
        //               throw Error(res.statusText);
        //             }
        //             return res.json();
        //           })
        //           .then(ofertas => {
        //             if (typeof ofertas.Resultado !== 'undefined') {
        //               validarProblema('Zurich', ofertas);
        //               agregarAseguradoraFallida('Zurich');
        //               if (zurichStates[plan].errors) {
        //                 ofertas.Mensajes.forEach(mensaje => {
        //                   mostrarAlertarCotizacionFallida(`Zurich`, mensaje);
        //                 });
        //               }
        //               zurichStates[plan].errors = false;
        //             } else {
        //               // eliminarAseguradoraFallida('Zurich');
        //               const contadorPorEntidad = validarOfertas(ofertas, 'Zurich', 1);
        //               if (zurichStates[plan].success) {
        //                 mostrarAlertaCotizacionExitosa(`Zurich`, contadorPorEntidad);
        //                 zurichStates[plan].success = false;
        //               }
        //             }
        //           })
        //           .catch((err) => {
        //             agregarAseguradoraFallida('Zurich');
        //             mostrarAlertarCotizacionFallida('Zurich', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
        //             console.error(err);
        //           })
        //       : Promise.resolve();

        //     cont.push(zurichPromise);
        //   });
        
        const ZBasicPromise = comprobarFallida('BASIC')
            ? fetch("https://grupoasistencia.com/motor_webservice_tst2/Zurich?callback=myCallback", {
                ...requestOptions,
                method: 'POST',  // Ajusta el método según tu necesidad
                headers: {
                  ...requestOptions.headers,
                  'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                  ...JSON.parse(requestOptions.body),
                  plan: 'BASIC',  // Agrega la clave plan con el valor "BASIC"
                  Email2: Math.round(Math.random() * 999999) + "@gmail.com",
                }),
              })
                .then((res) => {
                  if (!res.ok) throw Error(res.statusText);
                  return res.json();
                })
                .then((ofertas) => {
                  if (typeof ofertas.Resultado !== 'undefined') {
                    agregarAseguradoraFallida('Zurich');
                    validarProblema('Zurich', ofertas);
                    ofertas.Mensajes.forEach(mensaje => {
                      mostrarAlertarCotizacionFallida('Zurich', mensaje);
                    });
                  } else {
                    // eliminarAseguradoraFallida('Zurich');
                    const contadorPorEntidad = validarOfertas(ofertas, 'Zurich', 1);
                    mostrarAlertaCotizacionExitosa('Zurich', contadorPorEntidad);
                  }
                })
                .catch((err) => {
                  agregarAseguradoraFallida('Zurich');
                  mostrarAlertarCotizacionFallida('Zurich', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  console.error(err);
                })
            : Promise.resolve();

          cont.push(ZBasicPromise);

          // Para 'FULL'
          const ZFullPromise = comprobarFallida('FULL')
          ? fetch("https://grupoasistencia.com/motor_webservice_tst2/Zurich?callback=myCallback", {
              ...requestOptions,
              method: 'POST',
              headers: {
                ...requestOptions.headers,
                'Content-Type': 'application/json',
              },
              body: JSON.stringify({
                ...JSON.parse(requestOptions.body),
                plan: 'FULL',
                Email2: Math.round(Math.random() * 999999) + "@gmail.com",
              }),
            })
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            })
            .then((ofertas) => {
              if (typeof ofertas.Resultado !== 'undefined') {
                agregarAseguradoraFallida('Zurich');
                validarProblema('Zurich', ofertas);
                ofertas.Mensajes.forEach(mensaje => {
                  mostrarAlertarCotizacionFallida('Zurich', mensaje);
                });
              } else {
                const contadorPorEntidad = validarOfertas(ofertas, 'Zurich', 1);
                mostrarAlertaCotizacionExitosa('Zurich', contadorPorEntidad);
              }
            })
            .catch((err) => {
              agregarAseguradoraFallida('Zurich');
              mostrarAlertarCotizacionFallida('Zurich', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
              console.error(err);
            })
          : Promise.resolve();

          cont.push(ZFullPromise);

          // Para 'MEDIUM'
          const ZMediumPromise = comprobarFallida('MEDIUM')
          ? fetch("https://grupoasistencia.com/motor_webservice_tst2/Zurich?callback=myCallback", {
              ...requestOptions,
              method: 'POST',
              headers: {
                ...requestOptions.headers,
                'Content-Type': 'application/json',
              },
              body: JSON.stringify({
                ...JSON.parse(requestOptions.body),
                plan: 'MEDIUM',
                Email2: Math.round(Math.random() * 999999) + "@gmail.com",
              }),
            })
            .then((res) => {
              if (!res.ok) throw Error(res.statusText);
              return res.json();
            })
            .then((ofertas) => {
              if (typeof ofertas.Resultado !== 'undefined') {
                agregarAseguradoraFallida('Zurich');
                validarProblema('Zurich', ofertas);
                ofertas.Mensajes.forEach(mensaje => {
                  mostrarAlertarCotizacionFallida('Zurich', mensaje);
                });
              } else {
                const contadorPorEntidad = validarOfertas(ofertas, 'Zurich', 1);
                mostrarAlertaCotizacionExitosa('Zurich', contadorPorEntidad);
              }
            })
            .catch((err) => {
              agregarAseguradoraFallida('Zurich');
              mostrarAlertarCotizacionFallida('Zurich', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
              console.error(err);
            })
          : Promise.resolve();

          cont.push(ZMediumPromise);

          
  
          // let successEstado = true
  
          /* Estado */
          // if (comprobarFallida('Estado')) {
            // cont.push(
            // const estadoPromise = comprobarFallida('Estado')
            // ? fetch("https://grupoasistencia.com/motor_webservice_tst/Estado?callback=myCallback", requestOptions)
            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       let result = []
            //       result.push(ofertas)
            //       if (typeof result[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Estado');
            //         validarProblema('Estado', result);
            //         result[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Estado', mensaje)
            //         })
            //       } else {
            //         eliminarAseguradoraFallida('Estado')
            //         const contadorPorEntidad = validarOfertas(result,'Estado', 1);
            //         if (successEstado) {
            //           mostrarAlertaCotizacionExitosa('Estado', contadorPorEntidad)
            //           successEstado = false
            //         }
            //       }
            //     })
            //     .catch((err) => {
            //       agregarAseguradoraFallida('Estado')
            //       mostrarAlertarCotizacionFallida('Estado', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
            //       console.error(err);
            //     })
            //     : Promise.resolve();
  
            //     cont.push(estadoPromise);
            // );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }
          
  
          /* Estado2 */
          // if (comprobarFallida('Estado2')) {
            // cont.push(
            // const estado2Promise = comprobarFallida('Estado2')
            // ? fetch("https://grupoasistencia.com/motor_webservice_tst/Estado2?callback=myCallback", requestOptions)
            //     .then((res) => {
            //       if (!res.ok) throw Error(res.statusText);
            //       return res.json();
            //     })
            //     .then((ofertas) => {
            //       let result = []
            //       result.push(ofertas)
            //       if (typeof result[0].Resultado !== 'undefined') {
            //         agregarAseguradoraFallida('Estado2');///aqui decia Zurich2
            //         validarProblema('Estado', result);
            //         result[0].Mensajes.forEach(mensaje => {
            //           mostrarAlertarCotizacionFallida('Estado', mensaje)
            //         })
            //       } else {
            //         eliminarAseguradoraFallida('Estado');
            //         const contadorPorEntidad = validarOfertas(result,'Estado', 1);
            //         if (successEstado) {
            //           mostrarAlertaCotizacionExitosa('Estado', contadorPorEntidad)
            //           successEstado = false
            //         }
            //       }
            //     })
            //     .catch((err) => {
            //       agregarAseguradoraFallida('Estado2')
            //       mostrarAlertarCotizacionFallida('Estado', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
            //       console.error(err);
            //     })
            //     : Promise.resolve();
  
            //     cont.push(estado2Promise);
            // );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }

            /* Estado */
          const aseguradorasEstado = ["Estado", "Estado2"]; // Agrega más aseguradoras según sea necesario
          aseguradorasEstado.forEach((aseguradora) => {
            let successAseguradora = true;
            const aseguradoraPromise = comprobarFallida(aseguradora)
              ? fetch(`https://grupoasistencia.com/motor_webservice_tst2/${aseguradora}?callback=myCallback`, requestOptions)
                  .then((res) => {
                    if (!res.ok) throw Error(res.statusText);
                    return res.json();
                  })
                  .then((ofertas) => {
                    let result = [];
                    result.push(ofertas);
                    if (typeof result[0].Resultado !== 'undefined') {
                      agregarAseguradoraFallida("Estado");
                      validarProblema(aseguradora, result);
                      result[0].Mensajes.forEach(mensaje => {
                        mostrarAlertarCotizacionFallida(aseguradora, mensaje);
                      });
                    } else {
                      const contadorPorEntidad = validarOfertas(result, aseguradora, 1);
                      if (successAseguradora) {
                        mostrarAlertaCotizacionExitosa(aseguradora, contadorPorEntidad);
                        successAseguradora = false;
                      }
                    }
                  })
                  .catch((err) => {
                    agregarAseguradoraFallida("Estado");
                    mostrarAlertarCotizacionFallida(aseguradora, "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                    console.error(err);
                  })
              : Promise.resolve();

            cont.push(aseguradoraPromise);
          });

          
  
          /* Liberty */
          // if (comprobarFallida('Liberty')) {
          //   cont.push(
          //     fetch("https://grupoasistencia.com/motor_webservice_tst/Liberty?callback=myCallback", requestOptions)
          //       .then((res) => {
          //         if (!res.ok) throw Error(res.statusText);
          //         return res.json();
          //       })
          //       .then((ofertas) => {
          //         if (typeof ofertas[0].Resultado !== 'undefined') {
          //           agregarAseguradoraFallida('Liberty');
          //           validarProblema('Liberty', ofertas);
          //           ofertas[0].Mensajes.forEach(mensaje => {
          //             mostrarAlertarCotizacionFallida('Liberty', mensaje)
          //           })
          //         } else {
          //           eliminarAseguradoraFallida('Liberty');
          //           const contadorPorEntidad = validarOfertas(ofertas,'Liberty', 1);
          //           mostrarAlertaCotizacionExitosa('Liberty', contadorPorEntidad);
          //         }
          //       })
          //       .catch((err) => {
          //         agregarAseguradoraFallida('Liberty')
          //         mostrarAlertarCotizacionFallida('Liberty', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
          //         console.error(err);
          //       })
          //   );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }
          
            /* Liberty */
            const libertyPromise = comprobarFallida('Liberty')
            ? fetch("https://grupoasistencia.com/motor_webservice_tst2/Liberty?callback=myCallback", requestOptions)
                .then((res) => {
                  if (!res.ok) throw Error(res.statusText);
                  return res.json();
                })
                .then((ofertas) => {
                  if (typeof ofertas[0].Resultado !== 'undefined') {
                    agregarAseguradoraFallida('Liberty');
                    validarProblema('Liberty', ofertas);
                    ofertas[0].Mensajes.forEach(mensaje => {
                      mostrarAlertarCotizacionFallida('Liberty', mensaje);
                    });
                  } else {
                    // eliminarAseguradoraFallida('Liberty');
                    const contadorPorEntidad = validarOfertas(ofertas, 'Liberty', 1);
                    mostrarAlertaCotizacionExitosa('Liberty', contadorPorEntidad);
                  }
                })
                .catch((err) => {
                  agregarAseguradoraFallida('Liberty');
                  mostrarAlertarCotizacionFallida('Liberty', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                  console.error(err);
                })
            : Promise.resolve();
  
            cont.push(libertyPromise);
  
          /* Allianz */
          // if (comprobarFallida('Allianz')) {
          //   cont.push(
          //     fetch("https://grupoasistencia.com/motor_webservice_tst/Allianz?callback=myCallback", requestOptions)
          //       .then((res) => {
          //         if (!res.ok) throw Error(res.statusText);
          //         console.log(res);
          //         return res.json();
          //       })
          //       .then((ofertas) => {
          //         if (typeof ofertas[0].Resultado !== 'undefined') {
          //           agregarAseguradoraFallida('Allianz');
          //           validarProblema('Allianz', ofertas);
          //           ofertas[0].Mensajes.forEach(mensaje => {
          //             mostrarAlertarCotizacionFallida('Allianz', mensaje)
          //           })
          //         } else {
          //           eliminarAseguradoraFallida('Allianz');
          //           const contadorPorEntidad = validarOfertas(ofertas,'Allianz', 1);
          //           mostrarAlertaCotizacionExitosa('Allianz', contadorPorEntidad)
          //         }
          //       })
          //       .catch((err) => {
          //         agregarAseguradoraFallida('Allianz')
          //         mostrarAlertarCotizacionFallida('Allianz', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
          //         console.error(err);
          //       })
          //   );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }

            /* Allianz */
          const allianzPromise = comprobarFallida('Allianz')
          ? fetch("https://grupoasistencia.com/motor_webservice_tst2/Allianz?callback=myCallback", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Allianz');
                  validarProblema('Allianz', ofertas);
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('Allianz', mensaje);
                  });
                } else {
                  // eliminarAseguradoraFallida('Allianz');
                  const contadorPorEntidad = validarOfertas(ofertas, 'Allianz', 1);
                  mostrarAlertaCotizacionExitosa('Allianz', contadorPorEntidad);
                }
              })
              .catch((err) => {
                agregarAseguradoraFallida('Allianz');
                mostrarAlertarCotizacionFallida('Allianz', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                console.error(err);
              })
          : Promise.resolve();

          cont.push(allianzPromise);

          
          
  
          /* AXA */
          // if (comprobarFallida('AXA')) {
          //   cont.push(
          //     fetch("https://grupoasistencia.com/motor_webservice_tst/AXA?callback=myCallback", requestOptions)
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
          //           eliminarAseguradoraFallida('AXA');
          //           const contadorPorEntidad = validarOfertas(ofertas,'AXA', 1);
          //           mostrarAlertaCotizacionExitosa('AXA', contadorPorEntidad);
          //         }
          //       })
          //       .catch((err) => {
          //         agregarAseguradoraFallida('AXA')
          //         mostrarAlertarCotizacionFallida('AXA', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
          //         console.error(err);
          //       })
          //   );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }
          
             /* AXA */
          const axaPromise = comprobarFallida('AXA')
          ? fetch("https://grupoasistencia.com/motor_webservice_tst2/AXA_tst?callback=myCallback", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('AXA');
                  validarProblema('AXA', ofertas);
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('AXA', mensaje);
                  });
                } else {
                  // eliminarAseguradoraFallida('AXA');
                  const contadorPorEntidad = validarOfertas(ofertas, 'AXA', 1);
                  mostrarAlertaCotizacionExitosa('AXA', contadorPorEntidad);
                }
              })
              .catch((err) => {
                agregarAseguradoraFallida('AXA');
                mostrarAlertarCotizacionFallida('AXA', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                console.error(err);
              })
          : Promise.resolve();

          cont.push(axaPromise);
  
          /* SBS */
          // if (comprobarFallida('SBS')) {
          //   cont.push(
          //     fetch("https://grupoasistencia.com/motor_webservice_tst/SBS?callback=myCallback", requestOptions)
          //       .then((res) => {
          //         if (!res.ok) throw Error(res.statusText);
          //         return res.json();
          //       })
          //       .then((ofertas) => {
          //         let result = ofertas
          //         if (typeof result[0].Resultado !== 'undefined') {
          //           agregarAseguradoraFallida('SBS');
          //           validarProblema('SBS', ofertas);
          //           result[0].Mensajes.forEach(mensaje => {
          //             mostrarAlertarCotizacionFallida('SBS', mensaje)
          //           })
          //         } else {
          //           eliminarAseguradoraFallida('SBS');
          //           const contadorPorEntidad = validarOfertas(ofertas,'SBS', 1);
          //           mostrarAlertaCotizacionExitosa('SBS', contadorPorEntidad);
          //         }
          //       })
          //       .catch((err) => {
          //         agregarAseguradoraFallida('SBS')
          //         mostrarAlertarCotizacionFallida('SBS', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
          //         console.error(err);
          //       })
          //   );
          // } else {
          //   // Agrega un manejador de promesas rechazadas para evitar que Promise.all falle si cont está vacío
          //   cont.push(Promise.reject('No hay elementos en cont'));
          // }

            /* SBS */
          const sbsPromise = comprobarFallida('SBS')
          ? fetch("https://grupoasistencia.com/motor_webservice_tst2/SBS?callback=myCallback", requestOptions)
              .then((res) => {
                if (!res.ok) throw Error(res.statusText);
                return res.json();
              })
              .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('SBS');
                  validarProblema('SBS', ofertas);
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('SBS', mensaje);
                  });
                } else {
                  // eliminarAseguradoraFallida('SBS');
                  const contadorPorEntidad = validarOfertas(ofertas, 'SBS', 1);
                  mostrarAlertaCotizacionExitosa('SBS', contadorPorEntidad);
                }
              })
              .catch((err) => {
                agregarAseguradoraFallida('SBS');
                mostrarAlertarCotizacionFallida('SBS', "Error de conexión. Intente de nuevo o comuníquese con el equipo comercial");
                console.error(err);
              })
          : Promise.resolve();

          cont.push(sbsPromise);

  
          Promise.all(cont).then(() => {
            
            $("#loaderOferta").html("");
            $("#loaderRecotOferta").html("");
            swal.fire({
              type: "success",
              title: "¡Proceso de recotización finalizado!",
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
  
        // const mostrarAlertarCotizacionFallida = (aseguradora, mensaje) => {
        //   document.querySelector('.fallidas').innerHTML += `<p><i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i><b>${aseguradora}:</b> ${mensaje}</p>`
        // }
        
        /* Solidaria */
        // if (comprobarFallida('Solidaria')) {
        //   cont.push(
        //     fetch("https://grupoasistencia.com/motor_webservice/Solidaria", requestOptions)
        //       .then((res) => {
        //         if (!res.ok) throw Error(res.statusText);
        //         return res.json();
        //       }).then((ofertas) => {
        //         console.log(ofertas)
        //         if (typeof ofertas[0].Resultado !== 'undefined') {
        //           agregarAseguradoraFallida('Solidaria')
        //         } else {
        //           validarOfertas(ofertas);
        //           mostrarAlertaCotizacionExitosa('Solidaria')
        //           eliminarAseguradoraFallida('Solidaria')
        //         }
        //       }).catch((err) => {
        //         console.error(err);
        //       })
        //   );
        // }
  
  
        /* Previsora */
        // if (comprobarFallida('Previsora')) {
        //   cont.push(fetch("https://grupoasistencia.com/motor_webservice/Previsora", requestOptions)
        //     .then((res) => {
        //       if (!res.ok) throw Error(res.statusText);
        //       return res.json();
        //     }).then((ofertas) => {
        //       if (typeof ofertas[0].Resultado !== 'undefined') {
        //         agregarAseguradoraFallida('Previsora')
        //       } else {
        //         validarOfertas(ofertas);
        //         mostrarAlertaCotizacionExitosa('Previsora')
        //         eliminarAseguradoraFallida('Previsora')
        //       }
        //     })
        //     .catch((err) => {
        //       console.error(err);
        //     })
        //   );
        // }
  
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
        // if (comprobarFallida('Bolivar')) {
        //   cont.push(
        //     fetch("https://grupoasistencia.com/motor_webservice/Bolivar", requestOptions)
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
  
        /* HDI */
        // if (comprobarFallida('HDI')) {
        //   cont.push(
        //     fetch("https://grupoasistencia.com/motor_webservice/HDI", requestOptions)
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
  
        let zurichErrors = true
        let zurichSuccess = true
  
        /* Zurich */
        // if (comprobarFallida('Zurich')) {
        //   const planes = ["BASIC", "MEDIUM", "FULL"]
        //   let body = JSON.parse(requestOptions.body)
        //   planes.forEach(plan => {
        //     body.plan = plan
        //     body.Email = Math.round(Math.random() * 999999) + body.Email
        //     requestOptions.body = JSON.stringify(body)
        //     cont.push(
        //       fetch('https://grupoasistencia.com/motor_webservice/Zurich', requestOptions)
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
  
        let successEstado = true
  
        /* Estado */
        // if (comprobarFallida('Estado')) {
        //   cont.push(
        //     fetch("https://grupoasistencia.com/motor_webservice/Estado", requestOptions)
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
  
        /* Estado2 */
        // if (comprobarFallida('Estado2')) {
        //   cont.push(
        //     fetch("https://grupoasistencia.com/motor_webservice/Estado2", requestOptions)
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
  
        /* Liberty */
        // if (comprobarFallida('Liberty')) {
        //   cont.push(
        //     fetch("https://grupoasistencia.com/motor_webservice/Liberty", requestOptions)
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
  
        /* Allianz */
        // if (comprobarFallida('Allianz')) {
        //   cont.push(
        //     fetch("https://grupoasistencia.com/motor_webservice/Allianz", requestOptions)
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
  
        /* AXA */
        // if (comprobarFallida('AXA')) {
        //   cont.push(
        //     fetch("https://grupoasistencia.com/motor_webservice/AXA", requestOptions)
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
  
        /* SBS */
        // if (comprobarFallida('SBS')) {
        //   cont.push(
        //     fetch("https://grupoasistencia.com/motor_webservice/SBS", requestOptions)
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
      }
  
      // const mostrarAlertarCotizacionFallida = (aseguradora, mensaje) => {
      //   document.querySelector('.fallidas').innerHTML += `<p><i class="fa fa-times" aria-hidden="true" style="color: red; margin-right: 10px;"></i><b>${aseguradora}:</b> ${mensaje}</p>`
      // }
  
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
