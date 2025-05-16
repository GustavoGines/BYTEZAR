<?php
require '../backend/config/db.php';

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
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
</head>
<body>

<body>

<!-- Fondo de video -->
<div class="video-background">
  <video autoplay muted loop playsinline>
    <source src="../../videos/video.mp4" type="video/mp4" />
    Tu navegador no soporta el video.
  </video>
</div>


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

          <button type="button" class="btn btn-primary mt-3 agregarCarrito"
             data-id="<?= $producto['id'] ?>"
             data-nombre="<?= $producto['nombre'] ?>"
             data-precio="<?= $producto['precio'] ?>">
             Agregar al carrito
          </button>
        </div>
    </div>
</div>
<!-- Botón para abrir el carrito -->
<button id="abrirCarritoBtn" class="carrito-cerrado">
  &#128722;
  <span id="contadorCarrito" class="badge bg-danger ms-1">0</span>
</button>

<div id="carritoFlotante">
  <h2>Carrito</h2>
  <div id="productosCarrito"></div>
  <button id="cerrarCarritoBtn" class="btn btn-danger">Cerrar Carrito</button>
</div>
<!-- Script del carrito -->
<script src="js/carrito.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>
