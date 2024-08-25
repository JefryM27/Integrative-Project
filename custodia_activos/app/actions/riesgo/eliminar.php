<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/riesgo.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $success = eliminarRiesgo($conn, $id);
    if ($success) {
        echo "Riesgo eliminado con éxito.";
        header("Location: /pages/gestionRiesgo.html?success=true");
    } else {
        echo "Error al eliminar el riesgo.";
        header("Location: /pages/gestionRiesgo.html?error=true");
    }
} else {
    echo "No se proporcionó el ID del riesgo.";
    header("Location: /pages/gestionRiesgo.html?error=true");
}
?>
