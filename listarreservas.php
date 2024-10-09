<?php
// Incluir archivo de conexión
include 'conexion.php';

// Consulta SQL para obtener todos los registros de la tabla
$sql = "
    SELECT 
         
        Reservas.email_docente, 
        Reservas.nombre_grupo, 
        Reservas.fecha_reserva,
        Reservas.hora_inicio,
        Reservas.hora_fin,
        Reservas.Espacio,
        Reservas.Recurso

    FROM 
        Reservas
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
                                <th>Usuario</th>
                                <th>Curso</th>
                                <th>Fecha</th>
                                <th>Hora de inicio</th>
                                <th>Hora de Finalización</th>
                                <th>Espacio</th>
                                <th>Recursos adicionales</th>

                          
                            </tr>
                        </thead>
                        <tbody>";
                // Salida de datos de cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["email_docente"]). "</td>  
                             <td>" . htmlspecialchars($row["nombre_grupo"]). "</td>                 
                             <td>" . htmlspecialchars($row["fecha_reserva"]). "</td>
                            <td>" . htmlspecialchars($row["hora_inicio"]). "</td>
                            <td>" . htmlspecialchars($row["hora_fin"]). "</td>    
                            <td>" . htmlspecialchars($row["Espacio"]). "</td> 
                            <td>" . htmlspecialchars($row["Recurso"]). "</td> 
                          
                           
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