<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/tipoactivo.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar un tipo de activo
if (isset($_POST['descripcion'], $_POST['nombre_activo'], $_POST['clasificacion'])) {
    $descripcion = $_POST['descripcion'];
    $nombre_activo = $_POST['nombre_activo'];
    $clasificacion = $_POST['clasificacion'];

    $id = crearTipoActivo($conn, $descripcion, $nombre_activo, $clasificacion);
    if ($id) {
        header("Location: /pages/tipoActivo.html?success=true");
    } else {
        header("Location: /pages/tipoActivo.html?error=true");
    }
} else {
    header("Location: /pages/tipoActivo.html?error=true");
}
?>
