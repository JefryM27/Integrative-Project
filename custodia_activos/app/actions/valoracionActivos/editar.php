<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/valoracionactivo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $id_activo = $_POST['id_activo'];
    $id_tipoactivo = $_POST['id_tipoactivo'];
    $valor = $_POST['valor'];
    $fecha = $_POST['fecha'];
    $observaciones = $_POST['observaciones'];
    $id_usuario = $_POST['id_usuario'];

    // Actualizar valoración de activo en la base de datos
    if (actualizarValoracionActivo($conn, $id, $id_activo, $id_tipoactivo, $valor, $fecha, $observaciones, $id_usuario)) {
        // Redirigir a la página de gestión de valoraciones de activos con mensaje de éxito
        header("Location: /pages/valorActivo.html?success=true");
        exit();
    } else {
        echo "Error al actualizar la valoración de activo.";
    }
}

// Obtener ID de la valoración de activo desde la URL
$id = $_GET['id'];

// Obtener datos de la valoración de activo desde la base de datos
$valoracionactivo = obtenerValoracionActivoById($conn, $id);

if (!$valoracionactivo) {
    echo "Valoración de activo no encontrada.";
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
