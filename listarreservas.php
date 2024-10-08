<?php
// Incluir archivo de conexión
include 'conexion.php';

// Consulta SQL para obtener todos los registros de la tabla
$sql = "
    SELECT 
        Reservas.FechaCreacion, 
        Reservas.dia_semana, 
        Reservas.Hora, 
        Usuarios.Nombre, 
        Reservas.nombre_grupo, 
        Espacios.NombreEspacio, 
        Recursos.NombreRecursos
        



    FROM 
        Reservas
    INNER JOIN 
        Usuarios ON Reservas.UsuarioID = Usuarios.UsuarioID
    INNER JOIN 
        Espacios ON Reservas.EspacioID = Espacios.EspacioID
    INNER JOIN 
        Recursos ON Reservas.RecursoID = Recursos.ID
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bulma.css">
    <title>Lista de Reservas</title>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Lista de Reservas</h1>
            <?php
            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Mostrar los resultados en una tabla HTML
                echo "<table class='table is-striped is-hoverable'>
                        <thead>
                            <tr>
                                <th>Fecha de reserva</th>
                                <th>Dia reservado</th>
                                <th>Hora</th>
                                <th>Docente</th>
                                <th>Grupo</th>
                                <th>Espacio</th>
                                <th>Recursos adicionales</th>

                          
                            </tr>
                        </thead>
                        <tbody>";
                // Salida de datos de cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["FechaCreacion"]). "</td>  
                             <td>" . htmlspecialchars($row["dia_semana"]). "</td>                 
                             <td>" . htmlspecialchars($row["Hora"]). "</td>
                            <td>" . htmlspecialchars($row["Nombre"]). "</td>
                            <td>" . htmlspecialchars($row["nombre_grupo"]). "</td>    
                            <td>" . htmlspecialchars($row["NombreEspacio"]). "</td> 
                            <td>" . htmlspecialchars($row["NombreRecursos"]). "</td> 
                          
                           
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