-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2025 a las 23:47:02
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
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `Id_Reparacion` int(11) NOT NULL,
  `Id_Dispositivo` int(11) NOT NULL,
  `Id_Tecnico` int(11) NOT NULL,
  `Repuestos` varchar(500) NOT NULL,
  `Total_Repuestos` int(11) NOT NULL,
  `Servicio` varchar(500) NOT NULL,
  `Total_Servicio` int(11) NOT NULL,
  `Fecha_Reparacion` datetime NOT NULL,
  `Activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reparaciones`
--

INSERT INTO `reparaciones` (`Id_Reparacion`, `Id_Dispositivo`, `Id_Tecnico`, `Repuestos`, `Total_Repuestos`, `Servicio`, `Total_Servicio`, `Fecha_Reparacion`, `Activo`) VALUES
(1, 1, 1, 'Display', 20, 'Cambio Display', 23, '2025-05-01 15:41:00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`Id_Reparacion`),
  ADD KEY `fk_tecnico` (`Id_Tecnico`),
  ADD KEY `fk_dispositivo` (`Id_Dispositivo`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `Id_Reparacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD CONSTRAINT `fk_movil` FOREIGN KEY (`Id_Dispositivo`) REFERENCES `datosdispositivos` (`Id_Dispositivo`),
  ADD CONSTRAINT `fk_tecnico` FOREIGN KEY (`Id_Tecnico`) REFERENCES `datostecnico` (`Id_Tecnico`),
  ADD CONSTRAINT `reparaciones_ibfk_1` FOREIGN KEY (`Id_Dispositivo`) REFERENCES `datosdispositivos` (`Id_Dispositivo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
