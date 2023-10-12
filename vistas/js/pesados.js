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
  
  // Permite consultar la informacion del vehiculo por medio de la Placa (Seguros del Estado)
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
  
            consulDatosFasecoldaPesados(codigoFasecolda, modeloVehiculo).then(
              function (resp) {
                $("#txtMarcaVeh").val(resp.marcaVeh);
                $("#txtReferenciaVeh").val(resp.lineaVeh);
              }
            );
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