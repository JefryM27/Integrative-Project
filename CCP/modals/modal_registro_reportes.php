<?php
require_once 'db_connection.php';
?>
<!-- Modal Reportes -->
<div class="modal fade" id="modalReportes" tabindex="-1" aria-labelledby="modalReportesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReportesLabel">Reportes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormReportes()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Reportes -->
                <form id="formReportes" method="post">
                    <div class="form-group">
                        <label for="reporteNombre">Nombre</label>
                        <input type="text" class="form-control" id="reporteNombre" name="nombre" required />
                    </div>
                    <div class="form-group">
                        <label for="reporteDescripcion">Descripción</label>
                        <textarea class="form-control" id="reporteDescripcion" name="descripcion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reporteFechaGeneracion">Fecha de Generación</label>
                        <input type="date" class="form-control" id="reporteFechaGeneracion" name="fecha_generacion" required />
                    </div>
                    <div class="form-group">
                        <label for="reporteTipo">Tipo de Reporte</label>
                        <select class="form-control" id="reporteTipo" name="tipo_reporte" required>
                            <option value="Balance General">Balance General</option>
                            <option value="Estado de Resultados">Estado de Resultados</option>
                            <option value="Flujo de Efectivo">Flujo de Efectivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reporteIdCliente">Número de Documento del Cliente</label>
                        <select class="form-control" id="reporteIdCliente" name="cliente_id" required>
                            <?php
                            $conn = Database::getConnection();
                            $sql = "SELECT id, numeroDocumento FROM clientes";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['numeroDocumento'] . '</option>';
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formReportes">Generar Reporte</button>
                <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormReportes()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para limpiar el formulario
    function resetFormReportes() {
        document.getElementById('formReportes').reset();
    }

    // Manejo del envío del formulario
    document.getElementById('formReportes').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Nombre"
        const reporteNombreInput = document.getElementById('reporteNombre');
        if (!formValidator.validarTexto(reporteNombreInput)) {
            isValid = false;
            formValidator.mostrarError(reporteNombreInput, 'El nombre solo debe contener letras.');
        } else {
            formValidator.quitarError(reporteNombreInput);
        }

        if (!isValid) {
            return; // Detener la ejecución si hay errores de validación
        }

        var form = event.target;
        var formData = new FormData(form);

        fetch('process/process_reportes.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    form.reset();
                    $('#modalReportes').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>