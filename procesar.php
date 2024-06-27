<?php
// Mostrar errores (solo en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Datos de la conexión a la base de datos
$servername = "localhost";
$username = "lfnavas@localhost"; // Cambia esto si tu configuración de MySQL tiene un usuario diferente
$password = "N@vas35.*+"; // Cambia esto si tu usuario tiene una contraseña diferente
$dbname = "reservas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$pass = $_POST['pass'];

// Preparar y ejecutar la inserción en la base de datos
$stmt = $conn->prepare("INSERT INTO usuarios (cedula, nombre, pass) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $cedula, $nombre, $pass);

if ($stmt->execute()) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
