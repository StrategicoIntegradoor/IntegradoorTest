// CONST - VARAIBLES
const URL_TODO_RIESGO = 'https://www.grupoasistencia.com/autogestionpdftest/';
const URL_AUTOGESTION = 'https://www.grupoasistencia.com/autogestionpro/'
let numIdAutogestion = 1
let idCotizacionAutogestion = 0
let contErrProtocoloCotizarAutogestion = 0

$(document).ready(() => {
  const params = new URL(document.location).searchParams
  idCotizacionAutogestion = params.get('idcotizacion')
  if (idCotizacionAutogestion.length > 0) {
      obtenerCotizacion(idCotizacionAutogestion)
      .then(() => {
          obtenerParrilla(idCotizacionAutogestion)
      })
  }

  // EVENTS
  $('#aseguradora-autogestion').change(() => {
      selecProductoManualAutogestion()
  })
  $('#producto-autogestion').change(() => {
      selecRCManualAutogestion()
  })
  $('#valorRC-autogestion').change(() => {
      selecCoberturasManualAutogestion()
  })
  $('#btnAgregarCotizacionAutogestion').click(() => {
    agregarCotizacionAutogestion()
  })
  $('#btnRecotizarAutogestion').click(() => {
    cotizarOfertasAutogestion()
  })
  $('#btnParrillaPDFAutogestion').click(() => {
    const todosOn = $('.classSelecOferta:checked').length
    if (!todosOn) { 
        swal({ text: 'Por favor seleccione como minimo una cotización de la Parrilla!' })
        return
    }
    window.open('https://www.grupoasistencia.com/autogestionpdftest/extensiones/tcpdf/pdf/comparador.php?cotizacion=' + idCotizacionAutogestion, '_blank')
  })
})

// FUNCTIONS
/**
 * Get quotes data (Cliente data, Vehicle data)
 * @param id number
 * @return  void
 */
const obtenerCotizacion = id => {
  const datos = new FormData()
  datos.append('idCotizacion', id)

  return $.ajax({
    url: URL_TODO_RIESGO + 'ajax/cotizaciones.ajax.php',
    method: 'POST',
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: respuesta => {
        console.log(respuesta)
      /* FORMULARIO INFORMACIÓN DEL ASEGURADO */
      $('#placaVeh').val(respuesta['cot_placa'])
      $('#idCliente').val(respuesta['id_clientes'])
      $('#tipoDocumentoID').val(respuesta['cli_tip_documento'])
      $('#numDocumentoID').val(respuesta['cli_num_identidad'])
      $('#txtNombres').val(respuesta['cli_nombre'])
      $('#txtApellidos').val(respuesta['cli_apellidos'])
      $('#genero').val(respuesta['cli_genero'])
      $('#estadoCivil').val(respuesta['cli_estado_civil'])

      const fecha = respuesta['cli_fch_nacimiento'].split('-')
      const nombreMes = obtenerNombreMes(fecha[1])
      $('#dianacimiento').append(
        `<option value='${fecha[2]}' selected>${fecha[2]}</option>`
      )
      $("#mesnacimiento").append(
        `<option value='${fecha[1]}' selected>${nombreMes[0].toUpperCase()}
        ${nombreMes.slice(1)}</option>`
      )
      $("#anionacimiento").append(
        `<option value='${fecha[0]}' selected>${fecha[0]}</option>`
      )

      /* FORMULARIO INFORMACIÓN DEL VEHICULO */
      if (respuesta['cot_cerokm'] == 1) {
        document.getElementById('contenPlaca').style.display = 'none'
        document.getElementById('contenCeroKM').style.display = 'block'
        $('#txtConocesLaPlacaNo').prop('checked', true)
        $('#txtEsCeroKmSi').prop('checked', true)
      }

      if (respuesta['cot_placa'] == 'KZY000') {
        $('#txtPlacaVeh').val('SIN PLACA - VEHÍCULO 0 KM').val()
      } else {
        $('#txtPlacaVeh').val(respuesta['cot_placa']).val()
      }

      $("#CodigoClase").val(respuesta["cot_cod_clase"])
      $("#txtClaseVeh").val(respuesta["cot_clase"])
      $("#txtMarcaVeh").val(respuesta["cot_marca"])
      $("#txtModeloVeh").val(respuesta["cot_modelo"])
      $("#txtReferenciaVeh").val(respuesta["cot_linea"])
      $("#txtFasecolda").val(respuesta["cot_fasecolda"])
      $("#txtValorFasecolda").val(respuesta["cot_valor_asegurado"])
      $("#txtTipoUsoVehiculo").val(respuesta["cot_tip_uso"])
      $("#txtTipoServicio").val(respuesta["cot_tip_servicio"])
      $("#DptoCirculacion").append(
        `<option value='${respuesta["cot_departamento"]}' selected>
        ${departamentoVeh(respuesta["cot_departamento"])}</option>`
      )

      const posicion = respuesta['Nombre'].split('-')
      const ciudad = posicion[0].toLowerCase()
      const nomCiudad = ciudad.replace(/^(.)|\s(.)/g, function ($1) {
        return $1.toUpperCase()
      })
      $("#ciudadCirculacion").append(
          `<option value="${respuesta["cot_ciudad"]}" selected>${nomCiudad}</option>`
      )

      if (respuesta["cot_bnf_oneroso"] != "") {
        $("#esOnerosoSi").prop("checked", true);
        $("#benefOneroso").val(respuesta["cot_bnf_oneroso"])
        document.getElementById("contenBenefOneroso").style.display = "block"
      } else {
        $("#esOnerosoNo").prop("checked", true)
      }
    }
  })
}

