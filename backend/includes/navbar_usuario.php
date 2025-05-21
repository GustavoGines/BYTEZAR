<?php
require_once __DIR__ . '/../config/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Detectar automáticamente la versión de Bootstrap según el archivo actual
$archivo_actual = basename($_SERVER['SCRIPT_NAME']);

function detectar_bootstrap_version($archivo) {
    // Lista de archivos que usan Bootstrap 3
    $bootstrap3 = ['index.php', 'contactos.php']; // ← Agregá los nombres de tus archivos B3 aquí
    return in_array($archivo, $bootstrap3) ? 3 : 5;
}

$bootstrap_version = detectar_bootstrap_version($archivo_actual);

echo '<ul class="nav navbar-nav navbar-right">';

if (isset($_SESSION['usuario'])) {
    if ($bootstrap_version === 5) {
        // Bootstrap 5
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
        echo '<i class="fa fa-user me-2"></i>' . htmlspecialchars($_SESSION['usuario']['nombre']);
        echo '</a>';
        echo '<ul class="dropdown-menu dropdown-menu-end">';
        echo '<li><a class="dropdown-item" href="' . BASE_URL . '/backend/modules/auth/logout.php"><i class="fa fa-sign-out me-2"></i> Cerrar sesión</a></li>';
        echo '</ul>';
        echo '</li>';
    } else {
        // Bootstrap 3
        echo '<li class="dropdown">';
        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
        echo '<i class="fa fa-user"></i> ' . htmlspecialchars($_SESSION['usuario']['nombre']) . ' <span class="caret"></span>';
        echo '</a>';
        echo '<ul class="dropdown-menu">';
        echo '<li><a href="' . BASE_URL . '/backend/modules/auth/logout.php"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>';
        echo '</ul>';
        echo '</li>';
    }
} else {
    echo '<li class="nav-item active"><a class="nav-link login-brillante" href="' . BASE_URL . '/login.html"><span>Login</span></a></li>';
}

echo '</ul>';
?>
