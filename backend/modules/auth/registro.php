<?php
require_once __DIR__ . '/../../config/db.php';
include_once '../backend/includes/navbar_usuario.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1. Sanitizar datos del formulario
    $nombreCompleto = trim($_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telefono = trim($_POST['telefono']);
    $password = $_POST['password'];
    $fechaNacimiento = $_POST['fecha-nacimiento'];

    // 2. Separar nombre y apellido
    $partes = explode(' ', $nombreCompleto, 2);
    $nombre = $partes[0];
    $apellido = $partes[1] ?? '';

    // 3. Hashear la contraseña
    $passwordHasheada = password_hash($password, PASSWORD_DEFAULT);

    try {

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            header("Location: ../../../registro.html?error=email_duplicado");
            exit();
        }
         
        // 4. Insertar en personas
        $sqlPersona = "INSERT INTO personas (nombre, apellido, fecha_nacimiento, telefono) 
                       VALUES (?, ?, ?, ?)";
        $stmtPersona = $pdo->prepare($sqlPersona);
        $stmtPersona->execute([$nombre, $apellido, $fechaNacimiento, $telefono]);

        $idPersona = $pdo->lastInsertId();

        // 5. Insertar en usuarios con rol cliente (id_rol = 2 por defecto)
        $sqlUsuario = "INSERT INTO usuarios (id_personas, correo, contraseña, id_rol)
                       VALUES (?, ?, ?, 2)";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->execute([$idPersona, $email, $passwordHasheada]);

        // 6. Redirigir con éxito
        header("Location: ../../../login.html?registro=exitoso");
        exit();

    } catch (PDOException $e) {
        // Redirigir con error
        header("Location: ../../../registro.html?error=1");
        exit();
    }
}
// SOLO PARA DEBUG CAMBIAR EL CATCH
/* catch (PDOException $e) {
     echo "<h3>Error en el registro:</h3>";
     echo "<pre>" . $e->getMessage() . "</pre>";
     exit();
    } */
?>

