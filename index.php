<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BYTEZAR</title>

  <!-- Bootstrap 3 CSS y estilos -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/owl.carousel.css" />
  <link rel="stylesheet" href="css/owl.theme.default.min.css" />
  <link rel="stylesheet" href="css/tooplate-styles.css" />

  <link rel="icon" type="image/x-icon" href="favicon.ico">

</head>
<body>
<!-- ALERTAS DE LOGIN / LOGOUT -->
<div id="alert-container" class="text-center" style="margin-top: 90px; z-index: 1050; position: relative;"></div>
<script>
  const params = new URLSearchParams(window.location.search);
  const alertContainer = document.getElementById('alert-container');

  if (params.get('login') === 'exitoso') {
    alertContainer.innerHTML = `
      <div class="alert alert-success" role="alert">
        ✅ ¡Bienvenido/a! Has iniciado sesión correctamente.
      </div>
    `;
    setTimeout(() => alertContainer.innerHTML = "", 5000);
  } else if (params.get('logout') === '1') {
    alertContainer.innerHTML = `
      <div class="alert alert-info" role="alert">
        👋 Cerraste sesión correctamente.
      </div>
    `;
    setTimeout(() => alertContainer.innerHTML = "", 10000);
  }
  
</script>

<!-- PRE LOADER -->
<section class="preloader" id="main-loader">
  <div class="spinner"></div>
</section>
<div class="video-background">
  <video id="background-video"  autoplay muted loop playsinline>
    <source src="videos/video.mp4" type="video/mp4" />
    Tu navegador no soporta el video.
  </video>
</div>

<!-- NAVBAR Bootstrap 3 -->
<section class="navbar custom-navbar navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon icon-bar"></span>
        <span class="icon icon-bar"></span>
        <span class="icon icon-bar"></span>
      </button>
      <a href="index.php" class="navbar-brand">
        <img src="images/bytezar_imagen.png" class="img-responsive" alt="Logo Bytezar" style="width: 150px; margin-top: -10px;">
      </a>
    </div>

    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="#home" class="smoothScroll">Inicio</a></li>
        <li><a href="./catalogo/public/catalogo.php" class="smoothScroll">Catálogo</a></li>
        <li><a href="#feature" class="smoothScroll">Destacados</a></li>
        <li><a href="#about" class="smoothScroll">Quienes Somos</a></li>
        <li><a href="./contactos.php" class="smoothScroll">Contactos</a></li>
      </ul>
     
        <?php include_once 'backend/includes/navbar_usuario.php'; ?>
    </div>
  </div>
</section>

    <!-- FEATURE -->
<?php if (isset($_SESSION['usuario']['id_rol']) && $_SESSION['usuario']['id_rol'] === 1): ?>
<!-- Sección para Administrador -->
<section id="home" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6 col-sm-12">
        <div class="home-info">
          <h1>Panel Administrador</h1>
          <p style="margin-top: 20px; margin-bottom: 40px;">Gestión de productos</p>
          <a href="./catalogo/public/catalogo_admin.php" class="btn">Administrar Catálogo</a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php else: ?>
