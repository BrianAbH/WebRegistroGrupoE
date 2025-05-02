-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2025 a las 23:46:14
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
-- Estructura de tabla para la tabla `datoscliente`
--

CREATE TABLE `datoscliente` (
  `Id_Cliente` int(11) NOT NULL,
  `Cedula` varchar(10) NOT NULL,
  `Nombres` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Apellidos` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Nombre_Completo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datoscliente`
--

INSERT INTO `datoscliente` (`Id_Cliente`, `Cedula`, `Nombres`, `Apellidos`, `Telefono`, `Direccion`, `Nombre_Completo`, `activo`) VALUES
(1, '0959112368', 'Bryan', 'Carranza', '0980666659', 'Guasmo Sur', 'Bryan Carranza', 1),
(3, '0959112362', 'dadd', 'agustin', '0980666559', 'guasmo sur union de bananero bloque 2 manz31', 'dadd agustin', 0),
(4, '1231231231', 'agustin', 'agustin', '1231231231', 'guasmo sur union de bananero bloque 2 manz31', 'agustin agustin', 0),
(5, '1231231231', 'agustin', 'agustin', '0980616659', 'guasmo sur union de bananero bloque 2 manz31', 'agustin agustin', 0),
(6, 'ytyt', 'agustin', 'agustin', '0980616659', 'guasmo sur union de bananero bloque 2 manz31', 'agustin agustin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datoscliente`
--
ALTER TABLE `datoscliente`
  ADD PRIMARY KEY (`Id_Cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datoscliente`
--
ALTER TABLE `datoscliente`
  MODIFY `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
