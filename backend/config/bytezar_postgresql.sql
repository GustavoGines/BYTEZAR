
/*!50503 SET NAMES utf8 */;


DROP TABLE IF EXISTS "categorias";
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "categorias" (
  "id" SERIAL PRIMARY KEY,
  "categoria" VARCHAR(100) NOT NULL
) ;


INSERT INTO "categorias"("id","categoria") VALUES (1,'Laptops'),(2,'Smartphones'),(3,'Accesorios'),(4,'Gaming');


DROP TABLE IF EXISTS "detalle_productos";
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "detalle_productos" (
  "id_producto" INTEGER NOT NULL,
  "color" VARCHAR(50) DEFAULT NULL,
  "memoria_ram" VARCHAR(50) DEFAULT NULL,
  "almacenamiento" VARCHAR(50) DEFAULT NULL,
  "pantalla" VARCHAR(50) DEFAULT NULL,
  "tipo_carga" VARCHAR(50) DEFAULT NULL,
  "dimensiones" VARCHAR(100) DEFAULT NULL,
  "peso" VARCHAR(50) DEFAULT NULL,
  "material" VARCHAR(50) DEFAULT NULL,
  "descripcion" TEXT,
  PRIMARY KEY ("id_producto"),
  CONSTRAINT "detalle_productos_ibfk_1" FOREIGN KEY ("id_producto") REFERENCES "productos" ("id")
) ;


INSERT INTO "detalle_productos"("id_producto","color","memoria_ram","almacenamiento","pantalla","tipo_carga","dimensiones","peso","material","descripcion") VALUES (1,'Plata','16GB','512GB SSD','13.4\" FHD+','USB-C','30.2 x 1.5 cm','1.2kg','Aluminio','Ultrabook con pantalla InfinityEdge de 13.4\", Intel i7, 16GB RAM, 512GB SSD.'),(2,'Gris espacial','8GB','256GB SSD','13.6\" Retina','USB-C','30.4 x 1.1 cm','1.24kg','Aluminio','Laptop Apple de 13.6\", chip M2, 8GB RAM, 256GB SSD.'),(3,'Negro','6GB','128GB','6.1\" OLED','Lightning','14.7 x 7.1 x 0.8 cm','172g','Vidrio y aluminio','Smartphone Apple de 6.1\", A16 Bionic, cámara avanzada de 48 MP.'),(4,'Titanium Black','8GB','256GB','6.2\" AMOLED','USB-C','14.8 x 7.2 x 0.9 cm','180g','Metal y vidrio','Android 6.2\", Snapdragon 8 Gen 3, cámara triple de 50MP.'),(5,'Grafito','Sin RAM','Interna','Sin pantalla','USB-C','12.5 x 8.4 x 5.1 cm','141g','Plástico Premium','Mouse inalámbrico con sensor de alta precisión y múltiples botones programables.'),(6,'Negro','Sin RAM','65W salida','Sin pantalla','USB-C','6.2 x 4.5 x 2.5 cm','115g','Plástico resistente','Cargador compacto con tecnología GaN para carga rápida.'),(7,'Blanco','16GB GDDR6','1TB SSD','Salida HDMI 4K HDR','Cable AC','39 x 10.4 x 26 cm','4.5kg','Plástico','Consola de videojuegos con carga ultra rápida y soporte para 4K HDR.'),(8,'Negro','Compatible PC/PS5','Cableado','Sin pantalla','USB + Jack 3.5mm','21 x 19 x 10 cm','240g','Plástico','Auriculares con sonido envolvente 7.1, micrófono desmontable y diadema acolchada.');


DROP TABLE IF EXISTS "detalle_ventas";
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "detalle_ventas" (
  "id_venta" INTEGER NOT NULL,
  "id_productos" INTEGER NOT NULL,
  "cantidad" INTEGER DEFAULT NULL,
  PRIMARY KEY ("id_venta","id_productos"),
  
  CONSTRAINT "detalle_ventas_ibfk_1" FOREIGN KEY ("id_venta") REFERENCES "ventas" ("id"),
  CONSTRAINT "detalle_ventas_ibfk_2" FOREIGN KEY ("id_productos") REFERENCES "productos" ("id"),
  ADD CONSTRAINT detalle_ventas_chk_1 CHECK (cantidad >= 1);
) ;




DROP TABLE IF EXISTS "metodo_pagos";
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "metodo_pagos" (
  "id" SERIAL ,
  "metodo_pago" VARCHAR(100) NOT NULL,
  PRIMARY KEY ("id")
) ;


