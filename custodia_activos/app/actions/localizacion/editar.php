<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/localizacion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $numero_expediente = $_POST['numero_expediente'];
    $sucursal = $_POST['sucursal'];
    $archivo = $_POST['archivo'];
    $id_boveda = $_POST['id_boveda'];

    // Actualizar localización en la base de datos
    if (actualizarLocalizacion($conn, $id, $numero_expediente, $sucursal, $archivo, $id_boveda)) {
        // Redirigir a la página de gestión de localizaciones con mensaje de éxito
        header("Location: /pages/localizacion.html?success=true");
        exit();
    } else {
        echo "Error al actualizar la localización.";
    }
}

// Obtener ID de la localización desde la URL
$id = $_GET['id'];

// Obtener datos de la localización desde la base de datos
$localizacion = obtenerLocalizacionPorId($conn, $id);

if (!$localizacion) {
    echo "Localización no encontrada.";
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
