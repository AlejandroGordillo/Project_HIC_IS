<?php
require_once '../coneccion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    if (!isset($_SESSION['usuario'])) {
        echo json_encode(['success' => false, 'message' => 'No autorizado']);
        exit();
    }

    $articulo_id = $_POST['id'];
    $titulo = trim($_POST['titulo']);
    $contenido = $_POST['contenido'];
    $categoria = $_POST['categoria'];
    $estado = isset($_POST['publicar']) ? 'publicado' : 'borrador';

    // Verificar propiedad del artículo
    $query = "SELECT autor_id FROM articulos WHERE id = ?";
    $stmt = $conexionace->prepare($query);
    $stmt->bind_param("i", $articulo_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $articulo = $result->fetch_assoc();

    if (!$articulo) {
        echo json_encode(['success' => false, 'message' => 'Artículo no encontrado']);
        exit();
    }

    // Actualizar imagen si se proporciona una nueva
    $imagen_sql = "";
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['imagen']['tmp_name'];
        $file_name = time() . '_' . $_FILES['imagen']['name'];
        $upload_path = '../uploads/' . $file_name;
        
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $imagen_url = 'uploads/' . $file_name;
            $imagen_sql = ", imagen = ?";
        }
    }

    // Actualizar artículo
    $query = "UPDATE articulos 
              SET titulo = ?, contenido = ?, categoria = ?, estado = ?" . $imagen_sql . "
              WHERE id = ?";

    $stmt = $conexionace->prepare($query);
    if ($imagen_sql) {
        $stmt->bind_param("ssssi", $titulo, $contenido, $categoria, $estado, $imagen_url, $articulo_id);
    } else {
        $stmt->bind_param("ssssi", $titulo, $contenido, $categoria, $estado, $articulo_id);
    }

    if ($stmt->execute()) {
        // Actualizar tags
        if (isset($_POST['tags'])) {
            // Eliminar tags antiguos
            $query = "DELETE FROM articulo_tags WHERE articulo_id = ?";
            $stmt = $conexionace->prepare($query);
            $stmt->bind_param("i", $articulo_id);
            $stmt->execute();

            // Insertar nuevos tags
            $tags = explode(',', $_POST['tags']);
            foreach ($tags as $tag) {
                $tag = trim($tag);
                if (empty($tag)) continue;

                // Insertar o obtener tag
                $query = "INSERT IGNORE INTO tags (nombre) VALUES (?)";
                $stmt = $conexionace->prepare($query);
                $stmt->bind_param("s", $tag);
                $stmt->execute();

                $tag_id = $stmt->insert_id;
                if (!$tag_id) {
                    $query = "SELECT id FROM tags WHERE nombre = ?";
                    $stmt = $conexionace->prepare($query);
                    $stmt->bind_param("s", $tag);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $tag_row = $result->fetch_assoc();
                    $tag_id = $tag_row['id'];
                }

                // Relacionar artículo con tag
                $query = "INSERT INTO articulo_tags (articulo_id, tag_id) VALUES (?, ?)";
                $stmt = $conexionace->prepare($query);
                $stmt->bind_param("ii", $articulo_id, $tag_id);
                $stmt->execute();
            }
        }

        echo json_encode([
            'success' => true,
            'message' => 'Artículo actualizado exitosamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al actualizar el artículo'
        ]);
    }
    exit();
}
?>
