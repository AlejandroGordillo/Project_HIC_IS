<?php
require_once 'news.php';

// Permitir CORS para desarrollo
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Si es una petición OPTIONS, terminar aquí
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Crear instancia del manejador de noticias
$newsHandler = new NewsHandler($db);

// Manejar las peticiones
try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'getNews':
                        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
                        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
                        $news = $newsHandler->getNews($limit, $offset);
                        jsonResponse($news);
                        break;
                        
                    case 'getRecommended':
                        $recommended = $newsHandler->getRecommended();
                        jsonResponse($recommended);
                        break;
                        
                    default:
                        throw new Exception('Acción no válida');
                }
            }
            break;
            
        case 'POST':
            if (!isset($_POST['action'])) {
                throw new Exception('Acción requerida');
            }
            
            switch ($_POST['action']) {
                case 'createNews':
                    if (!isset($_POST['titulo']) || !isset($_POST['contenido'])) {
                        throw new Exception('Datos incompletos');
                    }
                    
                    $file = isset($_FILES['imagen']) ? $_FILES['imagen'] : null;
                    $result = $newsHandler->createNews($_POST, $file);
                    jsonResponse($result);
                    break;
                    
                default:
                    throw new Exception('Acción no válida');
            }
            break;
            
        default:
            throw new Exception('Método no permitido');
    }
    
} catch (Exception $e) {
    jsonResponse(['error' => $e->getMessage()], 400);
}
