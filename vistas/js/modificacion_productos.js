const URL = 'http://localhost/cotizautos/vistas/modulos/ModificacionProductos/ModificacionProductosController.php'

/* Obtener todas las asistencias */
const obtenerProductos = async () => {
    const formData = new FormData()
    formData.append('metodo', 'Obtener')
    await fetch(URL, {
            method: 'POST',
            body: formData
    })
    .then(res => res.json())
    .then(json => {
        let tbodyContent = ''
        json.forEach(asistencia => {
            tbodyContent += `<tr>
                                <td>${asistencia.id_asistencias}</td>
                                <td>${asistencia.aseguradora}</td>
                                <td>${asistencia.producto}</td>
                                <td>${asistencia.rce}</td>
                                <td>${asistencia.deducible}</td>
                                <td>${asistencia.eventos}</td>
                                <td>${asistencia.Grua}</td>
                                <td>${asistencia.Carrotaller}</td>
                                <td>${asistencia.Asistenciajuridica}</td>
                                <td>
                                    <button class="btn btn-danger btnObtener" onclick="eliminarAsistencia(${asistencia.id_asistencias})">Eliminar</button>
                                    <button class="btn btn-primary btnObtener" onclick="obtenerAsistencia(${asistencia.id_asistencias})">Editar</button>
                                </td>
                            </tr>
            `
        })
        document.querySelector('.tablas-asistencias tbody').innerHTML = tbodyContent
        configurarDataTable()
        mostrarMensaje('Productos obtenidos', 
            'Se han obtenido los productos')
    })
    .catch(err => console.error(err))
}

