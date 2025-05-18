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
       <li class="nav-item"><a class="nav-link login" href="../../login.html">Login</a></li>
     </ul> 
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
        <p class="descripcion-producto"><?= nl2br(htmlspecialchars($producto['descripcion'])) ?></p>
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
