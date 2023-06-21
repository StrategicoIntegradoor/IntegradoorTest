
async function registerGuest(){

const clave_registro = document.getElementById('clave_registro').value;
const nombre = document.getElementById('nombre').value;
const apellido = document.getElementById('apellido').value;
// const tipo_documento = document.getElementById('tipo_documento').value;
const identificacion = document.getElementById('identificacion').value;
const dia_nacimiento = document.getElementById('dia_nacimiento').value;
const mes_nacimiento = document.getElementById('mes_nacimiento').value;
const anio_nacimiento = document.getElementById('anio_nacimiento').value;
const genero = document.getElementById('genero').value;
const direccion = document.getElementById('direccion').value;
// const ciudad = document.getElementById('ciudad').value;
const telefono = document.getElementById('telefono').value;
const celular = document.getElementById('celular').value;
const correo_electronico = document.getElementById('correo_electronico').value;
const contrasena = document.getElementById('contrasena').value;
const confirmar_contrasena = document.getElementById('confirmar_contrasena').value;
const aceptoTermino = document.getElementById('acepto_termino').checked;

if (clave_registro !== '' &&
    nombre !== '' &&
    apellido !== '' &&
    // tipo_documento !== '' &&
    identificacion !== '' &&
    dia_nacimiento !== '' &&
    mes_nacimiento !== '' &&
    anio_nacimiento !== '' &&
    genero !== '' &&
    direccion !== '' &&
    // ciudad !== '' &&
    telefono !== '' &&
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
            // tipo: tipo_documento,
            identificacion: identificacion,
            dia_nacimiento: dia_nacimiento,
            mes_nacimiento: mes_nacimiento,
            anio_nacimiento: anio_nacimiento,
            genero: genero,
            direccion: direccion,
            // ciudad: ciudad,
            telefono: telefono,
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
        console.log(data);
        data = JSON.parse(data);

        if(data.success === "Registro exitoso"){
            Swal.fire(
                'Good job!',
                'Registro realizado exitosamente',
                'success'
              )
            //   .then(function() {
                // location.reload(); // Refrescar la página
            // });
        }else if(data.error === 'No se encuentra clave de seguridad'){
            Swal.fire(
                'HEY! :(',
                'No fue posible crear registro, clave de seguridad incorrecta',
                'error'
              ) 
        }else if(data.error === 'No se encuentra el usuario'){
            Swal.fire(
                'HEY! :(',
                'No fue posible crear registro, usuario sin pre_registro',
                'error'
              ) 
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