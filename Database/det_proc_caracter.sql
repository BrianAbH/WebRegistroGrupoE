-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2024 a las 00:50:59
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `digitallocal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_proc_caracter`
--

CREATE TABLE `det_proc_caracter` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_caracteristica` int(11) NOT NULL,
  `valor` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `det_proc_caracter`
--

INSERT INTO `det_proc_caracter` (`id`, `id_producto`, `id_caracteristica`, `valor`, `stock`) VALUES
(1, 1, 1, '22', 5),
(2, 1, 1, '24', 3),
(3, 1, 1, '22', 5),
(4, 1, 1, '24', 3),
(5, 1, 2, 'Roja', 3),
(6, 1, 2, 'Azul', 4),
(7, 2, 1, '22', 5),
(8, 2, 1, '25', 4),
(9, 2, 1, '27', 5),
(10, 2, 2, 'Amarilla', 8),
(11, 2, 2, 'Roja', 8),
(12, 2, 2, 'Azul', 10),
(13, 3, 1, '15', 9),
(14, 3, 1, '13', 8),
(15, 3, 1, '12', 10),
(16, 3, 2, 'Azul', 8),
(17, 3, 2, 'Verde', 17),
(18, 3, 2, 'Morado', 10),
(19, 4, 1, '28', 7),
(20, 4, 1, '26', 57),
(21, 4, 1, '24', 8),
(22, 4, 2, 'Negra', 8),
(23, 4, 2, 'Azul', 9),
(24, 4, 2, 'Gris', 8),
(25, 5, 1, '13', 8),
(26, 5, 1, '12', 10),
(27, 5, 2, 'Azul', 8),
(28, 5, 2, 'Verde', 17),
(29, 5, 2, 'Morado', 10),
(30, 6, 1, '13', 8),
(31, 6, 1, '12', 10),
(32, 6, 2, 'Azul', 8),
(33, 6, 2, 'Azul', 8),
(34, 6, 2, 'Verde', 17),
(35, 6, 2, 'Morado', 10),
(36, 7, 1, '13', 8),
(37, 7, 1, '12', 10),
(38, 7, 2, 'Azul', 8),
(39, 7, 2, 'Azul', 8),
(40, 7, 2, 'Verde', 17),
(41, 7, 2, 'Morado', 10),
(42, 8, 1, '13', 8),
(43, 7, 1, '12', 10),
(44, 8, 2, 'Azul', 8),
(45, 8, 2, 'Azul', 8),
(46, 8, 2, 'Verde', 17),
(47, 8, 2, 'Morado', 10),
(48, 9, 1, '13', 8),
(49, 9, 1, '12', 10),
(50, 9, 2, 'Azul', 8),
(51, 9, 2, 'Azul', 8),
(52, 9, 2, 'Verde', 17),
(53, 9, 2, 'Morado', 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `det_proc_caracter`
--
ALTER TABLE `det_proc_caracter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_det_prod` (`id_producto`),
  ADD KEY `fk_det_caracter` (`id_caracteristica`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `det_proc_caracter`
--
ALTER TABLE `det_proc_caracter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `det_proc_caracter`
--
ALTER TABLE `det_proc_caracter`
  ADD CONSTRAINT `fk_det_caracter` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristicas` (`id`),
  ADD CONSTRAINT `fk_det_prod` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
