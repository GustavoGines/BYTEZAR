-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: catalogo
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Dell XPS 13','Ultrabook con pantalla InfinityEdge de 13.4\", Intel i7, 16GB RAM, 512GB SSD.',1400.00,'Laptops','https://m.media-amazon.com/images/I/61kn7cyc46L._AC_SL1500_.jpg'),(2,'MacBook Air M2','Laptop Apple de 13.6\", chip M2, 8GB RAM, 256GB SSD.',1500.00,'Laptops','https://http2.mlstatic.com/D_NQ_NP_2X_829933-MLU77338402190_072024-F.webp'),(3,'iPhone 15','Smartphone Apple de 6.1\", A16 Bionic, cámara avanzada de 48 MP.',1200.00,'Smartphones','https://media.es.wired.com/photos/6509d9b5c3cae8b32bec9d69/16:9/w_2560%2Cc_limit/iPhone-15-Pro-Review-Top-Gear.jpeg'),(4,'Samsung Galaxy S24','Android 6.2\", Snapdragon 8 Gen 3, cámara triple de 50MP.',1100.00,'Smartphones','https://tiendaonline.movistar.com.ar/media/catalog/product/cache/1d01ed3f1ecf95fcf479279f9ae509ad/s/2/s24-ultra-256-titaniumblack-front_1_1.png'),(5,'Logitech MX Master 3S','Mouse inalámbrico de alta precisión para profesionales.',100.00,'Accesorios','https://mlx.com.ar/wp-content/uploads/2025/01/LOGITECH-MX-MASTER-3S-WIRELESS-GRAPHITE.webp'),(6,'Cargador Anker Nano II 65W','Cargador rápido USB-C compatible con laptops y móviles.',60.00,'Accesorios','https://i.ebayimg.com/images/g/7esAAeSwfFZoDANN/s-l1600.webp'),(7,'PlayStation 5','Consola Sony PS5, ultra alta velocidad de carga y gráficos inmersivos.',500.00,'Gaming','https://buenosairesimport.com/6494-large_default/playstation-5-slim-1-tb-digital.jpg'),(8,'Razer BlackShark V2','Auriculares gamer con sonido envolvente 7.1 para eSports.',120.00,'Gaming','https://static.nb.com.ar/img/e5d92864cfc942c29f4ec959eadb02bf.jpg');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-15 15:55:33
