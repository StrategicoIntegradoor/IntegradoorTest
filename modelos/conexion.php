<?php



class Conexion{

	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=grupoasi_cotizautos",
			            "grupoasi_cotizautos",
			            "M1graci0n123");
		$link->exec("set names utf8");

		return $link;
	}
}