<?php
require_once '../coneccion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM categorias ORDER BY nombre";
    $result = $conexionace->query($query);
    
    $categorias = [];
    while ($categoria = $result->fetch_assoc()) {
        $categorias[] = $categoria;
    }
    
    echo json_encode([
        'success' => true,
        'categorias' => $categorias
    ]);
    exit();
}
?>
