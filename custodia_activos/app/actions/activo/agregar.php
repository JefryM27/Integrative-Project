<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/activos.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar un activo
if (isset($_POST['nombre_activo'], $_POST['id_tipoactivo'], $_POST['numero_serie'], $_POST['valor'], $_POST['id_localizacion'], $_POST['estado'], $_POST['id_cliente'])) {
    $nombre_activo = $_POST['nombre_activo'];
    $id_tipoactivo = $_POST['id_tipoactivo'];
    $numero_serie = $_POST['numero_serie'];
    $valor = $_POST['valor'];
    $id_localizacion = $_POST['id_localizacion'];
    $estado = $_POST['estado'];
    $id_cliente = $_POST['id_cliente'];

    // Llamada a la función crearActivo sin la fecha_adquisicion
    $id = crearActivo($nombre_activo, $id_tipoactivo, $numero_serie, $valor, $id_localizacion, $estado, $id_cliente);
    if ($id) {
        header("Location: /pages/inventarioActivos.php?success=true");
        exit();
    } else {
        header("Location: /pages/inventarioActivos.php?error=true");
        exit();
    }
} else {
    // Mensaje de error indicando los parámetros faltantes
    $missing_params = array();
    if (!isset($_POST['nombre_activo'])) $missing_params[] = 'nombre_activo';
    if (!isset($_POST['id_tipoactivo'])) $missing_params[] = 'id_tipoactivo';
    if (!isset($_POST['numero_serie'])) $missing_params[] = 'numero_serie';
    if (!isset($_POST['valor'])) $missing_params[] = 'valor';
    if (!isset($_POST['id_localizacion'])) $missing_params[] = 'id_localizacion';
    if (!isset($_POST['estado'])) $missing_params[] = 'estado';
    if (!isset($_POST['id_cliente'])) $missing_params[] = 'id_cliente';

    $error_message = 'missing_params: ' . implode(', ', $missing_params);
    header("Location: /pages/inventarioActivos.php?error=" . urlencode($error_message));
    exit();
}
?>
