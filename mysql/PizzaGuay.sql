-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pizzaguay
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bebidas`
--

DROP TABLE IF EXISTS `bebidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bebidas` (
  `ID_Bebida` int(30) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL,
  `Precio` double NOT NULL,
  `Image` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Bebida`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bebidas`
--

LOCK TABLES `bebidas` WRITE;
/*!40000 ALTER TABLE `bebidas` DISABLE KEYS */;
INSERT INTO `bebidas` VALUES (1,'Pepsi',2.3,'images/bebidas/pepsi.jpg'),(2,'Nestea',2.3,'images/bebidas/nestea.jpg'),(3,'Agua',1.25,'images/bebidas/agua.jpg');
/*!40000 ALTER TABLE `bebidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domicilios`
--

DROP TABLE IF EXISTS `domicilios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domicilios` (
  `ID_Domicilio` int(11) NOT NULL AUTO_INCREMENT,
  `Calle` varchar(30) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
  `Piso` varchar(30) NOT NULL,
  `CodigoPostal` int(11) NOT NULL,
  PRIMARY KEY (`ID_Domicilio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domicilios`
--

LOCK TABLES `domicilios` WRITE;
/*!40000 ALTER TABLE `domicilios` DISABLE KEYS */;
INSERT INTO `domicilios` VALUES (1,'Guzman el Bueno','Madrid','8 Izquierda',28015),(2,'Cristo Rey','Madrid','5, puerta 401',28040);
/*!40000 ALTER TABLE `domicilios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foro`
--

DROP TABLE IF EXISTS `foro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foro` (
  `ID_Comentario` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Usuario` varchar(30) NOT NULL,
  `Puntuacion` int(11) NOT NULL,
  `Comentario` varchar(50) NOT NULL,
  `Fecha` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Comentario`),
  KEY `ID_Usuario` (`ID_Usuario`),
  CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`Correo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foro`
--

LOCK TABLES `foro` WRITE;
/*!40000 ALTER TABLE `foro` DISABLE KEYS */;
INSERT INTO `foro` VALUES (1,'contactpizzaguay@gmail.com',5,'Maravilloso servicio','2022-02-15'),(2,'usuario@pizzaguay.com',5,'Qué rico estaba todo!','2022-02-22'),(3,'usuario@pizzaguay.com',2,'No me ha llegado la pizza a tiempo, un vergüenza','2022-02-26');
/*!40000 ALTER TABLE `foro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foro_respuestas`
--

DROP TABLE IF EXISTS `foro_respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foro_respuestas` (
  `ID_Respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Comentario` int(11) NOT NULL,
  `ID_Usuario` varchar(30) NOT NULL,
  `Respuesta` varchar(50) NOT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`ID_Respuesta`),
  KEY `ID_Comentario` (`ID_Comentario`),
  KEY `ID_Usuario` (`ID_Usuario`),
  CONSTRAINT `foro_respuestas_ibfk_1` FOREIGN KEY (`ID_Comentario`) REFERENCES `foro` (`ID_Comentario`) ON UPDATE CASCADE,
  CONSTRAINT `foro_respuestas_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`Correo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foro_respuestas`
--

