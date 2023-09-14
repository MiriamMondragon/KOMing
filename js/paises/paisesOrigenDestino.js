//Origen
function cargarDepartamentosOrigen() { //Solicita una consulta de PHP a la BD mediante datos mandados como JSON a consultaDepto.php
    $.ajax({
        type: "POST",
        url: "../../php/paises/consultaDepto.php",
        dataType: 'html',
        data: {
            'pais': $('#cmbPaisOrigen').val(), //Recupera el valor en cmbPais
            'departamento': $('#departamentoOrigen').val() //Recupera el valor en departamento (solo usado en actualizaciones de registros) para marcar un option como seleccionado
        },
        success: function (respuesta) { //Responde con el llenado del cmbDepto con la cadena de respuesta de PHP
            $('#cmbDeptoOrigen').html(respuesta);
        }
    });
    return false;
}

function cargarCiudadesOrigen() { //Solicita una consulta de PHP a la BD mediante datos mandados como JSON a consultaCiudad.php
    $.ajax({
        type: "POST",
        url: "../../php/paises/consultaCiudad.php",
        dataType: 'html',
        data: {
            'depto': $('#cmbDeptoOrigen').val(), //Recupera el valor en cmbDepto
            'ciudad': $('#ciudadOrigen').val() //Recupera el valor en ciudad (solo usado en actualizaciones de registros) para marcar un option como seleccionado
        },
        success: function (respuesta) {
            $('#cmbCiudadOrigen').html(respuesta); //Responde con el llenado del cmbCiudad con la cadena de respuesta de PHP
        }
    });
    return false;
}

$(document).ready(function () { //Al cargar la pagina se activa esta funcion
    cargarDepartamentosOrigen();

    $('#cmbPaisOrigen').change(function () { //Al cambiar el estado del cmbPais se recargan los departamentos
        cargarDepartamentosOrigen();
    });
    return false;
})

$(document).ready(setTimeout(function () { //Despues de 0.200 segundos de cargar la pagina se llama a esta funcion
    cargarCiudadesOrigen();

    $('#cmbDeptoOrigen').change(function () { //Al cambiar el estado del cmbDepto se recargan las ciudades
        cargarCiudadesOrigen();
    });
    return false;
}, 200)); //Este retraso es porque para marcar una ciudad como seleccionada, el departamento debe estar seleccionado tambien
          //Asi que despues de 0.200 segundos tanto el departamento como la ciudad pueden seleccionarse correctamente


//Destino
function cargarDepartamentosDestino() { //Solicita una consulta de PHP a la BD mediante datos mandados como JSON a consultaDepto.php
    $.ajax({
        type: "POST",
        url: "../../php/paises/consultaDepto.php",
        dataType: 'html',
        data: {
            'pais': $('#cmbPaisDestino').val(), //Recupera el valor en cmbPais
            'departamento': $('#departamentoDestino').val() //Recupera el valor en departamento (solo usado en actualizaciones de registros) para marcar un option como seleccionado
        },
        success: function (respuesta) { //Responde con el llenado del cmbDepto con la cadena de respuesta de PHP
            $('#cmbDeptoDestino').html(respuesta);
        }
    });
    return false;
}

function cargarCiudadesDestino() { //Solicita una consulta de PHP a la BD mediante datos mandados como JSON a consultaCiudad.php
    $.ajax({
        type: "POST",
        url: "../../php/paises/consultaCiudad.php",
        dataType: 'html',
        data: {
            'depto': $('#cmbDeptoDestino').val(), //Recupera el valor en cmbDepto
            'ciudad': $('#ciudadDestino').val() //Recupera el valor en ciudad (solo usado en actualizaciones de registros) para marcar un option como seleccionado
        },
        success: function (respuesta) {
            $('#cmbCiudadDestino').html(respuesta); //Responde con el llenado del cmbCiudad con la cadena de respuesta de PHP
        }
    });
    return false;
}

$(document).ready(function () { //Al cargar la pagina se activa esta funcion
    cargarDepartamentosDestino();

    $('#cmbPaisDestino').change(function () { //Al cambiar el estado del cmbPais se recargan los departamentos
        cargarDepartamentosDestino();
    });
    return false;
})

$(document).ready(setTimeout(function () { //Despues de 0.200 segundos de cargar la pagina se llama a esta funcion
    cargarCiudadesDestino();

    $('#cmbDeptoDestino').change(function () { //Al cambiar el estado del cmbDepto se recargan las ciudades
        cargarCiudadesDestino();
    });
    return false;
}, 200)); //Este retraso es porque para marcar una ciudad como seleccionada, el departamento debe estar seleccionado tambien
          //Asi que despues de 0.200 segundos tanto el departamento como la ciudad pueden seleccionarse correctamente