async function authInfo() {
  

    const cedula = document.getElementById("cedula").value;
    const token = document.getElementById("token").value;
    const contraseñaN = document.getElementById("newPassword").value;
    const contraseñaNN = document.getElementById("autPassword").value;


    if(cedula !== "" && token !== "" && contraseñaN !== "" && contraseñaNN !== ""){

    var data = {
        cc: cedula,
        security: token,
        first: contraseñaN,
        last: contraseñaNN,
        accion: "verificarToken",
    };

      // Opciones de configuración de la solicitud
    var options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };
      
      // URL del controlador PHP
      var url = 'controladores/contrasena.controlador.php';
    //   C:\xampp\htdocs\repositorio\demoIntegradoor\controladores\contraseña.controlador.php
     
      // Enviar la solicitud utilizando fetch()
      fetch(url, options)
      .then(function(response) {
      if (response.ok) {
        return response.text();
        //  return response Si la respuesta es exitosa, devolver los datos como texto
          } else {
              throw new Error('Error en la solicitud, error de conexión');
          }
      })
      .then(function(data) {
        console.log(data);
        var jsonData =  JSON.parse(data);
        if(jsonData.error === 'No se encuentra el documento!'){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Documento de identidad no encontrado',
                footer: 'Comunicate con servicio técnico para mayor información'
              })
            console.error('No se ha encontrado usuario con ese numero de documento, verifique información'); 
            return;   
        } else if(jsonData.error === 'No coinciden las contraseñas') {
            Swal.fire(
                'HEY! :(',
                'Las contraseñas no coinciden',
                'error'
              )
            console.error('No coinciden las claves');
            return;
        }else if(jsonData.error === 'No coincide el token de seguridad') {
            Swal.fire(
                'HEY! :(',
                'Token incorrecto, verifica o vuelva e empezar el proceso',
                'error'
              )
          console.error('Token de seguridad incorrecto');
          return;
      }
        else if(jsonData.success === 'OK'){
          Swal.fire(
            'Good job!',
            'Contraseña cambiada exitosamente',
            'success'
          )
          setTimeout(function() {
            Swal.close();
            window.location.href = 'https://integradoor.com/appPruebasDemo3/';
          }, 4000);
        }   
      })

      .catch(function(error) {
      // // Manejar los errores de la solicitud
      console.log(error);
      });
  }else{       
      console.error('Completa todos los campos para completar el cambio de constraseña');
      Swal.fire(
        'HEY! :(',
        'Por favor llena todos los campos',
        'error'
      )
  }

}

