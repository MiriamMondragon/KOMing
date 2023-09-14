<?php 

    $id = $_GET['idBoleto'];

    //Inicializacion de variables
    $fechaCompra = '';
    $horaCompra = '';
    $idEmpleado = '';
    $idCliente = '';
    $nombre = '';
    $idViaje = '';
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
    $fechaSalida = '';
    $horaSalida = '';
    $idBus = '';
    $idTarifa = '';
    $precio = '';

    $sql = "SELECT * FROM v_Boleto WHERE Id_Boleto = '" . $id . "';"; 
    $result = mysqli_query($conexion, $sql); 
    while ($row = mysqli_fetch_assoc($result)) { 
        $fechaCompra = $row["Fecha_Compra"]; 
        $horaCompra = $row["Hora_Compra"];
        $idEmpleado = $row["Id_Empleado"];
        $idCliente = $row["Id_Cliente"];
        $nombre = $row["Nombre"];
        $idViaje = $row["Id_Viaje"];
        $paisOrigen = $row["Id_Pais_Origen"];
        $deptoOrigen = $row["Id_Departamento_Origen"];
        $ciudadOrigen = $row["Id_Ciudad_Origen"];
        $paisDestino = $row["Id_Pais_Destino"];
        $deptoDestino = $row["Id_Departamento_Destino"];
        $ciudadDestino = $row["Id_Ciudad_Destino"];
        $nombrePaisOrigen = $row["Nombre_Pais_Origen"];
        $nombreDeptoOrigen = $row["Nombre_Depto_Origen"];
        $nombreCiudadOrigen = $row["Nombre_Ciudad_Origen"];
        $nombrePaisDestino = $row["Nombre_Pais_Destino"];
        $nombreDeptoDestino = $row["Nombre_Depto_Destino"];
        $nombreCiudadDestino = $row["Nombre_Ciudad_Destino"];
        $fechaSalida = $row["Fecha_Salida"];
        $horaSalida = $row["Hora_Salida"];
        $idBus = $row["Id_Bus"];;
        $idTarifa = $row["Id_Tarifa"];
        $precio = $row["Precio"];
    }
    //Con esto y al incluir este archivo php al form de actualizacion de clientes, es posible llamar a estas variables en cada campo
?>