<?php
session_start();
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

<script>
// Botón para eliminar producto
function eliminarDelCarrito(id) {
    fetch(`../backend/modules/carrito/eliminar_producto.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const item = document.getElementById(`producto-${id}`);
                if (item) {
                    item.classList.add('fade-out');
                    setTimeout(() => item.remove(), 500);
                }

                if (data.nuevoTotal !== undefined) {
                    document.getElementById("total-carrito").textContent = "$" + data.nuevoTotal;
                }

                if (data.nuevaCantidad !== undefined) {
                    const contador = document.getElementById("contadorCarrito");
                    contador.textContent = data.nuevaCantidad;
                    if (data.nuevaCantidad === 0) {
                        contador.textContent = "0";
                        contador.style.display = "inline-block";
                    }
                }

                mostrarMensaje(data.message, true);
            } else {
                mostrarMensaje(data.message, false);
            }
        }).catch(() => mostrarMensaje("Error al conectar.", false));
}

// Mensaje flotante
function mostrarMensaje(texto, exito) {
    const div = document.createElement("div");
    div.textContent = texto;
    div.className = "mensaje" + (exito ? "" : " error");
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 3000);
}

// Cambiar cantidad con botones + y -
document.querySelectorAll('.cambiarCantidad').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const cambio = this.dataset.cambio;

        fetch('../backend/modules/carrito/actualizar_cantidad.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `id=${id}&cambio=${cambio}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Recargar la vista del carrito
                $('#productosCarrito').load('../includes/ver_carrito.php');
                $('#contadorCarrito').text(data.nuevaCantidad).show();
            } else {
                mostrarMensaje(data.message, false);
            }
        });
    });
});
</script>
