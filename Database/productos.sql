-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2024 a las 00:51:06
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
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(3) NOT NULL,
  `activo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `activo`) VALUES
(1, 'Camiseta Barcelona Fc', '<p>Camiseta Barcelona FC</p>\n<br>\n<b>Caracteristicas</b><br>\nMarca:Nike<br>\nColeccion:Retro<br>\nModelo:Dri-Fit<br>\nColor:Azul y Rojo<br>', 80.00, 0, 1),
(2, 'camiseta', '<p>Camiseta Sport</p>\n<br>\n<b>Caracteristicas</b><br>\nMarca:Nike<br>\nColeccion:Retro<br>\nModelo:Dri-Fit<br>\nColor:Azul y Rojo<br>', 80.00, 0, 1),
(3, 'Mameluco', '<p>Mameluco para bebe FC</p>\n<br>\n<b>Caracteristicas</b><br>\nMarca:Adidas<br>\nColeccion:Retro<br>\nModelo:AllFor<br>\n', 25.00, 0, 1),
(4, 'Sudadera', '<p>Sudadera FC</p> <br> <b>Caracteristicas</b><br> Marca:Nike<br> Coleccion:Retro<br> Modelo:Dri-Fit<br>', 20.00, 0, 1),
(5, 'Sueter', '<p>Sueter South park</p> <br> <b>Caracteristicas</b><br> Marca:Nike<br> Coleccion:Retro<br> Modelo:AllFor<br>', 25.00, 3, 1),
(6, 'Camisa', '<p>Camisa South park</p> <br> <b>Caracteristicas</b><br> Marca:Adidas<br> Coleccion:Retro<br> Modelo:AllFor<br>', 15.00, 2, 1),
(7, 'Sueter', '<p>Sueter South park FC</p> <br> <b>Caracteristicas</b><br> Marca:Adidas<br> Coleccion:Retro<br> Modelo:AllFor<br>', 10.00, 3, 1),
(8, 'Camisa 5° Escalon', '<p>Quinto Escalon</p> <br> <b>Caracteristicas</b><br> Marca:Adidas<br> Coleccion:Retro<br> Modelo:AllFor<br>', 15.00, 3, 1),
(9, 'Camisa Mickey', '<p>Camisa Disney</p> <br> <b>Caracteristicas</b><br> Marca:Adidas<br> Coleccion:Retro<br> Modelo:AllFor<br>', 50.00, 5, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
