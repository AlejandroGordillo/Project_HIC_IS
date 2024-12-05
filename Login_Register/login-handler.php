<?php
require_once '../coneccion.php';
header('Content-Type: application/json');
session_start(); // Iniciar sesión al principio

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['username']);
    $contrasena = trim($_POST['password']);

    error_log("=== INICIO DE SESIÓN ===");
    error_log("Usuario: " . $usuario);
    
    $loginQuery = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conexionace->prepare($loginQuery);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['contrasena'];
        
        $isValid = password_verify($contrasena, $hashedPassword);
        
        if ($isValid) {
            // Guardar datos importantes en la sesión
            $_SESSION['usuario'] = $usuario;
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['logged_in'] = true;
            
            $redirect = $_GET['redirect'] ?? 'home';
            if ($redirect === 'edit') {
                echo json_encode([
                    'success' => true,
                    'message' => 'Inicio de sesión exitoso',
                    'redirect' => '../Edit_Page/index.html'
                ]);
            } else {
                echo json_encode([
                    'success' => true, 
                    'message' => 'Inicio de sesión exitoso',
                    'redirect' => '../Home_Page/index.html'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false, 
                'message' => 'Contraseña incorrecta'
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }
    exit();
}
?>