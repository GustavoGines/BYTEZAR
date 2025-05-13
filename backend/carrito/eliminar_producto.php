<?php
session_start(); // Iniciar la sesión para acceder al carrito

// Indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Obtener y validar el ID del producto desde GET
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si el ID es inválido (null o no numérico)
if ($id === false || $id === null) // `false` cubre la mayoría de los casos, pero `null` se incluye por claridad
{
    http_response_code(400); // Código HTTP 400: solicitud incorrecta
    echo json_encode(["success" => false, "message" => "ID inválido."]);
    exit;
}

// Verificar si el producto existe en el carrito
if (isset($_SESSION['carrito'][$id])) {
    // Eliminar el producto del carrito
    unset($_SESSION['carrito'][$id]);

    // Recalcular el total y la cantidad de productos restantes
    $nuevoTotal = 0;
    $nuevaCantidad = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $nuevoTotal += $producto['precio'] * $producto['cantidad'];
        $nuevaCantidad += $producto['cantidad'];
    }

    // Devolver la respuesta con el nuevo total y cantidad
    echo json_encode([
        "success" => true,
        "message" => "Producto eliminado.",
        "nuevoTotal" => number_format($nuevoTotal, 2, ',', '.'), // Formato: 1.234,56
        "nuevaCantidad" => $nuevaCantidad
    ]);
} else {
    // Si el producto no existe en el carrito, devolver error 404
    http_response_code(404); // No encontrado
    echo json_encode(["success" => false, "message" => "Producto no encontrado en el carrito."]);
}
