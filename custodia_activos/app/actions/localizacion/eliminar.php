<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/localizacion.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $success = eliminarLocalizacion($conn, $id);
    if ($success) {
        echo "Localización eliminada con éxito.";
        header("Location: /pages/localizacion.html?success=true");
    } else {
        echo "Error al eliminar la localización.";
        header("Location: /pages/localizacion.html?error=true");
    }
} else {
    echo "No se proporcionó el ID de la localización.";
    header("Location: /pages/localizacion.html?error=true");
}
?>
