<?php
require_once 'db_connection.php';
?>
<!-- Modal Gestión de Intereses -->
<div class="modal fade" id="modalGestionIntereses" tabindex="-1" aria-labelledby="modalGestionInteresesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalGestionInteresesLabel">Gestión de Intereses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormIntereses()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Gestión de Intereses -->
                <form id="formGestionIntereses" method="post" action="process/process_gestion_intereses.php">
                    <input type="hidden" id="interesId" name="id" />
                    <div class="form-group">
                        <label for="creditoId">ID del Crédito</label>
                        <select class="form-control" id="creditoId" name="credito_id" required>
                            <?php
                            $conn = Database::getConnection();
                            $sql = "SELECT id FROM creditos_internos";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['id'] . '">' . $row['id'] . '</option>';
                            }
                            $conn = null;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="montoInteres">Monto del Interés</label>
                        <input type="number" class="form-control" id="montoInteres" name="monto_interes" required />
                    </div>
                    <div class="form-group">
                        <label for="fechaCobro">Fecha de Cobro</label>
                        <input type="date" class="form-control" id="fechaCobro" name="fecha_cobro" required />
                    </div>
                    <div class="form-group">
                        <label for="estadoInteres">Estado</label>
                        <select class="form-control" id="estadoInteres" name="estado" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Pagado">Pagado</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormIntereses()">Cerrar</button>
                </form>
                <hr>
                <!-- Lista de Intereses -->
                <h5>Lista de Intereses</h5>
                <ul class="list-group" id="listaIntereses">
                    <?php
                    $conn = Database::getConnection();
                    $sql = "SELECT id, credito_id FROM gestion_intereses";
                    $result = $conn->query($sql);

                    echo '<ul class="list-group">';
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center" data-id="' . $row['id'] . '">';
                        echo 'Crédito ID: ' . $row['credito_id'];
                        echo '<div>';
                        echo '<button class="btn btn-sm btn-info mr-2" onclick="editarInteres(' . $row['id'] . ')">Editar</button>';
                        echo '<button class="btn btn-sm btn-danger" onclick="eliminarInteres(' . $row['id'] . ')">Eliminar</button>';
                        echo '</div>';
                        echo '</li>';
                    }
                    echo '</ul>';

                    $conn = null;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para limpiar el formulario
    function resetFormIntereses() {
        document.getElementById('formGestionIntereses').reset();
    }

    document.getElementById('formGestionIntereses').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Monto del Interés"
        const montoInteresInput = document.getElementById('montoInteres');
        if (!formValidator.validarNumeros(montoInteresInput)) {
            isValid = false;
            formValidator.mostrarError(montoInteresInput, 'El monto debe ser un número.');
        } else {
            formValidator.quitarError(montoInteresInput);
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

                    var nuevoInteres = document.createElement('li');
                    nuevoInteres.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                    nuevoInteres.setAttribute('data-id', data.data.id);
                    nuevoInteres.innerHTML = `
                    Crédito ID: ${data.data.credito_id}
                    <div>
                        <button class="btn btn-sm btn-info mr-2" onclick="editarInteres(${data.data.id})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarInteres(${data.data.id})">Eliminar</button>
                    </div>
                `;
                    document.getElementById('listaIntereses').appendChild(nuevoInteres);

                    $('#modalGestionIntereses').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });

    function editarInteres(id) {
        fetch(`process/get_data.php?entity=interes&id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    document.getElementById('interesId').value = data.data.id;
                    document.getElementById('creditoId').value = data.data.credito_id;
                    document.getElementById('montoInteres').value = data.data.monto_interes;
                    document.getElementById('fechaCobro').value = data.data.fecha_cobro;
                    document.getElementById('estadoInteres').value = data.data.estado;
                    $('#modalGestionIntereses').modal('show');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function eliminarInteres(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este interés?')) {
            fetch(`process/delete_data.php?entity=interes&id=${id}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Interés eliminado correctamente');
                        document.querySelector(`#listaIntereses li[data-id="${id}"]`).remove();
                    } else {
                        alert('Error al eliminar el interés');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>