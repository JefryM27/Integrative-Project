
<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/auditoria.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $success = eliminarAuditoria($conn, $id);
    if ($success) {
        echo "Auditoría eliminada con éxito.";
        header("Location: /pages/auditorias.html?success=true");
    } else {
        echo "Error al eliminar la auditoría.";
        header("Location: /pages/auditorias.html?error=true");
    }
} else {
    echo "No se proporcionó el ID de la auditoría.";
    header("Location: /pages/auditorias.html?error=true");
}
?>
