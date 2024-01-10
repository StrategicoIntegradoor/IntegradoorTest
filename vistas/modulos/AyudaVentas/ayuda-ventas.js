$(document).ready(function () {
    obtenerAyudaVentas()
});

// Funciones
// const construirHtmlCentrosDeInspeccion = centrosDeInspeccion => {
//     if (centrosDeInspeccion.length === 0) return ''
//     let html = '<ul style="margin-top: 60px;" >'
//     centrosDeInspeccion.forEach(centro => {
//         if (centro !== '') html += `<li>- ${centro}</li>`
//     })
//     html += '</ul>'

//     return html
// }

// const construirHtmlCentrosDeInspeccion = centrosDeInspeccion => {
//     if (centrosDeInspeccion.length === 0) return '';
//     let html = '<ul style="margin-top: 60px;">';

//     centrosDeInspeccion.forEach(centro => {
//         if (centro.trim() !== '') {
//             // Dividir el centro en texto y enlace usando el espacio como separador
//             // const partes = centro.split(" ");
//             const partes = centro.indexOf('@');
//             if (partes !== -1) {
//                 // Extrae el texto y el enlace utilizando la posición del primer espacio
//                 // const texto = partes[0];
//                 // const enlace = partes[1];
//                 const texto = centro.substring(0, partes);
//                 const enlace = centro.substring(partes + 1);
//                 console.log(enlace)

//                 // Verifica si el valor es un enlace (comienza con "http" o "https")
//                 const esEnlace = enlace.startsWith('http') || enlace.startsWith('https');

//                 if (esEnlace) {
//                     // Si es un enlace, envuélvelo en una etiqueta <a> para que sea cliclable
//                     html += `<li>${texto} - <a href="${enlace}" target="_blank">${enlace}</a></li>`;
//                 } else {
//                     // Si no es un enlace, muestra el valor como está
//                     html += `<li>${centro}</li>`;
//                 }
//             } else {
//                 // Si no se pudo dividir en texto y enlace, muestra el valor como está
//                 html += `<li>${centro}</li>`;
//             }
//         }
//     });

//     html += '</ul>';
//     return html;
// };

const construirHtmlCentrosDeInspeccion = centrosDeInspeccion => {
    if (centrosDeInspeccion.length === 0) return '';
    let html = '<ul style="margin-top: 60px;">';

    // centrosDeInspeccion.forEach(centro => {
        // if (centrosDeInspeccion.trim() !== '') {
            // Dividir el centro en texto y enlace usando el espacio como separador
            const texto = centrosDeInspeccion[0];
            const enlace = centrosDeInspeccion[1];
            console.log(enlace)
            // if (partes !== -1) {
                // Extrae el texto y el enlace utilizando la posición del primer espacio
                // const texto = partes[0];
                // const enlace = partes[1];
                // const texto = centro.substring(0, partes);
                // const enlace = centro.substring(partes + 1);
                // console.log(enlace)

                // Verifica si el valor es un enlace (comienza con "http" o "https")
                // const esEnlace = enlace.startsWith('http') || enlace.startsWith('https');

                if (enlace == undefined) {
                    // Si es un enlace, envuélvelo en una etiqueta <a> para que sea cliclable
                    let textoSinGuion = texto.replace(/-$/, '');
                    html += `<li><span class="text-config">${textoSinGuion}</span></li>`;
                    // html += `<li><span class="text-config">${texto}</span></li>`;
                } else {
                    html += `<li><span class="text-config">${texto}</span> - <a href="${enlace}" target="_blank" class="text-config">${enlace}</a></li>`;
                 // Si no es un enlace, muestra el valor como está
                }
            // } 
        // }
    // });

    html += '</ul>';
    return html;
};
const construirHtmlContinuidad = continuidades => {
    if (continuidades.length === 0) return ''
    let html = '<ul style="margin-top: 60px;">'
    continuidades.forEach(continuidad => {
        if (continuidad !== '') html += `<li><span class="text-config">✅ ${continuidad}</span></li>`
    })
    html += '</ul>'

    return html
}

const construirHtmlCambioIntermediario = cambioPoliticas => {
    if (cambioPoliticas.length === 0) return ''
    let html = '<ul style="margin-top: 60px;">'
    cambioPoliticas.forEach(cambioPolitica => {
        if (cambioPolitica !== '') html += `<li><span class="text-config">✅ ${cambioPolitica}</span></li>`
    })
    html += '</ul>'

    return html
}