INSERT INTO "metodo_pagos"("id","metodo_pago") VALUES (1,'Efectivo'),(2,'Tarjeta de Crédito'),(3,'Tarjeta de Débito'),(4,'Transferencia Bancaria'),(5,'Billetera Virtual');


DROP TABLE IF EXISTS "personas";
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "personas" (
  "id" SERIAL ,
  "nombre" VARCHAR(100) NOT NULL,
  "apellido" VARCHAR(100) NOT NULL,
  "fecha_nacimiento" date DEFAULT NULL,
  "telefono" VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY ("id")
) ;

INSERT INTO "personas"("id","nombre","apellido","fecha_nacimiento","telefono") VALUES (1,'Gustavo','Gines','1996-03-28','370-4787285');


DROP TABLE IF EXISTS "productos";
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "productos" (
  "id" SERIAL ,
  "nombre" VARCHAR(100) NOT NULL,
  "precio" NUMERIC(20,2) NOT NULL,
  "id_categoria" INTEGER DEFAULT NULL,
  "imagen" VARCHAR(255) DEFAULT NULL,
  "stock" INTEGER DEFAULT NULL,
  PRIMARY KEY ("id"),
  
  CONSTRAINT "productos_ibfk_1" FOREIGN KEY ("id_categoria") REFERENCES "categorias" ("id"),
  CONSTRAINT "productos_chk_1" CHECK ("precio" > 0),
  CONSTRAINT "productos_chk_2" CHECK ("stock" >= 0)
) ;


INSERT INTO "productos"("id","nombre","apellido","id_categoria","imagen","stock") VALUES (1,'Dell XPS 13',1400.00,1,'https://m.media-amazon.com/images/I/61kn7cyc46L._AC_SL1500_.jpg',15),(2,'MacBook Air M2',1500.00,1,'https://http2.mlstatic.com/D_NQ_NP_2X_829933-MLU77338402190_072024-F.webp',12),(3,'iPhone 15',1200.00,2,'https://media.es.wired.com/photos/6509d9b5c3cae8b32bec9d69/16:9/w_2560%2Cc_limit/iPhone-15-Pro-Review-Top-Gear.jpeg',7),(4,'Samsung Galaxy S24',1100.00,2,'https://tiendaonline.movistar.com.ar/media/catalog/product/cache/1d01ed3f1ecf95fcf479279f9ae509ad/s/2/s24-ultra-256-titaniumblack-front_1_1.png',9),(5,'Logitech MX Master 3S',100.00,3,'https://http2.mlstatic.com/D_NQ_NP_2X_945737-MLA50896130021_072022-F.webp',5),(6,'Cargador Anker Nano II 65W',60.00,3,'https://ae01.alicdn.com/kf/Sf5332108f2cd44b1a9e568f3df00db19H.jpg',20),(7,'PlayStation 5',500.00,4,'https://buenosairesimport.com/6494-large_default/playstation-5-slim-1-tb-digital.jpg',14),(8,'Razer BlackShark V2',120.00,4,'https://static.nb.com.ar/img/e5d92864cfc942c29f4ec959eadb02bf.jpg',13);


DROP TABLE IF EXISTS "rol_usuarios";
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "rol_usuarios" (
  "id" SERIAL,
  "rol" VARCHAR(50) NOT NULL,
  PRIMARY KEY ("id")
) ;


INSERT INTO "rol_usuarios" VALUES (1,'admin'),(2,'cliente');


DROP TABLE IF EXISTS "usuarios";
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "usuarios" (
  "id_personas" INTEGER NOT NULL,
  "correo" VARCHAR(100) NOT NULL,
  "contraseña" VARCHAR(255) NOT NULL,
  "id_rol" INTEGER DEFAULT NULL,
  PRIMARY KEY ("id_personas"),
  UNIQUE ("correo"),
  
  CONSTRAINT "usuarios_ibfk_1" FOREIGN KEY ("id_personas") REFERENCES "personas" ("id") ON DELETE CASCADE,
  CONSTRAINT "usuarios_ibfk_2" FOREIGN KEY ("id_rol") REFERENCES "rol_usuarios" ("id")
) ;





DROP TABLE IF EXISTS "ventas";
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE "ventas" (
  "id" SERIAL,
  "id_personas" INTEGER DEFAULT NULL,
  "fecha_venta" date DEFAULT NULL,
  "id_metodo_pago" INTEGER DEFAULT NULL,
  "created_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  "updated_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ("id"),
  
  
  CONSTRAINT "ventas_ibfk_1" FOREIGN KEY ("id_personas") REFERENCES "personas" ("id"),
  CONSTRAINT "ventas_ibfk_2" FOREIGN KEY ("id_metodo_pago") REFERENCES "metodo_pagos" ("id")
) ;




