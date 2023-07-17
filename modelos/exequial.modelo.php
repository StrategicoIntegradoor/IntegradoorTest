<?php

require_once "conexion.php";

class ModelOlivos{

    public static function mdlAgregarCoti($tabla, $numeroCoti, $nombre, $edad, $tipo, $usuario, $fecha, $idUsuario){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (numeroCotizacion, nombreTitular, edad, tipoPlan, usuario, fechaCoti, id_usuario) 
        VALUES ('$numeroCoti', '$nombre', '$edad', '$tipo', '$usuario', '$fecha', '$idUsuario')");
        
        if($stmt->execute()){
            
            $numeroCoti = Conexion::conectar()->prepare("SELECT MAX(id) FROM segurosexequiales");
            $numeroCoti->execute();
            $resultado = $numeroCoti->fetch(PDO::FETCH_ASSOC);
            $cotizacion = $resultado["MAX(id)"];
            $stmtUpdate = Conexion::conectar()->prepare("UPDATE $tabla SET numeroCotizacion = :numeroCoti WHERE id = :id");
            $stmtUpdate->bindParam(":numeroCoti", $cotizacion);
            $stmtUpdate->bindParam(":id", $cotizacion);
            if($stmtUpdate->execute()){
                $response = array('success' => 'Registro exitoso','numeroCotizacion' => $cotizacion);
                $jsonResponse = json_encode($response);
                echo $jsonResponse;
            }
        }else{
            
            echo 'Fallo de conexion';
        }
        

        // if ($stmt->execute()) {
        //     $numeroCoti = Conexion::conectar()->lastInsertId();
        //     $stmtUpdate = Conexion::conectar()->prepare("UPDATE $tabla SET numeroCotizacion = :numeroCoti WHERE id = :id");
        //     $stmtUpdate->bindParam(":numeroCoti", $numeroCoti, PDO::PARAM_INT);
        //     $stmtUpdate->bindParam(":id", $numeroCoti, PDO::PARAM_INT);
        //     $stmtUpdate->execute();
        // }
    }
}