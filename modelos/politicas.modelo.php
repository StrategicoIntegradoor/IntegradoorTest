<?php

require_once "conexion.php";

class ModeloPoliticas{

    /*=============================================
	MOSTRAR Políticas
	=============================================*/

    public static function mdlMostrarPoliticas($variable){


        if($variable == 'S'){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM politicasfacturacion");
            $stmt -> execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultados);

        }else if($variable == ''){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM politicasfacturacion");
            $stmt -> execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultados);


        }
        else {

            $inter = $_SESSION["intermediario"];
            $stmt = Conexion::conectar()->prepare("SELECT * FROM intermediario i, Credenciales_Zurich z,Credenciales_Solidaria so, Credenciales_SBS sb, Credenciales_Liberty l, Credenciales_HDI h, Credenciales_Estado e, Credenciales_Bolivar b, Credenciales_AXA ax, Credenciales_Allianz al, Credenciales_Equidad eq WHERE i.id_Intermediario = ".$inter."  AND i.id_Intermediario = z.id_Intermediario  AND i.id_Intermediario = so.id_Intermediario  AND i.id_Intermediario = sb.id_intermediario AND i.id_Intermediario = l.id_Intermediario AND i.id_Intermediario = h.id_intermediario AND i.id_Intermediario = e.id_Intermediario AND i.id_Intermediario = b.id_Intermediario AND i.id_Intermediario = ax.id_Intermediario AND i.id_Intermediario = al.id_Intermediario AND i.id_Intermediario = eq.id_Intermediario");
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }

    }

    public static function mdlMostrarEstados(){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM estadocontrato");
        $stmt -> execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultados);

    }

    public static function mdlMostrarTipos(){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM tipoContrato");
        $stmt -> execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultados);

    }

    public static function mdlEliminarPolitica($id){

        $stmt = Conexion::conectar()->prepare("DELETE FROM politicasfacturacion WHERE idPoliticasCobro= :id");
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

    public static function mdlEliminarEstado($id){

        $stmt = Conexion::conectar()->prepare("DELETE FROM estadocontrato WHERE idEstadoContrato= :id");
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

    public static function mdlEliminarTipo($id){

        $stmt = Conexion::conectar()->prepare("DELETE FROM tipocontrato WHERE idTipoContrato= :id");
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

    public static function mdlAgregarPolitica($descripcion, $renovacion, $mora, $cancelacion){
    
        $stmt = Conexion::conectar()->prepare("INSERT INTO politicasfacturacion (descripcionPolitica, diasParaRenovar, diasMaxMora, diasCancelacion) 
        VALUES ('$descripcion', '$renovacion', '$mora', '$cancelacion')");
        $stmt -> execute();

    }

    public static function mdlEditarPolitica($descripcion, $renovacion, $mora, $cancelacion, $id){
        $stmt = Conexion::conectar()->prepare("UPDATE politicasfacturacion SET descripcionPolitica = '$descripcion', diasParaRenovar = '$renovacion', diasMaxMora = '$mora', diasCancelacion = '$cancelacion' WHERE idPoliticasCobro = '$id' ");
        $stmt -> execute();
        $result =  $stmt->rowCount();

        if($result){
            echo "1";
        }else{
            echo "0";
        }
    }

    public static function mdlAgregarEstado($nombre, $descripcion){
    
        $stmt = Conexion::conectar()->prepare("INSERT INTO estadocontrato (nombreEstadoContrato, descripcionEstadoContrato) VALUES ('$nombre', '$descripcion')");
        $stmt -> execute();

    }

    public static function mdlEditarEstado($nombre, $descripcion, $id){
        $stmt = Conexion::conectar()->prepare("UPDATE estadocontrato SET nombreEstadoContrato = '$nombre', descripcionEstadoContrato = '$descripcion' WHERE idEstadoContrato = '$id' ");
        $stmt -> execute();
        $result =  $stmt->rowCount();

        if($result){
            echo "1";
        }else{
            echo "0";
        }
    }

    public static function mdlAgregarTipo($modalidad, $duracion, $estado, $descripcion){
    
        $stmt = Conexion::conectar()->prepare("INSERT INTO tipocontrato (modalidadContrato, tiempoDuracionContrato, estadoTipoContrato, descripcionTipoContrato) VALUES ('$modalidad', '$duracion','$estado','$descripcion')");
        $stmt -> execute();

    }

    public static function mdlEditarTipo($modalidad, $duracion, $estado, $descripcion, $id){

        $stmt = Conexion::conectar()->prepare("UPDATE tipocontrato SET modalidadContrato = '$modalidad', tiempoDuracionContrato = '$duracion', estadoTipoContrato = '$estado', descripcionTipoContrato = '$descripcion'  WHERE idTipoContrato = '$id' ");
        $stmt -> execute();
        $result =  $stmt->rowCount();

        if($result){
            echo "1";
        }else{
            echo "0";
        }

    }

}