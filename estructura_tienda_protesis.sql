
-- Base de datos: tienda_protesis
CREATE DATABASE IF NOT EXISTS tienda_protesis;
USE tienda_protesis;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    contraseña VARCHAR(255),
    tipo ENUM('cliente', 'proveedor', 'veterinario', 'admin') DEFAULT 'cliente',
    estado ENUM('activo', 'bloqueado') DEFAULT 'activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de perros
CREATE TABLE perros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nombre VARCHAR(100),
    raza VARCHAR(100),
    edad INT,
    peso DECIMAL(5,2),
    tipo_amputacion VARCHAR(100),
    tiempo_desde_cirugia VARCHAR(100),
    movilidad_actual TEXT,
    es_candidato BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla de evaluaciones (para casos dudosos o revisión por veterinario)
CREATE TABLE evaluaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    perro_id INT,
    veterinario_id INT,
    resultado ENUM('apto', 'no_apto', 'dudoso'),
    observaciones TEXT,
    fecha_evaluacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (perro_id) REFERENCES perros(id),
    FOREIGN KEY (veterinario_id) REFERENCES usuarios(id)
);

-- Tabla de kits solicitados
CREATE TABLE kits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    perro_id INT,
    fecha_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente_pago', 'enviado', 'recibido'),
    precio_base DECIMAL(10,2),
    FOREIGN KEY (perro_id) REFERENCES perros(id)
);

-- Tabla de prótesis
CREATE TABLE protesis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    perro_id INT,
    estado ENUM('diseño', 'en_impresion', 'enviado', 'entregado', 'correccion'),
    fecha_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    precio_total DECIMAL(10,2),
    observaciones TEXT,
    FOREIGN KEY (perro_id) REFERENCES perros(id)
);

-- Tabla de mensajes
CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    remitente_id INT,
    destinatario_id INT,
    contenido TEXT,
    estado ENUM('leido', 'no_leido') DEFAULT 'no_leido',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (remitente_id) REFERENCES usuarios(id),
    FOREIGN KEY (destinatario_id) REFERENCES usuarios(id)
);

-- Tabla de notificaciones
CREATE TABLE notificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    tipo VARCHAR(100),
    mensaje TEXT,
    leida BOOLEAN DEFAULT FALSE,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla de seguimiento del pedido
CREATE TABLE seguimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    protesis_id INT,
    etapa VARCHAR(100),
    descripcion TEXT,
    fecha_estimada DATE,
    fecha_real TIMESTAMP NULL,
    FOREIGN KEY (protesis_id) REFERENCES protesis(id)
);