const construirHtmlFormasDePago = formasDePago => {
    if (formasDePago.length === 0) return '';
    let html = '<ul style="margin-top: 60px;">';
    
    formasDePago.forEach(formaDePago => {
        if (formaDePago !== '') {
            // Buscar la posición de los dos puntos
            const colonIndex = formaDePago.indexOf(':');
            
            if (colonIndex !== -1) {
                // Separar el texto antes y después de los dos puntos
                const text = formaDePago.substring(0, colonIndex + 1); // Incluye los dos puntos
                const link = formaDePago.substring(colonIndex + 1).trim(); // Elimina espacios en blanco
                
                html += `<li><span class="text-config">${text}</span> <a class="text-config" href="${link}" target="_blank">${link}</a></li>`;
            } else {
                html += `<li><span class="text-config">${formaDePago}</span></li>`;
            }
        }
    });
    
    html += '</ul>';
    return html;
}

document.querySelector('#editarAyudaVenta').addEventListener('click', e => {
    editarAyudaVenta()
})
const editarAyudaVenta = async () => {
    const d = document
    const issetSarlaft = d.querySelector('#sarlaft').files.length > 0
    const issetSarlaft2 = d.querySelector('#sarlaft2').files.length > 0
    const formData = new FormData()
    formData.append('funcion', 'editarAyudaVenta');
    formData.append('linea_de_atencion', d.querySelector('#linea_atencion').value)
    formData.append('id_ayuda_venta', d.querySelector('#id_ayuda_venta').value)
    formData.append('clausulado', d.querySelector('#clausulado').value)
    if (issetSarlaft) {
        formData.append('sarlaft', d.querySelector('#sarlaft').files[0])
    }
    if (issetSarlaft2) {
        formData.append('sarlaft2', d.querySelector('#sarlaft2').files[0])
    }
    formData.append('aseguradora', d.querySelector('#aseguradora').value)
    formData.append('centro_de_inspeccion', centros.join('-').toString())
    formData.append('continuidad', continuidades.join('-').toString())
    formData.append('formas_de_pago', formasDePago.join('-').toString())
    formData.append('tips_expedicion', d.querySelector('#tips_expedicion').value)

    await editarAyudaVentaRequest(formData);
}
const editarAyudaVentaRequest = async _formData => {
    const req = await fetch('./vistas/modulos/AyudaVentas/AyudaVentasController.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
        },
        body: _formData
    }).then(() => {
        obtenerAyudaVentas()
        document.querySelector('.form-editar-ayuda-venta').style.display = 'none';
    })
}
const editar = async _id => {
    const data = await obtenerAyudaVenta(_id)
    llenarFormulario(data)
}
const obtenerAyudaVenta = async _id => {
    const formData = new FormData();
    formData.append('funcion', 'obtenerAyudaVenta')
    formData.append('id', _id)
    const _data = await fetch('./vistas/modulos/AyudaVentas/AyudaVentasController.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        return data
    })
    return _data
}
const llenarFormulario = _data => {
    const d = document
    if (_data.centro_de_inspeccion != null) {
        centros = _data.centro_de_inspeccion.split('-')
        llenarCentrosDeInspeccion(centros)
    }
    if (_data.continuidad != null) {
        continuidades = _data.continuidad.split('-')
        llenarContinuidades(continuidades)
    }
    if (_data.politicas_cambio_intermediario != null) {
        politicas = _data.politicas_cambio_intermediario.split('-')
        llenarPoliticasCambio(politicas)
    }
    if (_data.formas_de_pago != null) {
        formasDePago = _data.formas_de_pago.split('-')
        llenarFormasDePago(formasDePago)
    }
    d.querySelector('#aseguradora').value = _data.aseguradora
    d.querySelector('#id_ayuda_venta').value = _data.id 
    d.querySelector('#linea_atencion').value = _data.linea_de_atencion
    d.querySelector('#clausulado').value = _data.link_clausulado
    d.querySelector('#continuidad').innerText = _data.continuidad
    d.querySelector('#tips_expedicion').innerText = _data.tips_de_expedicion
    d.querySelector('.form-editar-ayuda-venta').style.display = 'block'
    window.scroll(0, 0)
}
const obtenerAyudaVentas = async () => {
    const formData = new FormData();
    formData.append('funcion', 'obtenerAyudaVentas')
    await fetch('./vistas/modulos/AyudaVentas/AyudaVentasController.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(res => {
        const test = res.json()
        //return res.json()
        return test
    })
    .then(data => {

        let fecha_max1 = '0000-00-00 00:00:00';

        let rol = document.getElementById("rol").value;
        let template = ''
        data.forEach(ayudaVenta => {
            console.log(ayudaVenta.aseguradora)
            const fecha_base = ayudaVenta.Fecha_Ultima_modificacion;

            if(compare_dates(fecha_base, fecha_max1)){

                fecha_base

                fecha_max1 = fecha_base
            }
            
            const centrosDeInspeccion = (ayudaVenta.centro_de_inspeccion != null) 
                                            ? ayudaVenta.centro_de_inspeccion.split('@') : []
            const continuidades = (ayudaVenta.continuidad != null) 
                                            ? ayudaVenta.continuidad.split('-') : []
            const cambioPoliticas = (ayudaVenta.politicas_cambio_intermediario != null) 
                                            ? ayudaVenta.politicas_cambio_intermediario.split('-') : []
            let formasDePago = [];
            if(rol == 'x'){
                formasDePago = (ayudaVenta.formas_de_pago_freelance != null) 
                                            ? ayudaVenta.formas_de_pago_freelance.split('@') : []
            }else{
                formasDePago = (ayudaVenta.formas_de_pago != null) 
                                            ? ayudaVenta.formas_de_pago.split('@') : []
            }                                
            let partTemplate = `
                <tr >
                    <td style="text-align: center;"><ul style="margin-top: 60px;"><img src="./vistas/modulos/AyudaVentas/src/logos/${ayudaVenta.aseguradora}.png" class="img-responsive" width="80" style="margin: 0 auto; height: ${ayudaVenta.aseguradora === 'Solidaria' ? '40px' : 'auto'};"></ul></td>
                    <td><ul style="margin-top: 60px; text-align: center;">${ayudaVenta.linea_de_atencion}</ul></td>`
            if (ayudaVenta.link_clausulado) {
                partTemplate += `<td style="text-align: center;"><ul style="margin-top: 60px;"><button class="btn btn-alert" style="border-color: #88d600; width: 90%; color: #88d600; font-weight: 500;" onclick="validarPermisoClausulado('${ayudaVenta.link_clausulado}')">${ayudaVenta.link_clausulado.substring(0, 24)}</button></ul></td>`;
            } else {
                partTemplate += '<td></td>';
            }
            if (ayudaVenta.path_sarlaft || ayudaVenta.path_sarlaft2) {
                if(ayudaVenta.aseguradora == 'Allianz' || ayudaVenta.aseguradora == 'Equidad' || ayudaVenta.aseguradora == 'Previsora'){

                    // let sarlaftButtons = '<td><ul style="margin-top: 60px;">'
                    // sarlaftButtons += ayudaVenta.path_sarlaft ? `<a href="${ayudaVenta.path_sarlaft}" class="btn btn-alert" style="background: red; color: #fff; font-weight: 500;" target="_blank">PDF PN</a>` : '<button class="btn btn-alert" style="background: red; color: #fff; font-weight: 500;">PDF PN</button>';
                    // partTemplate += sarlaftButtons + '</ul></td>'
                    // let sarlaftButtons2 = '<td><ul style="margin-top: 60px;">'
                    // sarlaftButtons2 += ayudaVenta.path_sarlaft2 ? `<a href="${ayudaVenta.path_sarlaft2}" class="btn btn-alert" style="background: red; color: #fff; font-weight: 500;" target="_blank">PDF PJ</a>` : '<button class="btn btn-alert" style="background: red; color: #fff; font-weight: 500;">PDF PJ</button>';
                    // partTemplate += sarlaftButtons2 + '</ul></td>'

                    let sarlaftButtons = '<td><ul style="margin-top: 60px; display: flex; flex-direction: column;">';
                    sarlaftButtons += ayudaVenta.path_sarlaft ? `<a href="${ayudaVenta.path_sarlaft}" class="btn btn-alert" style="background: red; color: #fff; font-weight: 500; margin-bottom: 5px;" target="_blank">PDF PN</a>` : '<button class="btn btn-alert" style="background: red; color: #fff; font-weight: 500; margin-bottom: 15px;">PDF PN</button>';
                    sarlaftButtons += ayudaVenta.path_sarlaft2 ? `<a href="${ayudaVenta.path_sarlaft2}" class="btn btn-alert" style="background: red; color: #fff; font-weight: 500;" target="_blank">PDF PJ</a>` : '<button class="btn btn-alert" style="background: red; color: #fff; font-weight: 500;">PDF PJ</button>';
                    sarlaftButtons += '</ul></td>';

                    partTemplate += sarlaftButtons;


                }else{

                    // let sarlaftButtons = '<td><ul style="margin-top: 60px;">'
                    // sarlaftButtons += ayudaVenta.path_sarlaft ? `<button class="btn btn-alert" style="background: red; color: #fff; font-weight: 500;" onclick="validarPermisoPdfPersonaNatural('./vistas/modulos/AyudaVentas/pdf/sarlaft/${ayudaVenta.path_sarlaft}')">PDF PN</button>` : ''
                    // partTemplate += sarlaftButtons + '</ul></td>'
                    // let sarlaftButtons2 = '<td><ul style="margin-top: 60px;">'
                    // sarlaftButtons2 += ayudaVenta.path_sarlaft2 ? `<button class="btn btn-alert" style="background: red; color: #fff; font-weight: 500;" onclick="validarPermisoPdfPersonaJuridica('./vistas/modulos/AyudaVentas/pdf/sarlaft2/${ayudaVenta.path_sarlaft2}')">PDF PJ</button>` : ''
                    // partTemplate += sarlaftButtons2 + '</ul></td>'

                    let sarlaftButtons = '<td><ul style="margin-top: 60px; display: flex; flex-direction: column;">';
                    sarlaftButtons += ayudaVenta.path_sarlaft ? `<button class="btn btn-alert" style="background: red; color: #fff; font-weight: 500; margin-bottom: 5px;" onclick="validarPermisoPdfPersonaNatural('./vistas/modulos/AyudaVentas/pdf/sarlaft/${ayudaVenta.path_sarlaft}','${ayudaVenta.aseguradora}')">PDF PN</button>` : '';
                    sarlaftButtons += ayudaVenta.path_sarlaft2 ? `<button class="btn btn-alert" style="background: red; color: #fff; font-weight: 500;" onclick="validarPermisoPdfPersonaJuridica('./vistas/modulos/AyudaVentas/pdf/sarlaft2/${ayudaVenta.path_sarlaft2}','${ayudaVenta.aseguradora}')">PDF PJ</button>` : '';
                    sarlaftButtons += '</ul></td>';

                    partTemplate += sarlaftButtons;

                }

            } else {
                partTemplate += '<td></td>'
                partTemplate += '<td></td>'
            }
            partTemplate += `

            <style>
                .fixed-width {
                    text-align: center; /* Alinea el contenido al centro si es necesario */
                    word-wrap: break-word; /* Indica que el texto debe envolverse cuando se excede el ancho máximo */
                }
            </style>
                <td class="fixed-width">${construirHtmlCentrosDeInspeccion(centrosDeInspeccion)}</td>
                <td class="fixed-width continuidad">${construirHtmlContinuidad(continuidades)}</td>
                <td class="fixed-width cambio-intermediario">${construirHtmlCambioIntermediario(cambioPoliticas)}</td>
                <td class="fixed-width">${construirHtmlFormasDePago(formasDePago)}</td>`
            if(permisos.Editarinformaciondelayudaventas == 'x'){
                partTemplate += `<td style="line-height: 200px;">
                    <button 
                        onclick="editar(${ayudaVenta.id})"
                        class="btn btn-primary"
                    >
                        Editar
                    </button>
                </td>
            </tr>`
            }
            template += partTemplate
        })

        let fecha_max2 =  fecha_max1.split(' ')
        let fecha_max3 = fecha_max2[0];
        let fecha_max4 = fecha_max3.split('-')
        let fecha_max = fecha_max4[2]+'-'+fecha_max4[1]+'-'+fecha_max4[0];
        let men_fech = "<b>Fecha ultima actualización: </b>" + fecha_max
        document.querySelector('#fech_ult').innerHTML = men_fech
        document.querySelector('.ayuda-ventas-body').innerHTML = template   
    })
}
/* CENTROS DE INSPECCIÓN */
/* Agregar centro */
let centros = []
document.querySelector('#agregarCentroDeInspeccion').addEventListener('click', e => {
    e.preventDefault()
    agregarCentroDeInspeccion()
})
const agregarCentroDeInspeccion = () => {
    const d = document
    const centro = d.querySelector('#centro_inspeccion').value
    if (centro === '') return;
    centros.push(centro)
    const index = (centros.length - 1)
    template = `
    <div class="form-group">
        <input type="hidden" value="${index}" />
        <input class="form-control" type="text" id="centro_value_${index}" value="${centro}" />
        <button class="btn btn-danger" onclick="editarCentroInspeccion(${index}, 'centro_value_${index}')">Editar   </button>
    </div>
    `
    d.querySelector('#centros_de_inspeccion').innerHTML += template
    d.querySelector('#centro_inspeccion').value = ''
}

