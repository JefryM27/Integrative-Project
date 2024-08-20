<?php
require_once '../db_connection.php';
require_once '../classes/Interes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $credito_id = $_POST['credito_id'];
    $monto_interes = $_POST['monto_interes'];
    $fecha_cobro = $_POST['fecha_cobro'];
    $estado = $_POST['estado'];

    $interes = new Interes($credito_id, $monto_interes, $fecha_cobro, $estado, $id);

    if ($interes->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Interés registrado correctamente",
            "data" => [
                "id" => $interes->getId(),
                "credito_id" => $credito_id,
                "monto_interes" => $monto_interes,
                "fecha_cobro" => $fecha_cobro,
                "estado" => $estado
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el interés"]);
    }
}
