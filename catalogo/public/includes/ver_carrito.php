<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$carrito = $_SESSION['carrito'] ?? [];

if (count($carrito) === 0): ?>
    <p>No hay productos en el carrito.</p>
    <script>$('#contadorCarrito').text(0).show();</script>
<?php return; endif; ?>

<?php $total = 0; ?>

<div id="carrito-productos">
<?php foreach ($carrito as $id => $producto): 
    $subtotal = $producto['precio'] * $producto['cantidad'];
    $total += $subtotal;
?>
    <div class="producto d-flex justify-content-between align-items-center mb-3" id="producto-<?= $id ?>">
        <div>
            <span class="nombre"><?= htmlspecialchars($producto['nombre']) ?></span><br>
            <div class="d-flex align-items-center mt-1">
                <button class="btn btn-sm btn-outline-secondary cambiarCantidad me-2" data-id="<?= $id ?>" data-cambio="-1">−</button>
                <strong class="cantidad me-2 d-inline-block text-nowrap">Cantidad: <span><?= $producto['cantidad'] ?></span></strong>
                <button class="btn btn-sm btn-outline-secondary cambiarCantidad me-2" data-id="<?= $id ?>" data-cambio="1">+</button>
            </div>
            <span class="precio-unitaria d-block mt-1">Precio: $<?= number_format($producto['precio'], 2, ',', '.') ?></span>
        </div>
        <div class="text-end">
            <span class="precio d-block mb-1">Subtotal: $<?= number_format($subtotal, 2, ',', '.') ?></span>
            <button class="btn btn-sm btn-danger" onclick="eliminarDelCarrito(<?= $id ?>)">Eliminar</button>
        </div>
    </div>
<?php endforeach; ?>
</div>

<hr>
<p><strong>Total:</strong> <span id="total-carrito">$<?= number_format($total, 2, ',', '.') ?></span></p>

