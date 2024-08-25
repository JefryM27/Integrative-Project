<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/documento.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $success = eliminarDocumento($conn, $id);
    if ($success) {
        echo "Documento eliminado con éxito.";
        header("Location: /pages/documentos.html?success=true");
    } else {
        echo "Error al eliminar el documento.";
        header("Location: /pages/documentos.html?error=true");
    }
} else {
    echo "No se proporcionó el ID del documento.";
    header("Location: /pages/documentos.html?error=true");
}
?>
