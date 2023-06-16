<?php

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
    require_once "../modelos/olvido_contrasenia.modelo.php";
    require_once "../extensiones/PHPMailer.php";
    require_once "../extensiones/SMTP.php";

    class OlvidoContrasenia {

        protected $codigo = '';

        public function __construct() {
            $this->codigo = $this->generarCodigo();
        }

        private function generarCodigo() {
            return uniqid();
        }

        public function guardarCodigo($correo) {
            $codigo = $this->generarCodigo();
            $resultado = ModeloOlvidoContrasenia::mdlGuardarCodigo($correo, 
                                                                $codigo);
            print_r($resultado);
            if (!$resultado) { return false; }

            $this->enviarCorreo($correo, $codigo);
            return true;
        }
        
        public function enviarCorreo($correo, $codigo) {
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->CharSet = 'UTF-8';

            $body = '<a href="integradoor.com/app/cambio-password?codigo=' . $codigo . '"><h3 style="color: #88d600, font-weight: bold;">Click aquí para restablecer contraseña</h3><a>';

            $mail->IsSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->SMTPDebug  = 1;
            $mail->SMTPAuth   = true;
            $mail->Username   = 'developer@grupoasistencia.com';
            $mail->Password   = 'Sga.jperdomo2021';
            $mail->SetFrom('developer@grupoasistencia.com', "Integradoor");
            $mail->AddReplyTo('no-reply@mycomp.com','no-reply');
            $mail->Subject = 'Integradoor - Cambio de contraseña';
            $mail->MsgHTML($body);

            $mail->AddAddress($correo, 'Julián');
            $mail->send();
        }
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['enviarcorreo'])) {
        $olvidocontrasenia = new OlvidoContrasenia();
        $olvidocontrasenia->guardarCodigo($data['correo']);
    }
    