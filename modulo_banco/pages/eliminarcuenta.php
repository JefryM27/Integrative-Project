<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cuentas</title>
    <link rel="stylesheet" href="../bancos/css/style_eliminarcuentas.css">
</head>
<body>
<main>
    <div class="content">
        <div class="header">
            <div class="top-buttons">
                <button onclick="window.location.href = 'cuentas_bancarias.php'">
                    <img src="../bancos/imagen/atras.png" alt="Atrás">
                </button>
                <h1>Banco de Ahorro y Créditos</h1>
                <button onclick="window.location.href='index.php'">
                    <img src="../bancos/imagen/cerrar seccion.png" alt="Cerrar Sesión">
                </button>
            </div>
        </div>
        <div class="header1">
            <h1>Eliminar Cuentas</h1>
        </div>
        <div class="container">
            <p>¿Estás seguro de que deseas eliminar todas las cuentas?</p>
            <div class="action-buttons">
                <form id="deleteForm" method="POST" action="eliminarcuentas.php">
                    <button type="submit" name="confirmDelete">Eliminar Todas las Cuentas</button>
                </form>
                <button onclick="window.location.href='vercuentas.php'">Cancelar</button>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2024 Sistema de Gestión Bancaria. Todos los derechos reservados.</p>
        </div>
    </div>
</main>
</body>
</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de conexión a la base de datos
include 'connection.php'; // Asegúrate de que la ruta sea correcta

// Verificar si se ha enviado el formulario de eliminación
if (isset($_POST['confirmDelete'])) {
    // Preparar la consulta para eliminar todos los registros de la tabla
    $query = "DELETE FROM cuentas";
    $stmt = $conn->prepare($query);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute()) {
        // Redirigir al usuario con un mensaje de éxito
        header("Location: vercuentas.php?message=Todas las cuentas han sido eliminadas exitosamente");
        exit();
    } else {
        // Redirigir al usuario con un mensaje de error
        header("Location: vercuentas.php?message=Error al eliminar las cuentas");
        exit();
    }
} else {
    // Redirigir al usuario con un mensaje de error si el formulario no se ha enviado correctamente
    header("Location: vercuentas.php?message=No se recibió la solicitud de eliminación");
    exit();
}
?>
