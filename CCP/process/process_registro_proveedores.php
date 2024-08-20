<?php
require_once '../db_connection.php';
require_once '../classes/Proveedor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $proveedor = new Proveedor($nombre, $cedula, $direccion, $telefono, $email, $id);

    if ($proveedor->save()) {
        echo json_encode([
            "status" => "success",
            "message" => "Proveedor registrado correctamente",
            "data" => [
                "id" => $proveedor->getId(),
                "nombre" => $nombre,
                "cedula" => $cedula,
                "direccion" => $direccion,
                "telefono" => $telefono,
                "email" => $email
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el proveedor"]);
    }
}
