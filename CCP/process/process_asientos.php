<?php
require_once '../db_connection.php';
require_once '../classes/Asiento.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $monto = $_POST['monto'];
    $cuenta_debe = $_POST['cuenta_debe'];
    $cuenta_haber = $_POST['cuenta_haber'];
    $estado = $_POST['estado'];
    $tipo = $_POST['tipo'];

    $asiento = new Asiento($descripcion, $fecha, $monto, $cuenta_debe, $cuenta_haber, $estado, $tipo);

    if ($asiento->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Asiento registrado correctamente"
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el asiento"]);
    }
}
