<?php
$servername = "localhost";
$username = "lfnavas@localhost";
$password = "N@vas35.*+";
$dbname = "reservas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
