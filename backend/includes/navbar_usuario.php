<?php
require_once __DIR__ . '/../config/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo '<ul class="nav navbar-nav navbar-right me-auto">';

if (isset($_SESSION['usuario'])) {
    echo '<li class="dropdown">';
    echo '  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">';
    echo '    <i class="fa fa-user"></i> ' . htmlspecialchars($_SESSION['usuario']['nombre']) . ' <span class="caret"></span>';
    echo '  </a>';
    echo '  <ul class="dropdown-menu">';
    echo '    <li><a href="' . BASE_URL . '/backend/modules/auth/logout.php"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>';
    echo '  </ul>';
    echo '</li>';
} else {
    echo '<li class="active nav-item"><a class="nav-link login-brillante" href="' . BASE_URL . '/login.html"><span>Login</span></a></li>';
}

echo '</ul>';