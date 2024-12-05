<?php
require_once '../coneccion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['username'];
    $email = $_POST['email'];
    $contrasena = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validar los datos recibidos
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
        echo json_encode(['success' => false, 'message' => 'El nombre de usuario o correo electrónico ya existe']);
        exit();
    }

    // Insertar el nuevo usuario en la base de datos
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
    $insertUserQuery = "INSERT INTO usuarios (usuario, email, contrasena) VALUES (?, ?, ?)";
    $stmt = $conexionace->prepare($insertUserQuery);
    $stmt->bind_param("sss", $usuario, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Registro exitoso']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario']);
    }
}
?>