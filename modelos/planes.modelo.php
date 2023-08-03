<?php

require_once "conexion.php";

class ModeloPlanes{

    public static function mdlTraerPlanes(){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM planes");
        $stmt -> execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultados);

    }

    public static function mdlEliminarPlan($id){

        $stmt = Conexion::conectar()->prepare("DELETE FROM planes WHERE idPlan= :id");
        $stmt->bindParam(':id', $id);
        $stmt -> execute();
        $rowCount = $stmt->rowCount(); // Número de filas afectadas por la eliminación

        if ($rowCount > 0) {
            // Se eliminó exitosamente
            echo "1";
        } else {
            // No se encontró la fila o no se pudo eliminar
            echo "0";
        }        
    }


    public static function mdlAgregarPlan($nombre, $cantCot, $cantUsu, $cantUsuWeb, $iframe, $freeCharges, $valor){

        $stmt = Conexion::conectar()->prepare("INSERT INTO planes (nombrePlan, numeroDeCotizacionesPlan, cantidadeUsuarios, cantidadUsuariosWeb, iframe, cantRecargasGratisAnuales, Valor) 
        VALUES ('$nombre', '$cantCot', '$cantUsu', '$cantUsuWeb', '$iframe', '$freeCharges', '$valor')");
        $stmt -> execute();
    }

    public static function mdlEditarPlan($nombre, $cantCot, $cantUsu, $cantUsuWeb, $iframe, $freeCharges, $valor, $id){

        $stmt = Conexion::conectar()->prepare("UPDATE planes SET nombrePlan = '$nombre', numeroDeCotizacionesPlan = '$cantCot', cantidadeUsuarios = '$cantUsu', 
        cantidadUsuariosWeb = '$cantUsuWeb', iframe = '$iframe', cantRecargasGratisAnuales = '$freeCharges', Valor = '$valor'  WHERE idPlan = '$id' ");
        $stmt -> execute();
        $result =  $stmt->rowCount();

        if($result){
            echo "1";
        }else{
            echo "0";
        }
    }

}