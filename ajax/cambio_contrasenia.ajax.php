<?php

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);

    $data = json_decode(file_get_contents('php://input'), true);
    $codigo = $data['codigo'];
    $password = $data['password'];

    // Conexión
    $link = new PDO(
        "mysql:host=localhost;dbname=grupoasi_cotizautos",
        "root",
        ""
    );
    $link->exec("set names utf8");

    $codigo_cambio_contrasenia = $link->prepare("SELECT * FROM codigos_cambio_contraseñas WHERE codigo = '" . $codigo . "'");
    $codigo_cambio_contrasenia->execute();
    $codigo_cambio_contrasenia = $codigo_cambio_contrasenia->fetch(PDO::FETCH_ASSOC);
    if (!$codigo_cambio_contrasenia) {
        return false;
    }

    $usuarios = $link->prepare("SELECT * FROM usuarios WHERE id_usuario = " . $codigo_cambio_contrasenia['id_usuario']);
    $usuarios->execute();
    $usuarios = $usuarios->fetch(PDO::FETCH_ASSOC);
    if (!$usuarios) {
        return false;
    }

    $cambio = $link->prepare("UPDATE usuarios SET usu_password = '" . crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$') . "' WHERE id_usuario = " . $usuarios['id_usuario']);
    $cambio->execute();

    if (!$cambio) {
        print_r(false);
    }

    print_r(true);
