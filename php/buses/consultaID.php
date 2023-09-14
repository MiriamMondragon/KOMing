<?php 
    //Consulta PHP para la revision de no. de id de clientes llamada por AJAX en la funcion revisarIdentidad() en clientes.js
    include("../conexion.php");
    //Se incluye la conexion a la BD
    $id = $_POST["id_bus"]; //Se recupera el campo de id enviado mediante AJAX
    $c = 0; //Variable de conteo
    $sql = "SELECT COUNT(*) AS c FROM Buses WHERE Id_Bus = '$id'"; //Solicita un conteo de los registros que posean un numero de id igual al del campo en la tabla de Clientes

    $result = mysqli_query($conexion,$sql); //Ejecuta el query
    while($row=mysqli_fetch_assoc($result)) //Recorre la respuesta por cada registro
    {
        $c = $row["c"]; //Si no hay registros c=0 pero si hay (el caso maximo es que haya un registro) c=1
    }
    echo $c; //Devuelve c como una respuesta HTML que es recojida por AJAX que determinara que hacer si el valor es 0 o 1
?>