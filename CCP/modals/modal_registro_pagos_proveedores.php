<?php
require_once 'db_connection.php';
?>
<!-- Modal Registro de Pagos a Proveedores -->
<div class="modal fade" id="modalPagosProveedores" tabindex="-1" aria-labelledby="modalPagosProveedoresLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPagosProveedoresLabel">Pagos a Proveedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormPagosProveedores()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Registro de Pagos a Proveedores -->
                <form id="formRegistroPagosProveedores" method="post" action="process/process_pagos_proveedores.php">
                    <input type="hidden" id="pagoProveedorId" name="id" />
                    <div class="form-group">
                        <label for="montoPago">Monto del Pago</label>
                        <input type="number" class="form-control" id="montoPago" name="monto" required />
                    </div>
                    <div class="form-group">
                        <label for="fechaPago">Fecha del Pago</label>
                        <input type="date" class="form-control" id="fechaPago" name="fecha_pago" required />
                    </div>
                    <div class="form-group">
                        <label for="metodoPago">Método de Pago</label>
                        <select class="form-control" id="metodoPago" name="metodo_pago" required>
                            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="proveedorPago">Nombre del Proveedor</label>
                        <select class="form-control" id="proveedorPago" name="proveedor_id" required>
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
                        <label for="monedaPago">Moneda</label>
                        <select class="form-control" id="monedaPago" name="moneda" required>
                            <option value="Colones">Colones</option>
                            <option value="Dólares">Dólares</option>
                            <option value="Euros">Euros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="conceptoPago">Concepto</label>
                        <input type="text" class="form-control" id="conceptoPago" name="concepto" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Pago</button>
                    <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetFormPagosProveedores()">Cerrar</button>
                </form>
                <hr>
                <!-- Lista de Pagos a Proveedores -->
                <h5>Lista de Pagos a Proveedores</h5>
                <ul class="list-group" id="listaPagosProveedores">
                    <?php
                    $conn = Database::getConnection();
                    $sql = "SELECT id, concepto FROM pagos_proveedores";
                    $result = $conn->query($sql);

                    echo '<ul class="list-group">';
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center" data-id="' . $row['id'] . '">';
                        echo $row['concepto'];
                        echo '<div>';
                        echo '<button class="btn btn-sm btn-info mr-2" onclick="editarPago(' . $row['id'] . ')">Editar</button>';
                        echo '<button class="btn btn-sm btn-danger" onclick="eliminarPago(' . $row['id'] . ')">Eliminar</button>';
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
    function resetFormPagosProveedores() {
        document.getElementById('formRegistroPagosProveedores').reset();
    }

    // Manejo del envío del formulario
    document.getElementById('formRegistroPagosProveedores').addEventListener('submit', function(event) {
        event.preventDefault();

        let isValid = true;

        // Validación del campo "Monto del Pago"
        const montoPagoInput = document.getElementById('montoPago');
        if (!formValidator.validarNumeros(montoPagoInput)) {
            isValid = false;
            formValidator.mostrarError(montoPagoInput, 'El monto debe ser un número.');
        } else {
            formValidator.quitarError(montoPagoInput);
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

                    var nuevoPago = document.createElement('li');
                    nuevoPago.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                    nuevoPago.setAttribute('data-id', data.data.id);
                    nuevoPago.innerHTML = `
                    Concepto: ${data.data.concepto}
                    <div>
                        <button class="btn btn-sm btn-info mr-2" onclick="editarPago(${data.data.id})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarPago(${data.data.id})">Eliminar</button>
                    </div>
                `;
                    document.getElementById('listaPagosProveedores').appendChild(nuevoPago);

                    $('#modalPagosProveedores').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });

    function editarPago(id) {
        fetch(`process/get_data.php?entity=pago_proveedor&id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    document.getElementById('pagoProveedorId').value = data.data.id;
                    document.getElementById('montoPago').value = data.data.monto;
                    document.getElementById('fechaPago').value = data.data.fecha_pago;
                    document.getElementById('metodoPago').value = data.data.metodo_pago;
                    document.getElementById('proveedorPago').value = data.data.proveedor_id;
                    document.getElementById('monedaPago').value = data.data.moneda;
                    document.getElementById('conceptoPago').value = data.data.concepto;
                    $('#modalPagosProveedores').modal('show');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function eliminarPago(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este pago?')) {
            fetch(`process/delete_data.php?entity=pago_proveedor&id=${id}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Pago eliminado correctamente');
                        document.querySelector(`#listaPagosProveedores li[data-id="${id}"]`).remove();
                    } else {
                        alert('Error al eliminar el pago');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>