<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Semanal</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
</head>

<body>
    <center class="contenedor">
        <h1 id="fecha">Semana n</h1>
        <p>Hoy es <?php echo date('l, d F Y'); ?>.</p>
        <select id="opcion" name="opcion" required>
            <option value="">Selecciona una opción</option>
            <option value="opcion1">Jornada Mañana</option>
            <option value="opcion2">Jornada Tarde</option>
            <option value="opcion3">Jornada Nocturna</option>
          
        </select>
        <h2>Jornada Tarde</h2>

        <table>
            <tr>
                <th>Hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>

            </tr>
            <tr>
                <td>1</td>
                <td>Reservado</td>
                <td>Actividad 2</td>
                <td>Actividad 3</td>
                <td>Actividad 4</td>
                <td>Actividad 5</td>

            </tr>

            <tr>
                <td>2</td>  
                <td>Actividad 1</td>
                <td>Actividad 2</td>
                <td>Actividad 3</td>
                <td>Actividad 4</td>
                <td>Actividad 5</td>

            </tr>
            <tr>
                <td>3</td>
                <td>Actividad 1</td>
                <td>Actividad 2</td>
                <td>Actividad 3</td>
                <td>Actividad 4</td>
                <td>Actividad 5</td>

            </tr>

            <tr>
                <td>4</td>
                <td>Actividad 1</td>
                <td>Actividad 2</td>
                <td>Actividad 3</td>
                <td>Actividad 4</td>
                <td>Actividad 5</td>

            </tr>
            <tr>
                <td>5</td>
                <td>Actividad 1</td>
                <td>Actividad 2</td>
                <td>Actividad 3</td>
                <td>Actividad 4</td>
                <td>Actividad 5</td>

            </tr>
            <tr>
                <td>6</td>
                <td><button class="js-modal-trigger" data-target="modal-js-example">
                    Disponible
                  </button></td>
                <td>Actividad 2</td>
                <td>Actividad 3</td>
                <td>Actividad 4</td>
                <td>Actividad 5</td>

            </tr>

            <!-- Puedes agregar más filas según sea necesario -->
        </table>
        <div id="modal-js-example" class="modal">
            <div class="modal-background"></div>
          
            <div class="modal-content">
              <div class="box">
                <p>Modal JS example</p>
               
              </div>
            </div>
          
            <button class="modal-close is-large" aria-label="close"></button>
          </div>

          <!-- 
            <form method="post" action="procesar.php">

                    <label for="cedula">Cedula:</label>
                    <input type="text" id="cedula" name="cedula" required><br>
                    <label for="id">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br>
                    <label for="pass">Pass:</label>
                    <input type="text" id="pass" name="pass" required><br>
                    <input type="submit" value="Enviar">
                </form>
            -->
    </center>
    <script>
        // Función para manejar el clic en el botón de reserva
        function manejarReserva() {
            // Mostrar un cuadro de diálogo de confirmación
            var confirmacion = confirm("¿Desea reservar este espacio?");

            // Verificar si el usuario hizo clic en "Aceptar" o "Cancelar" en el cuadro de diálogo
            if (confirmacion) {
                alert("Espacio reservado."); // Mensaje de confirmación de la reserva
            } else {
                alert("Reserva cancelada."); // Mensaje si el usuario cancela la reserva
            }
        }

        // Obtener el botón de reserva
        var botonReserva = document.getElementById("botonReserva");

        // Agregar evento de clic al botón de reserva
        botonReserva.addEventListener("click", manejarReserva);
    </script>



    <script>
        // Obtener la fecha actual
        var fechaActual = new Date();

        // Obtener el día de la semana (0 para domingo, 1 para lunes, ..., 6 para sábado)
        var diaSemana = fechaActual.getDay();

        // Obtener el día del mes
        var diaMes = fechaActual.getDate();

        // Obtener el mes (0 para enero, 1 para febrero, ..., 11 para diciembre)
        var mes = fechaActual.getMonth();

        // Obtener el año
        var anio = fechaActual.getFullYear();

        // Array de los nombres de los meses
        var nombresMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        // Mostrar la fecha actual en el encabezado de la tabla
        document.getElementById("fecha").innerText = diaMes + ' de ' + nombresMeses[mes] + ' de ' + anio;    
   
        document.addEventListener('DOMContentLoaded', () => {
            // Functions to open and close a modal
            function openModal($el) {
                $el.classList.add('is-active');
            }

            function closeModal($el) {
                $el.classList.remove('is-active');
            }

            function closeAllModals() {
                (document.querySelectorAll('.modal') || []).forEach(($modal) => {
                    closeModal($modal);
                });
            }

            // Add a click event on buttons to open a specific modal
            (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
                const modal = $trigger.dataset.target;
                const $target = document.getElementById(modal);

                $trigger.addEventListener('click', () => {
                    openModal($target);
                });
            });

            // Add a click event on various child elements to close the parent modal
            (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
                const $target = $close.closest('.modal');

                $close.addEventListener('click', () => {
                    closeModal($target);
                });
            });

            // Add a keyboard event to close all modals
            document.addEventListener('keydown', (event) => {
                if (event.key === "Escape") {
                    closeAllModals();
                }
            });
        });
    </script>

</body>

</html>