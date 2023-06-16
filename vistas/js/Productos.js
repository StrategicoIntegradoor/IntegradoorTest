(()=>{
    comprobar_Aseguradoras()
})()

//Treaer información del producto seleccionado
$("#editarProducto").click(function(){
    producto = $("#Producto_id").val()

    $.ajax({
        url: "src/productos/ConsultaInfoProducto.php",
        method: "POST",
        data: {producto},
        success: function (data) {

            data = JSON.parse(data)

            $("#RCE").val(data["rce"]);

            $("#Deducible").val(data["deducible"]);

            let pth1 = data["pth"].split(' ');
            let pth = pth1['0'];
            if(pth != 'No'){
                $("#ptdhSi").prop('checked', true)
                $("#ptdhDesc").val(data["pth"])
            }else{
                $("#ptdhNo").prop('checked', true)
                $("#ptdhDesc").val("")
            }

            let ppd1 = data["ppd"].split(' ');
            let ppd = ppd1['0'];
            if(ppd != 'No'){
                $("#ppdSi").prop('checked', true)
                $("#ppdDesc").val(data["ppd"])
            }else{
                $("#ppdNo").prop('checked', true)
                $("#ppdDesc").val("")
            }

            let pph1 = data["pph"].split(' ');
            let pph = pph1['0'];
            if(pph != 'No'){
                $("#pphSi").prop('checked', true)
                $("#pphDesc").val(data["pph"])
            }else{
                $("#pphNo").prop('checked', true)
                $("#pphDesc").val("")
            }

            let eventos1 = data["eventos"].split(' ');
            let eventos = eventos1['0'];
            if(eventos != 'No'){
                $("#eventosSi").prop('checked', true)
                $("#eventosDesc").val(data["eventos"])
            }else{
                $("#eventosNo").prop('checked', true)
                $("#eventosDesc").val("")
            }

            let amparopatrimonial1 = data["amparopatrimonial"].split(' ');
            let amparopatrimonial = amparopatrimonial1['0'];
            if(amparopatrimonial != 'No'){
                $("#amparopatrimonialSi").prop('checked', true)
                let extraida = data["amparopatrimonial"].substr(9, 100);
                $("#amparopatrimonialDesc").val(extraida)
            }else{
                $("#amparopatrimonialNo").prop('checked', true)
                $("#amparopatrimonialDesc").val("")
            }

            let Grua1 = data["Grua"].split(' ');
            let Grua = Grua1['0'];
            if(Grua != 'No'){
                $("#GruaSi").prop('checked', true)
                let extraida = data["Grua"].substr(9, 100);
                $("#GruaDesc").val(extraida)
            }else{
                $("#GruaNo").prop('checked', true)
                $("#GruaDesc").val("")
            }

            let Carrotaller1 = data["Carrotaller"].split(' ');
            let Carrotaller = Carrotaller1['0'];
            if(Carrotaller != 'No'){
                $("#CarrotallerSi").prop('checked', true)
                let extraida = data["Carrotaller"].substr(9, 100);
                $("#CarrotallerDesc").val(extraida)
            }else{
                $("#CarrotallerNo").prop('checked', true)
                $("#CarrotallerDesc").val("")
            }

            let Asistenciajuridica1 = data["Asistenciajuridica"].split(' ');
            let Asistenciajuridica = Asistenciajuridica1['0'];
            if(Asistenciajuridica != 'No'){
                $("#AsistenciajuridicaSi").prop('checked', true)
                let extraida = data["Asistenciajuridica"].substr(9, 100);
                $("#AsistenciajuridicaDesc").val(extraida)
            }else{
                $("#AsistenciajuridicaNo").prop('checked', true)
                $("#AsistenciajuridicaDesc").val("")
            }
            
            let Gastosdetransportept1 = data["Gastosdetransportept"].split(' ');
            let Gastosdetransportept = Gastosdetransportept1['0'];
            if(Gastosdetransportept != 'No'){
                $("#GastosdetransporteptSi").prop('checked', true)
                let extraida = data["Gastosdetransportept"].substr(9, 100);
                $("#GastosdetransporteptDesc").val(extraida)
            }else{
                $("#GastosdetransporteptNo").prop('checked', true)
                $("#GastosdetransporteptDesc").val("")
            }

            let Gastosdetransportepp1 = data["Gastosdetransportepp"].split(' ');
            let Gastosdetransportepp = Gastosdetransportepp1['0'];
            if(Gastosdetransportepp != 'No'){
                $("#GastosdetransporteppSi").prop('checked', true)
                let extraida = data["Gastosdetransportepp"].substr(9, 100);
                $("#GastosdetransporteppDesc").val(extraida)
            }else{
                $("#GastosdetransporteppNo").prop('checked', true)
                $("#GastosdetransporteppDesc").val("")
            }

            let Vehiculoreemplazopt1 = data["Vehiculoreemplazopt"].split(' ');
            let Vehiculoreemplazopt = Vehiculoreemplazopt1['0'];
            if(Vehiculoreemplazopt != 'No'){
                $("#VehiculoreemplazoptSi").prop('checked', true)
                let extraida = data["Vehiculoreemplazopt"].substr(9, 100);
                $("#VehiculoreemplazoptDesc").val(extraida)
            }else{
                $("#VehiculoreemplazoptNo").prop('checked', true)
                $("#VehiculoreemplazoptDesc").val("")
            }

            let Vehiculoreemplazopp1 = data["Vehiculoreemplazopp"].split(' ');
            let Vehiculoreemplazopp = Vehiculoreemplazopp1['0'];
            if(Vehiculoreemplazopp != 'No'){
                $("#VehiculoreemplazoppSi").prop('checked', true)
                let extraida = data["Vehiculoreemplazopp"].substr(9, 100);
                $("#VehiculoreemplazoppDesc").val(extraida)
            }else{
                $("#VehiculoreemplazoppNo").prop('checked', true)
                $("#VehiculoreemplazoppDesc").val("")
            }

            let Conductorelegido1 = data["Conductorelegido"].split(' ');
            let Conductorelegido = Conductorelegido1['0'];
            if(Conductorelegido != 'No'){
                $("#ConductorelegidoSi").prop('checked', true)
                let extraida = data["Conductorelegido"].substr(9, 100);
                $("#ConductorelegidoDesc").val(extraida)
            }else{
                $("#ConductorelegidoNo").prop('checked', true)
                $("#ConductorelegidoDesc").val("")
            }

            let Transportevehiculorecuperdo1 = data["Transportevehiculorecuperdo"].split(' ');
            let Transportevehiculorecuperdo = Transportevehiculorecuperdo1['0'];
            if(Transportevehiculorecuperdo != 'No'){
                $("#TransportevehiculorecuperdoSi").prop('checked', true)
                let extraida = data["Transportevehiculorecuperdo"].substr(9, 100);
                $("#TransportevehiculorecuperdoDesc").val(extraida)
            }else{
                $("#TransportevehiculorecuperdoNo").prop('checked', true)
                $("#TransportevehiculorecuperdoDesc").val("")
            }

            let Transportepasajerosaccidente1 = data["Transportepasajerosaccidente"].split(' ');
            let Transportepasajerosaccidente = Transportepasajerosaccidente1['0'];
            if(Transportepasajerosaccidente != 'No'){
                $("#TransportepasajerosaccidenteSi").prop('checked', true)
                let extraida = data["Transportepasajerosaccidente"].substr(9, 100);
                $("#TransportepasajerosaccidenteDesc").val(extraida)
            }else{
                $("#TransportepasajerosaccidenteNo").prop('checked', true)
                $("#TransportepasajerosaccidenteDesc").val("")
            }

            let Transportepasajerosvarada1 = data["Transportepasajerosvarada"].split(' ');
            let Transportepasajerosvarada = Transportepasajerosvarada1['0'];
            if(Transportepasajerosvarada != 'No'){
                $("#TransportepasajerosvaradaSi").prop('checked', true)
                let extraida = data["Transportepasajerosvarada"].substr(9, 100);
                $("#TransportepasajerosvaradaDesc").val(extraida)
            }else{
                $("#TransportepasajerosvaradaNo").prop('checked', true)
                $("#TransportepasajerosvaradaDesc").val("")
            }

            let Accidentespersonales1 = data["Accidentespersonales"].split(' ');
            let Accidentespersonales = Accidentespersonales1['0'];
            if(Accidentespersonales != 'No'){
                $("#AccidentespersonalesSi").prop('checked', true)
                let extraida = data["Accidentespersonales"].substr(9, 100);
                $("#AccidentespersonalesDesc").val(extraida)
            }else{
                $("#AccidentespersonalesNo").prop('checked', true)
                $("#AccidentespersonalesDesc").val("")
            }

            let Pequeniosaccesorios1 = data["Pequeniosaccesorios"].split(' ');
            let Pequeniosaccesorios = Pequeniosaccesorios1['0'];
            if(Pequeniosaccesorios != 'No'){
                $("#PequeniosaccesoriosSi").prop('checked', true)
                let extraida = data["Pequeniosaccesorios"].substr(9, 100);
                $("#PequeniosaccesoriosDesc").val(extraida)
            }else{
                $("#PequeniosaccesoriosNo").prop('checked', true)
                $("#PequeniosaccesoriosDesc").val("")
            }

            let Llantasestalladas1 = data["Llantasestalladas"].split(' ');
            let Llantasestalladas = Llantasestalladas1['0'];
            if(Llantasestalladas != 'No'){
                $("#LlantasestalladasSi").prop('checked', true)
                let extraida = data["Llantasestalladas"].substr(9, 100);
                $("#LlantasestalladasDesc").val(extraida)
            }else{
                $("#LlantasestalladasNo").prop('checked', true)
                $("#LlantasestalladasDesc").val("")
            }

            let Perdidallaves1 = data["Perdidallaves"].split(' ');
            let Perdidallaves = Perdidallaves1['0'];
            if(Perdidallaves != 'No'){
                $("#PerdidallavesSi").prop('checked', true)
                let extraida = data["Perdidallaves"].substr(9, 100);
                $("#PerdidallavesDesc").val(extraida)
            }else{
                $("#PerdidallavesNo").prop('checked', true)
                $("#PerdidallavesDesc").val("")
            }

            $( "#BtnEditarProducto" ).prop( "disabled", false );

        }
    });
})


