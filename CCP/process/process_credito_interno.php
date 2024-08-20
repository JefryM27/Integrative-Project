<?php
require_once '../db_connection.php';
require_once '../classes/CreditoInterno.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $monto = $_POST['monto'];
    $plazo = $_POST['plazo'];
    $tasa_interes = $_POST['tasa_interes'];
    $fecha_solicitud = $_POST['fecha_solicitud'];
    $cliente_id = $_POST['cliente_id'];
    $estado = $_POST['estado'];

    $creditoInterno = new CreditoInterno($monto, $plazo, $tasa_interes, $fecha_solicitud, $cliente_id, $estado);

    if ($creditoInterno->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Crédito registrado correctamente",
            "data" => [
                "id" => $creditoInterno->getId(),
                "monto" => $monto,
                "plazo" => $plazo,
                "tasa_interes" => $tasa_interes,
                "fecha_solicitud" => $fecha_solicitud,
                "cliente_id" => $cliente_id,
                "estado" => $estado
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el crédito"]);
    }
}
