<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : "";
if ($accion == "guardar") {

    $sql = "CALL Vender_Boleto('" . $_POST["txtIdentidad"] . "','" . $_POST["checkViaje"] . "','" . $_POST["cmbTarifa"] .
           "','" . $_POST["usuarioLogin"] . "')";

    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Venta de boleto registrada satisfactoriamente, será redireccionado al PDF del boleto');</script>";
    echo "<script>window.open('../../reporteria/boletoPDF.php?idBoleto= ". $_POST["txtNoBoleto"] ."', '_blank');</script>";
    echo "<script>window.history.replaceState({}, document.title, '/' + 'PW2/Proyecto/forms/boletos/form_venderBoleto.php');
                  location.reload();</script>";
}
?>