/**
 * Get offers of quote
 * @param id number
 * @return  void
 */
const obtenerParrilla = id => {
    const datosOfertas = new FormData();
    datosOfertas.append('idCotizaOferta', id)

    $.ajax({
        url: URL_TODO_RIESGO + 'ajax/cotizaciones.ajax.php',
        method: 'POST',
        data: datosOfertas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: respuesta => {
            if (respuesta.length > 0) {
                let cardCotizacion = ''

                respuesta.forEach(oferta => {
                    const primaFormat = formatNumber(oferta.Prima)
            		const valorRCFormat = formatNumber(oferta.ValorRC)

                    if(oferta.Aseguradora == "SBS Seguros" && oferta.Producto == "RCE Daños"){
                        oferta.PerdidaTotal = "Cubrimiento al 100% (Daños)"
                        oferta.PerdidaParcial = "Deducible 10% - 1 SMMLV (Daños)"
                    }
                    if(oferta.Aseguradora == "SBS Seguros" && oferta.Producto == "RCE Hurto"){
                        oferta.PerdidaTotal = "Cubrimiento al 100% (Hurto)"
                        oferta.PerdidaParcial = "Deducible 10% - 1 SMMLV (Hurto)"
                    }

                    if( oferta.seleccionar == "Si" ) { var selecChecked = "checked" }
                    if( oferta.recomendar == "Si" ) { var recomChecked = "checked" }

                    cardCotizacion += `
								<div class='col-lg-12'>
									<div class='card-ofertas'>
										<div class='row card-body'>
											<div class="col-xs-12 col-sm-6 col-md-2 oferta-logo">
												<img src='vistas/img/logos/${oferta.logo.split('/').pop()}'>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-2 oferta-header">
												<h5 class='entidad'>${oferta.Aseguradora} - ${oferta.Producto}</h5>
												<h5 class='precio'>Desde $ ${primaFormat}</h5>
												<p class='title-precio'>Precio</p>
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
												<input type="checkbox" class="classSelecOferta" name="selecOferta" id="selec${oferta.NumCotizOferta}${numId}\" onclick='seleccionarOfertaAutogestion(\"${oferta.Aseguradora}\", \"${oferta.Prima}\", \"${oferta.Producto}\", \"${oferta.NumCotizOferta}\", this);' ${selecChecked}/>
											</div>
											<div class="recom-oferta">
												<label for="recomendar">RECOMENDAR</label>&nbsp;&nbsp;
												<input type="checkbox" class="classRecomOferta" name="recomOferta" id="recom${oferta.NumCotizOferta}${numId}\" onclick='recomendarOfertaAutogestion(\"${oferta.Aseguradora}\", \"${oferta.Prima}\", \"${oferta.Producto}\", \"${oferta.NumCotizOferta}\", this);' ${recomChecked}/>
											</div>
                                        </div>`;
                    if (oferta.Aseguradora == "Seguros Bolivar" || oferta.Aseguradora == "Axa Colpatria"){
                        cardCotizacion += `
                                        <div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">
                                        <button type="button" class="btn btn-info" id="btnAsegPDF${oferta.NumCotizOferta}${numId}\" onclick='verPdfOferta(\"${oferta.Aseguradora}\", \"${oferta.NumCotizOferta}\", \"${numId}\");'>
                                            <div id="verPdf${oferta.NumCotizOferta}${numId}\">VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>
                                        </button>
                                        </div>`;
                    }
                    else if (oferta.Aseguradora == "Seguros del Estado"){
                        cardCotizacion += `
                                        <div class="col-xs-12 col-sm-6 col-md-2 verpdf-oferta">
                                        <button type="button" class="btn btn-info" id="btnAsegPDF${oferta.NumCotizOferta}${numId}\" onclick='verPdfEstado(\"${oferta.Aseguradora}\", \"${oferta.NumCotizOferta}\", \"${numId}\", \"${oferta.UrlPdf}\");'>
                                            <div id="verPdf${oferta.NumCotizOferta}${numId}\">VER PDF &nbsp;&nbsp;<span class="fa fa-file-text"></span></div>
                                        </button>
                                        </div>`;
                    }
                    cardCotizacion += `</div>
                                    </div>
                                </div>`
                    numIdAutogestion++
                })
                $('.cardCotizacionAutogestion').html(cardCotizacion)
            } else {
                $('#loaderOferta').html('')
                swal({
                    type: "warning",
                    title: "¡ UPS, Lo Sentimos !",
                    text: '¡ No hay ofertas disponibles para tu vehículo !',
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                })
            }

            document.getElementById("headerAsegurado").style.display = "block";
            document.getElementById("contenSuperiorPlaca").style.display = "none";
            document.getElementById("contenBtnConsultarPlaca").style.display = "none";
            document.getElementById("resumenVehiculo").style.display = "block";
            document.getElementById("contenBtnCotizar").style.display = "none";
            document.getElementById("contenRecotizarYAgregar").style.display = "block";
            document.getElementById("contenParrilla").style.display = "block";
            menosAseg()
        }
    })
}

