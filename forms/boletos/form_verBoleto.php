<?php
include("../menu/menu.php");
//Incluye el archivo php con la libreria de Bootstrap y el menú del sistema
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/boletos/recuperarBoleto.php");
include("../../php/boletos/consultarBoleto.php");
if ($_SESSION["admin"] == 1 || $_SESSION["cargo"] == 3) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../../recursos/bus.ico" rel="shortcut icon" type="image/x-icon">
        <title>Ver Boleto - KOMing</title>
        <script src="../../js/jquery-1.10.2.min.js"></script>
        <!--Libreria básica de JQuery-->
        <script src="../../js/paises/paisesOrigenDestino.js"></script>
        <script>
            function generar() {
                document.getElementById("accion").value = "generar";
                document.getElementById("formulario").submit();
                return false;
            }
        </script>
    </head>

    <body>
        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <!--Bootstrap: Centrado de Texto y margenes arriba y abajo-->
                <h3 style="background-color: #3987E3; color: white;">Ver Boleto</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <!--Modificar usuario a POST cuando se tenga la variable de sesion de usuario (luego del login)-->
                <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
                <div class="col-12">
                    <div class="row">
                        <!--No.Boleto-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2 mb-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba y abajo-->
                                <label for="txtNoBoleto" class="form-label">No. Boleto</label>
                                <input type="number" class="form-control" name="txtNoBoleto" id="txtNoBoleto" maxlength="45" <?php echo "value='" . $_GET['idBoleto'] . "'" ?> readonly>
                            </div>
                        </div>
                        <!--Fecha Compra-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtFechaCompra" class="form-label">Fecha de Compra</label>
                                <input type="date" class="form-control" name="txtFechaCompra" id="txtFechaCompra" <?php echo 'value="' . $fechaCompra . '"' ?> readonly>
                            </div>
                        </div>
                        <!--Hora Compra-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtHoraCompra" class="form-label">Hora Compra</label>
                                <input type="time" class="form-control" name="txtHoraCompra" id="txtHoraCompra" <?php echo 'value="' . $horaCompra . '"' ?> readonly>
                            </div>
                        </div>
                        <!--Empleado-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtEmpleado" class="form-label">Empleado que Atendió</label>
                                <select class="form-control" name="txtEmpleado" id="txtEmpleado" disabled>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Empleado, CONCAT(Nombres, ' ', Apellidos) AS Nombre FROM Empleados WHERE Id_Empleado = '$idEmpleado'";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Id_Empleado'] . "'>" . $row['Nombre'] . "</option>";
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--No. Identidad-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtIdentidad" class="form-label">No. Identidad del Cliente</label>
                                <input type="text" class="form-control" name="txtIdentidad" id="txtIdentidad" placeholder="Ingrese el número de identidad del cliente" <?php echo 'value="' . $idCliente . '"' ?> readonly>
                            </div>
                        </div>
                        <!--Nombre Cliente-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtNombre" class="form-label">Nombre del Cliente</label>
                                <select class="form-control" name="txtNombre" id="txtNombre" disabled>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Cliente, CONCAT(Nombres, ' ', Apellidos) AS Nombre FROM Clientes WHERE Id_Cliente = '$idCliente'";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Id_Cliente'] . "'>" . $row['Nombre'] . "</option>";
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--Pais Origen-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbPaisOrigen" class="form-label">País de Origen</label>
                                <select disabled class="form-control" name="cmbPaisOrigen" id="cmbPaisOrigen">
                                    <option value="">-- Seleccione un País --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Pais, Nombre_Pais FROM Paises";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['Id_Pais'] == $paisOrigen) {
                                            echo "<option selected value='" . $row['Id_Pais'] . "'>" . $row['Nombre_Pais'] . "</option>";
                                        }
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="departamentoOrigen" id="departamentoOrigen" <?php echo 'value=' . $deptoOrigen ?>>
                        <input type="hidden" name="ciudadOrigen" id="ciudadOrigen" <?php echo 'value=' . $ciudadOrigen ?>>
                        <!--Departamento Origen-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="depto">
                                <label for='cmbDeptoOrigen' class='form-label'>Departamento de Origen</label>
                                <select disabled class='form-control' name='cmbDeptoOrigen' id='cmbDeptoOrigen'>
                                    <!--Se rellena mediante script paisesOrigenDestino.js, funcion cargarDepartamentos()-->
                                </select>
                            </div>
                        </div>
                        <!--Ciudad Origen-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="ciudad">
                                <label for='cmbCiudadOrigen' class='form-label'>Ciudad de Origen</label>
                                <select disabled class='form-control' name='cmbCiudadOrigen' id='cmbCiudadOrigen'>
                                    <!--Se rellena mediante scrip paisesOrigenDestino.js, funcion cargarCiudades()-->
                                </select>
                            </div>
                        </div>

                        <!--Pais Destino-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbPaisDestino" class="form-label">País de Destino</label>
                                <select disabled class="form-control" name="cmbPaisDestino" id="cmbPaisDestino">
                                    <option value="">-- Seleccione un País --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Pais, Nombre_Pais FROM Paises";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['Id_Pais'] == $paisDestino) {
                                            echo "<option selected value='" . $row['Id_Pais'] . "'>" . $row['Nombre_Pais'] . "</option>";
                                        }
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="departamentoDestino" id="departamentoDestino" <?php echo 'value=' . $deptoDestino ?>>
                        <input type="hidden" name="ciudadDestino" id="ciudadDestino" <?php echo 'value=' . $ciudadDestino ?>>
                        <!--Departamento Destino-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="depto">
                                <label for='cmbDeptoDestino' class='form-label'>Departamento de Destino</label>
                                <select disabled class='form-control' name='cmbDeptoDestino' id='cmbDeptoDestino'>
                                    <!--Se rellena mediante script paisesOrigenDestino.js, funcion cargarDepartamentos()-->
                                </select>
                            </div>
                        </div>
                        <!--Ciudad Destino-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="ciudad">
                                <label for='cmbCiudadDestino' class='form-label'>Ciudad de Destino</label>
                                <select disabled class='form-control' name='cmbCiudadDestino' id='cmbCiudadDestino'>
                                    <!--Se rellena mediante scrip paisesOrigenDestino.js, funcion cargarCiudades()-->
                                </select>
                            </div>
                        </div>

                        <!------------------------------------------------------------------------------------------------------------------------------------->
                        <div class="d-flex justify-content-center my-4">
                            <table id='tabla' class="table table-striped table-bordered" style="max-width: 1100px;">
                                <!--Bootstrap: Estilo de tabla-->
                                <?php
                                $sql = "SELECT * FROM v_Viaje_Compra_Boleto
                                        WHERE Id_Viaje = " . $idViaje;
                                $result = mysqli_query($conexion, $sql);
                                if (mysqli_num_rows($result) != 0) { //Si la respuesta contiene por lo menos un registro, imprime la tabla
                                    echo
                                    "<thead>
                                    <tr>
                                    <th scope='col' style='text-align: center;'>No. Viaje</th>
                                    <th scope='col' style='text-align: center;'>Fecha de Salida</th>
                                    <th scope='col' style='text-align: center;'>Hora de Salida</th>
                                    <th scope='col' style='text-align: center;'>Ciudad de Origen</th>
                                    <th scope='col' style='text-align: center;'>Ciudad de Destino</th>
                                    <th scope='col' style='text-align: center;'>Placa del Bus</th>
                                    </tr>
                                    </thead>
                                    <tbody>";

                                    while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                                        echo
                                        "<tr>
                                        <th scope='row' style='text-align: center;'>" . $row["Id_Viaje"] . "</th>
                                        <td scope='row' style='text-align: center;'>" . date('d-m-Y', strtotime($row["Fecha_Salida"])) . "</td>
                                        <td scope='row' style='text-align: center;'>" . date('h:i a', strtotime($row["Hora_Salida"])) . "</td>
                                        <td scope='row' style='text-align: center;'>" . $row["Origen"] . "</td>
                                        <td scope='row' style='text-align: center;'>" . $row["Destino"] . "</td>
                                        <td scope='row' style='text-align: center;'>" . $row["Id_Bus"] . "</td>
                                        </tr>";
                                    }
                                }
                                echo "</table>"; //Cerrado de tabla

                                if (mysqli_num_rows($result) == 0) { //Si la respuesta no contiene ningun registro, imprime que no hay resultados
                                    echo
                                    "<div class='col-12 text-center mt-5 mb-5'>
                                        <p>No se encontraron resultados</p>
                                    </div>";
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!------------------------------------------------------------------------------------------------------------------------------------->
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                        <!--Tarifa-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbTarifa" class="form-label">Tipo de Tarifa</label>
                                <select disabled class="form-control" name="cmbTarifa" id="cmbTarifa">
                                    <?php
                                    $sql = "SELECT Id_Tarifa FROM Tarifas_Boletos WHERE Id_Tarifa = '" . $idTarifa . "';";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if (($row['Id_Tarifa'] % 2) != 0) {
                                            echo "<option value='" . $row['Id_Tarifa'] . "'>Tarifa Normal</option>";
                                        } else if (($row['Id_Tarifa'] % 2) == 0) {
                                            echo "<option value='" . $row['Id_Tarifa'] . "'>Tarifa de Reajuste</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!--Precio-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtPrecio" class="form-label">Precio</label>
                                <div class="form-inline">
                                    <p style="float: left; margin-top: 6px;">L.</p>
                                    <p style="float: left; width: 20px;"></p>
                                    <input type="number" class="form-control" style="max-width: 380px; float: left;" name="txtPrecio" id="txtPrecio" min="0" step="0.01" <?php echo 'value=' . $precio ?> readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!--Botones-->
                            <div class="d-flex justify-content-center">
                                <a class='btn btn-secondary m-5' href='form_filtroBoleto.php'> Regresar</a>
                                <button onClick="return generar()" name="btnGenerar" id="btnGenerar" class="btn btn-primary m-5" style="background-color: #E36039; border-color: #E36039;">Generar PDF</button>
                                <!--El boton llama a la funcion de revision donde si las validaciones son correctas se hará el submit-->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

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