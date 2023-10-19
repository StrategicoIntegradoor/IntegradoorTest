
  $("#DptoCirculacion").change(function () {
    consultarCiudad();
  });

      // // Carga la fecha de Nacimiento
      // $("#diaCirculacion, #mesCirculacion, #anioCirculacion").select2({
      //   theme: "bootstrap fecnacimiento",
      //   language: "es",
      //   width: "100%",
      //   minimumResultsForSearch: 0 // Desactiva la búsqueda
  
      // });

     // Carga las Ciudades disponibles
  $("#ciudadCirculacion").select2({
    theme: "bootstrap ciudad",
    language: "es",
    width: "100%",
    minimumResultsForSearch: 0 // Desactiva la búsqueda

  });
  
    // Carga los Departamentos disponibles
    $("#DptoCirculacion").select2({
      theme: "bootstrap dpto",
      language: "es",
      width: "100%",
      minimumResultsForSearch: 0 // Desactiva la búsqueda

    });

    $("#diaCirculacion").select2({
      theme: "bootstrap dia",
      language: "es",
      width: "100%",
      minimumResultsForSearch: 0 // Desactiva la búsqueda

    });

    $("#mesCirculacion").select2({
      theme: "bootstrap mes",
      language: "es",
      width: "100%",
      minimumResultsForSearch: 0 // Desactiva la búsqueda

    });

    $("#anioCirculacion").select2({
      theme: "bootstrap anio",
      language: "es",
      width: "100%",
      minimumResultsForSearch: 0 // Desactiva la búsqueda

    });


  function consultarCiudad() {
    var codigoDpto = document.getElementById("DptoCirculacion").value;

    $.ajax({
      type: "POST",
      url: "src/consultarCiudad.php",
      dataType: "json",
      data: { data: codigoDpto },
      cache: false,
      success: function (data) {
        // console.log(data);
        var ciudadesVeh = `<option value="">Seleccionar Ciudad</option>`;
  
        data.forEach(function (valor, i) {
          var valorNombre = valor.Nombre.split("-");
          var nombreMinusc = valorNombre[0].toLowerCase();
          var ciudad = nombreMinusc.replace(/^(.)|\s(.)/g, function ($1) {
            return $1.toUpperCase();
          });
  
          ciudadesVeh += `<option value="${valor.Codigo}">${ciudad}</option>`;
        });
        document.getElementById("ciudadCirculacion").innerHTML = ciudadesVeh;
      },
    });
  
    //}
  }

async function registerGuest(){

const clave_registro = document.getElementById('clave_registro').value;
const nombre = document.getElementById('nombre').value;
const apellido = document.getElementById('apellido').value;
const tipo_documento = document.getElementById('tipo_documento').value;
const identificacion = document.getElementById('identificacion').value;
const dia_nacimiento = document.getElementById('diaCirculacion').value;
const mes_nacimiento = document.getElementById('mesCirculacion').value;
const anio_nacimiento = document.getElementById('anioCirculacion').value;
const genero = document.getElementById('genero').value;
const direccion = document.getElementById('direccion').value;
const ciudad = document.getElementById('ciudadCirculacion').value;
// const telefono = document.getElementById('telefono').value;
const celular = document.getElementById('celular').value;
const correo_electronico = document.getElementById('correo_electronico').value;
const contrasena = document.getElementById('contrasena').value;
const confirmar_contrasena = document.getElementById('confirmar_contrasena').value;
const aceptoTermino = document.getElementById('acepto_termino').checked;

if (clave_registro !== '' &&
    nombre !== '' &&
    apellido !== '' &&
    tipo_documento !== '' &&
    identificacion !== '' &&
    dia_nacimiento !== '' &&
    mes_nacimiento !== '' &&
    anio_nacimiento !== '' &&
    genero !== '' &&
    direccion !== '' &&
    ciudad !== '' &&
    // telefono !== '' &&
    celular !== '' &&
    correo_electronico !== '' &&
    contrasena !== '' &&
    confirmar_contrasena !== '' &&
    aceptoTermino
    ) {
        var data = {
            clave: clave_registro,
            nombre: nombre,
            apellido: apellido,
            tipo: tipo_documento,
            identificacion: identificacion,
            dia_nacimiento: dia_nacimiento,
            mes_nacimiento: mes_nacimiento,
            anio_nacimiento: anio_nacimiento,
            genero: genero,
            direccion: direccion,
            ciudad: ciudad,
            // telefono: telefono,
            celular: celular,
            correo_electronico: correo_electronico,
            contrasena: contrasena,
            confirmar_contrasena: confirmar_contrasena,
            accion: 'verificarCodigo',
        };
        

        var options = {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        };

        var url = 'controladores/invitacion.controlador.php';

        fetch(url, options)
    .then(function(response) {
    if (response.ok) {
      return response.text();
        } else {
            throw new Error('Error en la solicitud, error de conexión');
        }
    })
    .then(function(data) {
        // console.log(data);
        data = JSON.parse(data);
    console.log(data);
        if(data.success === "Registro exitoso"){
            Swal.fire({
                icon: '<img src="vistas/img/plantilla/ofertas.png" width="84" height="84">',
                title: '<img src="vistas/img/plantilla/ofertas.png" width="84" height="84">',
                text: 'Bienvenido! nuevo usuario Freelance, registro completado exitosamente, ya puedes ingresar a la plataforma. Tu nombre de usuario es tu número de documento',
              });
              setTimeout(function() {
            Swal.close();
            window.location.href = 'https://integradoor.com/Test';
          }, 9000);
            //   .then(function() {
                // location.reload(); // Refrescar la página
            // });
        }else if(data.error === 'Clave incorrecta'){
            Swal.fire({
                icon: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
                title: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
                text: 'Clave de registro incorrecta, verifica si dejaste espacios y vuelve a intentar',
              }) 
        }else if(data.error === 'No se encuentra el usuario'){
             Swal.fire({
                icon: '<img src="vistas/img/plantilla/buscar.png" width="84" height="84">',
                title: '<img src="vistas/img/plantilla/buscar.png" width="84" height="84">',
                text: 'No fue posible crear el registro, el número de documento no corresponde al usuario invitado',
              });
        }else if(data.error === 'Fallo contrasenas'){
            Swal.fire({
                icon: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
                title: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
                text: 'Ocurrió un error, tus contraseñas no coinciden, por favor verifica la informacion',
              }) 
        }
        else{
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
            'Error de solicitud, no pudo crearse el Registro, comuniquese con servicio técnico',
            'error'
          )
        });
        
    } else {
        // Al menos uno de los campos está vacío
        console.error('Completa todos los campos para enviar el registro');
        Swal.fire(
        'Error',
        'Por favor llena todos los campos para completar el registro',
        'error'
        )
    }
  



}