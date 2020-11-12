-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-11-2020 a las 16:45:11
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id15253096_subasta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_subasta` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_usuario`, `id_subasta`) VALUES
(2, 7, 10),
(3, 12, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carros`
--

CREATE TABLE `carros` (
  `id_carro` int(11) NOT NULL,
  `marca` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cc` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen1` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen2` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carros`
--

INSERT INTO `carros` (`id_carro`, `marca`, `cc`, `modelo`, `descripcion`, `imagen`, `imagen1`, `imagen2`, `id_categoria`) VALUES
(14, 'BMW 2015', '2500', '2014', 'BMW 2015', 'BMW1.jpg', 'BMW2.jpg', 'BMW3.jpg', 1),
(15, 'Lambo', '3000', '2020', 'Lambo', 'Lambo1.jpg', 'Lambo2.jpg', 'Lambo3.jpg', 1),
(16, 'Toyota', '2500', '2018', 'Toyota Lexus', 'Toyota1.jpg', 'Toyota2.jpg', 'Toyota3.jpg', 1),
(17, 'Lamborghini sián', '3500', '2021', 'Es un automóvil superdeportivo producido por el fabricante italiano Lamborghini. ', 'Lambo1.jpg', 'Lambo2.jpg', 'Lambo3.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `descripcion`) VALUES
(1, 'Nuevos', 'Todos los autos de agencia'),
(2, 'Usados', 'Carros Usados'),
(3, 'Reconstruidos', 'Carros Chocados reparados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `id_oferta` int(11) NOT NULL,
  `oferta` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_subasta` int(11) NOT NULL,
  `comprador` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`id_oferta`, `oferta`, `estado`, `fecha`, `id_subasta`, `comprador`) VALUES
(5, 30000, 0, '2020-10-31 01:27:39', 10, 10),
(6, 100000, 1, '2020-11-10 01:42:56', 10, 7),
(7, 1210, 0, '2020-11-12 14:43:38', 12, 12),
(8, 1205, 0, '2020-11-12 14:43:51', 12, 7),
(9, 1210, 0, '2020-11-12 14:44:16', 12, 12),
(10, 1215, 0, '2020-11-12 14:45:15', 12, 7),
(11, 7000, 1, '2020-11-12 02:45:27', 12, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subasta`
--

CREATE TABLE `subasta` (
  `id_subasta` int(11) NOT NULL,
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `tiempo_ini` datetime NOT NULL,
  `tiempo_fin` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `comprador` int(11) DEFAULT NULL,
  `subastador` int(11) NOT NULL,
  `id_carro` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subasta`
--

INSERT INTO `subasta` (`id_subasta`, `min`, `max`, `tiempo_ini`, `tiempo_fin`, `estado`, `comprador`, `subastador`, `id_carro`) VALUES
(10, 20000, 100000, '2020-10-31 00:02:50', '2020-11-02 12:00:00', 1, 7, 1, 14),
(11, 100, 222, '2020-11-03 00:43:20', '2020-11-03 12:00:00', 1, NULL, 1, 15),
(12, 1200, 7000, '2020-11-11 21:52:42', '2020-11-17 12:00:00', 1, 12, 1, 16),
(13, 100000, 300000, '2020-11-12 15:35:46', '2020-11-17 12:00:00', 0, NULL, 1, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(20) NOT NULL,
  `administrador` tinyint(10) NOT NULL DEFAULT 0,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `foto` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `user` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `administrador`, `nombre`, `apellido1`, `apellido2`, `telefono`, `foto`, `correo`, `user`, `pass`) VALUES
(1, 1, 'Subastador', 'Ventas', 'Subastador', '40326678', '1.jpg', 'subastador@gmail.com', 'Subastador', 'admin123'),
(7, 0, 'Luis', 'Luis', 'Luis', '30303030', 'signup.png', '1@hotmail.com', 'Luis', '1234@'),
(8, 0, 'Javier', 'Duarte', '', '22222222', NULL, 'javi@gmail.com', 'javi', 'javi'),
(11, 0, 'Paola', 'Car', 'Calan', '27', '16041072626561590974289264549282.jpg', 'pao@hotmail.com', 'paola', 'paola'),
(12, 0, 'Eduardo', 'Morales', '', '47891232', 'Qmz4l8.jpg', 'morales@hotmail.com', 'Eduardo', 'Morales'),
(13, 0, 'Carlos', 'Aldana', '', '40859784', NULL, 'aldana@hotmail.com', 'Carlos', 'Carlos123'),
(14, 0, 'Cristofer', 'Garcia', '', '12345678', NULL, 'camey@hotmail.com', 'Cristofer', 'Cristofer'),
(15, 0, 'Henry', NULL, NULL, NULL, NULL, 'henry@hotmail.com', 'henry2020', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`);

--
-- Indices de la tabla `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id_carro`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id_oferta`);

--
-- Indices de la tabla `subasta`
--
ALTER TABLE `subasta`
  ADD PRIMARY KEY (`id_subasta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carros`
--
ALTER TABLE `carros`
  MODIFY `id_carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `subasta`
--
ALTER TABLE `subasta`
  MODIFY `id_subasta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
