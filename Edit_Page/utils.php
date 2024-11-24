<?php
require_once 'config.php';

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function generateSlug($text) {
    // Convertir texto a minúsculas y remover caracteres especiales
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    $text = trim($text, '-');
    
    return $text;
}

function uploadImage($file) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 5 * 1024 * 1024; // 5MB
    
    if (!isset($file['error']) || $file['error'] !== 0) {
        throw new Exception('Error en la subida del archivo');
    }
    
    if (!in_array($file['type'], $allowed_types)) {
        throw new Exception('Tipo de archivo no permitido');
    }
    
    if ($file['size'] > $max_size) {
        throw new Exception('El archivo es demasiado grande');
    }
    
    $filename = uniqid() . '_' . sanitizeInput($file['name']);
    $filepath = UPLOAD_DIR . $filename;
    
    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        throw new Exception('Error al guardar el archivo');
    }
    
    return $filename;
}

function jsonResponse($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
