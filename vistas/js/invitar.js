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

    fetch(url, options)
    .then(function(response) {
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
            Swal.fire(
                'Good job!',
                'Registro realizado exitosamente',
                'success'
              ).then(function() {
                location.reload(); // Refrescar la página
            });
        }else if(data.error === 'Documento existente en la BDD'){
            Swal.fire(
                'HEY! :(',
                'No fue posible crear pre_registro, documento existente en la BDD',
                'error'
              ) 
        }else{
            Swal.fire(
                'HEY! :(',
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