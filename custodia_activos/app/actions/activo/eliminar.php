<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/models/activos.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Asegúrate de que el ID es un número entero
    $conn = get_mysql_connection();

    $success = eliminarActivo($conn, $id);

    if ($success) {
        header("Location: /pages/inventarioActivos.php?success=true");
    } else {
        header("Location: /pages/inventarioActivos.php?error=true");
    }

    $conn->close(); // Cerrar la conexión a la base de datos
} else {
    header("Location: /pages/inventarioActivos.php?error=true");
}
?>
