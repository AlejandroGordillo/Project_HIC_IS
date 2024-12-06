<?php
require_once 'auth.php';

// Permitir CORS para desarrollo
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Crear instancia de Auth
$auth = new Auth($conn);

try {
    // Obtener el cuerpo de la petición
    $requestData = json_decode(file_get_contents('php://input'), true);
    
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            if (!isset($_POST['action']) && !isset($requestData['action'])) {
                throw new Exception('Acción requerida');
            }
            
            $action = $_POST['action'] ?? $requestData['action'];
            
            switch ($action) {
                case 'register':
                    $result = $auth->register([
                        'username' => $_POST['username'] ?? $requestData['username'],
                        'email' => $_POST['email'] ?? $requestData['email'],
                        'password' => $_POST['password'] ?? $requestData['password']
                    ]);
                    break;
                    
                case 'login':
                    $result = $auth->login(
                        $_POST['email'] ?? $requestData['email'],
                        $_POST['password'] ?? $requestData['password']
                    );
                    break;
                    
                case 'logout':
                    $result = $auth->logout();
                    break;
                    
                case 'reset-password':
                    $result = $auth->resetPassword(
                        $_POST['email'] ?? $requestData['email']
                    );
                    break;
                    
                default:
                    throw new Exception('Acción no válida');
            }
            
            jsonResponse($result);
            break;
            
        default:
            throw new Exception('Método no permitido');
    }
    
} catch (Exception $e) {
    jsonResponse([
        'success' => false,
        'message' => $e->getMessage()
    ], 400);
}
