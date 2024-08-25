<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/cobroactivo.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $success = eliminarCobroActivo($conn, $id);
    if ($success) {
        echo "Cobro de activo eliminado con éxito.";
        header("Location: /pages/cobroActivos.html?success=true");
    } else {
        echo "Error al eliminar el cobro de activo.";
        header("Location: /pages/cobroActivos.html?error=true");
    }
} else {
    echo "No se proporcionó el ID del cobro de activo.";
    header("Location: /pages/cobroActivos.html?error=true");
}
?>
