CREATE DATABASE IF NOT EXISTS rendimiento_usfx;
USE rendimiento_usfx;

CREATE TABLE IF NOT EXISTS carreras(
  id_carrera INT AUTO_INCREMENT PRIMARY KEY,
  nombre_carrera VARCHAR(100) NOT NULL
);

INSERT IGNORE INTO carreras(nombre_carrera) VALUES
('Ingenieria de Sistemas'),
('Ingenieria Civil'),
('Ingenieria Industrial');

CREATE TABLE IF NOT EXISTS materias(
  id_materia INT AUTO_INCREMENT PRIMARY KEY,
  nombre_materia VARCHAR(100),
  id_carrera INT,
  FOREIGN KEY(id_carrera) REFERENCES carreras(id_carrera)
);

INSERT IGNORE INTO materias(nombre_materia, id_carrera) VALUES
('Calculo I', 1),
('Fisica I', 1),
('Programacion I', 1),
('Base de Datos', 1);

CREATE TABLE IF NOT EXISTS rendimiento_academico (
  id_registro INT AUTO_INCREMENT PRIMARY KEY,
  id_materia INT DEFAULT NULL,
  periodo VARCHAR(10) NOT NULL,
  estudiantes_inscritos INT NOT NULL,
  estudiantes_aprobados INT NOT NULL,
  estudiantes_reprobados INT NOT NULL,
  KEY id_materia (id_materia),
  CONSTRAINT rendimiento_academico_ibfk_1 FOREIGN KEY (id_materia) REFERENCES materias (id_materia)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO rendimiento_academico (id_registro, id_materia, periodo, estudiantes_inscritos, estudiantes_aprobados, estudiantes_reprobados) VALUES
(1, 1, '01/2026', 100, 78, 22),
(2, 2, '01/2026', 80, 62, 18),
(3, 3, '01/2026', 120, 75, 45),
(4, 1, '02/2026', 95, 85, 10);

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    carrera VARCHAR(100),
    semestre INT,
    descripcion TEXT,
    foto VARCHAR(255) DEFAULT 'img/default.png',
    rol VARCHAR(50) DEFAULT 'Usuario',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO usuarios (id_usuario, nombre, correo, password, carrera, semestre, descripcion, rol) VALUES
(1, 'Administrador del Sistema', 'admin@demo.com', MD5('123456'), 'Ingenieria de Sistemas', 5, 'Usuario encargado de administrar el Dashboard Academico Universitario.', 'Administrador'),
(2, 'Juan Perez', 'juan@usfx.edu.bo', MD5('123456'), 'Ingenieria de Sistemas', 5, 'Ayudante dedicado en Fisica I', 'Ayudante'),
(3, 'Maria Lopez', 'maria@usfx.edu.bo', MD5('123456'), 'Ingenieria de Sistemas', 6, 'Especialista en Programacion Web', 'Ayudante'),
(4, 'Carlos Rojas', 'carlos@usfx.edu.bo', MD5('123456'), 'Ingenieria de Sistemas', 4, 'Experto en Calculo y Analisis', 'Ayudante'),
(5, 'Ana Flores', 'ana@usfx.edu.bo', MD5('123456'), 'Ingenieria de Sistemas', 3, 'Profesional en Algebra Lineal', 'Ayudante'),
(6, 'Estudiante Prueba', 'estudiante@usfx.edu.bo', MD5('123456'), 'Ingenieria de Sistemas', 3, 'Estudiante de prueba', 'Usuario');

CREATE TABLE IF NOT EXISTS ayudantes(
    id_ayudante INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    carrera VARCHAR(100) NOT NULL,
    semestre INT NOT NULL,
    materia VARCHAR(100) NOT NULL,
    correo VARCHAR(100),
    telefono VARCHAR(20),
    descripcion TEXT,
    horario VARCHAR(200)
);

INSERT IGNORE INTO ayudantes(id_ayudante, nombre, carrera, semestre, materia, correo, telefono, descripcion, horario) VALUES
(1, 'Juan Perez',   'Sistemas',     5, 'Fisica I',          'juan@usfx.edu.bo',    '71234567', 'Ayudante dedicado en Fisica',                    'Lunes y Miercoles 14:00-16:00'),
(2, 'Maria Lopez',  'Sistemas',     6, 'Programacion Web',  'maria@usfx.edu.bo',   '72345678', 'Especialista en Programacion Web',               'Martes y Jueves 15:00-17:00'),
(3, 'Carlos Rojas', 'Computacion',  4, 'Calculo II',        'carlos@usfx.edu.bo',  '73456789', 'Experto en Calculo y Analisis',                  'Miercoles y Viernes 16:00-18:00'),
(4, 'Ana Flores',   'Sistemas',     3, 'Algebra I',         'ana@usfx.edu.bo',     '74567890', 'Profesional en Algebra Lineal',                  'Lunes y Viernes 14:00-16:00');

CREATE TABLE IF NOT EXISTS comentarios_ayudantes(
    id_comentario INT AUTO_INCREMENT PRIMARY KEY,
    id_ayudante INT NOT NULL,
    nombre_estudiante VARCHAR(100) NOT NULL,
    email_estudiante VARCHAR(100),
    comentario TEXT NOT NULL,
    calificacion INT,
    fecha_comentario DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_ayudante) REFERENCES ayudantes(id_ayudante)
);

INSERT IGNORE INTO comentarios_ayudantes(id_comentario, id_ayudante, nombre_estudiante, email_estudiante, comentario, calificacion) VALUES
(1, 1, 'Pedro Martinez',  'pedro@usfx.edu.bo',  'Excelente explicacion de los temas. Muy dedicado.', 5),
(2, 1, 'Sofia Garcia',    'sofia@usfx.edu.bo',  'Muy buena disposicion para ayudar. Recomendado.',  5),
(3, 1, 'Roberto Sanchez', 'roberto@usfx.edu.bo','Buen ayudante, explica bien los conceptos.',        4),
(4, 2, 'Laura Jimenez',   'laura@usfx.edu.bo',  'Muy amable y paciente. Me ayudo mucho.',            5),
(5, 2, 'Diego Ramos',     'diego@usfx.edu.bo',  'Conoce bien del tema de web.',                      4);
