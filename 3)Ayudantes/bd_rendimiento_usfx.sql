CREATE TABLE ayudantes(
    id_ayudante INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    carrera VARCHAR(100) NOT NULL,
    semestre INT NOT NULL,
    materia VARCHAR(100) NOT NULL,
    correo VARCHAR(100)
);

INSERT INTO ayudantes(nombre,carrera,semestre,materia,correo)
VALUES
('Juan Perez','Sistemas',5,'Fisica I','juan@usfx.edu.bo'),
('Maria Lopez','Sistemas',6,'Programacion Web','maria@usfx.edu.bo'),
('Carlos Rojas','Computacion',4,'Calculo II','carlos@usfx.edu.bo'),
('Ana Flores','Sistemas',3,'Algebra I','ana@usfx.edu.bo');