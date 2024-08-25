<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/valoracionactivo.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $success = eliminarValoracionActivo($conn, $id);
    if ($success) {
        echo "Valoración de activo eliminada con éxito.";
        header("Location: /pages/valorActivo.html?success=true");
    } else {
        echo "Error al eliminar la valoración de activo.";
        header("Location: /pages/valorActivo.html?error=true");
    }
} else {
    echo "No se proporcionó el ID de la valoración de activo.";
    header("Location: /pages/valorActivo.html?error=true");
}
?>
