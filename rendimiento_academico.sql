CREATE DATABASE IF NOT EXISTS rendimiento_usfx;
USE rendimiento_usfx;

-- -----------------------------------------------------
-- Tabla: usuarios
-- -----------------------------------------------------
CREATE TABLE usuarios(
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  correo VARCHAR(100) UNIQUE,
  password VARCHAR(100)
);

INSERT INTO usuarios(nombre, correo, password)
VALUES ('Administrador', 'admin@usfx.edu.bo', '123456');

-- -----------------------------------------------------
-- Tabla: carreras
-- -----------------------------------------------------
CREATE TABLE carreras(
  id_carrera INT AUTO_INCREMENT PRIMARY KEY,
  nombre_carrera VARCHAR(100) NOT NULL
);

INSERT INTO carreras(nombre_carrera)
VALUES 
('Ingeniería de Sistemas'),
('Ingeniería Civil'),
('Ingeniería Industrial');

-- -----------------------------------------------------
-- Tabla: materias
-- -----------------------------------------------------
CREATE TABLE materias(
  id_materia INT AUTO_INCREMENT PRIMARY KEY,
  nombre_materia VARCHAR(100),
  id_carrera INT,
  FOREIGN KEY(id_carrera) REFERENCES carreras(id_carrera)
);

INSERT INTO materias(nombre_materia, id_carrera)
VALUES
('Calculo I', 1),
('Fisica I', 1),
('Programacion I', 1),
('Base de Datos', 1);

-- -----------------------------------------------------
-- Tabla: rendimiento_academico
-- -----------------------------------------------------
CREATE TABLE `rendimiento_academico` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_materia` int(11) DEFAULT NULL,
  `periodo` varchar(10) NOT NULL,
  `estudiantes_inscritos` int(11) NOT NULL,
  `estudiantes_aprobados` int(11) NOT NULL,
  `estudiantes_reprobados` int(11) NOT NULL,
  PRIMARY KEY (`id_registro`),
  KEY `id_materia` (`id_materia`),
  CONSTRAINT `rendimiento_academico_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rendimiento_academico` (`id_registro`, `id_materia`, `periodo`, `estudiantes_inscritos`, `estudiantes_aprobados`, `estudiantes_reprobados`) 
VALUES
(1, 1, '01/2026', 100, 78, 22),
(2, 2, '01/2026', 80, 62, 18),
(3, 3, '01/2026', 120, 75, 45),
(4, 1, '02/2026', 95, 85, 10);

COMMIT;