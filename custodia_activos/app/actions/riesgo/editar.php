<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/riesgo.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $nivel = $_POST['nivel'];
    $id_activo = $_POST['id_activo'];
    $tipo_riesgo = $_POST['tipo_riesgo'];

    // Actualizar riesgo en la base de datos
    if (actualizarRiesgo($conn, $id, $descripcion, $nivel, $id_activo, $tipo_riesgo)) {
        // Redirigir a la página de gestión de riesgos con mensaje de éxito
        header("Location: /pages/gestionRiesgo.html?success=true");
        exit();
    } else {
        echo "Error al actualizar el riesgo.";
    }
}

// Obtener ID del riesgo desde la URL
$id = $_GET['id'];

// Obtener datos del riesgo desde la base de datos
$riesgo = obtenerRiesgoPorId($conn, $id);

if (!$riesgo) {
    echo "Riesgo no encontrado.";
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