const llenarCentrosDeInspeccion = _centros => {
    const d = document
    let template = ''
    _centros.forEach((centro, index) => {
        template += `
        <div class="form-group">
            <input type="hidden" value="${index}" />
            <input class="form-control" type="text" id="centro_value_${index}" value="${centro}" />
            <button class="btn btn-danger" onclick="editarCentroInspeccion(${index}, 'centro_value_${index}')">Editar   </button>
        </div>
        `
    })
    d.querySelector('#centros_de_inspeccion').innerHTML = template
}

const editarCentroInspeccion = (_index, _centro_value_index) => {
    const d = document
    centros[_index] = d.querySelector('#' + _centro_value_index).value
}
/* END - CENTROS DE INSPECCIÓN */

/* CONTINUIDAD */
let continuidades = []
document.querySelector('#agregarContinuidad').addEventListener('click', e => {
    e.preventDefault()
    agregarContinuidad()
})
const agregarContinuidad = () => {
    const d = document
    const continuidad = d.querySelector('#continuidad').value
    if (continuidad === '') return;
    continuidades.push(continuidad)
    const index = (continuidades.length - 1)
    template = `
    <div class="form-group">
        <input type="hidden" value="${index}" />
        <input class="form-control" type="text" id="continuidad_value_${index}" value="${continuidad}" />
        <button class="btn btn-danger" onclick="editarContinuidad(${index}, 'continuidad_value_${index}')">Editar   </button>
    </div>
    `
    d.querySelector('#continuidades').innerHTML += template
    d.querySelector('#continuidad').value = ''
}
const llenarContinuidades = _continuidades => {
    const d = document
    let template = ''
    _continuidades.forEach((continuidad, index) => {
        template += `
        <div class="form-group">
            <input type="hidden" value="${index}" />
            <input class="form-control" type="text" id="continuidad_value_${index}" value="${continuidad}" />
            <button class="btn btn-danger" onclick="editarContinuidad(${index}, 'continuidad_value_${index}')">Editar   </button>
        </div>
        `
    })
    d.querySelector('#continuidades').innerHTML = template
}
const editarContinuidad = (_index, _continuidad_value_index) => {
    const d = document
    continuidades[_index] = d.querySelector('#' + _continuidad_value_index).value
}
/* END - CONTINUIDAD */

