-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2022 a las 20:24:42
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzaguay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidas`
--

CREATE TABLE `bebidas` (
  `ID_Bebida` int(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Precio` double NOT NULL,
  `Image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bebidas`
--

INSERT INTO `bebidas` (`ID_Bebida`, `Nombre`, `Precio`, `Image`) VALUES
(1, 'Pepsi', 2.3, 'images/bebidas/pepsi.jpg'),
(2, 'Nestea', 2.3, 'images/bebidas/nestea.jpg'),
(3, 'Agua', 1.25, 'images/bebidas/agua.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilios`
--

CREATE TABLE `domicilios` (
  `ID_Domicilio` int(11) NOT NULL,
  `Calle` varchar(30) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
  `Piso` varchar(30) NOT NULL,
  `CodigoPostal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `domicilios`
--

INSERT INTO `domicilios` (`ID_Domicilio`, `Calle`, `Ciudad`, `Piso`, `CodigoPostal`) VALUES
(1, 'c/Sofia 5', 'Madrid', '4', 28022),
(2, 'Cristo Rey', 'Madrid', '5, puerta 401', 28040),
(6, 'c/Albania', 'Madrid', '1', 28022),
(7, 'c/Sofia 5', 'Madrid', '3', 28022),
(8, 'c/Sofia 5', 'Madrid', '3', 28022),
(9, '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `ID_Comentario` int(11) NOT NULL,
  `ID_Usuario` varchar(30) NOT NULL,
  `Puntuacion` int(11) NOT NULL,
  `Comentario` varchar(255) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `Editado` tinyint(1) NOT NULL,
  `Respuestas` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`ID_Comentario`, `ID_Usuario`, `Puntuacion`, `Comentario`, `Fecha`, `Editado`, `Respuestas`) VALUES
(42, 'contactpizzaguay@gmail.com', 5, 'Hola', '2022-05-02 20:22:56', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_respuestas`
--

CREATE TABLE `foro_respuestas` (
  `ID_Respuesta` int(11) NOT NULL,
  `ID_Comentario` int(11) NOT NULL,
  `ID_Usuario` varchar(30) NOT NULL,
  `Respuesta` varchar(255) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `Editado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `ID_Ingrediente` int(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Precio` double NOT NULL,
  `Image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`ID_Ingrediente`, `Nombre`, `Precio`, `Image`) VALUES
(1, 'Cebolla', 1.99, 'images/ingredientes/onion.jpg'),
(2, 'Queso', 0.99, 'images/ingredientes/queso.jpg'),
(3, 'Barbacoa', 0.99, 'images/ingredientes/bbq.jpg'),
(4, 'Carne de cerdo', 2.99, 'images/ingredientes/cerdo.jpg'),
(5, 'Pimientos', 1.59, 'images/ingredientes/pim.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masas`
--

CREATE TABLE `masas` (
  `ID_Masa` int(11) NOT NULL,
  `Tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `masas`
--

INSERT INTO `masas` (`ID_Masa`, `Tipo`) VALUES
(1, 'Fina'),
(2, 'Normal'),
(3, 'Gorda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `ID_Oferta` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Descuento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`ID_Oferta`, `Codigo`, `Tipo`, `Descuento`) VALUES
(1, 'DESCUENTO5', 1, '5'),
(2, 'BLACKFRIDAY', 2, '20'),
(3, 'HOLA2022', 1, '8'),
(4, '0', 3, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_tipos`
--

CREATE TABLE `ofertas_tipos` (
  `ID_TipoOferta` int(11) NOT NULL,
  `Tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ofertas_tipos`
--

INSERT INTO `ofertas_tipos` (`ID_TipoOferta`, `Tipo`) VALUES
(1, 'Cantidad'),
(2, 'Porcentaje'),
(3, 'SinOferta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ID_Pedido` int(11) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Oferta` int(30) NOT NULL,
  `Fecha` date NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ID_Pedido`, `Usuario`, `Oferta`, `Fecha`, `Estado`) VALUES
(1, 'usuario@pizzaguay.com', 4, '2022-03-24', 1),
(2, 'usuario@pizzaguay.com', 4, '2022-03-09', 0),
(3, 'contactpizzaguay@gmail.com', 1, '0000-00-00', 1),
(4, 'jasaiz01@ucm.es', 1, '0000-00-00', 1),
(5, 'carrito@gmail.com', 1, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_bebidas`
--

CREATE TABLE `pedidos_bebidas` (
  `ID_BebidaPedida` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Bebida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos_bebidas`
--

INSERT INTO `pedidos_bebidas` (`ID_BebidaPedida`, `ID_Pedido`, `ID_Bebida`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 3, 2),
(5, 4, 2),
(6, 5, 1),
(7, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_pizzas`
--

CREATE TABLE `pedidos_pizzas` (
  `ID_PizzaPedida` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Pizza` int(11) NOT NULL,
  `ID_Masa` int(11) NOT NULL,
  `ID_Tamaño` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos_pizzas`
--

INSERT INTO `pedidos_pizzas` (`ID_PizzaPedida`, `ID_Pedido`, `ID_Pizza`, `ID_Masa`, `ID_Tamaño`) VALUES
(1, 1, 1, 1, 3),
(2, 1, 3, 1, 1),
(3, 3, 1, 1, 1),
(4, 4, 2, 1, 1),
(5, 5, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pizzas`
--

CREATE TABLE `pizzas` (
  `ID_Pizza` int(30) NOT NULL,
  `Precio` double NOT NULL,
  `Personalizada` tinyint(1) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pizzas`
--

INSERT INTO `pizzas` (`ID_Pizza`, `Precio`, `Personalizada`, `Nombre`, `Image`) VALUES
(1, 8.99, 0, 'Barbacoa', 'images/pizzas/bbq.jpg'),
(2, 8.99, 0, 'Carbonara', 'images/pizzas/carb.jpg'),
(3, 4.99, 1, 'Personalizada', 'images/pizzas/pers.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pizza_ingredientes`
--

CREATE TABLE `pizza_ingredientes` (
  `ID_IngredientePizza` int(11) NOT NULL,
  `ID_PizzaPedida` int(11) NOT NULL,
  `ID_Ingrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pizza_ingredientes`
--

INSERT INTO `pizza_ingredientes` (`ID_IngredientePizza`, `ID_PizzaPedida`, `ID_Ingrediente`) VALUES
(1, 2, 2),
(2, 2, 3),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamaños`
--

CREATE TABLE `tamaños` (
  `ID_Tamaño` int(11) NOT NULL,
  `Tamaño` varchar(30) NOT NULL,
  `Precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tamaños`
--

INSERT INTO `tamaños` (`ID_Tamaño`, `Tamaño`, `Precio`) VALUES
(1, 'Normal', 0),
(2, 'Grande', 2.99),
(3, 'Familiar', 4.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Correo` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Domicilio` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Correo`, `Nombre`, `Apellidos`, `Contraseña`, `Admin`, `Domicilio`) VALUES
('carrito@gmail.com', 'Javier', 'Saiz', '$2y$10$Sxb65Jvy5uNy7/Uk6oQkie7hOVscQG6ReVPHLjBthivlPlcOO3vbe', 0, 7),
('contactpizzaguay@gmail.com', 'Usuario', 'Admin', '$2y$10$UM7xU.flgSqjK0/.wdXOoONVTOgK/vslIUTWLtxrGj9gQkWXD1s6G', 1, 2),
('jasaiz01@ucm.es', 'Javier', 'Saiz', '$2y$10$pWwpT/iwhXpFI1yc6FJviuuAFAHH2bwRfNkiejUXVUEK7AaRfC81C', 0, 6),
('prueba@gmail.com', 'Prueba', 'Prueba', '$2y$10$.zSJL8dRVnA4BypCHP4RqudA/3xzLHL/Kr2FKZGaLE7uNBLtDVi.y', 0, 7),
('usuario@pizzaguay.com', 'Usuario', 'Prueba', '$2y$10$Ts8HWmUXPLUOmpuyRzhXbeQwniEIwpBmtkuq.7NXYv9gGbvJO/r.O', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`ID_Bebida`);

--
-- Indices de la tabla `domicilios`
--
ALTER TABLE `domicilios`
  ADD PRIMARY KEY (`ID_Domicilio`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`ID_Comentario`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `foro_respuestas`
--
ALTER TABLE `foro_respuestas`
  ADD PRIMARY KEY (`ID_Respuesta`),
  ADD KEY `ID_Comentario` (`ID_Comentario`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`ID_Ingrediente`);

--
-- Indices de la tabla `masas`
--
ALTER TABLE `masas`
  ADD PRIMARY KEY (`ID_Masa`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`ID_Oferta`),
  ADD KEY `Tipo` (`Tipo`);

--
-- Indices de la tabla `ofertas_tipos`
--
ALTER TABLE `ofertas_tipos`
  ADD PRIMARY KEY (`ID_TipoOferta`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `Usuario` (`Usuario`),
  ADD KEY `Oferta` (`Oferta`);

--
-- Indices de la tabla `pedidos_bebidas`
--
ALTER TABLE `pedidos_bebidas`
  ADD PRIMARY KEY (`ID_BebidaPedida`),
  ADD KEY `ID_Pedido` (`ID_Pedido`),
  ADD KEY `ID_Bebida` (`ID_Bebida`);

--
-- Indices de la tabla `pedidos_pizzas`
--
ALTER TABLE `pedidos_pizzas`
  ADD PRIMARY KEY (`ID_PizzaPedida`),
  ADD KEY `ID_Pedido` (`ID_Pedido`),
  ADD KEY `ID_Pizza` (`ID_Pizza`),
  ADD KEY `ID_Masa` (`ID_Masa`),
  ADD KEY `ID_Tamaño` (`ID_Tamaño`);

--
-- Indices de la tabla `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`ID_Pizza`);

--
-- Indices de la tabla `pizza_ingredientes`
--
ALTER TABLE `pizza_ingredientes`
  ADD PRIMARY KEY (`ID_IngredientePizza`),
  ADD KEY `ID_Pizza` (`ID_PizzaPedida`),
  ADD KEY `ID_Ingrediente` (`ID_Ingrediente`);

--
-- Indices de la tabla `tamaños`
--
ALTER TABLE `tamaños`
  ADD PRIMARY KEY (`ID_Tamaño`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Correo`),
  ADD KEY `Domicilio` (`Domicilio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `ID_Bebida` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `domicilios`
--
ALTER TABLE `domicilios`
  MODIFY `ID_Domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `ID_Comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `foro_respuestas`
--
ALTER TABLE `foro_respuestas`
  MODIFY `ID_Respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `ID_Ingrediente` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `masas`
--
ALTER TABLE `masas`
  MODIFY `ID_Masa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `ID_Oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ofertas_tipos`
--
ALTER TABLE `ofertas_tipos`
  MODIFY `ID_TipoOferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos_bebidas`
--
ALTER TABLE `pedidos_bebidas`
  MODIFY `ID_BebidaPedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos_pizzas`
--
ALTER TABLE `pedidos_pizzas`
  MODIFY `ID_PizzaPedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `ID_Pizza` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pizza_ingredientes`
--
ALTER TABLE `pizza_ingredientes`
  MODIFY `ID_IngredientePizza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tamaños`
--
ALTER TABLE `tamaños`
  MODIFY `ID_Tamaño` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`Correo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro_respuestas`
--
ALTER TABLE `foro_respuestas`
  ADD CONSTRAINT `foro_respuestas_ibfk_1` FOREIGN KEY (`ID_Comentario`) REFERENCES `foro` (`ID_Comentario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_respuestas_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`Correo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`Tipo`) REFERENCES `ofertas_tipos` (`ID_TipoOferta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Correo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`Oferta`) REFERENCES `ofertas` (`ID_Oferta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos_bebidas`
--
ALTER TABLE `pedidos_bebidas`
  ADD CONSTRAINT `pedidos_bebidas_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_bebidas_ibfk_2` FOREIGN KEY (`ID_Bebida`) REFERENCES `bebidas` (`ID_Bebida`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos_pizzas`
--
ALTER TABLE `pedidos_pizzas`
  ADD CONSTRAINT `pedidos_pizzas_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_pizzas_ibfk_2` FOREIGN KEY (`ID_Pizza`) REFERENCES `pizzas` (`ID_Pizza`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_pizzas_ibfk_3` FOREIGN KEY (`ID_Masa`) REFERENCES `masas` (`ID_Masa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_pizzas_ibfk_4` FOREIGN KEY (`ID_Tamaño`) REFERENCES `tamaños` (`ID_Tamaño`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pizza_ingredientes`
--
ALTER TABLE `pizza_ingredientes`
  ADD CONSTRAINT `pizza_ingredientes_ibfk_2` FOREIGN KEY (`ID_Ingrediente`) REFERENCES `ingredientes` (`ID_Ingrediente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pizza_ingredientes_ibfk_3` FOREIGN KEY (`ID_PizzaPedida`) REFERENCES `pedidos_pizzas` (`ID_PizzaPedida`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Domicilio`) REFERENCES `domicilios` (`ID_Domicilio`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
