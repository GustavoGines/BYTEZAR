<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../helpers/bootstrap_helper.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$archivo_actual = basename($_SERVER['SCRIPT_NAME']);
$bs = detectar_bootstrap_version($archivo_actual);

$btnClass = 'btn btn-dark';
$modalFade = $bs === 3 ? 'modal fade' : 'modal fade';
$modalDialog = $bs === 3 ? 'modal-dialog' : 'modal-dialog modal-dialog-centered';
$modalDismiss = $bs === 3 ? 'data-dismiss="modal"' : 'data-bs-dismiss="modal"';
$modalToggle = $bs === 3 ? 'data-toggle="modal" data-target="#equipoModal"' : 'data-bs-toggle="modal" data-bs-target="#equipoModal"';
?>

<footer class="bg-light text-center text-dark py-5 mt-5">
  <div class="container">
    <img src="<?= BASE_URL ?>/images/bytezar_imagen.png" alt="Bytezar" class="img-fluid mb-3" style="max-width: 200px;">
    <p class="mb-3" style="font-size: 16px; color: #333;">Bytezar es el bazar de la tecnología. Ofrecemos laptops, smartphones y asesoramiento especializado en el corazón del centro de Formosa.</p>

    <button class="<?= $btnClass ?> mb-4" <?= $modalToggle ?>>Equipo de desarrollo</button>

    <p class="text-muted" style="font-size: 13px;">&copy; 2025 Bytezar. Todos los derechos reservados.</p>
  </div>

  <!-- Modal -->
  <div class="<?= $modalFade ?>" id="equipoModal" tabindex="-1" aria-hidden="true">
    <div class="<?= $modalDialog ?>">
      <div class="modal-content p-4">
        <div class="modal-header">
          <h3 class="modal-title" style="font-size: 24px; font-weight: 600;">Equipo de Desarrollo</h3>
          <?php if ($bs === 3): ?>
            <button type="button" class="close" <?= $modalDismiss ?>>&times;</button>
          <?php else: ?>
            <button type="button" class="btn-close" <?= $modalDismiss ?> aria-label="Cerrar"></button>
          <?php endif; ?>
        </div>
        <div class="modal-body">
          <div class="row <?= $bs === 3 ? 'text-center' : 'row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 justify-content-center' ?>">
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
                <div class="<?= $bs === 3 ? 'col-xs-6 col-sm-4 col-md-3' : '' ?> text-center mb-3" style="<?= $bs === 3 ? 'display: inline-block; float: none;' : '' ?>">
                    <img src="<?= BASE_URL . '/images/' . $persona['img'] ?>"
                     alt="Integrante <?= $index + 1 ?> - <?= $persona['nombre'] ?>"
                     class="img-circular mb-2"
                     onerror="this.src='<?= BASE_URL ?>/images/default.png'">
                  <p class="mb-0" style="font-size: 14px; <?= $bs === 3 ? 'color: #333; white-space: nowrap;' : '' ?>"><?= $persona['nombre'] ?></p>
                </div>
            <?php endforeach; ?>
          </div>
          <div class="text-center mt-4">
            <p style="font-size: 14px; color: #777;">
              <strong>Trabajo Práctico</strong><br>
              Desarrollo de un sistema de gestión de ventas y catálogo de productos<br>
              <strong>Comisión 2.2</strong>
            </p>
            <img src="<?= BASE_URL ?>/images/UTN_FRRE.png" alt="UTN" class="img-fluid mb-3" style="max-width: 180px;">
            <p style="font-size: 14px; color: #777;">
              Universidad Tecnológica Nacional - Sede Formosa<br>
              Tecnicatura en Programación<br>
              Materia: Metodología de Sistemas - Docente<br>
              <strong>Facundo Leonel Verón</strong> - faccu.veron92@gmail.com<br>
              Comisión: 2.2
            </p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="<?= $bs === 3 ? 'btn btn-default' : 'btn btn-secondary' ?>" <?= $modalDismiss ?>>Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</footer>
