<?php
require_once 'db_connection.php';
?>
<!-- Modal Registro de Créditos Internos -->
<div class="modal fade" id="modalCreditosInternos" tabindex="-1" aria-labelledby="modalCreditosInternosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreditosInternosLabel">Registro de Créditos Internos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormCreditosInternos()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRegistroCreditosInternos" method="post" action="process/process_credito_interno.php">
                    <input type="hidden" id="creditoInternoId" name="id" />
                    <div class="form-group">
                        <label for="montoCredito">Monto del Crédito</label>
                        <input type="number" class="form-control" id="montoCredito" name="monto" required />
                    </div>
                    <div class="form-group">
                        <label for="plazoCredito">Plazo (meses)</label>
                        <input type="number" class="form-control" id="plazoCredito" name="plazo" required />
                    </div>
                    <div class="form-group">
                        <label for="tasaInteres">Tasa de Interés (%)</label>
                        <input type="number" step="0.01" class="form-control" id="tasaInteres" name="tasa_interes" required />
                    </div>
                    <div class="form-group">
                        <label for="fechaSolicitud">Fecha de Solicitud</label>
                        <input type="date" class="form-control" id="fechaSolicitud" name="fecha_solicitud" required />
                    </div>
                    <div class="form-group">
                        <label for="clienteCredito">Cliente</label>
                        <select class="form-control" id="clienteCredito" name="cliente_id" required>
                            <!-- Aquí se cargarán los clientes desde la base de datos -->
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
                        <label for="estadoCredito">Estado</label>
                        <select class="form-control" id="estadoCredito" name="estado" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Rechazado">Rechazado</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formRegistroCreditosInternos">Registrar Crédito</button>
                <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormCreditosInternos()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para limpiar el formulario
    function resetFormCreditosInternos() {
        document.getElementById('formRegistroCreditosInternos').reset();
    }

    document.getElementById('formRegistroCreditosInternos').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Monto del Crédito"
        const montoCreditoInput = document.getElementById('montoCredito');
        if (!formValidator.validarNumeros(montoCreditoInput)) {
            isValid = false;
            formValidator.mostrarError(montoCreditoInput, 'El monto debe ser un número.');
        } else {
            formValidator.quitarError(montoCreditoInput);
        }

        // Validación del campo "Plazo (meses)"
        const plazoCreditoInput = document.getElementById('plazoCredito');
        if (!formValidator.validarNumeros(plazoCreditoInput)) {
            isValid = false;
            formValidator.mostrarError(plazoCreditoInput, 'El plazo debe ser un número.');
        } else {
            formValidator.quitarError(plazoCreditoInput);
        }

        // Validación del campo "Tasa de Interés"
        const tasaInteresInput = document.getElementById('tasaInteres');
        if (!formValidator.validarNumeros(tasaInteresInput)) {
            isValid = false;
            formValidator.mostrarError(tasaInteresInput, 'La tasa de interés debe ser un número.');
        } else {
            formValidator.quitarError(tasaInteresInput);
        }

        if (!isValid) {
            return; // Detener la ejecución si hay errores de validación
        }

        var form = event.target;
        var formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    form.reset();

                    var nuevoCredito = document.createElement('li');
                    nuevoCredito.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                    nuevoCredito.setAttribute('data-id', data.data.id);
                    nuevoCredito.innerHTML = `
                Monto: ${data.data.monto}
                <div>
                    <button class="btn btn-sm btn-info mr-2" onclick="editarCredito(${data.data.id})">Editar</button>
                    <button class="btn btn-sm btn-danger" onclick="eliminarCredito(${data.data.id})">Eliminar</button>
                </div>
            `;
                    document.getElementById('listaCreditosInternos').appendChild(nuevoCredito);

                    $('#modalCreditosInternos').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });

    function editarCredito(id) {
        fetch(`process/get_data.php?entity=credito_interno&id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    document.getElementById('creditoInternoId').value = data.data.id;
                    document.getElementById('montoCredito').value = data.data.monto;
                    document.getElementById('plazoCredito').value = data.data.plazo;
                    document.getElementById('tasaInteres').value = data.data.tasa_interes;
                    document.getElementById('fechaSolicitud').value = data.data.fecha_solicitud;
                    document.getElementById('clienteCredito').value = data.data.cliente_id;
                    document.getElementById('estadoCredito').value = data.data.estado;
                    $('#modalCreditosInternos').modal('show');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function eliminarCredito(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este crédito?')) {
            fetch(`process/delete_data.php?entity=credito_interno&id=${id}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Crédito eliminado correctamente');
                        document.querySelector(`#listaCreditosInternos li[data-id="${id}"]`).remove();
                    } else {
                        alert('Error al eliminar el crédito');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>