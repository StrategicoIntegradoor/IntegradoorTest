//Al cargar la pagina
(()=>{

    cargar_planes();

 })()


 
 // TRAER PLANES // 
 function cargar_planes(){

    // Opciones de configuración de la solicitud
    var options = {
        method: 'GET',
    };
      // URL del controlador PHP
    var URL = 'controladores/planes.controlador.php?tipo=1';
    var documentosTable = document.getElementById("plansTable");
    fetch(URL,options)
    .then(response => response.json(),
    )
    .then(data => {
        console.log(data);
        var tableBody = documentosTable.getElementsByTagName("tbody")[0];
        tableBody.innerHTML = "";

        data.forEach(function(documento) {

            //console.log(documento.PoliticasCobro);
            var newRow = tableBody.insertRow();

            var valueCell = newRow.insertCell();
            valueCell.textContent = documento.idPlan;            

            var descriptionCell = newRow.insertCell();
            descriptionCell.textContent = documento.nombrePlan;

            var idStateCell = newRow.insertCell();
            idStateCell.textContent = documento.numeroDeCotizacionesPlan;

            var observationCell = newRow.insertCell();
            observationCell.textContent = documento.cantidadeUsuarios;

            var observationCell = newRow.insertCell();
            observationCell.textContent = documento.cantidadUsuariosWeb;

            var observationCell = newRow.insertCell();
            observationCell.textContent = documento.iframe;

            var observationCell = newRow.insertCell();
            observationCell.textContent = documento.cantRecargasGratisAnuales;

            var observationCell = newRow.insertCell();
            observationCell.textContent = documento.Valor;

            var accionesCell = newRow.insertCell();
           
            var eliminarBtn = document.createElement("button");
            eliminarBtn.classList.add("btn", "btn-danger");
            eliminarBtn.innerHTML = '<i class="fa fa-trash"></i>';
            eliminarBtn.addEventListener("click", function() {
                eliminarPlan(documento.idPlan); 
            });

            var actualizarBtn = document.createElement("button");
            actualizarBtn.id = "btnEditarPlan"; // Agrega un ID al botón de editar
            actualizarBtn.classList.add("btn", "btn-primary");
            actualizarBtn.innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i>';
            actualizarBtn.addEventListener("click", function() {
                modoModal = 'editar';
                abrirModalAgregarPlan(documento.nombrePlan, documento.numeroDeCotizacionesPlan,documento.cantidadeUsuarios,documento.cantidadUsuariosWeb,documento.iframe,
                    documento.cantRecargasGratisAnuales,documento.Valor, modoModal, documento.idPlan);
              });

              var separador = document.createElement("span");
              separador.textContent = " ";
              
              accionesCell.appendChild(eliminarBtn);
              accionesCell.appendChild(separador);
              accionesCell.appendChild(actualizarBtn);
        });

         /*===================================================
        CONFIGURACION DE LA TABLA DATATABLE PARA COTIZACIONES
        ===================================================*/
      $("#plansTable").DataTable({
          "destroy": true,          // order: [
          //   [0, "desc"],
          //   [1, "desc"],
          // ],
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
  })



    .catch(error => {
        console.error(error);
    });
}

//ELIMINAR PLAN

function eliminarPlan(idPlan){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
    

    var options = {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'  // Establecer el tipo de contenido del cuerpo de la solicitud
          },
          body: JSON.stringify({id:idPlan})  // Convertir los datos a formato JSON y establecerlos como cuerpo de la solicitud        
    };

    var URL = 'controladores/planes.controlador.php?tipo=1';
    fetch(URL,options)
    .then(response => response.json(),
    )
    .then(data => {
        // Manejar la respuesta del servidor después de eliminar el documento
        console.log('Plan eliminado:', data);
        if(data === 1){
            cargar_planes();
        }else{
            console.error('Error al eliminar el plan:', error)
        }
        // Realizar cualquier otra acción necesaria después de eliminar el documento
      })
      .catch(error => {
        console.error('Error de solicitud:', error);
      });
    }
})
  }


  //AGREGAR PLAN MODAL 

