-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2024 a las 04:14:56
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
-- Base de datos: `call_food_g`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id_cart` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_products` varchar(255) NOT NULL,
  `price_product` decimal(20,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_cart`
--

INSERT INTO `tbl_cart` (`id_cart`, `user_id`, `name_products`, `price_product`, `quantity`, `image`) VALUES
(1, 2, 'malambito efectivo', 30000.00, 1, 'callfood.png'),
(2, 2, 'malambito efectivo', 30000.00, 1, 'callfood.png'),
(3, 2, 'malambito efectivo', 30000.00, 1, 'callfood.png'),
(4, 2, 'malambito efectivo', 30000.00, 1, 'callfood.png'),
(5, 2, 'malambito efectivo', 30000.00, 1, 'callfood.png'),
(6, 2, 'malambito efectivo', 30000.00, 1, 'callfood.png'),
(7, 2, 'malambito efectivo', 30000.00, 1, 'callfood.png'),
(8, 2, 'malambito efectivo', 30000.00, 1, 'callfood.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `user_id` int(11) NOT NULL,
  `nombre_cli` varchar(255) DEFAULT NULL,
  `apellidos_cli` varchar(255) DEFAULT NULL,
  `direccion_cli` varchar(255) DEFAULT NULL,
  `telefono_cli` varchar(12) DEFAULT NULL,
  `correo_cli` varchar(100) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `genero_cli` varchar(20) DEFAULT NULL,
  `fecha_nac_cli` date DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_cliente`
--

INSERT INTO `tbl_cliente` (`user_id`, `nombre_cli`, `apellidos_cli`, `direccion_cli`, `telefono_cli`, `correo_cli`, `contraseña`, `genero_cli`, `fecha_nac_cli`, `fecha_registro`) VALUES
(1, 'mauro andres', 'jimenez chavez', 'carrera 44-23u', '31224565', 'mauro33@gmail.com', '12345678911', 'Masculino', '2003-10-03', '2024-05-09 06:49:51'),
(2, 'Adres maurico', 'jimenez chaves', 'Carrea 103-23', '31162621', 'andresMjaim@gmail.com', '123456789', 'Masculino', '2003-10-03', '2024-05-06 08:19:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_message`
--

CREATE TABLE `tbl_message` (
  `id_message` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name_user` varchar(255) DEFAULT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  `number_user` varchar(255) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mypimes`
--

CREATE TABLE `tbl_mypimes` (
  `nit_mypime` int(11) NOT NULL,
  `name_mypime` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `address_mypime` varchar(255) NOT NULL,
  `phone_mypime` varchar(20) NOT NULL,
  `email_mypime` varchar(255) NOT NULL,
  `user_mypime` varchar(50) DEFAULT NULL,
  `password_mypime` varchar(255) NOT NULL,
  `fecha_registro_mypime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_mypimes`
--

INSERT INTO `tbl_mypimes` (`nit_mypime`, `name_mypime`, `photo`, `address_mypime`, `phone_mypime`, `email_mypime`, `user_mypime`, `password_mypime`, `fecha_registro_mypime`) VALUES
(1, 'camaron', 'cara.png', 'carrera 103-23', '312112123', 'camaron23@gmail.com', 'camaron', '12345678910', '2024-05-06 03:29:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id_order` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `number_user` varchar(12) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `method` varchar(60) NOT NULL,
  `address_user` varchar(255) NOT NULL,
  `total_products` int(11) NOT NULL,
  `total_price` decimal(20,2) NOT NULL,
  `placed_on` varchar(60) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pendiente',
  `id_product` int(11) NOT NULL,
  `product_names` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_orders`
--

INSERT INTO `tbl_orders` (`id_order`, `user_id`, `name_user`, `number_user`, `email_user`, `method`, `address_user`, `total_products`, `total_price`, `placed_on`, `status`, `id_product`, `product_names`) VALUES
(1, 1, 'mauro jimenez', '31224565', 'mauro33@gmail.com', 'metodo_pago', 'carrera 10434', 1, 30000.00, '2024-05-06 00:33:22', 'completado', 1, 'malambito efectivo'),
(2, 1, 'mauro jimenez', '31224565', 'mauro33@gmail.com', 'metodo_pago', 'fafasffa', 0, 0.00, '2024-05-06 04:25:43', 'pendiente', 1, ''),
(3, 1, 'mauro jimenez', '31224565', 'mauro33@gmail.com', 'metodo_pago', 'carambola', 3, 90000.00, '2024-05-06 04:30:18', 'pendiente', 0, 'malambito efectivo'),
(4, 1, 'mauro jimenez', '31224565', 'mauro33@gmail.com', 'metodo_pago', 'sijfikds', 3, 90000.00, '2024-05-06 04:39:23', 'pendiente', 0, 'malambito efectivo'),
(5, 1, 'mauro jimenez', '31224565', 'mauro33@gmail.com', 'metodo_pago', 'sadsadvvvvv', 4, 120000.00, '2024-05-06 04:42:51', 'pendiente', 0, 'malambito efectivo'),
(6, 2, 'Adres maurico jimenez chaves', '31162621', 'andresMjaim@gmail.com', 'metodo_pago', 'Carrera 013-23', 2, 60000.00, '2024-05-06 05:20:16', 'pendiente', 1, 'malambito efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `id_order_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `united_price` decimal(20,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`id_order_detail`, `id_order`, `id_product`, `united_price`, `quantity`) VALUES
(1, 1, 1, 30000.00, 1),
(2, 3, 1, 30000.00, 3),
(3, 4, 1, 30000.00, 3),
(4, 5, 1, 30000.00, 4),
(5, 6, 1, 30000.00, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id_product` int(11) NOT NULL,
  `id_mypime` int(11) NOT NULL,
  `nombre_product` varchar(255) NOT NULL,
  `price_product` decimal(20,2) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'disponible',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_products`
--

INSERT INTO `tbl_products` (`id_product`, `id_mypime`, `nombre_product`, `price_product`, `description`, `status`, `image`) VALUES
(1, 1, 'malambito efectivo', 30000.00, 'camaron que se duerme se lo lleva la corriente', 'disponible', 'callfood.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `fk_cart_user` (`user_id`);

--
-- Indices de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`id_message`);

--
-- Indices de la tabla `tbl_mypimes`
--
ALTER TABLE `tbl_mypimes`
  ADD PRIMARY KEY (`nit_mypime`);

--
-- Indices de la tabla `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Indices de la tabla `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`id_order_detail`),
  ADD KEY `fk_order_detail_order` (`id_order`),
  ADD KEY `fk_order_detail_product` (`id_product`);

--
-- Indices de la tabla `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `fk_product_mypime` (`id_mypime`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_mypimes`
--
ALTER TABLE `tbl_mypimes`
  MODIFY `nit_mypime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_cliente` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_cliente` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `fk_order_detail_order` FOREIGN KEY (`id_order`) REFERENCES `tbl_orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_detail_product` FOREIGN KEY (`id_product`) REFERENCES `tbl_products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `fk_product_mypime` FOREIGN KEY (`id_mypime`) REFERENCES `tbl_mypimes` (`nit_mypime`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