//Traer productos de la aseguradora aliada

$("#Aseguradora").change(function (){


    Aseguradora = $("#Aseguradora").val()


    $.ajax({
        url: "src/productos/ConsultaProduc.php",
        method: "POST",
        data: {Aseguradora},
        success: function (data) {

            $("#Producto_id").html(data);

        }
    });
})


//Traer Aseguradoras aliadas
function comprobar_Aseguradoras(){
    $.ajax({
        url: "src/productos/ConsultarAseProductos.php",
        method: "POST",
        success: function (data) {

            $("#Aseguradora").html(data);

        }
    });
}


//Actualizar producto

$("#BtnEditarProducto").click(function(){

    let producto = $("#Producto_id").val()
    let RCE = $("#RCE").val();
    let Deducible = $("#Deducible").val();
    let ptdh = ""
    let ppd = ""
    let pph = ""
    let eventos = ""
    let amparopatrimonial = ""
    let Grua = ""
    let Carrotaller = ""
    let Asistenciajuridica = ""
    let Gastosdetransportept = ""
    let Gastosdetransportepp = ""
    let Vehiculoreemplazopt = ""
    let Vehiculoreemplazopp = ""
    let Conductorelegido = ""
    let Transportevehiculorecuperdo = ""
    let Transportepasajerosaccidente = ""
    let Transportepasajerosvarada = ""
    let Accidentespersonales = ""
    let Pequeniosaccesorios = ""
    let Llantasestalladas = ""
    let Perdidallaves = ""

    //Comprobar si los checks estan en si o no;

    if($('#ptdhSi').is(':checked')){
        ptdh = $('#ptdhDesc').val()
    }else{
        ptdh = "No ampara"
    }

    if($('#ppdSi').is(':checked')){
        ppd  = $("#ppdDesc").val()
    }else{
        ppd = "No ampara"
        
    }

    if($('#pphSi').is(':checked')){
        pph = $("#pphDesc").val()
    }else{
        pph = "No ampara"
    }

    if($('#eventosSi').is(':checked')){
        eventos = $("#eventosDesc").val()
    }else{
        eventos = "No ampara"
    }

    if($('#amparopatrimonialSi').is(':checked')){
        amparopatrimonial = "Si ampara"
        amparopatrimonial += $('#amparopatrimonialDesc').val()
    }else{
        amparopatrimonial = "No ampara"
    }

    if($('#GruaSi').is(':checked')){
        Grua = "Si ampara "
        Grua += $('#GruaDesc').val()
    }else{
        Grua = "No ampara"
    }

    if($('#CarrotallerSi').is(':checked')){
        Carrotaller = "Si ampara "
        Carrotaller += $('#CarrotallerDesc').val()
    }else{
        Carrotaller = "No ampara"
    }

    if($('#AsistenciajuridicaSi').is(':checked')){
        Asistenciajuridica = "Si ampara "
        Asistenciajuridica += $('#AsistenciajuridicaDesc').val()
    }else{
        Asistenciajuridica = "No ampara"
    }
    
    if($('#GastosdetransporteptSi').is(':checked')){
        Gastosdetransportept = "Si ampara "
        Gastosdetransportept += $('#GastosdetransporteptDesc').val()
    }else{
        Gastosdetransportept = "No ampara"
    }

    if($('#GastosdetransporteppSi').is(':checked')){
        Gastosdetransportepp = "Si ampara "
        Gastosdetransportepp += $('#GastosdetransporteppDesc').val()
    }else{
        Gastosdetransportepp = "No ampara"
    }

    if($('#VehiculoreemplazoptSi').is(':checked')){
        Vehiculoreemplazopt = "Si ampara "
        Vehiculoreemplazopt += $('#VehiculoreemplazoptDesc').val()
    }else{
        Vehiculoreemplazopt = "No ampara"
    }

    if($('#VehiculoreemplazoppSi').is(':checked')){
        Vehiculoreemplazopp = "Si ampara "
        Vehiculoreemplazopp += $('#VehiculoreemplazoppDesc').val()
    }else{
        Vehiculoreemplazopp = "No ampara"
    }

    if($('#ConductorelegidoSi').is(':checked')){
        Conductorelegido = "Si ampara "
        Conductorelegido += $('#ConductorelegidoDesc').val()
    }else{
        Conductorelegido = "No ampara"
    }

    if($('#TransportevehiculorecuperdoSi').is(':checked')){
        Transportevehiculorecuperdo = "Si ampara "
        Transportevehiculorecuperdo += $('#TransportevehiculorecuperdoDesc').val()
    }else{
        Transportevehiculorecuperdo = "No ampara"
    }

    if($('#TransportepasajerosaccidenteSi').is(':checked')){
        Transportepasajerosaccidente = "Si ampara "
        Transportepasajerosaccidente += $("#TransportepasajerosaccidenteDesc").val()
    }else{
        Transportepasajerosaccidente = "No ampara"
    }

    if($('#TransportepasajerosvaradaSi').is(':checked')){
        Transportepasajerosvarada = "Si ampara "
        Transportepasajerosvarada += $('#TransportepasajerosvaradaDesc').val()
    }else{
        Transportepasajerosvarada = "No ampara"
    }

    if($('#AccidentespersonalesSi').is(':checked')){
        Accidentespersonales = "Si ampara "
        Accidentespersonales += $('#AccidentespersonalesDesc').val()
    }else{
        Accidentespersonales = "No ampara"
    }

    if($('#PequeniosaccesoriosSi').is(':checked')){
        Pequeniosaccesorios = "Si ampara "
        Pequeniosaccesorios += $('#PequeniosaccesoriosDesc').val()
    }else{
        Pequeniosaccesorios = "No ampara"
    }

    if($('#LlantasestalladasSi').is(':checked')){
        Llantasestalladas = "Si ampara "
        Llantasestalladas += $('#LlantasestalladasDesc').val()
    }else{
        Llantasestalladas = "No ampara"
    }

    if($('#PerdidallavesSi').is(':checked')){
        Perdidallaves = "Si ampara "
        Perdidallaves += $('#PerdidallavesDesc').val()
    }else{
        Perdidallaves = "No ampara"
    }


    $.ajax({
        url: "src/productos/ActualizarProduc.php",
        method: "POST",
        data: {producto:producto,
        RCE: RCE,
         Deducible: Deducible,
         ptdh: ptdh,
         ppd: ppd,
         pph: pph,
         eventos: eventos,
         amparopatrimonial: amparopatrimonial,
         Grua: Grua,
         Carrotaller: Carrotaller,
         Asistenciajuridica:Asistenciajuridica,
         Gastosdetransportept: Gastosdetransportept,
         Gastosdetransportepp: Gastosdetransportepp,
         Vehiculoreemplazopt: Vehiculoreemplazopt,
         Vehiculoreemplazopp: Vehiculoreemplazopp,
         Conductorelegido: Conductorelegido,
         Transportevehiculorecuperdo: Transportevehiculorecuperdo,
         Transportepasajerosaccidente: Transportepasajerosaccidente,
         Transportepasajerosvarada: Transportepasajerosvarada,
         Accidentespersonales: Accidentespersonales,
         Pequeniosaccesorios: Pequeniosaccesorios,
         Llantasestalladas: Llantasestalladas,
         Perdidallaves: Perdidallaves},
        success: function (data) {

            if(data == "ok"){
                Swal.fire({
                    icon: 'success',
                    text: '¡Producto  actualizado con exito!'
                  })


                  setTimeout(function(){
                    window.location = "Productos";
                }, 4000);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '¡No pudimos actualizar el producto!'
                  })
            }

        }
    });


    




})

