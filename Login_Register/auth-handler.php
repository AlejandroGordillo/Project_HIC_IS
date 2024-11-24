<?php
require_once 'config.php';

class Auth {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function register($data) {
        try {
            // Validar datos
            if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
                throw new Exception('Todos los campos son requeridos');
            }
            
            // Validar email
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Email inválido');
            }
            
            // Verificar si el email ya existe
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$data['email']]);
            if ($stmt->rowCount() > 0) {
                throw new Exception('El email ya está registrado');
            }
            
            // Hash de la contraseña
            $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
            
            // Insertar usuario
            $stmt = $this->conn->prepare("
                INSERT INTO users (username, email, password, created_at) 
                VALUES (?, ?, ?, NOW())
            ");
            
            $stmt->execute([
                $data['username'],
                $data['email'],
                $passwordHash
            ]);
            
            return [
                'success' => true,
                'message' => 'Usuario registrado exitosamente'
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    public function login($email, $password) {
        try {
            // Validar datos
            if (empty($email) || empty($password)) {
                throw new Exception('Email y contraseña son requeridos');
            }
            
            // Buscar usuario
            $stmt = $this->conn->prepare("
                SELECT id, username, email, password 
                FROM users 
                WHERE email = ?
            ");
            
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user || !password_verify($password, $user['password'])) {
                throw new Exception('Credenciales inválidas');
            }
            
            // Crear sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Actualizar último acceso
            $stmt = $this->conn->prepare("
                UPDATE users 
                SET last_login = NOW() 
                WHERE id = ?
            ");
            $stmt->execute([$user['id']]);
            
            return [
                'success' => true,
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email']
                ]
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    public function logout() {
        session_destroy();
        return [
            'success' => true,
            'message' => 'Sesión cerrada exitosamente'
        ];
    }
    
    public function resetPassword($email) {
        try {
            // Validar email
            if (empty($email)) {
                throw new Exception('Email es requerido');
            }
            
            // Verificar si el usuario existe
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() === 0) {
                throw new Exception('Email no encontrado');
            }
            
            // Generar token
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            // Guardar token
            $stmt = $this->conn->prepare("
                INSERT INTO password_resets (email, token, expires_at)
                VALUES (?, ?, ?)
            ");
            
            $stmt->execute([$email, $token, $expires]);
            
            // Aquí deberías enviar el email con el link de reset
            // Por ahora solo retornamos éxito
            return [
                'success' => true,
                'message' => 'Instrucciones enviadas al email'
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
