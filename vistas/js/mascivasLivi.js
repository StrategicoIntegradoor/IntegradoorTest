$("#BtnCotizMasiva").click(function(){
    $("#msgCotizando").show();

    var documento = document.getElementById("ArchivoCotMAs").files[0];

    var archivo = $("#ArchivoCotMAs").val();
    var extensiones = archivo.substring(archivo.lastIndexOf("."));

    if(extensiones != ".csv"){
        swal.fire({
            type: "error",
            title: "¡El archivo tiene que estar en formato csv!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
          });
    }else{

        var formData = new FormData();
        formData.append("documento", documento);

        $.ajax({
            url: "src/Masivas/cargarCotMasivas.php",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data  == "error cantidad"){
                    swal.fire({
                        type: "error",
                        title: "¡El maximo de cotizaciones permitidas es 50!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                    });
                }
            }
        });

    }
})