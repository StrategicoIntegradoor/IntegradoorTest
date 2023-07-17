// $(document).ready(function() {
//   // Llamar a la función cotizarExequial al hacer clic en el botón
//   $("#btnExequial").click(function(event) {
//     event.preventDefault(); // Evitar la acción predeterminada del botón
//     cotizarExequial();
//   });
// });

$("#nombreTitular").keyup(function () {
  var cliNombres = document.getElementById("nombreTitular").value.toLowerCase();
  $("#nombreTitular").val(
    cliNombres.replace(/^(.)|\s(.)/g, function ($1) {
      return $1.toUpperCase();
    })
  );
});

$(document).ready(function() {
  // Asociar la función cotizarExequial al evento submit del formulario
  $("#formResumTitu").submit(function(event) {
    event.preventDefault(); // Evitar el envío automático del formulario
    cotizarExequial();
  });
});


async function cotizarExequial(){

let registro = 0;
const txtNombre = document.getElementById('nombreTitular').value;
const edadTitularID = document.getElementById('edad').value;
const tipoPlanExequialID = document.getElementById('tipoPlanExequialID').value;
const nombreUsuario = document.getElementById('nombre').value;
const apellidoUsuario = document.getElementById('apellido').value;
const usuario = nombreUsuario + ' ' + apellidoUsuario;
const idUsuario = document.getElementById('idUsuario').value;

  if(txtNombre !== "" && edadTitularID !== "" && tipoPlanExequialID !== ""){

      if(edadTitularID >= 65 || edadTitularID <= 17){
        Swal.fire({
          icon: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
          title: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
          text: 'Usuario fuera del rango de edad permitido',
        }) 
      }else{
      registro++;
      var data = {
        registro: registro,
        nombre: txtNombre,
        edad: edadTitularID,
        tipo: tipoPlanExequialID,
        usuario: usuario,
        idUsuario: idUsuario,
        accion: 'nuevaCotizacion'
      };

      var options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      };

      var enlace = 'controladores/exequias.controlador.php';

      fetch(enlace, options)
      .then(function(response) {
      if (response.ok) {
        console.log(response)
        return response.text();
          } else {
              throw new Error('Error en la solicitud, error de conexión');
          }
      })
      .then(function(data) {
        console.log(data);
        data = JSON.parse(data);
        if(data.success === "Registro exitoso"){
          console.log('aqui llegue')
          const url = "extensiones/tcpdf/pdf/exequias.php?cotizacion=" + data.numeroCotizacion + "&txtNombre=" + txtNombre + "&tipoPlan=" + tipoPlanExequialID;
          window.open(url, "_blank");
            Swal.fire({
              icon: '<img src="vistas/img/plantilla/ofertas.png" width="104" height="104">',
              title: '<img src="vistas/img/plantilla/ofertas.png" width="104" height="104">',
              text: 'Cotización generada exitosamente',
            }).then(function() {
              location.reload(); // Refrescar la página
          });
        }
      })
      .catch(function(error) {
        console.log(error);
        Swal.fire({
          icon: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
          title: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
          text: 'Ocurrio un error al crear la invitacion, estamos presentando problemas de conexion, comunicate con servicio tecnico',
        }) 
        });
        
      }
  }
}