-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2017 a las 19:39:50
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_pedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombrecategoria` varchar(75) COLLATE utf8_german2_ci NOT NULL,
  `descripcioncategoria` varchar(250) COLLATE utf8_german2_ci NOT NULL,
  `condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombrecategoria`, `descripcioncategoria`, `condicion`) VALUES
(1, 'Artículos  de Oficina', 'Productos de madera decorados para la oficina.', 1),
(2, 'Artículos Decorativos', 'Productos decorativos elaborados en pintura artística y con arena', 1),
(3, 'Artículos de Cocina', 'Productos son elaborados en pintura artística ', 1),
(4, 'Artículos Utilitarios', 'Productos Utilitarios de Pintura Artística', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombrecliente` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `apellidocliente` varchar(50) COLLATE utf8_german2_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `password` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `telefono` varchar(9) COLLATE utf8_german2_ci NOT NULL,
  `celular` varchar(9) COLLATE utf8_german2_ci NOT NULL,
  `direccion` varchar(250) COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombrecliente`, `apellidocliente`, `username`, `password`, `telefono`, `celular`, `direccion`, `email`) VALUES
(1, 'Walter', 'Velis', 'Velis45', '0000', '2216-1071', '7422-7019', '4° Avenida Norte, casa N° 22 Apopa', 'waltervelis45@gmail.com'),
(2, 'Wendy', 'Carolina', 'wenkar', '1234', '7537-7233', '7537-7233', 'Residencial San Gabriel, clouster #6, casa #5 Apopa', 'wenkar_1990@hotmail.com'),
(3, 'Sofia', 'Martinez', 'Haragana-25', '1111', '7973-5356', '-', '-', 'dina.sofia.06@gmial.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `iddetalle` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidadprod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE `estadistica` (
  `idestadistica` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `cantvotos` int(11) DEFAULT NULL,
  `totalvotos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `idoferta` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `descuento` float NOT NULL,
  `descripcionoferta` varchar(200) COLLATE utf8_german2_ci NOT NULL,
  `estadooferta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`idoferta`, `idproducto`, `descuento`, `descripcionoferta`, `estadooferta`) VALUES
(1, 1, 15, 'Obtén 15% de descuento por tu primera compra.', 1),
(2, 2, 25, 'Obtén 25% de descuento por tu primera compra.', 0),
(3, 3, 10, 'Obtén 10% de descuento por tu primera compra.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `montototal` float NOT NULL,
  `fechaentrega` varchar(10) COLLATE utf8_german2_ci NOT NULL,
  `horaentrega` varchar(8) COLLATE utf8_german2_ci NOT NULL,
  `estadopedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `codigo` varchar(16) COLLATE utf8_german2_ci NOT NULL,
  `nombreproducto` varchar(75) COLLATE utf8_german2_ci NOT NULL,
  `descripcionproducto` varchar(250) COLLATE utf8_german2_ci DEFAULT NULL,
  `foto` varchar(25) COLLATE utf8_german2_ci DEFAULT NULL,
  `precio` float NOT NULL,
  `estadoproducto` int(11) NOT NULL,
  `puntuacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `idcategoria`, `codigo`, `nombreproducto`, `descripcionproducto`, `foto`, `precio`, `estadoproducto`, `puntuacion`) VALUES
(1, 1, 'CA-PO-PA-001', 'Calendario', 'Medidas: 7X9 cm', '35Calendario.PNG', 4, 1, NULL),
(2, 1, 'CA-PO-PA-006', 'Agenda N° 1', 'Medidas: 8x6 cms.', '38Agenda.PNG', 2, 1, NULL),
(3, 1, 'CA-PO-PA-003', 'Calendario Casita Porta Lápiz', 'Medidas: 17.5x11 cms', '11Calendario Casita.PNG', 5.5, 1, NULL),
(4, 1, 'CA-PO-PA-007', 'Agenda N°2', 'Medidas: 13.5x8 cm', '40Agenda02.PNG', 2.5, 1, NULL),
(5, 3, 'CA-PC-PA-009', 'Caja para Té ', '8 depósitos, Medidas: 28x18x7 cm', '18Caja para Te.PNG', 10.5, 1, NULL),
(6, 2, 'CA-PD-PA-021', 'Batea cuadrada', 'Medidas: 27x24 cm', '42Baeta Cuadrada.PNG', 4, 1, NULL),
(7, 2, 'CA-PD-PA-011', 'Cruces Gótica', 'Medida: 15 cm', '27cruz.PNG', 1.75, 1, NULL),
(8, 4, 'CA-PU-PA-026', 'Juego de cofres ovalado', 'Medidas: 5x5 cm', '22cofres01.PNG', 6.75, 1, NULL),
(9, 4, 'CA-PU-PA-044', 'Retablo porta llaves', 'Medidas: 15x15 cm.', '40Pintura Porta-Llave.PNG', 3.75, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user_default.png',
  `type` enum('admin','cliente') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cliente',
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `type`, `code`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Felipe Argueta', 'administrador@gmail.com', '$2y$10$HLrp6NgOrTUrIvmJhs7D5.rmWou3prg3j1pplUO/qVZc4dQJ7ZBH2', 'user_default.png', 'admin', '', 1, 'czf6bK4OvbiWRJrCtnp01XXBuNqYHaJCXci9ncTirTNv3WD88W4OEw7xfDiU', NULL, '2017-12-03 20:26:28'),
(7, 'Walter Velis', 'waltervelis45@gmail.com', '$2y$10$0ksV4BYYd4mNEq5bmm152e8rGtZUEkRl418hO7/2woEtWPTAgsKKe', 'user_default.png', 'cliente', 'gb1au5vafr', 1, NULL, '2017-12-05 18:18:56', '2017-12-05 18:36:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`iddetalle`),
  ADD KEY `fk_detallepedido_pedido` (`idpedido`),
  ADD KEY `fk_detallepedido_producto` (`idproducto`);

--
-- Indices de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD PRIMARY KEY (`idestadistica`),
  ADD KEY `fk_producto_estadistica` (`idproducto`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`idoferta`),
  ADD KEY `fk_producto_oferta` (`idproducto`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `fk_pedido_cliente` (`idcliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_producto_categoria` (`idcategoria`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  MODIFY `idestadistica` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `idoferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `fk_detallepedido_pedido` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`),
  ADD CONSTRAINT `fk_detallepedido_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD CONSTRAINT `fk_producto_estadistica` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `fk_producto_oferta` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
