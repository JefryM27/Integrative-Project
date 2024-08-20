<?php
require_once 'db_connection.php';
?>
<!-- Modal Registro de Notas de Débito -->
<div class="modal fade" id="modalRegistroNotasDebito" tabindex="-1" aria-labelledby="modalRegistroNotasDebitoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistroNotasDebitoLabel">Registro de Notas de Débito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormNotasDebito()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Registro de Notas de Débito -->
                <form id="formRegistroNotasDebito" method="post">
                    <div class="form-group">
                        <label for="notaDebitoFecha">Fecha de Emisión</label>
                        <input type="date" class="form-control" id="notaDebitoFecha" name="fecha_emision" required />
                    </div>
                    <div class="form-group">
                        <label for="notaDebitoMonto">Monto</label>
                        <input type="number" class="form-control" id="notaDebitoMonto" name="monto" required />
                    </div>
                    <div class="form-group">
                        <label for="notaDebitoProveedor">Proveedor</label>
                        <select class="form-control" id="notaDebitoProveedor" name="proveedor_id" required>
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
                        <label for="notaDebitoDescripcion">Descripción</label>
                        <textarea class="form-control" id="notaDebitoDescripcion" name="descripcion" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-register" form="formRegistroNotasDebito">Registrar Nota de Débito</button>
                <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormNotasDebito()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para limpiar el formulario
    function resetFormNotasDebito() {
        document.getElementById('formRegistroNotasDebito').reset();
    }

    // Manejo del envío del formulario
    document.getElementById('formRegistroNotasDebito').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Monto"
        const notaDebitoMontoInput = document.getElementById('notaDebitoMonto');
        if (!formValidator.validarNumeros(notaDebitoMontoInput)) {
            isValid = false;
            formValidator.mostrarError(notaDebitoMontoInput, 'El monto debe ser un número.');
        } else {
            formValidator.quitarError(notaDebitoMontoInput);
        }

        if (!isValid) {
            return; // Detener la ejecución si hay errores de validación
        }

        var form = event.target;
        var formData = new FormData(form);

        fetch('process/process_notas_debito.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    form.reset();
                    $('#modalRegistroNotasDebito').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>