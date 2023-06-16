<?php
include_once '../../config/dbconfig.php';
require 'categorias.php';

if ($_POST['dataString'] && $clasveh = $_POST['clasveh'] && $MarcaVeh = $_POST['MarcaVeh']) {
	$id = $_POST['dataString'];
	$clasveh = $_POST['clasveh'];
	$MarcaVeh = $_POST['MarcaVeh'];
	$edadVeh = $_POST['edadVeh'];

	$ejecutar = ejecutar($clasveh);


	switch ($ejecutar) {
			//-----------------------------------------------------------------------------------------------------
		case "MOTOCICLETA":
			$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY referencia2 ASC");
			$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));

			$contar = $stmt->rowCount();

			if ($contar > 1) {
?>

				<label>Referencia:</label>
				<select type="select" name="refe1" id="refe1" class="refe1 form-control" required>
					<option value="">Seleccione la Referencia</option>
					<?php

					$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
					$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<option value="<?php echo $row['referencia2']; ?>"><?php echo $row['referencia2']; ?></option>
					<?php
					}
					?>
				</select>

				<?php
			} else {

				$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
				$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
					<label>Segunda Referencia</label>
					<input type="text" class="refe1 form-control" required value="<?php echo $row['referencia2']; ?>" name="refe1" disabled>
				<?php
				}
			}



			break;
			//----------------------------------------------------------------------------------------------------
		case "AUTOMOVIL":
			$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
			$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));

			$contar = $stmt->rowCount();

			if ($contar > 1) {
				?>

				<label>Referencia:</label>
				<select type="select" name="refe1" class="refe1 form-control" required>
					<option value="">Seleccione la Referencia</option>
					<?php
					$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
					$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));

					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<option value="<?php echo $row['referencia2']; ?>"><?php echo $row['referencia2']; ?></option>
					<?php
					}
					?>
				</select>

				<?php
			} else {
				$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
				$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
					<label>Segunda Referencia</label>
					<input type="text" class="refe1 form-control" required value="<?php echo $row['referencia2']; ?>" name="refe1" disabled>
				<?php
				}
			}
			break;

			//----------------------------------------------------------------------------------------------------
		case "FURGONETA":
			$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
			$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));
			$contar = $stmt->rowCount();

			if ($contar > 1) {
				?>

				<label>Referencia:</label>
				<select type="select" name="refe1" class="refe1 form-control" required>
					<option value="">Seleccione la Referencia</option>
					<?php
					$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
					$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));

					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<option value="<?php echo $row['referencia2']; ?>"><?php echo $row['referencia2']; ?></option>
					<?php
					}
					?>
				</select>

				<?php
			} else {
				$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
				$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
					<label>Segunda Referencia</label>
					<input type="text" class="refe1 form-control" required value="<?php echo $row['referencia2']; ?>" name="refe1" disabled>
				<?php
				}
			}

			break;
			//---------------------------------------------------------------------------------------------------
		case "BUS / BUSETA / MICROBUS":
			$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
			$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));
			$contar = $stmt->rowCount();

			if ($contar > 1) {
				?>

				<label>Referencia:</label>
				<select type="select" name="refe1" class="refe1 form-control" required>
					<option value="">Seleccione la Referencia</option>
					<?php
					$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
					$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));

					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<option value="<?php echo $row['referencia2']; ?>"><?php echo $row['referencia2']; ?></option>
					<?php
					}
					?>
				</select>

				<?php
			} else {
				$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE clase=:ejecutar AND marca=:MarcaVeh AND referencia1=:id AND `$edadVeh` <> 0  GROUP BY referencia2 ORDER BY id_fasecolda");
				$stmt->execute(array(':id' => $id, ':ejecutar' => $ejecutar, ':MarcaVeh' => $MarcaVeh));
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
					<label>Segunda Referencia</label>
					<input type="text" class="refe1 form-control" required value="<?php echo $row['referencia2']; ?>" name="refe1" disabled>
				<?php
				}
			}
			break;
			//--------------------------------------------------------------------------------------------------
		case "clase='CAMIONETA REPAR' OR clase='CAMIONETA PASAJ.' OR clase='CAMPERO'":

			$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
			$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));
			//$stmt->execute(array(':id' => $_POST['dataString'], ':clasveh' => $_POST['clasveh']));
			$contar = $stmt->rowCount();

			if ($contar > 1) {
				?>

				<label>Referencia:</label>
				<select type="select" name="refe1" class="refe1  form-control">
					<option value="">Seleccione la Referencia</option>
					<?php
					$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
					$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));


					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<option value="<?php echo $row['referencia2']; ?>"><?php echo $row['referencia2']; ?></option>
					<?php
					}
					?>
				</select>

				<?php
			} else {
				$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
				$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
					<label>Segunda Referencia</label>
					<input type="text" class="refe1 form-control" required value="<?php echo $row['referencia2']; ?>" name="refe1" disabled>
				<?php
				}
			}
			break;
			//------------------------------------------------------------------------------------------------------
		case "clase='PICKUP DOBLE CAB' OR clase='PICKUP SENCILLA'":
			$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
			$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));

			$contar = $stmt->rowCount();

			if ($contar > 1) {
				?>

				<label>Referencia:</label>
				<select type="select" name="refe1" class="refe1 form-control" required>
					<option value="">Seleccione la Referencia</option>
					<?php
					$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
					$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));

					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<option value="<?php echo $row['referencia2']; ?>"><?php echo $row['referencia2']; ?></option>
					<?php
					}
					?>
				</select>

				<?php
			} else {
				$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
				$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
					<label>Referencia</label>
					<input type="text" class="refe1 form-control" required value="<?php echo $row['referencia2']; ?>" name="refe1" disabled>
				<?php
				}
			}
			break;
			//------------------------------------------------------------------------------------------------------
		case "clase='MOTOCARRO' OR clase='ISOCARRO'":

			$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
			$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));

			$contar = $stmt->rowCount();

			if ($contar > 1) {
				?>

				<label>Referencia:</label>
				<select type="select" name="refe1" class="refe1 form-control" required>
					<option value="">Seleccione la Referencia</option>
					<?php
					$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
					$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));

					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<option value="<?php echo $row['referencia2']; ?>"><?php echo $row['referencia2']; ?></option>
					<?php
					}
					?>
				</select>

				<?php
			} else {
				$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
				$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
					<label>Referencia</label>
					<input type="text" class="refe1 form-control" required value="<?php echo $row['referencia2']; ?>" name="refe1" disabled>
				<?php
				}
			}

			break;
			//-----------------------------------------------------------------------------------------------------
		case "clase='CAMION' OR clase='CARROTANQUE' OR clase='FURGON' OR clase='REMOLCADOR' OR clase='VOLQUETA' OR clase='UNIMOG'":

			$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
			$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));
			$contar = $stmt->rowCount();

			if ($contar > 1) {
				?>

				<label>Referencia:</label>
				<select type="select" name="refe1" class="refe1 form-control" required>
					<option value="">Seleccione la Referencia</option>
					<?php
					$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
					$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));

					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					?>
						<option value="<?php echo $row['referencia2']; ?>"><?php echo $row['referencia2']; ?></option>
					<?php
					}
					?>
				</select>

				<?php
			} else {
				$stmt = $DB_con->prepare("SELECT * FROM fasecolda WHERE  marca=:MarcaVeh AND referencia1=:id  AND `$edadVeh` <> 0 and (" . $ejecutar . ") GROUP BY referencia2 ORDER BY id_fasecolda");
				$stmt->execute(array(':id' => $id, ':MarcaVeh' => $MarcaVeh));
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
					<label>Referencia</label>
					<input type="text" class="refe1 form-control" required value="<?php echo $row['referencia2']; ?>" name="refe1" disabled>
<?php
				}
			}


			break;
			//-----------------------------------------------------------------------------------------------------	
	}
}

?>