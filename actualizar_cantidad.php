<?php
session_start();
header('Content-Type: application/json');

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$cambio = filter_input(INPUT_POST, 'cambio', FILTER_VALIDATE_INT);

if (!isset($_SESSION['carrito'][$id]) || $cambio === null) {
    echo json_encode([
        'success' => false,
        'message' => 'Producto no encontrado o datos inválidos.'
    ]);
    exit;
}

$cantidadActual = $_SESSION['carrito'][$id]['cantidad'];
$nuevaCantidad = $cantidadActual + $cambio;

if ($nuevaCantidad < 1) {
    unset($_SESSION['carrito'][$id]);
    $mensaje = "Producto eliminado del carrito.";
} else {
    $_SESSION['carrito'][$id]['cantidad'] = $nuevaCantidad;
    $mensaje = "Cantidad actualizada.";
}

// Recalcular total y cantidad
$total = 0;
$cantidadTotal = 0;
foreach ($_SESSION['carrito'] as $prod) {
    $total += $prod['precio'] * $prod['cantidad'];
    $cantidadTotal += $prod['cantidad'];
}

echo json_encode([
    'success' => true,
    'nuevoTotal' => number_format($total, 2, ',', '.'),
    'nuevaCantidad' => $cantidadTotal,
    'message' => $mensaje
]);
