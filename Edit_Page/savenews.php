<?php
require_once 'db-conexion.php';

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? null;
    $contenido = $_POST['contenido'] ?? null;
    $intereses = $_POST['intereses'] ?? null;
    $main_image = $_FILES['main_image'] ?? null;

    // Validar campos requeridos
    if (!$titulo || !$contenido || !$intereses || !$main_image) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Leer el contenido de la imagen como binario
    $imageContent = file_get_contents($main_image['tmp_name']);
    if ($imageContent === false) {
        echo json_encode(['success' => false, 'message' => 'Error al leer la imagen.']);
        exit;
    }

    // Insertar los datos en la base de datos
    $stmt = $conn->prepare("INSERT INTO news (titulo, main_image, text_blog, Categoria) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("sbss", $titulo, $imageContent, $contenido, $intereses);

    // Bind de blob manual (necesario en algunos entornos)
    $stmt->send_long_data(1, $imageContent);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Noticia publicada exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar los datos: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido.']);
}

// Cerrar conexión
$conn->close();

?>