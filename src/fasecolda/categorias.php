<?php
	function ejecutar($variable){
		
		switch ($variable) {
			case "MOTOS":
				$nombre="MOTOCICLETA";
				break;
			
			case "AUTOMOVIL":
				$nombre="AUTOMOVIL";
				break;

			case "CAMIONETA":
				$nombre="clase='CAMIONETA REPAR' OR clase='CAMIONETA PASAJ.' OR clase='CAMPERO'";
				break;

			case 'PICKUP':
				$nombre="clase='PICKUP DOBLE CAB' OR clase='PICKUP SENCILLA'";
				break;

			case 'MOTOCARRO':
				$nombre="clase='MOTOCARRO' OR clase='ISOCARRO'";
				break;

				
			case 'FURGONETA':
				$nombre="FURGONETA";
				break;

			case 'BUS':
				$nombre="BUS / BUSETA / MICROBUS";
				break;

			case 'PESADO':
				$nombre="clase='CAMION' OR clase='CARROTANQUE' OR clase='FURGON' OR clase='REMOLCADOR' OR clase='VOLQUETA' OR clase='UNIMOG'";
				break;
		}
		

		return $nombre;
	}


?>