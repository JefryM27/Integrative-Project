<?php
require_once "../utils/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $mysqli->real_escape_string($_POST['username']);
    $contraseña = $mysqli->real_escape_string($_POST['password']);

    $query = "SELECT id, usuario, contraseña FROM Usuarios WHERE usuario = '$usuario'";
    $result = $mysqli->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($contraseña === $row['contraseña']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['usuario'] = $row['usuario'];

            header("Location: ../pages/agregarDinero.php");
            exit;
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}
