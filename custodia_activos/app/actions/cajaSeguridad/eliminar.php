<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/cajaseguridad.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $success = eliminarCajaSeguridad($id);
    if ($success) {
        header("Location: /pages/cajasSeguridad.php?success=true");
    } else {
        header("Location: /pages/cajasSeguridad.php?error=true");
    }
} else {
    header("Location: /pages/cajasSeguridad.php?error=true");
}
?>
