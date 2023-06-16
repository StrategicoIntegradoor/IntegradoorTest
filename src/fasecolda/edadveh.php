<?php
//require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../config/dbconfig.php"); //Contiene funcion que conecta a la base de datos

require 'categorias.php';

//require 'funcionesBD.php';

if ($_POST['dataString'] && $clasveh = $_POST['clasveh']) {
    $id = $_POST['dataString'];

    if ($id == "ALFA") {
        $id = "ALFA ROMERO";
    } else {
    }

    $clasveh = $_POST['clasveh'];

    $ejecutar = ejecutar($clasveh);

    $sql = $DB_con->prepare("select distinct COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = 'fasecolda' and COLUMN_NAME  between '1000' and '2025'");
    $sql->execute();
    $rows = $sql->rowCount();

    //for para guardar la consulta en un arreglo
    for ($i = 0; $i < $rows; $i++) {
        $verConfig = $sql->fetch(PDO::FETCH_ASSOC);
        $CargaConfig[$i] = $verConfig["COLUMN_NAME"];
    }

    log($CargaConfig);
    $cantidad = count($CargaConfig);

    switch ($ejecutar) {

        case "MOTOCICLETA":

            for ($k = 0; $k < ($cantidad); $k++) {
                $vector[$k] = $CargaConfig[$k];

                $sql2 = $DB_con->prepare("SELECT `" . $vector[$k] . "` FROM fasecolda where clase=:ejecutar AND  MARCA=:id and `" . $vector[$k] . "` <>0");

                $sql2->execute(array(':id' => $id, ':ejecutar' => $ejecutar));
                $v = $sql2->fetch(PDO::FETCH_NUM);
                //condicional para guardar la posicion de los campos diferentes a cero de la consulta
                if ($v[0] > 0) {
                    $valor = $valor + 1;
                    $val[$valor - 1] = $k;
                }
            }

            break;
            //----------------------------------------------------------------------------------------------------          
        case "AUTOMOVIL":

            for ($k = 0; $k < ($cantidad); $k++) {
                $vector[$k] = $CargaConfig[$k];

                $sql2 = $DB_con->prepare("SELECT `" . $vector[$k] . "` FROM fasecolda where clase=:ejecutar AND  MARCA=:id and `" . $vector[$k] . "` <>0");

                $sql2->execute(array(':id' => $id, ':ejecutar' => $ejecutar));
                $v = $sql2->fetch(PDO::FETCH_NUM);
                //condicional para guardar la posicion de los campos diferentes a cero de la consulta
                if ($v[0] > 0) {
                    $valor = $valor + 1;
                    $val[$valor - 1] = $k;
                }
            }


            break;
            //-----------------------------------------------------------------------------------------------------
        case "clase='CAMIONETA REPAR' OR clase='CAMIONETA PASAJ.' OR clase='CAMPERO'":

            for ($k = 0; $k < ($cantidad); $k++) {
                $vector[$k] = $CargaConfig[$k];

                $sql2 = $DB_con->prepare("SELECT `" . $vector[$k] . "` FROM fasecolda where  MARCA=:id and `" . $vector[$k] . "` <>0 AND (" . $ejecutar . ")");

                $sql2->execute(array(':id' => $id));
                $v = $sql2->fetch(PDO::FETCH_NUM);
                //condicional para guardar la posicion de los campos diferentes a cero de la consulta
                if ($v[0] > 0) {
                    $valor = $valor + 1;
                    $val[$valor - 1] = $k;
                }
            }

            break;
            //------------------------------------------------------------------------------------------------------
        case "clase='PICKUP DOBLE CAB' OR clase='PICKUP SENCILLA'":
            for ($k = 0; $k < ($cantidad); $k++) {
                $vector[$k] = $CargaConfig[$k];

                $sql2 = $DB_con->prepare("SELECT `" . $vector[$k] . "` FROM fasecolda where  MARCA=:id and `" . $vector[$k] . "` <>0 AND (" . $ejecutar . ")");

                $sql2->execute(array(':id' => $id));
                $v = $sql2->fetch(PDO::FETCH_NUM);
                //condicional para guardar la posicion de los campos diferentes a cero de la consulta
                if ($v[0] > 0) {
                    $valor = $valor + 1;
                    $val[$valor - 1] = $k;
                }
            }

            break;
            //------------------------------------------------------------------------------------------------------
        case "clase='MOTOCARRO' OR clase='ISOCARRO'":

            for ($k = 0; $k < ($cantidad); $k++) {
                $vector[$k] = $CargaConfig[$k];

                $sql2 = $DB_con->prepare("SELECT `" . $vector[$k] . "` FROM fasecolda where  MARCA=:id and `" . $vector[$k] . "` <>0 AND (" . $ejecutar . ")");

                $sql2->execute(array(':id' => $id));
                $v = $sql2->fetch(PDO::FETCH_NUM);
                //condicional para guardar la posicion de los campos diferentes a cero de la consulta
                if ($v[0] > 0) {
                    $valor = $valor + 1;
                    $val[$valor - 1] = $k;
                }
            }

            break;
            //------------------------------------------------------------------------------------------------------
        case 'FURGONETA':
            for ($k = 0; $k < ($cantidad); $k++) {
                $vector[$k] = $CargaConfig[$k];

                $sql2 = $DB_con->prepare("SELECT `" . $vector[$k] . "` FROM fasecolda where clase=:ejecutar AND  MARCA=:id and `" . $vector[$k] . "` <>0");

                $sql2->execute(array(':id' => $id, ':ejecutar' => $ejecutar));
                $v = $sql2->fetch(PDO::FETCH_NUM);
                //condicional para guardar la posicion de los campos diferentes a cero de la consulta
                if ($v[0] > 0) {
                    $valor = $valor + 1;
                    $val[$valor - 1] = $k;
                }
            }
            break;
            //------------------------------------------------------------------------------------------------------

        case "BUS / BUSETA / MICROBUS":
            for ($k = 0; $k < ($cantidad); $k++) {
                $vector[$k] = $CargaConfig[$k];

                $sql2 = $DB_con->prepare("SELECT `" . $vector[$k] . "` FROM fasecolda where clase=:ejecutar AND  MARCA=:id and `" . $vector[$k] . "` <>0");

                $sql2->execute(array(':id' => $id, ':ejecutar' => $ejecutar));
                $v = $sql2->fetch(PDO::FETCH_NUM);
                //condicional para guardar la posicion de los campos diferentes a cero de la consulta
                if ($v[0] > 0) {
                    $valor = $valor + 1;
                    $val[$valor - 1] = $k;
                }
            }
            break;
            //------------------------------------------------------------------------------------------------------
        case "clase='CAMION' OR clase='CARROTANQUE' OR clase='FURGON' OR clase='REMOLCADOR' OR clase='VOLQUETA' OR clase='UNIMOG'":

            for ($k = 0; $k < ($cantidad); $k++) {
                $vector[$k] = $CargaConfig[$k];

                $sql2 = $DB_con->prepare("SELECT `" . $vector[$k] . "` FROM fasecolda where  MARCA=:id and `" . $vector[$k] . "` <>0 AND (" . $ejecutar . ")");

                $sql2->execute(array(':id' => $id));
                $v = $sql2->fetch(PDO::FETCH_NUM);
                //condicional para guardar la posicion de los campos diferentes a cero de la consulta
                if ($v[0] > 0) {
                    $valor = $valor + 1;
                    $val[$valor - 1] = $k;
                }
            }

            break;
            //------------------------------------------------------------------------------------------------------
    }


    $valo = count($val);

    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------

    $query = "SELECT * from fasecolda";
    $resultado = mysqli_query($enlace, $query);
    $finfo = mysqli_fetch_field_direct($resultado, 1);

    //for para recorrer sacar las possiciones de los campos.
    for ($j = 0; $j < $valo; $j++) {
        $finfos = mysqli_fetch_field_direct($resultado, ($val[$j] + 12));
        $da[$j] = $finfos->name;
    }

    // Contador de campo arreglo 
    $suma = count($da);
?>
    <option value="">Seleccione el Modelo</option><?php
                                                    for ($p = 0; $p < $suma; $p++) {
                                                    ?>
        <option value="<?php echo $da[$p] ?>"><?php echo $da[$p] ?></option>
<?php
                                                    }

                                                    // echo "</select>";


                                                }


?>