const selecProductoManualAutogestion = () => {
    vaciarCamposOfertaManualAutogestion()
    const aseguradora = $('#aseguradora-autogestion').val()

    $.ajax({
		type: 'POST',
		url: URL_AUTOGESTION + 'src/seleccionarProducto.php',
		dataType: 'json',
		data: {
			aseguradora: aseguradora
		},
		cache: false,
		success: function (data) {
			let producto = '<option value="">Seleccione Producto</option>'
			$.each(data, (key, item) => {
				producto += `<option value="${item.producto}">${item.producto}</option>`
			})
			$('#producto-autogestion').html(producto)
		}
	})
}

const selecRCManualAutogestion = () => {
    const aseguradora = $('#aseguradora-autogestion').val()
    const producto = $('#producto-autogestion').val()

    $.ajax({
		type: 'POST',
		url: URL_AUTOGESTION + 'src/seleccionarRC.php',
		dataType: 'json',
		data: {
			aseguradora: aseguradora,
			producto: producto
		},
		cache: false,
		success: function (data) {
			if(data.length > 1) {
				const valorRC = '<option value="">Seleccione RC</option>'

				$.each(data, (key, item) => {
					valorRC += `<option value='${item.rce}'>${item.rce}</option>`
				})
				$('#valorRC-autogestionw').html(valorRC)

                return
			}
            $('#valorRC-autogestion').html(`<option value='${data[0].rce}' selected>${data[0].rce}</option>`);
            selecCoberturasManualAutogestion()
		}
	})
}

