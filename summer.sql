-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2018 a las 15:38:26
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `summer`
--
CREATE DATABASE IF NOT EXISTS `summer` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `summer`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(80) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(2, 'Niña'),
(1, 'Niño');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombres` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(2) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_bloqueo` datetime DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombres`, `apellidos`, `email`, `nombre_usuario`, `contrasena`, `estado`, `fecha_registro`, `fecha_bloqueo`, `ip`) VALUES
(1, 'Andres', 'Henriquez', 'andresdosmil@gmail.com', 'AndresK21', '$2y$10$66NlegmAcOyR50Apyv3pEu1tF.lcfFmGzzAVb.u6cPlxMBCKhaQaC', 1, '2018-08-27 00:00:00', NULL, NULL);

--
-- Disparadores `cliente`
--
DELIMITER $$
CREATE TRIGGER `cliente-pedido` AFTER INSERT ON `cliente` FOR EACH ROW BEGIN 

DECLARE cliente1 int;
DECLARE fecha1 date;

SET cliente1 = (SELECT MAX(id_cliente) FROM cliente);
SET fecha1 = CURRENT_DATE;

INSERT INTO pedido(estado, fecha, id_cliente, id_empleado) VALUES(0, fecha1, cliente1, 1);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(2) NOT NULL,
  `estado` int(1) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_producto`, `cantidad`, `estado`, `id_pedido`) VALUES
(1, 2, 3, 1, 1),
(2, 2, 1, 1, 5),
(3, 2, 1, 1, 1),
(4, 2, 2, 1, 1),
(5, 2, 1, 1, 1),
(6, 2, 1, 1, 9),
(7, 2, 2, 1, 10),
(8, 2, 1, 1, 11),
(9, 2, 3, 1, 12),
(10, 2, 1, 1, 13),
(11, 2, 4, 1, 14),
(12, 2, 2, 1, 15),
(13, 2, 1, 1, 16),
(14, 2, 1, 1, 17),
(15, 2, 1, 1, 18),
(16, 2, 1, 1, 19),
(17, 2, 2, 1, 20),
(18, 2, 2, 1, 21),
(19, 2, 1, 1, 22),
(20, 2, 2, 1, 23),
(21, 2, 2, 1, 24),
(22, 2, 3, 1, 25),
(23, 2, 10, 1, 26),
(24, 2, 3, 1, 27),
(25, 2, 3, 1, 28),
(26, 2, 1, 1, 29),
(27, 2, 3, 1, 30),
(28, 2, 6, 1, 31),
(29, 2, 3, 1, 32);

--
-- Disparadores `detalle_pedido`
--
DELIMITER $$
CREATE TRIGGER `cantidad_priductos` AFTER INSERT ON `detalle_pedido` FOR EACH ROW BEGIN

DECLARE cantidad1 int;
DECLARE producto1 int;

SET cantidad1 = (SELECT cantidad FROM detalle_pedido WHERE id_detalle = (SELECT MAX(id_detalle) FROM detalle_pedido));

SET producto1 = (SELECT id_producto FROM detalle_pedido WHERE id_detalle = (SELECT MAX(id_detalle) FROM detalle_pedido));

UPDATE producto SET cantidad = (cantidad - cantidad1) WHERE id_producto = producto1;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre_completo` varchar(240) COLLATE utf8_spanish2_ci NOT NULL,
  `correo_electronico` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `estado` int(2) DEFAULT NULL,
  `fecha_bloqueo` datetime DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre_completo`, `correo_electronico`, `nombre_usuario`, `contrasena`, `imagen`, `fecha_registro`, `estado`, `fecha_bloqueo`, `ip`) VALUES
(1, 'Andres Oswaldo Henriquez Gomez', 'andresdosmil@gmail.com', 'AndresK21', '$2y$10$yIe5vMB77i2Q5CPNMEh08eoulpELCKH0C4xnK/3Uta.W/xcVsdDRe', '5b843ccf871c4.jpg', '2018-08-29 10:04:31', 1, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `estado` int(2) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `estado`, `fecha`, `total`, `id_cliente`, `id_empleado`) VALUES
(1, 1, '2018-08-27 00:00:00', '17.50', 1, 1),
(5, 1, '2018-08-28 00:00:00', '2.50', 1, 1),
(9, 1, '2018-08-28 00:00:00', '2.50', 1, 1),
(10, 1, '2018-08-28 00:00:00', '5.00', 1, 1),
(11, 1, '2018-08-28 00:00:00', '2.50', 1, 1),
(12, 1, '2018-08-28 00:00:00', '7.50', 1, 1),
(13, 1, '2018-08-28 00:00:00', '2.50', 1, 1),
(14, 1, '2018-08-28 00:00:00', '10.00', 1, 1),
(15, 1, '2018-08-28 00:00:00', '5.00', 1, 1),
(16, 1, '2018-08-28 00:00:00', '2.50', 1, 1),
(17, 1, '2018-08-28 00:00:00', '2.50', 1, 1),
(18, 1, '2018-08-28 00:00:00', '2.50', 1, 1),
(19, 1, '2018-08-28 00:00:00', '2.50', 1, 1),
(20, 1, '2018-08-28 00:00:00', '5.00', 1, 1),
(21, 1, '2018-08-28 00:00:00', '5.00', 1, 1),
(22, 1, '2018-08-28 00:00:00', '2.50', 1, 1),
(23, 1, '2018-08-29 00:00:00', '5.00', 1, 1),
(24, 1, '0000-00-00 00:00:00', '5.00', 1, 1),
(25, 1, '0000-00-00 00:00:00', '7.50', 1, 1),
(26, 1, '0000-00-00 00:00:00', '25.00', 1, 1),
(27, 1, '0000-00-00 00:00:00', '7.50', 1, 1),
(28, 1, '0000-00-00 00:00:00', '7.50', 1, 1),
(29, 1, '0000-00-00 00:00:00', '2.50', 1, 1),
(30, 1, '0000-00-00 00:00:00', '7.50', 1, 1),
(31, 1, '2018-08-29 09:42:46', '15.00', 1, 1),
(32, 1, '2018-08-29 09:59:42', '7.50', 1, 1),
(33, 0, '2018-08-29 00:00:00', '0.00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentaciones`
--

CREATE TABLE `presentaciones` (
  `id_presentacion` int(11) NOT NULL,
  `presentacion` varchar(80) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `presentaciones`
--

INSERT INTO `presentaciones` (`id_presentacion`, `presentacion`) VALUES
(1, 'Bolson');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `imagen` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_presentacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `cantidad`, `precio`, `imagen`, `id_categoria`, `id_presentacion`) VALUES
(1, 'Bolsa bla bla bla', 25, '2.50', '5b844d2d12d83.jpg', NULL, 1),
(2, 'Bolso bla bla bla', 59, '2.50', '5b844d7e866ed.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id_valoracion` int(11) NOT NULL,
  `estrellas` int(2) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `categoria` (`categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `email` (`email`),
  ADD KEY `nombre_usuario` (`nombre_usuario`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `nombre_usuario` (`nombre_usuario`),
  ADD KEY `correo_electronico` (`correo_electronico`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `presentaciones`
--
ALTER TABLE `presentaciones`
  ADD PRIMARY KEY (`id_presentacion`),
  ADD KEY `presentacion` (`presentacion`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_presentacion` (`id_presentacion`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `presentaciones`
--
ALTER TABLE `presentaciones`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_presentacion`) REFERENCES `presentaciones` (`id_presentacion`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
