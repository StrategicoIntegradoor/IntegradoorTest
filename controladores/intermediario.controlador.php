<?php

mb_internal_encoding("UTF-8");

require_once("../modelos/intermediario.modelo.php");


Switch ($_GET['function']){
    //funcion para cargar la informacion del intermediario
    case "traerCrede":
        if(isset($_POST['menu'])){

            $modelo = ModeloInternediario::mostrarCredenciales('S');

            print_r(json_encode($modelo));

        }else if(isset($_POST['id'])){

            $modelo = ModeloInternediario::mostrarCredenciales($_POST['id']);

            print_r(json_encode($modelo));
            
        }else{

            $modelo = ModeloInternediario::mostrarCredenciales('N');

            $resp = $modelo[0];

            print_r(json_encode($resp));
        }

    break;



    //funcion para guardar credenciales de allianz
    case "guardarallianz":

        $modelo = ModeloInternediario::guardarAlli($_POST['contra'], $_POST['part'], $_POST['idAge'], $_POST['codPat'], $_POST['codAge']);

        echo $modelo;

    break;


    //funcion para guardar credenciales bolivar
    case "guardarvoli":
        $modelo = ModeloInternediario::guardarBoli($_POST['apikey'], $_POST['clave']);

        echo $modelo; 

    break;

    //funcion para guardar credenciales equidad
    case "guardarequi":

        $modelo = ModeloInternediario::guardarEqui($_POST['usu'], $_POST['contra'] , $_POST['sucur']);

        echo $modelo; 

    break;

    //funcion para guardar credenciales solidaria
    case "guardarsoli":
        $modelo = ModeloInternediario::guardarSoli($_POST['sucur'], $_POST['codPer'] , $_POST['tipAge'], $_POST['codAge'] , $_POST['PunVen'], $_POST['grantTy'], $_POST['cookie']);

        echo $modelo;  

    break;

    //funcion para guardar credencialesliberty
    case "guardarliber":
        $modelo = ModeloInternediario::guardarLibe($_POST['cookTo'], $_POST['cookRe'] , $_POST['auto'], $_POST['codAge'] , $_POST['apliCli'], $_POST['ip'], $_POST['idReq'], $_POST['terminal']);

        echo $modelo; 

        
    break;

    //funcion para guardar credenciales estado
    case "guardarest":
        $modelo = ModeloInternediario::guardarEst($_POST['usu'], $_POST['contra']);

        echo $modelo;

    break;

    //funcion para guardar credenciales axa
    case "guardaraxa":
        $modelo = ModeloInternediario::guardaraxa($_POST['contra'], $_POST['codDis'], $_POST['tipDis'], $_POST['codCiu'], $_POST['canal'], $_POST['valEve']);

        echo $modelo; 

    break;

    //funcion para guardar credenciales hdi
    case "guardarhdi":
        $modelo = ModeloInternediario::guardarhdi($_POST['codSucu'], $_POST['codAge'], $_POST['usu'], $_POST['contra']);

        echo $modelo; 

    break;

    //funcion para guardar credenciales sbs
    case "guardarsbs":
        $modelo = ModeloInternediario::guardarsbs($_POST['usu'], $_POST['contra']);

        echo $modelo; 
    break;

    //Funcion para actualizar los intermediarios
    case "actualizarInter":

        if(isset($_FILES["img"])){
            move_uploaded_file($_FILES["img"]['tmp_name'], '../vistas/img/logosIntermediario/' . $_FILES["img"]['name']);

            $modelo = ModeloInternediario::editarInter($_POST['tipodocumento'], $_POST['correo'], $_POST['identiInt'], $_POST['direccion'], $_POST['razonSO'], $_POST['ciudad'], $_POST['nomRepre'], $_POST['indentiRepre'], $_POST['comConta'], $_POST['cel'], $_POST['alli'], $_POST['boli'], $_POST['equi'], $_POST['mapfre'], $_POST['previ'], $_POST['soli'], $_POST['libe'], $_POST['est'], $_POST['axa'], $_POST['hdi'], $_POST['sbs'], $_POST['zuri'], $_POST['vig_register'], $_FILES['img']['name']);
        }else{
            $modelo = ModeloInternediario::editarInter($_POST['tipodocumento'], $_POST['correo'], $_POST['identiInt'], $_POST['direccion'], $_POST['razonSO'], $_POST['ciudad'], $_POST['nomRepre'], $_POST['indentiRepre'], $_POST['comConta'], $_POST['cel'], $_POST['alli'], $_POST['boli'], $_POST['equi'], $_POST['mapfre'], $_POST['previ'], $_POST['soli'], $_POST['libe'], $_POST['est'], $_POST['axa'], $_POST['hdi'], $_POST['sbs'], $_POST['zuri'], $_POST['vig_register'], $_POST['img']);
        }
        
        

        
        echo $modelo; 

    break;


    //funcion para guardar credenciales zurich
    case "guardarzuri":

        $modelo = ModeloInternediario::guardarZuri($_POST['usu'], $_POST['contra'], $_POST['correo'], $_POST['cookie']);

        echo $modelo;

    break;

    //FUNCION PARA GUARDAR INTERMEDIARIOS
    case "guardarInter":

        if(isset($_POST['img'])){

            if(isset($_POST['id'])){

                $id = $_POST["id"];

                $modelo1 = ModeloInternediario::editInter($_POST['razon_update'], $_POST['tip_doc_update'], $_POST['numero_identificacionInter_update'], $_POST['repre_update'], $_POST['numero_identificacion_repre_update'], $_POST['email_update'], $_POST['direccion_update'], $_POST['ciudad_update'], $_POST['contac_update'], $_POST['cel_update'], $_POST['alli'], $_POST['boli'], $_POST['equi'], $_POST['mapfre'], $_POST['previ'], $_POST['soli'], $_POST['libe'], $_POST['est'], $_POST['axa'], $_POST['hdi'], $_POST['sbs'], $_POST['zuri'] , $_POST['sura'] , $_POST['mundial'] , $_POST['cars_update'], $_POST['img'], $id);

                $modelo = ModeloInternediario::editAlli($_POST['contraseñaAlli_update'], $_POST['idPartAlli_update'], $_POST['idagentAlli_update'], $_POST['codigoPartAlli_update'], $_POST['codigoagenAlli_update'], $id);

                $modelo = ModeloInternediario::editBoli($_POST['apikeyBo_update'], $_POST['ClaveABo_update'], $id);      
                
                $modelo = ModeloInternediario::editEqui($_POST['usuEqui_update'], $_POST['contraseñaEqui_update'] , $_POST['codSucuEqui_update'], $id);

                $modelo = ModeloInternediario::editSoli($_POST['codSucuSoli_update'], $_POST['codPerSoli_update'] , $_POST['tipAgeSoli_update'], $_POST['codigoAgeSoli_update'] , $_POST['codPunVenSoli_update'], $_POST['grantTypeSoli_update'], $_POST['cookieSoli_update'], $id);

                $modelo = ModeloInternediario::editLibe($_POST['cookieToLibe_update'], $_POST['cookieReLibe_update'] , $_POST['autoLibe_update'], $_POST['codigoAgenLibe_update'] , $_POST['ApliCliLibe_update'], $_POST['ipLibe_update'], $_POST['idRequeLibe_update'], $_POST['termilibe_update'], $id);

                $modelo = ModeloInternediario::editEst($_POST['usuEst_update'], $_POST['ContraLibe_update'], $id);

                $modelo = ModeloInternediario::editaxa($_POST['contraseñaaxa_update'], $_POST['codigodistriaxa_update'], $_POST['tipdistriaxa_update'], $_POST['codCiuaxa_update'], $_POST['canalaxa_update'], $_POST['valEveaxa_update'], $id);

                $modelo = ModeloInternediario::edithdi($_POST['codSucurhdi_update'], $_POST['codigoagenhdi_update'], $_POST['usuhdi_update'], $_POST['contraseñahdi_update'], $id);

                $modelo = ModeloInternediario::editsbs($_POST['ususbs_update'], $_POST['contraseñasbs_update'], $id);

                $modelo = ModeloInternediario::editZuri($_POST['usuzur_update'], $_POST['contraseñazur_update'], $_POST['correozur_update'], $_POST['cookiezur_update'], $id);

                if($modelo1){
                    echo "exitoso";
                }else{
                    echo "falle";
                }

            }else{

                $modelo1 = ModeloInternediario::guardarInter($_POST, $_FILES);

                $id = $modelo1["id_Intermediario"];

                $modelo = ModeloInternediario::guardarAlliRe($_POST['contraseñaAlli_register'], $_POST['idPartAlli_register'], $_POST['idagentAlli_register'], $_POST['codigoPartAlli_register'], $_POST['codigoagenAlli_register'], $id);
                
                echo $modelo;
                die();

                $modelo = ModeloInternediario::guardarBoliRe($_POST['apikeyBo_register'], $_POST['ClaveABo_register'], $id);      
                
                $modelo = ModeloInternediario::guardarEquiRe($_POST['usuEqui_register'], $_POST['contraseñaEqui_register'] , $_POST['codSucuEqui_register'], $id);

                $modelo = ModeloInternediario::guardarSoliRe($_POST['codSucuSoli_register'], $_POST['codPerSoli_register'] , $_POST['tipAgeSoli_register'], $_POST['codigoAgeSoli_register'] , $_POST['codPunVenSoli_register'], $_POST['grantTypeSoli_register'], $_POST['cookieSoli_register'], $id);

                $modelo = ModeloInternediario::guardarLibeRe($_POST['cookieToLibe_register'], $_POST['cookieReLibe_register'] , $_POST['autoLibe_register'], $_POST['codigoAgenLibe_register'] , $_POST['ApliCliLibe_register'], $_POST['ipLibe_register'], $_POST['idRequeLibe_register'], $_POST['termilibe_register'], $id);

                $modelo = ModeloInternediario::guardarEstRe($_POST['usuEst_register'], $_POST['ContraLibe_register'], $id);

                $modelo = ModeloInternediario::guardaraxaRe($_POST['contraseñaaxa_register'], $_POST['codigodistriaxa_register'], $_POST['tipdistriaxa_register'], $_POST['codCiuaxa_register'], $_POST['canalaxa_register'], $_POST['valEveaxa_register'], $id);

                $modelo = ModeloInternediario::guardarhdiRe($_POST['codSucurhdi_register'], $_POST['codigoagenhdi_register'], $_POST['usuhdi_register'], $_POST['contraseñahdi_register'], $id);

                $modelo = ModeloInternediario::guardarsbsRe($_POST['ususbs_register'], $_POST['contraseñasbs_register'], $id);

                $modelo = ModeloInternediario::guardarZuriRe($_POST['usuzur_register'], $_POST['contraseñazur_register'], $_POST['correozur_register'], $_POST['cookiezur_register'], $id);

                if($modelo1){
                    echo "exitoso";
                }else{
                    echo "fallo";
                }
            }
        }else{

            move_uploaded_file($_FILES['img']['tmp_name'], '../vistas/img/logosIntermediario/' . $_FILES['img']['name']);


            if(isset($_POST['id'])){

                $id = $_POST["id"];

                $modelo1 = ModeloInternediario::editInter($_POST['razon_update'], $_POST['tip_doc_update'], $_POST['numero_identificacionInter_update'], $_POST['repre_update'], $_POST['numero_identificacion_repre_update'], $_POST['email_update'], $_POST['direccion_update'], $_POST['ciudad_update'], $_POST['contac_update'], $_POST['cel_update'], $_POST['alli'], $_POST['boli'], $_POST['equi'], $_POST['mapfre'], $_POST['previ'], $_POST['soli'], $_POST['libe'], $_POST['est'], $_POST['axa'], $_POST['hdi'], $_POST['sbs'], $_POST['zuri'] , $_POST['sura'] , $_POST['mundial'] , $_POST['cars_update'], $_FILES['img']['name'], $id);

                $modelo = ModeloInternediario::editAlli($_POST['contraseñaAlli_update'], $_POST['idPartAlli_update'], $_POST['idagentAlli_update'], $_POST['codigoPartAlli_update'], $_POST['codigoagenAlli_update'], $id);

                $modelo = ModeloInternediario::editBoli($_POST['apikeyBo_update'], $_POST['ClaveABo_update'], $id);      
                
                $modelo = ModeloInternediario::editEqui($_POST['usuEqui_update'], $_POST['contraseñaEqui_update'] , $_POST['codSucuEqui_update'], $id);

                $modelo = ModeloInternediario::editSoli($_POST['codSucuSoli_update'], $_POST['codPerSoli_update'] , $_POST['tipAgeSoli_update'], $_POST['codigoAgeSoli_update'] , $_POST['codPunVenSoli_update'], $_POST['grantTypeSoli_update'], $_POST['cookieSoli_update'], $id);

                $modelo = ModeloInternediario::editLibe($_POST['cookieToLibe_update'], $_POST['cookieReLibe_update'] , $_POST['autoLibe_update'], $_POST['codigoAgenLibe_update'] , $_POST['ApliCliLibe_update'], $_POST['ipLibe_update'], $_POST['idRequeLibe_update'], $_POST['termilibe_update'], $id);

                $modelo = ModeloInternediario::editEst($_POST['usuEst_update'], $_POST['ContraLibe_update'], $id);

                $modelo = ModeloInternediario::editaxa($_POST['contraseñaaxa_update'], $_POST['codigodistriaxa_update'], $_POST['tipdistriaxa_update'], $_POST['codCiuaxa_update'], $_POST['canalaxa_update'], $_POST['valEveaxa_update'], $id);

                $modelo = ModeloInternediario::edithdi($_POST['codSucurhdi_update'], $_POST['codigoagenhdi_update'], $_POST['usuhdi_update'], $_POST['contraseñahdi_update'], $id);

                $modelo = ModeloInternediario::editsbs($_POST['ususbs_update'], $_POST['contraseñasbs_update'], $id);

                $modelo = ModeloInternediario::editZuri($_POST['usuzur_update'], $_POST['contraseñazur_update'], $_POST['correozur_update'], $_POST['cookiezur_update'], $id);

                if($modelo1){
                    echo "exitoso";
                }else{
                    echo "falle";
                }

            }else{

                $modelo1 = ModeloInternediario::guardarInter($_POST, $_FILES);

                $id = $modelo1["id_Intermediario"];

                $modelo = ModeloInternediario::guardarAlliRe($_POST['contraseñaAlli_register'], $_POST['idPartAlli_register'], $_POST['idagentAlli_register'], $_POST['codigoPartAlli_register'], $_POST['codigoagenAlli_register'], $id);

                $modelo = ModeloInternediario::guardarBoliRe($_POST['apikeyBo_register'], $_POST['ClaveABo_register'], $id);      
                
                $modelo = ModeloInternediario::guardarEquiRe($_POST['usuEqui_register'], $_POST['contraseñaEqui_register'] , $_POST['codSucuEqui_register'], $id);

                $modelo = ModeloInternediario::guardarSoliRe($_POST['codSucuSoli_register'], $_POST['codPerSoli_register'] , $_POST['tipAgeSoli_register'], $_POST['codigoAgeSoli_register'] , $_POST['codPunVenSoli_register'], $_POST['grantTypeSoli_register'], $_POST['cookieSoli_register'], $id);

                $modelo = ModeloInternediario::guardarLibeRe($_POST['cookieToLibe_register'], $_POST['cookieReLibe_register'] , $_POST['autoLibe_register'], $_POST['codigoAgenLibe_register'] , $_POST['ApliCliLibe_register'], $_POST['ipLibe_register'], $_POST['idRequeLibe_register'], $_POST['termilibe_register'], $id);

                $modelo = ModeloInternediario::guardarEstRe($_POST['usuEst_register'], $_POST['ContraLibe_register'], $id);

                $modelo = ModeloInternediario::guardaraxaRe($_POST['contraseñaaxa_register'], $_POST['codigodistriaxa_register'], $_POST['tipdistriaxa_register'], $_POST['codCiuaxa_register'], $_POST['canalaxa_register'], $_POST['valEveaxa_register'], $id);

                $modelo = ModeloInternediario::guardarhdiRe($_POST['codSucurhdi_register'], $_POST['codigoagenhdi_register'], $_POST['usuhdi_register'], $_POST['contraseñahdi_register'], $id);

                $modelo = ModeloInternediario::guardarsbsRe($_POST['ususbs_register'], $_POST['contraseñasbs_register'], $id);

                $modelo = ModeloInternediario::guardarZuriRe($_POST['usuzur_register'], $_POST['contraseñazur_register'], $_POST['correozur_register'], $_POST['cookiezur_register'], $id);

                if($modelo1){
                    echo "exitoso";
                }else{
                    echo "falle";
                }
            }
        }

    break;

    case "CambiarEstado":

        $Cambio = ModeloInternediario::CambioEstado($_POST['variable'], $_POST['id']);

    break;
    
}


?>
