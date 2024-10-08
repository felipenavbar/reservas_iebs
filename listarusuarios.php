<?php

// Conexión a la base de datos
$conn = new mysqli("localhost", "lfnavas@localhost", "N@vas35.*+", "reservas");

// Manejo de errores para la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los registros de la tabla
$sql = "SELECT UsuarioID, Nombre, Email FROM Usuarios";
$result = $conn->query($sql);

// Manejo de errores para la consulta SQL
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bulma.css">
    <title>Lista de Usuarios</title>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Lista de Usuarios</h1>
            <?php
            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Mostrar los resultados en una tabla HTML
                echo "<table class='table is-striped is-hoverable'>
                        <thead>
                            <tr>
                                <th>UsuarioID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Contraseña</th>
                            </tr>
                        </thead>
                        <tbody>";
                // Salida de datos de cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["UsuarioID"]). "</td>
                            <td>" . htmlspecialchars($row["Nombre"]). "</td>
                            <td>" . htmlspecialchars($row["Email"]). "</td>
                            <td>" . htmlspecialchars($row["Contraseña"]). "</td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='notification is-warning'>0 resultados</div>";
            }

            // Cerrar conexión
            $conn->close();
            ?>
        </div>
    </section>
</body>
</html> = new mysqli("localhost", "lfnavas@localhost", "N@vas35.*+", "reservas");

// Manejo de errores para la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los registros de la tabla
$sql = "SELECT UsuarioID, Nombre, Email, Contraseña FROM Usuarios";
$result = $conn->query($sql);

// Manejo de errores para la consulta SQL
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bulma.css">
    <title>Lista de Usuarios</title>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Lista de Usuarios</h1>
            <?php
            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Mostrar los resultados en una tabla HTML
                echo "<table class='table is-striped is-hoverable'>
                        <thead>
                            <tr>
                                <th>UsuarioID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Contraseña</th>
                            </tr>
                        </thead>
                        <tbody>";
                // Salida de datos de cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["UsuarioID"]). "</td>
                            <td>" . htmlspecialchars($row["Nombre"]). "</td>
                            <td>" . htmlspecialchars($row["Email"]). "</td>
                            <td>" . htmlspecialchars($row["Contraseña"]). "</td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='notification is-warning'>0 resultados</div>";
            }

            // Cerrar conexión
            $conn->close();
            ?>
        </div>
    </section>
</body>
</html>