<?php
require_once __DIR__ . '/../../backend/config/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

// Producto base + categoría
$sqlProducto = "SELECT p.*, c.categoria
                FROM productos p
                JOIN categorias c ON p.id_categoria = c.id
                WHERE p.id = :id";
$stmtProducto = $pdo->prepare($sqlProducto);
$stmtProducto->execute(['id' => $id]);
$producto = $stmtProducto->fetch(PDO::FETCH_ASSOC);

// Detalles extendidos
$sqlDetalle = "SELECT * FROM detalle_productos WHERE id_producto = :id";
$stmtDetalle = $pdo->prepare($sqlDetalle);
$stmtDetalle->execute(['id' => $id]);
$detalle = $stmtDetalle->fetch(PDO::FETCH_ASSOC);

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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../css/owl.carousel.css" />
<link rel="stylesheet" href="../../css/owl.theme.default.min.css" />
<link rel="stylesheet" href="../../css/font-awesome.min.css" />
<link rel="stylesheet" href="./css/styles.css" />

</head>

<body class="catalogo">
    <!-- PRE LOADER -->
<section class="preloader" id="main-loader">
  <div class="spinner"></div>
</section>

<!-- VIDEO DE FONDO -->
<div class="video-background">
  <video id="background-video" autoplay muted loop playsinline>
    <source src="../../videos/video.mp4" type="video/mp4" />
    Tu navegador no soporta el video.
  </video>
</div>

<!-- NAVBAR Bootstrap 5 -->
<nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
  <div class="container">
    <a class="navbar-brand me-auto" href="../../index.php">
      <img src="../../images/bytezar_imagen.png" alt="BYTEZAR" style="width: 150px;">
    </a>
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="../../index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="../../catalogo/public">Catálogo</a></li>
        <li class="nav-item"><a class="nav-link" href="../../index.php#feature">Destacados</a></li>
        <li class="nav-item"><a class="nav-link" href="../../index.php#about">¿Quiénes Somos?</a></li>
        <li class="nav-item"><a class="nav-link" href="../../contactos.php">Contactos</a></li>
      </ul>
     <?php include_once '../../backend/includes/navbar_usuario.php'; ?>
    </div>
  </div>
</nav>



<!-- Caja blanca translúcida para que se vea bien -->
<div class="container mt-5 pt-5">
  <a href="index.php" class="btn btn-primary mb-4">← Volver</a>
  
  <div class="card detalle-fondo-blanco">
    <div class="row no-gutters">
      <div class="col-md-6">
        <img src="<?= htmlspecialchars($producto['imagen']) ?>"
             alt="Imagen del producto"
             class="detalle-img">
      </div>
      <div class="col-md-6 card-body">
        <h2 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h2>
        <p class="descripcion-producto"><strong>Categoría:</strong> <?= htmlspecialchars($producto['categoria']) ?></p>
        <?php if ($detalle): ?>
         <ul>
           <li><strong>Color:</strong> <?= htmlspecialchars($detalle['color']) ?></li>
           <li><strong>Memoria RAM:</strong> <?= htmlspecialchars($detalle['memoria_ram']) ?></li>
           <li><strong>Almacenamiento:</strong> <?= htmlspecialchars($detalle['almacenamiento']) ?></li>
           <li><strong>Pantalla:</strong> <?= htmlspecialchars($detalle['pantalla']) ?></li>
           <li><strong>Tipo de carga:</strong> <?= htmlspecialchars($detalle['tipo_carga']) ?></li>
           <li><strong>Dimensiones:</strong> <?= htmlspecialchars($detalle['dimensiones']) ?></li>
           <li><strong>Peso:</strong> <?= htmlspecialchars($detalle['peso']) ?></li>
           <li><strong>Material:</strong> <?= htmlspecialchars($detalle['material']) ?></li>
           <li><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($detalle['descripcion'])) ?></li>
         </ul>
        <?php endif; ?>
        <h4 class="text-success">$<?= number_format($producto['precio'],2,',','.') ?></h4>
       
        <button class="btn btn-primary mt-3 agregarCarrito"
                data-id="<?= $producto['id'] ?>"
                data-nombre="<?= $producto['nombre'] ?>"
                data-precio="<?= $producto['precio'] ?>">
          Agregar al carrito
        </button>
      </div>
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

     <!-- FOOTER -->
