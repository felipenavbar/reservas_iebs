<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servidor = "localhost";
$usuario = "lfnavas@localhost";
$contraseña = "N@vas35.*+";
$base_datos = "reservas";

// Crear la conexión
$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si las variables están definidas
if (!isset($_POST['email_docente'], $_POST['nombre_grupo'], $_POST['fecha_reserva'], $_POST['hora_inicio'], $_POST['hora_fin'], $_POST['espacio'], $_POST['recurso'])) {
    die("Error: Faltan datos en el formulario.");
}

$email_docente = $_POST['email_docente'];
$nombre_grupo = $_POST['nombre_grupo'];
$fecha_reserva = $_POST['fecha_reserva'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fin = $_POST['hora_fin'];
$espacio = $_POST['espacio'];
$recurso = $_POST['recurso'];

// Insertar nueva reserva
$sql_insertar_reserva = "INSERT INTO Reservas (email_docente, nombre_grupo, fecha_reserva, hora_inicio, hora_fin, Espacio, Recurso) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt_insertar_reserva = $conexion->prepare($sql_insertar_reserva);
if (!$stmt_insertar_reserva) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}
$stmt_insertar_reserva->bind_param("sssssss", $email_docente, $nombre_grupo, $fecha_reserva, $hora_inicio, $hora_fin, $espacio, $recurso);
if ($stmt_insertar_reserva->execute()) {
    echo "Reserva creada con éxito.";
} else {
    echo "Error al crear la reserva: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
