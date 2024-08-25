<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/auditoria.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fecha = $_POST['fecha'];
    $resultado = $_POST['resultado'];
    $id_activo = $_POST['id_activo'];

    // Actualizar auditoría en la base de datos
    if (actualizarAuditoria($conn, $id, $fecha, $resultado, $id_activo)) {
        // Redirigir a la página de gestión de auditorías con mensaje de éxito
        header("Location: /pages/auditorias.html?success=true");
        exit();
    } else {
        echo "Error al actualizar la auditoría.";
    }
}

// Obtener ID de la auditoría desde la URL
$id = $_GET['id'];

// Obtener datos de la auditoría desde la base de datos
$auditoria = obtenerActivoPorId($conn, $id);

if (!$auditoria) {
    echo "Auditoría no encontrada.";
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