<footer class="bg-light text-center text-dark py-5 mt-5">
  <div class="container">
    <div class="row">

      <!-- Logo e información del local -->
      <div class="col-12 mb-4">
        <img src="../../images/bytezar_imagen.png" alt="Logo Bytezar" class="img-fluid mb-3" style="max-width: 200px;">
        <p style="font-size: 16px; color: #333;">
          Bytezar es el bazar de la tecnología. Ofrecemos laptops, smartphones y asesoramiento especializado en el corazón del centro de Formosa.
        </p>
        <hr class="my-4" style="width: 60%;">
      </div>

      <!-- Fotos del equipo -->
      <div class="col-12 mb-4">
        <h4 class="mb-4" style="color: #222;">Equipo de Desarrollo</h4>
        <div class="row justify-content-center g-3">
          <!-- Integrante 1 -->
          <div class="col-6 col-sm-4 col-md-2 text-center">
            <img src="../../images/gerardo_medina.PNG" alt="Gerardo Medina" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p class="mb-0" style="font-size: 14px; color: #333;">Gerardo Medina</p>
          </div>
          <!-- Integrante 2 -->
          <div class="col-6 col-sm-4 col-md-2 text-center">
            <img src="../../images/jajo.enc" alt="Javier Adrián Quintana" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p class="mb-0" style="font-size: 14px; color: #333;">Javier Adrián Quintana</p>
          </div>
          <div class="col-6 col-sm-4 col-md-2 text-center">
            <img src="../../images/gustavo_alejandro.jpg" alt="Gustavo Alejandro Ginés" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p class="mb-0" style="font-size: 14px; color: #333;">Gustavo Alejandro Ginés</p>
          </div>
          <div class="col-6 col-sm-4 col-md-2 text-center">
            <img src="../../images/leandro_Nacimento.jpg" alt="Leandro Nacimento" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p class="mb-0" style="font-size: 14px; color: #333;">Leandro Nacimento</p>
          </div>
          <div class="col-6 col-sm-4 col-md-2 text-center">
            <img src="../../images/Gabriela_Heretichi.jpg" alt="Gabriela Heretichi" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p class="mb-0" style="font-size: 14px; color: #333;">Gabriela Heretichi</p>
          </div>
          <div class="col-6 col-sm-4 col-md-2 text-center">
            <img src="../../images/jajo.enc" alt="Javier Adrián Quintana" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p class="mb-0" style="font-size: 14px; color: #333;">Javier Adrián Quintana</p>
          </div>
        </div>
      </div>

      <!-- Presentación académica -->
      <div class="col-12 mt-4">
        <img src="../../images/UTN_FRRE.png" alt="UTN" class="img-fluid mb-3" style="max-width: 200px;">
        <p style="font-size: 14px; color: #777;">
          Universidad Tecnológica Nacional - Sede Formosa<br>
          Tecnicatura en Programación<br>
          Materia: Metodología de Sistemas - Docente<br>
          <strong>Facundo Leonel Verón</strong> - faccu.veron92@gmail.com<br>
          Comisión: 2.2
        </p>
        <p class="text-muted" style="font-size: 12px;">&copy; 2025 Bytezar</p>
      </div>

    </div>
  </div>
</footer>

<!-- Script del carrito y dependencias -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/carrito.js"></script>

 <!-- BOOTSTRAP 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- OTRAS Librerías -->
<script src="../../js/jquery.stellar.min.js"></script>
<script src="../../js/owl.carousel.min.js"></script>
<script src="../../js/smoothscroll.js"></script>
<script src="../../js/custom.js"></script>

</body>

</html>
