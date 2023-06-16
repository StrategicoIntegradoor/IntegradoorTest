async function authEmail() {

    const email = document.getElementById("email").value;

    if(email !== ''){
    var data = {
        correo: email,
        accion: "enviarCorreo",
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

        const loader = document.getElementById("loader");
        loader.style.display = "block";
     
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
      var jsonData = JSON.parse(data);
        // Manipular los datos de la respuesta
      if (jsonData.error === 'Busqueda no encontrada') {
        // Mostrar aviso de "correo no encontrado" en la vista
        loader.style.display = "none";
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Correo no registrado',
          footer: 'Comunicate con servicio técnico para mayor información'
        })
        setTimeout(function() {
          Swal.close();
        }, 3000);
      } else {
        loader.style.display = "none";
        // Manipular los datos de la respuesta si no hay error
        Swal.fire(
          'Solicitud procesada',
          'Se han enviado las instrucciones a tu correo',
          'success'
        )
        setTimeout(function() {
          Swal.close();
          location.reload();
        }, 3000);
      }
      })
      .catch(function(error) {
      // // Manejar los errores de la solicitud
      console.log(error);
      });
  }else{
    
    Swal.fire(
        'HEY! :(',
        'Por favor llena todos los campos',
        'error'
      )
    console.error('El campo del correo electrónico no fue completado');
  }

}