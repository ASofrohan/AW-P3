-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2022 a las 18:46:03
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizazguayprueba`
--

--
-- Volcado de datos para la tabla `bebidas`
--

INSERT INTO `bebidas` (`ID_Bebida`, `Nombre`, `Precio`, `Imagen`) VALUES
(1, 'Pepsi', 2.3, 'images/bebidas/pepsi.jpg'),
(2, 'Nestea', 2.3, 'images/bebidas/nestea.jpg'),
(3, 'Agua', 1.25, 'images/bebidas/agua.jpg');

--
-- Volcado de datos para la tabla `domicilios`
--

INSERT INTO `domicilios` (`ID_Domicilio`, `Calle`, `Ciudad`, `Piso`, `CodigoPostal`) VALUES
(1, 'c/Sofia 5', 'Madrid', '4', 28022),
(2, 'Cristo Rey', 'Madrid', '5, puerta 401', 28040);

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`ID_Comentario`, `ID_Usuario`, `Puntuacion`, `Comentario`, `Fecha`, `Editado`, `Respuestas`) VALUES
(42, 'contactpizzaguay@gmail.com', 5, 'Hola', '2022-05-02 20:22:56', 0, 1),
(43, 'contactpizzaguay@gmail.com', 3, 'Mensaje prueba 2', '2022-05-05 11:23:50', 0, 0);

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`ID_Ingrediente`, `Nombre`, `Precio`, `Image`) VALUES
(1, 'Cebolla', 1.99, 'images/ingredientes/onion.jpg'),
(2, 'Queso', 0.99, 'images/ingredientes/queso.jpg'),
(3, 'Barbacoa', 0.99, 'images/ingredientes/bbq.jpg'),
(4, 'Carne de cerdo', 2.99, 'images/ingredientes/cerdo.jpg'),
(5, 'Pimientos', 1.59, 'images/ingredientes/pim.jpg');

--
-- Volcado de datos para la tabla `masas`
--

INSERT INTO `masas` (`ID_Masa`, `Tipo`) VALUES
(1, 'Fina'),
(2, 'Normal'),
(3, 'Gorda');

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`ID_Oferta`, `Codigo`, `Tipo`, `Descuento`, `Info`) VALUES
(1, 'DESCUENTO5', 1, '5', '5€ de descuento en tu pedido'),
(2, 'BLACKFRIDAY', 2, '20', '20% de descuento en tu pedido'),
(3, 'HOLA2022', 1, '8', '8€ de descuento en tu pedido'),
(4, '0', 3, '0', 'Elimina cualquier oferta aplicada a tu pedido');

--
-- Volcado de datos para la tabla `ofertas_tipos`
--

INSERT INTO `ofertas_tipos` (`ID_TipoOferta`, `Tipo`) VALUES
(1, 'Cantidad'),
(2, 'Porcentaje'),
(3, 'SinOferta');

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ID_Pedido`, `Usuario`, `Oferta`, `Fecha`, `Estado`, `FechaC`) VALUES
(1, 'usuario@pizzaguay.com', 4, '2022-03-24', 0, '2022-05-09'),
(2, 'usuario@pizzaguay.com', 4, '2022-03-09', 0, '2022-05-09'),
(3, 'contactpizzaguay@gmail.com', 2, '0000-00-00', 1, '2022-05-09');

--
-- Volcado de datos para la tabla `pedidos_bebidas`
--

INSERT INTO `pedidos_bebidas` (`ID_BebidaPedida`, `ID_Pedido`, `ID_Bebida`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

--
-- Volcado de datos para la tabla `pedidos_pizzas`
--

INSERT INTO `pedidos_pizzas` (`ID_PizzaPedida`, `ID_Pedido`, `ID_Pizza`, `ID_Masa`, `ID_Tamaño`) VALUES
(1, 1, 1, 1, 3),
(2, 1, 3, 1, 1),
(3, 3, 1, 1, 1);

--
-- Volcado de datos para la tabla `pizzas`
--

INSERT INTO `pizzas` (`ID_Pizza`, `Precio`, `Personalizada`, `Nombre`, `Imagen`) VALUES
(1, 8.99, 0, 'Barbacoa', 'images/pizzas/bbq.jpg'),
(2, 8.99, 0, 'Carbonara', 'images/pizzas/carb.jpg'),
(3, 4.99, 1, 'Personalizada', 'images/pizzas/pers.jpg');

--
-- Volcado de datos para la tabla `pizza_ingredientes`
--

INSERT INTO `pizza_ingredientes` (`ID_IngredientePizza`, `ID_PizzaPedida`, `ID_Ingrediente`) VALUES
(1, 2, 2),
(2, 2, 3),
(3, 2, 1);

--
-- Volcado de datos para la tabla `tamaños`
--

INSERT INTO `tamaños` (`ID_Tamaño`, `Tamaño`, `Precio`) VALUES
(1, 'Normal', 0),
(2, 'Grande', 2.99),
(3, 'Familiar', 4.99);

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Correo`, `Nombre`, `Apellidos`, `Contraseña`, `Admin`, `Domicilio`) VALUES
('contactpizzaguay@gmail.com', 'Usuario', 'Admin', '$2y$10$UM7xU.flgSqjK0/.wdXOoONVTOgK/vslIUTWLtxrGj9gQkWXD1s6G', 1, 2),
('usuario@pizzaguay.com', 'Usuario', 'Prueba', '$2y$10$Ts8HWmUXPLUOmpuyRzhXbeQwniEIwpBmtkuq.7NXYv9gGbvJO/r.O', 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
