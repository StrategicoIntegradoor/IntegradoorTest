<?php


require_once "../../modelos/conexion.php";

$producto = $_POST['producto'];



$stmt = Conexion::conectar()->prepare("UPDATE `asistencias` SET `RCE` = :RCE, `Deducible` = :Deducible, `pth` = :ptdh, `ppd` = :ppd, `pph` = :pph, `eventos` = :eventos, `amparopatrimonial` = :amparopatrimonial, `Grua` = :Grua, `Carrotaller` = :Carrotaller, `Asistenciajuridica` = :Asistenciajuridica, `Gastosdetransportept` = :Gastosdetransportept, `Gastosdetransportepp` = :Gastosdetransportepp, `Vehiculoreemplazopt` = :Vehiculoreemplazopt, `Vehiculoreemplazopp` = :Vehiculoreemplazopp, `Conductorelegido` = :Conductorelegido, `Transportevehiculorecuperdo` = :Transportevehiculorecuperdo, `Transportepasajerosaccidente` = :Transportepasajerosaccidente, `Transportepasajerosvarada` = :Transportepasajerosvarada, `Accidentespersonales` = :Accidentespersonales, `Pequeniosaccesorios` = :Pequeniosaccesorios, `Llantasestalladas` = :Llantasestalladas, `Perdidallaves` = :Perdidallaves WHERE `id_asistencias` = :producto");



$stmt->bindParam(":Deducible", $_POST['Deducible'], PDO::PARAM_STR);
$stmt->bindParam(":ptdh", $_POST['ptdh'], PDO::PARAM_STR);
$stmt->bindParam(":ppd", $_POST['ppd'], PDO::PARAM_STR);
$stmt->bindParam(":pph", $_POST['pph'], PDO::PARAM_STR);
$stmt->bindParam(":eventos", $_POST['eventos'], PDO::PARAM_STR);
$stmt->bindParam(":amparopatrimonial", $_POST['amparopatrimonial'], PDO::PARAM_STR);
$stmt->bindParam(":Grua", $_POST['Grua'], PDO::PARAM_STR);
$stmt->bindParam(":Carrotaller", $_POST['Carrotaller'], PDO::PARAM_STR);
$stmt->bindParam(":Asistenciajuridica", $_POST['Asistenciajuridica'], PDO::PARAM_STR);
$stmt->bindParam(":Gastosdetransportept", $_POST['Gastosdetransportept'], PDO::PARAM_STR);
$stmt->bindParam(":Gastosdetransportepp", $_POST['Gastosdetransportepp'], PDO::PARAM_STR);
$stmt->bindParam(":Vehiculoreemplazopt", $_POST['Vehiculoreemplazopt'], PDO::PARAM_STR);
$stmt->bindParam(":Vehiculoreemplazopp", $_POST['Vehiculoreemplazopp'], PDO::PARAM_STR);
$stmt->bindParam(":Conductorelegido", $_POST['Conductorelegido'], PDO::PARAM_STR);
$stmt->bindParam(":Transportevehiculorecuperdo", $_POST['Transportevehiculorecuperdo'], PDO::PARAM_STR);
$stmt->bindParam(":Transportepasajerosaccidente", $_POST['Transportepasajerosaccidente'], PDO::PARAM_STR);
$stmt->bindParam(":Transportepasajerosvarada", $_POST['Transportepasajerosvarada'], PDO::PARAM_STR);
$stmt->bindParam(":Accidentespersonales", $_POST['Accidentespersonales'], PDO::PARAM_STR);
$stmt->bindParam(":Pequeniosaccesorios", $_POST['Pequeniosaccesorios'], PDO::PARAM_STR);
$stmt->bindParam(":Llantasestalladas", $_POST['Llantasestalladas'], PDO::PARAM_STR);
$stmt->bindParam(":Perdidallaves", $_POST['Perdidallaves'], PDO::PARAM_STR);
$stmt->bindParam(":RCE", $_POST['RCE'], PDO::PARAM_INT);
$stmt->bindParam(":producto", $producto, PDO::PARAM_INT);

if($stmt->execute()){

    echo "ok";

}else{

    echo "error";

}


?>