<?php

/* Conectar a la base de datos*/
require_once("../Config/DB.php");
require_once("../Config/Conexion.php");

class ModificacionProductosModel
{

    public function Obtener()
    {
        $sql = "SELECT * FROM asistencias";
        $res = mysqli_query(Conexion::GetConexion(), $sql);
        $arr = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $arr[] = $row;
        }
        if (count($arr) < 1) {
            throw new Exception('No se obtuvieron asistencias');
        }

        return $arr;
    }

    public function ObtenerPorId($id)
    {
        $sql = "SELECT * FROM asistencias WHERE id_asistencias = $id";
        $res = mysqli_query(Conexion::GetConexion(), $sql);
        if ($res->num_rows < 1) {
            throw new Exception('No se pudo obtener la asistencia por id');
        }

        return mysqli_fetch_assoc($res);
    }

    public function Crear($_post)
    {
        $aseguradora = $_post['aseguradora'];
        $producto = $_post['producto'];
        $rce = $_post['rce'];
        $deducible = $_post['deducible'];
        $pth = $_post['pth'];
        $ppd = $_post['ppd'];
        $pph = $_post['pph'];
        $eventos = $_post['eventos'];
        $amparopatrimonial = $_post['amparoPatrimonial'];
        $grua = $_post['grua'];
        $carroTaller = $_post['carroTaller'];
        $asistenciaJuridica = $_post['asistenciaJuridica'];
        $gastosDeTransportePt = $_post['gastosDeTransportePt'];
        $gastosDeTransportePp = $_post['gastosDeTransportePp'];
        $conductorElegido = $_post['conductorElegido'];
        $transporteVehiculoRecuperado = $_post['transporteVehiculoRecuperado'];
        $transportePasajerosVarada = $_post['transportePasajerosVarada'];
        $accidentesPersonales = $_post['accidentesPersonales'];
        $pequeniosAccesorios = $_post['pequeniosAccesorios'];
        $llantasEstalladas = $_post['llantasEstalladas'];
        $perdidaLlaves = $_post['perdidaLlaves'];
        $color = $_post['color'];
        $rceExceso = $_post['rceExceso'];
        $otroDeducible = $_post['otroDeducible'];
        $asistenciaNacional = $_post['asistenciaNacional'];
        $auxilioPerdidaPatrimonial = $_post['auxilioPerdidaPatrimonial'];
        $auxilioPerdidaPatrimonialTerrorismo = $_post['auxilioPerdidaPatrimonialTerrorismo'];
        $perjuiciosExtraPatrimoniales = $_post['perjuiciosExtraPatrimoniales'];
        $paralizacionVehiculo = $_post['paralizacionVehiculo'];
        $obligacionFinanciera = $_post['obligacionFinanciera'];
        $gastosFunerarios = $_post['gastosFunerarios'];
        $gastosRecuperacion = $_post['gastosRecuperacion'];
        $gastosGrua = $_post['gastosGrua'];
        $vehiculoReemplazoPt = $_post['vehiculoReemplazoPt'];
        $vehiculoReemplazoPp = $_post['vehiculoReemplazoPp'];
        $transportePasajerosAccidente = $_post['transportePasajerosAccidente'];

        $sql = "INSERT INTO asistencias (id_asistencias, aseguradora, producto, rce, deducible, pth, ppd, pph, eventos, amparopatrimonial, Grua, Carrotaller, Asistenciajuridica, Gastosdetransportept, Gastosdetransportepp, Vehiculoreemplazopt, Vehiculoreemplazopp, Conductorelegido, Transportevehiculorecuperdo, Transportepasajerosaccidente, Transportepasajerosvarada, Accidentespersonales, Pequeniosaccesorios, Llantasestalladas, Perdidallaves, color, rceexceso, Deducible2, asistenciaNacional, auxilioPerdidaPatrimonial, auxilioperdidapatrimonialterrorismo, PerjuiciosExtrapatrimoniales, paralizacionvehiculo, obligacionfinanciera, gastosfunerarios, gastosrecuperacion, gastosgrua) 
        VALUES (NULL, '$aseguradora', '$producto', '$rce', '$deducible', '$pth', '$ppd', '$pph', '$eventos', '$amparopatrimonial', '$grua', '$carroTaller', '$asistenciaJuridica', '$gastosDeTransportePt', '$gastosDeTransportePp', '$vehiculoReemplazoPt', '$vehiculoReemplazoPp', '$conductorElegido', '$transporteVehiculoRecuperado', '$transportePasajerosAccidente', '$transportePasajerosVarada', '$accidentesPersonales', '$pequeniosAccesorios', '$llantasEstalladas', '$perdidaLlaves', '$color', '$rceExceso', '$otroDeducible', '$asistenciaNacional', '$auxilioPerdidaPatrimonial', '$auxilioPerdidaPatrimonialTerrorismo', '$perjuiciosExtraPatrimoniales', '$paralizacionVehiculo', '$obligacionFinanciera', '$gastosFunerarios', '$gastosRecuperacion', '$gastosGrua')";
        $res = mysqli_query(Conexion::GetConexion(), $sql);
        if (!$res) {
            throw new Exception('No se guardo correctamento');
        } else {
            return true;
        }
    }

    public function Editar($_post, $id)
    {
        $aseguradora = $_post['aseguradora'];
        $producto = $_post['producto'];
        $rce = $_post['rce'];
        $deducible = $_post['deducible'];
        $pth = $_post['pth'];
        $ppd = $_post['ppd'];
        $pph = $_post['pph'];
        $eventos = $_post['eventos'];
        $amparopatrimonial = $_post['amparoPatrimonial'];
        $grua = $_post['grua'];
        $carroTaller = $_post['carroTaller'];
        $asistenciaJuridica = $_post['asistenciaJuridica'];
        $gastosDeTransportePt = $_post['gastosDeTransportePt'];
        $gastosDeTransportePp = $_post['gastosDeTransportePp'];
        $conductorElegido = $_post['conductorElegido'];
        $transporteVehiculoRecuperado = $_post['transporteVehiculoRecuperado'];
        $transportePasajerosVarada = $_post['transportePasajerosVarada'];
        $accidentesPersonales = $_post['accidentesPersonales'];
        $pequeniosAccesorios = $_post['pequeniosAccesorios'];
        $llantasEstalladas = $_post['llantasEstalladas'];
        $perdidaLlaves = $_post['perdidaLlaves'];
        $color = $_post['color'];
        $rceExceso = $_post['rceExceso'];
        $otroDeducible = $_post['otroDeducible'];
        $asistenciaNacional = $_post['asistenciaNacional'];
        $auxilioPerdidaPatrimonial = $_post['auxilioPerdidaPatrimonial'];
        $auxilioPerdidaPatrimonialTerrorismo = $_post['auxilioPerdidaPatrimonialTerrorismo'];
        $perjuiciosExtraPatrimoniales = $_post['perjuiciosExtraPatrimoniales'];
        $paralizacionVehiculo = $_post['paralizacionVehiculo'];
        $obligacionFinanciera = $_post['obligacionFinanciera'];
        $gastosFunerarios = $_post['gastosFunerarios'];
        $gastosRecuperacion = $_post['gastosRecuperacion'];
        $gastosGrua = $_post['gastosGrua'];
        $vehiculoReemplazoPt = $_post['vehiculoReemplazoPt'];
        $vehiculoReemplazoPp = $_post['vehiculoReemplazoPp'];
        $transportePasajerosAccidente = $_post['transportePasajerosAccidente'];

        try {
            $asistencia = $this->ObtenerPorId($id);
        } catch (Exception $ex) {
            return false;
        }

        $sql = "UPDATE asistencias SET aseguradora = '$aseguradora', 
                                    producto = '$producto', rce = '$rce', deducible = '$deducible',
                                    pth = '$pth', ppd = '$ppd', pph = '$pph', eventos = '$eventos',
                                    amparopatrimonial = '$amparopatrimonial', Grua = '$grua', 
                                    Carrotaller = '$carroTaller', Asistenciajuridica = '$asistenciaJuridica',
                                    Gastosdetransportept = '$gastosDeTransportePt', Gastosdetransportepp = '$gastosDeTransportePp',
                                    Vehiculoreemplazopt = '$vehiculoReemplazoPt', Vehiculoreemplazopp = '$vehiculoReemplazoPp', 
                                    Conductorelegido = '$conductorElegido', Transportevehiculorecuperdo = '$transporteVehiculoRecuperado',
                                    Transportepasajerosaccidente = '$transportePasajerosAccidente', Transportepasajerosvarada = '$transportePasajerosVarada',
                                    Accidentespersonales = '$accidentesPersonales', Pequeniosaccesorios = '$pequeniosAccesorios',
                                    Llantasestalladas = '$llantasEstalladas', Perdidallaves = '$perdidaLlaves',
                                    color = '$color', rceexceso = '$rceExceso', Deducible2 = '$otroDeducible', 
                                    asistenciaNacional = '$asistenciaNacional', auxilioPerdidaPatrimonial = '$auxilioPerdidaPatrimonial',
                                    auxilioperdidapatrimonialterrorismo = '$auxilioPerdidaPatrimonialTerrorismo', 
                                    PerjuiciosExtrapatrimoniales = '$perjuiciosExtraPatrimoniales', paralizacionvehiculo = '$paralizacionVehiculo',
                                    obligacionfinanciera = '$obligacionFinanciera', gastosfunerarios = '$gastosFunerarios', 
                                    gastosrecuperacion = '$gastosRecuperacion', gastosgrua = '$gastosGrua'
                                    WHERE id_asistencias = $id";
        $res = mysqli_query(Conexion::GetConexion(), $sql);
        if (!$res) {
            throw new Exception('No se actualizo correctamente');
        } else {
            return true;
        }
    }

    public function Eliminar($id) {
        $sql = "DELETE FROM asistencias 
                WHERE id_asistencias = $id";
        $res = mysqli_query(Conexion::GetConexion(), $sql);
        if (!$res) {
            throw new Exception('No se elimino correctamente');
        } else {
            return true;
        }
    }

    public function Activar()
    {
    }

    public function Desactivar()
    {
    }
}
