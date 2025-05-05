<?php
$host = 'localhost';
$db = 'catalogo';
$user = 'root';
$pass = 'Gusty1996';
$charset = 'utf8mb4';
$puerto = 3307;

$dsn = "mysql:host=$host;port=$puerto;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}

/* Estructura de la base de datos:
CREATE DATABASE catalogo;
USE catalogo;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

INSERT INTO productos (nombre, descripcion, precio) VALUES
('Producto 1', 'Descripción del primer producto', 19.99),
('Producto 2', 'Descripción del segundo producto', 29.99);
*/
?>