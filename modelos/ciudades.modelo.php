<?php

require_once "conexion.php";

class ModeloCiudades{

    public static function MdlMostrarCiudades($item){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $item");
        $stmt -> execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;

    }
    
    public static function MdlBuscarCiudades($item, $valor, $item2){

        // var_dump($valor);
        // die()
        // ;
        $stmt = Conexion::conectar()->prepare("SELECT * FROM 'ciudadesbolivar' WHERE $item =:$item");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		var_dump($stmt -> execute());
        die();
		$respuesta = $stmt -> fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }



}