const selecCoberturasManualAutogestion = () => {
    const aseguradora = $('#aseguradora-autogestion').val()
	const producto = $('#producto-autogestion').val()
	const valorRC = $('#valorRC-autogestion').val()
	const modeloVeh = $('#txtModeloVeh').val()
	const valorFasecolda = $('#txtValorFasecolda').val()
	const diaNac = $('#dianacimiento').val()
	const mesNac = $('#mesnacimiento').val()
	const anioNac = $('#anionacimiento').val()
	const fechaNacimiento = `${diaNac}/${mesNac}/${anioNac}`

	$.ajax({
		type: 'POST',
		url: URL_AUTOGESTION + 'src/seleccionarCoberturas.php',
		dataType: 'json',
		data: {
			aseguradora: aseguradora,
			producto: producto,
			valorRC: valorRC
		},
		cache: false,
		success: data => {
			const edadVeh = new Date().getFullYear() - modeloVeh;
			const edadAseg = calcularEdad(fechaNacimiento);
			let perdTotales = data.pth;
			let perdParcialDanio = data.ppd;

			if(aseguradora === 'Seguros Bolivar' && producto === 'Estandar'
                || producto === 'Clasico') {
				perdTotales = "Cubrimiento al 90%"
                if(edadVeh <= 5) perdTotales = "Cubrimiento al 100%"
			}

			if(aseguradora === 'Axa Colpatria' && producto === 'Plus'
                || producto === 'VIP' || producto === 'Tradicional') {
                perdParcialDanio = 'Deducible 10% - 1 SMMLV';
				if(edadVeh <= 11 && edadAseg > 33){
					perdParcialDanio = 'Deducible unico: $700.000';
				}
			}

			if(aseguradora === 'Allianz Seguros' && producto === 'Motocicletas'){
				if(valorFasecolda <= 6000000){
					perdTotales = `Cubrimiento al ${calcularPerdTotalAllianz(valorFasecolda, 800000)}%`;
					perdParcialDanio = 'Deducible unico: $800.000';
				}
				else if(valorFasecolda > 6000000 && valorFasecolda <= 10000000){
					perdTotales = `Cubrimiento al ${calcularPerdTotalAllianz(valorFasecolda, 1350000)}%`;
					perdParcialDanio = 'Deducible unico: $1.350.000';
				}
				else if(valorFasecolda > 10000000 && valorFasecolda <= 20000000){
					perdTotales = `Cubrimiento al ${calcularPerdTotalAllianz(valorFasecolda, 2000000)}%`;
					perdParcialDanio = "Deducible unico: $2.000.000";
				}
				else if(valorFasecolda > 20000000 && valorFasecolda <= 30000000){
					perdTotales = `Cubrimiento al ${calcularPerdTotalAllianz(valorFasecolda, 3000000)}%`;
					perdParcialDanio = 'Deducible unico: $3.000.000';
				}
				else if(valorFasecolda > 30000000){
					perdTotales = `Cubrimiento al ${calcularPerdTotalAllianz(valorFasecolda, 4000000)}%`;
					perdParcialDanio = 'Deducible unico: $4.000.000';
				}
			}
			$('#valorPerdidaTotal').val(perdTotales);
			$('#valorPerdidaParcial').val(perdParcialDanio);
			$('#conductorElegido').val(data.CE);
			$('#servicioGrua').val(data.Grua);
		}
	})
}

/**
 * Add manual quote
 * @param none
 * @return  void
 */
