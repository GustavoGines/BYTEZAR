<?php
session_start(); // Inicia la sesión para acceder a la variable $_SESSION

// Indica que la respuesta será en formato JSON
header('Content-Type: application/json');

// Obtener el ID del producto y el cambio en cantidad desde el POST, asegurando que sean números válidos
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$cambio = filter_input(INPUT_POST, 'cambio', FILTER_VALIDATE_INT);

// Verificar que el producto exista en el carrito y que los datos sean válidos
if (!isset($_SESSION['carrito'][$id]) || $cambio === null) {
    echo json_encode([
        'success' => false,
        'message' => 'Producto no encontrado o datos inválidos.'
    ]);
    exit; // Termina la ejecución si hay error
}

// Obtener la cantidad actual del producto en el carrito
$cantidadActual = $_SESSION['carrito'][$id]['cantidad'];
$nuevaCantidad = $cantidadActual + $cambio;

// Si la nueva cantidad es menor a 1, eliminar el producto del carrito
if ($nuevaCantidad < 1) {
    unset($_SESSION['carrito'][$id]);
    $mensaje = "Producto eliminado del carrito.";
} else {
    // Si no, actualizar la cantidad en el carrito
    $_SESSION['carrito'][$id]['cantidad'] = $nuevaCantidad;
    $mensaje = "Cantidad actualizada.";
}

// Recalcular el total del carrito y la cantidad total de productos
$total = 0;
$cantidadTotal = 0;
foreach ($_SESSION['carrito'] as $prod) {
    $total += $prod['precio'] * $prod['cantidad'];
    $cantidadTotal += $prod['cantidad'];
}

// Enviar la respuesta como JSON al frontend con los nuevos valores
echo json_encode([
    'success' => true,
    'nuevoTotal' => number_format($total, 2, ',', '.'), // Formato: 1.234,56
    'nuevaCantidad' => $cantidadTotal,
    'message' => $mensaje
]);