/* FORMAS DE PAGO */
let formasDePago = []
document.querySelector('#agregarFormaDePago').addEventListener('click', e => {
    e.preventDefault()
    agregarFormaDePago()
})
const agregarFormaDePago = () => {
    const d = document
    const formaDePago = d.querySelector('#forma_de_pago').value
    if (formaDePago === '') return;
    formasDePago.push(formaDePago)
    const index = (formasDePago.length - 1)
    template = `
    <div class="form-group">
        <input type="hidden" value="${index}" />
        <input class="form-control" type="text" id="forma_de_pago_value_${index}" value="${formaDePago}" />
        <button class="btn btn-danger" onclick="editarFormaDePago(${index}, 'forma_de_pago_value_${index}')">Editar   </button>
    </div>
    `
    d.querySelector('#formas_de_pago').innerHTML += template
    d.querySelector('#forma_de_pago').value  = ''
}

const llenarFormasDePago = _formasDePago => {
    const d = document
    let template = ''
    _formasDePago.forEach((formaDePago, index) => {
        template += `
            <div class="form-group">
                <input type="hidden" value="${index}" />
                <input class="form-control" type="text" id="forma_de_pago_value_${index}" value="${formaDePago}" />
                <button class="btn btn-danger" onclick="editarFormaDePago(${index}, 'forma_de_pago_value_${index}')">Editar   </button>
            </div>
            `
    })
    d.querySelector('#formas_de_pago').innerHTML = template
}
const editarFormaDePago = (_index, _forma_de_pago_value_index) => {
    const d = document
    formasDePago[_index] = d.querySelector('#' + _forma_de_pago_value_index).value
}
const llenarPoliticasCambio = _politicas_cambio_intermediario => {
    const d = document
    let template = ''
    _politicas_cambio_intermediario.forEach((politica, index) => {
        template += `
        <div class="form-group">
            <input type="hidden" value="${index}" />
            <input class="form-control" type="text" id="politica_value_${index}" value="${politica}" />
            <button class="btn btn-danger" onclick="editarPolitica(${index}, 'politica_value_${index}')">Editar   </button>
        </div>
        `
    })
    d.querySelector('#continuidades').innerHTML = template
}
/* END - FORMAS DE PAGO */


