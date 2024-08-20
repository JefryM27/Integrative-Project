<?php
require_once 'db_connection.php';
?>
<!-- Modal Creación de Asientos -->
<div class="modal fade" id="modalCreacionAsientos" tabindex="-1" aria-labelledby="modalCreacionAsientosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreacionAsientosLabel">Creación de Asientos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormAsientos()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Creación de Asientos -->
                <form id="formCreacionAsientos" method="post">
                    <div class="form-group">
                        <label for="asientoDescripcion">Descripción</label>
                        <input type="text" class="form-control" id="asientoDescripcion" name="descripcion" required />
                    </div>
                    <div class="form-group">
                        <label for="asientoFecha">Fecha</label>
                        <input type="date" class="form-control" id="asientoFecha" name="fecha" required />
                    </div>
                    <div class="form-group">
                        <label for="asientoMonto">Monto</label>
                        <input type="number" class="form-control" id="asientoMonto" name="monto" required />
                    </div>
                    <div class="form-group">
                        <label for="asientoCuentaDebe">Cuenta Debe</label>
                        <select class="form-control" id="asientoCuentaDebe" name="cuenta_debe" required>
                            <?php
                            $conn = Database::getConnection();
                            $sql = "SELECT id, nombre FROM cuentas_contables";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="asientoCuentaHaber">Cuenta Haber</label>
                        <select class="form-control" id="asientoCuentaHaber" name="cuenta_haber" required>
                            <?php
                            $conn = Database::getConnection();
                            $sql = "SELECT id, nombre FROM cuentas_contables";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="asientoEstado">Estado</label>
                        <select class="form-control" id="asientoEstado" name="estado" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Confirmado">Confirmado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="asientoTipo">Tipo</label>
                        <select class="form-control" id="asientoTipo" name="tipo" required>
                            <option value="Ingreso">Ingreso</option>
                            <option value="Egreso">Egreso</option>
                            <option value="Traspaso">Traspaso</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-register" form="formCreacionAsientos">Registrar Asiento</button>
                <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormAsientos()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para limpiar el formulario
    function resetFormAsientos() {
        document.getElementById('formCreacionAsientos').reset();
    }

    document.getElementById('formCreacionAsientos').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Monto"
        const montoInput = document.getElementById('asientoMonto');
        if (!formValidator.validarNumeros(montoInput)) {
            isValid = false;
            formValidator.mostrarError(montoInput, 'El monto debe ser un número.');
        } else {
            formValidator.quitarError(montoInput);
        }

        if (!isValid) {
            return; // Detener la ejecución si hay errores de validación
        }

        var form = event.target;
        var formData = new FormData(form);

        fetch('process/process_asientos.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    form.reset();
                    $('#modalCreacionAsientos').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>