<!-- Sección para Cliente o Visitante -->
<section id="home" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6 col-sm-12">
        <div class="home-info">
          <h1>Bienvenido a BYTEZAR</h1>
          <p style="margin-top: 20px; margin-bottom: 40px;">El Bazar de la tecnología</p>
          <a href="./catalogo/public/catalogo.php" class="btn">Ver Catálogo</a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>


    <!-- FEATURE -->
    <section id="feature" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="section-title">
              <h1>Productos Destacados!</h1>
            </div>
          </div>

          <div class="col-md-6 col-sm-6">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active">
                <a
                  href="#tab01"
                  aria-controls="tab01"
                  role="tab"
                  data-toggle="tab"
                  >Laptops</a
                >
              </li>

              <li>
                <a
                  href="#tab02"
                  aria-controls="tab02"
                  role="tab"
                  data-toggle="tab"
                  >Smartphones</a
                >
              </li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab01" role="tabpanel">
                <div class="tab-pane-item">
                  <h2>Laptops - Ultima Generación</h2>
                  <p class="destacados">
                    Descubrí nuestras laptops de última generación: potentes,
                    livianas y con gran autonomía. Ideales para estudiar,
                    trabajar o disfrutar del entretenimiento donde estés. Con
                    procesadores modernos, diseño elegante y la seguridad que
                    necesitás, encontrá el equipo perfecto para tu día a día.
                    ¡Consultanos y aprovechá nuestras ofertas exclusivas!
                  </p>
                  <a href="./catalogo/public/catalogo.php" class="btn" id="destacados"
                    >Ver Catálogo</a
                  >
                </div>
              </div>
              <div class="tab-pane" id="tab02" role="tabpanel">
                <div class="tab-pane-item">
                  <h2>Smartphones - Innovación en tu mano</h2>
                  <p class="destacados">
                    Conectate al mundo con nuestros smartphones de última
                    generación: potentes, veloces y con cámaras de alta
                    definición. Ideales para comunicarte, capturar tus mejores
                    momentos y disfrutar tus apps favoritas en todo momento. Con
                    diseño moderno, pantallas envolventes y gran duración de
                    batería, encontrá el modelo que se adapta a tu estilo.
                    ¡Consultanos y descubrí promociones imperdibles!
                  </p>
                  <a href="./catalogo/public/catalogo.php" class="btn" id="destacados"
                    >Ver Catálogo</a
                  >
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-6">
            <div class="feature-image">
              <img
                id="img-laptop"
                src="images/feature-laptop.png"
                class="img-responsive"
                alt="Laptop"
                style="display: block"
              />

              <img
                id="img-smartphone"
                src="images/feature-smartphone.png"
                class="img-responsive"
                alt="Smartphone"
                style="display: none"
                width="80%"
                margin="20px"
                
              />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ABOUT -->
   <section id="about" data-stellar-background-ratio="0.5">
  <div class="container">
            <h1 style="
    color: aliceblue;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 0 auto;
    position: relative;
    gap: 15px;
">
    <span>¿Quienes somos?</span>
</h1>
    <div class="row">

      <!-- Imagen del local -->
      <div class="col-md-6 col-sm-6">
        <img src="images/local.jpg" class="img-responsive" alt="Local Bytezar" style="margin-top: 60px;">

      </div>

      <!-- Texto descriptivo -->
    <div class="col-md-6 col-sm-6 col-xs-12">
  <!-- Imagen arriba -->
  <img src="images/bytezar_imagen.png" class="img-responsive" alt="Foto del local Bytezar"
     style="margin-bottom: 30px; width: 300px; height: auto;">


  <!-- Texto debajo -->
<p style="font-size: 18px; line-height: 1.6;">
  <strong>Bytezar, el bazar de la tecnología.</strong><br><br>
  Nos caracteriza la vanguardia en innovación tecnológica y la excelente atención al cliente. 
  Estamos ubicados en el corazón del centro de Formosa, en 
  <a href="https://www.google.com/maps/place/Belgrano+885,+Formosa,+Argentina" 
     target="_blank" 
     style="color: #007bff; text-decoration: underline;">
    Belgrano 885
  </a>.<br><br>
  Ofrecemos lo último en laptops, smartphones, accesorios y servicios técnicos. 
  Nuestro compromiso es brindarte una experiencia única, con asesoramiento personalizado y productos de calidad.
</p>
<a href="contactos.php" class="btn">Contactanos</a>

</div>


    </div>
  </div>
</section>


   <!-- TESTIMONIALES -->
<section id="testimonial" data-stellar-background-ratio="0.5">
  <div class="container">
            <h1 style="
    color: rgb(18, 18, 19);
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 0 auto;
    position: relative;
    gap: 15px;
">
    <span>Opiniones </span>
