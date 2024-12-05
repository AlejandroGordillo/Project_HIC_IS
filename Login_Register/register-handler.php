<?php
require_once '../coneccion.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['username']);
    $email = trim($_POST['email']);
    $contrasena = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if (empty($usuario) || empty($email) || empty($contrasena) || empty($confirmPassword)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
        exit();
    }

    if ($contrasena !== $confirmPassword) {
        echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden']);
        exit();
    }

    // Verificar si el usuario ya existe
    $checkUserQuery = "SELECT * FROM usuarios WHERE usuario = ? OR email = ?";
    $stmt = $conexionace->prepare($checkUserQuery);
    $stmt->bind_param("ss", $usuario, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El usuario o email ya existe']);
        exit();
    }

    // Crear el hash y verificar inmediatamente
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
    $checkPassword = password_verify($contrasena, $hashedPassword);
    
    error_log("Contraseña original: " . $contrasena);
    error_log("Hash generado: " . $hashedPassword);
    error_log("Verificación inmediata: " . ($checkPassword ? "exitosa" : "fallida"));

    // Insertar usuario
    $insertUserQuery = "INSERT INTO usuarios (usuario, email, contrasena) VALUES (?, ?, ?)";
    $stmt = $conexionace->prepare($insertUserQuery);
    $stmt->bind_param("sss", $usuario, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Verificar que se puede recuperar y validar la contraseña
        $checkQuery = "SELECT contrasena FROM usuarios WHERE usuario = ?";
        $checkStmt = $conexionace->prepare($checkQuery);
        $checkStmt->bind_param("s", $usuario);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $row = $checkResult->fetch_assoc();
        
        $storedHash = $row['contrasena'];
        $finalCheck = password_verify($contrasena, $storedHash);
        
        error_log("Hash almacenado: " . $storedHash);
        error_log("Verificación final: " . ($finalCheck ? "exitosa" : "fallida"));
        
        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar usuario']);
    }
    exit();
}
?>