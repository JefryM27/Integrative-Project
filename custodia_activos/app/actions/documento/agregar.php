<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/documento.php');

// Validar que se están recibiendo todos los parámetros requeridos para insertar un documento
if (isset($_POST['descripcion'], $_POST['fecha'], $_POST['id_tipoactivo'], $_POST['id_localizacion'])) {
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $id_tipoactivo = $_POST['id_tipoactivo'];
    $id_localizacion = $_POST['id_localizacion'];

    $id = crearDocumento($conn, $descripcion, $fecha, $id_tipoactivo, $id_localizacion);
    if ($id) {
        header("Location: /pages/documentos.html?success=true");
    } else {
        header("Location: /pages/documentos.html?error=true");
    }
} else {
    header("Location: /pages/documentos.html?error=true");
}
?>
