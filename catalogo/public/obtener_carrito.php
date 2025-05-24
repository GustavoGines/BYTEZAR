<?php
session_start();
header('Content-Type: application/json');

// Verificamos si existe el carrito en la sesión
if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
    echo json_encode($_SESSION['carrito']);
} else {
    echo json_encode([]);
}
?>
