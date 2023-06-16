<?php

    require_once("DB.php");

class Conexion 
{

    public static function GetConexion() {
        $con = @mysqli_connect(DB::$DB_HOST, DB::$DB_USER, DB::$DB_PASS, DB::$DB_NAME);
        $con->set_charset("utf8");
        
        return $con;
    }
}