USE bd_rendimiento_usfx;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    carrera VARCHAR(100),
    semestre INT,
    descripcion TEXT,
    foto VARCHAR(255) DEFAULT 'img/default.png',
    rol VARCHAR(50) DEFAULT 'Administrador',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (
    nombre, 
    correo, 
    password, 
    carrera, 
    semestre, 
    descripcion, 
    foto, 
    rol
) VALUES (
    'Administrador del Sistema',
    'admin@demo.com',
    '$2y$10$wH8w5EapfHbYY7Q33DaOnOaWSQBDAW9a/YxSfIu2Yyk5evO1SlvP.',
    'Ingeniería de Sistemas',
    5,
    'Usuario encargado de administrar el Dashboard Académico Universitario.',
    'img/default.png',
    'Administrador'
);