/* editar sarlaf generico1*/

document.querySelector('#btn_edit_generic1').addEventListener('click', e => {

    $(".form-editar-generic1").show();
})

document.querySelector('#editargeneric1').addEventListener('click', e => {

    Edit_sarlaf_generico1();
    
})

const Edit_sarlaf_generico1 =async () => {

    const d = document
    const issetSarlaft = d.querySelector('#sarlaftGeneric1').files.length > 0
    if (issetSarlaft) {
        const formData = new FormData()
        formData.append('funcion', 'editarSarlaftGeneric1');
        formData.append('sarlaft', d.querySelector('#sarlaftGeneric1').files[0])

        const req = await fetch('./vistas/modulos/AyudaVentas/AyudaVentasController.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        }).then(() => {

            Swal.fire('¡Documento actualizado con exíto!')


            setTimeout(function(){
                location.reload();
            }, 3000);
            
        })
    }else{
        Swal.fire('¡Seleccione un archivo!')
    }

}


/*comprarar fechas*/

function compare_dates(fecha, fecha2)  
  {  
   
    var xMonth=fecha.substring(3, 5);  
    var xDay=fecha.substring(0, 2);  
    var xYear=fecha.substring(6,10);  
    var yMonth=fecha2.substring(3, 5);  
    var yDay=fecha2.substring(0, 2);  
    var yYear=fecha2.substring(6,10);  
    if (xYear> yYear)  
    {  
        return(true)  
    }  
    else  
    {  
      if (xYear == yYear)  
      {   
        if (xMonth> yMonth)  
        {  
            return(true)  
        }  
        else  
        {   
          if (xMonth == yMonth)  
          {  
            if (xDay> yDay)  
              return(true);  
            else  
              return(false);  
          }  
          else  
            return(false);  
        }  
      }  
      else  
        return(false);  
    }  
} 

/* editar sarlaf generico2*/

document.querySelector('#btn_edit_generic2').addEventListener('click', e => {

    $(".form-editar-generic2").show();
})

document.querySelector('#editargeneric2').addEventListener('click', e => {

    Edit_sarlaf_generico2();
    
})



const Edit_sarlaf_generico2 =async () => {

    const d = document
    const issetSarlaft = d.querySelector('#sarlaftGeneric2').files.length > 0
    if (issetSarlaft) {
        const formData = new FormData()
        formData.append('funcion', 'editarSarlaftGeneric2');
        formData.append('sarlaft', d.querySelector('#sarlaftGeneric2').files[0])

        const req = await fetch('./vistas/modulos/AyudaVentas/AyudaVentasController.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        }).then(() => {


            Swal.fire('¡Documento actualizado con exíto!')

            setTimeout(function(){
                location.reload();
            }, 3000);
        })
    }else{
        Swal.fire('¡Seleccione un archivo!')
    }

}

   