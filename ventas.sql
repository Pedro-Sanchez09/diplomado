-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2022 a las 01:51:53
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` bigint(11) NOT NULL,
  `password` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cedula`, `nombre`, `direccion`, `telefono`, `password`) VALUES
(123, 'Pedro', 'Manguito', 3134, '567'),
(345, 'Juan', 'ande', 433, '678'),
(2345, 'Juan', 'ande', 57, '456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `idCompra` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id-producto` int(11) NOT NULL,
  `id-cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`idCompra`, `importe`, `fecha`, `id-producto`, `id-cliente`) VALUES
(1, 39000, '2022-06-18', 45660, 123),
(3, 15000, '2022-06-18', 45663, 123),
(4, 4400, '2022-06-18', 45665, 123),
(6, 15000, '2022-06-18', 45663, 345),
(7, 4400, '2022-06-18', 45665, 345);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `descripcion`, `precio`) VALUES
(45660, 'CAFE SELLO ROJO X 500G ', '13000'),
(45661, 'CAFE CORDOBA X 500G ', '10000'),
(45662, 'AZUCAR X 500G ', '2000'),
(45663, 'AZUCAR MORENA X 500G', '5000'),
(45664, 'SAL REFISAL BOLSA X 1000 G ', '2000'),
(45665, 'ARROZ DIANA X 500 G', '2200'),
(45667, 'FAB 3D X 500G', '3800'),
(45668, 'ACEITE GIRASOL X 500ML', '9000'),
(57840, 'MULTI TOMA APC CON SUPRESOR DE PICOS REGLETA 6 TOMAS P6B-LM\r\n\r\n', '65000'),
(57841, '\r\nSMART TV EXCLUSIV EL32F2SM LED HD 32\" 100V/240V\r\n\r\n', '920000'),
(57842, 'PORTATIL HP 15-DK1506LA I5-10300H | 8GB | 512GB | GEFORCE GT\r\n\r\n', '5800000'),
(57843, 'POWER BANK BESTON CARGADOR PORTÁTIL BATERÍA 20000MAH \r\n\r\n', '100000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idCompra`),
  ADD KEY `fk_compras_productos_idx` (`id-producto`),
  ADD KEY `fk_compras_clientes1_idx` (`id-cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_clientes1` FOREIGN KEY (`id-cliente`) REFERENCES `clientes` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compras_productos` FOREIGN KEY (`id-producto`) REFERENCES `productos` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
