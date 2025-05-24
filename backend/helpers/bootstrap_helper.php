<?php
if (!function_exists('detectar_bootstrap_version')) {
    function detectar_bootstrap_version($archivo) {
        $bootstrap3 = ['index.php', 'contactos.php', 'catalogo_admin.php', 'login.html', 'registro.html'];
        return in_array($archivo, $bootstrap3) ? 3 : 5;
    }
}