const agregarCotizacionAutogestion = () => {
    const aseguradora = $('#aseguradora-autogestion').val()
	const producto = $('#producto-autogestion').val()
	const numCotizOferta = $('#numCotizacion').val()
	const prima = $('#valorTotal').val()

    const valorRC = $('#valorRC-autogestion').val()
    let PT = $('#valorPerdidaTotal').val()
	const PT2 = $('#valorPerdidaTotal').val()
    let PP = $('#valorPerdidaParcial').val()
	const PP2 = $('#valorPerdidaParcial').val()
	const CE = $('#conductorElegido').val()
	const GR = $('#servicioGrua').val()

    if(aseguradora !== '' && producto !== '' && numCotizOferta !== '' && prima
        !== '' && valorRC !== '' && PT !== '' && PP !== '' && CE !== '' && GR !== '') {
        const logo = logoOfertaManual(aseguradora)
        const primaFormat = formatNumber(prima)
        const valorRCFormat = valorRC
        let cardCotizacion = ''

        if (aseguradora === 'SBS Seguros' && producto === 'RCE Daños') {
			PT = 'Cubrimiento al 100% (Daños)'
			PP = 'Deducible 10% - 1 SMMLV (Daños)'
		}
		if (aseguradora == 'SBS Seguros' && producto == 'RCE Hurto') {
		    PT = 'Cubrimiento al 100% (Hurto)'
			PP = 'Deducible 10% - 1 SMMLV (Hurto)'
		}

        cardCotizacion += `
                        <div class='col-lg-12'>
                            <div class='card-ofertas'>
                                <div class='row card-body'>
                                    <div class="col-xs-12 col-sm-6 col-md-2 oferta-logo">
                                        <img src='vistas/img/logos/${logo.split('/').pop()}'>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-2 oferta-header">
                                        <h5 class='entidad'>${aseguradora} - ${producto}</h5>
                                        <h5 class='precio'>Desde $ ${primaFormat}</h5>
                                        <p class='title-precio'>Precio</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <span class="badge">* $${valorRCFormat}</span>
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
                                            <input type="checkbox" class="classSelecOferta" name="selecOferta" id="selec${numCotizOferta}${numIdAutogestion}\" onclick='seleccionarOferta(\"${aseguradora}\", \"${prima}\", \"${producto}\", \"${numCotizOferta}\", this);'/>
                                        </div>
                                        <div class="recom-oferta">
                                            <label for="recomendar">RECOMENDAR</label>&nbsp;&nbsp;
                                            <input type="checkbox" class="classRecomOferta" name="recomOferta" id="recom${numCotizOferta}${numIdAutogestion}\" onclick='recomendarOferta(\"${aseguradora}\", \"${prima}\", \"${producto}\", \"${numCotizOferta}\", this);'/>
                                        </div>
                                    </div>`
            cardCotizacion += `</div>
                            </div>
                        </div>`
        numIdAutogestion++

        registrarOfertaAutogestion(aseguradora, prima, producto,
            numCotizOferta, valorRC, PT2, PP2, CE, GR, logo)

        swal({ text: '! Cotización Registrada con Exito. ¡' })
        $('.cardCotizacionAutogestion').append(cardCotizacion)
        $('#aseguradora-autogestion').val('')
        vaciarCamposOfertaManualAutogestion()
    }
}

/**
 * Re-quote
 * @param none
 * @return  void
 */
