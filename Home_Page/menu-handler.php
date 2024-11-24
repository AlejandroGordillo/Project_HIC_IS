<?php
class MenuHandler {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getMenuPrincipal() {
        return $this->getMenuPorTipo('principal');
    }
    
    public function getMenuSuperior() {
        return $this->getMenuPorTipo('superior');
    }
    
    public function getMenuFooter() {
        return $this->getMenuPorTipo('footer');
    }
    
    private function getMenuPorTipo($tipo) {
        $stmt = $this->db->prepare("
            SELECT id, titulo, url, padre_id
            FROM menu_items
            WHERE tipo = ? AND activo = 1
            ORDER BY orden ASC
        ");
        
        $stmt->execute([$tipo]);
        $items = $stmt->fetchAll();
        
        return $this->construirArbolMenu($items);
    }
    
    private function construirArbolMenu($items, $padre_id = null) {
        $rama = [];
        
        foreach ($items as $item) {
            if ($item['padre_id'] === $padre_id) {
                $hijos = $this->construirArbolMenu($items, $item['id']);
                if ($hijos) {
                    $item['hijos'] = $hijos;
                }
                $rama[] = $item;
            }
        }
        
        return $rama;
    }
}
