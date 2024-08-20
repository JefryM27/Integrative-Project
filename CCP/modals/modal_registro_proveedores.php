<?php
require_once 'db_connection.php';
?>
<!-- Modal Registro de Proveedores -->
<div class="modal fade" id="modalRegistroProveedores" tabindex="-1" aria-labelledby="modalRegistroProveedoresLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistroProveedoresLabel">Registro de Proveedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetForm()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario Registro de Proveedores -->
                <form id="formRegistroProveedores" method="post" action="process/process_registro_proveedores.php">
                    <input type="hidden" id="proveedorId" name="id" />
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required />
                    </div>
                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" required />
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required />
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <button type="button" class="btn btn-close-red" data-dismiss="modal" onclick="resetForm()">Cerrar</button>
                </form>
                <hr>
                <!-- Lista de Proveedores -->
                <h5>Lista de Proveedores</h5>
                <ul class="list-group" id="listaProveedores">
                    <?php
                    $conn = Database::getConnection();
                    $sql = "SELECT id, nombre FROM proveedores";
                    $result = $conn->query($sql);

                    echo '<ul class="list-group">';
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center" data-id="' . $row['id'] . '">';
                        echo $row['nombre'];
                        echo '<div>';
                        echo '<button class="btn btn-sm btn-info mr-2" onclick="editarProveedor(' . $row['id'] . ')">Editar</button>';
                        echo '<button class="btn btn-sm btn-danger" onclick="eliminarProveedor(' . $row['id'] . ')">Eliminar</button>';
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
    function resetForm() {
        document.getElementById('formRegistroProveedores').reset();
    }

    document.getElementById('formRegistroProveedores').addEventListener('submit', function(event) {
        event.preventDefault();

        var isValid = true;

        if (!formValidator.validarTexto(document.getElementById('nombre'))) {
            isValid = false;
            formValidator.mostrarError(document.getElementById('nombre'), 'El nombre solo debe contener letras.');
        } else {
            formValidator.quitarError(document.getElementById('nombre'));
        }

        if (!formValidator.validarCedula(document.getElementById('cedula'))) {
            isValid = false;
            formValidator.mostrarError(document.getElementById('cedula'), 'La cédula debe tener 9 dígitos.');
        } else {
            formValidator.quitarError(document.getElementById('cedula'));
        }

        if (!formValidator.validarTelefono(document.getElementById('telefono'))) {
            isValid = false;
            formValidator.mostrarError(document.getElementById('telefono'), 'El número de teléfono debe tener 8 dígitos.');
        } else {
            formValidator.quitarError(document.getElementById('telefono'));
        }

        if (!formValidator.validarCorreo(document.getElementById('email'))) {
            isValid = false;
            formValidator.mostrarError(document.getElementById('email'), 'Ingrese un correo electrónico válido.');
        } else {
            formValidator.quitarError(document.getElementById('email'));
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

                    var nuevoProveedor = document.createElement('li');
                    nuevoProveedor.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                    nuevoProveedor.setAttribute('data-id', data.data.id);
                    nuevoProveedor.innerHTML = `
                    ${data.data.nombre}
                    <div>
                        <button class="btn btn-sm btn-info mr-2" onclick="editarProveedor(${data.data.id})">Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarProveedor(${data.data.id})">Eliminar</button>
                    </div>
                `;
                    document.getElementById('listaProveedores').appendChild(nuevoProveedor);

                    $('#modalRegistroProveedores').modal('hide');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    });

    function editarProveedor(id) {
        fetch(`process/get_data.php?entity=proveedor&id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    document.getElementById('proveedorId').value = data.data.id;
                    document.getElementById('nombre').value = data.data.nombre;
                    document.getElementById('cedula').value = data.data.cedula;
                    document.getElementById('direccion').value = data.data.direccion;
                    document.getElementById('telefono').value = data.data.telefono;
                    document.getElementById('email').value = data.data.email;
                    $('#modalRegistroProveedores').modal('show');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function eliminarProveedor(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este proveedor?')) {
            fetch(`process/delete_data.php?entity=proveedor&id=${id}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Proveedor eliminado correctamente');
                        document.querySelector(`#listaProveedores li[data-id="${id}"]`).remove();
                    } else {
                        alert('Error al eliminar el proveedor');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>