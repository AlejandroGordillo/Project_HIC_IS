<?php
class NewsHandler {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getDestacadas() {
        $stmt = $this->db->prepare("
            SELECT n.*, c.nombre as categoria_nombre 
            FROM noticias n
            LEFT JOIN categorias c ON n.categoria_id = c.id
            WHERE n.destacada = 1 AND n.estado = 'publicado'
            ORDER BY n.fecha_publicacion DESC
            LIMIT 4
        ");
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getNoticiasPorCategoria($categoria_slug, $limit = 6) {
        $stmt = $this->db->prepare("
            SELECT n.*, c.nombre as categoria_nombre
            FROM noticias n
            LEFT JOIN categorias c ON n.categoria_id = c.id
            WHERE c.slug = ? AND n.estado = 'publicado'
            ORDER BY n.fecha_publicacion DESC
            LIMIT ?
        ");
        
        $stmt->execute([$categoria_slug, $limit]);
        return $stmt->fetchAll();
    }
    
    public function getNoticiasRecientes($limit = 6, $offset = 0) {
        $stmt = $this->db->prepare("
            SELECT n.*, c.nombre as categoria_nombre
            FROM noticias n
            LEFT JOIN categorias c ON n.categoria_id = c.id
            WHERE n.estado = 'publicado'
            ORDER BY n.fecha_publicacion DESC
            LIMIT ? OFFSET ?
        ");
        
        $stmt->execute([$limit, $offset]);
        return $stmt->fetchAll();
    }
    
    public function contarNoticiasPorCategoria() {
        $stmt = $this->db->query("
            SELECT c.nombre, c.slug, COUNT(n.id) as total
            FROM categorias c
            LEFT JOIN noticias n ON c.id = n.categoria_id
            WHERE n.estado = 'publicado'
            GROUP BY c.id
            ORDER BY total DESC
        ");
        
        return $stmt->fetchAll();
    }
    
    public function buscarNoticias($query) {
        $query = "%$query%";
        $stmt = $this->db->prepare("
            SELECT n.*, c.nombre as categoria_nombre
            FROM noticias n
            LEFT JOIN categorias c ON n.categoria_id = c.id
            WHERE (n.titulo LIKE ? OR n.contenido LIKE ?)
            AND n.estado = 'publicado'
            ORDER BY n.fecha_publicacion DESC
        ");
        
        $stmt->execute([$query, $query]);
        return $stmt->fetchAll();
    }
}
