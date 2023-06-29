$("#name").keyup(function () {
  var cliNombres = document.getElementById("name").value.toLowerCase();
  $("#name").val(
    cliNombres.replace(/^(.)|\s(.)/g, function ($1) {
      return $1.toUpperCase();
    })
  );
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
            Swal.fire(
                'El documento ingresado ya se encuentra registrado',
                'Verifica la información y vuelve a intentar',
                'error'
              ) 
        }else{
            Swal.fire(
                'Alerta! :(',
                'Error interno, contactese con servicio técnico',
                'error'
              ) 
        }
    })
    .catch(function(error) {
        console.log(error);
        Swal.fire(
            'HEY! :(',
            'Error de solicitud, no pudo crearse el pre_registro',
            'error'
          )
        });
    }else{
        console.error('Completa todos los campos para enviar el registro');
      Swal.fire(
        'HEY! :/',
        'Por favor llena todos los campos',
        'error'
      )
    }


}