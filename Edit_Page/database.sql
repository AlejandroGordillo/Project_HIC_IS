CREATE DATABASE IF NOT EXISTS hospital_website;
USE hospital_website;

CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'editor', 'usuario') DEFAULT 'usuario',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE noticias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    contenido TEXT NOT NULL,
    imagen_destacada VARCHAR(255),
    extracto TEXT,
    autor_id INT,
    estado ENUM('borrador', 'publicado', 'archivado') DEFAULT 'borrador',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_publicacion TIMESTAMP NULL,
    vistas INT DEFAULT 0,
    FOREIGN KEY (autor_id) REFERENCES usuarios(id)
);

-- Insertar usuario admin por defecto
INSERT INTO usuarios (nombre, email, password, rol) VALUES 
('Admin', 'admin@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