//Validar cambios en check para bloquear o desbloquear


    

$("#ptdhSi").change(function (){
    $( "#ptdhDesc" ).prop( "disabled", false );
})
 
$("#ptdhNo").change(function (){
    $( "#ptdhDesc" ).prop( "disabled", true );
    $( "#ptdhDesc" ).val("");
})

$("#ppdSi").change(function (){
    $( "#ppdDesc" ).prop( "disabled", false );
})
$("#ppdNo").change(function (){
    $( "#ppdDesc" ).prop( "disabled", true );
    $( "#ppdDesc" ).valp("");
})   

$("#pphSi").change(function (){
    $( "#pphDesc" ).prop( "disabled", false );
})
$("#pphNo").change(function (){
    $( "#pphDesc" ).prop( "disabled", true );
    $( "#pphDesc" ).val("");
})   

$("#eventosSi").change(function (){
    $( "#eventosDesc" ).prop( "disabled", false );
})
$("#eventosNo").change(function (){
    $( "#eventosDesc" ).prop( "disabled", true );
    $( "#eventosDesc" ).val("");
})   

$("#amparopatrimonialSi").change(function (){
    $( "#amparopatrimonialDesc" ).prop( "disabled", false );
})
$("#amparopatrimonialNo").change(function (){
    $( "#amparopatrimonialDesc" ).prop( "disabled", true );
    $( "#amparopatrimonialDesc" ).val("");
})   

