<?php
require_once 'config.php';
require_once 'NewsHandler.php';
require_once 'MenuHandler.php';

// Permitir CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Inicializar manejadores
$newsHandler = new NewsHandler($db);
$menuHandler = new MenuHandler($db);

try {
    $action = $_GET['action'] ?? '';
    
    switch ($action) {
        case 'getDestacadas':
            $noticias = $newsHandler->getDestacadas();
            jsonResponse($noticias);
            break;
            
        case 'getNoticiasPorCategoria':
            if (!isset($_GET['categoria'])) {
                throw new Exception('Categoría requerida');
            }
            $noticias = $newsHandler->getNoticiasPorCategoria(
                $_GET['categoria'],
                $_GET['limit'] ?? 6
            );
            jsonResponse($noticias);
            break;
            
        case 'getNoticiasRecientes':
            $noticias = $newsHandler->getNoticiasRecientes(
                $_GET['limit'] ?? 6,
                $_GET['offset'] ?? 0
            );
            jsonResponse($noticias);
            break;
            
        case 'getCategorias':
            $categorias = $newsHandler->contarNoticiasPorCategoria();
            jsonResponse($categorias);
            break;
            
        case 'getMenu':
            $tipo = $_GET['tipo'] ?? 'principal';
            switch ($tipo) {
                case 'principal':
                    $menu = $menuHandler->getMenuPrincipal();
                    break;
                case 'superior':
                    $menu = $menuHandler->getMenuSuperior();
                    break;
                case 'footer':
                    $menu = $menuHandler->getMenuFooter();
                    break;
                default:
                    throw new Exception('Tipo de menú no válido');
            }
            jsonResponse($menu);
            break;
            
        case 'buscar':
            if (!isset($_GET['q'])) {
                throw new Exception('Término de búsqueda requerido');
            }
            $resultados = $newsHandler->buscarNoticias($_GET['q']);
            jsonResponse($resultados);
            break;
            
        default:
            throw new Exception('Acción no válida');
    }
} catch (Exception $e) {
    jsonResponse([
        'error' => true,
        'mensaje' => $e->getMessage()
    ], 400);
}
