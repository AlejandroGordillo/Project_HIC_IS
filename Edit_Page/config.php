<?php
session_start();

// Configuración de la base de datos
$db_config = [
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'hospital_website',
    'charset' => 'utf8mb4'
];

try {
    $db = new PDO(
        "mysql:host={$db_config['host']};dbname={$db_config['name']};charset={$db_config['charset']}",
        $db_config['user'],
        $db_config['pass'],
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

// Directorio para subir archivos
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
