<?php

mb_internal_encoding("UTF-8");

require_once("../modelos/planes.modelo.php");

class controladorPlanes {

    function ctrTraerPlanes(){

        $request = ModeloPlanes::mdlTraerPlanes();
        return $request; 

    }

    function ctrEliminarPlanes($id){

        $request = ModeloPlanes::mdlEliminarPlan($id);
        return $request;

    }

    function ctrAgregarPlanes($nombre, $cantCot, $cantUsu, $cantUsuWeb, $iframe, $freeCharges, $valor){

        $request = ModeloPlanes::mdlAgregarPlan($nombre, $cantCot, $cantUsu, $cantUsuWeb, $iframe, $freeCharges, $valor);
        return $request;
    }

    function ctrEditarPlanes($nombre, $cantCot, $cantUsu, $cantUsuWeb, $iframe, $freeCharges, $valor, $id){

        $request = ModeloPlanes::mdlEditarPlan($nombre, $cantCot, $cantUsu, $cantUsuWeb, $iframe, $freeCharges, $valor, $id);
        return $request;

    }

}


if($_SERVER['REQUEST_METHOD'] === 'GET'){

    $tipo = $_GET['tipo'];
    Switch ($tipo){
        case 1:

            $politicas = new ControladorPlanes();
            $politicas->ctrTraerPlanes();

        break;
    }

}


if($_SERVER['REQUEST_METHOD'] === 'DELETE'){

    $data = json_decode(file_get_contents('php://input'), true);
    $tipo = $_GET['tipo'];
    $delete = new ControladorPlanes();
    $delete->ctrEliminarPlanes($data['id'],$tipo); 
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $data = json_decode(file_get_contents('php://input'), true);
    $tipo = $_GET['tipo'];

    if($tipo == 1){

        $insert = new ControladorPlanes();
        $insert->ctrAgregarPlanes($data['nombre'],$data['cantCot'],$data['cantUsu'],$data['cantUsuWeb'], $data['iframe'], $data['freeCharges'],
        $data['valor']); 

    }else if($tipo == 2){

        $update = new ControladorPlanes();
        $update->ctrEditarPlanes($data['nombre'],$data['cantCot'],$data['cantUsu'],$data['cantUsuWeb'], $data['iframe'], $data['freeCharges'],
        $data['valor'],$data['id']);
    }


}