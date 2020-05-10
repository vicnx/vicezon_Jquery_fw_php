-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2020 a las 19:45:37
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `idbrand` int(30) NOT NULL,
  `namebrand` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`idbrand`, `namebrand`, `views`) VALUES
(1, 'samsung', 12),
(2, 'xiaomi', 32),
(3, 'iphone', 73),
(4, 'sony', 98),
(5, 'motorola', 33),
(6, 'Oppo', 0),
(7, 'redmi', 0),
(8, 'hola', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `username` varchar(255) NOT NULL,
  `idproduct` int(255) NOT NULL,
  `qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idfactura` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `total_factura` int(255) NOT NULL,
  `fecha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idfactura`, `username`, `total_factura`, `fecha`) VALUES
(1, 'test', 39558, '2020-04-13 13:57:08'),
(2, 'test', 46496, '2020-04-13 15:46:44'),
(3, 'test', 71600, '2020-04-13 17:03:38'),
(4, 'test', 50952, '2020-04-13 17:07:43'),
(5, 'test', 16324, '2020-04-19 09:41:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_linea`
--

CREATE TABLE `factura_linea` (
  `idlinea` int(255) NOT NULL,
  `idfactura` int(255) NOT NULL,
  `idproduct` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `cost` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura_linea`
--

INSERT INTO `factura_linea` (`idlinea`, `idfactura`, `idproduct`, `qty`, `cost`) VALUES
(1, 1, '6', 4, 1908),
(2, 1, '13', 5, 37650),
(3, 2, '3', 4, 34772),
(4, 2, '5', 4, 11724),
(5, 3, '3', 6, 52158),
(6, 3, '4', 2, 8162),
(7, 3, '5', 2, 5862),
(8, 3, '20', 2, 5418),
(9, 4, '13', 4, 30120),
(10, 4, '4', 3, 12243),
(11, 4, '5', 1, 2931),
(12, 4, '2', 6, 5658),
(13, 5, '4', 4, 16324);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `username` varchar(255) NOT NULL,
  `idproduct` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`username`, `idproduct`) VALUES
('test', 0),
('test', 2),
('test', 3),
('test', 5),
('test', 12),
('test', 15),
('test', 19),
('test', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loginusers`
--

CREATE TABLE `loginusers` (
  `iduser` int(11) NOT NULL,
  `rankuser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `loginusers`
--

INSERT INTO `loginusers` (`iduser`, `rankuser`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `money_codes`
--

CREATE TABLE `money_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` int(255) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `money_codes`
--

INSERT INTO `money_codes` (`id`, `code`, `value`, `state`) VALUES
(1, '6UPPO-HY9YU-1BVBS', 5025, 0),
(2, 'R2XTR-BXPCN-YO7IO', 5025, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablets`
--

CREATE TABLE `tablets` (
  `idproduct` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `marca` int(30) NOT NULL,
  `fpublic` varchar(255) DEFAULT NULL,
  `colores` varchar(255) NOT NULL,
  `sim` varchar(255) DEFAULT NULL,
  `rating` double NOT NULL DEFAULT 0,
  `imagen` varchar(255) NOT NULL DEFAULT 'module/admin/module/tablets/view/img/default.png',
  `views` int(11) NOT NULL DEFAULT 0,
  `stock` int(255) NOT NULL DEFAULT 1000
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tablets`
--

INSERT INTO `tablets` (`idproduct`, `nombre`, `price`, `marca`, `fpublic`, `colores`, `sim`, `rating`, `imagen`, `views`, `stock`) VALUES
(1, 'Oppo B', 8900, 4, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 5.14, 'modules/admin/module/tablets/view/img/11.jpg', 0, 1000),
(2, 'Alcatel R', 208, 5, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 4.93, 'modules/admin/module/tablets/view/img/16.jpg', 2, 1000),
(3, 'Honor G', 5780, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 0.33, 'modules/admin/module/tablets/view/img/15.jpg', 0, 1000),
(4, 'Nokia F', 4072, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 8.91, 'modules/admin/module/tablets/view/img/3.jpg', 0, 1000),
(5, 'IPadZ', 3119, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 8.3, 'modules/admin/module/tablets/view/img/13.jpg', 0, 1000),
(6, 'Cubot Version', 9305, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 6.58, 'modules/admin/module/tablets/view/img/3.jpg', 0, 1000),
(7, 'Xtrem D', 5679, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 1.94, 'modules/admin/module/tablets/view/img/11.jpg', 0, 1000),
(8, 'Realme tab', 1139, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 9.27, 'modules/admin/module/tablets/view/img/11.jpg', 0, 1000),
(9, 'Umidgi R', 8188, 3, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 5.34, 'modules/admin/module/tablets/view/img/9.jpg', 1, 1000),
(10, 'Cubot pad', 3385, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 4.96, 'modules/admin/module/tablets/view/img/4.jpg', 0, 1000),
(11, 'IPad F', 3059, 5, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 8.77, 'modules/admin/module/tablets/view/img/17.jpg', 0, 1000),
(12, 'Nokia pad', 422, 5, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 6.43, 'modules/admin/module/tablets/view/img/18.jpg', 0, 1000),
(13, 'Alcatel note', 5486, 4, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 6.68, 'modules/admin/module/tablets/view/img/12.jpg', 2, 1000),
(14, 'Realme Version', 8362, 4, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 9.63, 'modules/admin/module/tablets/view/img/17.jpg', 2, 1000),
(15, 'Nokia air', 4683, 5, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 8.4, 'modules/admin/module/tablets/view/img/2.jpg', 1, 1000),
(16, 'Windows A', 6160, 4, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 9.42, 'modules/admin/module/tablets/view/img/16.jpg', 0, 1000),
(17, 'IPad C', 6953, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 1.06, 'modules/admin/module/tablets/view/img/14.jpg', 0, 1000),
(18, 'Nokia Version', 2838, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 0.92, 'modules/admin/module/tablets/view/img/16.jpg', 0, 1000),
(19, 'huawei note', 2705, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 1.63, 'modules/admin/module/tablets/view/img/5.jpg', 0, 1000),
(20, 'Honor air', 8482, 5, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 5.88, 'modules/admin/module/tablets/view/img/2.jpg', 0, 1000),
(21, 'Xiaomi pad', 3425, 3, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 4.72, 'modules/admin/module/tablets/view/img/15.jpg', 0, 1000),
(22, 'Umidgi F', 7128, 3, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 4.29, 'modules/admin/module/tablets/view/img/12.jpg', 2, 1000),
(23, 'Meizu H', 6332, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 6.49, 'modules/admin/module/tablets/view/img/10.jpg', 0, 1000),
(24, 'IPad R', 4641, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 4.25, 'modules/admin/module/tablets/view/img/3.jpg', 0, 1000),
(25, 'NokiaZ', 9916, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 9.12, 'modules/admin/module/tablets/view/img/11.jpg', 0, 1000),
(26, 'Xtrem Version', 8579, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 9.32, 'modules/admin/module/tablets/view/img/8.jpg', 0, 1000),
(27, 'Realme I', 5025, 4, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 2.27, 'modules/admin/module/tablets/view/img/17.jpg', 0, 1000),
(28, 'Xiaomi I', 3915, 3, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 1.61, 'modules/admin/module/tablets/view/img/1.jpg', 2, 1000),
(29, 'IPad plus', 2127, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 9.01, 'modules/admin/module/tablets/view/img/3.jpg', 1, 1000),
(30, 'Cubot G', 1925, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 8.02, 'modules/admin/module/tablets/view/img/16.jpg', 0, 1000),
(31, 'Realme J', 8295, 4, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 9.76, 'modules/admin/module/tablets/view/img/2.jpg', 1, 1000),
(32, 'Meizu M', 2723, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 4.14, 'modules/admin/module/tablets/view/img/2.jpg', 0, 1000),
(33, 'Oppo C', 9630, 2, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 3.59, 'modules/admin/module/tablets/view/img/16.jpg', 0, 1000),
(34, 'Xiaomi C', 6578, 5, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 8.93, 'modules/admin/module/tablets/view/img/19.jpg', 0, 1000),
(35, 'Realme M', 5368, 5, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 7.45, 'modules/admin/module/tablets/view/img/10.jpg', 0, 1000),
(36, 'Nokia R', 793, 5, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 8.79, 'modules/admin/module/tablets/view/img/3.jpg', 0, 1000),
(37, 'Windows P', 6026, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 0.61, 'modules/admin/module/tablets/view/img/3.jpg', 0, 1000),
(38, 'Oppo Version', 8112, 1, '12/02/2019', 'Azul:Negro:Blanco:Rojo:', 'Yes', 0.05, 'modules/admin/module/tablets/view/img/9.jpg', 0, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'0',
  `token_check` varchar(255) NOT NULL,
  `token_recover` varchar(255) NOT NULL,
  `saldo` int(255) NOT NULL DEFAULT 100000,
  `register_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `type`, `avatar`, `active`, `token_check`, `token_recover`, `saldo`, `register_type`) VALUES
('107389958768449504522', 'andanivicente', 'Vicente', 'Andani', 'andanivicente@gmail.com', '', 'admin', 'https://lh3.googleusercontent.com/a-/AOh14GgGcGouCGpr-Eoa_EeLrGddmsRh9eWOdH956hKd', b'1', '', 'b769a03223f8e8265c63', 135175, 'google.com'),
('57725324', 'andanivicente', '', '', 'andanivicente@gmail.com', '', 'client', 'https://avatars2.githubusercontent.com/u/57725324?v=4', b'1', '', '3d67fb239756a8d98c32', 100000, 'github.com'),
('test', 'test', 'test', 'test', 'andanivicente@gmail.com', '$2y$10$imZ84uDDAu89OPct3juuReqeZTnDnomHZkiml3Z0c6W9r0D/JD./C', 'client', 'https://api.adorable.io/avatars/285/e995f7903051893f9a0f992d8542f3eb', b'1', '5ced673a747be4273d77', '1ac4bf6d7d4d2f27ba6d', 100000, 'local'),
('test2', 'test2', 'test', 'test', 'test@test.com', '$2y$10$UHGvQPgaw2wqLaXY1N94GuAgdfmYm1VU864E2FfIwnfQRn/gq99c2', 'client', 'https://www.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=40&d=identicon', b'0', '54bc570913869b4733bc', 'c0448c84d87d3dc25eec', 100000, 'local');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`idbrand`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idfactura`);

--
-- Indices de la tabla `factura_linea`
--
ALTER TABLE `factura_linea`
  ADD PRIMARY KEY (`idlinea`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idproduct`);

--
-- Indices de la tabla `money_codes`
--
ALTER TABLE `money_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tablets`
--
ALTER TABLE `tablets`
  ADD PRIMARY KEY (`idproduct`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `idbrand` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idfactura` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura_linea`
--
ALTER TABLE `factura_linea`
  MODIFY `idlinea` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `money_codes`
--
ALTER TABLE `money_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tablets`
--
ALTER TABLE `tablets`
  MODIFY `idproduct` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
