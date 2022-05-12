-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: vm15.db.swarm.test
-- Tiempo de generación: 12-05-2022 a las 21:04:35
-- Versión del servidor: 10.8.2-MariaDB-1:10.8.2+maria~focal
-- Versión de PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzaguayfinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidas`
--

CREATE TABLE `bebidas` (
  `ID_Bebida` int(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Precio` double NOT NULL,
  `Imagen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Editado` tinyint(1) NOT NULL DEFAULT 0,
  `Respuestas` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Editado` tinyint(1) NOT NULL DEFAULT 0
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masas`
--

CREATE TABLE `masas` (
  `ID_Masa` int(11) NOT NULL,
  `Tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `ID_Oferta` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Descuento` varchar(30) NOT NULL,
  `Info` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas_tipos`
--

CREATE TABLE `ofertas_tipos` (
  `ID_TipoOferta` int(11) NOT NULL,
  `Tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ID_Pedido` int(11) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Oferta` int(30) NOT NULL,
  `Fecha` date NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT 0,
  `FechaC` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_bebidas`
--

CREATE TABLE `pedidos_bebidas` (
  `ID_BebidaPedida` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Bebida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pizzas`
--

CREATE TABLE `pizzas` (
  `ID_Pizza` int(30) NOT NULL,
  `Precio` double NOT NULL,
  `Personalizada` tinyint(1) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Imagen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pizza_ingredientes`
--

CREATE TABLE `pizza_ingredientes` (
  `ID_IngredientePizza` int(11) NOT NULL,
  `ID_PizzaPedida` int(11) NOT NULL,
  `ID_Ingrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamaños`
--

CREATE TABLE `tamaños` (
  `ID_Tamaño` int(11) NOT NULL,
  `Tamaño` varchar(30) NOT NULL,
  `Precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `ID_Bebida` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `domicilios`
--
ALTER TABLE `domicilios`
  MODIFY `ID_Domicilio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `ID_Comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro_respuestas`
--
ALTER TABLE `foro_respuestas`
  MODIFY `ID_Respuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `ID_Ingrediente` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `masas`
--
ALTER TABLE `masas`
  MODIFY `ID_Masa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `ID_Oferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas_tipos`
--
ALTER TABLE `ofertas_tipos`
  MODIFY `ID_TipoOferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos_bebidas`
--
ALTER TABLE `pedidos_bebidas`
  MODIFY `ID_BebidaPedida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos_pizzas`
--
ALTER TABLE `pedidos_pizzas`
  MODIFY `ID_PizzaPedida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `ID_Pizza` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pizza_ingredientes`
--
ALTER TABLE `pizza_ingredientes`
  MODIFY `ID_IngredientePizza` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tamaños`
--
ALTER TABLE `tamaños`
  MODIFY `ID_Tamaño` int(11) NOT NULL AUTO_INCREMENT;

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
