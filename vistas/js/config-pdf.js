
$("#btnguardar").click(function(){
    Swal.fire({
        icon: 'error',
        title: '¡Esta opción no está disponible en la versión Demo!',
        text: "Adquiere esta opción con uno de nuestros planes",
        confirmButtonText: 'Cerrar',
    }).then((result) => {
        if (result.isConfirmed) {

        } else if (result.isDenied) {
        }
    })

})

$(".BtnEditarPDF").click(function(){
    Swal.fire({
        icon: 'error',
        title: '¡Esta opción no está disponible en la versión Demo!',
        text: "Adquiere esta opción con uno de nuestros planes",
        confirmButtonText: 'Cerrar',
    }).then((result) => {
        if (result.isConfirmed) {

        } else if (result.isDenied) {
        }
    })


    $(".BtnEditarPDF").prop('checked',false);

})

$(".BtnEditarPDFClasic").click(function(){

    $(".BtnEditarPDFClasic").prop('checked',true);

})

