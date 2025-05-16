-- SQLINES DEMO ***  Distrib 8.0.41, for Win64 (x86_64)
--
-- SQLINES DEMO ***   Database: catalogo
-- SQLINES DEMO *** -------------------------------------
-- SQLINES DEMO *** 1.0

/* SQLINES DEMO *** CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/* SQLINES DEMO *** CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/* SQLINES DEMO *** COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/* SQLINES DEMO ***  utf8 */;
/* SQLINES DEMO *** TIME_ZONE=@@TIME_ZONE */;
/* SQLINES DEMO *** ZONE='+00:00' */;
/* SQLINES DEMO *** UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/* SQLINES DEMO *** FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/* SQLINES DEMO *** SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/* SQLINES DEMO *** SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- SQLINES DEMO *** or table `productos`
--

DROP TABLE IF EXISTS productos;
/* SQLINES DEMO *** d_cs_client     = @@character_set_client */;
/* SQLINES DEMO *** cter_set_client = utf8mb4 */;
-- SQLINES FOR EVALUATION USE ONLY (14 DAYS)
CREATE TABLE productos (
  id int NOT NULL GENERATED ALWAYS AS IDENTITY,
  nombre varchar(255) NOT NULL,
  descripcion text,
  precio decimal(10,2) NOT NULL,
  categoria varchar(255) NOT NULL,
  imagen varchar(500) NOT NULL,
  PRIMARY KEY (id)
)  ;

ALTER SEQUENCE productos_seq RESTART WITH 9;
/* SQLINES DEMO *** cter_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `productos`
--

LOCK TABLES productos WRITE;
/* SQLINES DEMO *** LE `productos` DISABLE KEYS */;
INSERT INTO productos(id, nombre, descripcion, precio, categoria, imagen) VALUES (1,'Dell XPS 13','Ultrabook con pantalla InfinityEdge de 13.4", Intel i7, 16GB RAM, 512GB SSD.',1400.00,'Laptops','https://m.media-amazon.com/images/I/61kn7cyc46L._AC_SL1500_.jpg'),(2,'MacBook Air M2','Laptop Apple de 13.6", chip M2, 8GB RAM, 256GB SSD.',1500.00,'Laptops','https://http2.mlstatic.com/D_NQ_NP_2X_829933-MLU77338402190_072024-F.webp'),(3,'iPhone 15','Smartphone Apple de 6.1", A16 Bionic, cámara avanzada de 48 MP.',1200.00,'Smartphones','https://media.es.wired.com/photos/6509d9b5c3cae8b32bec9d69/16:9/w_2560%2Cc_limit/iPhone-15-Pro-Review-Top-Gear.jpeg'),(4,'Samsung Galaxy S24','Android 6.2", Snapdragon 8 Gen 3, cámara triple de 50MP.',1100.00,'Smartphones','https://tiendaonline.movistar.com.ar/media/catalog/product/cache/1d01ed3f1ecf95fcf479279f9ae509ad/s/2/s24-ultra-256-titaniumblack-front_1_1.png'),(5,'Logitech MX Master 3S','Mouse inalámbrico de alta precisión para profesionales.',100.00,'Accesorios','https://mlx.com.ar/wp-content/uploads/2025/01/LOGITECH-MX-MASTER-3S-WIRELESS-GRAPHITE.webp'),(6,'Cargador Anker Nano II 65W','Cargador rápido USB-C compatible con laptops y móviles.',60.00,'Accesorios','https://i.ebayimg.com/images/g/7esAAeSwfFZoDANN/s-l1600.webp'),(7,'PlayStation 5','Consola Sony PS5, ultra alta velocidad de carga y gráficos inmersivos.',500.00,'Gaming','https://buenosairesimport.com/6494-large_default/playstation-5-slim-1-tb-digital.jpg'),(8,'Razer BlackShark V2','Auriculares gamer con sonido envolvente 7.1 para eSports.',120.00,'Gaming','https://static.nb.com.ar/img/e5d92864cfc942c29f4ec959eadb02bf.jpg');
/* SQLINES DEMO *** LE `productos` ENABLE KEYS */;
UNLOCK TABLES;
/* SQLINES DEMO *** ZONE=@OLD_TIME_ZONE */;

/* SQLINES DEMO *** ODE=@OLD_SQL_MODE */;
/* SQLINES DEMO *** GN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/* SQLINES DEMO *** E_CHECKS=@OLD_UNIQUE_CHECKS */;
/* SQLINES DEMO *** CTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/* SQLINES DEMO *** CTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/* SQLINES DEMO *** TION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/* SQLINES DEMO *** OTES=@OLD_SQL_NOTES */;

-- SQLINES DEMO ***  2025-05-15 15:55:33
