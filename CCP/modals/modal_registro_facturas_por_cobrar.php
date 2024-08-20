<?php
require_once 'db_connection.php';
?>
<!-- Modal Registro de Facturas Por Cobrar -->
<div class="modal fade" id="modalRegistroFacturasPorCobrar" tabindex="-1" aria-labelledby="modalRegistroFacturasPorCobrarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistroFacturasPorCobrarLabel">Registro de Facturas Por Cobrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormFacturasPorCobrar()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Registro de Facturas Por Cobrar -->
                <form id="formRegistroFacturasPorCobrar" method="post">
                    <input type="hidden" id="facturaId" name="id" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facturaNumeroCobrar">Número de Factura</label>
                                <input type="text" class="form-control" id="facturaNumeroCobrar" name="numero_factura" required />
                            </div>
                            <div class="form-group">
                                <label for="facturaFechaCobrar">Fecha de Factura</label>
                                <input type="date" class="form-control" id="facturaFechaCobrar" name="fecha_factura" required />
                            </div>
                            <div class="form-group">
                                <label for="facturaMontoCobrar">Monto</label>
                                <input type="number" class="form-control" id="facturaMontoCobrar" name="monto" required />
                            </div>
                            <div class="form-group">
                                <label for="facturaEstadoCobrar">Estado</label>
                                <select class="form-control" id="facturaEstadoCobrar" name="estado" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Pagada">Pagada</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="facturaClienteCobrar">Cliente</label>
                                <select class="form-control" id="facturaClienteCobrar" name="cliente_id" required>
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
                                <label for="facturaMonedaCobrar">Moneda</label>
                                <select class="form-control" id="facturaMonedaCobrar" name="moneda" required>
                                    <option value="Colones">Colones</option>
                                    <option value="Dólares">Dólares</option>
                                    <option value="Euros">Euros</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="facturaDescripcionCobrar">Descripción</label>
                                <textarea class="form-control" id="facturaDescripcionCobrar" name="descripcion" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Lista de Facturas Por Cobrar-->
                            <h5 class="mt-4">Lista de Facturas por Cobrar</h5>
                            <ul class="list-group" id="listaFacturasPorCobrar">
                                <?php
                                $conn = Database::getConnection();
                                $sql = "SELECT id, numero_factura FROM facturas_por_cobrar";
                                $result = $conn->query($sql);

                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center" data-id="' . $row['id'] . '">';
                                    echo 'Número de Factura: ' . $row['numero_factura'];
                                    echo '<div>';
                                    echo '<button class="btn btn-sm btn-info mr-2 btn-editar" data-id="' . $row['id'] . '">Editar</button>';
                                    echo '<button class="btn btn-sm btn-danger btn-eliminar" data-id="' . $row['id'] . '">Eliminar</button>';
                                    echo '</div>';
                                    echo '</li>';
                                }

                                $conn = null;
                                ?>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formRegistroFacturasPorCobrar">Registrar Factura</button>
                <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormFacturasPorCobrar()">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para limpiar el formulario
    function resetFormFacturasPorCobrar() {
        document.getElementById('formRegistroFacturasPorCobrar').reset();
    }

    // Manejo del envío del formulario
    document.getElementById('formRegistroFacturasPorCobrar').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Número de Factura"
        const facturaNumeroCobrarInput = document.getElementById('facturaNumeroCobrar');
        if (!formValidator.validarNumeros(facturaNumeroCobrarInput)) {
            isValid = false;
            formValidator.mostrarError(facturaNumeroCobrarInput, 'El número de factura debe ser un número.');
        } else {
            formValidator.quitarError(facturaNumeroCobrarInput);
        }

        // Validación del campo "Monto"
        const facturaMontoCobrarInput = document.getElementById('facturaMontoCobrar');
        if (!formValidator.validarNumeros(facturaMontoCobrarInput)) {
            isValid = false;
            formValidator.mostrarError(facturaMontoCobrarInput, 'El monto debe ser un número.');
        } else {
            formValidator.quitarError(facturaMontoCobrarInput);
        }

        if (!isValid) {
            return; // Detener la ejecución si hay errores de validación
        }

        var form = event.target;
        var formData = new FormData(form);

        fetch('process/process_factura_por_cobrar.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    form.reset();

                    // Actualizar o añadir el elemento en la lista
                    var existingItem = document.querySelector(`#listaFacturasPorCobrar li[data-id="${data.data.id}"]`);
                    if (existingItem) {
                        existingItem.innerHTML = `
                        Número de Factura: ${data.data.numero_factura}
                        <div>
                            <button class="btn btn-sm btn-info mr-2 btn-editar" data-id="${data.data.id}">Editar</button>
                            <button class="btn btn-sm btn-danger btn-eliminar" data-id="${data.data.id}">Eliminar</button>
                        </div>
                        `;
                    } else {
                        var nuevaFactura = document.createElement('li');
                        nuevaFactura.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                        nuevaFactura.setAttribute('data-id', data.data.id);
                        nuevaFactura.innerHTML = `
                        Número de Factura: ${data.data.numero_factura}
                        <div>
                            <button class="btn btn-sm btn-info mr-2 btn-editar" data-id="${data.data.id}">Editar</button>
                            <button class="btn btn-sm btn-danger btn-eliminar" data-id="${data.data.id}">Eliminar</button>
                        </div>
                        `;
                        document.getElementById('listaFacturasPorCobrar').appendChild(nuevaFactura);
                    }

                    $('#modalRegistroFacturasPorCobrar').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });

    // Manejo del botón Editar
    document.getElementById('listaFacturasPorCobrar').addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-editar')) {
            var id = event.target.getAttribute('data-id');
            fetch('process/get_data.php?entity=factura_por_cobrar&id=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        document.getElementById('facturaId').value = data.data.id;
                        document.getElementById('facturaNumeroCobrar').value = data.data.numero_factura;
                        document.getElementById('facturaFechaCobrar').value = data.data.fecha_factura;
                        document.getElementById('facturaMontoCobrar').value = data.data.monto;
                        document.getElementById('facturaEstadoCobrar').value = data.data.estado;
                        document.getElementById('facturaClienteCobrar').value = data.data.cliente_id;
                        document.getElementById('facturaMonedaCobrar').value = data.data.moneda;
                        document.getElementById('facturaDescripcionCobrar').value = data.data.descripcion;
                        $('#modalRegistroFacturasPorCobrar').modal('show');
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });

    // Manejo del botón Eliminar
    document.getElementById('listaFacturasPorCobrar').addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-eliminar')) {
            var id = event.target.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar esta factura?')) {
                fetch('process/delete_data.php?entity=factura_por_cobrar&id=' + id, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert('Factura eliminada correctamente');
                            document.querySelector(`#listaFacturasPorCobrar li[data-id="${id}"]`).remove();
                        } else {
                            alert('Error al eliminar la factura');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    });
</script>