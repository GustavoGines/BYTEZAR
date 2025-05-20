<?php
session_start();
session_unset();      // Limpia variables de sesión
session_destroy();    // Destruye la sesión actual

// Redirige al home (puede cambiarse a login.html si preferís)
header("Location: /index.php?logout=1");
exit();
?>
