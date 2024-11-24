CREATE DATABASE IF NOT EXISTS hospital_web;
USE hospital_web;

-- Tabla de categorías
CREATE TABLE categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    descripcion TEXT,
    icono VARCHAR(50),
    color VARCHAR(20),
    orden INT DEFAULT 0,
    activo BOOLEAN DEFAULT TRUE
);

-- Tabla de noticias
CREATE TABLE noticias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    contenido TEXT NOT NULL,
    extracto TEXT,
    imagen_destacada VARCHAR(255),
    categoria_id INT,
    autor VARCHAR(100),
    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    vistas INT DEFAULT 0,
    destacada BOOLEAN DEFAULT FALSE,
    estado ENUM('borrador', 'publicado', 'archivado') DEFAULT 'borrador',
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabla de enlaces de navegación
CREATE TABLE menu_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    url VARCHAR(255),
    padre_id INT NULL,
    orden INT DEFAULT 0,
    tipo ENUM('principal', 'superior', 'footer') DEFAULT 'principal',
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (padre_id) REFERENCES menu_items(id)
);

-- Tabla de configuración del sitio
CREATE TABLE configuracion (
    clave VARCHAR(50) PRIMARY KEY,
    valor TEXT NOT NULL,
    tipo ENUM('texto', 'numero', 'booleano', 'json') DEFAULT 'texto'
);

-- Datos iniciales
INSERT INTO categorias (nombre, slug) VALUES 
('Oficial', 'oficial'),
('Pediatría', 'pediatria'),
('Nutrición', 'nutricion'),
('Terapia Física', 'terapia-fisica'),
('Psicología', 'psicologia'),
('Cardiología', 'cardiologia'),
('Odontopediatría', 'odontopediatria'),
('Urología', 'urologia');

-- Configuración inicial
INSERT INTO configuracion (clave, valor, tipo) VALUES
('sitio_nombre', 'Hospital Infantil de las Californias', 'texto'),
('telefono', '973 7756 y 973 7757', 'texto'),
('direccion', 'Avenida Alejandro von Humboldt 11431, Garita de Otay, 22430 Tijuana, Baja California', 'texto'),
('redes_sociales', '{"facebook":"https://www.facebook.com/hicoficial/","instagram":"https://www.instagram.com/hicoficial/","youtube":"https://www.youtube.com/user/HICoficial","twitter":"https://x.com/hicoficial"}', 'json');
