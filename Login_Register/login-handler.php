<?php
require_once '../coneccion.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['username']);
    $contrasena = trim($_POST['password']);

    error_log("=== INICIO DE SESIÓN ===");
    error_log("Usuario: " . $usuario);
    error_log("Contraseña ingresada (longitud): " . strlen($contrasena));

    $loginQuery = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conexionace->prepare($loginQuery);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['contrasena'];

        error_log("Hash en DB: " . $hashedPassword);
        
        // Intentar la verificación y mostrar resultado
        $isValid = password_verify($contrasena, $hashedPassword);
        error_log("Resultado de verificación: " . ($isValid ? "exitoso" : "fallido"));
        error_log("INFO password_verify - Contraseña: " . $contrasena . " | Hash: " . $hashedPassword);

        if ($isValid) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            echo json_encode([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'user' => ['username' => $usuario]
            ]);
        } else {
            echo json_encode([
                'success' => false, 
                'message' => 'Contraseña incorrecta',
                'debug_info' => [
                    'hash_length' => strlen($hashedPassword),
                    'password_length' => strlen($contrasena)
                ]
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }
    error_log("=== FIN DE SESIÓN ===");
    exit();
}
?>