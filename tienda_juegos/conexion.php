<?php
// Cargar variables de entorno
$env = parse_ini_file(__DIR__.'/.env');

if ($env === false) {
    die("Error: No se pudo leer el archivo de configuración .env.");
}

$servername = $env["DB_HOST"];
$username = $env["DB_USER"];
$password = $env["DB_PASS"];
$dbname = $env["DB_NAME"];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
     die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Establecer el charset
$conn->set_charset("utf8mb4");

?>