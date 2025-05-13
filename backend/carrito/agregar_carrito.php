<?php
session_start(); // Iniciar la sesión para usar $_SESSION

// Obtener y validar los datos del formulario enviados por POST
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);               // ID del producto como entero
$nombre = trim($_POST['nombre'] ?? '');                                  // Nombre del producto (limpiar espacios)
$precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);    // Precio del producto como número flotante

// Validar que los datos sean válidos
if (!$id || $nombre === '' || $precio === false) {
    http_response_code(400); // Código HTTP 400: Solicitud incorrecta
    echo "Datos inválidos.";
    exit;
}

// Si no existe el carrito aún en la sesión, inicializarlo como un array vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Si el producto ya está en el carrito, aumentar su cantidad
if (isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id]['cantidad'] += 1;
} else {
    // Si el producto no está, agregarlo con cantidad inicial 1
    $_SESSION['carrito'][$id] = [
        'id' => $id,
        'nombre' => htmlspecialchars($nombre), // Proteger contra XSS
        'precio' => $precio,
        'cantidad' => 1
    ];
}

// Devolver código HTTP 200 indicando éxito
http_response_code(200);
echo "Producto agregado correctamente.";