$("#GruaSi").change(function (){
    $( "#GruaDesc" ).prop( "disabled", false );
})
$("#GruaNo").change(function (){
    $( "#GruaDesc" ).prop( "disabled", true );
    $( "#GruaDesc" ).val("");
})   

$("#CarrotallerSi").change(function (){
    $( "#CarrotallerDesc" ).prop( "disabled", false );
})
$("#CarrotallerNo").change(function (){
    $( "#CarrotallerDesc" ).prop( "disabled", true );
    $( "#CarrotallerDesc" ).val("");
})   

$("#AsistenciajuridicaSi").change(function (){
    $( "#AsistenciajuridicaDesc" ).prop( "disabled", false );
})
$("#AsistenciajuridicaNo").change(function (){
    $( "#AsistenciajuridicaDesc" ).prop( "disabled", true );
    $( "#AsistenciajuridicaDesc" ).val("");
})   

$("#GastosdetransporteptSi").change(function (){
    $( "#GastosdetransporteptDesc" ).prop( "disabled", false );
})
$("#GastosdetransporteptNo").change(function (){
    $( "#GastosdetransporteptDesc" ).prop( "disabled", true );
    $( "#GastosdetransporteptDesc" ).val("");
})    

$("#GastosdetransporteppSi").change(function (){
    $( "#GastosdetransporteppDesc" ).prop( "disabled", false );
})
$("#GastosdetransporteppNo").change(function (){
    $( "#GastosdetransporteppDesc" ).prop( "disabled", true );
    $( "#GastosdetransporteppDesc" ).val("");
})   

