<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>BYTEZAR - Contactos</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="team" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="./css/tooplate-styles.css" />
    
</head>
<body>
    <!-- PRE LOADER -->
    <section class="preloader" id="main-loader">
        <div class="spinner">
            <span class="spinner-rotate"></span>
        </div>
    </section>
      <div class="video-background">
      <video id="background-video" autoplay muted loop playsinline>
        <source src="videos/video.mp4" type="video/mp4" />
        Tu navegador no soporta el video.
      </video>
    </div>

    <!-- MENU -->
    <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand">
                    <img src="images/bytezar_imagen.png" class="img-responsive" alt="Bytezar" style="width: 150px; margin-top: -10px;">
                </a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                   <li><a href="index.php" class="smoothScroll">Inicio</a></li>
                    <li><a href="./catalogo/public/catalogo.php" class="smoothScroll">Catálogo</a></li>
                    <li><a href="index.php#feature" class="smoothScroll">Destacados</a></li>
                    <li><a href="index.php#about" class="smoothScroll">Quiénes Somos</a></li>
                    <li class="active"><a href="contactos.php" class="smoothScroll">Contactos</a></li>
                </ul>
                <?php include 'backend/includes/navbar_usuario.php'; ?>
            </div>
        </div>
    </section>

    <!-- SECCIÓN DE CONTACTO -->
    <section id="contact"  style="padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <div class="section-title">
                        <h1 style="color: aliceblue;">Contáctanos</h1>
                        <p style="color: aliceblue;">¿Tienes consultas o necesitas asesoramiento? Escríbenos</p>
                    </div>

                    <form id="contact-form" role="form" method="post">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Teléfono de contacto">
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control" rows="6" id="mensaje" name="mensaje" placeholder="Tu mensaje..." required></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 text-center">
                                <button type="submit" class="btn section-btn">Enviar Mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


<!-- FOOTER -->
<footer id="footer" data-stellar-background-ratio="0.5" style="background: #f8f8f8; padding-top: 40px; padding-bottom: 40px;">
  <div class="container">
    <div class="row text-center">

      <!-- Logo e información del local -->
      <div class="col-md-12">
        <img src="images/bytezar_imagen.png" alt="Logo Bytezar" style="width: 200px; height: auto; margin-bottom: 15px;">
        <p style="font-size: 16px; color: #333;">
          Bytezar es el bazar de la tecnología. Ofrecemos laptops, smartphones y asesoramiento especializado en el corazón del centro de Formosa.
        </p>
        <hr style="margin: 30px auto; width: 60%;">
        <p class="text-muted" style="font-size: 13px;">&copy; 2025 Bytezar. Todos los derechos reservados.</p>
      </div>
</footer>

    <!-- SCRIPTS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
