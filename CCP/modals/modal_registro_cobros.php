<?php
require_once 'db_connection.php';
?>
<!-- Modal Registro de Cobros -->
<div class="modal fade" id="modalRegistroCobros" tabindex="-1" aria-labelledby="modalRegistroCobrosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistroCobrosLabel">Registro de Cobros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormCobros()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Registro de Cobros -->
                <form id="formRegistroCobros" method="post">
                    <div class="form-group">
                        <label for="registroCobroMonto">Monto Cobrado</label>
                        <input type="number" class="form-control" id="registroCobroMonto" name="monto_cobrado" required />
                    </div>
                    <div class="form-group">
                        <label for="registroCobroFecha">Fecha de Cobro</label>
                        <input type="date" class="form-control" id="registroCobroFecha" name="fecha_cobro" required />
                    </div>
                    <div class="form-group">
                        <label for="registroCobroMetodo">Método de Cobro</label>
                        <select class="form-control" id="registroCobroMetodo" name="metodo_cobro" required>
                            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="registroCobroFactura">Factura por Cobrar</label>
                        <select class="form-control" id="registroCobroFactura" name="factura_id" required>
                            <?php
                            $conn = Database::getConnection();
                            $sql = "SELECT id, numero_factura FROM facturas_por_cobrar";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['numero_factura'] . '</option>';
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="registroCobroCliente">Cliente</label>
                        <select class="form-control" id="registroCobroCliente" name="cliente_id" required>
                            <?php
                            $conn = Database::getConnection();
                            $sql = "SELECT id, nombre FROM clientes";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="registroCobroMoneda">Moneda</label>
                        <select class="form-control" id="registroCobroMoneda" name="moneda" required>
                            <option value="Colones">Colones</option>
                            <option value="Dólares">Dólares</option>
                            <option value="Euros">Euros</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Registrar Cobro</button>
                        <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormCobros()">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para limpiar el formulario
    function resetFormCobros() {
        document.getElementById('formRegistroCobros').reset();
    }

    document.getElementById('formRegistroCobros').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Monto Cobrado"
        const montoCobradoInput = document.getElementById('registroCobroMonto');
        if (!formValidator.validarNumeros(montoCobradoInput)) {
            isValid = false;
            formValidator.mostrarError(montoCobradoInput, 'El monto debe ser un número.');
        } else {
            formValidator.quitarError(montoCobradoInput);
        }

        if (!isValid) {
            return; // Detener la ejecución si hay errores de validación
        }

        var form = event.target;
        var formData = new FormData(form);

        fetch('process/process_cobros.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    form.reset();
                    $('#modalRegistroCobros').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>