$("#VehiculoreemplazoptSi").change(function (){
    $( "#VehiculoreemplazoptDesc" ).prop( "disabled", false );
})
$("#VehiculoreemplazoptNo").change(function (){
    $( "#VehiculoreemplazoptDesc" ).prop( "disabled", true );
    $( "#VehiculoreemplazoptDesc" ).val("");
})   

$("#VehiculoreemplazoppSi").change(function (){
    $( "#VehiculoreemplazoppDesc" ).prop( "disabled", false );
})
$("#VehiculoreemplazoppNo").change(function (){
    $( "#VehiculoreemplazoppDesc" ).prop( "disabled", true );
    $( "#VehiculoreemplazoppDesc" ).val("");
})   

$("#ConductorelegidoSi").change(function (){
    $( "#ConductorelegidoDesc" ).prop( "disabled", false );
})
$("#ConductorelegidoNo").change(function (){
    $( "#ConductorelegidoDesc" ).prop( "disabled", true );
    $( "#ConductorelegidoDesc" ).val("");
})   

$("#TransportevehiculorecuperdoSi").change(function (){
    $( "#TransportevehiculorecuperdoDesc" ).prop( "disabled", false );
})
$("#TransportevehiculorecuperdoNo").change(function (){
    $( "#TransportevehiculorecuperdoDesc" ).prop( "disabled", true );
    $( "#TransportevehiculorecuperdoDesc" ).val("");
})   

