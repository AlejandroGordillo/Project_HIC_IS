<?php
require_once 'utils.php';

class NewsHandler {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getNews($limit = 10, $offset = 0) {
        $stmt = $this->db->prepare("
            SELECT n.*, u.nombre as autor
            FROM noticias n
            LEFT JOIN usuarios u ON n.autor_id = u.id
            WHERE n.estado = 'publicado'
            ORDER BY n.fecha_publicacion DESC
            LIMIT :limit OFFSET :offset
        ");
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getRecommended($limit = 2) {
        $stmt = $this->db->prepare("
            SELECT id, titulo, imagen_destacada, extracto
            FROM noticias
            WHERE estado = 'publicado'
            ORDER BY vistas DESC
            LIMIT :limit
        ");
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function createNews($data, $file = null) {
        try {
            $this->db->beginTransaction();
            
            $imagen = null;
            if ($file) {
                $imagen = uploadImage($file);
            }
            
            $stmt = $this->db->prepare("
                INSERT INTO noticias (
                    titulo, slug, contenido, imagen_destacada,
                    extracto, autor_id, estado, fecha_publicacion
                ) VALUES (
                    :titulo, :slug, :contenido, :imagen,
                    :extracto, :autor_id, 'publicado', NOW()
                )
            ");
            
            $slug = generateSlug($data['titulo']);
            $extracto = substr(strip_tags($data['contenido']), 0, 200) . '...';
            $autor_id = $_SESSION['user_id'] ?? 1;
            
            $stmt->execute([
                ':titulo' => sanitizeInput($data['titulo']),
                ':slug' => $slug,
                ':contenido' => $data['contenido'],
                ':imagen' => $imagen,
                ':extracto' => $extracto,
                ':autor_id' => $autor_id
            ]);
            
            $this->db->commit();
            return ['success' => true, 'id' => $this->db->lastInsertId()];
            
        } catch (Exception $e) {
            $this->db->rollBack();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
