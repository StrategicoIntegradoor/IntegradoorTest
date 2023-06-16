<?php

mb_internal_encoding("UTF-8");

require_once("../modelos/politicas.modelo.php");

class ControladorPoliticas{

    function traerPoliticas(){
        
        $modelo = ModeloPoliticas::mdlMostrarPoliticas('S');
        return $modelo; 

        }
    
    function traerEstados(){

        $respuesta = ModeloPoliticas::mdlMostrarEstados();
        return $respuesta;
        
        }

    function traerTipos(){

        $respuesta = ModeloPoliticas::mdlMostrarTipos();
        return $respuesta;
        
        }

    function ctrEliminarPoliticas($id, $tipo){

        if (isset($tipo)){

            Switch($tipo){
                case 1:

                    $respuesta = ModeloPoliticas::mdlEliminarPolitica($id);
                    return $respuesta;
        
                break;
                case 2:

                    $respuesta = ModeloPoliticas::mdlEliminarEstado($id);
                    return $respuesta;
            
                break;
                case 3:

                    $respuesta = ModeloPoliticas::mdlEliminarTipo($id);
                    return $respuesta;
            
                break;
            
            }
        }
    }

    function ctrAgregarPoliticas($descripcion, $renovacion, $mora, $cancelacion, $tipo, $id){

        if (isset($tipo)){

            Switch($tipo){
                case 1:

                    $respuesta = ModeloPoliticas::mdlAgregarPolitica($descripcion, $renovacion, $mora, $cancelacion);
                    return $respuesta;
        
                break;
                case 4:

                    $respuesta = ModeloPoliticas::mdlEditarPolitica($descripcion, $renovacion, $mora, $cancelacion, $id);
                    return $respuesta;
            
                break;
            
            }
        }
    }

    function ctrAgregarEstados($nombre, $descripcion, $tipo, $id){
        Switch($tipo){
            case 2:
            
                $respuesta = ModeloPoliticas::mdlAgregarEstado($nombre, $descripcion);
                return $respuesta;
        
            break;
            case 5:

                $respuesta = ModeloPoliticas::mdlEditarEstado($nombre, $descripcion, $id);
                return $respuesta;
        
            break;
        }
    }

    function ctrAgregarTipos($modalidad, $duracion, $estado, $descripcion, $tipo, $id){
        Switch($tipo){
            case 3:
                
                $respuesta = ModeloPoliticas::mdlAgregarTipo($modalidad, $duracion, $estado, $descripcion);
                return $respuesta;
        
            break;
            case 6:

                $respuesta = ModeloPoliticas::mdlEditarTipo($modalidad, $duracion, $estado, $descripcion, $id);
                return $respuesta;
        
            break;
        }
    }
}

    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        $tipo = $_GET['tipo'];
        Switch ($tipo){
            case 1:

                $politicas = new ControladorPoliticas();
                $politicas->traerPoliticas();

            break;
            case 2:

                $passwordChange = new ControladorPoliticas();
	            $passwordChange->traerEstados();

            break;

            case 3:
                
                $passwordChange = new ControladorPoliticas();
	            $passwordChange->traerTipos();

            break;

        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'DELETE'){

        $data = json_decode(file_get_contents('php://input'), true);
        $tipo = $_GET['tipo'];
        $delete = new ControladorPoliticas();
        $delete->ctrEliminarPoliticas($data['id'],$tipo); 
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $data = json_decode(file_get_contents('php://input'), true);
        $tipo = $_GET['tipo'];
        
        if($tipo == 1 or $tipo == 4){
            $insert = new ControladorPoliticas();
            $insert->ctrAgregarPoliticas($data['descripcion'],$data['renovacion'],$data['mora'],$data['cancelacion'],$tipo,$data['id']); 
        }else if($tipo == 2 or $tipo == 5){
            $insert = new ControladorPoliticas();
            $insert->ctrAgregarEstados($data['nombre'],$data['descripcion'],$tipo,$data['id']);
        }else if($tipo == 3 or $tipo == 6){
            
            $insert = new ControladorPoliticas();
            $insert->ctrAgregarTipos($data['modalidad'],$data['duracion'],$data['estado'],$data['descripcion'],$tipo, $data['id']);
        }
    }
     

    
    

	