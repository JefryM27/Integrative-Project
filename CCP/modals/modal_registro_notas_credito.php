<?php
require_once 'db_connection.php';
?>
<!-- Modal Registro de Notas de Crédito -->
<div class="modal fade" id="modalRegistroNotasCredito" tabindex="-1" aria-labelledby="modalRegistroNotasCreditoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistroNotasCreditoLabel">Registro de Notas de Crédito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormNotasCredito()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Registro de Notas de Crédito -->
                <form id="formRegistroNotasCredito" method="post">
                    <div class="form-group">
                        <label for="notaCreditoFecha">Fecha de Emisión</label>
                        <input type="date" class="form-control" id="notaCreditoFecha" name="fecha_emision" required />
                    </div>
                    <div class="form-group">
                        <label for="notaCreditoMonto">Monto</label>
                        <input type="number" class="form-control" id="notaCreditoMonto" name="monto" required />
                    </div>
                    <div class="form-group">
                        <label for="notaCreditoProveedor">Proveedor</label>
                        <select class="form-control" id="notaCreditoProveedor" name="proveedor_id" required>
                            <?php
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
                        <label for="notaCreditoDescripcion">Descripción</label>
                        <textarea class="form-control" id="notaCreditoDescripcion" name="descripcion" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-register" form="formRegistroNotasCredito">Registrar Nota de Crédito</button>
                <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormNotasCredito()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para limpiar el formulario
    function resetFormNotasCredito() {
        document.getElementById('formRegistroNotasCredito').reset();
    }

    // Manejo del envío del formulario
    document.getElementById('formRegistroNotasCredito').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Monto"
        const notaCreditoMontoInput = document.getElementById('notaCreditoMonto');
        if (!formValidator.validarNumeros(notaCreditoMontoInput)) {
            isValid = false;
            formValidator.mostrarError(notaCreditoMontoInput, 'El monto debe ser un número.');
        } else {
            formValidator.quitarError(notaCreditoMontoInput);
        }

        if (!isValid) {
            return; // Detener la ejecución si hay errores de validación
        }

        var form = event.target;
        var formData = new FormData(form);

        fetch('process/process_notas_credito.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    form.reset();
                    $('#modalRegistroNotasCredito').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>