-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2025 a las 23:46:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosdispositivos`
--

CREATE TABLE `datosdispositivos` (
  `Id_Dispositivo` int(11) NOT NULL,
  `Id_Cliente` int(11) NOT NULL,
  `Tipo` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Marca` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Modelo` varchar(80) NOT NULL,
  `Año` int(4) NOT NULL,
  `Activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datosdispositivos`
--

INSERT INTO `datosdispositivos` (`Id_Dispositivo`, `Id_Cliente`, `Tipo`, `Marca`, `Modelo`, `Año`, `Activo`) VALUES
(1, 1, 'Smartphone', 'Iphone', 'Xr', 2024, 1),
(2, 1, 'Smartphone', 'Samsung', 'A20', 2024, 0),
(3, 1, 'Tablet', 'sa', 'sa', 1231, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datosdispositivos`
--
ALTER TABLE `datosdispositivos`
  ADD PRIMARY KEY (`Id_Dispositivo`),
  ADD KEY `Fk_Cliente` (`Id_Cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datosdispositivos`
--
ALTER TABLE `datosdispositivos`
  MODIFY `Id_Dispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datosdispositivos`
--
ALTER TABLE `datosdispositivos`
  ADD CONSTRAINT `Fk_Cliente` FOREIGN KEY (`Id_Cliente`) REFERENCES `datoscliente` (`Id_Cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
