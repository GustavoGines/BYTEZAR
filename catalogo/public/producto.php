<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Este archivo se incluye dentro de un foreach desde index.php
// y espera una variable $producto con los datos del producto

if (!isset($producto)) return;

// Imagen por defecto si no está definida
$imagen = $producto['imagen'] ?: 'https://via.placeholder.com/400x300.png?text=Imagen+no+disponible';
?>

<div class="card shadow-sm h-100">
    <!-- Imagen clickeable -->
    <a href="producto_detalle.php?id=<?= $producto['id'] ?>">
        <img src="<?= htmlspecialchars($imagen) ?>" class="card-img-top" alt="Imagen del producto">
    </a>
    <div class="card-body">
        <!-- Nombre clickeable -->
        <h4 class="card-title">
            <a href="producto_detalle.php?id=<?= $producto['id'] ?>" class="text-decoration-none text-dark">
                <?= htmlspecialchars($producto['nombre']) ?>
            </a>
        </h4>
        <p class="descripcion-producto"><?= htmlspecialchars($producto['descripcion']) ?></p>
        <p><strong>Precio:</strong> $<?= number_format($producto['precio'], 2, ',', '.') ?></p>
        
        <!-- Botón para agregar al carrito -->
        <button class="btn btn-primary agregarCarrito"
                data-id="<?= $producto['id'] ?>"
                data-nombre="<?= htmlspecialchars($producto['nombre']) ?>"
                data-precio="<?= $producto['precio'] ?>">
            Agregar al carrito
        </button>
    </div>
</div>
