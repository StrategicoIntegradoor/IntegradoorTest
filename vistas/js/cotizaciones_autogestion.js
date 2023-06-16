// CONST - VARAIBLES
const BASE_URL = 'https://www.grupoasistencia.com/autogestionpro/'

$(document).ready(() => {
    filtrarCotizaciones()
})

// FUNCTIONS
const filtrarCotizaciones = () => {
    const info = $('input[name=filter]').val() === undefined ? '' 
        : $('input[name=filter]').val() 
    $.ajax({
        url: BASE_URL + 'polizas/ObtenerCotizacionesCotizautos',
        type: 'GET',
        dataType: 'JSON',
        data: {
            dato: info
        },
        success: dato => {
            let tableHTML = ''
            if (dato.status !== 'success') return
            dato.result.forEach(e => {
                tableHTML += `<tr>
                            <td class="text-center">${e.id_cotizacion}</td>
                            <td class="text-center">${e.fecha_cotizacion.substr(0, 10).split('-').join('/')}</td>
                            <td class="text-right">${e.documento}</td>
                            <td class="text-right">${e.cliente}</td>
                            <td class="text-center">${e.placa}</td>
                            <td>${e.vehiculo} ${e.linea}</td>
                            <td>${e.asesor}</td>
                            <td class="text-center">
                            <button class="btn btn-primary btnEditarCotizacionAutogestion" id="${e.id_cotizacion}">Seleccionar</button>
                            </td>
                        </tr>`
            })
            $('.tabla-cotizaciones-autogestion tbody').html(tableHTML)
            const btns = document.querySelectorAll('.btnEditarCotizacionAutogestion')
            btns.forEach(e => {
                e.addEventListener('click', () => {
                    window.location = "index.php?ruta=editar-cotizacion-autogestion&idcotizacion=" + e.id;
                })
            })
            configurarDataTable()
        },
        error: err => {
            console.error(err)
        }
    })
}

const configurarDataTable = () => {
    $('.tabla-cotizaciones-autogestion').DataTable({
        "bDestroy": true,
		"order": [[0, "desc"], [1, "desc"]],
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
