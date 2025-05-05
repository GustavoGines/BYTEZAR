<?php
require 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM productos WHERE id = ?');
$stmt->execute([$id]);
$producto = $stmt->fetch();

if (!$producto) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($producto['nombre']) ?> - Detalles</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <a href="index.php" class="btn btn-secondary mb-4">← Volver</a>

    <div class="row">
        <div class="col-md-6">
            <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="Imagen del producto" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h2><?= htmlspecialchars($producto['nombre']) ?></h2>
            <p><strong>Categoría:</strong> <?= htmlspecialchars($producto['categoria']) ?></p>
            <p><?= nl2br(htmlspecialchars($producto['descripcion'])) ?></p>
            <h4 class="text-success">$<?= number_format($producto['precio'], 2, ',', '.') ?></h4>

            <!-- Agregar al carrito -->
            <form action="agregar_carrito.php" method="post">
                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                <input type="hidden" name="nombre" value="<?= $producto['nombre'] ?>">
                <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
                <button type="submit" class="btn btn-primary mt-3">Agregar al carrito</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
