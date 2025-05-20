<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$carrito = $_SESSION['carrito'] ?? [];

if (empty($carrito)) {
    echo "<p class='text-center mt-5'>El carrito está vacío.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h1 class="mb-4">Carrito de Compras</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($carrito as $indice => $producto) {
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                    <td>
                        <form action="../backend/modules/carrito/actualizar_carrito.php" method="post" class="d-flex">
                            <input type="hidden" name="indice" value="<?= $indice ?>">
                            <input type="number" name="cantidad" value="<?= $producto['cantidad'] ?>" min="1" class="form-control form-control-sm me-2" style="width: 70px;">
                            <button type="submit" class="btn btn-sm btn-success">Actualizar</button>
                        </form>
                    </td>
                    <td>$<?= number_format($producto['precio'], 2, ',', '.') ?></td>
                    <td>$<?= number_format($subtotal, 2, ',', '.') ?></td>
                    <td>
                        <a href="../../backend/modules/carrito/eliminar_producto.php?indice=<?= $indice ?>" class="btn btn-danger btn-sm">Eliminar</a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <h3>Total: $<?= number_format($total, 2, ',', '.') ?></h3>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