LOCK TABLES `foro_respuestas` WRITE;
/*!40000 ALTER TABLE `foro_respuestas` DISABLE KEYS */;
INSERT INTO `foro_respuestas` VALUES (1,1,'usuario@pizzaguay.com','Opino lo mismo','2022-03-01'),(2,1,'contactpizzaguay@gmail.com','Pues yo no','2022-03-02'),(3,2,'contactpizzaguay@gmail.com','No tienes ni idea de pizzas','2022-03-16');
/*!40000 ALTER TABLE `foro_respuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredientes` (
  `ID_Ingrediente` int(30) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL,
  `Precio` double NOT NULL,
  `Image` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Ingrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredientes`
--

LOCK TABLES `ingredientes` WRITE;
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;
INSERT INTO `ingredientes` VALUES (1,'Cebolla',1.99,'images/ingredientes/onion.jpg'),(2,'Queso',0.99,'images/ingredientes/queso.jpg'),(3,'Barbacoa',0.99,'images/ingredientes/bbq.jpg'),(4,'Carne de cerdo',2.99,'images/ingredientes/cerdo.jpg'),(5,'Pimientos',1.59,'images/ingredientes/pim.jpg');
/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `masas`
--

DROP TABLE IF EXISTS `masas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `masas` (
  `ID_Masa` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Masa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `masas`
--

LOCK TABLES `masas` WRITE;
/*!40000 ALTER TABLE `masas` DISABLE KEYS */;
INSERT INTO `masas` VALUES (1,'Fina'),(2,'Normal'),(3,'Gorda');
/*!40000 ALTER TABLE `masas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ofertas` (
  `ID_Oferta` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(30) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Descuento` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Oferta`),
  KEY `Tipo` (`Tipo`),
  CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`Tipo`) REFERENCES `ofertas_tipos` (`ID_TipoOferta`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofertas`
--

LOCK TABLES `ofertas` WRITE;
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
INSERT INTO `ofertas` VALUES (1,'DESCUENTO5',1,'5'),(2,'BLACKFRIDAY',2,'20'),(3,'HOLA2022',1,'8'),(4,'0',3,'0');
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ofertas_tipos`
--

DROP TABLE IF EXISTS `ofertas_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ofertas_tipos` (
  `ID_TipoOferta` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_TipoOferta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofertas_tipos`
--

LOCK TABLES `ofertas_tipos` WRITE;
/*!40000 ALTER TABLE `ofertas_tipos` DISABLE KEYS */;
INSERT INTO `ofertas_tipos` VALUES (1,'Cantidad'),(2,'Porcentaje'),(3,'SinOferta');
/*!40000 ALTER TABLE `ofertas_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(30) NOT NULL,
  `Oferta` int(30) NOT NULL,
  `Fecha` date NOT NULL,
  `Estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_Pedido`),
  KEY `Usuario` (`Usuario`),
  KEY `Oferta` (`Oferta`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`Correo`) ON UPDATE CASCADE,
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`Oferta`) REFERENCES `ofertas` (`ID_Oferta`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'usuario@pizzaguay.com',4,'2022-03-24',1),(2,'usuario@pizzaguay.com',4,'2022-03-09',0);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_bebidas`
--

DROP TABLE IF EXISTS `pedidos_bebidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos_bebidas` (
  `ID_BebidaPedida` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Bebida` int(11) NOT NULL,
  PRIMARY KEY (`ID_BebidaPedida`),
  KEY `ID_Pedido` (`ID_Pedido`),
  KEY `ID_Bebida` (`ID_Bebida`),
  CONSTRAINT `pedidos_bebidas_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedido`) ON UPDATE CASCADE,
  CONSTRAINT `pedidos_bebidas_ibfk_2` FOREIGN KEY (`ID_Bebida`) REFERENCES `bebidas` (`ID_Bebida`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_bebidas`
--

LOCK TABLES `pedidos_bebidas` WRITE;
/*!40000 ALTER TABLE `pedidos_bebidas` DISABLE KEYS */;
INSERT INTO `pedidos_bebidas` VALUES (1,1,1),(2,1,2),(3,1,3);
/*!40000 ALTER TABLE `pedidos_bebidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_pizzas`
--

DROP TABLE IF EXISTS `pedidos_pizzas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos_pizzas` (
  `ID_PizzaPedida` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Pizza` int(11) NOT NULL,
  `ID_Masa` int(11) NOT NULL,
  `ID_Tamaño` int(11) NOT NULL,
  PRIMARY KEY (`ID_PizzaPedida`),
  KEY `ID_Pedido` (`ID_Pedido`),
  KEY `ID_Pizza` (`ID_Pizza`),
  KEY `ID_Masa` (`ID_Masa`),
  KEY `ID_Tamaño` (`ID_Tamaño`),
  CONSTRAINT `pedidos_pizzas_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedido`) ON UPDATE CASCADE,
  CONSTRAINT `pedidos_pizzas_ibfk_2` FOREIGN KEY (`ID_Pizza`) REFERENCES `pizzas` (`ID_Pizza`) ON UPDATE CASCADE,
  CONSTRAINT `pedidos_pizzas_ibfk_3` FOREIGN KEY (`ID_Masa`) REFERENCES `masas` (`ID_Masa`) ON UPDATE CASCADE,
  CONSTRAINT `pedidos_pizzas_ibfk_4` FOREIGN KEY (`ID_Tamaño`) REFERENCES `tamaños` (`ID_Tamaño`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_pizzas`
--

LOCK TABLES `pedidos_pizzas` WRITE;
/*!40000 ALTER TABLE `pedidos_pizzas` DISABLE KEYS */;
INSERT INTO `pedidos_pizzas` VALUES (1,1,1,1,3),(2,1,3,1,1);
/*!40000 ALTER TABLE `pedidos_pizzas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizza_ingredientes`
--

DROP TABLE IF EXISTS `pizza_ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pizza_ingredientes` (
  `ID_IngredientePizza` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PizzaPedida` int(11) NOT NULL,
  `ID_Ingrediente` int(11) NOT NULL,
  PRIMARY KEY (`ID_IngredientePizza`),
  KEY `ID_Pizza` (`ID_PizzaPedida`),
  KEY `ID_Ingrediente` (`ID_Ingrediente`),
  CONSTRAINT `pizza_ingredientes_ibfk_2` FOREIGN KEY (`ID_Ingrediente`) REFERENCES `ingredientes` (`ID_Ingrediente`) ON UPDATE CASCADE,
  CONSTRAINT `pizza_ingredientes_ibfk_3` FOREIGN KEY (`ID_PizzaPedida`) REFERENCES `pedidos_pizzas` (`ID_PizzaPedida`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizza_ingredientes`
--

LOCK TABLES `pizza_ingredientes` WRITE;
/*!40000 ALTER TABLE `pizza_ingredientes` DISABLE KEYS */;
INSERT INTO `pizza_ingredientes` VALUES (1,2,2),(2,2,3),(3,2,1);
/*!40000 ALTER TABLE `pizza_ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizzas`
--

DROP TABLE IF EXISTS `pizzas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pizzas` (
  `ID_Pizza` int(30) NOT NULL AUTO_INCREMENT,
  `Precio` double NOT NULL,
  `Personalizada` tinyint(1) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Image` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Pizza`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizzas`
--

LOCK TABLES `pizzas` WRITE;
/*!40000 ALTER TABLE `pizzas` DISABLE KEYS */;
INSERT INTO `pizzas` VALUES (1,8.99,0,'Barbacoa','images/pizzas/bbq.jpg'),(2,8.99,0,'Carbonara','images/pizzas/carb.jpg'),(3,4.99,1,'Personalizada','images/pizzas/pers.jpg');
/*!40000 ALTER TABLE `pizzas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tamaños`
--

DROP TABLE IF EXISTS `tamaños`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tamaños` (
  `ID_Tamaño` int(11) NOT NULL AUTO_INCREMENT,
  `Tamaño` varchar(30) NOT NULL,
  `Precio` double NOT NULL,
  PRIMARY KEY (`ID_Tamaño`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tamaños`
--

LOCK TABLES `tamaños` WRITE;
/*!40000 ALTER TABLE `tamaños` DISABLE KEYS */;
INSERT INTO `tamaños` VALUES (1,'Normal',0),(2,'Grande',2.99),(3,'Familiar',4.99);
/*!40000 ALTER TABLE `tamaños` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `Correo` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `Contraseña` varchar(30) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Domicilio` int(30) NOT NULL,
  PRIMARY KEY (`Correo`),
  KEY `Domicilio` (`Domicilio`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Domicilio`) REFERENCES `domicilios` (`ID_Domicilio`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('contactpizzaguay@gmail.com','Usuario','Admin','1234',1,2),('usuario@pizzaguay.com','Usuario','Prueba','1234',0,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-06 13:42:36
