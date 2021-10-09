-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2021 a las 05:48:31
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `maderas`
--
CREATE DATABASE `maderas`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_producto` int(11) NOT NULL,
  `cantidad_carrito` int(11) NOT NULL,
  `id_user` char(11) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `estado` text NOT NULL,
  `usuario` text NOT NULL,
  `numero_productos` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `estado`, `usuario`, `numero_productos`, `total`) VALUES
(1, 'ac', 'leonardo', 2, 400),
(2, 'ac', 'leonardo', 3, 600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` int(11) NOT NULL,
  `usu` char(11) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`, `usu`, `estado`) VALUES
(1, 1, '1', 's'),
(2, 3, '1', 's'),
(3, 4, '1', 's'),
(4, 5, '1', 's'),
(5, 6, '1', 's'),
(6, 7, '1', 's'),
(7, 8, '1', 's'),
(8, 2, '2', 's'),
(9, 3, '2', 'n'),
(10, 4, '2', 'n'),
(11, 5, '2', 'n'),
(12, 6, '2', 'n'),
(13, 7, '2', 'n'),
(14, 8, '2', 'n'),
(15, 1, '3', 's'),
(16, 3, '3', 's'),
(17, 4, '3', 's'),
(18, 5, '3', 's'),
(19, 6, '3', 's'),
(20, 7, '3', 's'),
(21, 8, '3', 's'),
(85, 1, '8', 's'),
(86, 3, '8', 's'),
(87, 4, '8', 's'),
(88, 5, '8', 's'),
(89, 6, '8', 's'),
(90, 7, '8', 's'),
(91, 8, '8', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_tmp`
--

CREATE TABLE `permisos_tmp` (
  `id_permisostmp` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `permisos_tmp`
--

INSERT INTO `permisos_tmp` (`id_permisostmp`, `nombre`) VALUES
(1, 'modulo cajero'),
(2, 'modulo administrador'),
(3, 'Agregar_producto'),
(4, 'Carrito'),
(5, 'Generar reporte de ventas'),
(6, 'Mis facturas'),
(7, 'ver_inventario'),
(8, 'Crud usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `url_imagen` text COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_producto` text COLLATE utf8_spanish2_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `precio_unidad` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_producto`, `url_imagen`, `nombre_producto`, `id_tipo`, `descripcion`, `precio_unidad`, `cantidad`, `estado`) VALUES
(1, 12, '', 'Cama', 1, 'mmm', 200, 4, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo` int(11) NOT NULL,
  `nombre_tipo` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo`, `nombre_tipo`) VALUES
(1, 'Madera en bruto'),
(2, 'Muebles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `username`
--

CREATE TABLE `username` (
  `documento` char(11) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `username`
--

INSERT INTO `username` (`documento`, `usuario`, `contrasena`, `correo`, `fecha`, `tipo`) VALUES
('1', 'leonardo', '1234', 'leonardo@gmail.com', '2021-10-08 22:13:57', 'a'),
('2', 'Jose esteban', '1234', 'jose@gmail.com', '2021-10-08 02:00:12', 'c'),
('3', 'jose gallego', '123', 'josegallego@gmail.com', '2021-10-08 21:21:00', 'c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_producto_ventas` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `cantidad_ventas` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `estado_venta` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_producto_ventas`, `id_factura`, `cantidad_ventas`, `total`, `estado_venta`, `fecha`) VALUES
(1, 12, 1, 2, 400, 'vendido', '2021-10-09 03:04:46'),
(2, 12, 2, 3, 600, 'vendido', '2021-10-09 03:40:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usu` (`usu`),
  ADD KEY `permiso` (`permiso`);

--
-- Indices de la tabla `permisos_tmp`
--
ALTER TABLE `permisos_tmp`
  ADD PRIMARY KEY (`id_permisostmp`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_producto` (`id_producto`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `username`
--
ALTER TABLE `username`
  ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_producto` (`id_producto_ventas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `permisos_tmp`
--
ALTER TABLE `permisos_tmp`
  MODIFY `id_permisostmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