const cotizarOfertasAutogestion = () => {
    const placa = document.getElementById("placaVeh").value
	const esCeroKmSi = document.getElementById('txtEsCeroKmSi').checked
	const esCeroKm = esCeroKmSi.toString()
	const esCeroKmInt = esCeroKmSi == true ? 1 : 0

	const idCliente = document.getElementById("idCliente").value
	const tipoDocumentoID = document.getElementById("tipoDocumentoID").value
	const numDocumentoID = document.getElementById("numDocumentoID").value
	const Nombre = document.getElementById("txtNombres").value
	const Apellido1 = document.getElementById("txtApellidos").value
	const Apellido2 = "";
	const dia = document.getElementById("dianacimiento").value
	const mes = document.getElementById("mesnacimiento").value
	const anio = document.getElementById("anionacimiento").value
	const FechaNacimiento = anio + "-" + mes + "-" + dia
	const Genero = document.getElementById("genero").value
	const estadoCivil = document.getElementById("estadoCivil").value
	const celularAseg = document.getElementById("celularAseg").value
	const emailAseg = document.getElementById("emailAseg").value
	const direccionAseg = document.getElementById("direccionAseg").value

	const CodigoClase = document.getElementById("CodigoClase").value
	const CodigoMarca = document.getElementById("CodigoMarca").value
	const CodigoLinea = document.getElementById("CodigoLinea").value
	const claseVeh = document.getElementById("txtClaseVeh").value
	const marcaVeh = document.getElementById("txtMarcaVeh").value
	const modeloVeh = document.getElementById("txtModeloVeh").value
	const lineaVeh = document.getElementById("txtReferenciaVeh").value

	const LimiteRC = document.getElementById("LimiteRC").value
	const CoberturaEstado = document.getElementById("CoberturaEstado").value
	const ValorAccesorios = document.getElementById("ValorAccesorios").value
	const CodigoVerificacion = document.getElementById("CodigoVerificacion").value
	const AniosSiniestro = document.getElementById("AniosSiniestro").value
	const AniosAsegurados = document.getElementById("AniosAsegurados").value
	const NivelEducativo = document.getElementById("NivelEducativo").value
	const Estrato = document.getElementById("Estrato").value

	const fasecoldaVeh = document.getElementById("txtFasecolda").value
	const valorFasecolda = document.getElementById("txtValorFasecolda").value
	const tipoUsoVehiculo = document.getElementById("txtTipoUsoVehiculo").value
	const tipoServicio = document.getElementById("txtTipoServicio").value
	const DptoCirculacion = document.getElementById("DptoCirculacion").value
	let ciudadCirculacion = document.getElementById("ciudadCirculacion").value
	const isBenefOneroso = $('input:radio[name=oneroso]:checked').val() // Valida que alguno de los 2 este selecionado
	const benefOneroso = document.getElementById("benefOneroso").value

    if (ciudadCirculacion.length == 4) {
		ciudadCirculacion = "0" + ciudadCirculacion
	} else if (ciudadCirculacion.length == 3) {
		ciudadCirculacion = "00" + ciudadCirculacion
	}

    if (fasecoldaVeh != '' && valorFasecolda != '' && tipoUsoVehiculo != '' && tipoServicio != '' && DptoCirculacion != '' && ciudadCirculacion != '' && isBenefOneroso != undefined) {
		if (placa != '' && tipoDocumentoID != '' && numDocumentoID != '' && Nombre != '' && Apellido1 != '' && dia != '' && mes != '' && anio != '' && Genero != '' && estadoCivil != '') {
		    $('#loaderOferta').html('<img src="vistas/img/plantilla/loader-update.gif" width="34" height="34"><strong> Consultando Ofertas...</strong>')
			$('#loaderRecotOferta').html('<img src="vistas/img/plantilla/loader-update.gif" width="34" height="34"><strong> Recotizando Ofertas...</strong>')
            const myHeaders = new Headers()
			myHeaders.append("Content-Type", "application/json")

            const raw = {
                "Placa": placa, "ceroKm": esCeroKm, "TipoIdentificacion": tipoDocumentoID, "NumeroIdentificacion": numDocumentoID, "Nombre": Nombre,
				"Apellido": Apellido1, "Genero": Genero, "FechaNacimiento": FechaNacimiento, "EstadoCivil": estadoCivil, "NumeroTelefono": celularAseg,
				"Direccion": direccionAseg, "Email": emailAseg, "ZonaCirculacion": DptoCirculacion, "CodigoMarca": CodigoMarca, "CodigoLinea": CodigoLinea,
				"CodigoClase": CodigoClase, "CodigoFasecolda": fasecoldaVeh, "Modelo": modeloVeh, "ValorAsegurado": valorFasecolda, "LimiteRC": LimiteRC,
				"Cobertura": CoberturaEstado, "ValorAccesorios": ValorAccesorios, "CiudadBolivar": ciudadCirculacion, "tipoServicio": tipoServicio,
				"CodigoVerificacion": CodigoVerificacion, "Apellido2": Apellido2, "AniosSiniestro": AniosSiniestro, "AniosAsegurados": AniosAsegurados,
				"NivelEducativo": NivelEducativo, "Estrato": Estrato
            }
            const requestOptions = { method: 'POST', headers: myHeaders, body: JSON.stringify(raw), redirect: 'follow' }
            
            $.ajax({
                type: 'POST',
                url: URL_TODO_RIESGO + 'src/insertarCotizacion.php',
                dataType: 'json',
                data: {
                    placa: placa, esCeroKm: esCeroKmInt, idCliente: idCliente, tipoDocumento: tipoDocumentoID, numIdentificacion: numDocumentoID, Nombre: Nombre,
					Apellido: Apellido1, FechaNacimiento: FechaNacimiento, Genero: Genero, EstadoCivil: estadoCivil, Celular: "", Correo: "",
					direccionAseg: direccionAseg, CodigoClase: CodigoClase, Clase: claseVeh, Marca: marcaVeh, Modelo: modeloVeh, Linea: lineaVeh,
					Fasecolda: fasecoldaVeh, ValorAsegurado: valorFasecolda, tipoUsoVehiculo: tipoUsoVehiculo, tipoServicio: tipoServicio,
					Departamento: DptoCirculacion, Ciudad: ciudadCirculacion, benefOneroso: benefOneroso, idCotizacion: idCotizacionAutogestion
                },
                cache: false,
                success: data => {
                    idCotizacion: data.id_cotizacion

                    fetch('https://www.grupoasistencia.com/webservice_autosv1/Cotizar', requestOptions)
                    .then(response => {
                        console.log("response", response);
                        if (!response.ok) {
                            throw Error(response.statusText)
                        }

                        return response.json()
                    }).then(ofertas => {
                        validarOfertasAutogestion(ofertas)
                    }).catch(err => {
                        console.log('Parece que hubo un problema: \n', err)
                        contErrProtocoloCotizar++
                        if (contErrProtocoloCotizar >= 2) {
                            console.log('contErrProtocoloCotizar mayor o igual 2')
                        } else {
                            console.log('No mayor a 1')
                            //setTimeout(cotizarOfertas, 4000)
                        }
                    }).finally(() => {
                        $('#loaderOferta').html('')
						$('#loaderRecotOferta').html('')
                    })
                }
            })

            
        } else {
            swal({ text: '! Debe diligenciar en su totalidad los campos del Asegurado. ¡' })
			masAseg()
			menosVeh()
        }
    }
}

