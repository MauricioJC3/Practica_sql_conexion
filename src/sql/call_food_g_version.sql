-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2024 a las 03:15:01
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
(1, 'Andres Mauricio', 'Jiemenez Chavez', 'CR 103 #17-03', '3116323973', 'a.mauriciojc03@gmail.com', '123456789', 'Masculino', '2003-10-03', '2024-03-30 00:39:54'),
(2, 'esteban ', 'jose mario', 'carrera 104 #44-22', '311633625', 'marcos23@ejemplo.com', '123456789', 'Masculino', '1999-10-03', '2024-03-30 00:41:19'),
(3, 'Juan', 'Pérez', 'Calle 123', '123456789', 'juan@example.com', 'password123', 'Masculino', '1990-05-15', '2024-03-31 23:17:11'),
(4, 'María', 'Gómez', 'Avenida 456', '987654321', 'maria@example.com', 'abcd9876', 'Femenino', '1985-09-20', '2024-03-31 23:17:11'),
(5, 'Carlos', 'López', 'Carrera 789', '456123789', 'carlos@example.com', 'qwerty123', 'Masculino', '1992-03-10', '2024-03-31 23:17:11'),
(6, 'Ana', 'Martínez', 'Calle 456', '369258147', 'ana@example.com', 'abcd1234', 'Femenino', '1988-11-28', '2024-03-31 23:17:11'),
(7, 'Pedro', 'Rodríguez', 'Avenida 789', '258147369', 'pedro@example.com', 'password456', 'Masculino', '1994-07-05', '2024-03-31 23:17:11'),
(8, 'Laura', 'Hernández', 'Calle 789', '741852963', 'laura@example.com', 'abcd5678', 'Femenino', '1991-02-18', '2024-03-31 23:17:11'),
(9, 'Manuel', 'García', 'Carrera 123', '852369741', 'manuel@example.com', 'password789', 'Masculino', '1987-06-30', '2024-03-31 23:17:11'),
(10, 'Luisa', 'Díaz', 'Avenida 123', '963147258', 'luisa@example.com', 'abcd7890', 'Femenino', '1993-08-12', '2024-03-31 23:17:11'),
(11, 'Javier', 'Fernández', 'Carrera 456', '147852369', 'javier@example.com', 'passwordABC', 'Masculino', '1986-04-25', '2024-03-31 23:17:11'),
(12, 'Sofía', 'López', 'Avenida 456', '369147258', 'sofia@example.com', 'abcd12345', 'Femenino', '1990-10-08', '2024-03-31 23:17:11');

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
(123456789, 'camilos sas', 'ruta/a/la/foto.jpg', 'Dirección de tu MyPIME', '3208181190', 'correo@tumypime.com', 'camilos', '12345678910', '2024-03-29 16:07:47'),
(987654321, 'pelo bueno', 'ruta/a/la/foto1.jpg', 'Dir 34 #43', '31244454590', 'peluueno@tumypime.com', 'pelito', '12345678910', '2024-03-29 16:07:47');

--
-- Disparadores `tbl_mypimes`
--
DELIMITER $$
CREATE TRIGGER `trg_delete_mypime` AFTER DELETE ON `tbl_mypimes` FOR EACH ROW BEGIN
    INSERT INTO tbl_mypimes_eliminadas (nit_mypime, name_mypime, address_mypime, email_mypime, fecha_hora_borrado)
    VALUES (OLD.nit_mypime, OLD.name_mypime, OLD.address_mypime, OLD.email_mypime, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mypimes_eliminadas`
--

CREATE TABLE `tbl_mypimes_eliminadas` (
  `nit_mypime` int(11) NOT NULL,
  `name_mypime` varchar(255) NOT NULL,
  `address_mypime` varchar(255) NOT NULL,
  `email_mypime` varchar(255) NOT NULL,
  `fecha_hora_borrado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(10, 1, 'Andres Mauricio Jiemenez Chavez', '3116323973', 'a.mauriciojc03@gmail.com', 'metodo_pago', 'CARRERA 104 #23A', 2, 15000.00, '2024-03-30 17:23:42', 'completado', 2, 'lipertus, carpiol'),
(11, 2, 'esteban  jose mario', '311633625', 'marcos23@ejemplo.com', 'metodo_pago', 'carrera 12-22b', 5, 170000.00, '2024-03-30 17:50:55', 'completado', 4, 'polinomio, calamardo p, lipertus'),
(12, 2, 'esteban  jose mario', '311633625', 'marcos23@ejemplo.com', 'metodo_pago', 'cacadsadsa', 3, 40000.00, '2024-03-30 19:13:52', 'completado', 1, 'carpiol, calamardo p'),
(13, 2, 'esteban  jose mario', '311633625', 'marcos23@ejemplo.com', 'metodo_pago', 'carrera 33-20a', 1, 8000.00, '2024-03-30 22:47:29', 'pendiente', 5, 'hamburguesa');

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
(9, 10, 2, 10000.00, 1),
(10, 10, 1, 5000.00, 1),
(11, 11, 4, 50000.00, 2),
(12, 11, 3, 30000.00, 2),
(13, 11, 2, 10000.00, 1),
(14, 12, 1, 5000.00, 2),
(15, 12, 3, 30000.00, 1),
(16, 13, 5, 8000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos_eliminados`
--

CREATE TABLE `tbl_productos_eliminados` (
  `id_producto` int(11) NOT NULL,
  `nit_mypime` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `nombre_mypime` varchar(255) NOT NULL,
  `precio` decimal(20,2) NOT NULL,
  `fecha_hora_borrado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 987654321, 'carpiol', 5000.00, 'sea muy bueno', 'disponible', NULL),
(2, 123456789, 'lipertus', 10000.00, 'es para la gripe', 'disponible', 'slam.jpg'),
(3, 123456789, 'calamardo p', 30000.00, 'bob porque lo hiciste r', 'disponible', 'berserk.png'),
(4, 987654321, 'polinomio', 50000.00, 'polinomio perfecto al cuadrado', 'disponible', NULL),
(5, 123456789, 'hamburguesa', 8000.00, 'hamburguesa con salsas de francia', 'disponible', 'o_no_viejo.png'),
(6, 123456789, 'maconco', 30000.00, 'si a bueno', 'disponible', 'code.jpg'),
(9, 123456789, 'afinaito', 1000000.00, 'champeta criolla', 'disponible', 'initial.jpg');

--
-- Disparadores `tbl_products`
--
DELIMITER $$
CREATE TRIGGER `trg_delete_producto` AFTER DELETE ON `tbl_products` FOR EACH ROW BEGIN
    INSERT INTO tbl_productos_eliminados (id_producto, nit_mypime, nombre_producto, nombre_mypime, precio, fecha_hora_borrado)
    VALUES (OLD.id_product, OLD.id_mypime, OLD.nombre_product, (SELECT name_mypime FROM tbl_mypimes WHERE nit_mypime = OLD.id_mypime), OLD.price_product, NOW());
END
$$
DELIMITER ;

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
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `usuario`, `password`, `correo`) VALUES
(1, 'Mauricio', '12345678911', 'Mauricio0323@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id_cart`);

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
  ADD PRIMARY KEY (`id_order`);

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
  ADD PRIMARY KEY (`id_product`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `fk_order_detail_order` FOREIGN KEY (`id_order`) REFERENCES `tbl_orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_detail_product` FOREIGN KEY (`id_product`) REFERENCES `tbl_products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
