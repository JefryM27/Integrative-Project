<?php
require_once '../db_connection.php';
require_once '../classes/Proveedor.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $proveedor = Proveedor::getById($id);

    if ($proveedor) {
        echo json_encode([
            "status" => "success",
            "data" => [
                "id" => $proveedor->getId(),
                "nombre" => $proveedor->getNombre(),
                "cedula" => $proveedor->getCedula(),
                "direccion" => $proveedor->getDireccion(),
                "telefono" => $proveedor->getTelefono(),
                "email" => $proveedor->getEmail()
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Proveedor no encontrado"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ID de proveedor no proporcionado"]);
}
