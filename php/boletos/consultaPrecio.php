<?php 
    //Recibe el id del pais seleccionado para rellenar el combobox de departamentos y cumple la misma funcion que consultaCiudad.php
	//Solo que usando pais y departamentos
    include("../conexion.php");
    $idTarifa = $_REQUEST['idTarifa'];
    
	$sql = "SELECT Precio FROM Historico_Precios_Tarifas_Boletos WHERE Id_Tarifa = '$idTarifa' AND Fecha_FIN IS NULL";

	$result = mysqli_query($conexion,$sql);

	$precio = 0.00;

	while ($res = mysqli_fetch_row($result)) {
        $precio = $res[0];
	}
	echo  $precio;
?>