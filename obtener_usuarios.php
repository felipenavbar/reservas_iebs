<?php
// Incluir archivo de conexión
include 'conexion.php';

// Consulta SQL para obtener usuarios
$sql = "SELECT UsuarioID, Nombre, Email FROM Usuarios";
$result = $conn->query($sql);

$usuarios = array();

if ($result->num_rows > 0) {
	// Procesar resultados
	while($row = $result->fetch_assoc()) {
		$usuarios[] = $row;
	}
} else {
	echo "0 resultados";
}

// Cerrar conexión
$conn->close();

// Devolver resultados en formato JSON
header('Content-Type: application/json');
echo json_encode($usuarios);
?>