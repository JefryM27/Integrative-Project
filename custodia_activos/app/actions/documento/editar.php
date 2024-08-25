<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/documento.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $id_tipoactivo = $_POST['id_tipoactivo'];
    $id_localizacion = $_POST['id_localizacion'];

    // Actualizar documento en la base de datos
    if (actualizarDocumento($conn, $id, $descripcion, $fecha, $id_tipoactivo, $id_localizacion)) {
        // Redirigir a la página de gestión de documentos con mensaje de éxito
        header("Location: /pages/documentos.html?success=true");
        exit();
    } else {
        echo "Error al actualizar el documento.";
    }
}

// Obtener ID del documento desde la URL
$id = $_GET['id'];

// Obtener datos del documento desde la base de datos
$documento = obtenerDocumentoPorId($conn, $id);

if (!$documento) {
    echo "Documento no encontrado.";
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
