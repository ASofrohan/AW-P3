-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2022 at 10:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PizzaGuay`
--

-- --------------------------------------------------------

--
-- Table structure for table `bebidas`
--

CREATE TABLE `bebidas` (
  `ID_Bebida` int(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bebidas`
--

INSERT INTO `bebidas` (`ID_Bebida`, `Nombre`, `Precio`) VALUES
(1, 'Pepsi', 2.3),
(2, 'Nestea', 2.3),
(3, 'Agua', 1.25);

-- --------------------------------------------------------

--
-- Table structure for table `domicilios`
--

CREATE TABLE `domicilios` (
  `ID_Domicilio` int(11) NOT NULL,
  `Calle` varchar(30) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
  `Piso` varchar(30) NOT NULL,
  `CodigoPostal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `domicilios`
--

INSERT INTO `domicilios` (`ID_Domicilio`, `Calle`, `Ciudad`, `Piso`, `CodigoPostal`) VALUES
(1, 'Guzman el Bueno', 'Madrid', '8 Izquierda', 28015),
(2, 'Cristo Rey', 'Madrid', '5, puerta 401', 28040);

-- --------------------------------------------------------

--
-- Table structure for table `foro`
--

CREATE TABLE `foro` (
  `ID_Comentario` int(11) NOT NULL,
  `ID_Usuario` varchar(30) NOT NULL,
  `Puntuacion` int(11) NOT NULL,
  `Comentario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foro`
--

INSERT INTO `foro` (`ID_Comentario`, `ID_Usuario`, `Puntuacion`, `Comentario`) VALUES
(1, 'contactpizzaguay@gmail.com', 5, 'Maravilloso servicio'),
(2, 'usuario@pizzaguay.com', 5, 'Qué rico estaba todo!'),
(3, 'usuario@pizzaguay.com', 2, 'No me ha llegado la pizza a tiempo, un vergüenza');

-- --------------------------------------------------------

--
-- Table structure for table `ingredientes`
--

CREATE TABLE `ingredientes` (
  `ID_Ingrediente` int(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredientes`
--

INSERT INTO `ingredientes` (`ID_Ingrediente`, `Nombre`, `Precio`) VALUES
(1, 'Cebolla', 1.99),
(2, 'Queso', 0.99),
(3, 'Barbacoa', 0.99),
(4, 'Carne de cerdo', 2.99),
(5, 'Pimientos', 1.59);

-- --------------------------------------------------------

--
-- Table structure for table `masas`
--

CREATE TABLE `masas` (
  `ID_Masa` int(11) NOT NULL,
  `Tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masas`
--

INSERT INTO `masas` (`ID_Masa`, `Tipo`) VALUES
(1, 'Fina'),
(2, 'Normal'),
(3, 'Gorda');

-- --------------------------------------------------------

--
-- Table structure for table `ofertas`
--

CREATE TABLE `ofertas` (
  `ID_Oferta` int(11) NOT NULL,
  `Codigo` varchar(30) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Descuento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ofertas`
--

INSERT INTO `ofertas` (`ID_Oferta`, `Codigo`, `Tipo`, `Descuento`) VALUES
(1, 'DESCUENTO5', 1, '5'),
(2, 'BLACKFRIDAY', 2, '20'),
(3, 'HOLA2022', 1, '8'),
(4, '0', 3, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ofertas_tipos`
--

CREATE TABLE `ofertas_tipos` (
  `ID_TipoOferta` int(11) NOT NULL,
  `Tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ofertas_tipos`
--

INSERT INTO `ofertas_tipos` (`ID_TipoOferta`, `Tipo`) VALUES
(1, 'Cantidad'),
(2, 'Porcentaje'),
(3, 'SinOferta');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `ID_Pedido` int(11) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Oferta` int(30) NOT NULL,
  `Fecha` date NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`ID_Pedido`, `Usuario`, `Oferta`, `Fecha`, `Estado`) VALUES
(1, 'usuario@pizzaguay.com', 4, '2022-03-24', 1),
(2, 'usuario@pizzaguay.com', 4, '2022-03-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos_bebidas`
--

CREATE TABLE `pedidos_bebidas` (
  `ID_BebidaPedida` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Bebida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedidos_bebidas`
--

INSERT INTO `pedidos_bebidas` (`ID_BebidaPedida`, `ID_Pedido`, `ID_Bebida`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos_pizzas`
--

CREATE TABLE `pedidos_pizzas` (
  `ID_PizzaPedida` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Pizza` int(11) NOT NULL,
  `ID_Masa` int(11) NOT NULL,
  `ID_Tamaño` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedidos_pizzas`
--

INSERT INTO `pedidos_pizzas` (`ID_PizzaPedida`, `ID_Pedido`, `ID_Pizza`, `ID_Masa`, `ID_Tamaño`) VALUES
(1, 1, 1, 1, 3),
(2, 1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pizzas`
--

CREATE TABLE `pizzas` (
  `ID_Pizza` int(30) NOT NULL,
  `Precio` double NOT NULL,
  `Personalizada` tinyint(1) NOT NULL,
  `Nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizzas`
--

INSERT INTO `pizzas` (`ID_Pizza`, `Precio`, `Personalizada`, `Nombre`) VALUES
(1, 8.99, 0, 'Barbacoa'),
(2, 8.99, 0, 'Carbonara'),
(3, 4.99, 1, 'Personalizada');

-- --------------------------------------------------------

--
-- Table structure for table `pizza_ingredientes`
--

CREATE TABLE `pizza_ingredientes` (
  `ID_IngredientePizza` int(11) NOT NULL,
  `ID_PizzaPedida` int(11) NOT NULL,
  `ID_Ingrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizza_ingredientes`
--

INSERT INTO `pizza_ingredientes` (`ID_IngredientePizza`, `ID_PizzaPedida`, `ID_Ingrediente`) VALUES
(1, 2, 2),
(2, 2, 3),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tamaños`
--

CREATE TABLE `tamaños` (
  `ID_Tamaño` int(11) NOT NULL,
  `Tamaño` varchar(30) NOT NULL,
  `Precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tamaños`
--

INSERT INTO `tamaños` (`ID_Tamaño`, `Tamaño`, `Precio`) VALUES
(1, 'Normal', 0),
(2, 'Grande', 2.99),
(3, 'Familiar', 4.99);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `Correo` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `Contraseña` varchar(30) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Domicilio` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`Correo`, `Nombre`, `Apellidos`, `Contraseña`, `Admin`, `Domicilio`) VALUES
('contactpizzaguay@gmail.com', 'Usuario', 'Admin', '1234', 1, 2),
('usuario@pizzaguay.com', 'Usuario', 'Prueba', '1234', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`ID_Bebida`);

--
-- Indexes for table `domicilios`
--
ALTER TABLE `domicilios`
  ADD PRIMARY KEY (`ID_Domicilio`);

--
-- Indexes for table `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`ID_Comentario`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indexes for table `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`ID_Ingrediente`);

--
-- Indexes for table `masas`
--
ALTER TABLE `masas`
  ADD PRIMARY KEY (`ID_Masa`);

--
-- Indexes for table `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`ID_Oferta`),
  ADD KEY `Tipo` (`Tipo`);

--
-- Indexes for table `ofertas_tipos`
--
ALTER TABLE `ofertas_tipos`
  ADD PRIMARY KEY (`ID_TipoOferta`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `Usuario` (`Usuario`),
  ADD KEY `Oferta` (`Oferta`);

--
-- Indexes for table `pedidos_bebidas`
--
ALTER TABLE `pedidos_bebidas`
  ADD PRIMARY KEY (`ID_BebidaPedida`),
  ADD KEY `ID_Pedido` (`ID_Pedido`),
  ADD KEY `ID_Bebida` (`ID_Bebida`);

--
-- Indexes for table `pedidos_pizzas`
--
ALTER TABLE `pedidos_pizzas`
  ADD PRIMARY KEY (`ID_PizzaPedida`),
  ADD KEY `ID_Pedido` (`ID_Pedido`),
  ADD KEY `ID_Pizza` (`ID_Pizza`),
  ADD KEY `ID_Masa` (`ID_Masa`),
  ADD KEY `ID_Tamaño` (`ID_Tamaño`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`ID_Pizza`);

--
-- Indexes for table `pizza_ingredientes`
--
ALTER TABLE `pizza_ingredientes`
  ADD PRIMARY KEY (`ID_IngredientePizza`),
  ADD KEY `ID_Pizza` (`ID_PizzaPedida`),
  ADD KEY `ID_Ingrediente` (`ID_Ingrediente`);

--
-- Indexes for table `tamaños`
--
ALTER TABLE `tamaños`
  ADD PRIMARY KEY (`ID_Tamaño`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Correo`),
  ADD KEY `Domicilio` (`Domicilio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `ID_Bebida` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `domicilios`
--
ALTER TABLE `domicilios`
  MODIFY `ID_Domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `foro`
--
ALTER TABLE `foro`
  MODIFY `ID_Comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `ID_Ingrediente` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `masas`
--
ALTER TABLE `masas`
  MODIFY `ID_Masa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `ID_Oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ofertas_tipos`
--
ALTER TABLE `ofertas_tipos`
  MODIFY `ID_TipoOferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pedidos_bebidas`
--
ALTER TABLE `pedidos_bebidas`
  MODIFY `ID_BebidaPedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedidos_pizzas`
--
ALTER TABLE `pedidos_pizzas`
  MODIFY `ID_PizzaPedida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `ID_Pizza` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pizza_ingredientes`
--
ALTER TABLE `pizza_ingredientes`
  MODIFY `ID_IngredientePizza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tamaños`
--
ALTER TABLE `tamaños`
  MODIFY `ID_Tamaño` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`Correo`) ON UPDATE CASCADE;

--
-- Constraints for table `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`Tipo`) REFERENCES `ofertas_tipos` (`ID_TipoOferta`) ON UPDATE CASCADE;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Correo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`Oferta`) REFERENCES `ofertas` (`ID_Oferta`) ON UPDATE CASCADE;

--
-- Constraints for table `pedidos_bebidas`
--
ALTER TABLE `pedidos_bebidas`
  ADD CONSTRAINT `pedidos_bebidas_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_bebidas_ibfk_2` FOREIGN KEY (`ID_Bebida`) REFERENCES `bebidas` (`ID_Bebida`) ON UPDATE CASCADE;

--
-- Constraints for table `pedidos_pizzas`
--
ALTER TABLE `pedidos_pizzas`
  ADD CONSTRAINT `pedidos_pizzas_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_pizzas_ibfk_2` FOREIGN KEY (`ID_Pizza`) REFERENCES `pizzas` (`ID_Pizza`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_pizzas_ibfk_3` FOREIGN KEY (`ID_Masa`) REFERENCES `masas` (`ID_Masa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_pizzas_ibfk_4` FOREIGN KEY (`ID_Tamaño`) REFERENCES `tamaños` (`ID_Tamaño`) ON UPDATE CASCADE;

--
-- Constraints for table `pizza_ingredientes`
--
ALTER TABLE `pizza_ingredientes`
  ADD CONSTRAINT `pizza_ingredientes_ibfk_2` FOREIGN KEY (`ID_Ingrediente`) REFERENCES `ingredientes` (`ID_Ingrediente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pizza_ingredientes_ibfk_3` FOREIGN KEY (`ID_PizzaPedida`) REFERENCES `pedidos_pizzas` (`ID_PizzaPedida`) ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Domicilio`) REFERENCES `domicilios` (`ID_Domicilio`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
