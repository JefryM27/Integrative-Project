<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/tipoactivo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $nombre_activo = $_POST['nombre_activo'];
    $clasificacion = $_POST['clasificacion'];

    // Actualizar tipo de activo en la base de datos
    if (actualizarTipoActivo($conn, $id, $descripcion, $nombre_activo, $clasificacion)) {
        // Redirigir a la página de gestión de tipos de activo con mensaje de éxito
        header("Location: /pages/tipoActivo.html?success=true");
        exit();
    } else {
        echo "Error al actualizar el tipo de activo.";
    }
}

// Obtener ID del tipo de activo desde la URL
$id = $_GET['id'];

// Obtener datos del tipo de activo desde la base de datos
$tipoactivo = obtenerTipoActivoPorId($conn, $id);

if (!$tipoactivo) {
    echo "Tipo de activo no encontrado.";
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
