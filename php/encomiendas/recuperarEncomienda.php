<?php 

	//Parametro get con la inyeccion.
    $id = $_GET['idGuia'];

    //Inicializacion de variables
    $idGuia = '';
    $volumen = '';
    $fechaEnvio = '';
    $horaEnvio = '';
    $idEmpleado = '';
    $idEmisor = '';
    $nombreEmisor = '';
    $idReceptor = '';
    $nombreReceptor = '';
    $idViaje = '';
    $idPaisOrigen = '';
    $nombrePaisOrigen = '';
    $idDeptoOrigen = '';
    $nombreDeptoOrigen = '';
    $idCiudadOrigen = '';
    $nombreCiudadOrigen = '';
    $idPaisDestino = '';
    $nombrePaisDestino = '';
    $idDeptoDestino = '';
    $nombreDeptoDestino = '';
    $idCiudadDestino = '';
    $nombreCiudadDestino = '';
    $fechaSalida = '';
    $horaSalida = '';
    $fechaLlegada = '';
    $horaLLegada = '';
    $idBus = '';
    $idTarifa = '';
    $precio = '';
    $reclamada = '';
	
	//Consulta vulnerable, al hacer una inyección sería: 
	//		SELECT * FROM v_Encomienda WHERE Id_Guia = '1'; {CONSULTA SQL INYECTADA}'
	//Cerrando la consulta inicial con ';

    $sql = "SELECT * FROM v_Encomienda WHERE Id_Guia = '" . $id . "';"; 
    
		if($conexion->multi_query($sql)){
			do {
				if ($result = $conexion->store_result()){
					
					while ($row = $result->fetch_row()) { 
						$idGuia = $row[0];
						$volumen = $row[1]; 
						$fechaEnvio = $row[2]; 
						$horaEnvio = $row[3]; 
						$idEmpleado = $row[4]; 
						$idEmisor = $row[5]; 
						$nombreEmisor = $row[6]; 
						$idReceptor = $row[7]; 
						$nombreReceptor = $row[8]; 
						$idViaje = $row[9]; 
						$idPaisOrigen = $row[10]; 
						$nombrePaisOrigen = $row[11]; 
						$idDeptoOrigen = $row[12]; 
						$nombreDeptoOrigen = $row[13]; 
						$idCiudadOrigen = $row[14]; 
						$nombreCiudadOrigen = $row[15]; 
						$idPaisDestino = $row[16]; 
						$nombrePaisDestino = $row[17]; 
						$idDeptoDestino = $row[18]; 
						$nombreDeptoDestino = $row[19]; 
						$idCiudadDestino = $row[20]; 
						$nombreCiudadDestino = $row[21]; 
						$fechaSalida = $row[22]; 
						$horaSalida = $row[23]; 
						$fechaLlegada = $row[24]; 
						$horaLLegada = $row[25]; 
						$idBus = $row[26]; 
						$idTarifa = $row[27]; 
						$precio = $row[28]; 
						$reclamada = $row[29]; 
					}
					$result->free();
				}
				if ($conexion->more_results()) {
					
				}
			} while ($conexion->next_result());
		}
    //Con esto y al incluir este archivo php al form de ver encomienda, es posible llamar a estas variables en cada campo
?>