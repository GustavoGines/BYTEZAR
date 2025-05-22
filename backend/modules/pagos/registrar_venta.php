<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

if (!isset($_SESSION['usuario']['id_personas'])) {
    $_SESSION['redirect_after_login'] = 'catalogo/public/catalogo.php'; // guardás la intención
    echo json_encode([
        'success' => false,
        'redirect' => '../../login.html'
    ]);
    exit;
}
$id_persona = $_SESSION['usuario']['id_personas'];
$carrito = $_SESSION['carrito'] ?? [];
$metodo_pago = intval($_POST['metodo_pago'] ?? 0);

if (empty($carrito)) {
    echo json_encode(['success' => false, 'message' => 'El carrito está vacío.']);
    exit;
}

if ($metodo_pago <= 0) {
    echo json_encode(['success' => false, 'message' => 'Método de pago inválido.']);
    exit;
}

try {
    $pdo->beginTransaction();

    // Insertar en ventas y obtener el id_venta
    $stmt = $pdo->prepare("INSERT INTO ventas (id_personas, id_metodo_pago) VALUES (?, ?) RETURNING id");
    $stmt->execute([$id_persona, $metodo_pago]);
    $id_venta = $stmt->fetchColumn();

    // Insertar en detalle_ventas
    $stmtDetalle = $pdo->prepare("INSERT INTO detalle_ventas (id_venta, id_productos, cantidad) VALUES (?, ?, ?)");
    foreach ($carrito as $item) {
        $stmtDetalle->execute([$id_venta, $item['id'], $item['cantidad']]);
    }

    unset($_SESSION['carrito']);
    $pdo->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>

