<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../backend/config/db.php';

// Manejo de errores de PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Inicializar $categoriaSeleccionada desde $_GET
$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Obtener todas las categorías para el filtro
try {
  $categorias = $pdo->query("SELECT categoria FROM categorias ORDER BY categoria ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Error al obtener categorías: " . $e->getMessage());
}

try {
  // Verificar si la tabla detalle_productos existe en PostgreSQL
  $result = $pdo->query("SELECT to_regclass('public.detalle_productos') AS existe");
  $row = $result->fetch(PDO::FETCH_ASSOC);
  $detalleProductosExiste = !empty($row['existe']);
} catch (PDOException $e) {
  die("Error al verificar la tabla detalle_productos: " . $e->getMessage());
}

// Obtener productos con JOIN a categorías
try {
  if ($detalleProductosExiste) {
    if (!empty($categoriaSeleccionada)) {
      $queryProductos = "SELECT p.*, c.categoria, d.descripcion
                 FROM productos p
                 JOIN categorias c ON p.id_categoria = c.id
                 LEFT JOIN detalle_productos d ON d.id_producto = p.id
                 WHERE c.categoria = :categoria";
      $stmtProductos = $pdo->prepare($queryProductos);
      $stmtProductos->bindParam(':categoria', $categoriaSeleccionada);
      $stmtProductos->execute();
    } else {
      $queryProductos = "SELECT p.*, c.categoria, d.descripcion
                 FROM productos p
                 JOIN categorias c ON p.id_categoria = c.id
                 LEFT JOIN detalle_productos d ON d.id_producto = p.id";
      $stmtProductos = $pdo->query($queryProductos);
    }
  } else {
    if (!empty($categoriaSeleccionada)) {
      $queryProductos = "SELECT p.*, c.categoria
                 FROM productos p
                 JOIN categorias c ON p.id_categoria = c.id
                 WHERE c.categoria = :categoria";
      $stmtProductos = $pdo->prepare($queryProductos);
      $stmtProductos->bindParam(':categoria', $categoriaSeleccionada);
      $stmtProductos->execute();
    } else {
      $queryProductos = "SELECT p.*, c.categoria
                 FROM productos p
                 JOIN categorias c ON p.id_categoria = c.id";
      $stmtProductos = $pdo->query($queryProductos);
    }
  }
  $productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Error al obtener productos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo de Productos</title>
  
<!-- BOOTSTRAP 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/owl.carousel.css" />
  <link rel="stylesheet" href="../../css/owl.theme.default.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400">
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script>
  const usuarioLogueado = <?= json_encode(isset($_SESSION['usuario'])) ?>;
</script>

</head>
<body class="catalogo">

<!-- PRE LOADER -->
<section class="preloader" id="main-loader">
  <div class="spinner"><span class="spinner-rotate"></span></div>
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
    <a class="navbar-brand " href="../../index.php">
      <img src="../../images/bytezar_imagen.png" class="img-fluid" alt="BYTEZAR" style="width: 150px; margin-top: -10px;">
    </a>
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="../../index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link login-brillante" href="../../catalogo/public/catalogo.php">Catálogo</a></li>
        <li class="nav-item"><a class="nav-link" href="../../index.php#feature">Destacados</a></li>
        <li class="nav-item"><a class="nav-link" href="../../index.php#about">¿Quiénes Somos?</a></li>
        <li class="nav-item"><a class="nav-link" href="../../contactos.php">Contactos</a></li>
      </ul>
     <?php include_once '../../backend/includes/navbar_usuario.php'; ?>
    </div>
  </div>

</nav>


<!-- Contenido -->
<div class="container mt-5 pt-5">

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-warning text-center">
      <?= $_SESSION['mensaje'] ?>
    </div>
    <?php unset($_SESSION['mensaje']); ?>
  <?php endif; ?>
  
  <h1 class="mb-4 text-center  ">Catálogo de Productos</h1>

  <!-- Filtro por categoría -->
<form action="catalogo.php" method="get" class="mb-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <select name="categoria" id="categoria" class="form-control" onchange="this.form.submit()">
        <option value="">Todas las categorías</option>
        <?php foreach ($categorias as $categoria): ?>
          <?php
            $categoriaNombre = htmlspecialchars($categoria['categoria']);
            $selected = ($categoriaNombre === $categoriaSeleccionada) ? 'selected' : '';
          ?>
          <option value="<?= $categoriaNombre ?>" <?= $selected ?>><?= $categoriaNombre ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</form> 

 <!-- Sección de productos sobre fondo oscuro -->
<section id="productos" class="productos-sobre-video py-5">
  <div class="container">
    <h2 class="text-center text-white mb-4">Nuestros Productos</h2>

    <div class="row">
      <?php if ($productos): ?>
        <?php foreach ($productos as $producto): ?>
          <div class="col-md-4 mb-4">
            <?php include 'producto.php'; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="col-12 text-center text-white">No hay productos disponibles en esta categoría.</p>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- Carrito -->
<div id="carritoFlotante">
  <h2>Carrito</h2>
  <div id="productosCarrito"></div>
  <button id="cerrarCarritoBtn" class="btn btn-danger">Cerrar Carrito</button>
  <button id="pagarBtn" class="btn btn-success ms-2">Pagar</button>
</div>
 <button id="abrirCarritoBtn" class="carrito-cerrado">
  &#128722; <span id="contadorCarrito" class="badge bg-danger ms-1">0</span>
 </button>

  <!-- Modal Pagar -->
<div class="modal fade" id="modalPagar" tabindex="-1" aria-labelledby="modalPagarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formCompra">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPagarLabel">Detalle de Compra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div id="detalleCompra"></div>
          <div class="mb-3">
            <label for="metodoPago" class="form-label">Método de Pago</label>
            <select id="metodoPago" name="metodoPago" class="form-select" required>
              <option value="">Seleccione un método</option>
              <?php
                // Leer métodos de pago de la base de datos (PostgreSQL compatible)
                try {
                  $metodos = $pdo->query("SELECT id, metodo_pago FROM metodo_pagos")->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($metodos as $metodo) {
                    echo '<option value="'.$metodo['id'].'">'.htmlspecialchars($metodo['metodo_pago']).'</option>';
                  }
                } catch (PDOException $e) {
                  echo '<option value="">Error al cargar métodos de pago</option>';
                }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Confirmar compra</button>
        </div>
      </form>
    </div>
  </div>
</div>
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
      <div class="col-md-12">
        <h4 style="color: #222; margin-bottom: 20px;">Equipo de Desarrollo</h4>
        <div class="row justify-content-center">

          <!-- Repetir este bloque para cada integrante -->
          <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/gerardo_medina.PNG" alt="Integrante 1" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Gerardo Medina</p>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/jajo.jpg" alt="Integrante 2" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Javier Adrián Quintana</p>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/gustavo_gines.jpg" alt="Integrante 3" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Gustavo Alejandro Ginés</p>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/leandro_nacimento.jpg" alt="Integrante 4" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Leandro Nacimento</p>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/gabriela_heretichi.jpg" alt="Integrante 5" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Gabriela Heretichi</p>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/tere_zamboni.jpg" alt="Integrante 6" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Teresa Zamboni</p>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/leo_arce.jpg" alt="Integrante 7" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Leonardo Arce</p>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/lourdes_villalba.jpg" alt="Integrante 8" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Lourdes Villalba</p>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/max_justiniano.jpg" alt="Integrante 9" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Max Justiniano</p>
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
</div>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- BOOTSTRAP 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/carrito.js"></script>
<script src="../../js/jquery.stellar.min.js"></script>
<script src="../../js/owl.carousel.min.js"></script>
<script src="../../js/smoothscroll.js"></script>
<script src="../../js/custom.js"></script>

<?php include '../../backend/includes/footer.php'; ?>
</body>
</html>
