-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2026 at 01:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_rendimiento_usfx`
--

-- --------------------------------------------------------

--
-- Table structure for table `rendimiento_academico`
--

CREATE TABLE `rendimiento_academico` (
  `id_registro` int(11) NOT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `periodo` varchar(10) NOT NULL,
  `estudiantes_inscritos` int(11) NOT NULL,
  `estudiantes_aprobados` int(11) NOT NULL,
  `estudiantes_reprobados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rendimiento_academico`
--

INSERT INTO `rendimiento_academico` (`id_registro`, `id_materia`, `periodo`, `estudiantes_inscritos`, `estudiantes_aprobados`, `estudiantes_reprobados`) VALUES
(1, 1, '01/2026', 100, 78, 22),
(2, 2, '01/2026', 80, 62, 18),
(3, 3, '01/2026', 120, 75, 45),
(4, 1, '02/2026', 95, 85, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rendimiento_academico`
--
ALTER TABLE `rendimiento_academico`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_materia` (`id_materia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rendimiento_academico`
--
ALTER TABLE `rendimiento_academico`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rendimiento_academico`
--
ALTER TABLE `rendimiento_academico`
  ADD CONSTRAINT `rendimiento_academico_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
