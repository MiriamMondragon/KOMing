function revisarOrigenDestino() {
    var idCiudadOrigen = document.getElementById("cmbCiudadOrigen").value;
    var idCiudadDestino = document.getElementById("cmbCiudadDestino").value;
    var volumen = document.getElementById("txtVolumen").value;
    //alert('Origen ' + idCiudadOrigen + " Destino " + idCiudadDestino)
    if (idCiudadOrigen == "") {
        alert("Por favor ingrese la ciudad de origen de la tarifa");
        document.getElementById("cmbCiudadOrigen").focus();
    } else if (idCiudadDestino == "") {
        alert("Por favor ingrese la ciudad de destino de la tarifa");
        document.getElementById("cmbCiudadDestino").focus();
    } else if (volumen == "") {
        alert("Por favor ingrese el volumen de la tarifa");
        document.getElementById("txtVolumen").focus();
    }else if (idCiudadDestino.value != "" && idCiudadOrigen.value != "" && volumen.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/tarifas_encomiendas/consultaOrigenDestino.php',
            data: { //Se envian las variables a consultaOrigenDestino.php
                ciudad_origen: idCiudadOrigen,
                ciudad_destino: idCiudadDestino,
                volumen: volumen
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //Si el conteo de registros de es igual a 1, quiere decir que ya existe una tarifa con ese volumen, origen y destino
                    alert("Ya existe una tarifa de encomienda con este volumen, ciudad de origen y destino");
                } else { //Si no existen registros, pasa a la siguiente funcion de abajo
                    return validar();
                }
            });
    }
    return false
}

function validar() {
    //Valida que los campos requeridos no se encuentren vacios
    if (document.getElementById("txtVolumen").value == "") {
        alert("Por favor seleccione el el volumen de la tarifa");
        document.getElementById("txtVolumen").focus();
    } else if (document.getElementById("txtDescripcion").value == "") {
        alert("Por favor añada una descripción a la tarifa");
        document.getElementById("txtDescripcion").focus();
    } else if (document.getElementById("cmbPaisOrigen").value == "") {
        alert("Por favor seleccione el pais de origen de la tarifa");
        document.getElementById("cmbPaisOrigen").focus();
    } else if (document.getElementById("cmbDeptoOrigen").value == "") {
        alert("Por favor seleccione el departamento de origen de la tarifa");
        document.getElementById("cmbDeptoOrigen").focus();
    } else if (document.getElementById("cmbCiudadOrigen").value == "") {
        alert("Por favor seleccione la ciudad de origen de la tarifa");
        document.getElementById("cmbCiudadOrigen").focus();
    } else if (document.getElementById("cmbPaisDestino").value == "") {
        alert("Por favor seleccione el pais de destino de la tarifa");
        document.getElementById("cmbPaisDestino").focus();
    } else if (document.getElementById("cmbDeptoDestino").value == "") {
        alert("Por favor seleccione el departamento de destino de la tarifa");
        document.getElementById("cmbDeptoDestino").focus();
    } else if (document.getElementById("cmbCiudadDestino").value == "") {
        alert("Por favor seleccione la ciudad de destino de la tarifa");
        document.getElementById("cmbCiudadDestino").focus();
    } else if (document.getElementById("txtPrecio").value == "" || document.getElementById("txtPrecio").value <= 0) {
        alert("Por favor ingrese un precio para la tarifa");
        document.getElementById("txtPrecio").focus();
    } else if (document.getElementById("txtPorcentaje").value == "" || document.getElementById("txtPorcentaje").value <= 0 ||
               document.getElementById("txtPorcentaje").value > 100) {
        alert("Por favor ingrese un porcentaje de descuento valido para la tarifa de reajuste de esta tarifa");
        document.getElementById("txtPorcentaje").focus();
    } else {
        document.getElementById("accion").value = "guardar";
        document.getElementById("formulario").submit();
    }
    return false;
}

function desactivar() {  //Funcion llamada por el boton de Desactivar en form_actualizarTarifaEncomienda.php 
    if (confirm("¿Desea desactivar a esta tarifa de encomiendas del sistema?")) { //Confirmacion de desactivacion verdadera (Ok)
        document.getElementById("accion").value = "desactivar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de desactivacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}