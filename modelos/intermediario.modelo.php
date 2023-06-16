<?php

session_start();

require_once "conexion.php";

class ModeloInternediario{

    //funcion para traer credenciales de intermediario

    public static function mostrarCredenciales($variable){


        if($variable == 'S'){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM intermediario");


            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }else if(is_numeric($variable)){

            $inter = $variable;

            $stmt = Conexion::conectar()->prepare("SELECT * FROM intermediario i, Credenciales_Zurich z,Credenciales_Solidaria so, Credenciales_SBS sb, Credenciales_Liberty l, Credenciales_HDI h, Credenciales_Estado e, Credenciales_Bolivar b, Credenciales_AXA ax, Credenciales_Allianz al, Credenciales_Equidad eq WHERE i.id_Intermediario = ".$inter."  AND i.id_Intermediario = z.id_Intermediario  AND i.id_Intermediario = so.id_Intermediario  AND i.id_Intermediario = sb.id_intermediario AND i.id_Intermediario = l.id_Intermediario AND i.id_Intermediario = h.id_intermediario AND i.id_Intermediario = e.id_Intermediario AND i.id_Intermediario = b.id_Intermediario AND i.id_Intermediario = ax.id_Intermediario AND i.id_Intermediario = al.id_Intermediario AND i.id_Intermediario = eq.id_Intermediario");


            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }
        else {


            $inter = $_SESSION["intermediario"];
            


            $stmt = Conexion::conectar()->prepare("SELECT * FROM intermediario i, Credenciales_Zurich z,Credenciales_Solidaria so, Credenciales_SBS sb, Credenciales_Liberty l, Credenciales_HDI h, Credenciales_Estado e, Credenciales_Bolivar b, Credenciales_AXA ax, Credenciales_Allianz al, Credenciales_Equidad eq WHERE i.id_Intermediario = ".$inter."  AND i.id_Intermediario = z.id_Intermediario  AND i.id_Intermediario = so.id_Intermediario  AND i.id_Intermediario = sb.id_intermediario AND i.id_Intermediario = l.id_Intermediario AND i.id_Intermediario = h.id_intermediario AND i.id_Intermediario = e.id_Intermediario AND i.id_Intermediario = b.id_Intermediario AND i.id_Intermediario = ax.id_Intermediario AND i.id_Intermediario = al.id_Intermediario AND i.id_Intermediario = eq.id_Intermediario");


            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

    }

    //FUNCION PARA GUARDAR INTERMEDIARIOS

    public static function guardarInter($post, $files){
        
        if($post['tip_doc_register'] == 2){
            $Tip_Per = 1;
        }else{
            $Tip_Per = 2;
        }

        if(isset($post['img'])){

 

            $sqlInsert = Conexion::conectar()->prepare("INSERT INTO intermediario(nombre, tip_per_id, tipo_documento, num_documento, nombre_representante, Identificacion, correo, direccion, ciudad, contacto, celular, codigo_alli, codigo_boli, codigo_equi, codigo_map, codigo_previ, codigo_soli, codigo_libe, codigo_est, codigo_axa, codigo_hdi, codigo_sbs, codigo_zuri, codigo_Sura, codigo_Mundial, intermediario_Fech_Vigen, urlLogo) VALUES ('" .$post['razon_register']."', '".$Tip_Per."', '" .$post['tip_doc_register']."', '" .$post['numero_identificacionInter_register']."', '" .$post['repre_register']."', '" .$post['numero_identificacion_repre_register']."', '" .$post['email_register']."', '" .$post['direccion_register']."', '" .$post['ciudad_register']."', '" .$post['contac_register']."', '" .$post['cel_register']."', '" .$post['alli']."', '" .$post['boli']."', '" .$post['equi']."', '" .$post['mapfre']."', '" .$post['previ']."', '" .$post['soli']."', '" .$post['libe']."', '" .$post['est']."', '" .$post['axa']."', '" .$post['hdi']."', '" .$post['sbs']."', '" .$post['zuri']."' , '" .$post['sura']."' , '" .$post['mundial']."' , '".$post['vig_register'] ."', '" .$post['img']."')");

            $sqlInsert -> execute();

            if(isset($sqlInsert)){
                $sqlId = Conexion::conectar()->prepare("SELECT id_Intermediario FROM intermediario ORDER BY id_Intermediario DESC LIMIT 1");

                $sqlId -> execute();

                return $sqlId -> fetch();
            }
        }else{
            $sqlInsert = Conexion::conectar()->prepare("INSERT INTO intermediario(nombre, tip_per_id, tipo_documento, num_documento, nombre_representante, Identificacion, correo, direccion, ciudad, contacto, celular, codigo_alli, codigo_boli, codigo_equi, codigo_map, codigo_previ, codigo_soli, codigo_libe, codigo_est, codigo_axa, codigo_hdi, codigo_sbs, codigo_zuri,  codigo_Sura,  codigo_Mundial, intermediario_Fech_Vigen, urlLogo) VALUES ('" .$post['razon_register']."', '".$Tip_Per."', '" .$post['tip_doc_register']."', '" .$post['numero_identificacionInter_register']."', '" .$post['repre_register']."', '" .$post['numero_identificacion_repre_register']."', '" .$post['email_register']."', '" .$post['direccion_register']."', '" .$post['ciudad_register']."', '" .$post['contac_register']."', '" .$post['cel_register']."', '" .$post['alli']."', '" .$post['boli']."', '" .$post['equi']."', '" .$post['mapfre']."', '" .$post['previ']."', '" .$post['soli']."', '" .$post['libe']."', '" .$post['est']."', '" .$post['axa']."', '" .$post['hdi']."', '" .$post['sbs']."', '" .$post['zuri']."' , '" .$post['sura']."' , '" .$post['mundial']."' , '".$post['vig_register'] ."', '" .$files['img']['name']."')");

            $sqlInsert -> execute();

            if(isset($sqlInsert)){
                $sqlId = Conexion::conectar()->prepare("SELECT id_Intermediario FROM intermediario ORDER BY id_Intermediario DESC LIMIT 1");

                $sqlId -> execute();

                return $sqlId -> fetch();
            }
        }
    }

    //funcion para actualizar informacion del intermediario

    public static function editarInter($tipodocumento, $correo, $identiInt, $direccion, $razonSO, $ciudad, $nomRepre, $indentiRepre, $comConta, $cel, $alli, $boli, $equi, $mapfre, $previ, $soli, $libe, $est, $axa, $hdi, $sbs, $zuri, $vig_register, $img){
        $inter = $_SESSION["intermediario"];
        
        if($tipodocumento == 2){
            $Tip_Per = 1;
        }else{
            $Tip_Per = 2;
        }

        $sqledit = Conexion::conectar()->prepare("UPDATE intermediario SET nombre = '$razonSO', tip_per_id = '$Tip_Per', tipo_documento   =  '$tipodocumento', num_documento = '$identiInt', nombre_representante ='$nomRepre', Identificacion = '$indentiRepre', correo = '$correo', direccion = '$direccion', ciudad = '$ciudad', contacto = '$comConta', celular = '$cel', codigo_alli = '$alli', codigo_boli = '$boli', codigo_equi = '$equi', codigo_map = '$mapfre', codigo_previ = '$previ', codigo_soli = '$soli', codigo_libe = '$libe', codigo_est = '$est', codigo_axa = '$axa', codigo_hdi = '$hdi', codigo_sbs = '$sbs ', codigo_zuri = '$zuri', intermediario_Fech_Vigen = '$vig_register', urlLogo= '$img' WHERE id_Intermediario = '$inter'");

        $sqledit -> execute();
        $resultedit =  $sqledit ->rowCount();

        if($resultedit){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }

    //funcion para guardar credenciales del intermediario

    public static function guardarAlliRe($contra, $part, $idAge, $codPAt, $codAge, $inter){

        $inter = $inter;

        $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Allianz (id_Intermediario, cre_alli_passphrase, cre_alli_partnerid, cre_alli_agentid, cre_alli_partnercode, cre_alli_agentcode) VALUES ('".$inter."', '".$contra."', '".$part."', '".$idAge."', '".$codPAt."', '".$codAge."')");

        $sql -> execute();

    }

    public static function guardarBoliRe($apy, $clave, $inter){

        $inter = $inter;

            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Bolivar (id_Intermediario, cre_bol_api_key, cre_bol_claveAsesor) VALUES ('".$inter."', '".$apy."', '".$clave."')");

            $sql -> execute();

    }

    public static function guardarEquiRe($usu, $contra, $sucur, $inter){

        $inter = $inter;

            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Equidad (id_Intermediario, cre_equ_usuario, cre_equ_contraseña, cre_equ_codigo_sucursal) VALUES ('".$inter."', '".$usu."', '".$contra."', '".$sucur."')");

            $sql -> execute();
    
    }

    public static function guardarSoliRe($sucur, $codPer, $tipAge, $codAge, $PunVen, $grantTy, $cookie, $inter){

        $inter = $inter;

            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Solidaria (id_Intermediario, cre_sol_cod_sucursal, cre_sol_cod_per, cre_sol_cod_tipo_agente, cre_sol_cod_agente,cre_sol_cod_pto_vta, cre_sol_grant_type, cre_sol_Cookie_token) VALUES ('".$inter."', '".$sucur."', '".$codPer."', '".$tipAge."', '".$codAge."', '".$PunVen."', '".$grantTy."', '".$cookie."')");

            $sql -> execute();

    }

    public static function guardarLibeRe($cookTo, $cookRe, $auto, $codAge, $apliCli, $ip, $idReq, $terminal, $inter){

        $inter = $inter;

            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Liberty (id_Intermediario, cre_lib_cookieToken, cre_lib_cookieRequest, cre_lib_authorization, cre_lib_codigoAgenteGestion,cre_lib_aplicacionCliente, cre_lib_ip, cre_lib_requestID, cre_lib_terminal) VALUES ('".$inter."', '".$cookTo."', '".$cookRe."', '".$auto."', '".$codAge."', '".$apliCli."', '".$ip."', '".$idReq."', '".$terminal."')");
            $sql -> execute();
        
    }

    public static function guardarEstRe($usu, $contra, $inter){

        $inter = $inter;

            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Estado (id_Intermediario, cre_est_usuario, cre_equ_contrasena) VALUES ('".$inter."', '".$usu."', '".$contra."')");

            $sql -> execute();
       
    }

    public static function guardaraxaRe($contra, $codDis, $tipDis, $codCiu, $canal, $valEve, $inter){

        $inter = $inter;

            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_AXA (id_Intermediario, cre_axa_passphrase, cre_axa_codigoDistribuidor, cre_axa_idTipoDistribuidor, cre_axa_codigoDivipola,cre_axa_canal, cre_axa_validacionEventos) VALUES ('".$inter."', '".$contra."', '".$codDis."', '".$tipDis."', '".$codCiu."', '".$canal."', '".$valEve."')");
            $sql -> execute();
        
    }

    public static function guardarhdiRe($codSucu, $codAge, $usu, $contra, $inter){

        $inter = $inter;

            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_HDI (id_Intermediario, cre_hdi_codSucursal, cre_hdi_CodigoAgente, cre_hdi_usuario, cre_hdi_contraseña) VALUES ('".$inter."', '".$codSucu."', '".$codAge."', '".$usu."', '".$contra."')");
            $sql -> execute();
        
    }


    public static function guardarsbsRe($usu, $contra, $inter){

        $inter = $inter;


            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_SBS (id_intermediario, cre_sbs_usuario, cre_sbs_contraseña) VALUES ('".$inter."', '".$usu."', '".$contra."')");

            $sql -> execute();

    }

    public static function guardarZuriRe($usu, $contra, $correo, $cookie, $inter){

        $inter = $inter;

        
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Zurich (id_Intermediario, cre_zur_nomUsu, cre_zur_passwd, cre_zur_intermediaryEmail, cre_zur_Cookie) VALUES ('".$inter."', '".$usu."', '".$contra."', '".$correo."', '".$cookie."')");

            $sql -> execute();

    }

    public static function guardarAlli($contra, $part, $idAge, $codPAt, $codAge){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Allianz al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Allianz SET cre_alli_passphrase = '$contra', cre_alli_partnerid =  '$part', cre_alli_agentid = '$idAge', cre_alli_partnercode ='$codPAt', cre_alli_agentcode = '$codAge' WHERE id_Intermediario = '$inter'");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Allianz (cre_alli_passphrase, cre_alli_partnerid, cre_alli_agentid, cre_alli_partnercode, cre_alli_agentcode) VALUES ($contra, $part, $idAge, $codPAt, $codAge) WHERE id_Intermediario = '$inter'");

            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }

    public static function guardarBoli($apy, $clave){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Bolivar al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Bolivar SET cre_bol_api_key = '$apy', cre_bol_claveAsesor =  '$clave' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Bolivar (cre_bol_api_key, cre_bol_claveAsesor) VALUES ($apy, $clave) WHERE id_Intermediario = $inter");

            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }


    public static function guardarEqui($usu, $contra, $sucur){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Zurich al WHERE al.id_intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Equidad SET cre_equ_usuario = '$usu', cre_equ_contraseña =  '$contra', cre_equ_codigo_sucursal = $sucur WHERE id_intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Equidad (cre_equ_usuario, cre_equ_contraseña, cre_equ_codigo_sucursal) VALUES ($usu, $contra, $sucur) WHERE id_intermediario = $inter");

            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }

    public static function guardarSoli($sucur, $codPer, $tipAge, $codAge, $PunVen, $grantTy, $cookie){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Solidaria al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Solidaria SET cre_sol_cod_sucursal = '$sucur', cre_sol_cod_per =  '$codPer', cre_sol_cod_tipo_agente = '$tipAge', cre_sol_cod_agente = '$codAge', cre_sol_cod_pto_vta = '$PunVen', cre_sol_grant_type = '$grantTy', cre_sol_Cookie_token = '$cookie' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Solidaria (cre_sol_cod_sucursal, cre_sol_cod_per, cre_sol_cod_tipo_agente, cre_sol_cod_agente,cre_sol_cod_pto_vta, cre_sol_grant_type, cre_sol_Cookie_token) VALUES ($sucur, $codPer, $tipAge, $codAge, $PunVen, $grantTy, $cookie) WHERE id_Intermediario = $inter");

            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }


    public static function guardarLibe($cookTo, $cookRe, $auto, $codAge, $apliCli, $ip, $idReq, $terminal){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Liberty al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){

            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Liberty SET cre_lib_cookieToken = '$cookTo', cre_lib_cookieRequest =  '$cookRe', cre_lib_authorization = '$auto', cre_lib_codigoAgenteGestion = '$codAge', cre_lib_aplicacionCliente = '$apliCli', cre_lib_ip = '$ip', cre_lib_requestID = '$idReq', cre_lib_terminal = '$terminal' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Liberty (cre_lib_cookieToken, cre_lib_cookieRequest, cre_lib_authorization, cre_lib_codigoAgenteGestion,cre_lib_aplicacionCliente, cre_lib_ip, cre_lib_requestID, cre_lib_terminal) VALUES ($cookTo, $cookRe, $auto, $codAge, $apliCli, $ip, $idReq, $terminal) WHERE id_Intermediario = $inter");
            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }


    public static function guardarEst($usu, $contra){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Estado al WHERE al.id_intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Estado SET cre_est_usuario = '$usu', cre_equ_contrasena =  '$contra' WHERE id_intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Estado (cre_est_usuario, cre_equ_contrasena) VALUES ($usu, $contra) WHERE id_intermediario = $inter");

            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }


    public static function guardaraxa($contra, $codDis, $tipDis, $codCiu, $canal, $valEve){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_AXA al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){

            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_AXA SET cre_axa_passphrase = '$contra', cre_axa_codigoDistribuidor =  '$codDis', cre_axa_idTipoDistribuidor = '$tipDis', cre_axa_codigoDivipola = '$codCiu', cre_axa_canal = '$canal', cre_axa_validacionEventos = '$valEve' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_AXA (cre_axa_passphrase, cre_axa_codigoDistribuidor, cre_axa_idTipoDistribuidor, cre_axa_codigoDivipola,cre_axa_canal, cre_axa_validacionEventos) VALUES ($contra, $codDis, $tipDis, $codCiu, $canal, $valEve) WHERE id_Intermediario = $inter");
            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }


    public static function guardarhdi($codSucu, $codAge, $usu, $contra){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_HDI al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){

            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_HDI SET cre_hdi_codSucursal = '$codSucu', cre_hdi_CodigoAgente =  '$codAge', cre_hdi_usuario = '$usu', 	cre_hdi_contraseña = '$contra' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_HDI (cre_hdi_codSucursal, cre_hdi_CodigoAgente, cre_hdi_usuario, cre_hdi_contraseña) VALUES ($codSucu, $codAge, $usu, $contra) WHERE id_Intermediario = $inter");
            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }


    public static function guardarsbs($usu, $contra){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_SBS al WHERE al.id_intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_SBS SET cre_sbs_usuario = '$usu', cre_sbs_contraseña =  '$contra' WHERE id_intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Estado (cre_sbs_usuario, cre_sbs_contraseña) VALUES ($usu, $contra) WHERE id_intermediario = $inter");

            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }

    public static function guardarZuri($usu, $contra, $correo, $cookie){

        $inter = $_SESSION["intermediario"];

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Zurich al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Zurich SET cre_zur_nomUsu = '$usu', cre_zur_passwd =  '$contra',cre_zur_intermediaryEmail = '$correo', cre_zur_Cookie ='$cookie' WHERE id_Intermediario = '$inter'");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Zurich (cre_zur_nomUsu, cre_zur_passwd, cre_zur_intermediaryEmail, cre_zur_Cookie) VALUES ($usu, $contra, $correo, $cookie) WHERE id_Intermediario = '$inter'");

            $sql -> execute();
        }

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }
    }

    //funcion para actualizar credenciales del intermediario

    //XewEqDEOkZ1i4sphLVXxs5RtkIDLFIPq3jWEokla
    public static function editAlli($contra, $part, $idAge, $codPAt, $codAge,  $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Allianz al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Allianz SET cre_alli_passphrase = '$contra', cre_alli_partnerid =  '$part', cre_alli_agentid = '$idAge', cre_alli_partnercode ='$codPAt', cre_alli_agentcode = '$codAge' WHERE id_Intermediario = '$inter'");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Allianz (cre_alli_passphrase, cre_alli_partnerid, cre_alli_agentid, cre_alli_partnercode, cre_alli_agentcode) VALUES ($contra, $part, $idAge, $codPAt, $codAge) WHERE id_Intermediario = '$inter'");

            $sql -> execute();
        }

    }

    public static function editBoli($apy, $clave, $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Bolivar al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Bolivar SET cre_bol_api_key = '$apy', cre_bol_claveAsesor =  '$clave' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Bolivar (cre_bol_api_key, cre_bol_claveAsesor) VALUES ($apy, $clave) WHERE id_Intermediario = $inter");

            $sql -> execute();
        }

    }


    public static function editEqui($usu, $contra, $sucur, $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Zurich al WHERE al.id_intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Equidad SET cre_equ_usuario = '$usu', cre_equ_contraseña =  '$contra', cre_equ_codigo_sucursal = $sucur WHERE id_intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Equidad (cre_equ_usuario, cre_equ_contraseña, cre_equ_codigo_sucursal) VALUES ($usu, $contra, $sucur) WHERE id_intermediario = $inter");

            $sql -> execute();
        }

    }

    public static function editSoli($sucur, $codPer, $tipAge, $codAge, $PunVen, $grantTy, $cookie, $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Solidaria al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Solidaria SET cre_sol_cod_sucursal = '$sucur', cre_sol_cod_per =  '$codPer', cre_sol_cod_tipo_agente = '$tipAge', cre_sol_cod_agente = '$codAge', cre_sol_cod_pto_vta = '$PunVen', cre_sol_grant_type = '$grantTy', cre_sol_Cookie_token = '$cookie' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Solidaria (cre_sol_cod_sucursal, cre_sol_cod_per, cre_sol_cod_tipo_agente, cre_sol_cod_agente,cre_sol_cod_pto_vta, cre_sol_grant_type, cre_sol_Cookie_token) VALUES ($sucur, $codPer, $tipAge, $codAge, $PunVen, $grantTy, $cookie) WHERE id_Intermediario = $inter");

            $sql -> execute();
        }

    }


    public static function editLibe($cookTo, $cookRe, $auto, $codAge, $apliCli, $ip, $idReq, $terminal, $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Liberty al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){

            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Liberty SET cre_lib_cookieToken = '$cookTo', cre_lib_cookieRequest =  '$cookRe', cre_lib_authorization = '$auto', cre_lib_codigoAgenteGestion = '$codAge', cre_lib_aplicacionCliente = '$apliCli', cre_lib_ip = '$ip', cre_lib_requestID = '$idReq', cre_lib_terminal = '$terminal' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Liberty (cre_lib_cookieToken, cre_lib_cookieRequest, cre_lib_authorization, cre_lib_codigoAgenteGestion,cre_lib_aplicacionCliente, cre_lib_ip, cre_lib_requestID, cre_lib_terminal) VALUES ($cookTo, $cookRe, $auto, $codAge, $apliCli, $ip, $idReq, $terminal) WHERE id_Intermediario = $inter");
            $sql -> execute();
        }

    }


    public static function editEst($usu, $contra, $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Estado al WHERE al.id_intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Estado SET cre_est_usuario = '$usu', cre_equ_contrasena =  '$contra' WHERE id_intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Estado (cre_est_usuario, cre_equ_contrasena) VALUES ($usu, $contra) WHERE id_intermediario = $inter");

            $sql -> execute();
        }


    }


    public static function editaxa($contra, $codDis, $tipDis, $codCiu, $canal, $valEve, $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_AXA al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){

            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_AXA SET cre_axa_passphrase = '$contra', cre_axa_codigoDistribuidor =  '$codDis', cre_axa_idTipoDistribuidor = '$tipDis', cre_axa_codigoDivipola = '$codCiu', cre_axa_canal = '$canal', cre_axa_validacionEventos = '$valEve' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_AXA (cre_axa_passphrase, cre_axa_codigoDistribuidor, cre_axa_idTipoDistribuidor, cre_axa_codigoDivipola,cre_axa_canal, cre_axa_validacionEventos) VALUES ($contra, $codDis, $tipDis, $codCiu, $canal, $valEve) WHERE id_Intermediario = $inter");
            $sql -> execute();
        }

    }


    public static function edithdi($codSucu, $codAge, $usu, $contra, $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_HDI al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){

            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_HDI SET cre_hdi_codSucursal = '$codSucu', cre_hdi_CodigoAgente =  '$codAge', cre_hdi_usuario = '$usu', 	cre_hdi_contraseña = '$contra' WHERE id_Intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_HDI (cre_hdi_codSucursal, cre_hdi_CodigoAgente, cre_hdi_usuario, cre_hdi_contraseña) VALUES ($codSucu, $codAge, $usu, $contra) WHERE id_Intermediario = $inter");
            $sql -> execute();
        }

    }


    public static function editsbs($usu, $contra, $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_SBS al WHERE al.id_intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_SBS SET cre_sbs_usuario = '$usu', cre_sbs_contraseña =  '$contra' WHERE id_intermediario = $inter");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Estado (cre_sbs_usuario, cre_sbs_contraseña) VALUES ($usu, $contra) WHERE id_intermediario = $inter");

            $sql -> execute();
        }

    }

    public static function editZuri($usu, $contra, $correo, $cookie, $inter){

        $stmt = Conexion::conectar()->prepare("SELECT al.id_intermediario FROM Credenciales_Zurich al WHERE al.id_Intermediario = ".$inter."");
		$stmt -> execute();

        $num = $stmt->rowCount();
        if ($num != 0){
            $sql = Conexion::conectar()->prepare("UPDATE Credenciales_Zurich SET cre_zur_nomUsu = '$usu', cre_zur_passwd =  '$contra',cre_zur_intermediaryEmail = '$correo', cre_zur_Cookie ='$cookie' WHERE id_Intermediario = '$inter'");

            $sql -> execute();
        }else{
            $sql = Conexion::conectar()->prepare("INSERT INTO Credenciales_Zurich (cre_zur_nomUsu, cre_zur_passwd, cre_zur_intermediaryEmail, cre_zur_Cookie) VALUES ($usu, $contra, $correo, $cookie) WHERE id_Intermediario = '$inter'");

            $sql -> execute();
        }

    }

    public static function editInter($razonSO, $tipodocumento, $identiInt, $nomRepre, $indentiRepre, $correo,  $direccion,  $ciudad,   $comConta, $cel, $alli, $boli, $equi, $mapfre, $previ, $soli, $libe, $est, $axa, $hdi, $sbs, $zuri, $sura, $mundial, $fech_vig, $img, $inter){
        $inter = $inter;

        if($tipodocumento == 2){
            $Tip_Per = 1;
        }else{
            $Tip_Per = 2;
        }

        $sqledit = Conexion::conectar()->prepare("UPDATE intermediario SET nombre = '$razonSO', tip_per_id = '$Tip_Per', tipo_documento   =  '$tipodocumento', num_documento = '$identiInt', nombre_representante ='$nomRepre', Identificacion = '$indentiRepre', correo = '$correo', direccion = '$direccion', ciudad = '$ciudad', contacto = '$comConta', celular = '$cel', codigo_alli = '$alli', codigo_boli = '$boli', codigo_equi = '$equi', codigo_map = '$mapfre', codigo_previ = '$previ', codigo_soli = '$soli', codigo_libe = '$libe', codigo_est = '$est', codigo_axa = '$axa', codigo_hdi = '$hdi', codigo_sbs = '$sbs ', codigo_zuri = '$zuri', codigo_Mundial = '$mundial', codigo_sura = '$sura', intermediario_Fech_Vigen = '$fech_vig', urlLogo = '$img' WHERE id_Intermediario = '$inter'");

        $sqledit -> execute();
        return $resultedit =  $sqledit ->rowCount();

    }

    public static function CambioEstado($variable, $id){

        $sql = Conexion::conectar()->prepare("UPDATE intermediario SET intermediario_Estado = '$variable' WHERE id_Intermediario = '$id'");

        $sql -> execute();

        $result =  $sql ->rowCount();

        if($result){
            echo "exitoso";
        }else{
            echo "falle";
        }

    }
}
?>