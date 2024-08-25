<?php
include "../utils/database.php";

$conn = getDbConnection();

if ($conn && !$conn->connect_error) {
    echo "Conexión exitosa";
} else {
    echo "Error de conexión: " . $conn->connect_error;
}


$conn = getDbConnection();


if (!$conn || $conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "Conexión establecida correctamente.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $fecha_caducidad_doc = $_POST['fecha_caducidad_doc'];
    $edad = $_POST['edad'];
    $estado_civil = $_POST['estado_civil'];
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $direccion2 = $_POST['direccion2'];
    $direccion3 = $_POST['direccion3'];
    $telefono = $_POST['telefono'];
    $telefono2 = $_POST['telefono2'];
    $telefono3 = $_POST['telefono3'];
    $correo_electronico = $_POST['correo_electronico'];
    $correo_electronico2 = $_POST['correo_electronico2'];
    $correo_electronico3 = $_POST['correo_electronico3'];

    $sql = "INSERT INTO clientes 
        (nombre, apellido, tipo_documento, numero_documento, fecha_caducidad_doc, edad, estado_civil, descripcion, direccion, direccion2, direccion3, telefono, telefono2, telefono3, correo_electronico, correo_electronico2, correo_electronico3) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssssssssssss", 
            $nombre, $apellido, $tipo_documento, $numero_documento, 
            $fecha_caducidad_doc, $edad, $estado_civil, $descripcion, 
            $direccion, $direccion2, $direccion3, 
            $telefono, $telefono2, $telefono3, 
            $correo_electronico, $correo_electronico2, $correo_electronico3);

        if ($stmt->execute()) {
            header("Location: ../clientes/success.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close();
}
?>
