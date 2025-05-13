<?php
session_start();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nombre = trim($_POST['nombre'] ?? '');
$precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);

if (!$id || $nombre === '' || $precio === false) {
    http_response_code(400);
    echo "Datos inválidos.";
    exit;
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Usar el ID como clave
if (isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id]['cantidad'] += 1;
} else {
    $_SESSION['carrito'][$id] = [
        'id' => $id,
        'nombre' => htmlspecialchars($nombre),
        'precio' => $precio,
        'cantidad' => 1
    ];
}

http_response_code(200);
echo "Producto agregado correctamente.";

