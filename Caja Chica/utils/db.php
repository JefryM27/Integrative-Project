<?php
$mysqli = new mysqli("localhost", "root", "", "cajachicadb");
if (mysqli_connect_errno()) {
    printf("Conexión fallida", mysqli_connect_error());
} else {
    printf("");
}
