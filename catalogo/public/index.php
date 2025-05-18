<?php
require '../backend/config/db.php';

// Obtener categorías
$queryCategorias = "SELECT DISTINCT categoria FROM productos";
$stmtCategorias = $pdo->query($queryCategorias);
$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);

// Filtrar categoría seleccionada
$categoriaSeleccionada = filter_input(INPUT_GET, 'categoria', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Obtener productos
if (!empty($categoriaSeleccionada)) {
    $queryProductos = "SELECT * FROM productos WHERE categoria = :categoria";
    $stmtProductos = $pdo->prepare($queryProductos);
    $stmtProductos->bindParam(':categoria', $categoriaSeleccionada, PDO::PARAM_STR);
    $stmtProductos->execute();
} else {
    $queryProductos = "SELECT * FROM productos";
    $stmtProductos = $pdo->query($queryProductos);
}

$productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="../../index.html">
      <img src="../../images/bytezar_imagen.png" alt="BYTEZAR" style="width: 150px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="../../index.html">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="../../catalogo/public">Catálogo</a></li>
        <li class="nav-item"><a class="nav-link" href="../../index.html#feature">Destacados</a></li>
        <li class="nav-item"><a class="nav-link" href="../../index.html#about">¿Quiénes Somos?</a></li>
        <li class="nav-item"><a class="nav-link" href="../../contactos.html">Contactos</a></li>
      </ul>
     <ul class="navbar-nav ms-auto">
       <li class="nav-item">
        <a class="nav-link login-brillante" href="../../login.html">Login</a></li>
     </ul>  
    </div>
  </div>

</nav>


<!-- Contenido -->
<div class="container mt-5 pt-5">
  <h1 class="mb-4 text-center text-white ">Catálogo de Productos</h1>

  <!-- Filtro por categoría -->
<form action="index.php" method="get" class="mb-4">
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
 </div>
 <button id="abrirCarritoBtn" class="carrito-cerrado">
  &#128722; <span id="contadorCarrito" class="badge bg-danger ms-1">0</span>
 </button>

      <!-- FOOTER -->
<footer id="footer" data-stellar-background-ratio="0.5" style="background: #f8f8f8; padding-top: 40px; padding-bottom: 40px;">
  <div class="container">
    <div class="row text-center">

      <!-- Logo e información del local -->
      <div class="col-md-12">
        <img src="../../images/bytezar_imagen.png" alt="Logo Bytezar" style="width: 200px; height: auto; margin-bottom: 15px;">
        <p style="font-size: 16px; color: #333;">
          Bytezar es el bazar de la tecnología. Ofrecemos laptops, smartphones y asesoramiento especializado en el corazón del centro de Formosa.
        </p>
        <hr style="margin: 30px auto; width: 60%;">
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
            <img src="../../images/jajo.enc" alt="Integrante 2" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Javier Adrián Quintana</p>
          </div>
              <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/gustavo_alejandro.jpg" alt="Integrante 2" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Gustavo Alejandro Ginés</p>
          </div>
              <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/leandro_Nacimento.jpg" alt="Integrante 2" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Leandro Nacimento</p>
          </div>
              <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/Gabriela_Heretichi.jpg" alt="Integrante 2" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Gabriela Heretichi</p>
          </div>
              <div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 20px;">
            <img src="../../images/jajo.enc" alt="Integrante 2" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
            <p style="font-size: 14px; color: #333;">Javier Adrián Quintana</p>
          </div>
          <!-- ... agregar los 9 integrantes aquí ... -->

        </div>
      </div>

      <!-- Presentación académica -->
      <div class="col-md-12" style="margin-top: 30px;">
         <img src="../../images/UTN_FRRE.png" alt="Logo Bytezar" style="width: 200px; height: auto; margin-bottom: 15px;">
        
        <p style="font-size: 14px; color: #777;">

          Universidad Tecnologica Nacional  - Sede Formosa <br>
          Tecnicatura en Programación <br>
          Materia: Metodología de Sistemas - Docente<br>
          <strong>Facundo Leonel Verón</strong> - faccu.veron92@gmail.com <br>
          Comisión: 2.2
        </p>
        <p style="font-size: 12px; color: #aaa;">&copy; 2025 Bytezar</p>
      </div>

    </div>
  </div>
</footer>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- BOOTSTRAP 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- PLUGINS EXTRAS -->
<script src="js/carrito.js"></script>
<script src="../../js/jquery.stellar.min.js"></script>
<script src="../../js/owl.carousel.min.js"></script>
<script src="../../js/smoothscroll.js"></script>
<script src="../../js/custom.js"></script>
</body>
</html>
