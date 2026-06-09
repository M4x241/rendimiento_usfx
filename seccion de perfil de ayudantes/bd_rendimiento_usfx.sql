-- Agregar columnas adicionales a la tabla ayudantes
ALTER TABLE ayudantes ADD COLUMN telefono VARCHAR(20);
ALTER TABLE ayudantes ADD COLUMN descripcion TEXT;
ALTER TABLE ayudantes ADD COLUMN horario VARCHAR(200);

-- Crear tabla de comentarios
CREATE TABLE comentarios_ayudantes(
    id_comentario INT AUTO_INCREMENT PRIMARY KEY,
    id_ayudante INT NOT NULL,
    nombre_estudiante VARCHAR(100) NOT NULL,
    email_estudiante VARCHAR(100),
    comentario TEXT NOT NULL,
    calificacion INT,
    fecha_comentario DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_ayudante) REFERENCES ayudantes(id_ayudante)
);

-- Actualizar datos de ayudantes existentes
UPDATE ayudantes SET 
    telefono = '71234567',
    descripcion = 'Ayudante dedicado en Física',
    horario = 'Lunes y Miércoles 14:00-16:00'
WHERE nombre = 'Juan Perez';

UPDATE ayudantes SET 
    telefono = '72345678',
    descripcion = 'Especialista en Programación Web',
    horario = 'Martes y Jueves 15:00-17:00'
WHERE nombre = 'Maria Lopez';

UPDATE ayudantes SET 
    telefono = '73456789',
    descripcion = 'Experto en Cálculo y Análisis',
    horario = 'Miércoles y Viernes 16:00-18:00'
WHERE nombre = 'Carlos Rojas';

UPDATE ayudantes SET 
    telefono = '74567890',
    descripcion = 'Profesional en Álgebra Lineal',
    horario = 'Lunes y Viernes 14:00-16:00'
WHERE nombre = 'Ana Flores';

-- Insertar comentarios de ejemplo
INSERT INTO comentarios_ayudantes(id_ayudante, nombre_estudiante, email_estudiante, comentario, calificacion)
VALUES
(1, 'Pedro Martinez', 'pedro@usfx.edu.bo', 'Excelente explicación de los temas. Muy dedicado.', 5),
(1, 'Sofia Garcia', 'sofia@usfx.edu.bo', 'Muy buena disposición para ayudar. Recomendado.', 5),
(1, 'Roberto Sánchez', 'roberto@usfx.edu.bo', 'Buen ayudante, explica bien los conceptos.', 4),
(2, 'Laura Jimenez', 'laura@usfx.edu.bo', 'Muy amable y paciente. Me ayudó mucho.', 5),
(2, 'Diego Ramos', 'diego@usfx.edu.bo', 'Conoce bien del tema de web.', 4);