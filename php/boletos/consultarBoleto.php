<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : "";
if ($accion == "generar") {
    echo "<script>window.open('../../reporteria/boletoPDF.php?idBoleto= ". $_POST["txtNoBoleto"] ."', '_blank');</script>";
    //echo "<script>window.history.replaceState({}, document.title, '/' + 'PW2/Proyecto/forms/boletos/form_verBoleto.php');
     //             location.reload();</script>";
}
?>