function abrirModalAgregarPlan(nombrePlan, numeroDeCotizacionesPlan,cantidadeUsuarios,cantidadUsuariosWeb,iframe,
    cantRecargasGratisAnuales,Valor, variable, idPlan) {
    var botonAgregar = document.getElementById("btnAgregarPlan");
    var botonEditar = document.getElementById("btnEditarPlan");
    var guardarPlanBtn = document.getElementById("guardarPlanBtn");
    var actualizarPlanBtn = document.getElementById("actualizarPlanBtn");
    var guardarPlanEncabezado = document.getElementById("crearPlan");
    var actualizarPlanEncabezado = document.getElementById("actualizarPlan");


    if (variable === 'agregar') {

        console.log('Modal abierto desde el botón Agregar:', botonAgregar.id);
        document.getElementById("namePlan").value = "";
        document.getElementById("numCot").value = "";
        document.getElementById("cantUsu").value = "";
        document.getElementById("cantUsuWeb").value = "";
        document.getElementById("iframe").value = "";
        document.getElementById("freeCharges").value = "";
        document.getElementById("valor").value = "";

        guardarPlanBtn.style.display = "block";
        actualizarPlanBtn.style.display = "none";

        guardarPlanEncabezado.style.display = "block";
        actualizarPlanEncabezado.style.display = "none";

      } else if (variable === 'editar') {
        mostrarPlan(nombrePlan, numeroDeCotizacionesPlan,cantidadeUsuarios,cantidadUsuariosWeb,iframe,
        cantRecargasGratisAnuales,Valor, idPlan);
        console.log('Modal abierto desde el botón Editar:',idPlan);

        guardarPlanBtn.style.display = "none";
        actualizarPlanBtn.style.display = "block";

        guardarPlanEncabezado.style.display = "none";
        actualizarPlanEncabezado.style.display = "block";
      }
  }


    //GUARDAR PLAN NUEVO

    var guardarPlanBtn = document.getElementById("guardarPlanBtn");

    guardarPlanBtn.addEventListener("click", function(event) {

    // event.preventDefault();
      var namePlanInput = document.getElementById("namePlan");
      var numCotInput = document.getElementById("numCot");
      var cantUsuInput = document.getElementById("cantUsu");
      var cantUsuWebInput = document.getElementById("cantUsuWeb");
      var iframeInput = document.getElementById("iframe");
      var freeChargesInput = document.getElementById("freeCharges");
      var valorInput = document.getElementById("valor");

  
      agregarPlan(namePlanInput, numCotInput, cantUsuInput, cantUsuWebInput, iframeInput, freeChargesInput, valorInput);
  
    });
    
    function agregarPlan(namePlanInput, numCotInput, cantUsuInput, cantUsuWebInput, iframeInput, freeChargesInput, valorInput) {

        console.log()
  
      var options = {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'  // Establecer el tipo de contenido del cuerpo de la solicitud
            },
            body: JSON.stringify({nombre: namePlanInput.value, cantCot: numCotInput.value, cantUsu: cantUsuInput.value, cantUsuWeb: cantUsuWebInput.value,
            iframe: iframeInput.value, freeCharges: freeChargesInput.value, valor: valorInput.value})  // Convertir los datos a formato JSON y establecerlos como cuerpo de la solicitud        
      };

      var URL = 'controladores/planes.controlador.php?tipo=1';
      fetch(URL,options)
      .then(response => response.json(),
      )
      .then(data => {
          // Manejar la respuesta del servidor después de eliminar el documento
          console.log('Tipo de plan agregado:', data);
          if(data === 1){
              cargar_planes();
          }else{
              console.error('Error al agregar plan:', error)
              cargar_planes();
          }
          // Realizar cualquier otra acción necesaria después de eliminar el documento
        })
        .catch(error => {
          console.error('Error de solicitud al agregar plan nuevo:', error);
        });
    }



///MOSTRAR PLAN INDIVIDUAL

    function mostrarPlan(nombrePlan, numeroDeCotizacionesPlan,cantidadeUsuarios,cantidadUsuariosWeb,iframe,
        cantRecargasGratisAnuales,Valor, idPlan){

        document.getElementById("namePlan").value = nombrePlan
        document.getElementById("numCot").value = numeroDeCotizacionesPlan
        document.getElementById("cantUsu").value = cantidadeUsuarios
        document.getElementById("cantUsuWeb").value = cantidadUsuariosWeb
        document.getElementById("iframe").value = iframe
        document.getElementById("freeCharges").value = cantRecargasGratisAnuales
        document.getElementById("valor").value = Valor
        document.getElementById("idPlanInput").value = idPlan;

        $('#modalAgregarPlan').modal('show');

}

//GUARDAR EDICION PLAN INDIVIDUAL

var actualizarPlanBtn = document.getElementById("actualizarPlanBtn");

actualizarPlanBtn.addEventListener("click", function() {

    // event.preventDefault();
    var namePlanInput = document.getElementById("namePlan");
    var numCotInput = document.getElementById("numCot");
    var cantUsuInput = document.getElementById("cantUsu");
    var cantUsuWebInput = document.getElementById("cantUsuWeb");
    var iframeInput = document.getElementById("iframe");
    var freeChargesInput = document.getElementById("freeCharges");
    var valorInput = document.getElementById("valor");
    var idPlanInput = document.getElementById("idPlanInput");


editarPlan(namePlanInput, numCotInput, cantUsuInput, cantUsuWebInput, iframeInput, freeChargesInput, valorInput, idPlanInput);


});

function editarPlan(namePlanInput, numCotInput, cantUsuInput, cantUsuWebInput, iframeInput, freeChargesInput, valorInput, idPlanInput) {

console.log("ID de la política a editar:", idPlanInput.value);

var options = {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'  // Establecer el tipo de contenido del cuerpo de la solicitud
      },
      body: JSON.stringify({nombre: namePlanInput.value, cantCot: numCotInput.value, cantUsu: cantUsuInput.value, cantUsuWeb: cantUsuWebInput.value,
        iframe: iframeInput.value, freeCharges: freeChargesInput.value, valor: valorInput.value, id: idPlanInput.value})  // Convertir los datos a formato JSON y establecerlos como cuerpo de la solicitud        
};

var URL = 'controladores/planes.controlador.php?tipo=2';
fetch(URL,options)
.then(response => response.json(),
)
.then(data => {
    // Manejar la respuesta del servidor después de eliminar el documento
    console.log('Plan correctamente editado:', data);
    if(data === 1){
        cargar_planes();
    }else{
        console.error('Error al editar plan:', error)
        cargar_planes();
    }
    // Realizar cualquier otra acción necesaria después de eliminar el documento
  })
  .catch(error => {
    console.error('Error al editar Planes, solicitud fallida:', error);
  });
}



