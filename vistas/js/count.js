const getTime = dateTo => {
    let now = new Date(),
        time = (new Date(dateTo) - now + 1000) / 1000,
        seconds = ('0' + Math.floor(time % 60)).slice(-2),
        minutes = ('0' + Math.floor(time / 60 % 60)).slice(-2),
        hours = ('0' + Math.floor(time / 3600 % 24)).slice(-2),
        days = Math.floor(time / (3600 * 24));

    return {
        seconds,
        minutes,
        hours,
        days,
        time
    }
};

const countdown = (dateTo, element, rol) => {

    if(rol == 2){
        const item = document.getElementById(element);

        const timerUpdate = setInterval( () => {
            let currenTime = getTime(dateTo);
            if(currenTime.hours != 'aN'){

                
                

                if (currenTime.time <= 1) {
                    clearInterval(timerUpdate);

                    Swal.fire({
                        icon: 'error',
                        title: '!Tu tiempo de uso se agoto!.',
                        confirmButtonText: 'Ok',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "salir";
                        } else if (result.isDenied) {
                        }


                    })


                    setTimeout(function(){
                        window.location = "salir";
                    }, 10000);
                }else{
                    item.innerHTML =  currenTime.days + "D " + currenTime.hours +  'H ' + currenTime.minutes + 'M ' + currenTime.seconds + 'S';
                }
            }else{

            }

        }, 1000);
    }else{
        console.log("No hice nada")
    }
};

let fecha = $("#fechaLimi").val();
let fecha_fin = Date.parse(fecha);  
let rol = $("#rolId").val();



countdown(fecha_fin, 'cuentatras', rol);







const mostrarCotRestantes = ()=>{
    fecha1 = new Date;
    fecha2 = fecha1.toLocaleDateString();
    fecha3 = fecha2.split("/");
    fecha = fecha3[2] + "-" + fecha3[1] + "-" + fecha3[0];
  
  
    $.ajax({
  
      url: "ajax/compararFecha.php",
      method: "POST",
      data: { fecha },
      success: function (respuesta) {
        $p=document.getElementById("cotRestantes");
          $p.innerHTML = respuesta;
      
      }
    })
  
}

mostrarCotRestantes();