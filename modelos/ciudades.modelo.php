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

        echo "aqui estoy mor";
		die();
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $item2  WHERE $item =:$item");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		$respuesta = $stmt -> fetch(PDO::FETCH_ASSOC);
        return $respuesta;
    }



}