<?php
// Detectar si está en localhost o en Render
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    define('BASE_URL', '/BYTEZAR');
} else {
    define('BASE_URL', '');
}
