<?php
require '../utils/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $cuenta = $_POST['cuenta'];
    $denominacion = $_POST['denominacion'];
    $debe = $_POST['debe'];
    $haber = $_POST['haber'];

    if (empty($fecha) || empty($cuenta) || empty($denominacion) || empty($debe) || empty($haber)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    $sql = "INSERT INTO AsientosContables (fecha, cuenta, denominacion, debe, haber) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sssss", $fecha, $cuenta, $denominacion, $debe, $haber);

        if ($stmt->execute()) {
            echo "Asiento creado con éxito.";
        } else {
            echo "Error al crear el asiento contable: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $mysqli->error;
    }

    $mysqli->close();
} else {
    echo "Método de solicitud no permitido.";
}