</h1>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <div class="testimonial-image"></div>
      </div>

      <div class="col-md-6 col-sm-12">
        <div class="testimonial-info">
          <div class="section-title">
            <h3>Lo que dicen nuestros clientes</h3>
          </div>

          <div class="owl-carousel owl-theme">
            <div class="item">
              <h3>
                Compré mi notebook en Bytezar y la atención fue excelente. Me asesoraron según mis necesidades y me fui feliz con mi compra. ¡Recomendadísimo!
              </h3>
              <div class="testimonial-item">
                <img
                  src="images/tst-image1.jpg"
                  class="img-responsive"
                  alt="Juan Pérez"
                />
                <h4>Juan Pérez</h4>
              </div>
            </div>

            <div class="item">
              <h3>
                Siempre que necesito un accesorio o servicio técnico, recurro a Bytezar. Son rápidos, confiables y muy amables. Se nota que saben lo que hacen.
              </h3>
              <div class="testimonial-item">
                <img
                  src="images/tst-image2.jpg"
                  class="img-responsive"
                  alt="Carla Rodríguez"
                />
                <h4>Carla Rodríguez</h4>
              </div>
            </div>

            <div class="item">
              <h3>
                Excelente atención al cliente y productos de primera calidad. Me ayudaron a elegir mi nuevo celular y estoy más que conforme con la compra.
              </h3>
              <div class="testimonial-item">
                <img
                  src="images/tst-image3.jpg"
                  class="img-responsive"
                  alt="Luis Gómez"
                />
                <h4>Luisa Gómez</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- OFERTAS: Laptops y Smartphones -->
<section id="ofertas" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="section-title">
          <h1 style="
    color: aliceblue;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 0 auto;
    position: relative;
    gap: 15px;
">
    <span>Ofertas en Laptops y Smartphones</span>
</h1>

        </div>
      </div>

      <!-- Laptop 1 -->
      <div class="col-md-4 col-sm-6">
        <div class="pricing-thumb">
          <img src="images/hp1.avif" class="img-responsive" alt="Notebook HP 14" style="margin-bottom: 15px;">
          <div class="pricing-title">
            <h2>Notebook HP 14"</h2>
          </div>
          <div class="pricing-info">
            <p>Intel Core i3, 8GB RAM, 256GB SSD</p>
            <p>Liviana y rápida para el día a día</p>
          </div>
          <div class="pricing-bottom">
            <span class="pricing-dollar">$330.000</span>
            <a href="#" class="section-btn pricing-btn">Consultar</a>
          </div>
        </div>
      </div>

      <!-- Laptop 2 -->
      <div class="col-md-4 col-sm-6">
        <div class="pricing-thumb">
          <img src="images/asus1.jpg" class="img-responsive" alt="Notebook Asus VivoBook" style="margin-bottom: 15px;">
          <div class="pricing-title">
            <h2>Asus VivoBook 15</h2>
          </div>
          <div class="pricing-info">
            <p>AMD Ryzen 5, 12GB RAM, 512GB SSD</p>
            <p>Excelente rendimiento multitarea</p>
          </div>
          <div class="pricing-bottom">
            <span class="pricing-dollar">$420.000</span>
            <a href="#" class="section-btn pricing-btn">Consultar</a>
          </div>
        </div>
      </div>

      <!-- Smartphone 1 -->
      <div class="col-md-4 col-sm-6">
        <div class="pricing-thumb">
          <img src="images/galaxy14.jpeg" class="img-responsive" alt="Samsung Galaxy A14" style="margin-bottom: 15px;">
          <div class="pricing-title">
            <h2>Samsung Galaxy A14</h2>
          </div>
          <div class="pricing-info">
            <p>Pantalla 6.6”, 128GB, Cámara triple, Android 13</p>
            <p>Gran rendimiento a un precio accesible</p>
          </div>
          <div class="pricing-bottom">
            <span class="pricing-dollar">$210.000</span>
            <a href="#" class="section-btn pricing-btn">Consultar </a>
          </div>
        </div>
      </div>

     

    </div>
  </div>
