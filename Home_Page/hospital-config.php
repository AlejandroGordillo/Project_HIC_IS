<?php
session_start();

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hospital_web');

// Conexión PDO
try {
    $db = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Configuración de zona horaria
date_default_timezone_set('America/Tijuana');

// Constantes para rutas
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('SITE_URL', 'http://localhost/hospital/');

// Función para respuestas JSON
function jsonResponse($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Función para sanitizar entradas
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
