<?php
// Habilitar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir archivo de conexión
include 'conexion.php';

// Verificar si se ha enviado el formulario para agregar una nueva reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario y escapar entradas para evitar inyección SQL
    $usuarioID = mysqli_real_escape_string($conn, $_POST['email_docente']);
    $nombre_grupo = mysqli_real_escape_string($conn, $_POST['nombre_grupo']);
    $jornada = mysqli_real_escape_string($conn, $_POST['Jornada']);
    $dia_semana = mysqli_real_escape_string($conn, $_POST['dia_semana']);
    $hora = mysqli_real_escape_string($conn, $_POST['hora']);
    //aqui falta codigo ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $periodo = mysqli_real_escape_string($conn, $_POST['periodo']); // nuevo campo

    // Insertar los datos en la tabla Reservas
    $sql_insert = "INSERT INTO Reservas (UsuarioID, nombre_grupo, dia_semana, HorarioID, periodo) 
                   VALUES ('$usuarioID', '$nombre_grupo', '$dia_semana', '$hora', '$periodo')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Nueva reserva agregada correctamente.";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Consulta SQL para obtener todos los registros de la tabla
$sql = "SELECT Reservas.HorarioID, Usuarios.Nombre, Reservas.dia_semana, Reservas.nombre_grupo, Reservas.periodo
        FROM Reservas 
        INNER JOIN Usuarios ON Reservas.UsuarioID = Usuarios.UsuarioID";

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados en una tabla HTML
    echo "<table border='1'>
            <tr>
                <th>Hora</th>
                <th>Docente</th>
                <th>Grupo</th>
                <th>Dia</th>
                <th>Periodo</th>
            </tr>";
    // Salida de datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["HorarioID"]. "</td>
                <td>" . $row["Nombre"]. "</td>
                <td>" . $row["nombre_grupo"]. "</td>               
                <td>" . $row["dia_semana"]. "</td>
                <td>" . $row["periodo"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}

// Cerrar conexión
$conn->close();
?>

<!-- Formulario para agregar una nueva reserva -->
<form method="POST" action="">
    <label for="usuarioID"> Email Docente:</label><br>
    <input type="text" id="usuarioID" name="usuarioID" required><br><br>

    <label for="nombre_grupo">Nombre del Grupo:</label><br>
    <input type="text" id="nombre_grupo" name="nombre_grupo" required><br><br>

    <label for="jornada">Jornada:</label><br>
    <select id="jornada" name="jornada" required>
        <option value="Mañana">Mañana</option>
        <option value="Tarde">Tarde</option>
        <option value="Noche">Noche</option>
    </select><br><br>


    <label for="dia_semana">Día de la Semana:</label><br>
    <select id="dia_semana" name="dia_semana" required>
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miércoles">Miércoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Viernes">Viernes</option>
    </select><br><br>


    <label for="horarioID">Hora:</label><br>
    <select id="horarioID" name="horarioID" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select><br><br>

    <label for=">espacio">Espacio</label><br>
    <select id="espacio" name="espacio" required>
        <option value="1">Ninguno</option>
        <option value="1">Sala de sistemas 01</option>
        <option value="2">Sala de sistemas 02</option>
        <option value="3">Aula Inglés </option>
        <option value="4">Aula Audiovisuales</option>
        <option value="5">Biblioteca</option>
        <option value="6">Auditorio</option>
    </select><br><br>

    <label for="recurso">Recurso</label><br>
    <select id="recurso" name="recurso" required>
        <option value="1">Ninguno</option>
        <option value="1">Video Beam 01</option>
        <option value="2">Video Beam 02</option>
        <option value="3">Video Beam 03 </option>
        <option value="4">Video Beam 04</option>
        <option value="5">Video Beam Biblioteca</option>
        <option value="6">TV</option>
    </select><br><br>



    <input type="submit" value="Agregar Reserva">
</form>