const obtenerAsistencia = async id => {
    const formData = new FormData()
    formData.append('metodo', 'ObtenerPorId')
    formData.append('idAsistencia', id)
    await fetch(URL, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(json => {
        getByElementId('id_asistencia').value = json.id_asistencias
        getByElementId('producto').value = json.producto
        getByElementId('aseguradora').value = json.aseguradora
        getByElementId('rce').value = json.rce
        getByElementId('deducible').value = json.deducible
        getByElementId('pth').value = json.pth
        getByElementId('ppd').value = json.ppd
        getByElementId('pph').value = json.pph
        getByElementId('eventos').value = json.eventos
        getByElementId('amparoPatrimonial').value = json.amparopatrimonial
        getByElementId('grua').value = json.Grua
        getByElementId('carroTaller').value = json.Carrotaller
        getByElementId('asistenciaJuridica').value = json.Asistenciajuridica
        getByElementId('gastosDeTransportePt').value = json.Gastosdetransportept
        getByElementId('gastosDeTransportePp').value = json.Gastosdetransportepp
        getByElementId('vehiculoReemplazoPt').value = json.Vehiculoreemplazopt
        getByElementId('vehiculoReemplazoPp').value = json.Vehiculoreemplazopp
        getByElementId('conductorElegido').value = json.Conductorelegido
        getByElementId('transporteVehiculoRecuperado').value = json.Transportevehiculorecuperdo
        getByElementId('transportePasajerosAccidente').value = json.Transportepasajerosaccidente
        getByElementId('transportePasajerosVarada').value = json.Transportepasajerosvarada
        getByElementId('accidentesPersonales').value = json.Accidentespersonales
        getByElementId('pequeniosAccesorios').value = json.Pequeniosaccesorios
        getByElementId('llantasEstalladas').value = json.Llantasestalladas
        getByElementId('perdidaLlaves').value = json.Perdidallaves
        getByElementId('color').value = json.color
        getByElementId('rceExceso').value = json.rceexceso
        getByElementId('otroDeducible').value = json.Deducible2
        getByElementId('asistenciaNacional').value = json.asistenciaNacional
        getByElementId('auxilioPerdidaPatrimonial').value = json.auxilioPerdidaPatrimonial
        getByElementId('auxilioPerdidaPatrimonialTerrorismo').value = json.auxilioperdidapatrimonialterrorismo
        getByElementId('perjuiciosExtraPatrimoniales').value = json.PerjuiciosExtrapatrimoniales
        getByElementId('paralizacionVehiculo').value = json.paralizacionvehiculo
        getByElementId('obligacionFinanciera').value = json.obligacionfinanciera
        getByElementId('gastosFunerarios').value = json.gastosfunerarios
        getByElementId('gastosRecuperacion').value = json.gastosrecuperacion
        getByElementId('gastosGrua').value = json.gastosgrua
        getByElementId('formulario-asistencias').style.display = 'block'
        getByElementId('formulario-titulo').innerHTML = 'Editar producto'
        getByElementId('buttons-container').innerHTML = '<button type="button" class="btn btn-block btn-primary" id="btn-editar-asistencia">Editar</button>'
        getByElementId('btn-editar-asistencia').addEventListener('click', () => {
            editarAsistencia()
        })
        scroll(0, document.body.clientHeight - 1000)
    })
    .catch(err => console.log(err))
}

const crearAsistencia = async () => {
    const formData = new FormData()
    formData.append('metodo', 'Crear')
    formData.append('aseguradora', getByElementId('aseguradora').value)
    formData.append('producto', getByElementId('producto').value)
    formData.append('rce', getByElementId('rce').value)
    formData.append('deducible', getByElementId('deducible').value)
    formData.append('pth', getByElementId('pth').value)
    formData.append('ppd', getByElementId('ppd').value)
    formData.append('pph', getByElementId('pph').value)
    formData.append('eventos', getByElementId('eventos').value)
    formData.append('amparoPatrimonial', getByElementId('amparoPatrimonial').value)
    formData.append('grua', getByElementId('grua').value)
    formData.append('carroTaller', getByElementId('carroTaller').value)
    formData.append('asistenciaJuridica', getByElementId('asistenciaJuridica').value)
    formData.append('gastosDeTransportePt', getByElementId('gastosDeTransportePt').value)
    formData.append('gastosDeTransportePp', getByElementId('gastosDeTransportePp').value)
    formData.append('conductorElegido', getByElementId('conductorElegido').value)
    formData.append('transporteVehiculoRecuperado', getByElementId('transporteVehiculoRecuperado').value)
    formData.append('transportePasajerosVarada', getByElementId('transportePasajerosVarada').value)
    formData.append('accidentesPersonales', getByElementId('accidentesPersonales').value)
    formData.append('pequeniosAccesorios', getByElementId('pequeniosAccesorios').value)
    formData.append('llantasEstalladas', getByElementId('llantasEstalladas').value)
    formData.append('perdidaLlaves', getByElementId('perdidaLlaves').value)
    formData.append('color', getByElementId('color').value)
    formData.append('rceExceso', getByElementId('rceExceso').value)
    formData.append('otroDeducible', getByElementId('otroDeducible').value)
    formData.append('asistenciaNacional', getByElementId('asistenciaNacional').value)
    formData.append('auxilioPerdidaPatrimonial', getByElementId('auxilioPerdidaPatrimonial').value)
    formData.append('auxilioPerdidaPatrimonialTerrorismo', getByElementId('auxilioPerdidaPatrimonialTerrorismo').value)
    formData.append('perjuiciosExtraPatrimoniales', getByElementId('perjuiciosExtraPatrimoniales').value)
    formData.append('paralizacionVehiculo', getByElementId('paralizacionVehiculo').value)
    formData.append('obligacionFinanciera', getByElementId('obligacionFinanciera').value)
    formData.append('gastosFunerarios', getByElementId('gastosFunerarios').value)
    formData.append('gastosRecuperacion', getByElementId('gastosRecuperacion').value)
    formData.append('gastosGrua', getByElementId('gastosGrua').value)
    formData.append('vehiculoReemplazoPt', getByElementId('vehiculoReemplazoPt').value)
    formData.append('vehiculoReemplazoPp', getByElementId('vehiculoReemplazoPp').value)
    formData.append('transportePasajerosAccidente', getByElementId('transportePasajerosAccidente').value)

    await fetch(URL, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(json => {
        if (json) {
            mostrarMensaje('Producto creado', 
                'Se ha creado el producto correctamente')
            setTimeout(() => {
                location.reload()
            }, 2000)
        }
    })
    .catch(err => console.error(err))
}

const editarAsistencia = async () => {
    const formData = new FormData()
    formData.append('metodo', 'Editar')
    formData.append('idAsistencia', getByElementId('id_asistencia').value)
    formData.append('aseguradora', getByElementId('aseguradora').value)
    formData.append('producto', getByElementId('producto').value)
    formData.append('rce', getByElementId('rce').value)
    formData.append('deducible', getByElementId('deducible').value)
    formData.append('pth', getByElementId('pth').value)
    formData.append('ppd', getByElementId('ppd').value)
    formData.append('pph', getByElementId('pph').value)
    formData.append('eventos', getByElementId('eventos').value)
    formData.append('amparoPatrimonial', getByElementId('amparoPatrimonial').value)
    formData.append('grua', getByElementId('grua').value)
    formData.append('carroTaller', getByElementId('carroTaller').value)
    formData.append('asistenciaJuridica', getByElementId('asistenciaJuridica').value)
    formData.append('gastosDeTransportePt', getByElementId('gastosDeTransportePt').value)
    formData.append('gastosDeTransportePp', getByElementId('gastosDeTransportePp').value)
    formData.append('conductorElegido', getByElementId('conductorElegido').value)
    formData.append('transporteVehiculoRecuperado', getByElementId('transporteVehiculoRecuperado').value)
    formData.append('transportePasajerosVarada', getByElementId('transportePasajerosVarada').value)
    formData.append('accidentesPersonales', getByElementId('accidentesPersonales').value)
    formData.append('pequeniosAccesorios', getByElementId('pequeniosAccesorios').value)
    formData.append('llantasEstalladas', getByElementId('llantasEstalladas').value)
    formData.append('perdidaLlaves', getByElementId('perdidaLlaves').value)
    formData.append('color', getByElementId('color').value)
    formData.append('rceExceso', getByElementId('rceExceso').value)
    formData.append('otroDeducible', getByElementId('otroDeducible').value)
    formData.append('asistenciaNacional', getByElementId('asistenciaNacional').value)
    formData.append('auxilioPerdidaPatrimonial', getByElementId('auxilioPerdidaPatrimonial').value)
    formData.append('auxilioPerdidaPatrimonialTerrorismo', getByElementId('auxilioPerdidaPatrimonialTerrorismo').value)
    formData.append('perjuiciosExtraPatrimoniales', getByElementId('perjuiciosExtraPatrimoniales').value)
    formData.append('paralizacionVehiculo', getByElementId('paralizacionVehiculo').value)
    formData.append('obligacionFinanciera', getByElementId('obligacionFinanciera').value)
    formData.append('gastosFunerarios', getByElementId('gastosFunerarios').value)
    formData.append('gastosRecuperacion', getByElementId('gastosRecuperacion').value)
    formData.append('gastosGrua', getByElementId('gastosGrua').value)
    formData.append('vehiculoReemplazoPt', getByElementId('vehiculoReemplazoPt').value)
    formData.append('vehiculoReemplazoPp', getByElementId('vehiculoReemplazoPp').value)
    formData.append('transportePasajerosAccidente', getByElementId('transportePasajerosAccidente').value)

    await fetch(URL, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(json => {
        if (json) {
            mostrarMensaje('Producto modificado', 
                'Se ha modificado el producto correctamente')
            setTimeout(() => {
                location.reload()
            }, 2000)
        }
    })
    .catch(err => console.error(err))
}

const eliminarAsistencia = id => {
    swal({
        title: 'Estas seguro de borrar este producto?',
        text: '¡Si no lo está puede cancelar la acción!',
        type: 'warning',
        showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar!'
    })
    .then(result => {
        if (typeof result.value === 'undefined') return

        const formData = new FormData()
        formData.append('metodo', 'Eliminar')
        formData.append('idAsistencia', id)
        fetch(URL, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(json => {
            if (json) {
                mostrarMensaje('Producto eliminado', 
                    'Se ha eliminado el producto correctamente')
                setTimeout(() => {
                    location.reload()
                }, 2000)
            }
        })
        .catch(err => console.error(err))
    })
}

const clearForm = () => {
    getByElementId('formulario-asistencias').style.display = 'none'
    getByElementId('id_asistencia').value = ''
    getByElementId('producto').value = ''
    getByElementId('aseguradora').value = ''
    getByElementId('rce').value = ''
    getByElementId('deducible').value = ''
    getByElementId('pth').value = ''
    getByElementId('ppd').value = ''
    getByElementId('pph').value = ''
    getByElementId('eventos').value = ''
    getByElementId('amparoPatrimonial').value = ''
    getByElementId('grua').value = ''
    getByElementId('carroTaller').value = ''
    getByElementId('asistenciaJuridica').value = ''
    getByElementId('gastosDeTransportePt').value = ''
    getByElementId('gastosDeTransportePp').value = ''
    getByElementId('vehiculoReemplazoPt').value = ''
    getByElementId('vehiculoReemplazoPp').value = ''
    getByElementId('conductorElegido').value = ''
    getByElementId('transporteVehiculoRecuperado').value = ''
    getByElementId('transportePasajerosAccidente').value = ''
    getByElementId('transportePasajerosVarada').value = ''
    getByElementId('accidentesPersonales').value = ''
    getByElementId('pequeniosAccesorios').value = ''
    getByElementId('llantasEstalladas').value = ''
    getByElementId('perdidaLlaves').value = ''
    getByElementId('color').value = ''
    getByElementId('rceExceso').value = ''
    getByElementId('otroDeducible').value = ''
    getByElementId('asistenciaNacional').value = ''
    getByElementId('auxilioPerdidaPatrimonial').value = ''
    getByElementId('auxilioPerdidaPatrimonialTerrorismo').value = ''
    getByElementId('perjuiciosExtraPatrimoniales').value = ''
    getByElementId('paralizacionVehiculo').value = ''
    getByElementId('obligacionFinanciera').value = ''
    getByElementId('gastosFunerarios').value = ''
    getByElementId('gastosRecuperacion').value = ''
    getByElementId('gastosGrua').value = ''
}

/* Configurar DataTable despues de consultar todos los datos */
const configurarDataTable = () => {
    $('.tablas-asistencias').DataTable({
        "bDestroy": true,
		"order": [[0, "asc"], [1, "asc"]],
		// "ordering": false,
		"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	})
}

const getByElementId = id => {
    return document.querySelector(`#${id}`)
}

/* Events */
getByElementId('btn-agregar-asistencia-formulario').addEventListener('click', () => {
    clearForm()
    getByElementId('formulario-titulo').innerHTML = 'Agregar producto'
    getByElementId('buttons-container').innerHTML = '<button type="button" class="btn btn-block btn-primary" id="btn-agregar-asistencia">Guardar</button>'
    getByElementId('btn-agregar-asistencia').addEventListener('click', () => {
        crearAsistencia()
    })
    getByElementId('formulario-asistencias').style.display = 'block'
    scroll(0, document.body.clientHeight - 1000)
})

getByElementId('btn-cancelar-asistencia').addEventListener('click', () => {
    clearForm()
    scroll(0, 0)
})

const mostrarMensaje = (titulo, mensaje) => {
    const box = document.querySelector('.box-toast')
    box.classList.add('show')
    box.classList.remove('hidden')
    document.querySelector('.box-title-toast').innerText = titulo
    document.querySelector('.box-body-toast').innerText = mensaje
    setTimeout(() => {
        box.classList.add('hidden')
        box.classList.remove('show')
        document.querySelector('.box-title-toast').innerText = ''
        document.querySelector('.box-body-toast').innerText = ''
    }, 1000)
}

/* Main init */
obtenerProductos()
