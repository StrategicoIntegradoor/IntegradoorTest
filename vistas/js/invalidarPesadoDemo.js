(()=>{
    Swal.fire({
        icon: 'error',
        title: '¡Esta opción no está disponible en la versión Demo!',
        confirmButtonText: 'Cerrar',
      }).then((result) => {
        if (result.isConfirmed) {
            window.location = "inicio";
        } else if (result.isDenied) {
        }
      })

     
})()


setTimeout(function(){
    window.location = "inicio";
}, 10000);