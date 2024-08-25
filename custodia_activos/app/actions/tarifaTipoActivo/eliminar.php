<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/tarifatipoactivo.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $success = eliminarTarifaTipoActivo($conn, $id);
    if ($success) {
        echo "Tarifa tipo activo eliminada con éxito.";
        header("Location: /pages/tarifaActivo.html?success=true");
    } else {
        echo "Error al eliminar la tarifa tipo activo.";
        header("Location: /pages/tarifaActivo.html?error=true");
    }
} else {
    echo "No se proporcionó el ID de la tarifa tipo activo.";
    header("Location: /pages/tarifaActivo.html?error=true");
}
?>
