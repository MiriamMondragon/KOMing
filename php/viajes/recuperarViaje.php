<?php 
    $id = $_GET['idViaje']; 

    $idViaje = '';
    $fechaSalida = '';
    $horaSalida = '';
    $fechaLlegada = '';
    $horaLlegada = '';
    $paisOrigen = '';
    $deptoOrigen = '';
    $ciudadOrigen = '';
    $paisDestino = '';
    $deptoDestino = '';
    $ciudadDestino = '';
    $nombrePaisOrigen = '';
    $nombreDeptoOrigen = '';
    $nombreCiudadOrigen = '';
    $nombrePaisDestino = '';
    $nombreDeptoDestino = '';
    $nombreCiudadDestino = '';
    $idChofer = '';
    $nombreChofer = '';
    $idEstadoViaje = '';
    $estado = '';
    $capacidadBoletos = '';
    $boletos = '';
    $capacidadEncomiendas = '';
    $encomiendas = '';
    $volumenEncomiendas = '';
    $idBus = '';
    $descripcionBus ='';

    
    $sql = "SELECT * FROM v_Viaje WHERE Id_Viaje = '" . $id . "';";
    $result = mysqli_query($conexion, $sql); 
    while ($row = mysqli_fetch_assoc($result)) {
        $idViaje = $row["Id_Viaje"];
        $fechaSalida = $row["Fecha_Salida"];
        $horaSalida = $row["Hora_Salida"];
        $fechaLlegada = $row["Fecha_Llegada"];
        $horaLlegada = $row["Hora_Llegada"];
        $paisOrigen = $row["Id_Pais_Origen"];
        $deptoOrigen = $row["Id_Departamento_Origen"];
        $ciudadOrigen = $row["Id_Ciudad_Origen"];
        $paisDestino = $row["Id_Pais_Destino"];
        $deptoDestino = $row["Id_Departamento_Destino"];
        $ciudadDestino = $row["Id_Ciudad_Destino"];
        $nombrePaisOrigen = $row["Nombre_Pais_Origen"];
        $nombreDeptoOrigen = $row["Nombre_Departamento_Origen"];
        $nombreCiudadOrigen = $row["Nombre_Ciudad_Origen"];
        $nombrePaisDestino = $row["Nombre_Pais_Destino"];
        $nombreDeptoDestino = $row["Nombre_Departamento_Destino"];
        $nombreCiudadDestino = $row["Nombre_Ciudad_Destino"];
        $idChofer = $row["Id_Chofer"];
        $nombreChofer = $row["Nombre_Chofer"];
        $idEstadoViaje = $row["Id_Estado_Viaje"];
        $estado = $row["Estado"];
        $capacidadBoletos = $row["Capacidad_Personas"];
        $boletos = $row["Boletos_Vendidos"];
        $capacidadEncomiendas = $row["Capacidad_Encomiendas"];
        $encomiendas = $row["Encomiendas_Guiadas"];
        $volumenEncomiendas = $row["Volumen_Encomiendas_Guiadas"];
        $idBus = $row["Id_Bus"];
        $descripcionBus = $row["Descripcion_Bus"];
    }
?>