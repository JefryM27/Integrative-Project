<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $monto = $_POST['monto'];
    $tipoCobro = $_POST['tipoCobro'];
    $numeroCaso = $_POST['numeroCaso'];
    $nombreAbogado = isset($_POST['nombreAbogado']) ? $_POST['nombreAbogado'] : null;

    // Aquí puedes agregar el código para guardar los datos en la base de datos o realizar otra acción.
    // Ejemplo de mensaje de respuesta:

    echo "Cobro realizado con éxito para el socio $nombre por un monto de $monto.";
} else {
    echo "Método de solicitud no permitido.";
}
?>