/**
 * Validate and save each offers
 * @param offers
 * @return  void
 */
const validarOfertasAutogestion = ofertas => {
    var cont = []

    ofertas.forEach((oferta, i) => {
        const numCotizacion = oferta.numero_cotizacion
        const precioOferta = oferta.precio

        if (numCotizacion !== null && precioOferta !== '0' && precioOferta.length > 3) {
            cont.push(registrarOfertaAutogestion(oferta.entidad,
                oferta.precio,
                oferta.producto,
                oferta.numero_cotizacion,
                oferta.responsabilidad_civil,
                oferta.cubrimiento,
                oferta.deducible,
                oferta.conductores_elegidos,
                oferta.servicio_grua,
                oferta.imagen,
                oferta.pdf))
                
            Promise.all(cont).then(resultados => {
                console.log(resultados)
                $('#loaderOferta').html('')
                $('#loaderRecotOferta').html('')

                swal({
                    type: 'success',
                    title: 'Cotización Exitosa!',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar'
                }).then(result => {
                    if (result.value) {
                        window.location = `index.php?ruta=editar-cotizacion-autogestion&idcotizacion=${idCotizacionAutogestion}`
                    }
                })
            })
        }
    })
}

/**
 * Insert offer in DB
 * @param aseguradora
 * @param prima
 * @param producto
 * @param ...
 * @return  void
 */
