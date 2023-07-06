// Ejectura la funcion Generar pdf de ofertas
$("#btnExequial").click(function() {
    cotizarExequial();
  });

  let registro = 0;

async function cotizarExequial(){

    const txtNombre = document.getElementById('nombreTitular').value;
    const edadTitularID = document.getElementById('edadTitularID').value;
    const tipoPlanExequialID = document.getElementById('tipoPlanExequialID').value;

    if(txtNombre !== "" && edadTitularID !== "" && tipoPlanExequialID !== ""){

        if(edadTitularID >= 60 || edadTitularID <= 10){
          Swal.fire({
            icon: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
            title: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
            text: 'Usuario fuera del rango de edad permitido',
          }) 
        }else{
          registro++;
          const url = "extensiones/tcpdf/pdf/exequias.php?cotizacion=" + txtNombre + "&tipoPlan=" + tipoPlanExequialID;
            window.open(url, "_blank");
        }

    }else{
      Swal.fire({
        icon: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
        title: '<img src="vistas/img/plantilla/advertir.png" width="104" height="104">',
        text: 'Es necesario que llenes todos los campos',
      }) 
    }

}