$("#TransportepasajerosaccidenteSi").change(function (){
    $( "#TransportepasajerosaccidenteDesc" ).prop( "disabled", false );
})
$("#TransportepasajerosaccidenteNo").change(function (){
    $( "#TransportepasajerosaccidenteDesc" ).prop( "disabled", true );
    $( "#TransportepasajerosaccidenteDesc" ).val("");
})    

$("#TransportepasajerosvaradaSi").change(function (){
    $( "#TransportepasajerosvaradaDesc" ).prop( "disabled", false );
})
$("#TransportepasajerosvaradaNo").change(function (){
    $( "#TransportepasajerosvaradaDesc" ).prop( "disabled", true );
    $( "#TransportepasajerosvaradaDesc" ).val("");
})   

$("#AccidentespersonalesSi").change(function (){
    $( "#AccidentespersonalesDesc" ).prop( "disabled", false );
})
$("#AccidentespersonalesNo").change(function (){
    $( "#AccidentespersonalesDesc" ).prop( "disabled", true );
    $( "#AccidentespersonalesDesc" ).val("");
})   

$("#PequeniosaccesoriosSi").change(function (){
    $( "#PequeniosaccesoriosDesc" ).prop( "disabled", false );
})
$("#PequeniosaccesoriosNo").change(function (){
    $( "#PequeniosaccesoriosDesc" ).prop( "disabled", true );
    $( "#PequeniosaccesoriosDesc" ).val("");
})  

$("#PerdidallavesSiPerdidallavesSiPerdidallavesSi").change(function (){
    $( "#PerdidallavesSiPerdidallavesSiPerdidallavesDesc" ).prop( "disabled", false );
})
$("#PerdidallavesSiPerdidallavesSiPerdidallavesNo").change(function (){
    $( "#PerdidallavesSiPerdidallavesSiPerdidallavesDesc" ).prop( "disabled", true );
    $( "#PerdidallavesSiPerdidallavesSiPerdidallavesDesc" ).val("");
})   

$("#PerdidallavesSi").change(function (){
    $( "#PerdidallavesDesc" ).prop( "disabled", false );
})
$("#PerdidallavesNo").change(function (){
    $( "#PerdidallavesDesc" ).prop( "disabled", true );
    $( "#PerdidallavesDesc" ).val("");
})