<?php
function getDbConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "root!@123";
    $dbname = "colocacion";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    } 
    return $conn;
}
?>
