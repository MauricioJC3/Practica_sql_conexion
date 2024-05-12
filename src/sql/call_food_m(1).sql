-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2024 a las 17:16:03
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
-- Base de datos: `call_food_m`
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
  `image` varchar(255) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_cart`
--

INSERT INTO `tbl_cart` (`id_cart`, `user_id`, `name_products`, `price_product`, `quantity`, `image`, `id_product`) VALUES
(34, 4, 'pizza', 3000.00, 5, '../imagenes_productos/capas.png', 3);

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
(3, 'andres mauricio', 'jimenez chavez', 'Cr 103 #17-03  ALTAVISTA (EL GUAMO)', '3116323973', 'a.mauriciojc1003@gmail.com', '12345678910', 'Masculino', '2003-10-12', '2024-05-12 13:47:18'),
(4, 'esteban', 'medina osorio', 'Cr 103 #17-33  ALTAVISTA (EL GUAMO)', '3116323963', 'a.mauriciojc199@gmail.com', '12345678910', 'Masculino', '2003-10-03', '2024-05-12 14:18:29');

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
  `status` varchar(15) NOT NULL DEFAULT 'activo',
  `user_mypime` varchar(50) DEFAULT NULL,
  `password_mypime` varchar(255) NOT NULL,
  `fecha_registro_mypime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_mypimes`
--

INSERT INTO `tbl_mypimes` (`nit_mypime`, `name_mypime`, `photo`, `address_mypime`, `phone_mypime`, `email_mypime`, `status`, `user_mypime`, `password_mypime`, `fecha_registro_mypime`) VALUES
(105267724, 'caramaro', 'foto.jpg', 'carrera 103-23', '311828222', 'caramaro23@gmail.com', 'activo', 'caramaro', '1234567899', '2024-05-12 13:49:06'),
(1052666921, 'miuin', 'gato.jpg', 'carrea 103-23', '3116323973', 'miuin33@gmail.com', 'desactivado', 'miuin', '12345678910', '2024-05-12 14:30:25');

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
  `product_names` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_orders`
--

INSERT INTO `tbl_orders` (`id_order`, `user_id`, `name_user`, `number_user`, `email_user`, `method`, `address_user`, `total_products`, `total_price`, `placed_on`, `status`, `product_names`) VALUES
(19, 3, 'Mauro', '3116323973', 'a.mauriciojc03@gmail.com', 'cash on delivery', 'Cr 103 #17-03  ALTAVISTA (EL GUAMO)', 3, 9000.00, '12-May-2024', 'pendiente', 'pizza (3)'),
(20, 3, 'speedi', '3116323973', 'a.mauriciojc03@gmail.com', 'cash on delivery', 'Cr 103 #17-03  ALTAVISTA (EL GUAMO)', 5, 15000.00, '12-May-2024', 'completado', 'pizza (5)'),
(21, 3, 'Mauro', '3116323973', 'a.mauriciojc03@gmail.com', 'cash on delivery', 'Cr 103 #17-03  ALTAVISTA (EL GUAMO)', 9, 22000.00, '12-May-2024', 'pendiente', 'camaron (5), pizza (4)'),
(22, 4, 'esteban', '31163234321', 'a.mauriciojc199@gmail.com', 'paypal', 'Cr 103 #23-03  ALTAVISTA (EL GUAMO)', 4, 12000.00, '12-May-2024', 'pendiente', 'pizza (4)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `id_order_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `unit_price` decimal(20,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`id_order_detail`, `id_order`, `id_product`, `unit_price`, `quantity`) VALUES
(6, 20, 3, 3000.00, 5),
(7, 21, 4, 2000.00, 5),
(8, 21, 3, 3000.00, 4),
(9, 22, 3, 3000.00, 4);

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
(3, 105267724, 'pizza', 3000.00, 'nada', 'disponible', 'capas.png'),
(4, 1052666921, 'camaron', 2000.00, 'camaron del mar muerto', 'disponible', 'jachan.jpg');

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
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_mypimes`
--
ALTER TABLE `tbl_mypimes`
  MODIFY `nit_mypime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1052666922;

--
-- AUTO_INCREMENT de la tabla `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
