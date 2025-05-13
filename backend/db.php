<?php
// Datos de configuración para la conexión a la base de datos
$host = 'localhost';         // Host del servidor de base de datos (usualmente 'localhost' en desarrollo)
$db = 'catalogo';            // Nombre de la base de datos
$user = 'root';              // Usuario de la base de datos
$pass = 'Gusty1996';                  // Contraseña del usuario (vacía por defecto en XAMPP)
$charset = 'utf8mb4';        // Conjunto de caracteres recomendado (soporta emojis y caracteres especiales)
$puerto = 3307;              // Puerto por defecto de MySQL

// Data Source Name (cadena de conexión)
$dsn = "mysql:host=$host;port=$puerto;dbname=$db;charset=$charset";

// Opciones para el objeto PDO (manejo de errores y modo de obtención de resultados)
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,     // Lanzar excepciones si hay errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Devolver resultados como arrays asociativos
];

try {
    // Crear una nueva conexión PDO con los datos y opciones anteriores
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Si ocurre un error, mostrar el mensaje y detener el script
    die('Error de conexión: ' . $e->getMessage());
}


/* Estructura de la base de datos:
CREATE DATABASE catalogo;
USE catalogo;

-- Crear tabla productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    categoria VARCHAR(50),
    imagen VARCHAR(255)
);

INSERT INTO productos VALUES 
(1, 'Dell XPS 13', 'Ultrabook con pantalla InfinityEdge de 13.4", Intel i7, 16GB RAM, 512GB SSD.', 1400.00, 'Laptops', 'https://m.media-amazon.com/images/I/61kn7cyc46L.AC_SL1500.jpg'),
(2, 'MacBook Air M2', 'Laptop Apple de 13.6", chip M2, 8GB RAM, 256GB SSD.', 1500.00, 'Laptops', 'https://http2.mlstatic.com/D_NQ_NP_2X_829933-MLU77338402190_072024-F.webp'),
(3, 'iPhone 15', 'Smartphone Apple de 6.1", A16 Bionic, cámara avanzada de 48 MP.', 1200.00, 'Smartphones', 'https://media.es.wired.com/photos/6509d9b5c3cae8b32bec9d69/16:9/w_2560%2Cc_limit/iPhone-15-Pro-Review-Top-Gear.jpeg'),
(4, 'Samsung Galaxy S24', 'Android 6.2", Snapdragon 8 Gen 3, cámara triple de 50MP.', 1100.00, 'Smartphones', 'https://tiendaonline.movistar.com.ar/media/catalog/product/cache/1d01ed3f1ecf95fcf479279f9ae509ad/s/2/s24-ultra-256-titaniumblack-front_1_1.png'),
(5, 'Logitech MX Master 3S', 'Mouse inalámbrico de alta precisión para profesionales.', 100.00, 'Accesorios', 'https://mlx.com.ar/wp-content/uploads/2025/01/LOGITECH-MX-MASTER-3S-WIRELESS-GRAPHITE.webp'),
(6, 'Cargador Anker Nano II 65W', 'Cargador rápido USB-C compatible con laptops y móviles.', 60.00, 'Accesorios', 'https://i.ebayimg.com/images/g/7esAAeSwfFZoDANN/s-l1600.webp'),
(7, 'PlayStation 5', 'Consola Sony PS5, ultra alta velocidad de carga y gráficos inmersivos.', 500.00, 'Gaming', 'https://buenosairesimport.com/6494-large_default/playstation-5-slim-1-tb-digital.jpg'),
(8, 'Razer BlackShark V2', 'Auriculares gamer con sonido envolvente 7.1 para eSports.', 120.00, 'Gaming', 'https://static.nb.com.ar/img/e5d92864cfc942c29f4ec959eadb02bf.jpg');
*/
?>