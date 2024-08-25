<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/activos.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_activo = isset($_POST['id_activo']) ? trim($_POST['id_activo']) : '';
    $nombre_activo = isset($_POST['nombre_activo']) ? trim($_POST['nombre_activo']) : '';
    $id_tipoactivo = isset($_POST['id_tipoactivo']) ? trim($_POST['id_tipoactivo']) : '';
    $numero_serie = isset($_POST['numero_serie']) ? trim($_POST['numero_serie']) : '';
    $valor = isset($_POST['valor']) ? trim($_POST['valor']) : '';
    $id_localizacion = isset($_POST['id_localizacion']) ? trim($_POST['id_localizacion']) : '';
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
    $id_cliente = isset($_POST['id_cliente']) ? trim($_POST['id_cliente']) : '';

    // Verifica que todos los parámetros estén presentes
    if (isset($id_activo, $nombre_activo, $id_tipoactivo, $numero_serie, $valor, $id_localizacion, $estado, $id_cliente)) {
        // Depura los valores recibidos
        error_log("Valores recibidos: id_activo=$id_activo, nombre_activo=$nombre_activo, id_tipoactivo=$id_tipoactivo, numero_serie=$numero_serie, valor=$valor, id_localizacion=$id_localizacion, estado=$estado, id_cliente=$id_cliente");

        $resultado = actualizarActivo($id_activo, $nombre_activo, $id_tipoactivo, $numero_serie, $valor, $id_localizacion, $fecha_adquisicion, $estado, $id_cliente);

        if ($resultado) {
            header('Location: /pages/inventarioActivos.php?message=Activo actualizado');
        } else {
            header('Location: /pages/inventarioActivos.php?message=Error al actualizar activo');
        }
    } else {
        header('Location: /pages/inventarioActivos.php?message=Parámetros faltantes');
    }
    exit();
}
?>
