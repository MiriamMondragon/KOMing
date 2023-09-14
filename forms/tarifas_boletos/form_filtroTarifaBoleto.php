<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
if ($_SESSION["admin"] == 1 || $_SESSION["cargo"] == 3) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../../recursos/bus.ico" rel="shortcut icon" type="image/x-icon">
        <title>Tarifas de Boletos Registradas - KOMing</title>
        <script src="../../js/jquery-1.10.2.min.js"></script>
        <script src="../../js/paises/paisesOrigenDestino.js"></script>
        <!-- Utiliza las librerias de Bootstrap -->
        <!--Scripts-->
        <script type="text/javascript">
            function validar() {
                if (document.getElementById("cmbCiudadOrigen").value == "") {
                    alert("Por favor seleccione una ciudad de origen para filtrar");
                    document.getElementById("cmbCiudadOrigen").focus();
                } else if (document.getElementById("cmbCiudadDestino").value == "") {
                    alert("Por favor seleccione una ciudad de destino para filtrar");
                    document.getElementById("cmbCiudadDestino").focus();
                } else {
                    document.getElementById("accion").value = "consultar"; //Al cambiar este valor, el incrutado PHP entra a la condicion
                    document.getElementById("formulario").submit(); //Al hacer submit PHP puede recuperar los valores POST necesarios abajo
                }
                return false;
            }
        </script>
        <!--Fin Scripts-->
    </head>

    <body>

        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <h3 style="background-color: #3987E3; color: white;">Filtrar Tarifas de Boletos Registradas</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <div class="col-12">
                    <div class="row">
                        <!--Pais Origen-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbPaisOrigen" class="form-label">País de Origen</label>
                                <select class="form-control" name="cmbPaisOrigen" id="cmbPaisOrigen">
                                    <option value="">-- Seleccione un País --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Pais, Nombre_Pais FROM Paises";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Id_Pais'] . "'>" . $row['Nombre_Pais'] . "</option>";
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--Departamento Origen-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="depto">
                                <label for='cmbDeptoOrigen' class='form-label'>Departamento de Origen</label>
                                <select class='form-control' name='cmbDeptoOrigen' id='cmbDeptoOrigen'>
                                    <!--Se rellena mediante script paisesOrigenDestino.js, funcion cargarDepartamentos()-->
                                </select>
                            </div>
                        </div>
                        <!--Ciudad Origen-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="ciudad">
                                <label for='cmbCiudadOrigen' class='form-label'>Ciudad de Origen</label>
                                <select class='form-control' name='cmbCiudadOrigen' id='cmbCiudadOrigen'>
                                    <!--Se rellena mediante scrip paisesOrigenDestino.js, funcion cargarCiudades()-->
                                </select>
                            </div>
                        </div>

                        <!--Pais Destino-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbPaisDestino" class="form-label">País de Destino</label>
                                <select class="form-control" name="cmbPaisDestino" id="cmbPaisDestino">
                                    <option value="">-- Seleccione un País --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Pais, Nombre_Pais FROM Paises";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Id_Pais'] . "'>" . $row['Nombre_Pais'] . "</option>";
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--Departamento Destino-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="depto">
                                <label for='cmbDeptoDestino' class='form-label'>Departamento de Destino</label>
                                <select class='form-control' name='cmbDeptoDestino' id='cmbDeptoDestino'>
                                    <!--Se rellena mediante script paisesOrigenDestino.js, funcion cargarDepartamentos()-->
                                </select>
                            </div>
                        </div>
                        <!--Ciudad Destino-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="ciudad">
                                <label for='cmbCiudadDestino' class='form-label'>Ciudad de Destino</label>
                                <select class='form-control' name='cmbCiudadDestino' id='cmbCiudadDestino'>
                                    <!--Se rellena mediante script paisesOrigenDestino.js, funcion cargarCiudades()-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--Botones-->
                        <div class="d-flex justify-content-center">
                            <?php
                            $accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //La accion que cambia con la funcion validar()
                            if ($accion == "consultar") {
                                echo "<a class='btn btn-secondary m-3' href='form_filtroTarifaBoleto.php'> Regresar</a>";
                            }
                            ?>
                            <button onClick="return validar()" name="btnBuscar" id="btnBuscar" class="btn btn-primary m-3" style="background-color: #3987E3; border-color: #3987E3;">Buscar</button>
                            <!--Utiliza el script especificado en el head para validar que el campo no este vacio y hacer submit-->
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-center my-4">
            <!--Bootstrap: Centrado de div-->
            <table id='tabla' class="table table-striped table-bordered" style="max-width: 1100px;">
                <!--Bootstrap: Estilo de tabla-->
                <?php
                $accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //La accion que cambia con la funcion validar()
                $origen = isset($_POST["cmbCiudadOrigen"]) ? $_POST["cmbCiudadOrigen"] : "";
                $destino = isset($_POST["cmbCiudadDestino"]) ? $_POST["cmbCiudadDestino"] : "";
                if ($accion == "consultar") {
                    $sql = "SELECT TB.Id_Tarifa, C1.Nombre_Ciudad AS Origen, C2.Nombre_Ciudad AS Destino, TB.Precio
                        FROM v_Tarifas_Boletos AS TB INNER JOIN Ciudades AS C1 ON TB.Id_Ciudad_Origen = C1.Id_Ciudad
                                                    INNER JOIN Ciudades AS C2 ON TB.Id_Ciudad_Destino = C2.Id_Ciudad
                        WHERE TB.Id_Ciudad_Origen = " . $origen . " AND TB.Id_Ciudad_Destino = " . $destino . "
                        ORDER BY TB.Id_Tarifa;";
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result) != 0) { //Si la respuesta contiene por lo menos un registro, imprime la tabla
                        echo
                        "<thead>
                        <tr>
                            <th scope='col'>No. de Tarifa de Boleto</th>
                            <th scope='col'>Ciudad de Origen</th>
                            <th scope='col'>Ciudad de Destino</th>
                            <th scope='col'>Precio</th>
                            <th style='text-align: center;' scope='col'>Actualizar</th>
                        </tr>
                        </thead>
                        <tbody>";

                        while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                            echo
                            "<tr>
                        <th scope='row'>" . $row["Id_Tarifa"] . "</th>
                        <td scope='row'>" . $row["Origen"] . "</td>
                        <td scope='row'>" . $row["Destino"] . "</td>
                        <td scope='row'>L. " . $row["Precio"] . "</td>
                        <td style='text-align: center'><a class='btn btn-primary' style='background-color: #3987E3; border-color: #3987E3;' href='form_actualizarTarifaBoleto.php?idTarifaBoleto=" . $row["Id_Tarifa"] . "'> Actualizar Tarifa</a></td>
                        </tr>"; //El enlace redirecciona al formulario de actualizar, y mediante metodo GET envia el Id de la tarifa
                        }
                    }
                    echo "</table>"; //Cerrado de tabla

                    if (mysqli_num_rows($result) == 0) { //Si la respuesta no contiene ningun registro, imprime que no hay resultados
                        echo
                        "<div class='col-12 text-center mt-5 mb-5'>
                        <p>No se encontraron resultados</p>
                    </div>";
                    }
                } else {
                    $sql = "SELECT TB.Id_Tarifa, C1.Nombre_Ciudad AS Origen, C2.Nombre_Ciudad AS Destino, TB.Precio
                        FROM v_Tarifas_Boletos AS TB INNER JOIN Ciudades AS C1 ON TB.Id_Ciudad_Origen = C1.Id_Ciudad
                                                    INNER JOIN Ciudades AS C2 ON TB.Id_Ciudad_Destino = C2.Id_Ciudad
                        ORDER BY TB.Id_Tarifa;";
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result) != 0) { //Si la respuesta contiene por lo menos un registro, imprime la tabla
                        echo
                        "<thead>
                        <tr>
                            <th scope='col'>No. de Tarifa de Boleto</th>
                            <th scope='col'>Ciudad de Origen</th>
                            <th scope='col'>Ciudad de Destino</th>
                            <th scope='col'>Precio</th>
                            <th style='text-align: center;' scope='col'>Actualizar</th>
                        </tr>
                        </thead>
                        <tbody>";

                        while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                            echo
                            "<tr>
                        <th scope='row'>" . $row["Id_Tarifa"] . "</th>
                        <td scope='row'>" . $row["Origen"] . "</td>
                        <td scope='row'>" . $row["Destino"] . "</td>
                        <td scope='row'>L. " . $row["Precio"] . "</td>
                        <td style='text-align: center'><a class='btn btn-primary' style='background-color: #3987E3; border-color: #3987E3;' href='form_actualizarTarifaBoleto.php?idTarifaBoleto=" . $row["Id_Tarifa"] . "'> Actualizar Tarifa</a></td>
                        </tr>"; //El enlace redirecciona al formulario de actualizar, y mediante metodo GET envia el Id de la tarifa
                        }
                    }
                    echo "</table>"; //Cerrado de tabla
                }
                ?>
                </tbody>
            </table>
        </div>
        <br>
        <footer style="clear: both; position: relative; margin-top: 150px;">
            <div style="background-color: #24242c; width: 1481px; height: 58px;"></div>
        </footer>
    </body>

    </html>
<?php
} else { //Pagina que se carga cuando se trata de acceder con la url sin ser administrador
    echo "<script>
            window.location.href = '../../forms/principal/principal.php';
        </script>";
}
?>