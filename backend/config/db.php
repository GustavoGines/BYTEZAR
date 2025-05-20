<?php
$host = 'dpg-d0hpjbq4d50c73dc1gb0-a.oregon-postgres.render.com'; // Asegurate que sea el host completo
$db = 'prueba_db_n963';
$user = 'prueba_db_n963_user';
$pass = 'fz8hoDvUGGuFQw8sttoUE9WBI2E8gFDf';
$puerto = 5432;

$dsn = "pgsql:host=$host;port=$puerto;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}

// CONECTAR A LA BASE DE DATOS POR MEDIO DE LA TERMINAL
//COMANDO: psql -h dpg-d0hpjbq4d50c73dc1gb0-a.oregon-postgres.render.com -U prueba_db_n963_user prueba_db_n963
//CONTRASEÑA: fz8hoDvUGGuFQw8sttoUE9WBI2E8gFDf 


