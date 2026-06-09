CREATE DATABASE IF NOT EXISTS rendimiento_usfx;
USE rendimiento_usfx;

CREATE TABLE usuarios(
id_usuario INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
correo VARCHAR(100) UNIQUE,
password VARCHAR(100)
);

INSERT INTO usuarios(nombre,correo,password)
VALUES
('Administrador','[admin@usfx.edu.bo](mailto:admin@usfx.edu.bo)','123456');

CREATE TABLE carreras(
id_carrera INT AUTO_INCREMENT PRIMARY KEY,
nombre_carrera VARCHAR(100) NOT NULL
);

INSERT INTO carreras(nombre_carrera)
VALUES
('Ingeniería de Sistemas'),
('Ingeniería Civil'),
('Ingeniería Industrial');

CREATE TABLE materias(
id_materia INT AUTO_INCREMENT PRIMARY KEY,
nombre_materia VARCHAR(100),
id_carrera INT,
FOREIGN KEY(id_carrera)
REFERENCES carreras(id_carrera)
);

INSERT INTO materias(nombre_materia,id_carrera)
VALUES
('Calculo I',1),
('Fisica I',1),
('Programacion I',1),
('Base de Datos',1);

CREATE TABLE rendimiento_academico(
id_registro INT AUTO_INCREMENT PRIMARY KEY,
id_materia INT,
semestre INT,
gestion INT,
estudiantes_inscritos INT,
estudiantes_aprobados INT,
estudiantes_reprobados INT,
FOREIGN KEY(id_materia)
REFERENCES materias(id_materia)
);

INSERT INTO rendimiento_academico
(id_materia,semestre,gestion,estudiantes_inscritos,estudiantes_aprobados,estudiantes_reprobados)
VALUES
(1,1,2026,100,78,22),
(2,1,2026,90,70,20),
(3,1,2026,110,85,25),
(4,1,2026,120,95,25),
(1,2,2026,130,100,30),
(2,2,2026,95,75,20),
(3,2,2026,105,80,25),
(4,2,2026,115,90,25);