</section>
<!-- Agrega esto justo antes del cierre de </body> -->
<a href="https://api.whatsapp.com/send?phone=5493704857048" 
   class="whatsapp-float" 
   target="_blank" 
   rel="noopener noreferrer"
   title="Chatea con nosotros por WhatsApp">
    <i class="fa fa-whatsapp whatsapp-icon"></i>
    <span class="whatsapp-text">Hablanos</span>
</a>



<!-- FOOTER -->
<footer class="bg-light text-center text-dark py-5 mt-5">
  <div class="container">
    <img src="<?= BASE_URL ?>/images/bytezar_imagen.png" alt="Bytezar" class="img-responsive center-block mb-3" style="max-width: 200px;">
    <p class="mb-3" style="font-size: 16px; color: #333;">Bytezar es el bazar de la tecnología. Ofrecemos laptops, smartphones y asesoramiento especializado en el corazón del centro de Formosa.</p>

    <button class="btn btn-dark mb-4" data-toggle="modal" data-target="#equipoModal">Equipo de desarrollo</button>

    <p class="text-muted" style="font-size: 13px;">&copy; 2025 Bytezar. Todos los derechos reservados.</p>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="equipoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-4">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" style="font-size: 24px; font-weight: 600;">Equipo de Desarrollo</h3>
        </div>
        <div class="modal-body">
          <div class="row text-center">
            <?php
              $equipo = [
                ["img" => "gerardo_medina.png", "nombre" => "Gerardo Medina"],
                ["img" => "jajo.jpg", "nombre" => "Javier Quintana"],
                ["img" => "gustavo_gines.jpg", "nombre" => "Gustavo Ginés"],
                ["img" => "leandro_nacimento.jpg", "nombre" => "Leandro Nacimento"],
                ["img" => "gabriela_heretichi.jpg", "nombre" => "Gabriela Heretichi"],
                ["img" => "tere_zamboni.jpg", "nombre" => "Teresa Zamboni"],
                ["img" => "leo_arce.jpg", "nombre" => "Leonardo Arce"],
                ["img" => "lourdes_villalba.jpg", "nombre" => "Lourdes Villalba"],
                ["img" => "max_justiniano.jpg", "nombre" => "Max Justiniano"]
              ];
              foreach ($equipo as $index => $persona): ?>
                <div class="col-xs-6 col-sm-4 col-md-3 text-center mb-3" style="display: inline-block; float: none;">
                  <img src="images/<?= $persona['img'] ?>"
                       alt="Integrante <?= $index + 1 ?> - <?= $persona['nombre'] ?>"
                       class="img-circular mb-2"
                       onerror="this.src='images/default.png'">
                  <p class="mb-0" style="font-size: 14px; color: #333; white-space: nowrap;"><?= $persona['nombre'] ?></p>
                </div>
            <?php endforeach; ?>
          </div>
          <div class="text-center mt-4">
            <p style="font-size: 14px; color: #777;">
              <strong>Trabajo Práctico</strong><br>
              Desarrollo de un sistema de gestión de ventas y catálogo de productos<br>
              <strong>Comisión 2.2</strong>
            </p>
            <img src="images/UTN_FRRE.png" alt="UTN" class="img-responsive center-block mb-3" style="max-width: 180px;">
            <p style="font-size: 14px; color: #777;">
              Universidad Tecnológica Nacional - Sede Formosa<br>
              Tecnicatura Universitaria en Programación<br>
              Materia: Metodología en Sistemas 1 - Docente<br>
              <strong>Facundo Leonel Verón</strong> - faccu.veron92@gmail.com<br>
              Comisión: 2.2
            </p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</footer>


<!-- JS SCRIPTS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/custom.js"></script>
<script src="js/carrito.js"></script>

</body>
</html>
