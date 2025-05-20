<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: application/json');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) // por claridad, aunque `false` cubre la mayoría de los casos
{
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "ID inválido."]);
    exit;
}

if (isset($_SESSION['carrito'][$id])) {
    unset($_SESSION['carrito'][$id]);

    $nuevoTotal = 0;
    $nuevaCantidad = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $nuevoTotal += $producto['precio'] * $producto['cantidad'];
        $nuevaCantidad += $producto['cantidad'];
    }

    echo json_encode([
        "success" => true,
        "message" => "Producto eliminado.",
        "nuevoTotal" => number_format($nuevoTotal, 2, ',', '.'),
        "nuevaCantidad" => $nuevaCantidad
    ]);
} else {
    http_response_code(404);
    echo json_encode(["success" => false, "message" => "Producto no encontrado en el carrito."]);
}
