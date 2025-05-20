<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Buscar usuario por correo
    $sql = "SELECT u.*, p.nombre 
            FROM usuarios u
            JOIN personas p ON u.id_personas = p.id
            WHERE u.correo = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['contraseña'])) {
        // Inicio de sesión exitoso
        session_regenerate_id(true); // seguridad
        $_SESSION['usuario'] = [
            'id_personas' => $usuario['id_personas'],
            'correo' => $usuario['correo'],
            'nombre' => $usuario['nombre'],
            'id_rol' => $usuario['id_rol']
        ];

        // Redirigir al inicio con mensaje
        header("Location: ../../../index.php?login=exitoso");
        exit();
    } else {
        // Credenciales incorrectas
        header("Location: ../../../login.html?error=1");
        exit();
    }
}
?>
