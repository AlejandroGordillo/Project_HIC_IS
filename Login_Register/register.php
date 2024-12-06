<?php
// Incluir la conexión a la base de datos
require_once 'db-conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden.']);
        exit;
    }

    $sql = "INSERT INTO login (usuario,correo,pass) VALUES ('$nombre','$email','$password')";
    if( $conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . sql . "<br>" . $conn->error;
    }
    
} else { 
    http_response_code(405); 
    echo "Método no permitido"; 
}

$conn->close();

?>
