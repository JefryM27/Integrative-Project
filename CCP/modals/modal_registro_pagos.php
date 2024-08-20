<!-- Modal Registro de Pagos -->
<div class="modal fade" id="modalRegistroPagos" tabindex="-1" aria-labelledby="modalRegistroPagosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistroPagosLabel">
                    Registro de Pagos
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormRegistroPagos()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Registro de Pagos -->
                <form id="formRegistroPagos" novalidate>
                    <div class="form-group">
                        <label for="registroPagoMonto">Monto Pagado</label>
                        <input type="number" class="form-control" id="registroPagoMonto" name="monto_pagado" required />
                    </div>
                    <div class="form-group">
                        <label for="registroPagoFecha">Fecha de Pago</label>
                        <input type="date" class="form-control" id="registroPagoFecha" name="fecha_pago" required />
                    </div>
                    <div class="form-group">
                        <label for="registroPagoMetodo">Método de Pago</label>
                        <select class="form-control" id="registroPagoMetodo" name="metodo_pago" required>
                            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="registroPagoFactura">Factura por Pagar</label>
                        <select class="form-control" id="registroPagoFactura" name="factura_id" required>
                            <?php
                            // Consultar facturas por pagar desde la base de datos
                            $conn = Database::getConnection();
                            $sql = "SELECT id, numero_factura FROM facturas_por_pagar";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['numero_factura'] . '</option>';
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="registroPagoProveedor">Proveedor</label>
                        <select class="form-control" id="registroPagoProveedor" name="proveedor_id" required>
                            <?php
                            // Consultar proveedores desde la base de datos
                            $conn = Database::getConnection();
                            $sql = "SELECT id, nombre FROM proveedores";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="creditoMoneda">Moneda</label>
                        <select class="form-control" id="creditoMoneda" name="moneda" required>
                            <option value="Colones">Colones</option>
                            <option value="Dólares">Dólares</option>
                            <option value="Euros">Euros</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-register" form="formRegistroPagos">
                    Registrar Pago
                </button>
                <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormRegistroPagos()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para limpiar el formulario
    function resetFormRegistroPagos() {
        document.getElementById('formRegistroPagos').reset();
    }

    // Manejo del envío del formulario
    document.getElementById('formRegistroPagos').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Monto Pagado"
        const registroPagoMontoInput = document.getElementById('registroPagoMonto');
        if (!formValidator.validarNumeros(registroPagoMontoInput)) {
            isValid = false;
            formValidator.mostrarError(registroPagoMontoInput, 'El monto debe ser un número.');
        } else {
            formValidator.quitarError(registroPagoMontoInput);
        }

        if (!isValid) {
            return; // Detener la ejecución si hay errores de validación
        }

        var form = event.target;
        var formData = new FormData(form);

        fetch('process/process_registro_pagos.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    form.reset();
                    $('#modalRegistroPagos').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>