// Ejectura la funcion Generar pdf de ofertas
$("#btnExequial").click(function() {
  cotizarExequial();
});

//  // Obtiene los datos de cada campo del formulario y Valida que no esten Vacios
//  $("#formResumTitu").on(
//   "submit",
//   function (e) {
//     e.preventDefault(); // Evita que la pagina se recargue
//   }
// );

async function cotizarExequial(){

let registro = 0;
const txtNombre = document.getElementById('nombreTitular').value;
const edadTitularID = document.getElementById('edadTitularID').value;
const tipoPlanExequialID = document.getElementById('tipoPlanExequialID').value;
const usuarioID = document.getElementById('idUsuario').value;

  if(txtNombre !== "" && edadTitularID !== "" && tipoPlanExequialID !== ""){

      if(edadTitularID >= 60 || edadTitularID <= 10){
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
        usuario: usuarioID,
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
          const url = "extensiones/tcpdf/pdf/exequias.php?cotizacion=" + data.numeroCotizacion + "&txtNombre=" + txtNombre + "&tipoPlan=" + tipoPlanExequialID;
          window.open(url, "_blank");
            Swal.fire({
              icon: '<img src="vistas/img/plantilla/ofertas.png" width="104" height="104">',
              title: '<img src="vistas/img/plantilla/ofertas.png" width="104" height="104">',
              text: 'Cotización generada exitosamente',
            }).then(function() {
              // location.reload(); // Refrescar la página
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