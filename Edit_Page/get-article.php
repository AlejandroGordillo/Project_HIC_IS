<?php
require_once '../coneccion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $articulo_id = $_GET['id'];
    
    $query = "SELECT a.*, u.usuario as autor_nombre 
              FROM articulos a 
              JOIN usuarios u ON a.autor_id = u.id 
              WHERE a.id = ?";
              
    $stmt = $conexionace->prepare($query);
    $stmt->bind_param("i", $articulo_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($articulo = $result->fetch_assoc()) {
        // Obtener tags del artículo
        $query = "SELECT t.nombre 
                  FROM tags t 
                  JOIN articulo_tags at ON t.id = at.tag_id 
                  WHERE at.articulo_id = ?";
        $stmt = $conexionace->prepare($query);
        $stmt->bind_param("i", $articulo_id);
        $stmt->execute();
        $tags_result = $stmt->get_result();
        
        $tags = [];
        while ($tag = $tags_result->fetch_assoc()) {
            $tags[] = $tag['nombre'];
        }
        
        $articulo['tags'] = $tags;
        
        echo json_encode([
            'success' => true,
            'articulo' => $articulo
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Artículo no encontrado'
        ]);
    }
    exit();
}
?>
