<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
echo '<ul class="nav navbar-nav navbar-right me-auto">';
if (isset($_SESSION['usuario'])) {
    echo '<li class=" nav-item" ><a class="nav-link" href="#"><i class="fa fa-user"></i> ' . htmlspecialchars($_SESSION['usuario']['nombre']) . '</a></li>';
    echo '<li class=" nav-item"><a href="/BYTEZAR/backend/modules/auth/logout.php" class="logout-link"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>';
} else {
    echo '<li class="active nav-item"><a class="nav-link login-brillante" href="/BYTEZAR/login.html"><span>Login</span></a></li>';
}
echo '</ul>';
?>