<?php 
    include("../conexion.php");

    $c=0;
	//Consulta vulnerable, al hacer un comentario la consulta final sería: 
	//		SELECT COUNT(*) AS c FROM Usuarios WHERE Id_Usuario = 'mmondragon'# ' AND Clave = '1'
	//Siendo todo despues del # completamente ignorado en la consulta.
	
    $sql="SELECT COUNT(*) AS c FROM Usuarios WHERE Id_Usuario = '" . $_POST["empleado_usuario"] . "' AND Clave = '" . $_POST["empleado_clave"] . "'";

    $result=mysqli_query($conexion,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
        $c=$row["c"];
    }
    echo $c;
?>