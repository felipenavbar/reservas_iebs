#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <ArduinoJson.h>

// Configuración de la red WiFi
const char* ssid = "tu_ssid";
const char* password = "tu_password";

// Crear una instancia del servidor web
ESP8266WebServer server(80);

bool alarmas[100] = {false};do de hasta 100 alarmas
bool alarmas[100000] = {false};

// Manejar la solicitud raíz
    String html = R"rawliteral(
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Alarmas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .alarm { margin: 10px 0; }
        .alarm span { margin-right: 10px; }
    </style>
</head>
<body>
    <h1>Configuración de Alarmas</h1>
    <div id="alarms"></div>
    <script>
        async function fetchAlarms() {
// Manejar la solicitud para obtener el estado de las alarmas
void handleAlarms() {
    StaticJsonDocument<2000> doc;
    for (int i = 0; i < 100; i++) {
        doc.add(alarmas[i]);
    }
    String json;
    serializeJson(doc, json);
    server.send(200, "application/json", json);
}

void setup() {nst response = await fetch('/alarms');
    // Configurar las rutas del servidor web
    server.on("/alarms", handleAlarms);on();
            const alarmsDiv = document.getElementById('alarms');
            alarmsDiv.innerHTML = '';
            alarms.forEach((alarm, index) => {
                const alarmDiv = document.createElement('div');
                alarmDiv.className = 'alarm';
                alarmDiv.innerHTML = `
                    <span>Alarma ${index + 1}: ${alarm ? 'Activada' : 'Desactivada'}</span>
                    <button onclick="toggleAlarm(${index})">${alarm ? 'Desactivar' : 'Activar'}</button>
                `;
                alarmsDiv.appendChild(alarmDiv);
            });
        }

        async function toggleAlarm(index) {
            await fetch(`/toggle?id=${index}`);
            fetchAlarms();
        }

        fetchAlarms();
    </script>
</body>
</html>
    )rawliteral";
    server.send(200, "text/html", html);
}   server.send(200, "text/plain", "Servidor de Alarmas");
}

// Manejar la solicitud para alternar el estado de una alarma
void handleToggle() {
    if (server.hasArg("id")) {
        int id = server.arg("id").toInt();
        if (id >= 0 && id < 100) {
            alarmas[id] = !alarmas[id];
            server.send(200, "text/plain", "OK");
        } else {
            server.send(400, "text/plain", "ID de alarma inválido");
        }
    } else {
        server.send(400, "text/plain", "Falta el parámetro 'id'");
    }
}

void setup() {
    // Inicializar la comunicación serie
    Serial.begin(115200);

    // Conectar a la red WiFi
    WiFi.begin(ssid, password);
    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.println("Conectando a WiFi...");
    }
    Serial.println("Conectado a WiFi");

    // Configurar las rutas del servidor web
    server.on("/", handleRoot);
    server.on("/toggle", handleToggle);

    // Iniciar el servidor web
    server.begin();
    Serial.println("Servidor web iniciado");
}

void loop() {
    // Manejar las solicitudes del servidor web
    server.handleClient();
}