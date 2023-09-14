function revisarOrigenDestino() {
    var idCiudadOrigen = document.getElementById("cmbCiudadOrigen").value;
    var idCiudadDestino = document.getElementById("cmbCiudadDestino").value;
    //alert('Origen ' + idCiudadOrigen + " Destino " + idCiudadDestino)
    if (idCiudadOrigen == "") {
        alert("Por favor ingrese la ciudad de origen");
        document.getElementById("cmbCiudadOrigen").focus();
    } else if (idCiudadDestino == "") {
        alert("Por favor ingrese la ciudad de destino");
        document.getElementById("cmbCiudadDestino").focus();
    } else {
        document.getElementById("accion").value = "consultar";
        document.getElementById("formulario").submit();
    }
    return false
}

function revisarIdentidad() {
    var identidad = document.getElementById("txtIdentidad").value;
    if (identidad == "") {
        alert("Por favor ingrese la identidad del cliente");
        document.getElementById("txtIdentidad").focus();
    } else if (identidad.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/clientes/consultaIdentidad.php',
            data: { //Se envia la variable a consultaIdentidad.php
                identidad_cliente: identidad
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) {
                    return validar();
                } else { //Si no existe el ID, pasa a la siguiente funcion de abajo
                    if (confirm("No existe un cliente registrado con este número de identidad, ¿Desea registrarlo?")) { //Confirmacion de desactivacion verdadera (Ok)
                        createPopupWin("../../forms/clientes/form_insertarCliente.php", "Insertar Nuevo Cliente", 800, 700);
                    }
                }
            });
    }
    return false
}

function createPopupWin(pageURL, pageTitle,
    popupWinWidth, popupWinHeight) {
    var left = (screen.width - popupWinWidth) / 2;
    var top = (screen.height - popupWinHeight) / 4;

    var myWindow = window.open(pageURL, pageTitle,
        'resizable=yes, width=' + popupWinWidth
        + ', height=' + popupWinHeight + ', top='
        + top + ', left=' + left);
    return false;
}

function validar() {
    //Valida que los campos requeridos no se encuentren vacios
    if (document.getElementById("txtIdentidad").value == "") {
        alert("Por favor ingrese la identidad del cliente");
        document.getElementById("txtIdentidad").focus();
    } else if (document.querySelectorAll('input[type="radio"]:checked').length == 0) {
        alert("Por favor seleccione un viaje para completar la compra del boleto");
        document.getElementById("checkViaje").focus();
    } else if (document.getElementById("cmbTarifa").value == "") {
        alert("Por favor seleccione una tarifa de boletos para completar la compra");
        document.getElementById("cmbTarifa").focus();
    } else {
        document.getElementById("accion").value = "guardar";
        document.getElementById("formulario").submit();
    }
    return false;
}