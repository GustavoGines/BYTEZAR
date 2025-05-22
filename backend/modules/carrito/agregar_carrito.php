<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nombre = trim($_POST['nombre'] ?? '');
$precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);

if (!$id || $nombre === '' || $precio === false) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
    exit;
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

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

header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Producto agregado correctamente.']);
