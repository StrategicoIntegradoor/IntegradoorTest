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
  
    // Excepción de Motos
    // var placaInput = document.getElementById("placaVeh");
    // var mensajeError = document.getElementById("mensajeErrorPlaca");
  
    // placaInput.addEventListener("blur", function () {
    //     var placa = placaInput.value.trim(); // Eliminar espacios en blanco al principio y al final
        
    //     // Usar una expresión regular para validar el formato AAA111
    //     var formatoValido = /^[A-Z]{3}\d{3}$/.test(placa);
        
    //     if (formatoValido) {
    //         mensajeError.style.display = "none";
    //         placaInput.setCustomValidity("");
    //     } else {
    //         mensajeError.style.display = "block";
    //         mensajeError.textContent = "Formato de placa incorrecto, verificar información";
    //         placaInput.setCustomValidity("Formato de placa incorrecto, verificar información");
    //     }
    // });
  
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
      document.getElementById("placaVeh").value = "CAT770";
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
  
    // Consulta informacion del usuario en la bdd
    $("#numDocumentoID").change(function () {
      consultarAsegurado();
    });
  
    // Obtener los campos de entrada por su ID
    var nombreInput = document.getElementById("txtNombres");
    var apellidoInput = document.getElementById("txtApellidos");
  
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
  
    // Ejectura la funcion Consultar Placa Vehiculo pesado
    $("#btnConsultarPlacaPesados").click(function () {
      consulPlacaPesados();
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

  function consulPlaca() {
    var numplaca = document.getElementById("placaVeh").value;
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
                document.getElementById("formularioVehiculo").style.display =
                  "block";
                $("#loaderPlaca").html("");
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
            } else if (
              mensajeConsulta == "Vehículo no encontrado." ||
              mensajeConsulta == "Unable to connect to the remote server"
            ) {
              document.getElementById("formularioVehiculo").style.display =
                "block";
            } else {
              contErrMetEstado++;
              if (contErrMetEstado > 1) {
                document.getElementById("formularioVehiculo").style.display =
                  "block";
                contErrMetEstado = 0;
              } else {
                setTimeout(consulPlaca, 2000);
              }
            }
            $("#loaderPlaca").html("");
          }
        })
        .catch(function (error) {
          console.log("Parece que hubo un problema: \n", error);
  
          contErrProtocolo++;
          if (contErrProtocolo > 1) {
            $("#loaderPlaca").html("");
            document.getElementById("formularioVehiculo").style.display = "block";
            contErrProtocolo = 0;
          } else {
            setTimeout(consulPlaca, 4000);
          }
        });
    }
  }
  
  
  // Permite consultar la informacion del vehiculo por medio de la Placa (Seguros del Estado)
  function consulPlacaPesados() {
    var numplaca = document.getElementById("placaVeh").value;
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
  
      var raw = JSON.stringify({ Placa: valnumplaca });
  
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
          // console.log(myJson);
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
  
            console.log(codigoFasecolda)
            console.log(valorAsegurado)

            if(codigoFasecolda != null){
              if (valorAsegurado == "null" || valorAsegurado == null) {
                document.getElementById("formularioVehiculo").style.display =
                  "block";
                $("#loaderPlaca").html("");
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
            } else if (
              mensajeConsulta == "Vehículo no encontrado." ||
              mensajeConsulta == "Unable to connect to the remote server"
            ) {
              document.getElementById("formularioVehiculo").style.display =
                "block";
            } else {
              contErrMetEstado++;
              if (contErrMetEstado > 1) {
                document.getElementById("formularioVehiculo").style.display =
                  "block";
                contErrMetEstado = 0;
              } else {
                setTimeout(consulPlaca, 2000);
              }
            }
            $("#loaderPlaca").html("");
          }
        })
        .catch(function (error) {
          console.log("Parece que hubo un problema: \n", error);
  
          contErrProtocolo++;
          if (contErrProtocolo > 1) {
            $("#loaderPlaca").html("");
            document.getElementById("formularioVehiculo").style.display = "block";
            contErrProtocolo = 0;
          } else {
            setTimeout(consulPlaca, 4000);
          }
        });
    }
  }
  
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
          if (placaVeh == "CAT770") {
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
    responsabilidad_civil_familiar,
    manual,
    pdf,
  ) {
    return new Promise((resolve, reject) => {
      var idCotizOferta = idCotizacion
      var numDocumentoID = document.getElementById("numDocumentoID").value
      var placa = document.getElementById("placaVeh").value
      if (manual == null) { 
        manual = 0;
      }
      // console.log(placa)
      // console.log(idCotizOferta)
      // console.log(numDocumentoID)
      // console.log(aseguradora)
      // console.log(numCotizOferta)
      // console.log(producto)
      // console.log(prima)
      // console.log(valorRC)
      // console.log(PT)
      // console.log(PP)
      // console.log(CE)
      // console.log(GR)
      // console.log(logo)
      // console.log(UrlPdf)
      // console.log(manual)
      // console.log(pdf)
      // console.log(responsabilidad_civil_familiar) 
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
          pdf: pdf,
          responsabilidad_civil_familiar: responsabilidad_civil_familiar
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
          reject(error)
        }
      });
    })
  }
  
  const mostrarOfertaPesados = (
    aseguradora,
    prima,
    producto,
    numCotizOferta,
    PT,
    PP,
    PPH,
    CE,
    GR,
    logo,
    UrlPdf
  ) => {
    // console.log("aseguradora:", aseguradora);
    // console.log("prima:", prima);
    // console.log("producto:", producto);
    // console.log("numCotizOferta:", numCotizOferta);
    // console.log("PT:", PT);
    // console.log("PP:", PP);
    // console.log("CE:", CE);
    // console.log("GR:", GR);
    // console.log("logo:", logo);
    // console.log("UrlPdf:", UrlPdf);
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
                          <span class="badge">* $${PT}</span>
                          Responsabilidad Civil (RCE)
                        </li>
                        <li class="list-group-item">
                          <span class="badge">* ${PP}</span>
                          Pérdida Total Daños y Hurto
                        </li>
                        <li class="list-group-item">
                          <span class="badge">* ${PPH}</span>
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
            var container = document.getElementById("cardCotizacion");
            container.innerHTML += cardCotizacion;
            console.log(container)
              };
  
  // VALIDA QUE LAS OFERTAS COTIZADAS HAYAN SIDO GUARDADAS EN SU TOTALIDAD
  function validarOfertasPesados(ofertas) {
    $responsabilidadCivilFamiliar = ofertas[0].responsabilidad_civil_familiar;
    ofertas.forEach((oferta, i) => {
        var numCotizacion = oferta.numero_cotizacion;
        var precioOferta = oferta.precio;
        if (oferta == null) return;
        if (numCotizacion == null && precioOferta == "0") return;
        if (precioOferta.length <= 3) return;
        mostrarOfertaPesados(
          oferta.entidad,
          oferta.precio,
          oferta.producto,
          oferta.numero_cotizacion,
          oferta.cubrimiento,
          oferta.deducible,
          oferta.PPH,
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
          oferta.cubrimiento,
          oferta.deducible,
	        oferta.PPH,
          oferta.conductores_elegidos,
          oferta.servicio_grua,
          oferta.imagen,
          oferta.pdf,
          $responsabilidadCivilFamiliar,
          0,
	        null
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
  
//   document.querySelector('#btnReCotizarFallidas').addEventListener('click', () => {
//     cotizarOfertasPesados()
//   })
  

function cotizarOfertasPesados() {

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


    var fasecoldaVeh = document.getElementById("txtFasecolda").value;
    var valorfasecoldaVeh = document.getElementById("txtValorFasecolda").value;
    var modelovehiculo = document.getElementById("txtModeloVeh").value;
    var marca = document.getElementById("txtMarcaVeh").value;
    var linea = document.getElementById("txtReferenciaVeh").value;
  
    var mundial = document.getElementById("mundialseguros").value;
    // var hdi = document.getElementById("hdiseguros").value;
    // var estado = document.getElementById("estadoseguros").value;
  
    var ofinanciera = document.getElementById("obligacionfinanciera").value;
  
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
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
    var celularAseg = document.getElementById("celularAseg").value;
    var emailAseg = document.getElementById("emailAseg").value;
    var direccionAseg = document.getElementById("direccionAseg").value;
  
    var CodigoClase = document.getElementById("CodigoClase").value;
    var CodigoMarca = document.getElementById("CodigoMarca").value;
    var CodigoLinea = document.getElementById("CodigoLinea").value;
    var claseVeh = document.getElementById("txtClaseVeh").value;
  
    var LimiteRC = document.getElementById("LimiteRC").value;
    var CoberturaEstado = document.getElementById("CoberturaEstado").value;
    var ValorAccesorios = document.getElementById("ValorAccesorios").value;
    var CodigoVerificacion = document.getElementById("CodigoVerificacion").value;
    var AniosSiniestro = document.getElementById("AniosSiniestro").value;
    var AniosAsegurados = document.getElementById("AniosAsegurados").value;
    var NivelEducativo = document.getElementById("NivelEducativo").value;
    var Estrato = document.getElementById("Estrato").value;
  
    var tipoUsoVehiculo = document.getElementById("txtTipoUsoVehiculo").value;
    var tipoServicio = document.getElementById("txtTipoServicio").value;
    var DptoCirculacion = document.getElementById("DptoCirculacion").value;
    var ciudadCirculacion = document.getElementById("ciudadCirculacion").value;
    var isBenefOneroso = $("input:radio[name=oneroso]:checked").val(); // Valida que alguno de los 2 este selecionado
    var benefOneroso = document.getElementById("benefOneroso").value;
  
    if (ciudadCirculacion.length == 4) {
      ciudadCirculacion = "0" + ciudadCirculacion;
    } else if (ciudadCirculacion.length == 3) {
      ciudadCirculacion = "00" + ciudadCirculacion;
    }
  
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
  
    if (
      fasecoldaVeh != "" &&
      valorfasecoldaVeh != "" &&
      modelovehiculo != "" &&
      marca != "" &&
      linea != ""
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
        CodigoClase: condicional,
        CodigoFasecolda: fasecoldaVeh,
        Modelo: modelovehiculo,
        ValorAsegurado: valorfasecoldaVeh,
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
        mundial: mundial,
        ofinanciera: ofinanciera,
        // hdi: hdi,
        // estado: estado,
      };
  
      var requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: JSON.stringify(raw),
        redirect: "follow",
      };
  
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
          Celular: "",
          Correo: "",
          direccionAseg: direccionAseg,
          CodigoClase: condicional,
          Clase: claseVeh,
          Marca: marca,
          Modelo: modelovehiculo,
          Linea: linea,
          Fasecolda: fasecoldaVeh,
          ValorAsegurado: valorfasecoldaVeh,
          tipoUsoVehiculo: tipoUsoVehiculo,
          tipoServicio: tipoServicio,
          Departamento: DptoCirculacion,
          Ciudad: ciudadCirculacion,
          benefOneroso: benefOneroso,
          mundial: mundial,
          idCotizacion: idCotizacion,
        },
        cache: false,
        success: function (data) {
          const contenParrilla = document.querySelector('#contenParrilla')
          contenParrilla.style.display = 'block'
          idCotizacion = data.id_cotizacion;
          raw.cotizacion = idCotizacion
          console.log(data)
          console.log(data.id_cotizacion)
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
          
          /* SEGUROS MUNIDAL */
          fetch(
            "https://grupoasistencia.com/webservice_autosv1/CotizarPesados",
            requestOptions
          )
            .then(function (response) {
              if (!response.ok) throw Error(response.statusText);
              return response.json();
            })
            .then((ofertas) => {
                if (typeof ofertas[0].Resultado !== 'undefined') {
                  agregarAseguradoraFallida('Seguros Mundial')
                  ofertas[0].Mensajes.forEach(mensaje => {
                    mostrarAlertarCotizacionFallida('Seguros Mundial', mensaje)
                  })
                } else {
                  validarOfertasPesados(ofertas);
                  mostrarAlertaCotizacionExitosa('Seguros Mundial')
                }
              })
              .catch((err) => {
                console.error(err);
              })
            .catch(function (error) {
              console.log("Parece que hubo un problema: \n", error);

            });

            /* AXA */
            cont.push(
              fetch("https://grupoasistencia.com/motor_webservice_tst/AXA", requestOptions)
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
                  }
                })
                .catch((err) => {
                  console.error(err);
                })
            );

             /* LIBERTY */ 
              let planesLiberty = ["Full","Integral"];
              let body = JSON.parse(requestOptions.body)

              // planesLiberty.forEach(plan => {
              //   body.plan = plan
              //   requestOptions.body = JSON.stringify(body)
              
              //   fetch("https://grupoasistencia.com/motor_webservice_tst/Liberty", requestOptions)
              //     .then((res) => {
              //       if (!res.ok) throw Error(res.statusText);
              //       return res.json();
              //     })
              //     .then((ofertas) => {
              //       if (typeof ofertas[0].Resultado !== 'undefined') {
              //         agregarAseguradoraFallida(`Liberty ${plan}`);
              //         ofertas[0].Mensajes.forEach(mensaje => {
              //           mostrarAlertarCotizacionFallida(`Liberty ${plan}`, mensaje);
              //         });
              //       } else {
              //         validarOfertasPesados(ofertas);
              //         mostrarAlertaCotizacionExitosa(`Liberty ${plan}`);
              //       }
              //     })
              //     .catch((err) => {
              //       console.error(err);
              //     });
              // });  
        
        
            // Llamar a esta función cuando todas las promesas se resuelvan
            function ejecutarDespuesDePromesas() {
              

              setTimeout(function () {

              $("#btnCotizar").hide();
              $("#loaderOferta").html("");
              $("#loaderRecotOferta").html("");
              swal.fire({
                type: "success",
                title: "! Cotización Exitosa ¡",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
              });
                //  window.location = "index.php?ruta=editar-cotizacion&idCotizacion=" + idCotizacion;
                console.log("Se completó todo");
                document.querySelector('.button-recotizar').style.display = 'block'
                
                /* Se monta el botón para generar el PDF con 
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
                `;

                $("#btnParrillaPDF").click(function () {
                  const todosOn = $(".classSelecOferta:checked").length;
                  const idCotizacionPDF = idCotizacion;
                  const checkboxAsesor = $("#checkboxAsesor");

                  if (permisos.Generarpdfdecotizacion != "x") {
                    Swal.fire({
                      icon: 'error',
                      title: '¡Esta versión no tiene esta funcionalidad disponible!',
                      showCancelButton: true,
                      confirmButtonText: 'Cerrar',
                      cancelButtonText: 'Conoce más'
                    }).then((result) => {
                      if (result.isConfirmed) {
                      } else if (result.isDismissed) {
                        window.open('https://www.integradoor.com', "_blank")
                      }
                    })
                  } else {
                    if (!todosOn) {
                      swal.fire({
                        title: "¡Debes seleccionar al menos una oferta!",
                      });
                    } else {
                      let url = `extensiones/tcpdf/pdf/comparadorPesados.php?cotizacion=${idCotizacionPDF}`;
                      if (checkboxAsesor.is(":checked")) {
                        url += "&generar_pdf=1";
                      }
                      window.open(url, "_blank");
                    }
                  }
                });
              }, 200); // Agrega el tiempo de retraso en milisegundos aquí
            }


            Promise.all(cont)
              .then(() => {
                ejecutarDespuesDePromesas(); // Llama a la función después de que todas las promesas se resuelvan
              })
              .catch((error) => {
                console.error(error);
              });
      
          },
      });
    }
  }
  