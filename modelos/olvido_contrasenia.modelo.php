<?php

    require_once "conexion.php";

    class ModeloOlvidoContrasenia {
        
        static public function mdlGuardarCodigo($correo, $codigo) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE usu_email = " . "'" . $correo . "'");
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $idUsuario = $resultado['id_usuario'];
            $stmt = Conexion::conectar()->prepare("DELETE FROM codigos_cambio_contraseñas WHERE id_usuario = " . $idUsuario);
            $stmt->execute();
            $stmt = Conexion::conectar()->prepare("INSERT INTO codigos_cambio_contraseñas VALUES(NULL," . $idUsuario . ", '" . $codigo . "')");
            $stmt->execute();

            return true;
        }
        
    }