const registrarOfertaAutogestion = (aseguradora, prima, producto, numCotizOferta,
                        valorRC, PT, PP, CE, GR, logo, UrlPdf) => {
  return new Promise((resolve, reject) => {
    const idCotizOferta = idCotizacionAutogestion
    const numDocumentoID = $('#numDocumentoID').val()
    const placa = $('#placaVeh').val()

    $.ajax({
      type: 'POST',
      url: URL_TODO_RIESGO + 'src/insertarOferta.php',
      dataType: 'json',
      data: {
        placa: placa, idCotizOferta: idCotizOferta,
        numIdentificacion: numDocumentoID, aseguradora: aseguradora,
        numCotizOferta: numCotizOferta, producto: producto,
        valorPrima: prima, valorRC: valorRC,
        PT: PT, PP: PP, CE: CE, GR: GR,
        logo: logo, UrlPdf: UrlPdf
      },
      success: data => {
        resolve({ result: data.Message, success: data.Success })
        if (!data.Success) {
          reject(new Error('Hubo un error en la inserción de las ofertas'))
        }
      }
    })
  })
}

/**
 * Select offer
 * @param offers
 * @return  void
 */
const seleccionarOfertaAutogestion = (aseguradora, prima, producto,
                                    numCotizOferta, valCheck) => {
    const placa = $('#placaVeh').val()
    const idCheckBox = $(valCheck).attr('id')
    let seleccionar = ''

    if (document.getElementById(idCheckBox).checked) { 
        seleccionar = 'Si'
    }

    $.ajax({
        type: 'POST',
        url: URL_TODO_RIESGO + 'src/seleccionarOferta.php',
        dataType: 'json',
        data: {
            placa: placa,
            idCotizacion: idCotizacionAutogestion,
            aseguradora: aseguradora,
            numCotizOferta: numCotizOferta,
            producto: producto,
            valorPrima: prima,
            seleccionar: seleccionar
        },
        success: data => {
            console.log(data)
        }
    })
}

const recomendarOfertaAutogestion = (aseguradora, prima, producto, 
                                numCotizOferta, valCheck) => {
    const placa = $('#placaVeh').val()
    const idCheckBox = $(valCheck).attr('id')
    let recomendar = ''

    if (document.getElementById(idCheckBox).checked) { 
        recomendar = 'Si'
    }

    if ($('.classRecomOferta:checked').length > 3) {
        $('#' + idCheckBox).prop('checked', false)
        swal( { text: 'No se permite recomendar mas de 3 Ofertas por parrilla!'} )
        return
    }
    $.ajax({
        type: 'POST',
        url: URL_TODO_RIESGO + 'src/recomendarOferta.php',
        dataType: 'json',
        data: {
            placa: placa,
            idCotizacion: idCotizacionAutogestion,
            aseguradora: aseguradora,
            numCotizOferta: numCotizOferta,
            producto: producto,
            valorPrima: prima,
            recomendar: recomendar
        },
        success: data => {
            console.log(data)
        }
    })
}

const vaciarCamposOfertaManualAutogestion = () => {
  $('#producto-autogestion').html('');
	$('#numCotizacion').val('')
	$('#valorTotal').val('')
	$('#valorRC-autogestion').html('');
	$('#valorPerdidaTotal').val('')
	$('#valorPerdidaParcial').val('')
	$('#conductorElegido').val('')
	$('#servicioGrua').val('')
}
