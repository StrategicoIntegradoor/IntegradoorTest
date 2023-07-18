$("#name").keyup(function () {
  var cliNombres = document.getElementById("name").value.toLowerCase();
  $("#name").val(
    cliNombres.replace(/^(.)|\s(.)/g, function ($1) {
      return $1.toUpperCase();
    })
  );
});

$(document).ready(function() {
  // Asociar la función cotizarExequial al evento submit del formulario
  $("#formularioInvitacion").submit(function(event) {
    event.preventDefault(); // Evitar el envío automático del formulario
    authCedula();
  });
});

async function authCedula(){


    const cedula = document.getElementById("cc").value;
    const nombre = document.getElementById("name").value;
    const correo = document.getElementById("mail").value;

    if(cedula !== "" && nombre !== "" && correo !== ""){

    var data = {
        cc: cedula,
        nombre: nombre,
        correo: correo,
        accion: "verificarCC",
    };

    var options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };

    var url = 'controladores/invitar.controlador.php';
    $("#loaderOferta").html(
      '<img src="vistas/img/plantilla/loader-update.gif" width="34" height="34"><strong> Cargando pre_registro...</strong>'
    );
    fetch(url, options)
    .then(function(response) {
    $("#loaderOferta").html("");
    if (response.ok) {
      return response.text();
        } else {
            throw new Error('Error en la solicitud, error de conexión');
        }
    })
    .then(function(data) {
        console.log(data);
        data = JSON.parse(data);
        if(data.success == "Registro exitoso"){
            Swal.fire({
                icon: '<img src="vistas/img/plantilla/ofertas.png" width="84" height="84">',
                title: '<img src="vistas/img/plantilla/ofertas.png" width="84" height="84">',
                text: 'Invitacion enviada exitosamente',
              }).then(function() {
                location.reload(); // Refrescar la página
            });
        }else if(data.error === 'Documento existente en la BDD'){
            Swal.fire({
              icon: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
              title: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
              text: 'El documento ingresado ya se encuentra registrado, verifica la información y vuelve a intentar',
            }) 
        }else if(data.error === 'Error de conexion'){
            Swal.fire({
              icon: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
              title: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
              text: 'Ocurrio un error al crear la invitacion, estamos presentando problemas de conexion, comunicate con servicio tecnico',
            }) 
        }else if(data.error === 'Error al enviar el correo'){
          Swal.fire({
            icon: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
            title: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
            text: 'El correo registrado es invalido, no se pudo crear la invitacion, verificar informacion',
          }) 
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
    }else{
      //   console.error('Completa todos los campos para enviar el registro');
      // Swal.fire(
      //   'HEY! :/',
      //   'Por favor llena todos los campos',
      //   'error'
      // )
    }


}