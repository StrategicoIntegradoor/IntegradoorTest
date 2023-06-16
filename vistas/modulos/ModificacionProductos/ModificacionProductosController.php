<?php

include_once 'ModificacionProductosModel.php';

$modificacionProductosController = 
    new MofificacionProductosController();
call_user_func(array($modificacionProductosController, 
    $_POST['metodo']));

class MofificacionProductosController
{

    private $modificacionProductosModel;

    function __construct()
    {
        $this->modificacionProductosModel = 
            new ModificacionProductosModel();
    }

    public function Obtener()
    {
        try {
            $res = $this->modificacionProductosModel->Obtener();
        } catch (Exception $ex) {
            return false;
        }

        print_r(json_encode($res, JSON_UNESCAPED_UNICODE));
    }

    public function ObtenerPorId() 
    {
        $id = $_POST['idAsistencia'];
        try {
            $res = $this->modificacionProductosModel->
                ObtenerPorId($id);
        } catch (Exception $ex) {
            return false;
        }
        
        print_r(json_encode($res, JSON_UNESCAPED_UNICODE));
    }

    public function Crear()
    {
        try {
            $result = $this->modificacionProductosModel->
                Crear($_POST);
            if ($result) { 
                print_r(json_encode(true, JSON_UNESCAPED_UNICODE));
            }
        } catch (Exception $ex) {
            return print_r(json_encode(false, JSON_UNESCAPED_UNICODE));
        }
    }

    public function Editar()
    {
        try {
            $result = $this->modificacionProductosModel->  
                Editar($_POST, $_POST['idAsistencia']);
            if ($result) {
                print_r(json_encode(true, JSON_UNESCAPED_UNICODE));
            }
        } catch (Exception $ex) {
            return print_r(json_encode(false, JSON_UNESCAPED_UNICODE));
        }
    }

    public function Eliminar() {
        try {
            $result = $this->modificacionProductosModel->
                Eliminar($_POST['idAsistencia']);
            if ($result) {
                print_r(json_encode(true, JSON_UNESCAPED_UNICODE));
            }
        } catch (Exception $ex) {
            print_r(json_encode(true, JSON_UNESCAPED_UNICODE));
        }
    }

    public function Activar()
    {
    }

    public function Desactivar()
    {
    }
}
