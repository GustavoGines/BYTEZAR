<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.html");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Compra Exitosa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center mt-5">
  <div class="card shadow-sm p-4">
    <h1 class="text-success">¡Gracias por tu compra!</h1>
    <p class="lead">Tu pedido ha sido registrado correctamente.</p>
    <hr>
    <a href="index.php" class="btn btn-primary mt-3">Volver al inicio</a>
  </div>
</div>

</body>
</html>
