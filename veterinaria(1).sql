-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 14, 2023 at 05:41 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veterinaria`
--
CREATE DATABASE IF NOT EXISTS `veterinaria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `veterinaria`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_especies`
--

DROP TABLE IF EXISTS `tbl_especies`;
CREATE TABLE IF NOT EXISTS `tbl_especies` (
  `id_especie` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `estado` tinyint NOT NULL,
  `creado_por` int NOT NULL,
  `actualizado_por` int NOT NULL,
  `fecha` date NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  PRIMARY KEY (`id_especie`),
  KEY `actualizado_por` (`actualizado_por`),
  KEY `creado_por` (`creado_por`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_especies`
--

INSERT INTO `tbl_especies` (`id_especie`, `nombre`, `estado`, `creado_por`, `actualizado_por`, `fecha`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Perros', 1, 1, 1, '2023-09-21', '2023-09-22 05:42:28', '2023-09-22 05:42:28'),
(2, 'Gatos', 1, 2, 2, '2023-09-21', '2023-09-22 05:43:13', '2023-09-22 05:43:13'),
(6, 'lagarto', 1, 1, 1, '2023-10-13', '2023-10-13 07:35:32', '2023-10-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pacientes`
--

DROP TABLE IF EXISTS `tbl_pacientes`;
CREATE TABLE IF NOT EXISTS `tbl_pacientes` (
  `id_paciente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `enfermedades` text NOT NULL,
  `vacunas` text NOT NULL,
  `id_raza` int NOT NULL,
  `imagen` text NOT NULL,
  `estado` int NOT NULL,
  `fecha` date NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `creado_por` int NOT NULL,
  `actualizado_por` int NOT NULL,
  PRIMARY KEY (`id_paciente`),
  KEY `creado_por` (`creado_por`),
  KEY `actualizado_por` (`actualizado_por`),
  KEY `id_raza` (`id_raza`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_pacientes`
--

INSERT INTO `tbl_pacientes` (`id_paciente`, `nombre`, `enfermedades`, `vacunas`, `id_raza`, `imagen`, `estado`, `fecha`, `fecha_creacion`, `fecha_actualizacion`, `creado_por`, `actualizado_por`) VALUES
(2, 'Sr gato', 'Gripe', 'Sarna, Jiote, Ninguna', 3, 'imagenes/o3jtxqz54b.jpeg', 0, '2023-09-21', '2023-09-22 05:45:51', '2023-10-14 05:02:58', 1, 1),
(26, '33', 'Rabia, Gripe, Jiote', 'Sarna, Rabia, Jiote, Ninguna', 2, 'imagenes/6e20yh1ctf.jpeg', 0, '2023-10-14', '2023-10-14 05:33:55', '2023-10-14 05:34:41', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_razas`
--

DROP TABLE IF EXISTS `tbl_razas`;
CREATE TABLE IF NOT EXISTS `tbl_razas` (
  `id_raza` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `estado` tinyint NOT NULL,
  `creado_por` int NOT NULL,
  `actualizado_por` int NOT NULL,
  `fecha` date NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `id_especie` int NOT NULL,
  PRIMARY KEY (`id_raza`),
  KEY `id_especie` (`id_especie`),
  KEY `creado_por` (`creado_por`),
  KEY `actualizado_por` (`actualizado_por`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_razas`
--

INSERT INTO `tbl_razas` (`id_raza`, `nombre`, `estado`, `creado_por`, `actualizado_por`, `fecha`, `fecha_creacion`, `fecha_actualizacion`, `id_especie`) VALUES
(1, 'Pitbull', 1, 1, 1, '2023-09-21', '2023-09-22 05:43:30', '2023-09-22 05:43:30', 1),
(2, 'Dalmata', 1, 1, 1, '2023-09-21', '2023-09-22 05:43:59', '2023-09-22 05:43:59', 1),
(3, 'Siames', 1, 2, 2, '2023-09-21', '2023-09-22 05:44:11', '2023-09-22 05:44:11', 2),
(4, 'Sphinx', 1, 2, 2, '2023-09-21', '2023-09-22 05:44:11', '2023-09-22 05:44:11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id_rol`, `rol`) VALUES
(1, 'administrador'),
(2, 'usuario'),
(3, 'visitante');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `tbl_usuarios_ibfk_1` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `username`, `password`, `id_rol`) VALUES
(1, 'Admin', '123456', 1),
(2, 'Zeke16', '123456', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_especies`
--
ALTER TABLE `tbl_especies`
  ADD CONSTRAINT `tbl_especies_ibfk_1` FOREIGN KEY (`actualizado_por`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_especies_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_pacientes`
--
ALTER TABLE `tbl_pacientes`
  ADD CONSTRAINT `tbl_pacientes_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_pacientes_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_pacientes_ibfk_3` FOREIGN KEY (`id_raza`) REFERENCES `tbl_razas` (`id_raza`);

--
-- Constraints for table `tbl_razas`
--
ALTER TABLE `tbl_razas`
  ADD CONSTRAINT `tbl_razas_ibfk_1` FOREIGN KEY (`id_especie`) REFERENCES `tbl_especies` (`id_especie`),
  ADD CONSTRAINT `tbl_razas_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_razas_ibfk_3` FOREIGN KEY (`actualizado_por`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Constraints for table `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD CONSTRAINT `tbl_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
