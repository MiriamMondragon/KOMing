function cargarPrecio() { //Solicita una consulta de PHP a la BD mediante datos mandados como JSON a consultaDepto.php
    $.ajax({
        type: "POST",
        url: "../../php/boletos/consultaPrecio.php",
        dataType: 'html',
        data: {
            'idTarifa': $('#cmbTarifa').val(), //Recupera el valor en cmbPais
        },
        success: function (respuesta) { //Responde con el llenado del cmbDepto con la cadena de respuesta de PHP
            $('#txtPrecio').val(respuesta);
        }
    });
    return false;
}

$(document).ready(function () { 
    $('#cmbTarifa').change(function () { //Al cambiar el estado del cmbPais se recargan los departamentos
        cargarPrecio();
    });
    return false;
})