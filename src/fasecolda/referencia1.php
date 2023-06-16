<?php
	include_once '../../config/dbconfig.php';
	require 'categorias.php';
	
	if($_POST['dataString'] && $clasveh=$_POST['clasveh'] && $MarcaVeh=$_POST['MarcaVeh'])
	{
		$id=$_POST['dataString'];
		$clasveh=$_POST['clasveh'];
		$MarcaVeh=$_POST['MarcaVeh'];

		$ejecutar=ejecutar($clasveh);

		switch ($ejecutar) {
//-----------------------------------------------------------------------------------------------------
			case "MOTOCICLETA":
				$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND `$id` <> 0  GROUP BY referencia1 ORDER BY referencia1 ASC");
				$stmt->execute(array(':ejecutar' => $ejecutar, ':MarcaVeh'=>$MarcaVeh));
			
				?>
				<select type="select" name="lineaVehh" class="lineaVeh" required>
				<option value="">Seleccione la Linea</option><?php
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								?>
								<option value="<?php echo $row['referencia1']; ?>"><?php echo $row['referencia1']; ?></option>
						 	
						<?php
						}
						?>
					</select>
					<?php
					break;
//----------------------------------------------------------------------------------------------------
			 case "AUTOMOVIL":
			 	$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND `$id` <> 0  GROUP BY referencia1 ORDER BY id_fasecolda");
				$stmt->execute(array(':ejecutar' => $ejecutar, ':MarcaVeh'=>$MarcaVeh));

				?>
				<select type="select" name="lineaVeh" class="lineaVeh" required>
				<option value="">Seleccione la Linea</option><?php
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								?>
								<option value="<?php echo $row['referencia1']; ?>"><?php echo $row['referencia1']; ?></option>
						 	
						<?php
						}
						?>
					</select>
					<?php
			 	break;

//----------------------------------------------------------------------------------------------------
			 	case "FURGONETA":
			 		$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND `$id` <> 0  GROUP BY referencia1 ORDER BY id_fasecolda");
					$stmt->execute(array(':ejecutar' => $ejecutar, ':MarcaVeh'=>$MarcaVeh));
				//$stmt->execute(array(':id' => $_POST['dataString'], ':clasveh' => $_POST['clasveh']));
					?>
					<select type="select" name="lineaVeh" class="lineaVeh" required>
						<option value="">Seleccione la Linea</option><?php
						while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								?>
								<option value="<?php echo $row['referencia1']; ?>"><?php echo $row['referencia1']; ?></option>
						 	
						<?php
						}
						?>
					</select>
					<?php
			 		break;
//---------------------------------------------------------------------------------------------------
			 	case "BUS / BUSETA / MICROBUS":
			 		$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND `$id` <> 0  GROUP BY referencia1 ORDER BY id_fasecolda");
						$stmt->execute(array(':ejecutar' => $ejecutar, ':MarcaVeh'=>$MarcaVeh));
					//$stmt->execute(array(':id' => $_POST['dataString'], ':clasveh' => $_POST['clasveh']));
					?>
					<select type="select" name="lineaVeh" class="lineaVeh" required>
						<option value="">Seleccione la Linea</option><?php
						while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								?>
								<option value="<?php echo $row['referencia1']; ?>"><?php echo $row['referencia1']; ?></option>
						 	
						<?php
						}
						?>
					</select>
					<?php
			 		break;
//--------------------------------------------------------------------------------------------------
			 	case "clase='CAMIONETA REPAR' OR clase='CAMIONETA PASAJ.' OR clase='CAMPERO'":
                
	                $stmt = $DB_con->prepare("SELECT * FROM fasecolda where marca=:MarcaVeh AND `$id` <> 0 and (".$ejecutar.") GROUP BY referencia1");
							$stmt->execute(array(':MarcaVeh'=>$MarcaVeh));
		
						?>
					<select type="select" name="lineaVeh" class="lineaVeh" required>
						<option value="">Seleccione la Linea</option><?php
						while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								?>
								<option value="<?php echo $row['referencia1']; ?>"><?php echo $row['referencia1']; ?></option>
						 	
						<?php
						}
						?>
					</select>
					<?php              
                break;
//------------------------------------------------------------------------------------------------------
            case "clase='PICKUP DOBLE CAB' OR clase='PICKUP SENCILLA'":
               	$stmt = $DB_con->prepare("SELECT * FROM fasecolda where marca=:MarcaVeh AND `$id` <> 0 and (".$ejecutar.") GROUP BY referencia1");
				$stmt->execute(array(':MarcaVeh'=>$MarcaVeh));
	//$stmt->execute(array(':id' => $_POST['dataString'], ':clasveh' => $_POST['clasveh']));
				?>
				<select type="select" name="lineaVeh" class="lineaVeh" required>
						<option value="">Seleccione la Linea</option><?php
						while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								?>
								<option value="<?php echo $row['referencia1']; ?>"><?php echo $row['referencia1']; ?></option>
						 	
						<?php
						}
						?>
					</select>
					<?php                  
                break;
//------------------------------------------------------------------------------------------------------
            case "clase='MOTOCARRO' OR clase='ISOCARRO'":

                $stmt = $DB_con->prepare("SELECT * FROM fasecolda where marca=:MarcaVeh AND `$id` <> 0 and (".$ejecutar.") GROUP BY referencia1");
				$stmt->execute(array(':MarcaVeh'=>$MarcaVeh));
				//$stmt->execute(array(':id' => $_POST['dataString'], ':clasveh' => $_POST['clasveh']));
				?>
				<select type="select" name="lineaVeh" class="lineaVeh" required>
						<option value="">Seleccione la Linea</option><?php
						while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								?>
								<option value="<?php echo $row['referencia1']; ?>"><?php echo $row['referencia1']; ?></option>
						 	
						<?php
						}
						?>
					</select>
					<?php

                break;
//-----------------------------------------------------------------------------------------------------
			case "clase='CAMION' OR clase='CARROTANQUE' OR clase='FURGON' OR clase='REMOLCADOR' OR clase='VOLQUETA' OR clase='UNIMOG'":

	                $stmt = $DB_con->prepare("SELECT * FROM fasecolda where marca=:MarcaVeh AND `$id` <> 0 and (".$ejecutar.") GROUP BY referencia1");
					$stmt->execute(array(':MarcaVeh'=>$MarcaVeh));
					//$stmt->execute(array(':id' => $_POST['dataString'], ':clasveh' => $_POST['clasveh']));
					?>
					<select type="select" name="lineaVeh" class="lineaVeh" required>
						<option value="">Seleccione la Linea</option><?php
						while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
								?>
								<option value="<?php echo $row['referencia1']; ?>"><?php echo $row['referencia1']; ?></option>
						 	
						<?php
						}
						?>
					</select>
					<?php

	                break;
//-----------------------------------------------------------------------------------------------------	
		}






	}



	

?>