<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/tipoactivo.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $success = eliminarTipoActivo($conn, $id);
    if ($success) {
        echo "Tipo de activo eliminado con éxito.";
        header("Location: /pages/tipoActivo.html?success=true");
    } else {
        echo "Error al eliminar el tipo de activo.";
        header("Location: /pages/tipoActivo.html?error=true");
    }
} else {
    echo "No se proporcionó el ID del tipo de activo.";
    header("Location: /pages/tipoActivo.html?error=true");
}
?>
